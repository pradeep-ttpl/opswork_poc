<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 		: user_entity.php
 * @version  		: 1.0
 * @date  			: 16-Dec-2013
 *
 * @description 	: User entity file
 *
 * @author      	: Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        16-Dec-2013           Initial Version - File Created
 * 
 */

class User_DAO
{
	public function __construct()
	{	
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
	}	
	/**
	 * function name : userLoginCheck
	 * purpose : To ensure that whether the user entered his email and password is valid or not
	 * Table Name : admin_users
	 * @Params : user_name,user_password
	 * The argument passed in this fuction was sent from userLogin function in user_biz.php file
	 */
	public function UserLoginCheck($userName,$hashpwd)
	{
		global $DBH;
		$sql = "SELECT u.*,d.department_name,r.role_name FROM 
				`tt_users` AS u 
				JOIN 
				`t_admin_departments` AS d ON (u.user_department_id = d.id) 
				JOIN 
				`t_admin_roles` AS r ON (u.user_role_id = r.id) 
				WHERE user_name=? AND user_password=? AND user_active = ? AND d.publish = ? AND r.publish = ? ";
		$prepareSql = $DBH->prepare($sql);
		$prepareSql->execute(array($userName,$hashpwd,'Y','Y','Y'));
		$prepareSql->setFetchMode(PDO::FETCH_ASSOC);
		$row = $prepareSql->fetch();
		return $row;
	}
	// Fetching all users list
	public function getAllUsersList()
	{
		global $DBH;
		$allUsersListInfo = array();
		$deptid = $_SESSION['department_id'];
		
		$sql = "SELECT u.*,r.role_name,d.department_name FROM 
				`tt_users` AS u 
				LEFT JOIN `t_admin_roles` AS r ON (u.user_role_id = r.id) 
				LEFT JOIN `t_admin_departments` AS d ON (u.user_department_id = d.id)  
				WHERE u.id != 1 AND admin_side_allowed = 1 ORDER BY u.id  DESC";
		
		$prepareSql = $DBH->prepare($sql);
		$prepareSql->execute();
		$prepareSql->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $prepareSql->fetch()){
			$allUsersListInfo[] = $row;	
		}
		return $allUsersListInfo;
	}
	// Fetching specific user information	
	public function getUserInfo($userID)
	{
		global $DBH;
		$sql = "SELECT u.*,d.department_name,r.role_name FROM 
				`tt_users` AS u 
				LEFT JOIN 
				`t_admin_departments` AS d ON (u.user_department_id = d.id)
				LEFT JOIN 
				`t_admin_roles` AS r ON (u.user_role_id = r.id) 
				WHERE u.id=?";
		$getUserDetails = $DBH->prepare($sql);
		$getUserDetails->execute(array($userID));
		$getUserDetails->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $getUserDetails->fetch()){
			$usersInfoArray[] = $row;	
		}
		return $usersInfoArray;
	}
	//	Activate or De-activate an user
	public function updateUserStatus($userId,$status){
		global $DBH;
		$updatesql = "update `tt_users` set active =? WHERE id = ? ";
		$prepareUpdatesql = $DBH->prepare($updatesql);
		if($status == 'activate'){
			$prepareUpdatesql -> execute(array('1',$userId));
		}else{
			$prepareUpdatesql -> execute(array('0',$userId));
		}
		echo "updated";		
	}		
	// Fetching all departments
	public function getAllDepartmentsInfo()
	{
		global $DBH;
		$results = array();
		$sql = "SELECT * FROM `t_admin_departments` WHERE publish = ? AND id > 1";
		$prepareSql = $DBH->prepare($sql);
		$prepareSql->execute(array('Y'));
		$prepareSql->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $prepareSql->fetch()){
			$results[] = $row;	
		}
		return $results;
	}	
	// Fetching specific department information
	public function getDepartmentInfo($deptName){
		global $DBH;
		$sql = "Select * FROM `t_admin_departments` WHERE department_name=? AND publish = ? ";
		$prepareSql = $DBH->prepare($sql);
		$prepareSql->execute(array($deptName,'Y'));
		$prepareSql->setFetchMode(PDO::FETCH_ASSOC);
		$row = $prepareSql->fetch();
		if($prepareSql->rowcount() > 0){
			return $row['id'];
		}		
	}	
	// Adding new department
	public function addNewDepartment($deptName){
		global $DBH;
		$createDate = date("Y-m-d h:i:s");
		$sql = "INSERT INTO `t_admin_departments`(`department_name`,`publish`,`created_by`,`created_date`,`modified_by`) VALUES(?,?,?,?,?) ";	
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($deptName,'Y',$_SESSION['user_id'],$createDate,$_SESSION['user_id']));
		$Dept_id = $DBH->lastInsertId();
		return $Dept_id;
	}
	// Deleting a department
	public function deleteDepartment($deptId){
		global $DBH;
		$sql = "DELETE FROM `t_admin_departments` WHERE id = ? ";	
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($deptId));
	}
	
	//To Delete Roles Based on Departments
	public function deleteRolesBasedOnDepartment($deptValue)
	{
		global $DBH;
		$results = array();
		$sql = "Select r.id as role_id,r.role_name,dra.department_id FROM t_admin_roles AS r 
					JOIN t_admin_departments_roles_assoc as dra ON (r.id = dra.role_id AND dra.department_id = ?) 
					WHERE r.publish = ? ";
		$prepareSql = $DBH->prepare($sql);
		$prepareSql->execute(array($deptValue,'Y'));
		$prepareSql->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $prepareSql->fetch())
		{
			$sql1 = "DELETE FROM `t_admin_roles` WHERE id = ? ";	
			$preparesql1 = $DBH->prepare($sql1);
			$preparesql1->execute(array($row['role_id']));
		}
	}
	
	// Fetching all roles
	public function getAllRolesInfo()
	{
		global $DBH;
		$results = array();
		$sql = "SELECT * FROM `t_admin_roles` WHERE publish = ? ";
		$prepareSql = $DBH->prepare($sql);
		$prepareSql->execute(array('Y'));
		$prepareSql->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $prepareSql->fetch()){
			$results[] = $row;	
		}
		return $results;
	}
	// Fetching roles belongs to the departments
	public function getRolesBasedOnDepartment($deptId,$roleId){
		global $DBH;
		$sql = "Select r.id as role_id,r.role_name FROM t_admin_roles AS r 
					JOIN t_admin_departments_roles_assoc as dra ON (r.id = dra.role_id AND dra.department_id =?) 
					WHERE r.publish = ?";
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($deptId,'Y'));
				if($preparesql->rowcount() > 0)
				{
					$html .= "<option value='0'>- Select Role -</option>";
					if($roleId == 1){
						$html .= "<option value='1' selected>Super Admin</option>";
					}else{
						while($row = $preparesql->fetch())
						{
							$html .= "<option value='".$row['role_id']."' ";
							if($roleId == $row['role_id']){
								$html .= "selected";
							}
							$html .= ">".$row['role_name']."</option>";
							$flag = 'filled';
						}
					}
				}
				else
				{ 
					$html = "<option value=''>-No roles found-</option>";
					$flag = '';
				}	
		echo $html.'~'.$flag;		
	}
	// Fetching specific department's roles
	public function getDepartmentRoles($deptId){
		global $DBH;
		$sql = "Select r.id as role_id,r.role_name FROM t_admin_roles AS r 
					JOIN t_admin_departments_roles_assoc as dra ON (r.id = dra.role_id AND dra.department_id =?) 
					WHERE r.publish = ?";
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($deptId,'Y'));
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $preparesql->fetch()){
			$results[] = $row;	
		}
		return $results;		
	}
	// Add new role based on department
	public function addNewRole($deptId,$roleName){
		global $DBH;
		$sql = "Select r.role_name FROM t_admin_roles AS r 
					JOIN t_admin_departments_roles_assoc as dra ON (r.id = dra.role_id AND dra.department_id =?) 
					WHERE r.role_name=? AND r.publish = 1";
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($deptId,$roleName));
		if($preparesql->rowcount() > 0){
			echo "empty|Role exist";		
		}else{
			$createDate = date("Y-m-d h:i:s");
			$sql = "INSERT INTO `t_admin_roles`(`role_name`,`publish`,`created_by`,`created_date`,`modified_by`) VALUES(?,?,?,?,?) ";	
			$preparesql = $DBH->prepare($sql);
			$preparesql->execute(array($roleName,'Y',$_SESSION['user_id'],$createDate,$_SESSION['user_id']));
			$roleId = $DBH->lastInsertId();
			
			$role_sql = "INSERT INTO `t_admin_departments_roles_assoc`(`role_id`,`department_id`,`created_by`,`created_date`,`modified_by`) VALUES(?,?,?,?,?)";	
			$prepareRolesql = $DBH->prepare($role_sql);
			$prepareRolesql->execute(array($roleId,$deptId,$_SESSION['user_id'],$createDate,$_SESSION['user_id']));
			
			$sql = "Select r.id as role_id,r.role_name FROM t_admin_roles AS r 
						JOIN t_admin_departments_roles_assoc as dra ON (r.id = dra.role_id AND dra.department_id =?) 
						WHERE r.publish = 1";
			$preparesql = $DBH->prepare($sql);
			$preparesql->execute(array($deptId));
			$preparesql->setFetchMode(PDO::FETCH_ASSOC);
					if($preparesql->rowcount() > 0)
					{
						$html .= "<option value='0'>- Select Role -</option>";
						while($row = $preparesql->fetch())
						{
							$html .= "<option value='".$row['role_id']."'";
							if($roleId == $row['role_id']){
								$html .= "selected";
							}
							$html .= ">".$row['role_name']."</option>";
						}
					}
					else
					{ 
						$html = "<option value=''>-No roles found-</option>";
					}	
			echo $html.'|inserted';
		}		
	}
	// Deleting a role
	public function deleteRole($roleID){
		global $DBH;
		$sql = "DELETE FROM `t_admin_roles` WHERE id = ? ";	
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($roleID));
	}
	// Check user email already exist
	public function checkEmail($email,$userid){
	global $DBH;
	if($userid>0){
		$sql = "SELECT * FROM `tt_users` WHERE user_email = ? AND user_active=? AND id != ?";
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($email,'Y',$userid));
	}else{
		$sql = "SELECT * FROM `tt_users` WHERE user_email = ? AND user_active=? ";
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($email,'Y'));
	}
	$count = $preparesql->rowcount();	
	echo $count;		
	}
	// Check user name already exist
	public function checkUserName($userName){
		global $DBH;
		$sql = "SELECT * FROM `tt_users` WHERE user_name = ? AND user_active=?";
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($userName,'Y'));
		$count = $preparesql->rowcount();	
		echo $count;		
	}
	// Add new user or update user information
	public function saveUserInfo($update_user_id,$user_first_name,$user_last_name,$pwd,$user_email,$user_phone,$user_type,$user_department,$user_role,$isallowed,$form_flag)
	{
		global $DBH;
		$created_date = date('Y-m-d H:i:s');
		
		$password = $this->MCrypt->decrypt($pwd);
	
		if($form_flag == 'Update'){
			
			$sql = "Update `tt_users` set 
								`first_name` = ?, 
								`last_name` = ?,";
			if(strlen($password) > 0 && ($password) != '*******'){
			$sql .= "			`password` = ?,";	
			}
			$sql .= "			`email` = ?, 
								`phone` = ?,
								`user_type` = ?,
								`user_department_id` = ?,
								`user_role_id` = ?,
								`admin_side_allowed` = ?,
								`updated_date` = ? 
								 WHERE id = ?";
			$updateUserInfo = $DBH->prepare($sql);
			$executeArray = array($user_first_name,$user_last_name);
			if(strlen($password) > 0 && $password != '*******'){ 
				array_push($executeArray,$pwd);
			}
			array_push($executeArray,$user_email,$user_phone,$user_type,$user_department,$user_role,$isallowed,$created_date,$update_user_id);
			$updateUserInfo->execute($executeArray);
			
			if($updateUserInfo)
			{
				return $status = 'updated';
			}
			
		}else{
			 $insertUserInfo = "INSERT INTO `tt_users` (`first_name`,`last_name`,`email`,`password`,`phone`,`user_type`,
									`user_department_id`,`user_role_id`,`active`,`admin_side_allowed`,`created_date`) 
					   	   			 VALUES (?,?,?,?,?,?,?,?,?,?,?)";
			
			$prepareInsert = $DBH->prepare($insertUserInfo);
			$prepareInsert->execute(array($user_first_name,$user_last_name,$user_email,$pwd,$user_phone,$user_type,
							$user_department,$user_role,'1',$isallowed,$created_date));		

			$insertedId = $DBH->lastInsertId();
			
			if($insertedId>0)
			{
				return $status = 'inserted';
			}
			
		}
	}	

	//Selecting privileges based on the role
	public function getUsersAllAccessPrivileges($roleID)
	{
		global $DBH;
//		$sql = "SELECT am.id,am.menu_name,am.menu_display_name,arp.page_access,arp.add_privilege, 
//				arp.edit_privilege,arp.delete_privilege FROM `t_admin_menus` AS am 
//				LEFT JOIN `t_admin_role_privilege` AS arp ON (am.id = arp.`menu_id`) WHERE arp.role_id = ?";
//		
//		$sql = 'SELECT am.id,am.menu_name,am.menu_display_name,am.`menu_parent_id`,
//				arp.page_access,arp.add_privilege, arp.edit_privilege,arp.delete_privilege,amp.menu_name AS parent_menu_name 
//				FROM `t_admin_menus` AS am LEFT JOIN `t_admin_role_privilege` AS arp ON (am.id = arp.`menu_id`) 
//				JOIN `t_admin_menus` AS amp ON (am.menu_parent_id = amp.id)
//				WHERE arp.role_id = ? AND am.`menu_parent_id` > 0 ORDER BY `am`.`order_id`,`am`.`id` ASC';
		
		$usersql = "SELECT * FROM t_admin_role_user_privilege WHERE user_id = ?";
		$userpreparesql = $DBH->prepare($usersql);
		$userpreparesql->execute(array($_SESSION['user_id']));
		if($userpreparesql->rowcount() > 0)
		{
			$sql2 = "SELECT id,menu_name,menu_display_name,publish FROM t_admin_menus 
							 WHERE menu_parent_id = ? AND id IN(
							 SELECT am.`id` FROM `t_admin_menus` am
							 JOIN `t_admin_role_user_privilege` arp ON(arp.`menu_id` = am.id)
							 WHERE arp.role_id = ?) ORDER BY order_id,menu_display_name ASC";
			$preparesql = $DBH->prepare($sql2);
			$preparesql->execute(array(0,$roleID));
			$preparesql->setFetchMode(PDO::FETCH_ASSOC);
			$i = 0;
			while($row = $preparesql->fetch())
			{
				$menuArray[$i]['Id'] = $row['id'];
				$menuArray[$i]['menuName'] = $row['menu_name'];
				$menuArray[$i]['menuDisplayName'] = $row['menu_display_name'];
				$menuArray[$i]['Publish'] = $row['publish'];
				
				$i++;	
			}			
		}else{

			$sql2 = "SELECT id,menu_name,menu_display_name,publish FROM t_admin_menus 
								 WHERE menu_parent_id = ? AND id IN(
								 SELECT am.`id` FROM `t_admin_menus` am
								 JOIN `t_admin_role_privilege` arp ON(arp.`menu_id` = am.id)
								 WHERE arp.role_id = ?) ORDER BY order_id,menu_display_name ASC";
			$preparesql = $DBH->prepare($sql2);
			$preparesql->execute(array(0,$roleID));
			$preparesql->setFetchMode(PDO::FETCH_ASSOC);
			$i = 0;
			while($row = $preparesql->fetch())
			{
				$menuArray[$i]['Id'] = $row['id'];
				$menuArray[$i]['menuName'] = $row['menu_name'];
				$menuArray[$i]['menuDisplayName'] = $row['menu_display_name'];
				$menuArray[$i]['Publish'] = $row['publish'];
				
				$i++;	
			}			
		}
		return $menuArray;
	}
	/**
	 * This method return the boolean value to check the email in the database.
	 */
	public function checkUserEmailExist($email)
	{
		global $DBH;
		$emailStatus = false;
		$sql = "SELECT * FROM `tt_users` WHERE email = ?  AND `active` =1";
		$res = $DBH->prepare($sql);
		$res->execute(array($email));
		$count = $res->rowCount();
		
		if($count > 0 )
		{
			$emailStatus = true;
		}
		return $emailStatus;
	}
}
?>