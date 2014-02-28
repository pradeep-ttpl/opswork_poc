<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : taxablevehicleinfo_entity.php
 * @version  : 1.0
 * @date  : 16-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila         		 16-Jul-2012           Initial Version - File Created
 * 
 */
class Taxablevehicleinfo_DAO
{
		public function __construct()
		{	
			
		}
		
		//Getting the list of weights from tt_tax_computation_master table
		public function taxWeightlist()
		{
			global $DBH;
		
		   	$sql = "SELECT DISTINCT(`weight_category`),weight FROM `tt_tax_computation_master` ORDER BY weight_category";
			$res = $DBH->prepare($sql);
			$res->execute(array());
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$weightList[] = $row;
			}
			return $weightList;
		}
		
		//Getting the list of liscenses
		public function getUserVehicles($userId)
		{
			global $DBH;
			$weightList = array();
			
		   	$sql = "SELECT DISTINCT licence_no,id FROM `tt_user_vehicles` 
		   			WHERE user_id = ? AND active = ? ORDER BY id ASC";
			$res = $DBH->prepare($sql);
			$res->execute(array($userId,1));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$weightList[] = $row;
			}
			return $weightList;
		}
		
		public function vehicleInfo($liscenceId)
		{
			global $DBH;
		
		   	$sql = "SELECT * FROM `tt_user_vehicles` WHERE id = ? AND `active` =1";
			$res = $DBH->prepare($sql);
			$res->execute(array($liscenceId));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			$row = $res->fetch();
			return $row;
		}
		
		//Inserting into tt_filing_taxable_vehicle table
		public function insertTaxVehiInfo($vin,$loggingInfo,$taxableGrossweight,$taxAmount,$filingid,$createdBy)
		{
			global $DBH;
			$createdDate = date("Y-m-d h:i:s");
			$chkVehiStatus = 'SELECT * FROM `tt_filing_taxable_vehicle` WHERE `vin` = ? AND `active` = ? AND `filing_id` = ?';
			$preparechkVehiStatus = $DBH->prepare($chkVehiStatus);
			$preparechkVehiStatus->execute(array($vin,1,$filingid));	
			$count = $preparechkVehiStatus->rowCount();	
			
			if($count == 0)
			{
				$insertTaxVehiInfo = "INSERT INTO `tt_filing_taxable_vehicle` (`filing_id`,`vin`,`is_logging`,`weight_category`,`tax_amount`,`created_date`,`created_by`,`active`) 
						   	   VALUES (?,?,?,?,?,?,?,?)";		
				
				$prepareInsertTaxVehiInfo = $DBH->prepare($insertTaxVehiInfo);
				$prepareInsertTaxVehiInfo->execute(array($filingid,$vin,$loggingInfo,$taxableGrossweight,$taxAmount,$createdDate,$createdBy,'1'));		
			
				if($prepareInsertTaxVehiInfo)
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
		
		//getting records from tt_filing_taxable_vehicle table
		public function getTaxVehiDetails($filingid,$user_id)
		{
			global $DBH;
			$filingvehicle = array();

			$sql = "select fv.id as taxableid,fv.filing_id,fv.vin,fv.is_logging,fv.weight_category,fv.tax_amount,fv.active,fm.id
					from tt_filing_taxable_vehicle AS fv
					JOIN tt_filings AS fm ON (fm.id = fv.filing_id)
					where fm.user_id = ?  AND fm.active = ? AND fv.active = ? AND fv.filing_id = ? order by fv.id desc";
			$res = $DBH->prepare($sql);
			$res->execute(array($user_id,'1','1',$filingid));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$filingvehicle[] = $row;
			}
			return $filingvehicle;
		}
		
		//get weight from  TT_TaxComputation table.
		public function gettaxableGrossWeight($TaxWeightId)  
		{
			global $DBH;
			$weightList = array();
			
		   	$sql = "SELECT * FROM `tt_tax_computation_master` WHERE `weight_category` = ? ";
			$res = $DBH->prepare($sql);
			$res->execute(array($TaxWeightId));
			
			$res->setFetchMode(PDO::FETCH_ASSOC);	
			while($row = $res->fetch())
			{
				$weightList = $row;
			}
			return $weightList;
		}
		
		//getting records from tt_filing_taxable_vehicle table
		public function TaxFilingVehiDetails($TaxableId)
		{
			global $DBH;

			$sql = "select tv.*,uv.licence_no from tt_filing_taxable_vehicle AS tv
			LEFT JOIN `tt_user_vehicles` AS uv ON (tv.vin = uv.vin AND tv.weight_category = uv.weight_category AND tv.is_logging = uv.is_logging)
			where tv.id = ?  AND tv.`active` =1";  
			
			$res = $DBH->prepare($sql);
			$res->execute(array($TaxableId));
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
		public function taxAmount($taxableGrossweight)
		{
			global $DBH;
			$result = array();
			$sql = "SELECT * FROM `tt_tax_computation_master` WHERE `id` = ? ";
			$preparesql = $DBH -> prepare($sql);
			$preparesql -> execute(array($taxableGrossweight));
			$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
			$result = $preparesql ->fetch();
			
			return $result;
		}
		
		//update into tt_filing_taxable_vehicle table.
		public function updateTaxVehiInfo($vin,$TaxweightId,$loggingInfo,$taxAmount,$TaxableId,$modifiedBy)
		{
			global $DBH;
            $updatetaxInfo = "Update `tt_filing_taxable_vehicle` 
            					SET `vin` = ?,`is_logging` = ?, `weight_category` = ?, `tax_amount` = ?, `modified_by` = ? 
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
		
		public function taxAmountid($taxableGrossweight)
		{
			global $DBH;
			$result = array();
			$sql = "SELECT * FROM `tt_tax_computation_master` WHERE `id` = ? ";
			$preparesql = $DBH -> prepare($sql);
			$preparesql -> execute(array($taxableGrossweight));
			$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
			$result = $preparesql ->fetch();
			
			return $result;
		}
		
		//delete from tt_filing_taxable_vehicle
		public function deleteTaxVehiDetails($TaxableId,$Vin,$filingId)
		{
			global $DBH;
			
			/*$MCrypt	= new MCrypt;
			
			$sql		= "SELECT tax_amount FROM tt_filing_taxable_vehicle WHERE `filing_id` = ? AND active = ? AND id != ?";
			$preparesql = $DBH->prepare($sql);
			$executesql = $preparesql->execute(array($filingId,1,$TaxableId));	
			$preparesql->setFetchMode(PDO::FETCH_ASSOC);
			$taxedAmount = 0;
			while($row = $preparesql->fetch())
			{
				$taxedAmount +=  $MCrypt->decrypt($row['tax_amount']);
			}
				
			$sql1		= "SELECT credit_amount FROM tt_filing_sold_destroyed WHERE `filing_id` = ? AND active = ?";
			$preparesql1 = $DBH->prepare($sql1);
			$executesql1 = $preparesql1->execute(array($filingId,1));	
			$preparesql1->setFetchMode(PDO::FETCH_ASSOC);
			$taxAmount = 0;
			while($row1 = $preparesql1->fetch())
			{
				$taxAmount +=  $MCrypt->decrypt($row1['credit_amount']);
			}
			
			$sql1		= "SELECT credit_amount FROM tt_filing_low_mileage WHERE `filing_id` = ? AND active = ?";
			$preparesql1 = $DBH->prepare($sql1);
			$executesql1 = $preparesql1->execute(array($filingId,1));	
			$preparesql1->setFetchMode(PDO::FETCH_ASSOC);
			$creditAmount = 0;
			while($row1 = $preparesql1->fetch())
			{
				$creditAmount +=  $MCrypt->decrypt($row1['credit_amount']);
			}
			
			$finalTaxAmount = $taxedAmount - ($creditAmount+$taxAmount);
			
			if($finalTaxAmount >= 0)
			{
				$deleteql = 'UPDATE `tt_filing_taxable_vehicle` set active = ? WHERE `id` = ? AND `vin` = ?'; 
				$preparedeletesql = $DBH -> prepare($deleteql);
				$preparedeletesql -> execute(array('0',$TaxableId,$Vin));
				
				return 'updated';
			}
			else
			return 'failed';*/
			
			$deleteql = 'UPDATE `tt_filing_taxable_vehicle` set active = ? WHERE `id` = ? AND `vin` = ?'; 
			$preparedeletesql = $DBH -> prepare($deleteql);
			$preparedeletesql -> execute(array('0',$TaxableId,$Vin));
			
			return 'updated';
		}
	
		//Getting the gross weight details for upload through bulk excel
		public function grossWeightDetails($GrossWeightCategory)
		{
			global $DBH;
			$result = array();
			$sql = "SELECT * FROM `tt_tax_computation_master` WHERE `weight_category` = ? ";
			$preparesql = $DBH -> prepare($sql);
			$preparesql -> execute(array($GrossWeightCategory));
			$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
			$result = $preparesql ->fetch();			
			return $result;
		}
}
?>