<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : login_controller.php
 * @version  : 1.0
 * @date  : 12-Jul-2012
 *
 * @description :
 *
 * @author      : Ramya
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          -------------------------------------------
 * Ramya               12-Jul-2012           Initial Version - File Created
 * 
 */

class Login_Controller
{	
	public $template = 'landing';
	
	public function main( array $reqVars )
	{
		$registerModel 	= new Register_Model;
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		$status = '';
		$statusMsg = '';
		
		if(!isset($reqVars['email']) && ($reqVars['pwd']))
		{   
			if(isset($_COOKIE['stt_user']))
			{
				$MCrypt	= new MCrypt;
			
				$cookieValue = $MCrypt->decrypt($_COOKIE['stt_user']);
				$expandValue = explode('~',$cookieValue);
				$status = $registerModel->userLogin($expandValue[0],$expandValue[1],1);
			}
		}
		
		if(sizeof($reqVars) > 0)
		{
			$email = addslashes(trim($reqVars['email']));	
			$pwd = addslashes(trim($reqVars['pwd']));
			
			if(isset($reqVars['rememberMe'])){
				$rememberMe = $reqVars['rememberMe'];
			}else{
				$rememberMe = '';
			}
			
			$status = $registerModel->userLogin($email,$pwd,$rememberMe);
		}			
		
		if(strtolower($status) == 'ok')
		{
			// update user login to log
			$result = $registerModel->insertUserLastLogin($_SESSION['user_id'],$_SERVER['REMOTE_ADDR'],"login");
			
			if($_SESSION['admin_allowed'] == 1 && $_SESSION['user_type'] != 2){
				header('Location: '.TT_ADMIN_SITE_NAME.'dashboard');				
			}else{
				$taxpayerbusinessDAO 	= new Taxpayerbusiness_DAO;
				
				// If user already have done any filings, then redirect to filestatus page
				$filingLsit = $taxpayerbusinessDAO->getFilingStatus($_SESSION['user_id']);
				if(count($filingLsit) > 0){
					header('Location: '.TT_SITE_NAME.'filestatus/');
				}else{
					header('Location: '.TT_SITE_NAME.'taxpayerbusiness/');
				}
			}
			exit();
		}
		
		/*$activation = (isset($parsed[2]) ? $parsed[2]: '');
		if(strlen($activation) > 0)
		{
			$statusMsg = confirmlogin($parsed[2]);				
		}*/
			
		$tpl = new Template_Model($this->template);		
		$tpl->assign('status', $status);	
		$tpl->assign('msg' , $statusMsg);	
		$tpl->assign('loginValue' , $reqVars);
	}		
}
?>