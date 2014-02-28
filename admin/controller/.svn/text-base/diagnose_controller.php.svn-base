<?php
class Diagnose_Controller
{	
	public function main( array $reqVars )
	{	
		
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		$userId = $_SESSION['user_id'];
		
		$template = 'diagnose';
		
		$diagnoseModel = new diagnose_Model;
		
		$filingId = $_REQUEST['filingId'];
		
		$getdiagnoseListResult = $diagnoseModel->getdiagnoseList($filingId);
		$getsubmissionListResult = $diagnoseModel->getsubmissionList($filingId);
		
		if(isset($parsed[3]) && $parsed[3] == 'add')
		{
			$template = 'editpaymentstatus'; 
		}
		
		if(isset($reqVars['submitPaymentStatus']))
		{
			$paymentstatus 		= $reqVars['paymentstatus'];
			$transactionId 		= $reqVars['transactionId'];
			
			//To insert Payment details manually
			$paymentInfo = $diagnoseModel->insertPaymentDetails($paymentstatus,$transactionId,$userId,$filingId);
			
			$_SESSION['paymentInfo'] = $paymentInfo;
			header('location:/admin/diagnose/?filingId='.$filingId);
			exit(0);
			
		}
		
		$tpl = new Template_Model($template);		
		
		$tpl->assign('diagnoseList',$getdiagnoseListResult);
		$tpl->assign('submissionList',$getsubmissionListResult);
		
	}		
}
?>