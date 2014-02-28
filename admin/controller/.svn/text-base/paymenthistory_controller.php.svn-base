<?php
class Paymenthistory_Controller
{	
	public function main( array $reqVars )
	{	
		$template = 'paymenthistory';
		
		$paymenthistoryModel = new paymenthistory_Model;
		
		$fromDate = '';
		$toDate = '';
		
		if(isset($reqVars['fromDate']) && isset($reqVars['toDate']))
		{
			$fromDate = $reqVars['fromDate'];
			$toDate = $reqVars['toDate'];
		}
		
		$paymenthistoryList = $paymenthistoryModel->getpaymenthistoryList($fromDate,$toDate);
		
		$tpl = new Template_Model($template);		
		
		$tpl->assign('paymenthistoryList',$paymenthistoryList);
		
	}		
}
?>