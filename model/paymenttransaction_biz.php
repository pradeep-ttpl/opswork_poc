<?php 
class Paymenttransaction_Model
{		
	public function __construct()
	{		
		$paymenttransactionDAO = new Paymenttransaction_DAO;
		$this->paymenttransactionDAO = $paymenttransactionDAO;
	}

	public function getpaymenthistoryList($userId)
	{
		$getpaymenthistoryList = $this->paymenttransactionDAO->getpaymenthistoryList($userId);		
		return $getpaymenthistoryList;
	}
}
?>