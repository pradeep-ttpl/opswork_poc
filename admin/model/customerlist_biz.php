<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: customerlist_biz.php
 * @version  	: 1.0
 * @date  		: 23-Jan-2014
 *
 * @description : customerlist business model file
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

class Customerlist_Model
{		
	public function __construct()
	{		
		$customerlistDAO = new Customerlist_DAO;
		$this->customerlistDAO = $customerlistDAO;
		
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
	}
	
	// Fetching all users list
	public function allCustomerlist()
	{
		$allCustomerlist = $this->customerlistDAO->allCustomerlist();
		return $allCustomerlist;		
	}
	// Fetching Customer Info
	public function customerInfo($customerId)
	{
		$customerInfo = $this->customerlistDAO->customerInfo($customerId);
		return $customerInfo;		
	}
	// Update Customer Status		
	public function updateCustomerInfo($customerId,$adminAccess){
		$updateCustomerInfo = $this->customerlistDAO->updateCustomerInfo($customerId,$adminAccess);
		return $updateCustomerInfo;
	}
}
?>