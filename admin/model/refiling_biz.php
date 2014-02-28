<?php
class Refiling_Model
{		
	public function __construct()
	{		
		// filing DAO
		$refilingDAO = new Refiling_DAO;
		$this->refilingDAO = $refilingDAO;
		
	}
	
	public function getfilingList($filingId,$ein,$bizName,$taxForm,$taxyear,$taxmonth)
	{
		$getfilingList = $this->refilingDAO->getfilingList($filingId,$ein,$bizName,$taxForm,$taxyear,$taxmonth);		
		return $getfilingList;
	}
}
?>