<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : summary_validations.php
 * @version  : 1.0
 * @date  : 23-Jan-2014
 *
 * @description :
 *
 * @author      : Raja Saravanan
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Raja Saravanan       23-Jan-2014           Initial Version - File Created
 * 
 */
class SummaryValidations
{
	public $filingId;
	public $formType;
	
	public function __construct()
	{
		$this->filingId = $_SESSION['filingId'];
		$this->formType = $_SESSION['formtype'];
		
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
	}
	
	//Checking whether all VIN entered is valid for filing
	public function checkVIN()
	{
		global $DBH;
		$filingId = $this->filingId; 
		$sql = "( SELECT `vin` FROM `tt_filing_taxable_vehicle` WHERE `filing_id` = ? AND active = 1 ) UNION
				( SELECT `vin` FROM `tt_filing_current_suspended` WHERE `filing_id` = ? AND active = 1 ) UNION
				( SELECT `vin` FROM `tt_filing_prior_suspended` WHERE `filing_id` = ? AND active = 1 ) UNION
				( SELECT `vin` FROM `tt_filing_sold_destroyed` WHERE `filing_id` = ? AND active = 1 ) UNION
				( SELECT `vin` FROM `tt_filing_low_mileage` WHERE `filing_id` = ? AND active = 1 ) UNION
				( SELECT `vin` FROM `tt_filing_tgw_increase` WHERE `filing_id` = ? AND active = 1 ) UNION
				( SELECT `vin` FROM `tt_filing_exceeded_mileage_vehicle` WHERE `filing_id` = ? AND active = 1 )";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($filingId, $filingId, $filingId, $filingId, $filingId, $filingId, $filingId));
		$status = 0;
		while($row = $preparesql->fetch())
		{
			$vin = 	$this->MCrypt->decrypt($row['vin']);
			if (!preg_match('/^([a-h j-n p r-z A-H J-N P R-Z 0-9_-]){17}$/', $vin))
			{
			   $status = 1;
			}
		}
		
		return $status;
	}
	
	//Checking whether the EIN is valid for filing
	public function checkEIN()
	{
		global $DBH;
		$filingId = $this->filingId; 
		$sql = "SELECT ttub.ein FROM tt_filings ttf
				JOIN tt_user_business ttub ON(ttf.biz_id = ttub.id)
				WHERE ttf.id = ?";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($filingId));
		$status = 0;
		$row = $preparesql->fetch();
		$ein = 	$this->MCrypt->decrypt($row['ein']);
		if (!preg_match('/^[0-9]{9}$/', $ein))
		{
		   $status = 1;
		}
		return $status;
	}
	
