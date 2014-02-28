<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : emailsubcription_entity.php
 * @version  : 1.0
 * @date  : 1-Aug-2012
 *
 * @description :
 *
 * @author      : Naveen
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen				1-Aug-2012           Initial Version - File Created
 * 
 */

class Emailsubcription_DAO
{		
	public function __construct()
	{	
		
	}
	public function emailSubscription($email,$time){
		
		$getEmailSubslist = getEmailSubscriptionlist($email);
		
		if(count($getEmailSubslist) > 0)
		{
			return 'already exists';
		}
		else 
		{
			global $DBH;
			
			$sql = "INSERT INTO `tt_email_subscription`(`email`,`reg_date`,`active`) VALUES (?,?,?)";		
			$preparesql = $DBH->prepare($sql);
			$preparesql->execute(array($email,$time,'1'));
			
			return 'success';
		}
	}	
}
?>