<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : paymentsuccess_entity.php
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

class Paymentsuccess_DAO
{		
	public function __construct()
	{	
		
	}	
	public function updateFilingDetails($filingId,$status,$transactionId)
	{
		global $DBH;
		$sql		= "UPDATE `tt_filings` SET  `payment_status` = ?, `transaction_id` = ? WHERE  `id` = ?  AND active = 1";
		$preparesql	= $DBH->prepare($sql);
		$preparesql->execute(array($status,$transactionId,$filingId));
		return true;
	}
	
	// update transaction details
	public function updateTransactionDetails($user_id, $filingId, $invoice_no, $trans_id, $payment_method, $card_type, $acc_no, $amount, $status)
	{
		global $DBH;
		$date = date('Y-m-d h:i:s');
		/*$sql = "INSERT INTO `tt_user_transactions` (`id`, `user_id`, `filing_id`, `voucher_no`, `transaction_id`, `payment_method`, `card_type`, `account_number`, `amount`, `transaction_date`, `payment_status`,`active`) 
		VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP, ?,?)";
		$preparesql	= $DBH->prepare($sql);
		$preparesql->execute(array($user_id, $filingId, $invoice_no, $trans_id, $payment_method, $card_type, $acc_no, $amount, $status,'1'));*/
		
		$sql = 'UPDATE `tt_user_transactions` SET  `transaction_id` = ?, `payment_method` = ?, `card_type` = ?, `account_number` =?,
				`payment_status`  =? , `modified_date` = ?, `modified_by` = ? 
				WHERE `filing_id` = ? AND `voucher_no` = ?';
		$preparesql	= $DBH->prepare($sql);
		$preparesql->execute(array($trans_id, $payment_method, $card_type, $acc_no,$status,$date,$_SESSION['user_id'],$filingId, $invoice_no));
		return true;		
	}
	
	//get filing fee from tt_fee_plan_master table
	public function getFilingfee()
	{
		global $DBH;
		$date = date('Y-m-d');
		$result = array();
		$sql = "SELECT fee, wef FROM tt_fee_plan_master WHERE wef IN ( SELECT max( wef ) FROM tt_fee_plan_master WHERE wef <= '$date') AND active = ?";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array('1'));
		$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql ->fetch();
		
		return $result;
	}

	// get payment details of last transaction
	public function getLastTransaction($filingid)
	{
		global $DBH;
		$result = array();
		$sql = "SELECT * FROM  `tt_user_transactions` WHERE  `transaction_date` = ( SELECT MAX(  `transaction_date` ) FROM  `tt_user_transactions` WHERE  `filing_id` = ? ) AND `active` = 1";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($filingid));
		$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql ->fetch();
		
		return $result;
	}
}
?>