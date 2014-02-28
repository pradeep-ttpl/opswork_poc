<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : productpayment_entity.php
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

class Productpayment_DAO
{		
	public function __construct()
	{	
		
	}
	
	// update business information to filings_extra_fields to have unchanged data
	public function saveExtraFields($filingid)
	{
		global $DBH;
		
		$sql = "SELECT * FROM  `tt_release_versions` ORDER BY  `release_date` DESC LIMIT 1";
		$preparesql	= $DBH->prepare($sql);
		$preparesql->execute();		
		$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql ->fetch();
		$version_name = $result['version_name'];		
		
		$chkVehiStatus = 'SELECT * FROM `tt_filings_extra_fields` WHERE `filing_id` = ?';
		$preparechkVehiStatus = $DBH->prepare($chkVehiStatus);
		$preparechkVehiStatus->execute(array($filingid));	
		$count = $preparechkVehiStatus->rowCount();	
		
		if($count == 0)
		{	
			$sql = "INSERT INTO `tt_filings_extra_fields` (`filing_id`, `ein`, `type`, `name`, `owner_first_name`, `owner_last_name`, `address1`, `address2`, `city`, `state_id`, `country_id`, `zipcode`, `phone`, `email`, `siging_authority_name`, `siging_authority_title`, `siging_authority_phone`, `siging_authority_pin`, `third_party_designee_name`, `third_party_designee_phone`, `third_party_designee_pin`, `software_version`)
					SELECT fs.`id`, ub.`ein`, ub.`type`, ub.`name`, ub.`owner_first_name`, ub.`owner_last_name`, ub.`address1`, ub.`address2`, ub.`city`, ub.`state_id`, ub.`country_id`, ub.`zipcode`, ub.`phone`, ub.`email`, ub.`siging_authority_name`, ub.`siging_authority_title`, ub.`siging_authority_phone`, ub.`siging_authority_pin`, ub.`third_party_designee_name`, ub.`third_party_designee_phone`, ub.`third_party_designee_pin`, ?
					  FROM `tt_filings` AS fs 
					  JOIN `tt_user_business` AS ub
					  ON (fs.biz_id = ub.id) 
					WHERE fs.`id` = ?";
			$preparesql	= $DBH->prepare($sql);
			$preparesql->execute(array($version_name, $filingid));
		}
		else 
		{
			$sql = "UPDATE `tt_filings_extra_fields` AS ef
			INNER JOIN
			(
				SELECT fs.`id`, ub.`ein`, ub.`type`, ub.`name`, ub.`owner_first_name`, ub.`owner_last_name`, ub.`address1`, ub.`address2`, ub.`city`, ub.`state_id`, ub.`country_id`, ub.`zipcode`, ub.`phone`, ub.`email`, ub.`siging_authority_name`, ub.`siging_authority_title`, ub.`siging_authority_phone`, ub.`siging_authority_pin`, ub.`third_party_designee_name`, ub.`third_party_designee_phone`, ub.`third_party_designee_pin` 
				  FROM `tt_filings` AS fs 
				  JOIN `tt_user_business` AS ub
				  ON (fs.biz_id = ub.id) 
				WHERE fs.`id` = ?
			) AS ov ON ef.filing_id = ov.id
			SET ef.`ein` = ov.`ein`, ef.`type` = ov.`type`, ef.`name` = ov.`name`, ef.`owner_first_name` = ov.`owner_first_name`, ef.`owner_last_name` = ov.`owner_last_name`, 
			ef.`address1` = ov.`address1`, ef.`address2` = ov.`address2`, ef.`city` = ov.`city`, ef.`state_id` = ov.`state_id`, ef.`country_id` = ov.`country_id`, 
			ef.`zipcode` = ov.`zipcode`, ef.`phone` = ov.`phone`, ef.`email` = ov.`email`, ef.`siging_authority_name` = ov.`siging_authority_name`, 
			ef.`siging_authority_title` = ov.`siging_authority_title`, ef.`siging_authority_phone` = ov.`siging_authority_phone`, 
			ef.`siging_authority_pin` = ov.`siging_authority_pin`, ef.`third_party_designee_name` = ov.`third_party_designee_name`, 
			ef.`third_party_designee_phone` = ov.`third_party_designee_phone`, ef.`third_party_designee_pin` = ov.`third_party_designee_pin`, 
			ef.`software_version` = ?";
			$preparesql	= $DBH->prepare($sql);
			$preparesql->execute(array($filingid, $version_name));
		}
		return true;			
	}
	
	
	//get filing fee from tt_fee_plan_master table
	public function getfilingfee($filingId, $form_type)
	{
		global $DBH;
		$result = array();
		$sql = "SELECT * FROM `view_filing_vehicles` WHERE `filing_id` = ?";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($filingId));
		$count = $preparesql ->rowCount();

