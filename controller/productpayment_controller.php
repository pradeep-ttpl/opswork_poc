<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : productpayment_controller.php
 * @version  : 1.0
 * @date  : 18-Aug-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila                 18-Aug-2012           Initial Version - File Created
 * 
 */

class Productpayment_Controller
{
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
		
		$MCrypt	= new MCrypt;
		
		$template = 'productpayment'; 
		$productpaymentModel = new productpayment_Model;
		global $constantArr;

		// Payment transaction failed return repsone
		if(isset($reqVars['x_response_code']) && $reqVars['x_response_code'] != "1")
		{
			$trans_error_msg = $reqVars['x_response_reason_text'];
		}
		
		/****** Summary details validation starts *************/
		
		$chkSummaryDetails = new SummaryValidations();
		
		//Checking whether all VIN entered is valid for filing
		$EINvalidation = $chkSummaryDetails->checkEIN();
		
		//Checking whether the EIN is valid for filing
		$vinValidation = $chkSummaryDetails->checkVIN();
		
		//Checking whether there is taxable vehicle
		$totalTaxVehicles = 0;
		if(isset($_SESSION['formtype']) && $_SESSION['formtype'] == '2290')
		{
			$chkTaxableAmount = $chkSummaryDetails->chkTaxableAmount();
			$totalTaxVehicles = $chkSummaryDetails->totalTaxVehicles();
		}
		
		//Checking whether credit exceeding the tax amount for the selected filing
		if(isset($_SESSION['formtype']) && $_SESSION['formtype'] == '2290')
		$creditExceedValidation = $chkSummaryDetails->checkCreditExceed();
		
		//Checking whether payment selected for filing
		$chkPaymentSelection = 0;
		if(isset($_SESSION['formtype']) && ($_SESSION['formtype'] == '2290A1' || $_SESSION['formtype'] == '2290A2' || ($_SESSION['formtype']=='2290' && $totalTaxVehicles > 0)))
		$chkPaymentSelection = $chkSummaryDetails->chkPaymentSelection();
		
		//Checking whether the vehicles entered are following the filing rule
		if(isset($_SESSION['formtype']) && $_SESSION['formtype'] == '2290')
		$VINruleValidation = $chkSummaryDetails->checkVINrule();
		
		$errorArray = array();
		
		if($EINvalidation > 0)
		array_push($errorArray,1);
		
		if($vinValidation > 0)
		array_push($errorArray,2);
		
		if(isset($_SESSION['formtype']) && $_SESSION['formtype'] == '2290' && $creditExceedValidation < 0)
		array_push($errorArray,3);
		
		if((isset($_SESSION['formtype']) && ($_SESSION['formtype'] == '2290A1' || $_SESSION['formtype'] == '2290A2' || ($_SESSION['formtype']=='2290' && $totalTaxVehicles > 0))) && $chkPaymentSelection == 0)
		array_push($errorArray,4);
		
		if(isset($_SESSION['formtype']) && $_SESSION['formtype'] == '2290' && $VINruleValidation > 0)
		{
			if($VINruleValidation == 1)
			array_push($errorArray,5);
			else if($VINruleValidation == 2)
			array_push($errorArray,6);
			else if($VINruleValidation == 3)
			array_push($errorArray,7);
			else if($VINruleValidation == 4)
			array_push($errorArray,8);
		}
		
		if(isset($_SESSION['formtype']) && $_SESSION['formtype'] == '2290' && $chkTaxableAmount == 0)
		array_push($errorArray,9);
		
		//User cannot submit his return only with prior year suspended vehicle unless it is users final return .
		if($_SESSION['final_prior_validation'] == 'error'){ array_push($errorArray,10); }
		
		/* Amended - Taxable gross weight increased vehicles - 
		 * If Form 2290, "Amended Return" checkbox is checked, then the Schedule 1 must contain at least one VIN. */
		if($_SESSION['formtype'] == '2290A1'){
			$tgwincreasedModel 	= new Tgwincreased_Model;
			$tgwIncreasedVehicles = $tgwincreasedModel->getTGWIncreaseInfo($_SESSION['user_id'],$_SESSION['filingId']);
		}

		if(isset($_SESSION['finalReturn']) && $_SESSION['finalReturn'] == 1 && count($tgwIncreasedVehicles) == 0 && $_SESSION['formtype'] == '2290A1'){ array_push($errorArray,11);}
		/* Amended - Taxable gross weight increased vehicles - Ends here*/
		
		/* Amended - Exceeded Mileage -
		 * If Form 2290, "Amended Return" checkbox is checked, then the Schedule 1 must contain at least one VIN. */
		if($_SESSION['formtype'] == '2290A2'){
			$exceededMileageModel = new exceededmileage_Model;
			$getExceededMileageVehiInfo = $exceededMileageModel->getExceededMileageVehiInfo($_SESSION['user_id'],$_SESSION['filingId']);
		}

