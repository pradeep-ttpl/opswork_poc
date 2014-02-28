<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: user_biz.php
 * @version  	: 1.0
 * @date  		: 16-Dec-2013
 *
 * @description : User business model file
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        16-Dec-2013           Initial Version - File Created
 * 
 */

class User_Model
{		
	public function __construct()
	{		
		// User DAO
		$userDAO = new User_DAO;
		$this->userDAO = $userDAO;
		
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
	}
	// Checking user login information
	public function userLogin( array $reqVars )
	{
		$userLoginCheck = array();
		$userName = stripslashes($reqVars['username']);	
		$password = stripslashes($reqVars['password']);
		$hashpwd = md5($password);			
		$userInfo = $this->userDAO->UserLoginCheck($userName,$hashpwd);
		if($userInfo['id'] > 0 && $userInfo['user_active'] == 'Y')
		{
			$_SESSION['user_id'] 			= $userInfo['id'];
			$_SESSION['department_id'] 		= $userInfo['user_department_id'];
			$_SESSION['department_name'] 	= $userInfo['department_name'];
			$_SESSION['role_id'] 			= $userInfo['user_role_id'];
			$_SESSION['role_name']			= $userInfo['role_name'];
			$_SESSION['user_name'] 			= $userInfo['user_name'];
			$_SESSION['user_display_name']	= $userInfo['user_first_name'].' '.$userInfo['user_last_name'];
			$_SESSION['last_login'] 		= $userInfo['last_login'];
			$userPagePrivilegesArray = $this->userDAO->getUsersAllAccessPrivileges($userInfo['user_role_id']);
			$_SESSION['menuArray'] = $userPagePrivilegesArray;
			//$_SESSION['user_page_privileges'] = $userPagePrivilegesArray;
			$userLoginCheck['status']		= 'ok';
		}
		else
		{
			$userLoginCheck['status'] = 'Invalid User';	
		}
		return $userLoginCheck;
	}
	// Fetching all users list
	public function getAllUsersList()
	{
		$allUsersListInfo = $this->userDAO->getAllUsersList();
		return $allUsersListInfo;		
	}
	// Fetching specific user information
	public function getUserInfo($userID)
	{
		$userInfoArray = $this->userDAO->getUserInfo($userID);
		return $userInfoArray;
	}	
	// Fetching all departments
	public function getAllDepartmentsInfo()
	{
		$allDepartmentsInfo = $this->userDAO->getAllDepartmentsInfo();
		return $allDepartmentsInfo;		
	}
	// Fetching all roles
	public function getAllRolesInfo()
	{
		$allRolesInfo = $this->userDAO->getAllRolesInfo();
		return $allRolesInfo;		
	}
	// Fetching roles belongs to the departments
	public function getDepartmentRoles($deptId){
		$allDepartmentRolesInfo = $this->userDAO->getDepartmentRoles($deptId);
		return $allDepartmentRolesInfo;		
	}	
	public function saveUserInfo($reqVars)
	{
		$update_user_id = '';
		if( isset($reqVars['user_id']) && $reqVars['user_id'] > 0) $update_user_id = $reqVars['user_id'];
		if( isset($reqVars['password'])) $pwd = $reqVars['password'];
		$user_first_name 	= $reqVars['user_first_name'];
		$user_last_name 	= $reqVars['user_last_name'];
		$user_email 		= $reqVars['user_email'];
		$user_phone 		= $reqVars['user_phone'];
		$user_type			= $reqVars['user_type'];
		
		$isallowed = '';
		if(isset($reqVars['isallowed'])){
			$isallowed = $reqVars['isallowed'];
		}
		
		if($isallowed == "on")
		{
			$isallowed = 1;
		}
		else
		{
			$isallowed = 0;
		}
		
		$user_department 	= explode('_',$reqVars['user_department']);
		$user_department	= $user_department['0'];
		$user_role 			= explode('_',$reqVars['user_role']);
		$user_role			= $user_role['0'];
		if($user_department == '' && $user_role == ''){
			$user_department 	= $reqVars['user_dept_id'];
			$user_role			= $reqVars['user_role_id'];
		}
//		$user_designation 	= $reqVars['user_designation'];
		if( isset($reqVars['addUser']) && strlen($reqVars['addUser']) > 0)$form_flag = $reqVars['addUser'];
		if( isset($reqVars['updateUser']) && strlen($reqVars['updateUser']) > 0)$form_flag = $reqVars['updateUser'];
		
		$userStatus = 0;
		if($form_flag != 'Update')
		{
			// Check the given user email is already exist or not in database.
			$userStatus = $this->userDAO->checkUserEmailExist($this->MCrypt->encrypt($user_email));	
		}
		
		if($userStatus == 1)
		{		
			$message = 'error'; 
		}
		else
		{
			$userInfoArray = $this->userDAO->saveUserInfo($update_user_id,$this->MCrypt->encrypt($user_first_name),
							 $this->MCrypt->encrypt($user_last_name),$this->MCrypt->encrypt($pwd),$this->MCrypt->encrypt($user_email),
							 $this->MCrypt->encrypt($user_phone),$user_type,$user_department,$user_role,$isallowed,$form_flag);
							 
			if($form_flag != 'Update')
			{
				$mail_template = userLoginDetails($user_first_name,$user_email,$pwd);
				SendEmail(TT_SUPPORT_EMAIL,$user_email,'Simpletrucktax login details',$mail_template);
			}
			
			$message = 'success';
			
			/*
			if($form_flag == 'Update' && $pwd != '' && $pwd != '*******')
			{
				$mail_template = userPasswordUpdateDetails($user_display_name,$pwd);
				SendEmail($user_email,'Apex Password Update Details',$mail_template);
			}*/
		}
		return $message;
	}			
}
?>