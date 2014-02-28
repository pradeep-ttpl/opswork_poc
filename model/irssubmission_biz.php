<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : irssubmission_biz.php
 * @version  : 1.0
 * @date  : 24-Jan-2013
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           24-Jan-2013           Initial Version - File Created
 * 
 */

class Irssubmission_Model
{		
	public function __construct()
	{
		$irssubmissionDAO = new Irssubmission_DAO;
		$this->irssubmissionDAO = $irssubmissionDAO;
	}
	
	//get filing fee from tt_fee_plan_master table
	public function updateFiling($filingid)
	{
		$result = $this->irssubmissionDAO->updateFiling($filingid);
		return $result;			
	}
}
?>