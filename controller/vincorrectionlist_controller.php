<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename 	: vincorrectionlist_controller.php
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

class Vincorrectionlist_Controller
{
	public $template = 'vincorrectionlist';

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
		
		
		
		$vinCorrectionModel = new Vincorrection_Model;

		$submittedFilingList = $vinCorrectionModel->getSubmittedFilingList($userId,$filingYear,$businessId,$MCrypt->encrypt($filingMonth));

		if(isset($_SESSION['selectedFIdForVin'])){
			header( 'Location: '.TT_SITE_NAME.'vincorrection/'.$_SESSION['selectedFIdForVin']);
			exit(0); 
		}		
		if(count($submittedFilingList) == 0){
			
			$_SESSION['addVINCorrection'] = $addVinCorrection;
			header( 'Location: '.TT_SITE_NAME.'vincorrection/new');
			exit(0);
			
		}
		
		$tpl = new Template_Model($this->template);
		$tpl->assign('submittedFilingList',$submittedFilingList);
	}
}
?>