		if(isset($_SESSION['finalReturn']) && $_SESSION['finalReturn'] == 1 && count($getExceededMileageVehiInfo) == 0 && $_SESSION['formtype'] == '2290A2'){ array_push($errorArray,11);}
		
		/* Amended - Exceeded Mileage - Ends here*/

		
		if(count($errorArray) > 0)
		{
			$_SESSION['errorArray'] = $errorArray;
			header('location:/summary/');
			exit(0);
		}
		
		/****** Summary details validation ends *************/
		
		
		//Save data into extra fields table
		$result = $productpaymentModel->saveExtraFields();
		
		/////////////////////// API CALL - XSD Validation ////////////////////////////
		$filingid = $_SESSION['filingId'];
		$json = file_get_contents(XSD_VALIDATION_PATH.$filingid);
		$validation_result = json_decode($json, true);
		if($json === FALSE) 
		{ 
			// To create the mailing content
			$message = APICommunicationErrorContent("summary", TT_SITE_NAME);
			$subject = "Alert: http://".$_SERVER['SERVER_NAME']." - Error Connecting API";
			// send communication error mail to administrator
			$sendMail =  SendEmail(TT_ALERT_MAIL_FROM,TT_ALERT_MAIL_TO,$subject,$message);
			
			$_SESSION['validation_error'] = $constantArr['summary_error'][$_SESSION['lang']]; 
			header('location:/summary/');
			exit(0);
		}		
		if($validation_result['result'] != "Success")
		{		
			//To be removed - only for testing
			$_SESSION['xmlValidationError'] = $validation_result['result'];

			// Show known xsd validation errors to user
			$xsdValidationResult = getKnownXSDErrors($validation_result['result']);
			if($xsdValidationResult){
				$_SESSION['validation_error'] = $xsdValidationResult;
			}else{
				// Get filer informations
				$user_info = $productpaymentModel->getUserInfo($filingid);
			
				$user_name = $user_info['first_name'];
				$user_mail = $user_info['email'];
				$user_phone = $user_info['phone'];
				
				// To create the mailing content
				$message = summaryXSDValidationFailed($MCrypt->decrypt($user_name), $MCrypt->decrypt($user_mail), $MCrypt->decrypt($user_phone), $validation_result, $filingid, TT_SITE_NAME);
				$subject = "Alert: http://".$_SERVER['SERVER_NAME']." - XSD Validation Error";
				// send communication error mail to administrator
				$sendMail =  SendEmail(TT_ALERT_MAIL_FROM,TT_ALERT_MAIL_TO,$subject,$message);
			
				$_SESSION['validation_error'] = $constantArr['summary_error'][$_SESSION['lang']]; 
			}
			header('location:/summary/');
			exit(0);
		}
		/////////////////////////////////////////////////////////////
		
		$filingcharge = $productpaymentModel->getfilingfee();
		
		$filingfee = $filingcharge['diff'];
		
		$invoice_no	= $_SESSION['filingId'].date("YmdHis");
		$sequence	= rand(1, 1000);
		$timeStamp	= time();
		
		$_SESSION['filing_fee'] = $filingfee;
		
		// Check for payment made for filing in previous transactions
		if($filingfee <= 0 || $_SESSION['formtype'] == '2290V' || ( $_SESSION['finalReturn'] == 1 && $filingfee == 0) )
		{
			header('location:/paymentsuccess/');
			exit(0);
		}
		
		// Get offers and discounts
		// $discounts = $productpaymentModel->getdiscounts();
		
		// get user business information for payment gateway submission
		$addbusiness_Model = new Addbusiness_Model;
		$getBusinessiInfo = $addbusiness_Model->getUsersBusinessInfo($_SESSION['user_id'],$_SESSION['selectedbusiness']);
		
		// get file tax year and form type details
		$taxpayerbusinessDAO = new Taxpayerbusiness_DAO;
		$file_details = $taxpayerbusinessDAO->getFilingDetails($filingid);
		
		// get user details
		$registerDAO = new Register_DAO;
		$userDetails = $registerDAO->getUserDetails($_SESSION['user_id']);

		// Passing the response data to UI template.
		$tpl = new Template_Model($template);	
		$tpl->assign('filingcharge',$filingcharge);
		$tpl->assign('invoice_no',$invoice_no);
		$tpl->assign('sequence',$sequence);
		$tpl->assign('timeStamp',$timeStamp);
        // $tpl->assign('discounts',$discounts);
		$tpl->assign('bizinfo',$getBusinessiInfo);
		$tpl->assign('userinfo',$userDetails);
		$tpl->assign('filinginfo',$file_details);
		$tpl->assign('trans_error',$trans_error_msg);
	}
}
