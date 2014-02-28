<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : paymentoption_entity.php
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
 * Akila         		 18-Aug-2012           Initial Version - File Created
 * 
 */

class Paymentoption_DAO
{		
	public function __construct()
	{	
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
	}
	public function savePaymentOptionInfo($filingid,$paymentMode,$bankName,$accountType,$acNumber,$rountingTransitNumber)
	{
		$payMode = $this->MCrypt->decrypt($paymentMode);
		global $DBH;
		$date = date('Y-m-d H:i:s');
		
		$chkpaymentDetails = 'SELECT * FROM `tt_filing_payment` WHERE `filing_id` = ? AND `active` =1';
		$preparepaymentDetails = $DBH->prepare($chkpaymentDetails);
		$preparepaymentDetails->execute(array($filingid));	
		$count = $preparepaymentDetails->rowCount();	
		
		if($count == 0)
		{	
			$sql = "INSERT INTO `tt_filing_payment`(`filing_id`,`payment_mode`,`bank_name`,`acct_type`,`acct_number`,`routing_transit_no`,`user_acceptance`,`active`,`created_date`)
					VALUES(?,?,?,?,?,?,?,?,?)";
			
			$prepareInsertBiz = $DBH->prepare($sql);
			$prepareInsertBiz->execute(array($filingid,$paymentMode,$bankName,$accountType,$acNumber,$rountingTransitNumber,'1','1',$date));
		}
		else 
		{	
			$updatepaymentInfo = "Update `tt_filing_payment` set `payment_mode` = ?,`bank_name` = ?,`acct_type` = ?,`acct_number` = ?, 
								 `routing_transit_no` = ? WHERE filing_id = ?";	
			$prepareupdatepaymentinfo = $DBH->prepare($updatepaymentInfo);
			
			//To check condition for Direct Debit 
			if($this->MCrypt->decrypt($paymentMode) == "Direct Debit")
			{	
				$prepareupdatepaymentinfo->execute(array($paymentMode,$bankName,$accountType,$acNumber,$rountingTransitNumber,$filingid));
			}
			else
			{	
				$prepareupdatepaymentinfo->execute(array($paymentMode,'','','','',$filingid));
			}

		}
		
	}
	
	public function getfilingPaymentDetails($filingid)
	{
		global $DBH;
		$results = array();	
		$sql = 'SELECT * from tt_filing_payment where filing_id = ? AND `active` = 1';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($filingid));		
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		$results = $preparesql->fetch();		
		return $results;
	}
}
?>