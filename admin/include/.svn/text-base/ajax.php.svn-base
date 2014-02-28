<?php
/*******************************************************************************
 *                        AJAX file for Simple Truck Tax
 *******************************************************************************
 *      Author		: Raja Saravanan
 * 		Language 	: PHP 5.3
 * 		Project 	: Simple Truck Tax
 *  	Version		: 1
 *      File		: ajax.php
 *      Copyright (c) 2011- 2013
 *      
 *******************************************************************************
 *  VERSION HISTORY:
 * 
 *      v1 [27.02.2013] - Initial Version
 *
 */
error_reporting(1);
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/constants.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/admin/entity/menucontrolpanel_entity.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/admin/entity/user_entity.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/admin/entity/privilegemaster_entity.php');
include_once (TT_INCLUDE_PATH.'/MCrypt.php');
$MCrypt	= new MCrypt;

$type = $_REQUEST['type'];

if($type == 'UpdateMenu')
{ 
	$menuDisplayName = $_REQUEST['menu_display_name'];
	$menuName = $_REQUEST['menu_name'];
	$menuParent = $_REQUEST['menu_parent'];
	$menuOrder = $_REQUEST['menu_order'];
	$menupublish = $_REQUEST['publish'];
	$menuId = $_REQUEST['menuId'];
	
	$menucontrolDAO = new Menucontrolpanel_DAO;
	
	$updateMenu = $menucontrolDAO-> updatemenu($menuName,$menuDisplayName,$menuParent,$menuOrder,$menupublish,$menuId);
	
	echo $menuDisplayName."|".$menuName."|".$menuParent."|".$menuOrder."|".$publish;
	
}
else if($type == 'EditMenu')
{   
	$menuId = $_REQUEST['menuId'];
	$menuDetails 	= getMenuDetails($menuId);
	
	$menuName 			= $menuDetails['menu_name'];
	$menuDisplayName 	= $menuDetails['menu_display_name'];
	$menuParent 		= $menuDetails['menu_parent_id'];
	$menuOrder 			= $menuDetails['order_id'];
	$publish			= $menuDetails['publish'];
	
	echo $menuDisplayName."|".$menuName."|".$menuParent."|".$menuOrder."|".$publish;
}
else if($type == 'deleteMenu')
{
	$menuId = $_REQUEST['menuId'];
	$menucontrolDAO = new Menucontrolpanel_DAO;
	
	$deleteMenu = $menucontrolDAO->deleteMenu($menuId);
}
// Fetching roles related to the selected departments
else if($type == 'getRoles')
{
	$deptId = $_REQUEST['deptId'];
	$roleId = $_REQUEST['roleId'];
	$userDAO 				= new User_DAO;
	$rolesBasedOnDepartment = $userDAO->getRolesBasedOnDepartment($deptId,$roleId);
}
else if($type == 'savedPrivileges')
{
	$roleId = $_REQUEST['roleId'];
	$SavedType = $_REQUEST['SavedType'];
	$selectedID = $_REQUEST['selectedID'];
	$privilegeDAO = new Privilegemaster_DAO;
	$savedPrivileges = $privilegeDAO-> savedPrivileges($selectedID,$SavedType,$roleId);
	echo $savedPrivileges;
}
// Fetch list of users base on role
else if($type == 'selectUsers')
{
	$roleID = $_REQUEST['roleId'];
	$sql = 'SELECT id,first_name,last_name FROM `tt_users` WHERE user_role_id = ? AND active = ?
			ORDER BY id DESC';
	$prepareSql = $DBH->prepare($sql);
  	$prepareSql ->execute(array($roleID,1));		
	$prepareSql->setFetchMode(PDO::FETCH_ASSOC);
	$count = $prepareSql->rowcount();
	$html = '';
	if($count > 0)
	{
		$html .= '<option value=""> - Select -</option>';
		while($row = $prepareSql->fetch())
		{	
			$html .= '<option value="'.$row['id'].'">'.$MCrypt->decrypt($row['first_name']).' '.$MCrypt->decrypt($row['last_name']).'</option>';
		}
	}else{
		$html .= '<option value=""> - No Users -</option>';
	}
	echo $html;  	
}
// Fetch user info
else if($type == 'selectAssignedUsers')
{
	$userId = $_REQUEST['userId'];
	$roleId = $_REQUEST['roleId'];
	
	$sql = 'SELECT id,first_name,last_name FROM `tt_users` WHERE user_role_id = ? AND active = ?
			ORDER BY id DESC'; 
	$prepareSql = $DBH->prepare($sql);
  	$prepareSql ->execute(array($roleId,1));		
	$prepareSql->setFetchMode(PDO::FETCH_ASSOC);
	$count = $prepareSql->rowcount();
	$html = '';
	if($count > 0)
	{
		$html .= '<option value=""> - Select -</option>';
		while($row = $prepareSql->fetch())
		{	
			$html .= '<option value="'.$row['id'].'" ';
			if($row['id'] == $userId){
				$html .= 'selected';
			}
			$html .='>'.$MCrypt->decrypt($row['first_name']).' '.$MCrypt->decrypt($row['last_name']).'</option>';
		}
	}else{
		$html .= '<option value=""> - No Users -</option>';
	}
	echo $html;  	
}
else if($type == 'selectSubparent')
{
	$ParentId = $_REQUEST['ParentId'];
	$privilegeDAO = new Privilegemaster_DAO;
	$selectSubparent = $privilegeDAO-> selectSubparent($ParentId);	
	echo $selectSubparent;
}
//Adding new dynamic department
else if( $type == 'addDepartment')
{	
	$deptName			= $_REQUEST['DeptName'];
	$userDAO 			= new User_DAO;
	$checkDepartmentName= $userDAO->getDepartmentInfo($deptName);
	
	if($checkDepartmentName > 0){
		echo "department exist";		
	}else{
		
		$newDepartmentId 	= $userDAO->addNewDepartment($deptName);
		$allDepartmentsInfo = $userDAO->getAllDepartmentsInfo();
		if(sizeof($allDepartmentsInfo) > 0)
		{
			$html .= "<option value='0'>- Select Department -</option>";
			foreach($allDepartmentsInfo as $key => $value)
			{
				$html .= "<option value='".$value['id']."'";
				if($newDepartmentId == $value['id']){
					$html 	.= "selected";
				}
				$html 		.= ">".$value['department_name']."</option>";
			}
		}
		else
		{ 
			$html = "<option value=''>-No Department found-</option>";
		}	
		echo $html;
	}
}
//Delete Department
else if( $type == 'deleteDept')
{	
	$deptId		= $_REQUEST['deptId'];	
	
	$deptValue = $_REQUEST['deptArrayValue'];
	
	global $DBH;
	$userDAO 			= new User_DAO;
	$deleteDepartment 	= $userDAO->deleteDepartment($deptId);
	
	//To delete role if department is deleted.
	$deleteRoles 	= $userDAO->deleteRolesBasedOnDepartment($deptValue);
	
	$allDepartmentsInfo = $userDAO->getAllDepartmentsInfo();
	if(sizeof($allDepartmentsInfo) > 0)
		{
			$html .= "<option value='0'>- Select Department -</option>";
			foreach($allDepartmentsInfo as $key => $value)
			{
				$html .= "<option value='".$value['id']."'>".$value['department_name']."</option>";
			}
		}
	else
	{ 
		$html = "<option value=''>-No Department found-</option>";
	}	
	echo $html;
}
else if($type == 'checkDeptAvailable')
{
	$userDAO 			= new User_DAO;
	$checkDepartmentName= $userDAO->getAllDepartmentsInfo();
	echo count($checkDepartmentName);
	
}
//Adding new dynamic role
else if( $type == 'addRole')
{	
	$roleName		= $_REQUEST['roleName'];
	$deptId		= $_REQUEST['deptId'];
	
	$userDAO 	= new User_DAO;
	$addNewRole = $userDAO->addNewRole($deptId,$roleName);
}
//Deleting a role
else if( $type == 'deleteRole')
{	
	$roleId			= $_REQUEST['roleID'];	
	$departmentId	= $_REQUEST['departmentId'];

	$userDAO 	= new User_DAO;
	$deleteRole = $userDAO->deleteRole($roleId);
	$getRoles 	= $userDAO->getRolesBasedOnDepartment($departmentId,$roleId);
}
// Fetching roles related to the selected departments
else if($type == 'getRoles')
{
	$deptId = $_REQUEST['deptId'];
	$roleId = $_REQUEST['roleId'];
	$userDAO 				= new User_DAO;
	$rolesBasedOnDepartment = $userDAO->getRolesBasedOnDepartment($deptId,$roleId);
}
else if($type == 'checkRoleAvailable')
{
	$deptId = $_REQUEST['department'];
	
	$userDAO 			= new User_DAO;
	$checkDepartmentName= $userDAO->getDepartmentRoles($deptId);
	echo count($checkDepartmentName);
	
}
//Activate or De-activate an user
else if($type == 'updateUserStatus')
{
	$userId		= $_REQUEST['userId'];
	$status		= $_REQUEST['status'];
	$userDAO 	= new User_DAO;
	$checkEmail = $userDAO->updateUserStatus($userId,$status);	
} 
?>