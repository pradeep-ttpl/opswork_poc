<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : fleet_entity.php
 * @version  : 1.0
 * @date  : 20-Nov-2013
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           20-Nov-2013           Initial Version - File Created
 * 
 */

class Fleet_DAO
{		
	public function __construct()
	{	
		
	}
	
	public function getUserFleets()
	{
		global $DBH;
		$results = array();	
		$sql = 'SELECT taxbiz.name,uv.*
				FROM `tt_user_vehicles` AS uv
				JOIN tt_user_business AS taxbiz ON(uv.business_id = taxbiz.id) 
				WHERE uv.user_id = ?  AND uv.active = ?  AND taxbiz.`active` =1 GROUP BY uv.id  ORDER BY id DESC';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($_SESSION['user_id'], "1"));
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$results[] = $result;
		}	
		return $results;
	}	
	
	public function addnewfleet($businessId,$licenceno, $vin, $taxableWeight, $logging)
	{
		global $DBH;
		$sql = 'INSERT INTO `tt_user_vehicles` (`business_id`, `licence_no`, `vin`, `weight_category`, `is_logging`, `user_id`, `active`) VALUES (?, ?, ?, ?, ?, ?, ?)';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($businessId,$licenceno, $vin, $taxableWeight, $logging, $_SESSION['user_id'], '1'));
		$count = $preparesql->rowCount();
		return $count;
	}
	
	public function getfleetdetails($vinid)
	{
		global $DBH;
		$sql = 'SELECT * FROM `tt_user_vehicles` WHERE id = ? AND `active` =1';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($vinid));
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql->fetch();
		return $result;
	}
	
	public function updatefleet($businessId,$licenceno, $vin, $taxableWeight, $logging, $vinid)
	{
		global $DBH;
		$sql = 'UPDATE `tt_user_vehicles` SET  `business_id` =  ?, `licence_no` =  ?, `vin` =  ?, `weight_category` =  ?, `is_logging` =  ? WHERE `id` = ?';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($businessId,$licenceno, $vin, $taxableWeight, $logging, $vinid));
		echo $count = $preparesql->rowCount();
		return $count;
	}
	
	public function deleteFleet($fleetid)
	{
		global $DBH;
		$deleteql = 'UPDATE `tt_user_vehicles` set active = ? WHERE `id` = ?'; 
		$preparedeletesql = $DBH -> prepare($deleteql);
		$preparedeletesql -> execute(array('0',$fleetid));		
	}
	
	public function getFleet($lno)
	{
		$results = array();
		global $DBH;
		$bizId = $_SESSION['selectedbusiness'];
		if(isset($_SESSION['admin_biz_id']) && $_SESSION['admin_biz_id'] > 0){
			$bizId = $_SESSION['admin_biz_id'];
		}
		$sql = "SELECT * FROM  `tt_user_vehicles` WHERE `licence_no` LIKE  ? AND business_id = ? AND `active` =1";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array("%".$lno."%", $bizId));
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$results[] = $result;
		}	
		
		return $results;
	}
	
	public function chkVehicleNickname($fleetNo,$businessId)
	{
		global $DBH;
		$sql = "SELECT id FROM tt_user_vehicles WHERE licence_no = ? AND business_id = ? AND active = ?";
		$chksql = $DBH->prepare($sql);
		$chksql->execute(array($fleetNo,$businessId,1));
		return $chksql->rowcount();	
	}
}

?>