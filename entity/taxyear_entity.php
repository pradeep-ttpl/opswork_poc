<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : taxyear_entity.php
 * @version  : 1.0
 * @date  : 19-Jul-2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           19-Jul-2012           Initial Version - File Created
 * 
 */

class Taxyear_DAO
{		
	public function __construct()
	{	
		
	}	
	public function getTaxFilingYears()
	{
		global $DBH;
		$sql		= "SELECT * FROM  `tt_tax_year` WHERE active = ? AND form_type != ? ORDER BY `id` DESC ";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array(1,'8849S6'));	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$details[] = $result;
		}	
		return $details;
	}
	
	public function getTaxForms()
	{
		global $DBH;
		$sql		= "SELECT * FROM  `tt_forms`";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute();	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$details[] = $result;
		}	
		return $details;
	}
	
	public function getTaxFilingYearDetails($id)
	{
		global $DBH;
		$sql		= "SELECT * FROM `tt_tax_year` WHERE  `id` =?";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($id));	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql->fetch();
		return $result;		
	}
	public function insertTaxFilingYear($user_id, $business_id, $taxYear, $taxMonth, $finalReturn,$addresschange,$consent,$formType,$amendMentMonth,$earliestDateId,$latestDateId,$taxYearEndMonth)
	{
		global $DBH;
		
		/*
		// Check for filing year and month for the same business already exists
		$sql		= "SELECT * FROM `tt_filings` WHERE `user_id` = ? AND `biz_id` = ? AND `filing_year` = ? 
						AND `filing_month` = ? AND amended_month = ? AND `form_type` = ?  AND `final_return` = ?  AND `address_change` = ? AND `active` = 1 AND `user_completed` = 0";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($user_id,$business_id,$taxYear,$taxMonth,$amendMentMonth,$formType,$finalReturn,$addresschange));
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql->fetch();
		// If so return the existing id
		if($result['id'] > 0 )
		{
			return $result['id'];
		}
		else
		{
		*/
		 $createdDate = date("Y-m-d h:i:s");
		 $sql		= "INSERT INTO `tt_filings` (`id`, `user_id`, `biz_id`, `filing_year`, `filing_month`, `final_return`, 
						`address_change`,`consent_disclosure`, `is_third_party_designee`, `amended_month`, `earliest_date`,
						`latest_date`,`tax_year_end_month`,`form_type`,`payment_status`,`active`, `created_date`, `modified_date`) 
						 VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, '0', ?, ?, ?, ?, ?,'pending','1', ?, ?)";
		 
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($user_id, $business_id, $taxYear, $taxMonth, $finalReturn,$addresschange,$consent, 
					  $amendMentMonth, $earliestDateId,$latestDateId,$taxYearEndMonth,$formType,$createdDate,$createdDate));
		$filingID = $DBH->lastInsertId();	
		return $filingID;
		
	}
	
	public function updateConsentDiscloser($status,$filingid)
	{
		global $DBH;
		$sql		= "UPDATE `tt_filings` SET  `consent_disclosure` =  ? WHERE `id` = ?";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($status, $filingid));	
		return $executesql;
	}
	
	public function updateChanges($filingid,$finalReturn,$addressChange)
	{
		global $DBH;
		$sql		= "UPDATE `tt_filings` SET  `address_change` =  ?, final_return = ? WHERE `id` = ?";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($addressChange, $finalReturn, $filingid));	
		return $executesql;
	}
	
	//To get tax year details for 8849S6
	public function getTaxFilingYearList($formType)
	{
		global $DBH;
		$sql		= "SELECT * FROM `tt_tax_year` WHERE  `form_type` =? AND active =?";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($formType,'1'));	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql->fetch();
		return $result;		
	}
	//To get filing details for 8849S6
	public function getTaxFilingDetails($filingId)
	{
		global $DBH;
		$sql		= "SELECT * FROM `tt_filings` WHERE  `id` =? AND active = ?";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($filingId,'1'));	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql->fetch();
		return $result;		
	}
}
?>