<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : register_biz.php
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
 * Ramya                 13-Jul-2012           updated for login, forgot password, change password 
 * 
 */

class Register_Model
{
	public function __construct()
	{
		$registerDAO = new Register_DAO;
		$this->registerDAO = $registerDAO;
		$defineArr			= validateData();
		$this->defineArr	= $defineArr;   
		
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
	}
	
	//user Registration
	public function userRegistration($firstname,$email,$password,$captcha,$user_type)
	{
		$msg = array();
		$msg['value'] = "";
		
		$createDate = date('Y-m-d H:i:s');
		
		if($firstname == '' || $email == '' || $password == '' || $captcha == '')
		{
			$msg['value'] 	= $this->defineArr['TAX_VALIDATE_MSG'][$_SESSION['lang']];
		}
		if(strlen($captcha) > 0 )
		{
			// Validate the verification code		
			if($captcha != $_SESSION['captcha'])
			{ 	
				//$msg['value'] =  $this->defineArr['TAX_VERIFY_CAPTCHA'][$_SESSION['lang']];
				$msg['value'] =  'wrongcaptcha';
			}
			else
			{
				unset($_SESSION['captcha']);
			}
		}
		if(strlen($email) > 0 )
		{	
			// To check the standard email format for a given email string.
			if (!preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z0-9]{2,4})$/i", $email))
			{
				$msg['value'] = $this->defineArr['TAX_EMAIL_INVALID'][$_SESSION['lang']];
			}
			
		}
		// Check the given user email is already exist or not in database.
		$userStatus = $this->registerDAO->checkUserEmailExist($this->MCrypt->encrypt($email));	
		
