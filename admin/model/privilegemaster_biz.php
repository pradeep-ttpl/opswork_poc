<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename : privilegemaster_biz.php
 * @version  : 1.0
 * @date  : 28-Feb-2013
 *
 * @description : Privilegemaster business model file
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

class Privilegemaster_Model
{
	public function __construct()
	{		
		
		$privilegeDAO = new Privilegemaster_DAO;
		$this->privilegeDAO = $privilegeDAO;
	}
	
	//Selecting all the roles related to the selected department
	public function selectAllRoles($departmentID)
	{
		$selectRoles = $this->privilegeDAO->selectAllRoles($departmentID);
		return $selectRoles;
	}
	
	//Selecting all the users related to the selected role
	public function selectRoleUsers($roleID)
	{
		$selectRoleUsers = $this->privilegeDAO->selectRoleUsers($roleID);
		return $selectRoleUsers;
	}
	
	//selecting all the parent menus
	public function selectParentMenus()
	{
		$selectparentMenus = $this->privilegeDAO->selectParentMenus();		
		return $selectparentMenus;
	}
	
	//selecting all the sub menus
	public function selectSubMenus($subMenuID)
	{
		$selectsubMenus = $this->privilegeDAO->selectSubMenus($subMenuID);		
		return $selectsubMenus;
	}
	
	//selecting all the reports
	public function selectReports($subMenuID)
	{
		$selectReports = $this->privilegeDAO->selectReports($subMenuID);		
		return $selectReports;
	}
	
	//selecting the available menu list
	public function menuList($reqVars)
	{
		$menuList = $this->privilegeDAO->menuList();
		$i = 0;
		$privilegeArray = array();
		foreach($menuList as $key => $values)
		{
			if($values['Childs'] > 0)
			{
				foreach($values['Child'] as $values1)
				{
					if($values1['subChilds'] > 0)
					{
						foreach($values1['subChild'] as $value2)
						{
							if(isset($reqVars[$value2['Id'].'_child']) && $reqVars[$value2['Id'].'_child'] == 'on')
							{
								$privilegeArray[$i]['menu_id'] = $value2['Id'];
									
								if(isset($reqVars[$value2['Id'].'_view']))
								$privilegeArray[$i]['page_access'] = 'Y';
								else 
								$privilegeArray[$i]['page_access'] = 'N';								
								
								if(isset($reqVars[$value2['Id'].'_edit']))
								$privilegeArray[$i]['edit'] = 'Y';
								else 
								$privilegeArray[$i]['edit'] = 'N';
								
								$i++;
							}
						}
					}
					else
					{
						if(isset($reqVars[$values1['Id'].'_parent']) && $reqVars[$values1['Id'].'_parent'] == 'on')
						{
							$privilegeArray[$i]['menu_id'] = $values1['Id'];
									
							if(isset($reqVars[$values1['Id'].'_view']))
							$privilegeArray[$i]['page_access'] = 'Y';
							else 
							$privilegeArray[$i]['page_access'] = 'N';								
							
							if(isset($reqVars[$values1['Id'].'_edit']))
							$privilegeArray[$i]['edit'] = 'Y';
							else 
							$privilegeArray[$i]['edit'] = 'N';
							
							$i++;
						}
					}
				}
			}	
			else 
			{
				if(isset($reqVars[$values['Id'].'_greatparent']) && $reqVars[$values['Id'].'_greatparent'] == 'on')
				{
					$privilegeArray[$i]['menu_id'] = $values['Id'];
									
					if(isset($reqVars[$values['Id'].'_view']))
					$privilegeArray[$i]['page_access'] = 'Y';
					else 
					$privilegeArray[$i]['page_access'] = 'N';								
					
					if(isset($reqVars[$values['Id'].'_edit']))
					$privilegeArray[$i]['edit'] = 'Y';
					else 
					$privilegeArray[$i]['edit'] = 'N';
					
					$i++;
				}
			}	
		}	
		return $privilegeArray;
	}
	
	//saving the privilege
	public function savePrivilege($privilegeArray,$role,$userID)
	{
		$savePrivilege = $this->privilegeDAO->savePrivilege($privilegeArray,$role,$userID);	
		return $savePrivilege;
	}
}
?>