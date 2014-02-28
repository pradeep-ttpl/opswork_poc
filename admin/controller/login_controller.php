<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: login_controller.php
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

class Login_Controller
{	
	public $template = 'login';
	
	public function main( array $reqVars )
	{
		$loginModel 	= new Login_Model;
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		$status = '';
		$statusMsg = '';
		
		if(sizeof($reqVars) > 0)
		{	
			$status = $loginModel->userLogin($reqVars);
		}			
		
		if(strtolower($status) == 'ok')
		{
			header('Location: '.TT_ADMIN_SITE_NAME.'dashboard');				
			exit();	
		}
		
		$activation = (isset($parsed[3]) ? $parsed[3]: '');
		if(strlen($activation) > 0)
		{
			$statusMsg = confirmlogin($parsed[3]);				
		}
			
		$tpl = new Template_Model($this->template);		
		$tpl->assign('status', $status);	
		$tpl->assign('msg' , $statusMsg);	
		$tpl->assign('loginValue' , $reqVars);
	}		
}
?>