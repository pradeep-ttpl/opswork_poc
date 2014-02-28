<?php
class Paymenttransaction_Controller
{	
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
		
		$template 		  = 'paymenttransaction';
		
		$paymenttransactionModel 	= new Paymenttransaction_Model;

		$userId = $_SESSION['user_id'];
		
		$paymentDetails = $paymenttransactionModel->getpaymenthistoryList($userId);
		
		$tpl = new Template_Model($template);	
		
		if(isset($paymentDetails))
		{
			$tpl->assign('paymentDetails',$paymentDetails);
		}
		
	}		
}
?>