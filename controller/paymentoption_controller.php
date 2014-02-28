<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : paymentoption_controller.php
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

class Paymentoption_Controller
{
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}

//		if($_SESSION['formtype'] == "8849" || $_SESSION['IRStotalamount'] <= 0) 
//		{
//			header( 'Location: '.TT_SITE_NAME.'productpayment');
//			exit();		
//		}

		$filingid 				= $_SESSION['filingId'];
		
		if($_SESSION['formtype'] == "8849S1" || $_SESSION['formtype'] == "2290") 
		{
			$parsed = explode('/', $_SERVER["HTTP_REFERER"]);
			$taxablevehicleinfoDAO 	= new Taxablevehicleinfo_DAO;
			$taxablevehicleinfo 	= $taxablevehicleinfoDAO->getTaxVehiDetails($filingid,$_SESSION['user_id']);
			// If No taxable vehicles, then skip payment option page and redirect to summary page
			if(count($taxablevehicleinfo) != 0){
				goto endloop;
			}
			elseif($_SESSION['formtype'] == "2290" && $parsed[3] == "summary")
			{
				header( 'Location: '.TT_SITE_NAME.'lowmileagecredit');
				exit();
			}
			
			header( 'Location: '.TT_SITE_NAME.'summary');
			exit();
			endloop:		
		}
		
		$template = 'paymentoption'; 
		
		$paymentoptionModel =  new paymentoption_Model;
		
		if(isset($reqVars['savePaymentOption']))
		{
			$paymentMode = $reqVars['paymentMode'];
			if($paymentMode == "Direct Debit"){
				$bankName = $reqVars['bankName'];
				$accountType = $reqVars['accountType'];
				$acNumber = $reqVars['acNumber'];
				$rountingTransitNumber = $reqVars['rountingTransitNumber'];
			}else{
				$bankName = "";
				$accountType = "";
				$acNumber = "";
				$rountingTransitNumber = "";
			}
			$savePaymentOptionResult = $paymentoptionModel->savePaymentOptionInfo($filingid,$paymentMode,$bankName,$accountType,$acNumber,$rountingTransitNumber);
			header( 'Location: '.TT_SITE_NAME.'summary');
			exit();
		}
		
		$filingPaymentDetails  = $paymentoptionModel->getfilingPaymentDetails($filingid);
		
		// Passing the response data to UI template.
		$tpl = new Template_Model($template);
		$tpl->assign('filingPaymentDetails' , $filingPaymentDetails);	
		
	}
}