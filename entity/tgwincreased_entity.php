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
class Tgwincreased_DAO
{
		public function __construct()
		{	
			
		}
		
		//Inserting into tt_filing_tgw_increase table
		public function insertTGWincrease($filingid,$vin,$loggingInfo,$previousWeightCategory,$changingWeightCategory,$changeTaxMonth,$previousTaxAmount,$currentTaxAmount,$taxAmount,$createdDate,$createdBy)
		{			
			global $DBH;
			
			$chkVehiStatus = 'SELECT * FROM `tt_filing_tgw_increase` WHERE `vin` = ? AND `active` = ? AND `filing_id` = ?';
			$preparechkVehiStatus = $DBH->prepare($chkVehiStatus);
			$preparechkVehiStatus->execute(array($vin,1,$filingid));	
			$count = $preparechkVehiStatus->rowCount();	
			
			if($count == 0)
			{
				echo $insertTaxVehiInfo = "INSERT INTO `tt_filing_tgw_increase` (
											`filing_id`,`vin`,`is_logging`,`previous_category`,
											`changed_category`,`changed_month`,`previous_month_tax_amount`,`changed_month_tax_amount`,`difference_tax_amount`,
											`active`,`created_date`,`created_by`) 
						   	   VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
				$prepareInsertTGWIInfo = $DBH->prepare($insertTaxVehiInfo);
				
				$prepareInsertTGWIInfo->execute(array($filingid,$vin,$loggingInfo,$previousWeightCategory,$changingWeightCategory,$changeTaxMonth,$previousTaxAmount,$currentTaxAmount,$taxAmount,'1',$createdDate,$createdBy));		
	
				if($prepareInsertTGWIInfo)
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
		
		//getting records from tt_filing_tgw_increase table
		public function getTGWIncreaseInfo($userid,$filingid)
		{
			global $DBH;
			$feilingvehicle = array();
			
			$sql = "select far.*,f.id,far.id AS taxableid from tt_filing_tgw_increase AS far
					JOIN tt_filings AS f ON (f.id = far.filing_id)
					WHERE f.user_id = ? AND f.active = ? AND far.active = ? AND far.filing_id = ? order by far.id desc";
			$res = $DBH->prepare($sql);
			$res->execute(array($userid,'1','1',$filingid));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$feilingvehicle[] = $row;
			}
			return $feilingvehicle;
		}
		
		//getting records from tt_filing_tgw_increase table
		public function editTGWIncreasedDetails($TaxableId,$selectedBusiness)
		{
			global $DBH;
			$sql = "SELECT tgw.*,uv.licence_no FROM tt_filing_tgw_increase AS tgw 
					LEFT JOIN tt_user_vehicles AS uv ON (tgw.vin = uv.vin
					AND tgw.changed_category = uv.weight_category AND tgw.is_logging = uv.is_logging 
					AND uv.business_id = ?  AND uv.`active` =1) 
					WHERE tgw.id = ? AND tgw.`active` =1 ";
			
			$res = $DBH->prepare($sql);
			$res->execute(array($selectedBusiness,$TaxableId));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$tGWIncreased = $row;
			}
			
			return $tGWIncreased;
		}
		public function getTaxAmount($previousWeightCategory,$changingWeightCategory,$changeTaxMonth,$loggingInfo,$filingYear){
			global $DBH;
			$result = array();
			$sql = "SELECT tcm.amount FROM `tt_tax_computation_master` AS tcm 
						JOIN tt_tax_year AS ty 
							ON (tcm.tax_year =  	ty.tax_computation_year AND ty.id = ?) 
							WHERE tcm.`is_logging` = ? AND tcm.month_remaining = ? AND tcm.weight_category = ?
						UNION
					SELECT tcm.amount FROM `tt_tax_computation_master` AS tcm 
						JOIN tt_tax_year AS ty 
							ON (tcm.tax_year =  	ty.tax_computation_year AND ty.id = ?) 
							WHERE tcm.`is_logging` = ? AND tcm.month_remaining = ? AND tcm.weight_category = ?";
			$preparesql = $DBH -> prepare($sql);
			$preparesql -> execute(array($filingYear,$loggingInfo,$changeTaxMonth,$changingWeightCategory,$filingYear,$loggingInfo,$changeTaxMonth,$previousWeightCategory));
			$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
			while($row = $preparesql->fetch())
			{
				$result[] = $row;
			}
			return $result;
		}
		
		//update into tt_filing_tgw_increase table.
		public function updateTGWITaxVehiInfo($vin,$previousWeightCategory,$changingWeightCategory,$changeTaxMonth,$loggingInfo,$previousTaxAmount,$currentTaxAmount,$taxAmount,$TaxableId,$modifiedBy)
		{
			
			global $DBH;
			$updatetaxInfo = "Update `tt_filing_tgw_increase` set `vin` = ?,`is_logging` = ?, `previous_category` = ?,
							`changed_category` = ?, `changed_month` = ?, `previous_month_tax_amount` = ?,`changed_month_tax_amount` = ?,`difference_tax_amount` = ?, 
							`modified_by` = ?
			 				  WHERE id = ?";	
			
			$prepareupdatetaxInfo = $DBH->prepare($updatetaxInfo);
			$prepareupdatetaxInfo->execute(array($vin,$loggingInfo,$previousWeightCategory,$changingWeightCategory,$changeTaxMonth,$previousTaxAmount,$currentTaxAmount,$taxAmount,$modifiedBy,$TaxableId));
			
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
		
		//delete from tt_filing_tgw_increase
		public function deleteTGWIncreasedDetails($TaxableId,$Vin)
		{
			global $DBH;
			$deleteql = 'UPDATE `tt_filing_tgw_increase` set active = ? WHERE `id` = ? AND `vin` = ?'; 
			$preparedeletesql = $DBH -> prepare($deleteql);
			$preparedeletesql -> execute(array('0',$TaxableId,$Vin));
		}
	
		public function getFilingDetails($filingId)
		{
			global $DBH;
			$sql		= "SELECT * FROM `tt_filings` WHERE `id` =? ";
			$preparesql = $DBH->prepare($sql);
			$executesql = $preparesql->execute(array($filingId));
			$preparesql->setFetchMode(PDO::FETCH_ASSOC);
			$result = $preparesql->fetch();
			return $result;		
		}
}
?>