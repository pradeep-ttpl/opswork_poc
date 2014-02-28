<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : menucontrolpanel_entity.php
 * @version  : 1.0
 * @date  : December 16, 2013
 *
 * @description :
 *
 * @author      : Raja Saravanan S R D
 *
 * History of modifications:
 *
 * Author               				 Date                 	 	Description of modifications
 * ----------           				 ------------         	    ------------------------------
 * Raja Saravanan S R D          	     December 16, 2013          Initial Version - File Created
 * 
 */ 
class Menucontrolpanel_DAO
{
	//Finding the order id
	public function getOrderId()
	{
		global $DBH;
		$sql = "SELECT max(`order_id`) as MaxOrderId FROM `t_admin_menus";
		$prepareSql = $DBH->prepare($sql);
		$prepareSql->execute(array());
		$prepareSql->setFetchMode(PDO::FETCH_ASSOC);
		$row = $prepareSql->fetch();
		return $row['MaxOrderId'];		
	}
	
	//Inserting New menu
	public function addNewmenu($menuName,$menuDisplayName,$menuParent,$menupublish,$menuorderId)
	{
		global $DBH;
		$date = date("Y-m-d H:i:s");
		$insertMenu = "INSERT INTO `t_admin_menus`
							 (`menu_name`,menu_display_name,`menu_parent_id`,`order_id`,`publish`,`created_by`,`created_date`)
							  VALUES (?,?,?,?,?,?,?)";
			$insertMenuDetails = $DBH->prepare($insertMenu);
			$insertMenuDetails->execute(array($menuName,$menuDisplayName,$menuParent,$menuorderId,$menupublish,$_SESSION['user_id'],$date));
			$menuId = $DBH->lastInsertId();
			
		if($_SESSION['user_id'] == 1)
		{
			$insertPrivilege = "INSERT INTO `t_admin_role_privilege`
						 (`menu_id`,role_id,`page_access`,`edit_privilege`,`created_by`,`created_date`)
						  VALUES (?,?,?,?,?,?)";
			$insertPrivilegeDetails = $DBH->prepare($insertPrivilege);
			$insertPrivilegeDetails->execute(array($menuId,$_SESSION['user_id'],'Y','Y',$_SESSION['user_id'],$date));
		}
	}
	
	//Updating menu details
	public function updatemenu($menuName,$menuDisplayName,$menuParent,$menuOrder,$menupublish,$menuId)
	{
		global $DBH;
		$date = date("Y-m-d H:i:s");
		$insertEnquirySpec = "UPDATE `t_admin_menus` SET `menu_name` = ?,menu_display_name = ?,`menu_parent_id` = ?,order_id = ? ,`publish` = ?,
								`modified_by` = ? WHERE id = ?";
			$insertEnquiryDetails = $DBH->prepare($insertEnquirySpec);
			$insertEnquiryDetails->execute(array($menuName,$menuDisplayName,$menuParent,$menuOrder,$menupublish,$_SESSION['user_id'],$menuId));
	}
	
	//Deleting a menu
	public function deleteMenu($menuId)
	{
		global $DBH;
		
		$sql = "DELETE FROM `t_admin_menus` WHERE id = ? OR menu_parent_id = ?";
		$deleteSql = $DBH->prepare($sql);
		$deleteSql->execute(array($menuId,$menuId));
		
		$sql = "DELETE FROM `t_admin_role_privilege` WHERE menu_id = ?";
		$deleteSql = $DBH->prepare($sql);
		$deleteSql->execute(array($menuId));
		
		$sql = "DELETE FROM `t_admin_role_user_privilege` WHERE menu_id = ?";
		$deleteSql = $DBH->prepare($sql);
		$deleteSql->execute(array($menuId));		

	}
}
?>