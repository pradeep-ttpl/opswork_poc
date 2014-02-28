<?php
/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: exceededmileage_controller.php
 * @version  	: 1.0
 * @date  	 	: 26-Dec-2013
 *
 * @description : Exceededmileage controller file
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        26-Dec-2013           Initial Version - File Created
 * 
 */


 class Exceededmileage_Controller
 {
 	
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
		
		$template 		  = 'exceededmileage';  //set a template name to a variable
		
		if(isset($_SESSION['admin_user_id']) && $_SESSION['admin_user_id'] > 0){
			$userid = $_SESSION['admin_user_id'];
		}else{
			$userid = $_SESSION['user_id'];
		}
		
		if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
			$filingId = $_SESSION['admin_filing_id'];
		}else{
			$filingId = $_SESSION['filingId'];
		}
		
		if(isset($_SESSION['admin_biz_id']) && $_SESSION['admin_biz_id'] > 0){
			$selectedBusiness = $_SESSION['admin_biz_id'];
		}else{
			$selectedBusiness = $_SESSION['selectedbusiness'];
		}
		
		if(isset($_SESSION['admin_filing_year']) && $_SESSION['admin_filing_year'] > 0){
			$filingYear = $_SESSION['admin_filing_year'];
		}else{
			$filingYear = $_SESSION['filingYear'];
		}		
		
		if(isset($_SESSION['admin_filing_month']) && $_SESSION['admin_filing_month'] > 0){
			$filingMonth = $_SESSION['admin_filing_month'];
		}else{
			$filingMonth = $_SESSION['filingMonth'];
		}
		
		if(isset($_SESSION['admin_biz_id']) && $_SESSION['admin_biz_id'] > 0){
			$businessId = $_SESSION['admin_biz_id'];
		}else{
			$businessId = $_SESSION['selectedbusiness'];
		}
		
		$request 	= $_SERVER['REQUEST_URI'];
		$parsed 	= explode('/', $request);
		
		$MCrypt	= new MCrypt;
		
			
		if(isset($_REQUEST['vehicleno']))
        $urlvin 	= $_REQUEST['vehicleno'];
		
		$taxablevehicleinfoModel	= new taxablevehicleinfo_Model;
		$exceededMileageModel 		= new exceededmileage_Model;
		
		$getweight    = $taxablevehicleinfoModel->getTaxweight();
		$userVehicles = $taxablevehicleinfoModel->getUserVehicles($userid);
		$addExceededMileageVehiInfo ='';
		if(isset($parsed[2]) && $parsed[2] =='add')
		{
			$template = 'addexceededmileage';
		}
		if(isset($reqVars['addexceededmileage']))
		{
			$licenceNo	= $reqVars['lno'];
			$vin 			= $reqVars['vin'];
			$loggingInfo 	= $reqVars['logging'];
			$createdBy		= $_SESSION['user_id'];
			$exceededMileageWeight = $reqVars['taxableWeight'];
			
		
			$addExceededMileageVehiInfo = $exceededMileageModel->addExceededMileageVehicle($businessId, $licenceNo,$vin,$loggingInfo,$exceededMileageWeight,$filingId,$filingMonth,$filingYear,$createdBy);
			
			
			if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$_SESSION['adminStatusMsg'] = $addExceededMileageVehiInfo;
				header("location:/filingsummary/".encryptID($_SESSION['admin_filing_id']));
			}else{
				$_SESSION['addExceededMileageMsg'] = $addExceededMileageVehiInfo;
				header("location:/exceededmileage/");
			}
			exit(0);
		}
		$editTaxVehiInfo = '';
		$getExceededMileageVehiInfo = $exceededMileageModel->getExceededMileageVehiInfo($userid,$filingId);
		if(isset($parsed[2]) && $parsed[2] =='edit' || isset($reqVars['updateexceededmileage']) )
		{
			$template = 'editexceededmileage';
			
			$TaxableId = decryptID($reqVars['emId']);
			$editTaxVehiInfo = $exceededMileageModel->editExceededMileageFilingVehiDetails($TaxableId,$selectedBusiness);
			if(isset($reqVars['updateexceededmileage']))
			{
				$licenceNo	= $reqVars['lno'];
				$vin 			= $reqVars['vin'];	
				$loggingInfo 	= $reqVars['logging'];
				$TaxableId 		= decryptID($reqVars['emId']);
				$modifiedBy		= $_SESSION['user_id'];

				$exceededMileageWeight = $reqVars['taxableWeight'];
				
				$updateExceededMileageVehiInfo = $exceededMileageModel->updateExceededMileageVehiInfo($businessId, $licenceNo,$vin,$exceededMileageWeight,$loggingInfo,$TaxableId,$filingId,$filingMonth,$filingYear,$modifiedBy);
				
				
				if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
					$_SESSION['adminStatusMsg'] = $updateExceededMileageVehiInfo;
					header("location:/filingsummary/".encryptID($_SESSION['admin_filing_id']));
				}else{
					$_SESSION['updateExceededMileageMsg'] = $updateExceededMileageVehiInfo;
					header("location:/exceededmileage/");
				}
				exit(0);
			}
		}
		
		$tpl = new Template_Model($template);	
		$tpl->assign('Taxweights',$getweight);
		$tpl->assign('userVehicles',$userVehicles);
		$tpl->assign('addExceededMileageVehiInfo',$addExceededMileageVehiInfo);
		$tpl->assign('getExceededMileageVehiInfo',$getExceededMileageVehiInfo);
		$tpl->assign('editTaxVehiInfo',$editTaxVehiInfo);
	}
 }
?>