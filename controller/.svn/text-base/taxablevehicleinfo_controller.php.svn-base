<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : taxablevehicleinfo_controller.php
 * @version  : 1.0
 * @date  : 16-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila                 16-Jul-2012           Initial Version - File Created
 * 
 */

 class Taxablevehicleinfo_Controller
 {
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
		
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
			
		//set a template name to a variable
		$template = 'taxablevehicleinfo';
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		
		$taxablevehicleinfoModel 	= new taxablevehicleinfo_Model;
		$MCrypt	= new MCrypt;
		
		$getweight    = $taxablevehicleinfoModel->getTaxweight();
		$userVehicles = $taxablevehicleinfoModel->getUserVehicles($userId);
		if(isset($parsed[2]) && $parsed[2] == 'add')
		{
			$template = 'addtaxablevehicleinfo'; 
		}
		
		if(isset($reqVars['addtaxablevehiInfo']))
		{
			$licenceNo			= $reqVars['lno'];
			$vin 				= $reqVars['vin'];
			$loggingInfo 		= $reqVars['logging'];
			$taxableGrossweight = $reqVars['taxableWeight'];
			$createdBy 			= $_SESSION['user_id'];
			
			global $taxmonthAry;
			// Change month from integer to string / month name
			$monthName = date("F", mktime(0, 0, 0, $filingMonth, 10)); 
			// Get remaining month for calculation
			$filingMonthId = $taxmonthAry[$monthName];
			
			$addTaxVehiInfo = $taxablevehicleinfoModel->addTaxbleVehicle($businessId,$licenceNo,$vin,$loggingInfo,$taxableGrossweight,$filingYear,$filingMonthId,$filingId,$createdBy);
			
			if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$_SESSION['adminStatusMsg'] = $addTaxVehiInfo;
				header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
			}else{
				$_SESSION['addTaxVehiInfo'] = $addTaxVehiInfo;
				header('location:/taxablevehicleinfo/');
			}
			exit(0);
		}
		$ResulteditTaxFilingVehiInfo = '';
		$getTaxVehiInfo = $taxablevehicleinfoModel->getTaxVehiInfo($filingId,$userId);
			
		if(isset($parsed[2]) && $parsed[2]=='edit' )
		{
			$template = 'edittaxablevehicleinfo';
			$TaxableId = decryptID($reqVars['TaxableId']);
			$ResulteditTaxFilingVehiInfo = $taxablevehicleinfoModel->editTaxFilingVehiDetails($TaxableId);
		}
		
		if(isset($reqVars['updatetaxablevehiInfo']))
		{
			$licenceNo			= $reqVars['lno'];
			$vin 				= $reqVars['vin'];	
			$taxableGrossweight = $reqVars['taxableWeight'];
			$loggingInfo 		= $reqVars['logging'];
			$TaxableId 			= decryptID($_REQUEST['TaxableId']);
			$modifiedBy			= $_SESSION['user_id'];
			
			global $taxmonthAry;
			// Change month from integer to string / month name
			$monthName = date("F", mktime(0, 0, 0, $filingMonth, 10)); 
			// Get remaining month for calculation
			$filingMonthId = $taxmonthAry[$monthName];
			
			$updateTaxVehiInfo = $taxablevehicleinfoModel->updateTaxVehiInfo($businessId,$licenceNo,$vin,$taxableGrossweight,$loggingInfo,$TaxableId,$filingYear,$filingMonthId,$filingId,$modifiedBy);
			
			if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$_SESSION['adminStatusMsg'] = $updateTaxVehiInfo;
				header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
			}else{
				$_SESSION['updateTaxVehiInfo'] = $updateTaxVehiInfo;	
				header("location:/taxablevehicleinfo/");
			}
			exit(0);
		}
		
		if(isset($reqVars['uploadExcel']))
		{
			global $taxmonthAry;
			$filingMonthId 	= $taxmonthAry[end(explode(' ',$filingMonth))];	
			
			$uploadExcel 	= $taxablevehicleinfoModel->uploadExcel($filingMonthId,$filingYear,$filingId);
			$getTaxVehiInfo = $taxablevehicleinfoModel->getTaxVehiInfo($filingId,$userId);			
		}
		
		$tpl = new Template_Model($template);	
		$tpl->assign('Taxweights',$getweight);
		$tpl->assign('userVehicles',$userVehicles);
		$tpl->assign('getTaxVehiInfo',$getTaxVehiInfo);
		$tpl->assign('editTaxVehiInfo',$ResulteditTaxFilingVehiInfo);
		if(isset($uploadExcel))
		{
			$tpl->assign('uploadExcelMsg',$uploadExcel);
		}
	}
 }
?>