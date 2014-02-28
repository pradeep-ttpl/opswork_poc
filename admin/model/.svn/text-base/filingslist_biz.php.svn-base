<?php
class Filingslist_Model
{		
	public function __construct()
	{		
		// filing DAO
		$filingslistDAO = new Filingslist_DAO;
		$this->filingslistDAO = $filingslistDAO;
		
	}
	
	public function getfilingList($fromDate,$toDate,$userId)
	{
		$getfilingList = $this->filingslistDAO->getfilingList($fromDate,$toDate,$userId);		
		return $getfilingList;
	}
	
	public function getRecentfilingList($fromDate,$toDate)
	{
		$recentfilingList = $this->filingslistDAO->getRecentfilingList($fromDate,$toDate);		
		return $recentfilingList;
	}
}
?>