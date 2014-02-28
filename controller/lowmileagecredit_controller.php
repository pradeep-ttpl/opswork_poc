<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : lowmileagecredit_controller.php
 * @version  : 1.0
 * @date  : 21-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Manojkumar            21-Jul-2012           Initial Version - File Created
 * 
 */
	class Lowmileagecredit_Controller
	{
		public function main( $reqVars )
		{
			$template = 'lowmileagecredit';
			$request = $_SERVER['REQUEST_URI'];
			$parsed = explode('/', $request);
			
			if(isset($_SESSION['admin_user_id']) && $_SESSION['admin_user_id'] > 0){
				$userId = $_SESSION['admin_user_id'];
			}else{
				$userId = $_SESSION['user_id'];
			}
			
			if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$filingId = $_SESSION['admin_filing_id'];
			}else{
				$filingId = $_SESSION['filingId'];
			}
			
			if(isset($_SESSION['admin_biz_id']) && $_SESSION['admin_biz_id'] > 0){
				$businessId = $_SESSION['admin_biz_id'];
			}else{
				$businessId = $_SESSION['selectedbusiness'];
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
			
			if(isset($_SESSION['admin_form_type']) && $_SESSION['admin_form_type'] > 0){
				$formType = $_SESSION['admin_form_type'];
			}else{
				$formType = $_SESSION['formtype'];
			}

			
			if(!isset($_SESSION['user_id']))
			{
				header( 'Location: '.TT_SITE_NAME.'login');	
				exit();
			}
			
			$taxablevehicleinfoModel 	= new taxablevehicleinfo_Model;
			$MCrypt	= new MCrypt;
			
			$getweight       			= $taxablevehicleinfoModel->getTaxweight();
			
			$lowMileageCreditModel = new Lowmileagecredit_Model;
			
			if(isset($reqVars['addlowmileage']))
			{
				$licenceNo	= $reqVars['lno'];
				$vin = $reqVars['vin'];
				$TaxweightId = $reqVars['taxableWeight'];
				$loggingInfo = $reqVars['logging'];
				$monthused = $reqVars['monthused'];
				$date = date('Y-m-d h:i:s');
				$createdBy = $_SESSION['user_id'];
				
				if(isset($reqVars['explanation']))
				$explanation = $reqVars['explanation'];
				else 
				$explanation = '';
				
				$addLowMileage = $lowMileageCreditModel->addLowMileage($businessId, $licenceNo,$vin,$TaxweightId,$loggingInfo,$monthused,$explanation,$userId,$filingId,$formType,$filingYear,$date,$createdBy);
				
				
				if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
					$_SESSION['adminStatusMsg'] = $addLowMileage;
					header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
				}else{
					$_SESSION['addLowMilMsg'] = $addLowMileage;
					header('location:/lowmileagecredit/');
				}
				exit(0);
			}
			
			$getcreditVehiInfo 			= $lowMileageCreditModel->getcreditVehiInfo($userId,$filingId);
			
			$taxablevehicleinfoModel 	= new taxablevehicleinfo_Model;
			$userVehicles = $taxablevehicleinfoModel->getUserVehicles($userId);

			if (isset($parsed[2]) && $parsed[2] == 'add')
			{
				$template = 'addlowmileagecredit';
			}
			
			if (isset($parsed[2]) && $parsed[2] == 'view')
			{
				$template = 'viewlowmileagecredit';
				$lowMlgId = decryptID($reqVars['lowMlgId']);
				
				$getcreditvehiDet = $lowMileageCreditModel->getcreditdetails($lowMlgId,$businessId);
			}
			
			if(isset($parsed[2]) && $parsed[2]=='edit')
			{
				$template = 'editlowmileagecredit';
				$lowMlgId = decryptID($reqVars['lowMlgId']);
				
				$getcreditvehiDet = $lowMileageCreditModel->getcreditdetails($lowMlgId,$businessId);
			}
			
			if(isset($reqVars['updatecreditvehicle']))
			{
				$licenceNo	= $reqVars['lno'];
				$lowMlgId = decryptID($reqVars['lowMlgId']);
				$vin = $reqVars['vin'];
				$taxableGrossweight = $reqVars['taxableWeight'];
				$TaxweightId = $reqVars['taxableWeight'];
				$loggingInfo = $reqVars['logging'];
				$monthused = $reqVars['monthused'];
				$uploadDocumentName = $reqVars['UploadDocName'];
				$modifiedBy		= $_SESSION['user_id'];
				
				if(isset($reqVars['explanation']))
				$explanation = $reqVars['explanation'];
				else 
				$explanation = '';
				
				$updatecreditDetails= $lowMileageCreditModel->updateCreditDetails($businessId, $licenceNo,$vin,$taxableGrossweight,$TaxweightId,$loggingInfo,$monthused,$explanation,$userId,$filingId,$filingYear,$lowMlgId,$uploadDocumentName,$modifiedBy,$formType);
				

				if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
					$_SESSION['adminStatusMsg'] = $updatecreditDetails;
					header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
				}else{
					$_SESSION['updateLowMilMsg'] = $updatecreditDetails;
					header("location:/lowmileagecredit/");
				}
				exit(0);
			
			}

			if(isset($reqVars['uploadExcel']))
			{
				$uploadExcel = $lowMileageCreditModel->uploadExcel($filingId,$filingYear);		
				
				$getcreditVehiInfo 	= $lowMileageCreditModel->getcreditVehiInfo($userId,$filingId);		
				
				$_SESSION['uploadExcel'] = $uploadExcel;
				header('location:/lowmileagecredit/');
				exit(0);
			}
				
			$tpl = new Template_Model($template);	
			$tpl->assign('Taxweights',$getweight);
			$tpl->assign('userVehicles',$userVehicles);
			$tpl->assign('getcreditvehicle',$getcreditVehiInfo);
			if(isset($getcreditvehiDet))
			{
				$tpl->assign('editcreditdata',$getcreditvehiDet);
			}
			if(isset($uploadExcel))
			{
				$tpl->assign('uploadExcelMsg',$uploadExcel);
			}
		}
	}
?>