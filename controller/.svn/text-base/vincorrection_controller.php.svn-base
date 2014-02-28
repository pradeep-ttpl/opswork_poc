<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename 	: vincorrection_controller.php
 * @version  	: 1.0
 * @date  	 	: Feb 3, 2014
 *
 * @description :
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        Feb 3, 2014           Initial Version - File Created
 * 
 */

class Vincorrection_Controller
{
	public $template = 'vincorrection';

	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		
		$vinCorrectionModel = new Vincorrection_Model;
		$taxablevehicleinfoModel 	= new taxablevehicleinfo_Model;
		$MCrypt	= new MCrypt;
		
		
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

		$getweight  = $taxablevehicleinfoModel->getTaxweight();
		
		$selectedFilingId = '';
		
		if(count($reqVars) == 0 || (isset($parsed[2]) && $parsed[2] =='new')) $reqVars['selectedFilingId'] = $MCrypt->encrypt('new');

		if(isset($parsed[2]) && $MCrypt->decrypt($parsed[2]) != 'new' && $MCrypt->decrypt($parsed[2]) != 'edit'){
			
			$filingId = $selectedFilingId = $MCrypt->decrypt($parsed[2]);
			
		}elseif(isset($reqVars['selectedFilingId'])){
			
			if($MCrypt->decrypt($reqVars['selectedFilingId']) == 'new'){
				$filingId = $_SESSION['filingId'];
				$selectedFilingId = 'new';
			}else{
				$filingId = $selectedFilingId = $MCrypt->decrypt($reqVars['selectedFilingId']);

				if(isset($_SESSION['selectedFIdForVin'])){ unset($_SESSION['selectedFIdForVin']);}
				$_SESSION['selectedFIdForVin'] = $MCrypt->encrypt($selectedFilingId);	
			}
			
		}else{
			
			if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$filingId = $_SESSION['admin_filing_id'];
			}else{
				$filingId = $_SESSION['filingId'];
			}
			
		}

	 	if($selectedFilingId == 'new' || $selectedFilingId != '' || (isset($parsed[2]) && $parsed[2] =='new')){

		 	if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$filingId = $_SESSION['admin_filing_id'];
			}else{
				$filingId = $_SESSION['filingId'];
			}
			
	 		if($selectedFilingId == 'new'  || (isset($parsed[2]) && $parsed[2] =='new'))
	 		{
	 			$vinCorrectionlist  = $vinCorrectionModel->getAllNewCorrectingVIN($userId,$filingId,'new');
	 		}else{
	 			$vinCorrectionlist  = $vinCorrectionModel->getAllNewCorrectingVIN($userId,$filingId,'');
	 		}
		}
		if(isset($parsed[2]) && $parsed[2] =='edit')
		{
			$filingId = '';
			if(isset($parsed[3])){
				$filingId = $MCrypt->decrypt($parsed[3]);					
			}
		}

		if(isset($_SESSION['admin_filing_year']) && $_SESSION['admin_filing_year'] > 0){
			$filingYear = $_SESSION['admin_filing_year'];
		}else{
			$filingYear = $_SESSION['filingYear'];
		}
		
		if(isset($_SESSION['admin_biz_id']) && $_SESSION['admin_biz_id'] > 0){
			$businessId = $_SESSION['admin_biz_id'];
		}else{
			$businessId = $_SESSION['selectedbusiness'];
		}

		if(isset($_SESSION['admin_filing_month']) && $_SESSION['admin_filing_month'] > 0){
			$filingMonth = $_SESSION['admin_filing_month'];
		}else{
			$filingMonth = $_SESSION['filingMonth'];
		}
			
		//echo $userId.' - '.$filingYear.' - '.$businessId.' - '.$MCrypt->encrypt($filingMonth);
		
		$submittedFilingList = $vinCorrectionModel->getSubmittedFilingList($userId,$filingYear,$businessId,$MCrypt->encrypt($filingMonth));
		
		//Add section
		if(isset($reqVars['addvincorrection']))
		{
			$previn					= $reqVars['previn'];
			$vin 					= $reqVars['vin'];
			$vinCorrectionType		= $reqVars['vinCorrectionType'];
			$grossWeightCategory	= $reqVars['grossWeightCategory'];
			$createdDate 			= date("Y-m-d h:i:s");
			$createdBy 				= $_SESSION['user_id'];
			$filingId				= $_SESSION['filingId'];
			$logging				= $reqVars['logging'];
			
			$addVinCorrection 		= $vinCorrectionModel->addVinCorrection($filingId,$previn,$vin,$vinCorrectionType,$MCrypt->encrypt($grossWeightCategory),$MCrypt->encrypt($logging),$createdDate,$createdBy);
			
			if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$_SESSION['adminStatusMsg'] = $addVinCorrection;
				header("location:/vincorrection/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
			}else{
				$_SESSION['addVINCorrection'] = $addVinCorrection;
				header( 'Location: '.TT_SITE_NAME.'vincorrection/new');
			}
			exit(0);
		}
		//Add section
		if(isset($reqVars['editvincorrection']))
		{
			$previn					= $reqVars['previn'];
			$vin 					= $reqVars['vin'];
			$vinCorrectionType		= $reqVars['vinCorrectionType'];
			$grossWeightCategory	= $reqVars['grossweightlblvalue'];
			$modifiedDate 			= date("Y-m-d h:i:s");
			$modifiedBy 			= $_SESSION['user_id'];
			$selectedFilingId		= $reqVars['selectedFilingId'];
			$filingId				= $_SESSION['filingId'];
			$logging				= $reqVars['logging'];
			
			$updateVinCorrection 		= $vinCorrectionModel->updateVinCorrection($filingId,$previn,$vin,$vinCorrectionType,$MCrypt->encrypt($grossWeightCategory),$MCrypt->encrypt($logging),$modifiedDate,$modifiedBy);
			
			if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$_SESSION['adminStatusMsg'] = $updateVinCorrection;
				header("location:/vincorrection/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
			}else{
				$_SESSION['updateVinCorrection'] = $updateVinCorrection;
				if(isset($_SESSION['selectedFIdForVin'])){ unset($_SESSION['selectedFIdForVin']);}
				$_SESSION['selectedFIdForVin'] = $MCrypt->encrypt($selectedFilingId);
				header( 'Location: '.TT_SITE_NAME.'vincorrection/'.$MCrypt->encrypt($selectedFilingId));
			}
			exit(0);
		}
		if(isset($parsed[2]) && $parsed[2] =='add')
		{
			$this->template = 'addvincorrection';
		}
		if(isset($parsed[2]) && $parsed[2] =='edit')
		{
			if(isset($parsed[3])){
				$filingId = $MCrypt->decrypt($parsed[3]);
				$selectedFilingId = $MCrypt->decrypt($parsed[3]);
									
			}
			$alreadyFiledVINs = $vinCorrectionModel->getAlreadyFiledVINs($filingId,$businessId);
			$this->template = 'editvincorrection';
		}
		
		$tpl = new Template_Model($this->template);
		$tpl->assign('vinCorrectionlist',$vinCorrectionlist);
		$tpl->assign('taxweights',$getweight);
		$tpl->assign('filingId',$filingId);
		$tpl->assign('selectedFilingId',$selectedFilingId);
		$tpl->assign('submittedFilingList',$submittedFilingList);		
		if(isset($alreadyFiledVINs)){
			$tpl->assign('alreadyFiledVINs',$alreadyFiledVINs);
		}
		
	}
}
?>