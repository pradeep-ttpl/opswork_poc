<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : irssubmission_entity.php
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

class Irssubmission_DAO
{		
	public function __construct()
	{	
		
	}
	public function updateFiling($filingid){
		global $DBH;
		$sql = "UPDATE `tt_filings` SET  `date_user_submitted` = NOW(), `consent_to_submit` = ?, `user_completed` = ? WHERE `id` = ?";		
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array("1", "1", $filingid));
		return true;
	}	
}
?>