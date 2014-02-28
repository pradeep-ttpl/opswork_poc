 <?php
/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: exceededmileage_entity.php
 * @version  	: 1.0
 * @date  	 	: 26-Dec-2013
 *
 * @description : Exceededmileage entity file
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        26-Dec-2013           Initial Version - File Created
 * 
 */

 
class Exceededmileage_DAO
{
		public function __construct()
		{	
			
		}
		
		//Inserting into tt_filing_exceeded_mileage_vehicle table
		public function insertExceededMileageVehiInfo($vin,$loggingInfo,$taxableGrossweight,$taxAmount,$filingid,$createdBy)
		{
			global $DBH;
			$createdDate = date("Y-m-d h:i:s");
			$chkVehiStatus = 'SELECT * FROM `tt_filing_exceeded_mileage_vehicle` WHERE `vin` = ? AND `active` = ? AND `filing_id` = ?';
			$preparechkVehiStatus = $DBH->prepare($chkVehiStatus);
			$preparechkVehiStatus->execute(array($vin,1,$filingid));	
			$count = $preparechkVehiStatus->rowCount();	
			
			if($count == 0)
			{
				$insertExceededMileageVehiInfo = "INSERT INTO `tt_filing_exceeded_mileage_vehicle` (`filing_id`,`vin`,`is_logging`,`weight_category`,`tax_amount`,`created_date`,`created_by`,`active`) 
						   	   VALUES (?,?,?,?,?,?,?,?)";		
				
				$prepareInsertExceededMileageVehiInfo = $DBH->prepare($insertExceededMileageVehiInfo);
				$prepareInsertExceededMileageVehiInfo->execute(array($filingid,$vin,$loggingInfo,$taxableGrossweight,$taxAmount,$createdDate,$createdBy,'1'));		
			
				if($prepareInsertExceededMileageVehiInfo)
				{
					$status = 'Uploaded successfully';
				}
				else
				{
					$status = 'Failed to upload';
				}
			}
			else 
			{
				$status = 'VIN Number already exist';
			}
			return $status;
		}
		
		//getting records from tt_filing_exceeded_mileage_vehicle table
		public function getExceededMileageVehiDetails($userid,$filingid)
		{
			global $DBH;
			$feilingvehicle = array();
			
			$sql = "select fv.id as taxableid,fv.filing_id,fv.vin,fv.is_logging,fv.weight_category,fv.tax_amount,fv.active,fm.id
					from tt_filing_exceeded_mileage_vehicle AS fv
					JOIN tt_filings AS fm ON (fm.id = fv.filing_id)
					where user_id = ?  AND fm.active = ? AND fv.active = ? AND fv.filing_id = ? order by taxableid desc";
			$res = $DBH->prepare($sql);
			$res->execute(array($userid,'1','1',$filingid));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$feilingvehicle[] = $row;
			}
			return $feilingvehicle;
		}
		
		//getting records from tt_filing_exceeded_mileage_vehicle table
		public function exceededMileageFilingVehiDetails($TaxableId,$selectedBusiness)
		{
			global $DBH;

			$sql = "SELECT em.*,uv.licence_no from tt_filing_exceeded_mileage_vehicle AS em 
					LEFT JOIN tt_user_vehicles AS uv ON (em.vin = uv.vin AND em.weight_category = uv.weight_category 
					AND em.is_logging = uv.is_logging
					AND uv.business_id = ?  AND uv.`active` =1) 
					WHERE em.id = ? AND em.`active` =1";
			
			$res = $DBH->prepare($sql);
			$res->execute(array($selectedBusiness,$TaxableId));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$feilingvehicle = $row;
			}
			
			return $feilingvehicle;
		}
		public function getTaxAmount($filingYear,$filingMonthId,$weightCategory,$loggingInfo){
			global $DBH;
			$result = array();
			$sql = "SELECT tc.amount FROM `tt_tax_computation_master` AS tc 
						JOIN tt_tax_year AS fy ON tc.tax_year = fy.tax_computation_year 
					WHERE fy.id = ? AND tc.weight_category = ? AND tc.month_remaining = ? AND tc.is_logging = ?";
			
			$preparesql = $DBH -> prepare($sql);
			$preparesql -> execute(array($filingYear,$weightCategory,$filingMonthId,$loggingInfo));
			$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
			$result = $preparesql ->fetchColumn();

			return $result;
		}
		
		//update into tt_filing_exceeded_mileage_vehicle table.
		public function updateExceededMileageVehiInfo($vin,$TaxweightId,$loggingInfo,$taxAmount,$TaxableId,$modifiedBy)
		{
			global $DBH;
            $updatetaxInfo = "Update `tt_filing_exceeded_mileage_vehicle` set `vin` = ?,`is_logging` = ?, 
            				  `weight_category` = ?, `tax_amount` = ?, `modified_by` = ?
			 				  WHERE id = ?";
			$prepareupdatetaxInfo = $DBH->prepare($updatetaxInfo);
			$prepareupdatetaxInfo->execute(array($vin,$loggingInfo,$TaxweightId,$taxAmount,$modifiedBy,$TaxableId));
			
			if($prepareupdatetaxInfo)
			{
				$status = 'updated';
			}
			else
			{
				$status = 'not_updated';
			}
			return $status;
		}
		
		//delete from tt_filing_exceeded_mileage_vehicle
		public function deleteExceededMileageVehi($TaxableId,$Vin)
		{
			global $DBH;
			$deleteql = 'UPDATE `tt_filing_exceeded_mileage_vehicle` set active = ? WHERE `id` = ? AND `vin` = ?'; 
			$preparedeletesql = $DBH -> prepare($deleteql);
			$preparedeletesql -> execute(array('0',$TaxableId,$Vin));
		}
		
		public function getTaxFilingYearDetails($year)
		{
			global $DBH;
			$sql		= "SELECT * FROM `tt_tax_year` WHERE  `tax_year` =?";
			$preparesql = $DBH->prepare($sql);
			$executesql = $preparesql->execute(array($year));	
			$preparesql->setFetchMode(PDO::FETCH_ASSOC);
			$result = $preparesql->fetch();
			return $result;		
		}
}
?>