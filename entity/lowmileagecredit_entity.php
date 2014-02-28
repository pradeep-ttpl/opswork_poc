 <?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : lowmileagecredit_entity.php
 * @version  : 1.0
 * @date  : 21-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                 		Date                  		Description of modifications
 * ----------            	  ------------          		------------------------------
 * Manojkumar                 21-Jul-2012                   Initial Version - File Created
 * 
 */
class Lowmileagecredit_DAO
{		
	    //Getting the list of weights from TT_TaxComputation table
		public function taxWeightlist()
		{
			global $DBH;
		
		   	$sql = "SELECT * FROM `tt_tax_computation_master`";
			$res = $DBH->prepare($sql);
			$res->execute(array());
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$weightList[] = $row;
			}
			return $weightList;
		}
		
		//Inserting taxable vehicle information in 'tt_filing_low_mileage' table
		public function addlowmileageinfo($vin,$TaxweightId,$loggingInfo,$monthused,$filingid,$explanation,$document,$creditTaxAmount,$date,$createdBy)
		{
			global $DBH;
			$chkVehiStatus = 'SELECT * FROM `tt_filing_low_mileage` WHERE `vin` = ? AND `active` = ? AND `filing_id` = ?';
			$preparechkVehiStatus = $DBH->prepare($chkVehiStatus);
			$preparechkVehiStatus->execute(array($vin,1,$filingid));	
			$count = $preparechkVehiStatus->rowCount();	
			if($count == 0)
			{
				 $insertcreditInfo = "INSERT INTO `tt_filing_low_mileage` (`filing_id`,`vin`,`weight_category`,`is_logging`,
				 						`first_used_month`,`credit_amount`,`refund_explanation`,`document_name`,`active`,`created_date`,`created_by`) 
						   	   		  VALUES (?,?,?,?,?,?,?,?,?,?,?)";	
				$prepareInsertcreditInfo = $DBH->prepare($insertcreditInfo);
				$prepareInsertcreditInfo->execute(array($filingid,$vin,$TaxweightId,$loggingInfo,$monthused,$creditTaxAmount,$explanation,$document,'1',$date,$createdBy));
				
				if($prepareInsertcreditInfo)
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
		
		
		public function getcreditVehiDet($userid,$filingid)
		{
			global $DBH;
			$creditvehidetails = array();
			$sql = "select lc.id as lowMlgId,lc.filing_id,lc.vin,lc.weight_category,lc.is_logging,lc.first_used_month,lc.credit_amount,
					lc.active,lc.refund_explanation,
					lc.document_name,fm.id
					FROM tt_filing_low_mileage AS lc
					JOIN tt_filings AS fm ON (fm.id = lc.filing_id) 
					WHERE user_id = ?  AND fm.active = ? AND lc.active = ? AND lc.filing_id = ? GROUP BY lc.id order by lowMlgId desc";
			$res = $DBH->prepare($sql);
			$res->execute(array($userid,'1','1',$filingid));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$creditvehidetails[] = $row;
			}
			
			return $creditvehidetails;
		}
		
		public function getcreditdet($lowMlgId,$businessId)
		{
			global $DBH;
	
			$sql = "SELECT lm.*,ttuv.licence_no FROM tt_filing_low_mileage lm
					LEFT JOIN tt_user_vehicles ttuv ON(lm.vin = ttuv.vin AND lm.weight_category = ttuv.weight_category 
					AND lm.is_logging = ttuv.is_logging	AND ttuv.business_id = ?) 
					WHERE lm.id = ? AND lm.active = 1 LIMIT 1";
			
			$res = $DBH->prepare($sql);
			$res->execute(array($businessId,$lowMlgId));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$creditdet = $row;
			}
			return $creditdet;
		}
		
		//delete
		public function deletecreditvehicle($lowMlgId,$vin)
		{ 
			global $DBH;
			$deleteql = 'UPDATE `tt_filing_low_mileage` set active = ? WHERE `id` = ? AND `vin` = ?'; 
			$preparedeletesql = $DBH -> prepare($deleteql);
			$preparedeletesql -> execute(array('0',$lowMlgId,$vin));
		}
		
		//get weight from  tt_tax_computation_master table.
		public function gettaxableGrossWeight($TaxWeightId)
		{
			global $DBH;
			
		   	$sql = "SELECT * FROM `tt_tax_computation_master` WHERE `id` = ? ";
			$res = $DBH->prepare($sql);
			$res->execute(array($TaxWeightId));
			
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$weightList = $row;
			}
			return $weightList;
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
		
		//update
		public function updateCreditDetails($vin,$TaxweightId,$loggingInfo,$monthused,$lowMlgId,$explanation,$document,$creditTaxAmount,$modifiedBy)
		{
			global $DBH;
			
			$updatecreditInfo = "Update `tt_filing_low_mileage` set `vin` = ?, `weight_category` = ?, `is_logging` = ?, `credit_amount` = ?, `first_used_month` = ?, 
								`refund_explanation` = ?, `document_name` = ?, `modified_by` = ? 
			 				     WHERE id = ?";	
			$prepareupdatecredit = $DBH->prepare($updatecreditInfo);
			$prepareupdatecredit->execute(array($vin,$TaxweightId,$loggingInfo,$creditTaxAmount,$monthused,$explanation,$document,$modifiedBy,$lowMlgId));
		
			if($prepareupdatecredit)
			{
				$status = 'updated';
			}
			else
			{
				$status = 'not_updated';
			}
			return $status;
		}		
		//Getting the gross weight details for upload through bulk excel
		public function grossWeightDetails($GrossWeightCategory)
		{
			global $DBH;
			$result = array();
			$sql = "SELECT * FROM ` tt_tax_computation_master` WHERE `weight_category` = ? ";
			$preparesql = $DBH -> prepare($sql);
			$preparesql -> execute(array($GrossWeightCategory));
			$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
			$result = $preparesql ->fetch();			
			return $result;
		}
		public function getTaxYearDetails($year)
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