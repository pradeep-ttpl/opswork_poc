<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename	: filingsummary_controller.php
 * @version 	: 1.0
 * @date  		: 10-Jan-2014
 *
 * @description : Filling user's tax from Admim as Support user.
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar           10-Jan-2014           Initial Version - File Created
 * 
 */

class Filingsummary_Controller
{	
	public $template = 'summary';
	
	public function main( array $reqVars )
	{	
		if(!isset($_SESSION['user_id']))
		{
			header( 'Location: '.TT_SITE_NAME.'login');
			exit();
		}
		
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
		
		$request = $_SERVER['REQUEST_URI']; 
		$parsed = explode('/', $request);
		
		$filingid = $this->MCrypt->decrypt($parsed[2]);
		
		
		// get file tax year and form type details
		$taxpayerbusinessDAO = new Taxpayerbusiness_DAO;
		$file_details = $taxpayerbusinessDAO->getFilingDetails($filingid);
		
		$_SESSION['admin_filing_id'] = $filingid;
		$userid 	= $_SESSION['admin_user_id'] 	= $file_details['user_id'];
		$businessId = $_SESSION['admin_biz_id'] 	= $file_details['biz_id'];
		$formType 	= $_SESSION['admin_form_type'] 	= $file_details['form_type'];
		$filingMonth= $_SESSION['admin_filing_month'] 	= $this->MCrypt->decrypt($file_details['filing_month']);
		$filingYear = $_SESSION['admin_filing_year']= $file_details['filing_year'];
		
		// get business details
		$addbusiness_Model = new Addbusiness_Model;
		$businessiInfo = $addbusiness_Model->getUsersBusinessInfo($userid,$businessId);
		
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