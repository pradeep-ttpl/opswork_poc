<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : emailsubcription_biz.php
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
 * Naveen           	1-Aug-2012           Initial Version - File Created
 * 
 */

class Emailsubcription_Model
{		
	public function __construct()
	{		
	}
	public function emailSubscription($reqVars)
	{
		$emailSubscriptionDAO = new Emailsubcription_DAO;
		$email = $reqVars['emailSubscription'];
		$time = date("Y-m-d H:i:s");
		$emailSubStatus = $emailSubscriptionDAO->emailSubscription($email,$time);

		if($emailSubStatus=='success'){
			$_SESSION['emailSubMsg'] = "You are successfully subscribed.";
		}else{
			$_SESSION['emailSubMsg'] = "You are already subscribed.";
		}
	}
}
?>