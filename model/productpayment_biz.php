<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : productpayment_biz.php
 * @version  : 1.0
 * @date  : 18-Aug-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila         		 18-Aug-2012           Initial Version - File Created
 * 
 */

class Productpayment_Model
{		
	public function __construct()
	{		
		$productpaymentDAO = new Productpayment_DAO;
		$this->productpaymentDAO = $productpaymentDAO;
	}
	
	public function saveExtraFields()
	{	
		$filingId = $_SESSION['filingId'];
		$result = $this->productpaymentDAO->saveExtraFields($filingId);
		return $result;	
	}
	
	//get filing fee from tt_fee_plan_master table
	public function getfilingfee()
	{
		$filingId = $_SESSION['filingId'];
		$form_type = $_SESSION['formtype'];
		$result = $this->productpaymentDAO->getfilingfee($filingId, $form_type);
		return $result;
	}
	
	public function getUserInfo($filingId)
	{
		$result = $this->productpaymentDAO->getUserInfo($filingId);
		return $result;			
	}
	// Get discounts
//	public function getdiscounts()
//	{
//		$result = $this->productpaymentDAO->getdiscounts();
//		return $result;		
//	}
}