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

 class Tgwincreased_Controller
 {
 	
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
		
		
		
		$template = 'tgwincreased';  //set a template name to a variable
		
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
		
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		
		if(isset($_REQUEST['vehicleno']))
        $urlvin = decryptID($_REQUEST['vehicleno']);
		
		$tgwincreasedModel 	= new Tgwincreased_Model;
		$MCrypt	= new MCrypt;
		$taxablevehicleinfoModel 	= new taxablevehicleinfo_Model;
		
		$getweight    = $taxablevehicleinfoModel->getTaxweight();
		$userVehicles = $taxablevehicleinfoModel->getUserVehicles($userid);

		//Add section
		if(isset($reqVars['addtgwincreased']))
		{
			$licenceNo	= $reqVars['lno'];
			$vin 					= $reqVars['vin'];
			$loggingInfo 			= $reqVars['logging'];
			$previousWeightCategory = $reqVars['taxableWeight'];
			$changingWeightCategory = $reqVars['changingWeightCategory'];
			$createdDate 			= date("Y-m-d h:i:s");
			$createdBy 				= $_SESSION['user_id'];
			
			$addTGWincrease 		= $tgwincreasedModel->addTaxableGrossWeightIncrease($businessId, $licenceNo,$vin,$loggingInfo,$previousWeightCategory,$changingWeightCategory,$filingId,$filingYear,$createdDate,$createdBy);
			
			if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$_SESSION['adminStatusMsg'] = $addTGWincrease;
				header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
			}else{
				$_SESSION['addTGWincrease'] = $addTGWincrease;
				header( 'Location: '.TT_SITE_NAME.'tgwincreased');
			}
			exit(0);
		}
		
		if(isset($parsed[2]) && $parsed[2] =='add')
		{
			$monthList = $tgwincreasedModel->getMonthList('add','',$filingYear);
			$template = 'addtgwincreased';
		}
		
		if(isset($parsed[2]) && $parsed[2] =='edit')
		{
			$template = 'edittgwincreased';
			
			$TaxableId = decryptID($reqVars['TaxableId']);
			$editTGWIncreasedInfo = $tgwincreasedModel->editTGWIncreasedDetails($TaxableId,$selectedBusiness);
			$monthList = $tgwincreasedModel->getMonthList('edit',$editTGWIncreasedInfo['changed_month'],$filingYear);
		}
		
		if(isset($reqVars['updatetgwincreased']))
		{
			$licenceNo	= $reqVars['lno'];
			$vin 			= $reqVars['vin'];	
			$loggingInfo 	= $reqVars['logging'];
			$TaxableId 		= decryptID($reqVars['TaxableId']);
			$modifiedBy 	= $_SESSION['user_id'];
			$previousWeightCategory = $reqVars['taxableWeight'];
			$changingWeightCategory = $reqVars['changingWeightCategory'];
			
			$updatetgwincreased = $tgwincreasedModel->updateTGWITaxVehiInfo($businessId, $licenceNo,$vin,$previousWeightCategory,$changingWeightCategory,$loggingInfo,$TaxableId,$filingId,$filingYear,$filingMonth,$modifiedBy);
			
			if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$_SESSION['adminStatusMsg'] = $updatetgwincreased;
				header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
			}else{
				$_SESSION['updatetgwincreased'] = $updatetgwincreased;
				header("location:/tgwincreased/");
			}
			exit(0);
		}
		
		//Edit section
		$ResulteditTaxFilingVehiInfo = '';
		$getTGWIncreasedInfo = $tgwincreasedModel->getTGWIncreaseInfo($userid,$filingId);
		
		$tpl = new Template_Model($template);	
		$tpl->assign('Taxweights',$getweight);
		$tpl->assign('userVehicles',$userVehicles);
		$tpl->assign('getTGWIncreasedInfo',$getTGWIncreasedInfo);
		if(isset($addTGWincrease))
		{
			$tpl->assign('addTGWincrease',$addTGWincrease);
		}
		if(isset($editTGWIncreasedInfo))
		{
			$tpl->assign('editTGWIncreasedInfo',$editTGWIncreasedInfo);
		}
		if(isset($monthList))
		{
			$tpl->assign('monthList',$monthList);
		}		
	}
 }
?>