		if(strlen($msg['value']) == 0)
		{	
			if( $userStatus == 1)
			{				
				$msg['value'] =  $this->defineArr['TAX_EMAIL_VERIFY_MSG'][$_SESSION['lang']]; 
			}
		    else
			{
				$userId = $this->registerDAO->insertUserdetails($this->MCrypt->encrypt($firstname),$this->MCrypt->encrypt($email),
						  $this->MCrypt->encrypt($password),$captcha,$user_type);
				
				if((int)$userId > 0)
				{
					//Create link to activate the account..
					//No need of activation process required as per RAJA suggestion				
					//$activeUrl = TT_SITE_NAME.'login/'.getActiveCode($userId,$createDate,'A').'/';
					
					// To create the mailing content
					$message = registrationMailcontent($firstname,$email,$password,$activeUrl);
					
					// send account activation mail to registered user
					$sendMail =  SendEmail('registration@simpletrucktax.com',$email,'User Registration',$message);	
				}
				
				$msg['value'] = 'inserted';
				
		    }
		}
	    return $msg;
	}
    //user login
	public function userLogin($email,$pwd,$rememberMe)
	{		
		$userInfo = $this->registerDAO->userLoginCheck($this->MCrypt->encrypt($email),$this->MCrypt->encrypt($pwd));
		
		if(sizeof($userInfo) > 1)		
		{	
			if($userInfo['active'] == 1)
			{
				if($userInfo['id'] > 0)
				{		
					if(!isset($_COOKIE['stt_user']))
					{
						$cookieValue = $email.'~'.$pwd;
						$cookieValue = $this->MCrypt->encrypt($cookieValue);			
						setcookie('stt_user',$cookieValue,time() + (365*86400),'/');
					}
					
					$_SESSION['user_id'] = $userInfo['id'];			
					$_SESSION['first_name'] = $userInfo['first_name'];
					
//					$_SESSION['success_login']   	= $userInfo['LatestSuccessfulLogin'];
//					$_SESSION['failure_login']   	= $userInfo['FailureLogin'];
//					$_SESSION['user_privilages'] 	= $userInfo['user_privileges'];
					$_SESSION['user_type'] 			= $userInfo['user_type'];
					$_SESSION['admin_allowed'] 		= $userInfo['admin_side_allowed'];
					
					if($userInfo['admin_side_allowed'] == 1){
						$userPagePrivilegesArray 	= $this->registerDAO->getUsersAllAccessPrivileges($userInfo['id'],$userInfo['user_role_id']);
						$_SESSION['menuArray'] 		= $userPagePrivilegesArray;
					}

					$this->registerDAO->insertLoggingTime($userInfo['id'],true);
					
					// Insert particular log page data in database 
					//insertPageLog($userId,'Registration');
					
					$userLoginStatus = 'ok';	
				}
			}
			else
			{
				$userLoginStatus =  $this->defineArr['TAX_ACCOUNT_EXPIRED'][$_SESSION['lang']];
			}				
		}		
		else
		{	
			$userInfo = $this->registerDAO->getUserDataByEmail($this->MCrypt->encrypt($email));
			if( sizeof($userInfo) > 0 )		
			{
				if($this->MCrypt->encrypt($pwd) != $userInfo['password'] )
				{   
					$this->registerDAO->insertLoggingTime($userInfo['id'],false);
				}
			}			
			$userLoginStatus = $this->defineArr['TAX_ACCOUNT_INVALID'][$_SESSION['lang']];	
		}
		return $userLoginStatus;
	}
	public function directuserLogin($email,$pwd,$rememberMe)
	{		
		$userInfo = $this->registerDAO->userLoginCheck($this->MCrypt->encrypt($email),$this->MCrypt->encrypt($pwd));
		
		$_SESSION['user_id'] = $userInfo['id'];			
		$_SESSION['first_name'] = $userInfo['first_name'];
					
		$_SESSION['user_type'] 			= $userInfo['user_type'];
		$_SESSION['admin_allowed'] 		= $userInfo['admin_side_allowed'];
					
		if($userInfo['admin_side_allowed'] == 1){
			$userPagePrivilegesArray 	= $this->registerDAO->getUsersAllAccessPrivileges($userInfo['id'],$userInfo['user_role_id']);
			$_SESSION['menuArray'] 		= $userPagePrivilegesArray;
		}

		$this->registerDAO->insertLoggingTime($userInfo['id'],true);
					
		$userLoginStatus = 'ok';	
				
		return $userLoginStatus;
	}
	public function setNewPassword( $userId,$newpassword )
	{
		$statusUpdate = '';
		$affectedrow = $this->registerDAO->setNewPassword( $userId,$this->MCrypt->encrypt($newpassword));		
		//if((int)$affectedrow > 0)
		//{
			$statusUpdate = $this->defineArr['TAX_UPDATE_PWD'][$_SESSION['lang']];
		//}
		
		return $statusUpdate;
	}
	public function chkUserEmail( $email )
	{		
		$errorFlag = '~error';
		$successFlag = '~success';
		
		$userInfo = $this->registerDAO->getUserDataByEmail($this->MCrypt->encrypt($email));
		
		if( sizeof($userInfo) > 1 && $userInfo['active'] == 1)
		{
			$userStatus = $this->defineArr['TAX_ACCOUNT_EXPIRED'][$_SESSION['lang']].$errorFlag;		
			if($userInfo['active'] == 1)
			{	
				//Create link to create a new passford..				
				$forgotpwdUrl = TT_SITE_NAME.'forgotpassword/'.getActiveCode($userInfo['id'],$userInfo['created_date'],'F').'/';			
				
				// To create the mailing content
				$message = forgotPwdMailcontent($this->MCrypt->decrypt($userInfo['first_name']),$this->MCrypt->decrypt($userInfo['email']),$forgotpwdUrl);
				
				// send forgot password mail to registered user
				$sendMail =  SendEmail('info@simpletrucktax.com',$email,'Forgot Password',$message);				
				
				$userStatus = $this->defineArr['TAX_CHK_MAIL'][$_SESSION['lang']].$successFlag;
			}			
		}
		else if(sizeof($userInfo) > 1 && $userInfo['active'] == 0)
		{
			$userStatus = $this->defineArr['FP_ACCOUNT_NOT_ACTIVE'][$_SESSION['lang']].$errorFlag;
		}
		else
		{
			$userStatus = $this->defineArr['TAX_EMAIL_NOT_MATCHING'][$_SESSION['lang']].$errorFlag;
		}
		return $userStatus;
	}	
	
	function insertUserLastLogin($user_id, $ip, $status)
	{
		 $result = $this->registerDAO->insertUserLastLogin($user_id, $ip, $status);
		 return $result;
	}
}
?>
