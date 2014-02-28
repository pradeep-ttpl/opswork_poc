<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : forgotpassword_controller.php
 * @version  : 1.0
 * @date  : 13-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          -------------------------------------------
 * Akila                 12-Nov-2013           Initial Version - File Created
 * 
 */

class ForgotPassword_Controller
{	
	public $template = 'forgotpassword'; //forgotpassword
	public function main( array $reqVars )
	{
		// Model
		$registerModel 	= new Register_Model;
		
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		$userId = 0;
		$newpassword 	 	= '';
	    $confirmpassword 	= '';	
	    $status = '';
	    $email = '';
		if( isset($parsed[2]) && strlen($parsed[2]) > 0 )
		{
			$userId = getUserIdBYRetypePwd($parsed[2]); 
			if((int)$userId > 0)
			{
				$newpassword 	 	= (isset($reqVars['pwd']) ? $reqVars['pwd'] : '');
				$confirmpassword 	= (isset($reqVars['cpwd']) ? $reqVars['cpwd'] : '');
				
				$this->template 	= 'changepassword'; //to change password 
				if($newpassword != '')
				{
					$status 		= $registerModel->setNewPassword($userId,$newpassword);
				}
				if(strlen($status) > 0)
				{					
					$newpassword 	 	= '';
					$confirmpassword 	= '';					
				}						
			}
			else
			{
				header( 'Location: '.TT_SITE_NAME);
				exit();
			}	
		}
		else
		{
			$email     = (isset($reqVars['email']) ? $reqVars['email'] : '');		
			
			if( sizeof($reqVars) > 0 )
			{			
				$status = $registerModel->chkUserEmail($email);
				$email = '';
			}
		}
		
		// Passing the response data to UI template.
		$tpl = new Template_Model($this->template);		
		$tpl->assign('mail' , $email);				
		$tpl->assign('password' , $newpassword);				
		$tpl->assign('confirmpassword' , $confirmpassword);				
		$tpl->assign('status' , $status);
	}
}
?>
 