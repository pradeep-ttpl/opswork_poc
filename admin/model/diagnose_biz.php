<?php
class Diagnose_Model
{		
	public function __construct()
	{		
		//diagnose DAO
		$diagnoseDAO = new Diagnose_DAO;
		$this->diagnoseDAO = $diagnoseDAO;
		
	}
	
	public function getdiagnoseList($filingId)
	{
		$getdiagnoseList = $this->diagnoseDAO->getdiagnoseList($filingId);		
		return $getdiagnoseList;
	}
	
	public function getsubmissionList($filingId)
	{
		$getsubmissionList = $this->diagnoseDAO->getsubmissionList($filingId);		
		return $getsubmissionList;
	}
	
	public function insertPaymentDetails($paymentstatus,$transactionId,$userId,$filingId)
	{
		$insertPaymentDetails = $this->diagnoseDAO->insertPaymentDetails($paymentstatus,$transactionId,$userId,$filingId);
		
		if($insertPaymentDetails=='inserted')
		{
			$message = 'Payment details successfuly updated';
		}
		else if($insertPaymentDetails == 'not_inserted')
		{
			$message = 'Payment details not updated';
		}
//		else if($insertPaymentDetails == 'already_exists')
//		{
//			$message = 'Payment details already exists';
//		}
		
		return $message;
		
	}
}
?>