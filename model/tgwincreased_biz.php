<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : tgwincreased_biz.php
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
class Tgwincreased_Model
{
	public function __construct()
	{		
		$tgwIncreasedInfoDAO = new Tgwincreased_DAO;
		$this->tgwIncreasedInfoDAO = $tgwIncreasedInfoDAO;
		
		$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
		$this->taxablevehicleinfoDAO = $taxablevehicleinfoDAO;
		
		$taxyear_DAO = new Taxyear_DAO;
		$this->taxyear_DAO = $taxyear_DAO;
		
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
	}
	
	//Inserting into  tt_filing_tgw_increase table
	public function addTaxableGrossWeightIncrease($businessId, $licenceNo,$vin,$loggingInfo,$previousWeightCategory,$changingWeightCategory,$filingId,$filingYear,$createdDate,$createdBy)
	{
		global $constantArr,$taxmonthAry;	
		
		$errorFlag = '~error';
		$successFlag = '~success';
		$chkVin = chkVin($vin);
		if($chkVin > 0)
		{
			$message = $constantArr['EnterValidvin'][$_SESSION['lang']].$errorFlag;
		}
		else if($previousWeightCategory == '')
		{
			$message = $constantArr['selectPreviousWeight'][$_SESSION['lang']].$errorFlag;
		}
		else if($changingWeightCategory == '')
		{
			$message = $constantArr['selectChangedWeight'][$_SESSION['lang']].$errorFlag;
		}
		else if($previousWeightCategory > $changingWeightCategory)
		{
			$message = $constantArr['changedCategoryNotvalid'][$_SESSION['lang']].$errorFlag;
		}
		else if($loggingInfo == '')
		{
			$message = $constantArr['selectLogging'][$_SESSION['lang']].$errorFlag;
		}
		else 
		{
			$filingDetails = $this->tgwIncreasedInfoDAO->getFilingDetails($filingId);
			$changeTaxMonth = $filingDetails['amended_month'];
	
			if($licenceNo != '')
			{
				// Checking whether licence number exists
				$chkLicenceNo = chkLicenceNo($businessId, $licenceNo, $this->MCrypt->encrypt($vin), $this->MCrypt->encrypt($changingWeightCategory), $this->MCrypt->encrypt($loggingInfo),$createdBy);
			}
			
			$tempChangeTaxMonth = $taxmonthAry[date('F',mktime(0, 0, 0,$this->MCrypt->decrypt($changeTaxMonth)))];
			$taxAmount = $this->tgwIncreasedInfoDAO->getTaxAmount($previousWeightCategory,$changingWeightCategory,$tempChangeTaxMonth,$loggingInfo,$filingYear);
			
			$previousTaxAmount 	= $taxAmount[1]['amount'];
			$currentTaxAmount 	= $taxAmount[0]['amount'];
			$taxAmount			= $currentTaxAmount-$previousTaxAmount;
	
			$amendedreturnInformation = $this->tgwIncreasedInfoDAO->insertTGWincrease($filingId,$this->MCrypt->encrypt($vin),$this->MCrypt->encrypt($loggingInfo),$this->MCrypt->encrypt($previousWeightCategory),$this->MCrypt->encrypt($changingWeightCategory),$changeTaxMonth,$this->MCrypt->encrypt($previousTaxAmount),$this->MCrypt->encrypt($currentTaxAmount),$this->MCrypt->encrypt($taxAmount),$createdDate,$createdBy);
			if($amendedreturnInformation=='inserted')
			{
				$message = $constantArr['vehicle_added'][$_SESSION['lang']].$successFlag;
			}
			else if($amendedreturnInformation == 'not_inserted')
			{
				$message = $constantArr['vehicle_not_added'][$_SESSION['lang']].$errorFlag;
			}
			else if($amendedreturnInformation == 'already_exists')
			{
				$message = $constantArr['VIN_already_exists'][$_SESSION['lang']].$errorFlag;
			}
		}
		return $message;
		
	}
	
	//getting records from tt_filing_tgw_increase table
	public function getTGWIncreaseInfo($userid,$filingId)
	{
		$tgwIncreasedInfo = $this->tgwIncreasedInfoDAO->getTGWIncreaseInfo($userid,$filingId);
		return $tgwIncreasedInfo;
	}
	
	//edit
	public function editTGWIncreasedDetails($TaxableId,$selectedBusiness)
	{
		$TGWIncreasedInfo = $this->tgwIncreasedInfoDAO->editTGWIncreasedDetails($TaxableId,$selectedBusiness);
		return $TGWIncreasedInfo;
	}
	
