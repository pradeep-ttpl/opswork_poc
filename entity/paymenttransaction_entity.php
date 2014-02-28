<?php 
class Paymenttransaction_DAO
{
	public function __construct()
	{	
	
	}
	
	public function getpaymenthistoryList($userId)
	{
		global $DBH;
		$paymentList = array();
		
		$sql = "SELECT ut.modified_date,ut.voucher_no,ut.transaction_id,ut.payment_gateway,ut.amount,
				ut.payment_status,tf.form_type,fo.desc
				FROM `tt_user_transactions` ut
				JOIN `tt_filings` tf ON (ut.filing_id = tf.id)
				JOIN `tt_forms` fo ON (tf.form_type = fo.type)
				WHERE ut.payment_status = ? AND ut.user_id = ? AND ut.active = ?";
		
		$res = $DBH->prepare($sql);
				
		$res->execute(array('success',$userId,'1'));
				
		$res->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $res->fetch())
		{
			$paymentList[] = $row;
		}
		return $paymentList;
	}
}
?>