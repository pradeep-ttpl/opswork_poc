<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : taxPayerBusiness_entity.php
 * @version  : 1.0
 * @date  : 12-Jul-2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           12-Jul-2012           Initial Version - File Created
 * 
 */

class Taxpayerbusiness_DAO
{		
	public function __construct()
	{	
		
	}	
	public function getBusinessDetails($user_id)
	{
		global $DBH;
		$results = array();	
		$sql = 'SELECT pb.*,bl.name as busType FROM `tt_user_business` pb,tt_business_type bl
				WHERE  pb.type = bl.id AND pb.`user_id` =? AND pb.active = 1 ORDER BY pb.modified_date desc';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($user_id));		
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$results[] = $result;
		}	
		return $results;
	}
	
	public function getFilingStatus($user_id)
	{
		global $DBH;
		$results = array();	
		$sql = 'SELECT fm.*,pb.ein,pb.name FROM  `tt_filings` AS fm JOIN `tt_user_business` AS pb ON pb.id = fm.biz_id WHERE  fm.user_id =? AND fm.active = 1 AND pb.`active` =1 ORDER BY fm.modified_date DESC ';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($user_id));		
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$results[] = $result;
		}	
		return $results;		
	}

	public function getFilingList($user_id)
	{
		global $DBH;
		$results = array();	
		$sql = "SELECT f.*, c.desc AS form,
				CASE
					WHEN (sch1_received=1 && irs_approved=1) THEN 'SCH1_RECEIVED'
					WHEN (ack_received=1 && irs_approved=1) THEN 'IRS_APPROVED'
					WHEN (ack_received=1 && irs_approved=0) THEN 'IRS_REJECTED'
					WHEN (ack_received=0 && xml_submitted=1) THEN 'APPROVAL_PENDING'
					WHEN (xml_submitted=0 && user_completed=1) THEN 'PENDING_SUBMISSION'
				ELSE 'INCOMPLETE'
				END as filing_status, b.ein, b.name 
				FROM `tt_filings` AS f 
				JOIN `tt_user_business` AS b ON b.id = f.biz_id 
				JOIN `tt_forms` AS c ON  f.form_type = c.type
				WHERE  f.user_id = ? AND f.active = 1 AND b.`active` =1 
				ORDER BY f.modified_date DESC ";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($user_id));		
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$results[] = $result;
		}	
		return $results;		
	}
	
	public function resetSubmissionData($filingId)
	{
		global $DBH;
		$sql = "UPDATE `tt_filings` SET submission_id = '', date_user_submitted = NULL, date_xml_sent = NULL, date_last_ack_attempt = NULL, date_acknowledged = NULL, 
				irs_approved = 0, ack_received = 0, xml_submitted = 0, consent_to_submit = 0, user_completed = 0 WHERE `id` = ?";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($filingId));
		return true;			
	}
	
	public function resetFilingErrorMsgs($filingId)
	{
		global $DBH;
		$sql = "UPDATE `tt_filings` SET error_description = NULL WHERE `id` = ?";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($filingId));
		return true;			
	}
			
	public function getFilingDetails($filingId)
	{
		global $DBH;
		$sql = 'SELECT tf.*, ty.id AS tax_year_id,ty.display_year, forms.desc FROM `tt_filings` AS tf
				JOIN tt_tax_year AS ty ON (tf.filing_year = ty.tax_year)
				JOIN `tt_forms` AS forms ON (tf.form_type = forms.type)
				WHERE  tf.id = ?  AND tf.active = 1';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($filingId));		
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql->fetch();
		return $result;		
	}
	
	//To delete business
	public function deletebusiness($businessid)
	{ 
		global $DBH;
		$deleteql = 'UPDATE `tt_user_business` set active = ? WHERE `id` = ?'; 
		$preparedeletesql = $DBH -> prepare($deleteql);
		$preparedeletesql -> execute(array('0',$businessid));
	}
	
	//To Delete tax return pending list
	public function deletetaxpendinglist($filingid)
	{ 
		global $DBH;
		$deleteql = 'UPDATE `tt_filings` set active = ? WHERE `id` = ? AND active = 1'; 
		$preparedeletesql = $DBH -> prepare($deleteql);
		$preparedeletesql -> execute(array('0',$filingid));
	}
	
	// get number of vehicles under filing
	public function getVehicleCount($filingId)
	{
		global $DBH;
		
		$sql = "( SELECT `vin`, '1' as 'recordtype' FROM `tt_filing_taxable_vehicle` WHERE `filing_id` = ? AND active = 1 ) UNION
				( SELECT `vin`, '2' as 'recordtype' FROM `tt_filing_current_suspended` WHERE `filing_id` = ? AND active = 1 ) UNION
				( SELECT `vin`, '3' as 'recordtype' FROM `tt_filing_prior_suspended` WHERE `filing_id` = ? AND active = 1 ) UNION
				( SELECT `vin`, '4' as 'recordtype' FROM `tt_filing_sold_destroyed` WHERE `filing_id` = ? AND active = 1 ) UNION
				( SELECT `vin`, '5' as 'recordtype' FROM `tt_filing_low_mileage` WHERE `filing_id` = ? AND active = 1 ) UNION
				( SELECT null as `vin`, '6' as 'recordtype' FROM `tt_filing_credit_overpayment` WHERE `filing_id` = ? AND active = 1 ) UNION
				( SELECT `vin`, '7' as 'recordtype' FROM `tt_filing_tgw_increase` WHERE `filing_id` = ? AND active = 1 ) UNION
				( SELECT `vin`, '8' as 'recordtype' FROM `tt_filing_exceeded_mileage_vehicle` WHERE `filing_id` = ? AND active = 1 )";
		
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($filingId, $filingId, $filingId, $filingId, $filingId, $filingId, $filingId, $filingId));
		$count = $preparesql ->rowCount();
		
		return $count;
	}
	
}
?>