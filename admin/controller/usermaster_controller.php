<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: usermaster_controller.php
 * @version  	: 1.0
 * @date  	 	: 16-Dec-2013
 *
 * @description : Usermaster controller file
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


class Usermaster_Controller
{	
	public $template = 'usermaster';
	public function main( array $reqVars )
	{	
		$userModel 	= new User_Model;	// Create Object for User_Model Class
		
		// Get all departments
		$allDepartmentsInfo = $userModel->getAllDepartmentsInfo();
		
		if(isset($reqVars['type']) && $reqVars['type']=='add'){
			
			$tpl = new Template_Model('addusermaster');
					
		}elseif((isset($reqVars['type']) && $reqVars['type']=='edit'  && $reqVars['id'] > 0)||(isset($reqVars['type']) && $reqVars['type']=='myaccount' && !isset($reqVars['updateUser']))){

			if(isset($reqVars['id'])){
				$editUserID 	= $reqVars['id'];
			}else{
				$editUserID 	= $_SESSION['user_id'];	
			}			
			$userInfoArray 	= $userModel->getUserInfo($editUserID);
			$rolesArray 	= $userModel->getDepartmentRoles($userInfoArray[0]['user_department_id']);
			$tpl = new Template_Model('editusermaster');		
			$tpl ->assign('userInfoArray',$userInfoArray);
			
		}elseif (isset($reqVars['addUser']) && $reqVars['addUser']=='Save'){

			$saveUserStatus = $userModel->saveUserInfo($reqVars);
			
			if($saveUserStatus == 'error')
			{   
				$_SESSION['errorStatus'] = 'Sorry,This email is already registered';
				header( 'Location: '.TT_ADMIN_SITE_NAME.'usermaster/?type=add' );
			}
			if($saveUserStatus == 'success')
			{	
				$_SESSION['status'] = 'User saved successfully';
				header( 'Location: '.TT_ADMIN_SITE_NAME.'usermaster' );
			}
			
		}elseif (isset($reqVars['updateUser']) && $reqVars['updateUser']=='Update'){
			
			$saveUserStatus = $userModel->saveUserInfo($reqVars);
			if($saveUserStatus == 'success')
			{
				$_SESSION['status'] = 'User updated successfully';
			}
			
			if($reqVars['type'] == 'myaccount'){
				header( 'Location: '.TT_ADMIN_SITE_NAME.'usermaster');	
			}else{
				header( 'Location: '.TT_ADMIN_SITE_NAME.'usermaster');
			}
        	exit();
		}else{
			
			$allUsersListInfo = $userModel->getAllUsersList();
			$tpl = new Template_Model($this->template);		
			$tpl ->assign('allUsersListInfo',$allUsersListInfo);
			
		}		
			if(isset($allDepartmentsInfo)){
				$tpl ->assign('allDepartmentsInfo',$allDepartmentsInfo);
			}
			if(isset($rolesArray)){
				$tpl ->assign('rolesArray',$rolesArray);
			}
	}		
}
?>