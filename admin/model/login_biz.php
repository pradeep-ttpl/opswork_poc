<?php
/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: login_biz.php
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

class Login_Model
{
	public function __construct()
	{
		$loginDAO = new Login_DAO;
		$this->loginDAO = $loginDAO;
		
		$MCrypt = new MCrypt;
		$this->MCrypt = $MCrypt;
		
		$defineArr			= validateData();
		$this->defineArr	= $defineArr;   
	}
	
    //user login
	public function userLogin( array $variable )
	{		
		$email = addslashes(trim($variable['email']));	
		$pwd = addslashes(trim($variable['pwd']));
		//$hashpwd = md5($pwd);			

		$userInfo = $this->loginDAO->userLoginCheck($this->MCrypt->encrypt($email),$this->MCrypt->encrypt($pwd));
		
		
		if(sizeof($userInfo) > 1)		
		{
				if($userInfo['id'] > 0)
				{					
					$_SESSION['user_id'] = $userInfo['id'];			
					$_SESSION['first_name'] = $userInfo['first_name'];
					$_SESSION['department_id'] 		= $userInfo['user_department_id'];
					$_SESSION['department_name'] 	= $userInfo['department_name'];
					$_SESSION['role_id'] 			= $userInfo['user_role_id'];
					$_SESSION['role_name']			= $userInfo['role_name'];
					$_SESSION['admin_allowed']		= $userInfo['admin_side_allowed'];
					
//					$_SESSION['user_privilages'] = $userInfo['user_privileges'];
					$_SESSION['user_type'] = $userInfo['user_type'];
					
					$userDAO = new User_DAO;
					$userPagePrivilegesArray = $userDAO->getUsersAllAccessPrivileges($userInfo['user_role_id']);
					$_SESSION['menuArray'] = $userPagePrivilegesArray;
			
					$this->loginDAO->insertLoggingTime($userInfo['id'],true);
					
					// Insert particular log page data in database 
					//insertPageLog($userId,'Registration');
					
					$userLoginStatus = 'ok';	
				}
				
		}		
		else
		{	
			$userInfo = $this->loginDAO->getUserDataByEmail($email);
			if(sizeof($userInfo) > 0)		
			{
				if($this->MCrypt->encrypt($pwd) != $userInfo['password'] )
				{
					$this->loginDAO->insertLoggingTime($userInfo['id'],false);
				}
			}			
			$userLoginStatus = $this->defineArr['TAX_ACCOUNT_INVALID'][$_SESSION['lang']];	
		}
		return $userLoginStatus;
	}		
}
?>