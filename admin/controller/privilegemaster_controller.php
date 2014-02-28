<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename : Privilegemaster_controller.php
 * @version  : 1.0
 * @date  : 28-Feb-2013
 *
 * @description : Privilegemaster controller file
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        28-Feb-2013           Initial Version - File Created
 * 
 */

class Privilegemaster_Controller
{
	public $template = 'Privilegemaster';

	public function main( array $reqVars )
	{
		$privilegeModel = new Privilegemaster_Model;
		$selectParentmenus = $privilegeModel -> selectParentMenus();
		//$selectSubmenus = $privilegeModel -> selectSubMenus();
		$status = '';
		
		if(isset($_REQUEST['managePrivilege']))
		{
			$role = $reqVars['roles'];	
			$department = $reqVars['user_department'];
			$userID = $reqVars['dept_role_user'];
			$departmentID = explode("_",$department);
			$selectAllroles = $privilegeModel -> selectAllRoles($departmentID[0]);	
			$selectRoleUsers = 	$privilegeModel -> selectRoleUsers($role);
			$menuList = $privilegeModel -> menuList($reqVars);
			$privilegeArray = $menuList;
			if(count($privilegeArray)>0)
			{
				$savePrivilege = $privilegeModel -> savePrivilege($privilegeArray,$role,$userID);
				$status = 'saved';
			}
			else 
			$status = 'Not saved';
		}
		
		$userModel 	= new User_Model;	// Create Object for User_Model Class
		// Get all departments
		$allDepartmentsInfo = $userModel->getAllDepartmentsInfo();
		
		$tpl = new Template_Model($this->template);

		$tpl ->assign('allDepartmentsInfo',$allDepartmentsInfo);
		$tpl ->assign('ParentMenus',$selectParentmenus);
		
		$tpl ->assign('status',$status);
		
		if(isset($_REQUEST['managePrivilege']))
		{
			$tpl ->assign('selectedRoleID',$role);
			$tpl ->assign('selectedDepartmentID',$department);
			$tpl ->assign('selectedUserID',$userID);
			$tpl ->assign('Allroles',$selectAllroles);
			$tpl ->assign('roleUserslist',$selectRoleUsers);
		}
	}
}
?>