	//update
	public function updateTGWITaxVehiInfo($businessId, $licenceNo,$vin,$previousWeightCategory,$changingWeightCategory,$loggingInfo,$TaxableId,$filingId,$filingYear,$filingMonth,$modifiedBy)
	{
		global $taxmonthAry,$constantArr;
		
		$errorFlag = '~error';
		$successFlag = '~success';
		$chkVin = chkVin($vin);
		if($chkVin > 0)
		{
			$message = $constantArr['EnterValidvin'][$_SESSION['lang']].$errorFlag;
		}
		else if($previousWeightCategory == '')
		{
			$message = $constantArr['selectPreviousWeight'][$_SESSION['lang']].$errorFlag;
		}
		else if($changingWeightCategory == '')
		{
			$message = $constantArr['selectChangedWeight'][$_SESSION['lang']].$errorFlag;
		}
		else if($previousWeightCategory > $changingWeightCategory)
		{
			$message = $constantArr['changedCategoryNotvalid'][$_SESSION['lang']].$errorFlag;
		}
		else if($loggingInfo == '')
		{
			$message = $constantArr['selectLogging'][$_SESSION['lang']].$errorFlag;
		}
		else 
		{
//			$filingMonthId = $taxmonthAry[end(explode(' ',$filingMonth))];
	
			$filingDetails 		= $this->tgwIncreasedInfoDAO->getFilingDetails($filingId);
			$changeTaxMonth 	= $filingDetails['amended_month']; 
			
			if($licenceNo != '')
			{
				// Checking whether licence number exists
				$chkLicenceNo = chkLicenceNo($businessId, $licenceNo, $this->MCrypt->encrypt($vin), $this->MCrypt->encrypt($changingWeightCategory), $this->MCrypt->encrypt($loggingInfo),$modifiedBy);
			}
			
			$tempChangeTaxMonth = $taxmonthAry[date('F',mktime(0, 0, 0,$this->MCrypt->decrypt($changeTaxMonth)))];
			$taxAmount = $this->tgwIncreasedInfoDAO->getTaxAmount($previousWeightCategory,$changingWeightCategory,$tempChangeTaxMonth,$loggingInfo,$filingYear);
			
			$previousTaxAmount 	= $taxAmount[1]['amount'];
			$currentTaxAmount 	= $taxAmount[0]['amount'];
			$taxAmount			= $currentTaxAmount-$previousTaxAmount;
			
			$updateTGWITaxVehiInfo = $this->tgwIncreasedInfoDAO->updateTGWITaxVehiInfo($this->MCrypt->encrypt($vin),$this->MCrypt->encrypt($previousWeightCategory),$this->MCrypt->encrypt($changingWeightCategory),$changeTaxMonth,$this->MCrypt->encrypt($loggingInfo),$this->MCrypt->encrypt($previousTaxAmount),$this->MCrypt->encrypt($currentTaxAmount),$this->MCrypt->encrypt($taxAmount),$TaxableId,$modifiedBy);
			
	
			if($updateTGWITaxVehiInfo == 'updated')
			{
				$message = $constantArr['vehicle_updated'][$_SESSION['lang']].$successFlag;
			}
			else if($updateTGWITaxVehiInfo == 'not_updated')
			{
				$message = $constantArr['vehicle_not_updated'][$_SESSION['lang']].$errorFlag;
			}
		}
		return $message;
	}
	
	public function getMonthList($fromType,$monthValue,$filingYear){
		
		$currentYear =  date("Y");
		$currentMonth = date("F");
		
		$yearDetails = $this->taxyear_DAO->getTaxFilingYearDetails($filingYear);
		$yearTo = $yearDetails['tax_year']+1;
		$yearFrom = $yearDetails['tax_year'];
		
		$month_start = array ("12" => "July", "11" => "August", "10" => "September", "09" => "October", "08" => "November", "07" => "December");
		$month_end = array ("06" => "January", "05" => "February", "04" => "March", "03" => "April", "02" => "May", "01" => "June");
		
		$temp_var = '';
		
		//$temp_var ='<select id="taxmonth" name="taxmonth" class="alignleft txtBox320px"><option value="0">Select Month</option>';
		
		foreach($month_start AS $key => $value)
		{
			$temp_var .= '<option value="'. $key .'"';
			
			if($monthValue ==  $key)
			{
				$temp_var .= ' selected="selected"';
			}
			
			$temp_var .= '>'. $yearFrom .' '. $value .'</option>';
			
			// Break the loop once it reaches the current time.
			if($currentYear == $yearFrom && $currentMonth == $value)
			{
				$closeLoop = 1;
				break;
			}
		}
		if(isset($closeLoop) && $closeLoop!= 1)
		{
			foreach($month_end AS $key => $value)
			{
				$temp_var .= '<option value="'. $key .'"';
				
				if($monthValue == $key)
				{
					$temp_var .= ' selected="selected"';
				}			
				
				$temp_var .= '>'. $yearTo .' '. $value .'</option>';
				
				// Break the loop once it reaches the current time.
				if($currentYear == $yearTo && $currentMonth == $value)
				{
					break;
				}
			}
		}
		$temp_var .= "</select>";
		
		return $temp_var;
	}
}
?>