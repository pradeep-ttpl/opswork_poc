<?php
class paymenthistory_DAO
{
	public function __construct()
	{	
	
	}

	//To get Payment history details
	public function getpaymenthistoryList($fromDate,$toDate)
	{
		global $DBH;
		$paymentList = array();
		
		$sql = "SELECT modified_date,voucher_no,transaction_id,payment_gateway,amount,payment_status
				from `tt_user_transactions`";
		
		if($fromDate != '' && $toDate != ''){
		 	$sql .= " WHERE DATE(modified_date) BETWEEN ? AND ?";
		}
	   	
		$sql .= " GROUP BY filing_id ORDER BY filing_id DESC";
		
		$res = $DBH->prepare($sql);
				
		if($fromDate != '' && $toDate != ''){
			$res->execute(array($fromDate,$toDate));
		}else{
			$res->execute(array());
		}
				
		$res->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $res->fetch())
		{
			$paymentList[] = $row;
		}
		return $paymentList;
	}
	
}
?>