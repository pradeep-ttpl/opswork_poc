<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : summaryreview_controller.php
 * @version  : 1.0
 * @date  : 26-Jul-2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           26-Jul-2012           Initial Version - File Created
 * 
 */

class Summaryreview_Controller
{	
	public $template = 'summaryreview';
	
	public function main( array $reqVars )
	{	
		if(!isset($_SESSION['user_id']))
		{
			header( 'Location: '.TT_SITE_NAME.'login');
			exit();
		}
		
		//Creating object for Summaryreview_Model class
		$Summaryreview_Model = new  Summaryreview_Model;
		
		// check consent to disclosure
		$consentStatus = $Summaryreview_Model->checkConsentDisclosure();
		
		if($consentStatus['consent_disclosure'] == "0" || empty($consentStatus['consent_disclosure']))
		{
			header( 'Location: '.TT_SITE_NAME.'consentdisclosure');
			exit();
		}
		
		if(isset($reqVars['totaltax']) && isset($reqVars['totalcredit']))
		{
			$totaltax = $reqVars['totaltax'];
			$totalcredit = $reqVars['totalcredit'];
			$_SESSION['totaltax'] = $totaltax ;
			$_SESSION['totalcredit'] = $totalcredit;
		}
		else
		{
			$totaltax = $_SESSION['totaltax'];
			$totalcredit = $_SESSION['totalcredit'];
		}

		
		// Calculate tax amount need to be paid
		//if(($totaltax - $totalcredit) > 0)
		$total_amount_gross = $totaltax;
		//else
		//$total_amount_gross = 0;
		
		//get filing fee
		$filingfee      = $Summaryreview_Model->getfilingfee();
		$filingcharge 	= $filingfee['fee'];
		
		// Filing charge include
		// $total_amount = $total_amount_gross + $filingcharge;
		$total_amount = $total_amount_gross - $totalcredit;
		
		$_SESSION['IRStotalamount'] = $total_amount;
	
		
		$tpl = new Template_Model($this->template);
		$tpl->assign('fingerprint',$fingerprint);
		$tpl->assign('invoice_no',$invoice_no);
		$tpl->assign('sequence',$sequence);
		$tpl->assign('timeStamp',$timeStamp);
		$tpl->assign('total_amount',$total_amount);
		$tpl->assign('totalcredit',$totalcredit);
		$tpl->assign('totaltax',$totaltax);
		$tpl->assign('total_amount_gross',$total_amount_gross);
		$tpl->assign('filingfee',$filingcharge);
	}		
}

?>