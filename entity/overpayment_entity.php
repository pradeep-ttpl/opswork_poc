<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : overpayment_entity.php
 * @version  : 1.0
 * @date  : 27-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila                27-Jul-2012            Initial Version - File Created
 * 
 */
class Overpayment_DAO
{	
		public function addOverpayment($vin,$paymentdate,$amtclaim,$explanation,$document,$filingid,$createdBy)
		{
			global $DBH;
			$createdDate = date("Y-m-d h:i:s");
			$insertoverpaymentInfo = "INSERT INTO `tt_filing_credit_overpayment` (`filing_id`,`vin`,`payment_date`,`amount_of_claim`,`explanation`,`document_name`,`created_date`,`created_by`) 
						   	   		  VALUES (?,?,?,?,?,?,?,?)";	
			$prepareoverpayment = $DBH->prepare($insertoverpaymentInfo);
			$prepareoverpayment->execute(array($filingid,$vin,$paymentdate,$amtclaim,$explanation,$document,$createdDate,$createdBy));
			if($prepareoverpayment)
			{
				$status = 'inserted';
			}
			else
			{
				$status = 'not_inserted';
			}
			
			return $status;
			
		}
		
	public function getOverpaymentDet($userid,$filingid)
	{
		global $DBH;
		$overpaymentdetails = array();
		$sql = "select op.vin as vin, op.id as overpaymentId,op.payment_date,op.amount_of_claim,op.explanation,op.document_name
				from tt_filing_credit_overpayment AS op
				JOIN tt_filings AS fm ON (fm.id = op.filing_id)
				where user_id = ?  AND fm.active = ? AND op.active = ? AND op.filing_id = ? order by overpaymentId desc";
		$res = $DBH->prepare($sql);
		$res->execute(array($userid,'1','1',$filingid));
		$res->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $res->fetch())
		{
			$overpaymentdetails[] = $row;
		}
		return $overpaymentdetails;
	}
	
	public function editoverpaymentdetails($overpaymentId,$businessId)
	{
		global $DBH;
	
		//$sql = "select * from tt_filing_credit_overpayment where id = ? AND active = 1";
		$sql = "SELECT fco.*,ttuv.licence_no FROM tt_filing_credit_overpayment fco
					LEFT JOIN tt_user_vehicles ttuv ON(fco.vin = ttuv.vin AND ttuv.business_id = ?) 
					WHERE fco.id = ? AND fco.active = 1 LIMIT 1";
		$res = $DBH->prepare($sql);
		$res->execute(array($businessId,$overpaymentId));
		$res->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $res->fetch())
		{
			$overpaymentdet = $row;
		}
		
		return $overpaymentdet;
	}
	
	public function updateCreditDetails($vin,$paymentdate,$amtclaim,$explanation,$document,$overpaymentId,$modifiedBy)
	{
		global $DBH;
		
		if($document == '')
		{
			$updatepaymentInfo = "Update `tt_filing_credit_overpayment` set `vin`= ?, `payment_date` = ?,`amount_of_claim` = ?,`explanation` = ?,`modified_by` = ? WHERE id = ? AND active = 1";	
			$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
			$prepareupdatepayment = $DBH->prepare($updatepaymentInfo);
			$prepareupdatepayment->execute(array($vin,$paymentdate,$amtclaim,$explanation,$modifiedBy,$overpaymentId));			
		}
		else
		{
			$updatepaymentInfo = "Update `tt_filing_credit_overpayment` set `vin` = ?, `payment_date` = ?,`amount_of_claim` = ?,`explanation` = ?,`modified_by` = ?,`document_name` = ? WHERE id = ? AND active = 1";	
			$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
			$prepareupdatepayment = $DBH->prepare($updatepaymentInfo);
			$prepareupdatepayment->execute(array($vin,$paymentdate,$amtclaim,$explanation,$modifiedBy,$document,$overpaymentId));
		}
		//print_r($prepareupdatepayment->errorInfo());
		
		return $prepareupdatepayment->rowCount();
	}
	
	public function deletetoverpayment($id)
	{ 
		global $DBH;
		$deleteql = 'UPDATE `tt_filing_credit_overpayment` set active = ? WHERE `id` = ?'; 
		$preparedeletesql = $DBH -> prepare($deleteql);
		$preparedeletesql -> execute(array('0',$id));
	}
}
?>