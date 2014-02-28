<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : logout_controller.php
 * @version  : 1.0
 * @date  : 13-Jul-2012
 *
 * @description :
 *
 * @author      : Ramya
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          -------------------------------------------
 * Ramya               	13-Jul-2012           	Initial Version - File Created
 * Naveen				16-Jul-2012 			Session fully destroyed
 */

class Logout_Controller
{	
	public function main( array $reqVars )
	{	
		
		$request = $_SERVER['REQUEST_URI']; 
		$parsed = explode('/', $request);
		$expireVar = '';

		//setcookie('fbs_'.TT_FB_CLIENT_ID, '', time()-100, '/', TT_SITE_NAME);
		session_destroy();
		//setcookie('stt_user','',time()-3600,'/');
		
		/*if(isset($parsed[2])){
			$expireVar = preg_replace( '|[^a-z0-9-]+|', '', $parsed[2] );
			session_start();
			$_SESSION['expires_msg'] = 'Session expired';
		}*/
		header( 'Location: '.TT_SITE_NAME);
		exit();	
	}
} 
?>