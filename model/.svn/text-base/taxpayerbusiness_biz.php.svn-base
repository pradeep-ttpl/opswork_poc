<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : taxPayerBusiness_biz.php
 * @version  : 1.0
 * @date  : 12-Jul-2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           12-Jul-2012           Initial Version - File Created
 * 
 */

class Taxpayerbusiness_Model
{		
	public function __construct()
	{		
		// taxPayerBusiness DAO
		$taxpayerbusinessDAO = new Taxpayerbusiness_DAO;
		$this->taxpayerbusiness = $taxpayerbusinessDAO;
	}
	public function getBusinessDetails()
	{
		$user_id = $_SESSION['user_id'];
		$userDetails = $this->taxpayerbusiness->getBusinessDetails($user_id);
		return $userDetails;
	}
	public function getFilingStatus()
	{
		$user_id = $_SESSION['user_id'];
		$filelist = $this->taxpayerbusiness->getFilingStatus($user_id);
		return $filelist;
	}
	public function getFilingList()
	{
		$user_id = $_SESSION['user_id'];
		$filelist = $this->taxpayerbusiness->getFilingList($user_id);
		return $filelist;		
	}
}
?>