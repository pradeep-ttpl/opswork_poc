<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : paymentsuccess_controller.php
 * @version  : 1.0
 * @date  : 01-Aug-2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           01-Aug-2012           Initial Version - File Created
 * 
 */

class Paymentsuccess_Controller
{	
	public $template = 'paymentsuccess';
	
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
		
		$paymentsuccessModel 	= new Paymentsuccess_Model;
		
		$total_amount = $_SESSION['total_amount'];
		$form_type = $_SESSION['formtype'];
		$filingid = $_SESSION['filingId'];
		$transacdetails = array();
		$tansdetkey = array();
		$transdetvalue = array();
		
		if(isset($_POST['transdetailskey']))
		$tansdetkey = $_POST['transdetailskey'];
		
		if(isset($_POST['transdetailsvalue']))
		$transdetvalue = $_POST['transdetailsvalue'];

		for($i=0; $i <=count($tansdetkey); $i++)
		{
			$transacdetails[$tansdetkey[$i]] = $transdetvalue[$i];
		}
		
		if(isset($transacdetails['x_response_code'] ))
		{
			$paymentsuccess  = $paymentsuccessModel->checkTransactionDetails($transacdetails);
		}
		
		//$filingfee       = $paymentsuccessModel->getFilingfee();
		
		$last_trans_detail = $paymentsuccessModel->getLastTransaction($filingid);
		
		if(isset($transacdetails['x_response_code'] ) && $transacdetails['x_response_code'] != "1")
		{
			include_once(TT_CONTROLLER_PATH . '/productpayment_controller.php');
			$payment_controller = new Productpayment_Controller;
			$payment_controller->main($transacdetails);
			exit(0);
		}
		
		/*
		if($last_trans_detail['payment_status']!="success" && $form_type != '2290V'  && ( $_SESSION['finalReturn'] != 1 && $filingfee != 0))
		{
			echo $last_trans_detail['payment_status']." - ".$form_type." - ".$_SESSION['finalReturn']." - ".$filingfee; die;
			header('Location: /error/');
			exit();	
		}
		*/
		
		unset($_SESSION['discounts']);
		unset($_SESSION['discount_total']);
		unset($_SESSION['filing_fee']);
		unset($_SESSION['total_amount']);
		
		$tpl = new Template_Model($this->template);
		$tpl->assign('status',$paymentsuccess);
		$tpl->assign('amount_paid', $total_amount);
		$tpl->assign('form_type', $form_type);
		$tpl->assign('filing_id', $filingid);
		$tpl->assign('transacdetails', $transacdetails);
		$tpl->assign('last_trans', $last_trans_detail);
	}
}
?>