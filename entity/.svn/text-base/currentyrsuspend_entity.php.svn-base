<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : currentyrsuspend_entity.php
 * @version  : 1.0
 * @date  : 18-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila         		 18-Jul-2012           Initial Version - File Created
 * 
 */

class Currentyrsuspend_DAO
{
	public function __construct()
	{	
	
	}
	//Inserting into tt_filing_current_suspended table
	public function addCurrentsuspend($vin,$logcurrent,$agrivehicle,$filingid,$createdBy)
	{
		global $DBH;
		$createdDate = date("Y-m-d h:i:s");
		$chkVehiStatus = 'SELECT * FROM `tt_filing_current_suspended` WHERE `vin` = ? AND `active` = ? AND `filing_id` = ?';
		$preparechkVehiStatus = $DBH->prepare($chkVehiStatus);
		$preparechkVehiStatus->execute(array($vin,1,$filingid));	
		$count = $preparechkVehiStatus->rowCount();	
		if($count == 0)
		{
			$suspendVehiInfo = "INSERT INTO `tt_filing_current_suspended` (`filing_id`,`vin`,`is_logging`,`is_agriculture`,`active`,`created_date`,`created_by`) 
					   	        VALUES (?,?,?,?,?,?,?)";		
			$prepareSuspendVehiInfo = $DBH->prepare($suspendVehiInfo);
			$prepareSuspendVehiInfo->execute(array($filingid,$vin,$logcurrent,$agrivehicle,'1',$createdDate,$createdBy));
			
			if($prepareSuspendVehiInfo)
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
	
	//getting records fromtt_filing_current_suspended table
	public function CurrentsuspendInfo($userid,$filingid)
	{
		global $DBH;
		$suspendvehicle = array();
		$sql = "select sp.id as crntYrSpndId,sp.filing_id,sp.vin,sp.is_logging,sp.is_agriculture,sp.active,fm.id,fm.user_id
		        from tt_filing_current_suspended AS sp
				JOIN tt_filings AS fm ON (fm.id = sp.filing_id)
				where fm.user_id = ?  AND fm.active = 1 AND sp.active = ? AND sp.filing_id = ? order by crntYrSpndId desc";
		$res = $DBH->prepare($sql);
		$res->execute(array($userid,'1',$filingid));
		$res->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $res->fetch())
		{
			$suspendvehicle[] = $row;
		}
		
		return $suspendvehicle;
		
	}
	
	//edit
	public function editCurrentsuspend($crntYrSpndid)
	{			
		global $DBH;
		$sql = "select tv.*,uv.licence_no from tt_filing_current_suspended AS tv
			LEFT JOIN `tt_user_vehicles` AS uv ON (tv.vin = uv.vin AND tv.is_logging = uv.is_logging)
			where tv.id = ?  AND tv.`active` =1";
		$res = $DBH->prepare($sql);
		$res->execute(array($crntYrSpndid));
		$res->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $res->fetch())
		{
			$suspendvehicle = $row;
		}
		
		return $suspendvehicle;
	}
	
	//update
	public function updateCurrentsuspend($crntYrSpndid,$vin,$logging,$FarmingAgriculture,$modifiedBy)
	{	
		global $DBH;
		
		$updatesuspendvehicle = "Update `tt_filing_current_suspended` set `vin` = ?,`is_logging` = ?, `is_agriculture` = ?, `modified_by` = ?
			 				  	 WHERE id = ?";	
		$prepareupdatesuspend = $DBH->prepare($updatesuspendvehicle);
		$prepareupdatesuspend->execute(array($vin,$logging,$FarmingAgriculture,$modifiedBy,$crntYrSpndid));
		
		if($prepareupdatesuspend)
		{
			$status = 'updated';
		}
		else
		{
			$status = 'not_updated';
		}
		return $status;

	}
	//delete
	public function deleteSuspendVehicle($crntYrSpndId,$vin)
	{
		global $DBH;
		$deleteql = 'UPDATE `tt_filing_current_suspended` set active = ? WHERE `id` = ? AND `vin` = ?'; 
		$preparedeletesql = $DBH -> prepare($deleteql);
		$preparedeletesql -> execute(array('0',$crntYrSpndId,$vin));
	}
}
?>