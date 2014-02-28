<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: customerlist_controller.php
 * @version  	: 1.0
 * @date  	 	: 23-Jan-2014
 *
 * @description : customerlist controller file
 *
 * @author      : Raja Saravanan
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Raja Saravanan        23-Jan-2014           Initial Version - File Created
 * 
 */


class Customerlist_Controller
{	
	public $template = 'customerlist';
	
	public function main( array $reqVars )
	{	
		$customerModel 	= new Customerlist_Model;	// Create Object for User_Model Class
		$MCrypt	= new MCrypt;
		
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		
		if(isset($parsed[3]) && $parsed[3] == 'changestatus')
		{	
			// Get all customer list
			if(isset($parsed[4])){
				$customerId = $MCrypt->decrypt($parsed[4]);
			}
			$customerInfo = $customerModel->customerInfo($customerId);
			$this->template = 'changestatus';
						
		}else if(isset($reqVars['Update'])){
			
			$customerId		= $reqVars['customerId'];
			$adminAccess 	= 0;
			if($reqVars['admin_access'] == 'on'){
				$adminAccess = 1;	
			}
			$customerInfo = $customerModel->updateCustomerInfo($customerId,$adminAccess);
			$_SESSION['customerUpdateMsg'] = $customerInfo;
			header( 'Location: '.TT_ADMIN_SITE_NAME.'customerlist' );
			exit();
		}else{
			// Get all customer list
			$allCustomerlist = $customerModel->allCustomerlist();
		}
		$tpl = new Template_Model($this->template);
		$tpl ->assign('allCustomerlist',$allCustomerlist);
		if(isset($customerInfo)){
			$tpl ->assign('customerInfo',$customerInfo);
		}
	}		
}
?>
