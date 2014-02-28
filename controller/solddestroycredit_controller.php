<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : solddestroycredit_controller.php
 * @version  : 1.0
 * @date  : 20-Jul-2012
 *
 * @description :
 *
 * @author      : Manojkumar
 *
 * History of modifications:
 *
 * Author                		Date                  Description of modifications
 * ----------            	   ------------           ------------------------------
 * Manojkumar         		   20-Jul-2012            Initial Version - File Created
 * Akila				       23-Jul-2012            Add,edit - issue fixed.
 * Akila				       23-Jul-2012            delete functionality added.
 */
class Solddestroycredit_Controller
{
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
		
		$MCrypt	= new MCrypt;
		
		if(isset($_SESSION['admin_user_id']) && $_SESSION['admin_user_id'] > 0){
			$userId = $_SESSION['admin_user_id'];
		}else{
			$userId = $_SESSION['user_id'];
		}
		
		if(isset($_SESSION['admin_form_type']) && $_SESSION['admin_form_type'] != '')
		$formType = $_SESSION['admin_form_type'];
		else
		$formType = $_SESSION['formtype'];
		
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
		
		$template = 'solddestroycredit';
		
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		
		if(isset($_REQUEST['sldDtroyCrdId']))
		$sldDtroyCrdId  = decryptID($_REQUEST['sldDtroyCrdId']);
		
		if(isset($_REQUEST['vehicleno']))
		$vin = $_REQUEST['vehicleno'];
		
		$solddestroycreditModel = new Solddestroycredit_Model;
		
		$editcurrentsuspend = '';
		$addNewCurrentsuspendinfoResult ='';
		$updatecurrentsuspendInfo = '';
		
		$taxablevehicleinfoModel 	= new taxablevehicleinfo_Model;
		$userVehicles = $taxablevehicleinfoModel->getUserVehicles($userId);
		
		if (isset($parsed[2]) && $parsed[2] == 'view')
		{
			$template = 'viewsolddestroycredit';
			$editSoldDestInfo = $solddestroycreditModel->editSoldDestroyInfo($businessId,$sldDtroyCrdId);
		}
		else if (isset($parsed[2]) && $parsed[2] == 'add')
		{
			$template = 'addsolddestroycredit';
		}
		else if(isset($reqVars['addSoldInfo']))
		{	
			$licenceNo	= $reqVars['lno'];				
			$vin = $reqVars['VIN'];
			$lossType = $reqVars['lossType'];
			$soldYear = $reqVars['soldyear'];
			$firstYear = $reqVars['firstyear'];
			$logging = $reqVars['logging'];
			$weight = $reqVars['weight'];
			$explanation = $reqVars['explanation'];	
			$date = date('Y-m-d h:i:s');
			$createdBy = $_SESSION['user_id'];
			
			$addSoldDestroyInfoResult = $solddestroycreditModel->addSoldDestroyInfo($businessId,$licenceNo,$userId,$filingId,$formType,$filingMonth,$vin,$lossType,$soldYear,$firstYear,$logging,$weight,$explanation,$date,$createdBy);
			
			if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$_SESSION['adminStatusMsg'] = $addSoldDestroyInfoResult;
				header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
			}else{
				$_SESSION['addSoldDestroyInfoResult'] = $addSoldDestroyInfoResult;
				header('location:/solddestroycredit/');
			}
			exit(0);
		}
		else if (isset($parsed[2]) && $parsed[2] == 'edit')
		{
			$template = 'editsolddestroycredit';
			$editSoldDestInfo = $solddestroycreditModel->editSoldDestroyInfo($businessId,$sldDtroyCrdId);
		}
		else if(isset($reqVars['updateSoldInfo']))
		{			
			$licenceNo	= $reqVars['lno'];			
			$sldDtroyCrdId  = decryptID($reqVars['sldDtroyCrdId']);
			$vin = $reqVars['VIN'];
			$lossType = $reqVars['lossType'];
			$soldYear = $reqVars['soldyear'];
			$firstYear = $reqVars['firstyear'];
			$logging = $reqVars['logging'];
			$weight = $reqVars['weight'];
			$explanation = $reqVars['explanation'];	
			$uploadDocumentName = $reqVars['UploadDocName'];
			$modifiedBy		= $_SESSION['user_id'];
							
			$updateSoldDestInfo = $solddestroycreditModel->updateSoldDestroyInfo($businessId, $licenceNo,$userId,$filingId,$sldDtroyCrdId,$vin,$lossType,$soldYear,$firstYear,$logging,$weight,$explanation,$uploadDocumentName,$modifiedBy);
			if($updateSoldDestInfo != 'Sold date should be future date')
			{
				
				if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
					$_SESSION['adminStatusMsg'] = $updateSoldDestInfo;
					header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
				}else{
					$_SESSION['updatemsg'] = $updateSoldDestInfo;
					header('location:/solddestroycredit/');
				}
				exit(0);
			}
		}
		
		if(isset($reqVars['uploadExcel']))
		{
			$uploadExcel = $solddestroycreditModel->uploadExcel($filingId);	
			$getcreditVehiInfo 	= $solddestroycreditModel->getSoldDestroyCreditInfo($userId,$filingId);	

			$_SESSION['uploadExcelMsg'] = $uploadExcel;
			header('location:/solddestroycredit/');
			exit(0);
		}
			
		$pendingFiling = $solddestroycreditModel->getPendingFiling($userId,$filingId);
		
		
		$SoldDestroyCreditInfo = $solddestroycreditModel->getSoldDestroyCreditInfo($userId,$filingId);
		$taxablevehicleinfoModel 	= new taxablevehicleinfo_Model;
		$getweight       			= $taxablevehicleinfoModel->getTaxweight();
		$tpl = new Template_Model($template);	
		$tpl->assign('userVehicles',$userVehicles);
		$tpl->assign('SoldDestroyCreditInfo',$SoldDestroyCreditInfo);
		if( isset( $editSoldDestInfo )):
			$tpl->assign('editSoldDestInfo',$editSoldDestInfo);
		endif;
		$tpl->assign('weightArr',$getweight);
		$tpl->assign('pendingFiling',$pendingFiling);
	}
}
?>