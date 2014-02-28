<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename 	: vincorrection_entity.php
 * @version  	: 1.0
 * @date  		: 03-Feb-2014
 *
 * @description :
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar  		 03-Feb-2014           Initial Version - File Created
 * 
 */
class Vincorrection_DAO
{
		public function __construct()
		{	
			
		}
		
		public function getAllNewCorrectingVIN($userId,$filingId,$selectedFilingId){
			
			//echo $selectedFilingId;
			global $DBH;
			$correctingVIN = array();
			$constrain = 'exist';
			if($selectedFilingId == 'new'){
				$constrain = 'new';
			}
			$sql = "select vc.*,f.id,vc.id AS correctionVINId from  tt_filing_vin_correction AS vc
					JOIN tt_filings AS f ON (f.id = vc.filing_id)
					WHERE f.user_id = ? AND f.active = ?  AND vc.active = ? AND vc.filing_id = ?  AND vc.edit_mode = ? order by vc.id desc";

			//echo $userId.'~'.$filingId.'~'.$constrain;
			$res = $DBH->prepare($sql);
			$res->execute(array($userId,'1','1',$filingId,$constrain));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$correctingVIN[] = $row;
			}
			return $correctingVIN;
		}
		public function getOverAllCorrectingVIN($userId,$filingId){
			
			//echo $selectedFilingId;
			global $DBH;
			$correctingVIN = array();
			
			$sql = "select vc.*,f.id,vc.id AS correctionVINId from  tt_filing_vin_correction AS vc
					JOIN tt_filings AS f ON (f.id = vc.filing_id)
					WHERE f.user_id = ? AND f.active = ?  AND vc.active = ? AND vc.filing_id = ? order by vc.id desc";

			$res = $DBH->prepare($sql);
			$res->execute(array($userId,'1','1',$filingId));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$correctingVIN[] = $row;
			}
			return $correctingVIN;
		}		
		
		public function addVinCorrection($filingId,$previn,$vin,$vinCorrectionType,$grossWeightCategory,$logging,$createdDate,$createdBy)
		{
			global $DBH;
			$chkVehiStatus = 'SELECT * FROM `tt_filing_vin_correction` WHERE `previous_vin` = ? AND `filing_id` = ? AND `active` = ?';
			$preparechkVehiStatus = $DBH->prepare($chkVehiStatus);
			$preparechkVehiStatus->execute(array($previn,$filingId,'1'));	
			$count = $preparechkVehiStatus->rowCount();	
			
			if($count == 0)
			{
				$insertTaxVehiInfo = "INSERT INTO `tt_filing_vin_correction` 
										(`filing_id`,`previous_vin`,`correct_vin`,`vin_type`,
										 `weight_category`,`is_logging`,`active`,`created_date`,`created_by`) 
						   	   			 VALUES (?,?,?,?,?,?,?,?,?)";		
				
				$prepareInsertTaxVehiInfo = $DBH->prepare($insertTaxVehiInfo);
				$prepareInsertTaxVehiInfo->execute(array($filingId,$previn,$vin,$vinCorrectionType,$grossWeightCategory,$logging,'1',$createdDate,$createdBy));		
			
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
		
		
		public function updateVinCorrection($filingId,$previn,$vin,$vinCorrectionType,$grossWeightCategory,$logging,$modifiedDate,$modifiedBy)
		{
			global $DBH;
			$chkVehiStatus = 'SELECT * FROM `tt_filing_vin_correction` WHERE `previous_vin` = ? AND `filing_id` = ? AND `active` = ?';
			$preparechkVehiStatus = $DBH->prepare($chkVehiStatus);
			$preparechkVehiStatus->execute(array($previn,$filingId,'1'));	
			$count = $preparechkVehiStatus->rowCount();	
			
			if($count == 0)
			{
				$insertTaxVehiInfo = "INSERT INTO `tt_filing_vin_correction` 
										(`filing_id`,`previous_vin`,`correct_vin`,`vin_type`,
										 `weight_category`,`is_logging`,`edit_mode`,`active`,`created_date`,`created_by`) 
						   	   			 VALUES (?,?,?,?,?,?,?,?,?,?)";		
				
				$prepareInsertTaxVehiInfo = $DBH->prepare($insertTaxVehiInfo);
				$prepareInsertTaxVehiInfo->execute(array($filingId,$previn,$vin,$vinCorrectionType,$grossWeightCategory,$logging,'exist','1',$modifiedDate,$modifiedBy));		
			
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
			/*else 
			{
				$updateTaxVehiInfo = "UPDATE `tt_filing_vin_correction` SET `correct_vin` = ?,`vin_type` = ?,`is_logging` = ?,
										 	`modified_date` = ?,`modified_by` = ? 
											WHERE previous_vin = ? AND `filing_id` = ?";		
				
				$prepareUpdateTaxVehiInfo = $DBH->prepare($updateTaxVehiInfo);
				$prepareUpdateTaxVehiInfo->execute(array($vin,$vinCorrectionType,$logging,$modifiedDate,$modifiedBy,$previn,$filingId));		
			
				if($prepareUpdateTaxVehiInfo)
				{
					$status = 'updated';
				}
				else
				{
					$status = 'not_updated';
				}
			}*/
			return $status;
		}
		
		public function deleteVINCorrection($vin)
		{
			global $DBH;
			$deleteql = 'UPDATE `tt_filing_vin_correction` set active = ? WHERE `id` = ?'; 
			$preparedeletesql = $DBH -> prepare($deleteql);
			$preparedeletesql -> execute(array('0',$vin));
		}
		
		public function getSubmittedFilingList($userId,$filingYear,$filingBusiness,$filingMonth){
			global $DBH;
			$submittedFilingList = array();
			
			$sql = "SELECT * FROM `tt_tax_year` AS ty 
					JOIN `tt_filings` AS tf ON (ty.tax_year = tf.filing_year 
					AND (ty.id = ? OR ty.tax_year = ?) AND tf.user_id = ? AND tf.active = ? AND tf.biz_id = ? 
					AND tf. submission_id > ? AND tf.irs_approved = ? AND tf.filing_month = ?) 
					GROUP BY tf.id";
			$res = $DBH->prepare($sql);
			$res->execute(array($filingYear,$filingYear,$userId,'1',$filingBusiness,'0','1',$filingMonth));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$submittedFilingList[] = $row;
			}
			return $submittedFilingList;
		}
		
		public function getAlreadyFiledVINs($filingId,$filingBusiness){
			
			global $DBH;
			$filingVINsList = array();

			$sql = "SELECT * FROM `view_filing_vehicles` AS vfv 
					JOIN  tt_filings AS tf ON (vfv.filing_id = tf.id)
					WHERE vfv.`filing_id` = ?";
			$res = $DBH->prepare($sql);
			$res->execute(array($filingId));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $res->fetch())
			{
				$filingVINsList[] = $row;
			}
			return $filingVINsList;
			
		}
		
		public function getTaxableGrossWeight($vin){
			
			global $DBH;
			$taxableGrossWeight = '';

			
			$sql = "SELECT weight_category FROM `tt_user_vehicles` WHERE `vin` = ? AND active = ?";
			$res = $DBH->prepare($sql);
			$res->execute(array($vin,'1'));
			$res->setFetchMode(PDO::FETCH_ASSOC);
			$row = $res->fetch();
			
			if($row['weight_category'] == ''){
				
				$sql = "SELECT weight_category FROM `tt_filing_vin_correction` WHERE `correct_vin` = ? AND active = ?";
				$res = $DBH->prepare($sql);
				$res->execute(array($vin,'1'));
				$res->setFetchMode(PDO::FETCH_ASSOC);
				$row = $res->fetch();
				
			}
			return $row['weight_category'];			
		}
}
?>