<?php
class diagnose_DAO
{
	public function __construct()
	{	
	
	}

	//To get Payment Log details
	public function getdiagnoseList($filingId)
	{
		global $DBH;
		$diagnoseList = array();
	   	
//		$sql = "SELECT ut.voucher_no,ut.transaction_id,ut.payment_method,ut.payment_gateway,ut.modified_date,
//				ut.payment_status,ub.name,fi.id as filingId,fi.form_type,CONCAT(us.first_name, ' ', us.last_name) as fullName,
//				ut.user_id
//				FROM `tt_user_transactions` ut
//				JOIN `tt_filings` fi ON ( ut.filing_id = fi.id )
//				JOIN `tt_users` us ON ( ut.user_id = us.id )
//				JOIN `tt_user_business` ub ON ( fi.biz_id = ub.id )
//				WHERE ut.filing_id = ?";
		
		$sql = "SELECT ut.voucher_no,ut.transaction_id,ut.payment_method,ut.payment_gateway,ut.modified_date,ut.payment_status,
				fi.id as filingId,fi.form_type,fi.xml_submitted,fi.date_user_submitted,fi.date_xml_sent,
				fi.date_last_ack_attempt,fi.date_acknowledged,
				fi.irs_approved,fi.ack_received,fi.sch1_received,fi.user_completed,
				us.first_name,us.last_name,ut.user_id,ub.name
				FROM `tt_filings` fi
				LEFT JOIN `tt_user_transactions` ut ON (fi.id = ut.filing_id)
				JOIN `tt_users` us ON ( fi.user_id = us.id )
				JOIN `tt_user_business` ub ON ( fi.biz_id = ub.id )
				WHERE fi.id = ?";
		
		$res = $DBH->prepare($sql);
		$res->execute(array($filingId));
		$res->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $res->fetch())
		{
			$diagnoseList[] = $row;
		}
		return $diagnoseList;
	}
	
	//To get Submisstion Log details
	public function getsubmissionList($filingId)
	{
		global $DBH;
		$submissionList = array();
	   	
		$sql = "SELECT * from tt_filing_submissions_logging where filing_id = ?";
	   	
		$res = $DBH->prepare($sql);
		$res->execute(array($filingId));
		$res->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $res->fetch())
		{
			$submissionList[] = $row;
		}
		return $submissionList;
	}
	
	//To insert Payment details manually
	
	public function insertPaymentDetails($paymentstatus,$transactionId,$userId,$filingId)
	{
		global $DBH;
		$createdDate = date("Y-m-d h:i:s");
		
		$insertPaymentDet = "INSERT INTO `tt_user_transactions`(`filing_id`,`transaction_id`,`payment_gateway`,
							 `payment_status`,`modified_date`,`modified_by`,`active`) 
						   	  VALUES (?,?,?,?,?,?,?)";		
				
		$prepareInsertPaymentInfo = $DBH->prepare($insertPaymentDet);
		$prepareInsertPaymentInfo->execute(array($filingId,$transactionId,'Manual',$paymentstatus,$createdDate,$userId,'1'));
		
		if($prepareInsertPaymentInfo)
		{
			$status = 'inserted';
		}
		else
		{
			$status = 'not_inserted';
		}
		
		return $status;
	}
}
?>