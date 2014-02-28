<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : paymentsuccess_biz.php
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

class Paymentsuccess_Model
{		
	public function __construct()
	{		
		// taxPayerBusiness DAO
		$paymentsuccessDAO = new Paymentsuccess_DAO;
		$this->paymentsuccessDAO = $paymentsuccessDAO;
	}
	public function checkTransactionDetails($transacdetails)
	{
		$filingId = $_SESSION['filingId'];
		$user_id = $_SESSION['user_id'];
				
		if(isset($transacdetails['x_response_code'] ) && $transacdetails['x_response_code'] == "1")
		{
			// payment success
			$completed = 1;
			$status = 'success';
			
			$result = $this->paymentsuccessDAO->updateTransactionDetails($user_id, $filingId, $transacdetails['x_invoice_num'], $transacdetails['x_trans_id'], $transacdetails['x_method'], $transacdetails['x_card_type'], $transacdetails['x_account_number'], $transacdetails['x_amount'], "success");
			
			$result = $this->paymentsuccessDAO->updateFilingDetails($filingId,$status,$transacdetails['x_trans_id']);

			$result = "Payment success";
		}
		else
		{
			// payment failed
			$completed = 0;
			$status = 'failed';
						
			$result = $this->paymentsuccessDAO->updateTransactionDetails($user_id, $filingId, $transacdetails['x_invoice_num'], $transacdetails['x_trans_id'], $transacdetails['x_method'], $transacdetails['x_card_type'], $transacdetails['x_account_number'], $transacdetails['x_amount'], "failed");
			
			$result = "Transaction Declained - ";
			$result .= $transacdetails['x_response_reason_text'];
				
			$updateFiling = $this->paymentsuccessDAO->updateFilingDetails($filingId,$status,$transacdetails['x_trans_id']);
			
		}
		
		return $result;
	}
	
	//get filing fee from tt_fee_plan_master table
	public function getFilingfee()
	{
		$result = $this->paymentsuccessDAO->getFilingfee();
		return $result;			
	}

	// get payment details of last transaction	
	public function getLastTransaction($filingid)
	{
		$result = $this->paymentsuccessDAO->getLastTransaction($filingid);
		return $result;			
	}
}
?>