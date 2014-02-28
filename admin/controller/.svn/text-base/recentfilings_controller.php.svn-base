<?php
class Recentfilings_Controller
{	
	public $template = 'recentfilings';
	
	public function main( array $reqVars )
	{
		$fromDate = date("Y-m-d");
		$toDate =  date("Y-m-d");
		
		if(isset($reqVars['fromDate']) && isset($reqVars['toDate']))
		{
			$fromDate = $reqVars['fromDate'];
			$toDate = $reqVars['toDate'];
		}
		
		$filingslistModel = new filingslist_Model;
		$recentfilingList = $filingslistModel->getRecentfilingList($fromDate,$toDate);
		
		$tpl = new Template_Model($this->template);	
		$tpl->assign('filinglist',$recentfilingList);
		$tpl->assign('fromdate',$fromDate);
		$tpl->assign('todate',$toDate);
	}		
}
?>