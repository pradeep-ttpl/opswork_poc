<?php
class Submissionlist_Model
{		
	public function __construct()
	{		
		// filing DAO
		$filingslistDAO = new Filingslist_DAO;
		$this->filingslistDAO = $filingslistDAO;
		
	}
	
	public function getSubmissionList($fromDate,$toDate)
	{
		$getSubmissionList = $this->filingslistDAO->getSubmissionList($fromDate,$toDate);		
		return $getSubmissionList;
	}
	
}
?>