		/*
		$result = array();
		$sql = "SELECT * FROM `tt_fee_plan_master` WHERE `form_type` = ? AND   `from_vehicle` <= ? AND  `to_vehicle` >= ? AND `active` = ?";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($form_type, $count, $count, "1"));
		$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql ->fetch(); 
		*/
		
		$sql = "select a.fee, ifnull( b.paid, 0 ) as paid, a.fee-ifnull( b.paid, 0 ) as diff from  
				(SELECT fee FROM `tt_fee_plan_master` WHERE `form_type` = ? AND   `from_vehicle` <= ? AND  `to_vehicle` >= ? AND `active` = 1)  a left join  (
				SELECT filing_id, sum( amount ) as paid
				FROM `tt_user_transactions`
				WHERE filing_id = ?
				AND active =1
				AND payment_status = 'success'
				GROUP BY filing_id) b on (b.filing_id= ?)";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($form_type, $count, $count, $filingId, $filingId));
		$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
		$filing_fee = $preparesql ->fetch();
		$filing_fee['vehicle_count'] = $count;

		return $filing_fee;
	}
	
	// Get discounts
//	public function getdiscounts()
//	{
//		global $DBH;
//		$result = array();
//		$discounts = array();
//		
//		$sql = "SELECT * FROM  `TT_Filing_Discount` WHERE active =  '1' ORDER BY `discount_avail` ASC";
//		$preparesql = $DBH -> prepare($sql);
//		$preparesql -> execute(array($count, $count));
//		$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
//		while($result = $preparesql ->fetch())
//		{
//			$discounts[] = $result;
//		}
//		
//		return $discounts;
//	}
	
	// get discount details
	public function getDiscountDetails($discountID)
	{
		global $DBH;
		$result = array();
		$discounts = array();
		
		$sql = "SELECT * FROM  `TT_Filing_Discount` WHERE discount_id = ?";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($discountID));
		$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql ->fetch();
		
		return $result;		
	}
	
	// Insert transaction details
	public function initiatePayment($voucherNo,$filingAmount)
	{
		$user_id = $_SESSION['user_id'];
		$filingId = $_SESSION['filingId'];
		global $DBH;
		$sql = "INSERT INTO `tt_user_transactions` (`user_id`, `filing_id`, `voucher_no`, `amount`,`created_date`,created_by,`active`) 
		VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP, ?, ?)";
		$preparesql	= $DBH->prepare($sql);
		$preparesql->execute(array($user_id, $filingId, $voucherNo, $filingAmount,$user_id,1));
		$insertedId = $DBH->lastInsertId();
		echo $insertedId;		
	}
	
	public function getUserInfo($filingId)
	{
		global $DBH;
		$result = array();
		
		$sql = "SELECT ts.first_name, ts.email, ub.phone FROM  `tt_user_business` ub 
				JOIN  `tt_filings` tf ON ( ub.id = tf.biz_id ) 
				JOIN  `tt_users` ts ON ( tf.user_id = ts.id ) WHERE tf.`id` = ?";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($filingId));
		$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql ->fetch();
		
		return $result;		
	}
}
?>