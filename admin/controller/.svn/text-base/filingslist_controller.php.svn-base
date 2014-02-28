<?php
class Filingslist_Controller
{	
	public $template = 'filingslist';
	public function main( array $reqVars )
	{	
		$filingslistModel = new filingslist_Model;
		
		$MCrypt	= new MCrypt;
		
		$request = $_SERVER['REQUEST_URI']; 
		$parsed = explode('/', $request);
		$userId = $MCrypt->decrypt($parsed[3]);
		
		$fromDate = '';
		$toDate = '';
		
		if(isset($reqVars['fromDate']) && isset($reqVars['toDate']))
		{
			$fromDate = $reqVars['fromDate'];
			$toDate = $reqVars['toDate'];
		}

		$getfilingListResult = $filingslistModel->getfilingList($fromDate,$toDate,$userId);
		
		$tpl = new Template_Model($this->template);		
		$tpl->assign('filingList',$getfilingListResult);
		
	}		
}
?>