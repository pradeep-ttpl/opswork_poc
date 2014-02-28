<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : addbusiness_entity.php
 * @version  : 1.0
 * @date  : 13-Jul-2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           13-Jul-2012           Initial Version - File Created
 * 
 */

class Addbusiness_DAO
{		
	public function __construct()
	{	
		
	}	
	public function getBusinessTypes()
	{
		global $DBH;
		$results = array();	
		$sql = 'SELECT * FROM  `tt_business_type`';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute();	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$results[] = $result;
		}	
		return $results;
	}
	
	public function getCountryList()
	{
		global $DBH;
		$results = array();	
		$sql = 'SELECT * FROM `tt_country_list`';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute();	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$results[] = $result;
		}	
		return $results;
	}
	
	public function selectEIN($einNo,$user_id)
	{
		global $DBH;
		$results = array();	
		$sql = 'SELECT id FROM `tt_user_business` WHERE user_id = ? AND ein = ? AND `active` =1';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($user_id,$einNo));	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		return $preparesql->rowCount();
	}
	
	// inserting into BizInfo table. 
	public function addBusinessInformation($businessName,$businessType,$ownerFirstName,$ownerLastName,$EINId,$bizAddress1,$bizAddress2,$businessCountry,$businessCity,$businessState,$businessZipcode,$businessPhone,$businessEmail,$sigingAuthorityName,$sigingAuthoritytitle,$sigingAuthorityPhone,$sigingAuthorityPin,$tPdName,$tPdPhone,$tPdPin,$user_id,$date)
	{
		global $DBH;
		
		$chkBusiness = 'SELECT * FROM `tt_user_business` WHERE `name` = ? AND `user_id` = ? AND `active` = ?';
		$preparechkBusiness = $DBH->prepare($chkBusiness);
		$preparechkBusiness->execute(array($businessName,$user_id,1));	
		$count = $preparechkBusiness->rowCount();	
		
		if($count == 0)
		{
			$sql = "INSERT INTO `tt_user_business` (`user_id`,`ein`,`type`,`name`,`owner_first_name`,`owner_last_name`,`address1`,`address2`,`city`,`state_id`,`country_id`,
					`zipcode`,`phone`,`email`,`siging_authority_name`,`siging_authority_title`,`siging_authority_phone`,`siging_authority_pin`,`third_party_designee_name`,
					`third_party_designee_phone`,`third_party_designee_pin`,`created_date`,`active`) 
					 VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$prepareInsertBiz = $DBH->prepare($sql);
			$prepareInsertBiz->execute(array($user_id,$EINId,$businessType,$businessName,$ownerFirstName,$ownerLastName,$bizAddress1,$bizAddress2,$businessCity,
								$businessState,$businessCountry,$businessZipcode,$businessPhone,$businessEmail,$sigingAuthorityName,$sigingAuthoritytitle,
								$sigingAuthorityPhone,$sigingAuthorityPin,$tPdName,$tPdPhone,$tPdPin,$date,'1'));	

			if($prepareInsertBiz)
			{
				$status = 'inserted';
			}
			else
			{
				$status = 'not_inserted';
			}
		}
		else 
		{
			$status = 'already_exists';
		}
			
		return $status;	
		
	}
	public function getUsersBusinessInfo($user_id,$bizId)
	{
		global $DBH;
		$details =array();
		$sql = "SELECT biz.*, st.`state_name`, ct.`country_name` FROM `tt_user_business` AS biz 
				JOIN `tt_state_list` AS st ON (biz.`state_id` = st.`id`) 
				JOIN `tt_country_list` AS ct ON(biz.`country_id` = ct.`id`)
				WHERE biz.`user_id` = ? AND biz.`id` = ? AND biz.`active` =1";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($user_id,$bizId));	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$details = $result;
		}	
		
		return $details;
	}
	//update into BizInfo table. 
	public function updateBusinessInfo($bizId,$user_id,$bizName,$bizType,$ownerFirstName,$ownerLastName,$bizEIN,$bizAddress1,$bizAddress2,$bizCountry,$bizselectState,$bizCity,$bizZip,$bizPhone,$bizEmail,$sigingAuthorityName,$sigingAuthoritytitle,$sigingAuthorityPhone,$sigingAuthorityPin,$tPdName,$tPdPhone,$tPdPin,$date,$modified_by)
	{
		global $DBH;
		
		$sql = "UPDATE `tt_user_business` SET `name` = ?, `ein`= ?, `type`= ?, `owner_first_name`=?, `owner_last_name`= ?,`address1`= ?,`address2` = ?,
				`city`= ?, `state_id`= ?, `zipcode`= ?, `country_id`= ?, `phone`= ?, `email`=? ,`siging_authority_name`= ?, `siging_authority_title`= ?, 
				`siging_authority_phone`= ?,`siging_authority_pin` = ?,`third_party_designee_name`=?,`third_party_designee_phone`=?,`third_party_designee_pin`=?, 
				`modified_by`=?  
				 WHERE `user_id`= ? AND `id`= ?";
		
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($bizName,$bizEIN,$bizType,$ownerFirstName,$ownerLastName,$bizAddress1,$bizAddress2,$bizCity,$bizselectState,$bizZip,$bizCountry,
					 		$bizPhone,$bizEmail,$sigingAuthorityName,$sigingAuthoritytitle,$sigingAuthorityPhone,$sigingAuthorityPin,$tPdName,
							$tPdPhone,$tPdPin,$modified_by,$user_id,$bizId));
		if($preparesql)
		{
			$status = 'updated';
		}
		else
		{
			$status = 'not_updated';
		}
		
		return $status;
		
	}
	public function getstate()
	{
		global $DBH;
		$sql = "select * from tt_state_list";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute();	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$details[] = $result;
		}	
		return $details;
	}
	
	//Selecting all states
	public function selectStates($countryID)
	{
		global $DBH;
		$sql = "SELECT * FROM tt_state_list WHERE `country_id` = ?";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($countryID));	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$details[] = $result;
		}	
		return $details;
	}
}

?>