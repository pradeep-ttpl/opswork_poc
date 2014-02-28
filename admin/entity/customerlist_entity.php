<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 		: customerlist_entity.php
 * @version  		: 1.0
 * @date  			: 23-Jan-2014
 *
 * @description 	: customerlist entity file
 *
 * @author      	: Raja Saravanan
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Raja Saravanan        23-Jan-2014           Initial Version - File Created
 * 
 */

class Customerlist_DAO
{
	// Fetching all customer list
	public function allCustomerlist()
	{
		global $DBH;
		$allCustomerlist = array();
		$sql = "SELECT ttu.id,ttu.first_name,ttu.last_name,ttu.email,ttu.phone,
				SUM(CASE WHEN ttf.user_completed = 0 AND ttf.active = 1 THEN 1 ELSE 0 END) partialFilings,
				SUM(CASE WHEN ttf.user_completed = 1 AND ttf.active = 1 THEN 1 ELSE 0 END) completedFilings,
				temp.latest_login
				FROM tt_users ttu 
				LEFT JOIN tt_filings ttf ON (ttu.id = ttf.user_id)
				LEFT JOIN (SELECT `user_id`,max(`log_time`) as latest_login FROM `tt_user_login_log` WHERE `log_status` = 'login' group by user_id)
				AS temp ON(ttf.user_id = temp.user_id)
				WHERE ttu.admin_side_allowed != ? AND ttu.active = ? GROUP BY ttf.user_id";
		$prepareSql = $DBH->prepare($sql);
		$prepareSql->execute(array(1,1));
		$prepareSql->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $prepareSql->fetch()){
			$allCustomerlist[] = $row;	
		}
		return $allCustomerlist;
	}
	
	// Fetching customer info
	public function customerInfo($customerId)
	{
		global $DBH;
		$customerInfo = array();
		$sql = "SELECT * FROM tt_users WHERE admin_side_allowed != ? AND active = ? AND id = ? ";
		$prepareSql = $DBH->prepare($sql);
		$prepareSql->execute(array(1,1,$customerId));
		$prepareSql->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $prepareSql->fetch()){
			$customerInfo = $row;	
		}
		return $customerInfo;
	}
	//Update customer status
	public function updateCustomerInfo($customerId,$adminAccess){
		global $DBH;

		$sql = "UPDATE tt_users SET admin_side_allowed = ?, updated_date = ? WHERE active = ? AND id = ? ";
		$prepareSql = $DBH->prepare($sql);
		$prepareSql->execute(array($adminAccess,date('Y-m-d H:i:s'),1,$customerId));
		
		$status = 'failed';
		if($prepareSql)
		{
			$status = 'updated';
		}
		
		return $status;
	}
}
?>