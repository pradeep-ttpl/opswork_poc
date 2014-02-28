<?php
class Submissionlist_Controller
{	
	public $template = 'submissionlist';
	
	public function main( array $reqVars )
	{	
		$submissionlistModel = new submissionlist_Model;
		
		$MCrypt	= new MCrypt;
		
		$fromDate = '';
		$toDate = '';
		
		if(isset($reqVars['fromDate']) && isset($reqVars['toDate']))
		{
			$fromDate = $reqVars['fromDate'];
			$toDate = $reqVars['toDate'];
		}
		
		//To get List of Submissions.
		$getsubmissionListResult = $submissionlistModel->getSubmissionList($fromDate,$toDate);
		
		$tpl = new Template_Model($this->template);	
			
		$tpl->assign('submissionList',$getsubmissionListResult);
		
	}		
}
?>