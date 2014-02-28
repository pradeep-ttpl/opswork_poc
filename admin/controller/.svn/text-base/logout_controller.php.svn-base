<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: logout_controller.php
 * @version  	: 1.0
 * @date  		: 12-Dec-2013
 *
 * @description :
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        12-Dec-2013           Initial Version - File Created
 * 
 */

class Logout_Controller
{	
	public function main( array $reqVars )
	{	
		setcookie('fbs_'.TT_FB_CLIENT_ID, '', time()-100, '/', 'tax2290.triestendemos.com');
		session_destroy();
		header( 'Location: '.TT_SITE_NAME);
		exit();	
	}
} 
?>