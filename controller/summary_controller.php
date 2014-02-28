<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : summary_controller.php
 * @version  : 1.0
 * @date  : 21-Jul-2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           21-Jul-2012           Initial Version - File Created
 * 
 */

class Summary_Controller
{	
	public $template = 'summary';
	
	public function main( array $reqVars )
	{	
		if(!isset($_SESSION['user_id']))
		{
			header( 'Location: '.TT_SITE_NAME.'login');
			exit();
		}
		
		$filingid = $_SESSION['filingId'];
		$userid = $_SESSION['user_id'];
		$businessId = $_SESSION['selectedbusiness'];
		$formType = $_SESSION['formtype'];

		// get business details
		$addbusiness_Model = new Addbusiness_Model;
		$businessiInfo = $addbusiness_Model->getUsersBusinessInfo($userid,$businessId);
		
		// get file tax year and form type details
		$taxpayerbusinessDAO = new Taxpayerbusiness_DAO;
		$file_details = $taxpayerbusinessDAO->getFilingDetails($filingid);
		
		// get number of vehicles filed
		$vehicle_count = $taxpayerbusinessDAO->getVehicleCount($filingid);
		
		// get details about reported taxable vehicle
		$taxablevehicleinfoModel = new taxablevehicleinfo_Model;
		$reportedVehicleInfo = $taxablevehicleinfoModel->getTaxVehiInfo($filingid,$userid);
		
		// get details about current year suspended vehicles
		$currentyrsuspendModel = new currentyrsuspend_Model;
		$suspendedVehicleInfo = $currentyrsuspendModel->getCursuspendInfo($userid,$filingid);
		
		// get details about prior year suspended vehicles
		$prioryrModel = new prioryrsuspend_Model;
		$priorsuspendedVehicleInfo = $prioryrModel->getPriorYrSusinfo($userid,$filingid);
		
		// get sold/lost/destroyed vehicle info
		$solddestroycreditModel = new Solddestroycredit_Model;
		$lossVehicleInfo = $solddestroycreditModel->getSoldDestroyCreditInfo($userid,$filingid);
		
		// get low milieage vehicle info
		$lowMileageCreditModel = new Lowmileagecredit_Model;
		$lowMilieageClaimInfo = $lowMileageCreditModel->getcreditVehiInfo($userid,$filingid);
		
		// get over payment credit info
		$overpaymentModel = new Overpayment_Model;
		$overPaymentCredit = $overpaymentModel->getOverpayment($userid,$filingid);
		
		// amended - taxable gross weight increased vehicles
		$tgwincreasedModel 	= new Tgwincreased_Model;
		$tgwIncreasedVehicles = $tgwincreasedModel->getTGWIncreaseInfo($userid,$filingid);
		
		// amended - exceeded mileage
		$exceededMileageModel = new exceededmileage_Model;
		$getExceededMileageVehiInfo = $exceededMileageModel->getExceededMileageVehiInfo($userid,$filingid);
		
		// amended - exceeded mileage
		$vinCorrectionModel = new Vincorrection_Model;
		$vinCorrectionlist  = $vinCorrectionModel->getOverAllCorrectingVIN($userid,$filingid);
		// To get vehicle count only from VIN correction tt_filing_vin_correction table
		if($formType == '2290V'){
			$vehicle_count = count($vinCorrectionlist);	
		}
		
		// To get payment option and details
		$paymentoptionDAO = new Paymentoption_DAO;
		$paymentDetails = $paymentoptionDAO->getfilingPaymentDetails($filingid);
		
		// Reset error message from IRS on rejected submissions
		if($file_details['error_description'] != '')
		{
			$result = $taxpayerbusinessDAO->resetFilingErrorMsgs($filingid);
		}
		
		//User cannot submit his return only with prior year suspended vehicle unless it is users final return .
		if(isset($_SESSION['final_prior_validation']))unset($_SESSION['final_prior_validation']);
		
		if(count($reportedVehicleInfo) == 0 && count($suspendedVehicleInfo) == 0 &&  
		count($priorsuspendedVehicleInfo) > 0 && count($lossVehicleInfo) == 0 &&  
		count($lowMilieageClaimInfo) == 0 && $_SESSION['finalReturn'] == 0){
			$_SESSION['final_prior_validation'] = 'error';
		}
		
		$tpl = new Template_Model($this->template);	
		$tpl->assign('businessInfo',$businessiInfo);
		$tpl->assign('fileDetails',$file_details);
		$tpl->assign('reportedVehicleInfo',$reportedVehicleInfo);
		$tpl->assign('suspendedVehicleInfo',$suspendedVehicleInfo);
		$tpl->assign('priorsuspendedVehicleInfo',$priorsuspendedVehicleInfo);
		$tpl->assign('lossVehicleInfo',$lossVehicleInfo);
		$tpl->assign('lowMilieageClaimInfo',$lowMilieageClaimInfo);
		$tpl->assign('overPaymentCredit',$overPaymentCredit);
		$tpl->assign('tgwIncreasedVehicles',$tgwIncreasedVehicles);
		$tpl->assign('exceededMileage',$getExceededMileageVehiInfo);
		$tpl->assign('vinCorrectionlist',$vinCorrectionlist);		
		$tpl->assign('paymentDetails',$paymentDetails);
		$tpl->assign('vehicleCount',$vehicle_count);
		$tpl->assign('formType',$formType);
	}		
}

?>