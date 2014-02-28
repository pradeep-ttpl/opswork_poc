<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename : privilegemaster_entity.php
 * @version  : 1.0
 * @date  : 28-Feb-2013
 *
 * @description : Privilegemaster entity file
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

class Privilegemaster_DAO
{
	//Selecting all the roles related to the department				
	public function selectAllRoles($departmentID)
	{
		global $DBH;
		$sql = 'SELECT ar.role_name,ar.id FROM `t_admin_roles` ar
		JOIN t_admin_departments_roles_assoc adra ON(adra.role_id = ar.id) 
		WHERE ar.publish = 1 AND adra.department_id = ?';
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($departmentID));
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $preparesql->fetch())
		{
			$result[] = $row;
		}
		return $result;
	}
	
	//Selecting all the users related to the role				
	public function selectRoleUsers($roleID)
	{
		global $DBH;
		$result = array();
		
		$sql = 'SELECT au.first_name,au.last_name,au.id FROM `tt_users` au
				WHERE au.active = ? AND au.user_type = ? AND au.user_role_id = ?';
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array(1,1,$roleID));
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $preparesql->fetch())
		{
			$result[] = $row;
		}
		return $result;		
	}
	
	//Selecting all the parent menus
	public function selectParentMenus()
	{
		global $DBH;
		
		$sql = "SELECT id,menu_name,menu_display_name,publish FROM t_admin_menus WHERE menu_parent_id = ?";
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array(0));
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		$i = 0;
		while($row = $preparesql->fetch())
		{
			$menuArray[$i]['Id'] = $row['id'];
			$menuArray[$i]['menuName'] = $row['menu_name'];
			$menuArray[$i]['menuDisplayName'] = $row['menu_display_name'];
			$menuArray[$i]['Publish'] = $row['publish'];
			
			//check whether have childs
			$sql1 = "SELECT id,menu_name,menu_display_name,publish FROM t_admin_menus 
					 WHERE menu_parent_id = ? ORDER BY order_id ASC";
			$preparesql1 = $DBH->prepare($sql1);
			$preparesql1->execute(array($row['id']));
			$preparesql1->setFetchMode(PDO::FETCH_ASSOC);
			$menuArray[$i]['Childs'] = $preparesql1->rowcount();
			
			if($preparesql1->rowcount() > 0)
			{
				$j = 0;
				while($row1 = $preparesql1->fetch())
				{
					$menuArray[$i]['Child'][$j]['Id'] = $row1['id'];
					$menuArray[$i]['Child'][$j]['menuName'] = $row1['menu_name'];
					$menuArray[$i]['Child'][$j]['menuDisplayName'] = $row1['menu_display_name'];
					$menuArray[$i]['Child'][$j]['Publish'] = $row1['publish'];
					
					$sql2 = "SELECT id,menu_name,menu_display_name,publish FROM t_admin_menus 
							 WHERE menu_parent_id = ? ORDER BY order_id ASC";
					$preparesql2 = $DBH->prepare($sql2);
					$preparesql2->execute(array($row1['id']));
					$preparesql2->setFetchMode(PDO::FETCH_ASSOC);
					$menuArray[$i]['Child'][$j]['subChilds'] = $preparesql2->rowcount();
					
					if($preparesql2->rowcount() > 0)
					{
						$k = 0;
						while($row2 = $preparesql2->fetch())
						{
							$menuArray[$i]['Child'][$j]['subChild'][$k]['Id'] = $row2['id'];
							$menuArray[$i]['Child'][$j]['subChild'][$k]['menuName'] = $row2['menu_name'];
							$menuArray[$i]['Child'][$j]['subChild'][$k]['menuDisplayName'] = $row2['menu_display_name'];
							$menuArray[$i]['Child'][$j]['subChild'][$k]['Publish'] = $row2['publish'];
							
							$k++;
						}
					}
					
					$j++;
				}
			}
			
			$i++;	
		}
		//print_r($menuArray); die;
		return $menuArray;
	}
	
	//Selecting all the sub menus
	public function selectSubMenus($subMenuID)
	{
		global $DBH;
		$result = array();
		$sql = 'SELECT * FROM `t_admin_menus` WHERE `parent_id` = ?';
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($subMenuID));
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $preparesql->fetch())
		{
			$result[] = $row;
			
		}
		return $result;
	}
	
	//selecting the available menu list
	public function menuList()
	{
		global $DBH;
		$menuArray = array();
		$sql = "SELECT id,menu_name,menu_display_name,publish FROM t_admin_menus WHERE menu_parent_id = ?";
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array(0));
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		$i = 0;
		while($row = $preparesql->fetch())
		{
			$menuArray[$i]['Id'] = $row['id'];
			$menuArray[$i]['menuName'] = $row['menu_name'];
			$menuArray[$i]['menuDisplayName'] = $row['menu_display_name'];
			$menuArray[$i]['Publish'] = $row['publish'];
			
			//check whether have childs
			$sql1 = "SELECT id,menu_name,menu_display_name,publish FROM t_admin_menus 
					 WHERE menu_parent_id = ? ORDER BY order_id ASC";
			$preparesql1 = $DBH->prepare($sql1);
			$preparesql1->execute(array($row['id']));
			$preparesql1->setFetchMode(PDO::FETCH_ASSOC);
			$menuArray[$i]['Childs'] = $preparesql1->rowcount();
			
			if($preparesql1->rowcount() > 0)
			{
				$j = 0;
				while($row1 = $preparesql1->fetch())
				{
					$menuArray[$i]['Child'][$j]['Id'] = $row1['id'];
					$menuArray[$i]['Child'][$j]['menuName'] = $row1['menu_name'];
					$menuArray[$i]['Child'][$j]['menuDisplayName'] = $row1['menu_display_name'];
					$menuArray[$i]['Child'][$j]['Publish'] = $row1['publish'];
					
					$sql2 = "SELECT id,menu_name,menu_display_name,publish FROM t_admin_menus 
							 WHERE menu_parent_id = ? ORDER BY order_id ASC";
					$preparesql2 = $DBH->prepare($sql2);
					$preparesql2->execute(array($row1['id']));
					$preparesql2->setFetchMode(PDO::FETCH_ASSOC);
					$menuArray[$i]['Child'][$j]['subChilds'] = $preparesql2->rowcount();
					
					if($preparesql2->rowcount() > 0)
					{
						$k = 0;
						while($row2 = $preparesql2->fetch())
						{
							$menuArray[$i]['Child'][$j]['subChild'][$k]['Id'] = $row2['id'];
							$menuArray[$i]['Child'][$j]['subChild'][$k]['menuName'] = $row2['menu_name'];
							$menuArray[$i]['Child'][$j]['subChild'][$k]['menuDisplayName'] = $row2['menu_display_name'];
							$menuArray[$i]['Child'][$j]['subChild'][$k]['Publish'] = $row2['publish'];
							
							$k++;
						}
					}
					
					$j++;
				}
			}
			
			$i++;	
		}
		//print_r($menuArray); die;
		return $menuArray;
	}
	
	//Saving the privilege
	public function savePrivilege($privilegeArray,$role,$userID)
	{
		global $DBH;
		$createDate = date("Y-m-d h:i:s");
		if($userID > 0)
		{
			$deleteUsersql = 'DELETE FROM `t_admin_role_user_privilege` WHERE `user_id` = ?';
			$preparedeleteUsersql = $DBH->prepare($deleteUsersql);
			$preparedeleteUsersql ->execute(array($userID));
				
			foreach($privilegeArray as $value)
			{	
				if($value['menu_id'] != '')
				{
					$sql1 = 'INSERT INTO `t_admin_role_user_privilege`(`menu_id`,`role_id`,`user_id`,`page_access`,
							`edit_privilege`,`created_by`,`created_date`,`modified_by`) VALUES(?,?,?,?,?,?,?,?)';
					$preparesql = $DBH->prepare($sql1);
					$preparesql->execute(array($value['menu_id'],$role,$userID,$value['page_access'],$value['edit'],$_SESSION['user_id'],$createDate,$_SESSION['user_id']));
				}
			}
		}
		else 
		{
			$deletesql = 'DELETE FROM `t_admin_role_privilege` WHERE `role_id` = ?';
			$preparedeletesql = $DBH->prepare($deletesql);
			$preparedeletesql ->execute(array($role));
			
			foreach($privilegeArray as $value)
			{	
				if($value['menu_id'] != '')
				{
					$sql = 'INSERT INTO `t_admin_role_privilege`(`menu_id`,`role_id`,`page_access`,`edit_privilege`,`created_by`,`created_date`,`modified_by`) VALUES(?,?,?,?,?,?,?)';
					$preparesql = $DBH->prepare($sql);
					$preparesql->execute(array($value['menu_id'],$role,$value['page_access'],$value['edit'],$_SESSION['user_id'],$createDate,$_SESSION['user_id']));
				}
			}
		}
	}
	
	//selecting the sub parent ids of menus in menu_list table
	public function selectSubparent($greatParentID)
	{
		global $DBH;
		$result = array();
		$sql = 'SELECT group_concat(id) as SubparentIDs FROM `t_admin_menus` WHERE `menu_parent_id` = ? GROUP BY menu_parent_id';
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($greatParentID));
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);	
		$row = $preparesql->fetch();
		return $row['SubparentIDs'];	
	}
	
	//selecting the sub child ids of menus in menu_list table
	public function selectSubchild($ParentID)
	{
		global $DBH;
		$result = array();
		$sql = 'SELECT group_concat(id) as SubchildIDs FROM `t_admin_menus` WHERE `parent_id` = ? GROUP BY parent_id';
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($ParentID));
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);	
		$row = $preparesql->fetch();
		return $row['SubchildIDs'];	
	}
	
	//selecting the saved privileges
	public function savedPrivileges($selectedID,$SavedType,$roleID)
	{
		global $DBH;
		$result = array();
		if($SavedType == 'role')
		{
			$sql = 'SELECT arp.*,am.menu_parent_id FROM `t_admin_role_privilege` as arp, `t_admin_menus` as am
					WHERE arp.menu_id = am.id AND arp.role_id = ?';
			$preparesql = $DBH->prepare($sql);
			$preparesql->execute(array($selectedID));
		}
		else if($SavedType == 'user')
		{
			$totalCount = 1;
			if($selectedID > 0)
			{
				$sql = 'SELECT arup.*,am.menu_parent_id FROM `t_admin_role_user_privilege` AS arup 
						JOIN `t_admin_menus` AS am ON (arup.menu_id = am.id) 
						WHERE arup.user_id =?';
				
				$preparesql = $DBH->prepare($sql);
				$preparesql->execute(array($selectedID));
				$totalCount = $preparesql->rowcount();
			}
			
			if($selectedID == '' || $totalCount == 0)
			{
				$sql = 'SELECT arp.*,am.menu_parent_id FROM `t_admin_role_privilege` as arp, `t_admin_menus` as am
					WHERE arp.menu_id = am.id AND arp.role_id = ?';
				$preparesql = $DBH->prepare($sql);
				$preparesql->execute(array($roleID));
			}
		}
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $preparesql->fetch())
		{
			$greatParentSql = 'SELECT menu_parent_id FROM t_admin_menus WHERE id = ?';
			$preparesql1 = $DBH->prepare($greatParentSql);
			$preparesql1->execute(array($row['menu_parent_id']));
			$preparesql1->setFetchMode(PDO::FETCH_ASSOC);
			$greatparentSqlrow = $preparesql1->fetch();
			$greatParentId = $greatparentSqlrow['menu_parent_id'];
			
			$result[] = $row['menu_parent_id'].','.$row['menu_id'].','.$row['page_access'].','.$row['edit_privilege'].','.$greatParentId;
		}		
		$newResult = '';
		foreach($result as $value)
		{
			$newResult .= $value.'|';
		}		
		$newResult = substr($newResult,0,-1);
		return $newResult;
	}
}
?>
