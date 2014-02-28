<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : prioryrsuspend_entity.php
 * @version  : 1.0
 * @date  : 20-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila                 20-Jul-2012           Initial Version - File Created
 * 
 */
class prioryrsuspend_DAO
{
		public function __construct()
		{	
		
		}
		
		//Adding the prior year suspended vehicle information in 'tt_filing_prior_suspended' Table
		public function addPriorYrSusDet($vin,$exceededMileage,$priorSoldorTrans,$buyer_name,$transSold_date,$filingid)
		{
			global $DBH;
			$createdDate = date("Y-m-d h:i:s");
			$chkVehiStatus = 'SELECT * FROM `tt_filing_prior_suspended` WHERE `vin` = ? AND `active` = ? AND `filing_id` = ?';
			$preparechkVehiStatus = $DBH->prepare($chkVehiStatus);
			$preparechkVehiStatus->execute(array($vin,1,$filingid));	
			$count = $preparechkVehiStatus->rowCount();	
			if($count == 0)
			{
				$insertprioryrsus = "INSERT INTO `tt_filing_prior_suspended`(`filing_id`,`vin`,`is_exceeded_mileage`,`is_vehicle_sold`,`sold_to_whom`,`sold_date`,`active`,`created_date`) 
						   	   		  VALUES (?,?,?,?,?,?,?,?)";		
				$prepareInsertpriorsus = $DBH->prepare($insertprioryrsus);
				$prepareInsertpriorsus->execute(array($filingid,$vin,$exceededMileage,$priorSoldorTrans,$buyer_name,$transSold_date,'1',$createdDate));		
	
				if($prepareInsertpriorsus)
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
		
		//Getting the all details of 'tt_filing_prior_suspended'
		public function PriorYrSusVehiInfo($userid,$filingid)
		{
			global $DBH;
			$prioryrvehicle = array();
			
			$sql = "select pr.id as preYrSpndId,pr.filing_id,pr.vin,pr.is_exceeded_mileage,pr.is_vehicle_sold,pr.sold_to_whom,pr.sold_date,pr.active,fm.id 
					from tt_filing_prior_suspended AS pr
					JOIN tt_filings AS fm ON (fm.id = pr.filing_id)
					where user_id = ?  AND fm.active = ? AND pr.active = ? AND pr.filing_id = ? order by preYrSpndId desc";
			$res = $DBH->prepare($sql);
			$res->execute(array($userid,'1','1',$filingid));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$prioryrvehicle[] = $row;
			}
			return $prioryrvehicle;
		}
		
		//Getting the details of prior year suspended vehicle based on the vin ID and TaxFilingId
		public function getpriorsuspendvehiDet($preYrSpndId)
		{
			global $DBH;
	
			$sql = "select tv.*,uv.licence_no from tt_filing_prior_suspended AS tv
					LEFT JOIN `tt_user_vehicles` AS uv ON (tv.vin = uv.vin)
					where tv.id = ? AND tv.`active` =1";
			
			$res = $DBH->prepare($sql);
			$res->execute(array($preYrSpndId));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$priorvehicle = $row;
			}
			
			return $priorvehicle;
			
		}
		
		//updating the prior year suspended vehicle details
		public function updatePriorYrSusVehiDetails($vin,$exceededMileage,$priorSoldorTrans,$transBuyerName,$transSold_date,$preYrSpndId)
		{
			global $DBH;
			
			$updatepriorInfo = "Update `tt_filing_prior_suspended` set `vin` = ?, `is_exceeded_mileage` = ?, `is_vehicle_sold` = ?, `sold_to_whom` = ?,
			 				  `sold_date` = ? WHERE id = ?";	
			$prepareupdateprior = $DBH->prepare($updatepriorInfo);
			$prepareupdateprior->execute(array($vin,$exceededMileage,$priorSoldorTrans,$transBuyerName,$transSold_date,$preYrSpndId));
			
			if($prepareupdateprior)
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
		public function deleteprioryrsuspend($preYrSpndId,$Vin)
		{ 
			global $DBH;
			$deleteql = 'UPDATE `tt_filing_prior_suspended` set active = ? WHERE `id` = ? AND `vin` = ?'; 
			$preparedeletesql = $DBH -> prepare($deleteql);
			$preparedeletesql -> execute(array('0',$preYrSpndId,$Vin));
		}
}
?>