	//Checking whether credit exceeding the tax amount for the selected filing
	public function checkCreditExceed()
	{
		global $DBH;
		$filingId = $this->filingId; 
		$creditAmount = 0;
		$taxedAmount = 0;
		
		if($this->formType == '2290')
		{
			$sql		= "SELECT tax_amount FROM tt_filing_taxable_vehicle WHERE `filing_id` = ? AND active = ?";
			$preparesql = $DBH->prepare($sql);
			$executesql = $preparesql->execute(array($filingId,1));	
			$preparesql->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $preparesql->fetch())
			{
				$taxedAmount +=  $this->MCrypt->decrypt($row['tax_amount']);
			}
				
			$sql1		= "SELECT credit_amount FROM tt_filing_sold_destroyed WHERE `filing_id` = ? AND active = ?";
			$preparesql1 = $DBH->prepare($sql1);
			$executesql1 = $preparesql1->execute(array($filingId,1));	
			$preparesql1->setFetchMode(PDO::FETCH_ASSOC);
			while($row1 = $preparesql1->fetch())
			{
				$creditAmount +=  $this->MCrypt->decrypt($row1['credit_amount']);
			}
			
			$sql1		= "SELECT credit_amount FROM tt_filing_low_mileage WHERE `filing_id` = ? AND active = ?";
			$preparesql1 = $DBH->prepare($sql1);
			$executesql1 = $preparesql1->execute(array($filingId,1));	
			$preparesql1->setFetchMode(PDO::FETCH_ASSOC);
			while($row1 = $preparesql1->fetch())
			{
				$creditAmount +=  $this->MCrypt->decrypt($row1['credit_amount']);
			}
		}
		else if($this->formType == '2290A1')
		{
			$sql		= "SELECT difference_tax_amount FROM tt_filing_tgw_increase WHERE `filing_id` = ? AND active = ?";
			$preparesql = $DBH->prepare($sql);
			$executesql = $preparesql->execute(array($filingId,1));	
			$preparesql->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $preparesql->fetch())
			{
				$taxedAmount +=  $this->MCrypt->decrypt($row['difference_tax_amount']);
			}
		}
		else if($this->formType == '2290A2')
		{
			$sql		= "SELECT tax_amount FROM tt_filing_exceeded_mileage_vehicle WHERE `filing_id` = ? AND active = ?";
			$preparesql = $DBH->prepare($sql);
			$executesql = $preparesql->execute(array($filingId,1));	
			$preparesql->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $preparesql->fetch())
			{
				$taxedAmount +=  $this->MCrypt->decrypt($row['tax_amount']);
			}
		}
		
		$finalTaxAmount = $taxedAmount - $creditAmount;
		return $finalTaxAmount;
	}
	
	//Checking whether there is taxable amount
	public function chkTaxableAmount()
	{
		global $DBH;
		$filingId = $this->filingId; 
		
		$sql1		= "SELECT id FROM tt_filing_sold_destroyed WHERE `filing_id` = ? AND active = ?";
		$preparesql1 = $DBH->prepare($sql1);
		$preparesql1->execute(array($filingId,1));
		$soldCreditCount = $preparesql1->rowcount();
		
		$sql1		= "SELECT id FROM tt_filing_low_mileage WHERE `filing_id` = ? AND active = ?";
		$preparesql1 = $DBH->prepare($sql1);
		$preparesql1->execute(array($filingId,1));
		$lowmileageCreditAmount = $preparesql1->rowcount();
		
		if($soldCreditCount != 0 || $lowmileageCreditAmount != 0)
		{
			$sql = "SELECT id FROM tt_filing_taxable_vehicle WHERE filing_id = ? AND active = ?";
			$preparesql = $DBH->prepare($sql);
			$preparesql->execute(array($filingId,1));
			return $preparesql->rowcount();
		}
		else
		return 1;
	}
	
	//Checking whether payment selected for filing
	public function chkPaymentSelection()
	{
		global $DBH;
		$filingId = $this->filingId; 
		$sql = "SELECT id FROM tt_filing_payment WHERE filing_id = ? AND active = ?";
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($filingId,1));
		return $preparesql->rowcount();
	}
	
	//fetching total taxable vehicles
	public function totalTaxVehicles()
	{
		global $DBH;
		$filingId = $this->filingId;
		$sql = "SELECT count(id) as totalTaxVehicles FROM tt_filing_taxable_vehicle WHERE filing_id = ? AND active = ?
				GROUP BY filing_id";
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($filingId,1));
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		$row = $preparesql->fetch();
		$count = 0;
		if($row['totalTaxVehicles']!='')
		$count = $row['totalTaxVehicles'];
		
		return $count;
	}
	
	//Checking whether the vehicles entered are following the filing rule
	public function checkVINrule()
	{
		global $DBH;
		$filingId = $this->filingId; 
		
		$sql = "SELECT ftv.id 
				FROM tt_filing_taxable_vehicle ftv 
				JOIN tt_filing_current_suspended fcs ON(ftv.vin = fcs.vin AND ftv.filing_id = fcs.filing_id)
				WHERE ftv.filing_id = ? AND ftv.active = 1 AND fcs.active = 1";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($filingId));
		if($preparesql->rowcount() > 0)
		return 1;
		
		$sql = "SELECT ftv.id 
				FROM tt_filing_taxable_vehicle ftv 
				JOIN tt_filing_sold_destroyed fsd ON(ftv.vin = fsd.vin AND ftv.filing_id = fsd.filing_id)
				WHERE ftv.filing_id = ? AND ftv.active = 1 AND fsd.active = 1";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($filingId));
		if($preparesql->rowcount() > 0)
		return 2;
		
		$sql = "SELECT fcs.id FROM tt_filing_current_suspended fcs
				JOIN tt_filing_sold_destroyed fsd ON(fcs.vin = fsd.vin AND fcs.filing_id = fsd.filing_id)
				WHERE ftv.filing_id = ? AND fcs.active = 1 AND fsd.active = 1";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($filingId));
		if($preparesql->rowcount() > 0)
		return 3;
		
		$sql = "SELECT fcs.id FROM tt_filing_prior_suspended fps
				JOIN tt_filing_low_mileage flm ON(fps.vin = flm.vin AND fps.filing_id = flm.filing_id)
				WHERE fps.filing_id = ? AND fps.active = 1 AND flm.active = 1";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($filingId));
		if($preparesql->rowcount() > 0)
		return 4;
		
	}
}
	
?>