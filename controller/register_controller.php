<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : register_controller.php
 * @version  : 1.0
 * @date  : 12-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * AKila                 12-Jul-2012           Initial Version - File Created
 * 
 */

class Register_Controller
{	
	public $template = 'register';
	
	public function main( array $reqVars )
	{
		if(DISABLE_REGISTRATION == '1')
		{
			header( 'Location: '.TT_SITE_NAME);
			exit();
		}
		
		$registerModel 	= new Register_Model;
		
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		
		if(isset($parsed[2]) && $parsed[2] == 'confirm')
		$this->template = "regconfirm";
		
		if(isset($reqVars['register']) == "taxprof")
		{
			$this->template = "register_tax_prof";
		}
		
		if( isset($reqVars['firstname']) > 0 ) 		
		{
			$firstname	= $reqVars['firstname'];
//			$lastname 	= $reqVars['lastname'];
		    $email 		= $reqVars['email'];
		    $password 	= $reqVars['pwd'];
//		    $phone 		= $reqVars['phone'];
		    $captcha 	= $reqVars['captcha'];
		    $user_type  = $reqVars['user_type']; 
		    
		    $msg = $registerModel->userRegistration($firstname,$email,$password,$captcha,$user_type);
			
		    if($msg['value'] == 'inserted')
			{
				
				$status = $registerModel->directuserLogin($email,$password,'');
					
				if($status == 'ok')
				{
					// update user login to log
					$result = $registerModel->insertUserLastLogin($_SESSION['user_id'],$_SERVER['REMOTE_ADDR'],"login");
					
					$_SESSION['regSucMsg'] = 'You are registered successfully';
					header('Location: '.TT_SITE_NAME.'taxpayerbusiness/');
					exit();
				}
			}
			
			/*if($msg['value'] == 'inserted')
			{
				$defineArr	    = validateData();
				$msg['value']   = $defineArr['TAX_REGISTER_MSG'][$_SESSION['lang']];
				header('location:/register/confirm/');
			}	*/
		}
		// Passing the response data to UI template.
		$tpl = new Template_Model($this->template);	
		$tpl->assign('regValue' , $reqVars);
		if(isset($msg)){ 
			$tpl->assign('msg' , $msg);	
		}
	}		
}
?>