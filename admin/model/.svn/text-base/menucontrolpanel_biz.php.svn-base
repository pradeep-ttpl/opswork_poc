<?php
/******************************************************************************
 * File:        menucontrolpanel_biz.php
 * Version:     1
 * Authors:     Raja Saravanan S R D
 * Created:     16-December-2013
 * Language:    PHP
 * Project:     Simple Truck Tax
 * 
 * Copyright 2011-2012, all rights reserved.
 *
 * 
 */
class Menucontrolpanel_Model
{		
	public function __construct()
	{		
		$menuControlpanelDAO = new Menucontrolpanel_DAO;	
		$this->menuControlpanelDAO = $menuControlpanelDAO;
	}
	
	//Finding the order id
	public function getOrderId()
	{
		$orderId = $this->menuControlpanelDAO->getOrderId();
		return $orderId;
	}
	
	//Inserting new menu
	public function addNewmenu( $reqVars )
	{
		if($reqVars['menu_publish'] == 'yes')
		$publish = 'Y';
		else if($reqVars['menu_publish'] == 'no')
		$publish = 'N';
		
		$menuInfo = $this->menuControlpanelDAO->addNewmenu(trim($reqVars['menu_name']),trim($reqVars['menu_display_name']),
																$reqVars['menu_parent'],$publish,$reqVars['orderId']);
	}
	
	//Updating menu details
//	public function updatemenu( $reqVars )
//	{
//		if($reqVars['menu_publish'] == 'yes')
//		$publish = 'Y';
//		else if($reqVars['menu_publish'] == 'no')
//		$publish = 'N';
//		
//		$menuInfo = $this->menuControlpanelDAO->updatemenu(trim($reqVars['menu_name']),trim($reqVars['menu_display_name']),
//																$reqVars['menu_parent'],$reqVars['menu_order'],$publish,$reqVars['menuId']);
//	}
}
?>
