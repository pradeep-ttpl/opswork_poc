<?php
class Paymenthistory_Model
{		
	public function __construct()
	{		
		//payment history DAO
		$paymenthistoryDAO = new Paymenthistory_DAO;
		$this->paymenthistoryDAO = $paymenthistoryDAO;
		
	}
	
	public function getpaymenthistoryList($fromDate,$toDate)
	{
		$getpaymenthistoryList = $this->paymenthistoryDAO->getpaymenthistoryList($fromDate,$toDate);		
		return $getpaymenthistoryList;
	}
	
}
?>