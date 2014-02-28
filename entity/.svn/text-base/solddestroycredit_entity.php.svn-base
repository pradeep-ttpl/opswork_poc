<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : lowmileagecredit_entity.php
 * @version  : 1.0
 * @date  : 19-Jul-2012
 *
 * @description :
 *
 * @author      : Manojkumar
 *
 * History of modifications:
 *
 * Author                 		Date                 Description of modifications
 * ----------            	  ------------           ------------------------------
 * Manojkumar                 19-Jul-2012            Initial Version - File Created
 * Akila				      23-Jul-2012            Add,edit - issue fixed.
 * Akila				      23-Jul-2012            delete functionality added.
 */
class Solddestroycredit_DAO
{
	public function getSoldDestroyTaxAmount($filingYear,$filingMonthDiff,$weightCategory,$loggingInfo){
		//echo $filingYear.'-'.$weightCategory.'-'.$filingMonthDiff.'-'.$loggingInfo;
		global $DBH;
		$result = array();
		$sql = "SELECT tc.amount FROM `tt_tax_computation_master` AS tc 
					JOIN tt_tax_year AS fy ON tc.tax_year = fy.tax_computation_year 
				WHERE fy.tax_year = ? AND tc.weight_category = ? AND tc.month_remaining = ? AND tc.is_logging = ?";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($filingYear,$weightCategory,$filingMonthDiff,$loggingInfo));
		$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql ->fetchColumn();
		return $result;
	}	
	public function addSoldDestroyInfo( $soldArr,$filingid,$date,$createdBy)
	{
		global $DBH;
		$chkVehiStatus = 'SELECT * FROM `tt_filing_sold_destroyed` WHERE `vin` = ? AND `active` = ? AND `filing_id` = ?';
		$preparechkVehiStatus = $DBH->prepare($chkVehiStatus);
		$preparechkVehiStatus->execute(array($soldArr['VIN'],1,$filingid));		
		$count = $preparechkVehiStatus->rowCount();	
		if($count == 0)
		{			
		$sql = "INSERT INTO `tt_filing_sold_destroyed` (`filing_id`,`vin`,`weight_category`,is_logging,`loss_type`,`credit_amount`,
				`first_used_month`,`sold_destroyed_date`,`refund_explanation`,`document_name`,`active`,`created_date`,`created_by`) 
		VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$prepareInsertBiz = $DBH->prepare($sql);
		$prepareInsertBiz->execute( array( $filingid,$soldArr['VIN'],$soldArr['weight'],$soldArr['logging'],$soldArr['LossType'],
									$soldArr['taxAmount'],$soldArr['FirstUsedmonth'],$soldArr['soldDate'],$soldArr['explanation'],
									$soldArr['document'],'1',$date,$createdBy));	
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
	
	//Insert for bulk upload.
	public function addbulksoldvehicle( $filingid,$VIN,$TaxWeightID,$IsLogging,$LossTypevalue,$FirstUsedMonth,$creditTaxAmount,$SoldDate )
	{
		global $DBH;
		$chkVehiStatus = 'SELECT * FROM `tt_filing_sold_destroyed` WHERE `vin` = ? AND `active` = ? AND `filing_id` = ?';
		$preparechkVehiCount = $DBH->prepare($chkVehiStatus);
		$preparechkVehiCount->execute(array($VIN,1,$filingid));		
		$count = $preparechkVehiCount->rowCount();	
		
		if($count == 0)
		{
			$sql = "INSERT INTO `tt_filing_sold_destroyed` (`filing_id`,`vin`,`weight_category`,is_logging,`loss_type`,`credit_amount`,`first_used_month`,sold_destroyed_date,`active`) 
			VALUES(?,?,?,?,?,?,?,?,?)";
			$prepareInsertBiz = $DBH->prepare($sql);
			$prepareInsertBiz->execute( array( $filingid,$VIN,$TaxWeightID,$IsLogging,$LossTypevalue,$creditTaxAmount,$FirstUsedMonth,$SoldDate,'1'));
			$count = $prepareInsertBiz->rowCount();	
		}else{
			$updateSql = 'UPDATE `tt_filing_sold_destroyed` set `weight_category` = ?, is_logging = ?, `loss_type` = ?, 
						 `credit_amount` = ?,`first_used_month` = ?,`sold_destroyed_date` = ? 
						 WHERE `vin` = ? AND `filing_id` = ?'; 
			$prepareUpdateSql = $DBH -> prepare($updateSql);
			$prepareUpdateSql -> execute(array($TaxWeightID,$IsLogging,$LossTypevalue,$creditTaxAmount,$FirstUsedMonth,$SoldDate,$VIN,$filingid));			
		}
		return $count;	
			
	}
	
	public function getSoldDestroyCreditInfo($userid,$filingid)
	{
		global $DBH;
		$soldArr = array();	
		$userid.$filingid.$sql = "SELECT fc.id as sldDtroyCrdId,fc.filing_id,fc.vin, fc.weight_category,fc.first_used_month,fc.is_logging,fc.loss_type,fc.sold_destroyed_date,
				fc.credit_amount,fc.active,fc.refund_explanation,fc.document_name,fm.id
				from tt_filing_sold_destroyed AS fc
				JOIN tt_filings AS fm ON (fm.id = fc.filing_id) 
				where fm.user_id = ?  AND fm.active = ? AND fc.active = ? AND fc.filing_id = ? GROUP BY fc.id order by sldDtroyCrdId desc";
		
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($userid,'1','1',$filingid));	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$soldArr[] = $result;
		}	
		return $soldArr;
	}
	public function editSoldDestroyInfo($businessId,$sldDtroyCrdId )
	{
		global $DBH;
		$details =array();
		$sql = "SELECT fsc.*,ttuv.licence_no FROM `tt_filing_sold_destroyed` AS fsc 
				LEFT JOIN tt_user_vehicles ttuv ON(fsc.vin = ttuv.vin AND fsc.weight_category = ttuv.weight_category AND fsc.is_logging = ttuv.is_logging 
				AND ttuv.business_id = ?) 
				WHERE fsc.`id`=? AND fsc.`active` =1 LIMIT 1";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($businessId,$sldDtroyCrdId));	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql->fetch();
		return $result;
	}
	public function updateSoldDestroyInfo($taxAmount,$lossType,$explanation,$soldArr,$sldDtroyCrdId,$vin,$modifiedBy)
	{
		global $DBH;
		$details = array();
		$sql = "UPDATE `tt_filing_sold_destroyed` SET `vin`=?, `weight_category`=?,`first_used_month`=?,`is_logging`=?,`sold_destroyed_date`=?,`credit_amount`=?,
					`loss_type`=?, `refund_explanation`=?,`document_name`=?,`modified_by`=?
					 WHERE `id`=?";
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($soldArr['VIN'],$soldArr['weight'],$soldArr['FirstUsedmonth'],$soldArr['logging'],$soldArr['soldDate'],$taxAmount,$lossType,$explanation,$soldArr['document'],$modifiedBy,$sldDtroyCrdId));			
	}
	
		//get weight from  TT_TaxComputation table.
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
				
	    //delete
		public function deletesolddestroy($sldDtroyCrdId,$vin)
		{
			global $DBH;
			$deleteql = 'UPDATE `tt_filing_sold_destroyed` set active = ? WHERE `id` = ? AND `vin` = ?'; 
			$preparedeletesql = $DBH -> prepare($deleteql);
			$preparedeletesql -> execute(array('0',$sldDtroyCrdId,$vin));
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
		
	public function getPendingFiling($user_id,$filingid)
	{
		global $DBH;
		$results = array();	
		$sql = 'SELECT fm.*,pb.name FROM  `tt_filings` AS fm 
		JOIN `tt_user_business` AS pb ON pb.id = fm.biz_id 
		WHERE  fm.user_id =? AND fm.user_completed = 0 AND pb.active = 1 AND fm.active = 1 AND fm.id = ?';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($user_id,$filingid));		
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$results[] = $result;
		}	
		return $results;		
	}
	
	//To get Tax year
	public function getTaxYear($taxYear)
	{
		global $DBH;
		$result = array();
		$sql = "SELECT * FROM `tt_tax_year` WHERE `tax_year` = ? ";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($taxYear));
		$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql ->fetch();			
		return $result;
	}
}
?>