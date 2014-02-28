<?php
/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: exceededmileage_biz.php
 * @version  	: 1.0
 * @date  	 	: 26-Dec-2013
 *
 * @description : Exceededmileage business file
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

class Exceededmileage_Model
{
	public function __construct()
	{		
		$exceededmileagevehicleinfoDAO = new Exceededmileage_DAO;
		$this->exceededmileageinfoDAO = $exceededmileagevehicleinfoDAO;
		
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
	}
	
	//Inserting into tt_filing_exceeded_mileage_vehicle table
	public function addExceededMileageVehicle($businessId, $licenceNo,$vin,$loggingInfo,$exceededMileageWeight,$filingid,$filingMonth,$filingYear,$createdBy)
	{
		global $taxmonthAry,$constantArr;
		// Change month from integer to string / month name
		$monthName = date("F", mktime(0, 0, 0, $filingMonth, 10)); 
		// Get remaining month for calculation
		$filingMonthId = $taxmonthAry[$monthName];
		//$filingMonthId = $taxmonthAry[end(explode(' ',$filingMonth))];

		if(isset($_SESSION['admin_filing_year']) && $_SESSION['admin_filing_year'] > 0){
			$taxYearId = $this->exceededmileageinfoDAO->getTaxFilingYearDetails($filingYear);
			$filingYear= $taxYearId['id'];
		}
		
		$errorFlag = '~error';
		$successFlag = '~success';
		$chkVin = chkVin($vin);
		if($chkVin > 0)
		{
			$message = $constantArr['EnterValidvin'][$_SESSION['lang']].$errorFlag;
		}
		else if($exceededMileageWeight == '')
		{
			$message = $constantArr['selectWeight'][$_SESSION['lang']].$errorFlag;
		}
		else if($loggingInfo == '')
		{
			$message = $constantArr['selectLogging'][$_SESSION['lang']].$errorFlag;
		}
		else 
		{
			if($licenceNo != '')
			{
				// Checking whether licence number exists
				$chkLicenceNo = chkLicenceNo($businessId, $licenceNo, $this->MCrypt->encrypt($vin), $this->MCrypt->encrypt($exceededMileageWeight), $this->MCrypt->encrypt($loggingInfo),$createdBy);
			}
			
			$taxAmount = $this->exceededmileageinfoDAO->getTaxAmount($filingYear,$filingMonthId,$exceededMileageWeight,$loggingInfo);
		
			$ExceededMileageVehiInformation = $this->exceededmileageinfoDAO->insertExceededMileageVehiInfo($this->MCrypt->encrypt($vin),$this->MCrypt->encrypt($loggingInfo),$this->MCrypt->encrypt($exceededMileageWeight),$this->MCrypt->encrypt($taxAmount),$filingid,$createdBy);
			if($ExceededMileageVehiInformation=='Uploaded successfully')
			{
				$message = $constantArr['vehicle_added'][$_SESSION['lang']].$successFlag;
			}
			else if($ExceededMileageVehiInformation == 'Failed to upload')
			{
				$message = $constantArr['vehicle_not_added'][$_SESSION['lang']].$errorFlag;
			}
			else if($ExceededMileageVehiInformation == 'VIN Number already exist')
			{
				$message = $constantArr['VIN_already_exists'][$_SESSION['lang']].$errorFlag;
			}
		}		
		return $message;
		
	}
	
	//getting records from tt_filing_exceeded_mileage_vehicle table
	public function getExceededMileageVehiInfo($userid,$filingid)
	{
		$ExceededMileageVehiInfo = $this->exceededmileageinfoDAO->getExceededMileageVehiDetails($userid,$filingid);
		return $ExceededMileageVehiInfo;
	}
	
	//edit
	public function editExceededMileageFilingVehiDetails($TaxableId,$selectedBusiness)
	{
		$ExceededMileageFilingVehiInfo = $this->exceededmileageinfoDAO->exceededMileageFilingVehiDetails($TaxableId,$selectedBusiness);
		return $ExceededMileageFilingVehiInfo;
	}
	
	//update
	public function updateExceededMileageVehiInfo($businessId, $licenceNo,$vin,$exceededMileageWeight,$loggingInfo,$TaxableId,$filingid,$filingMonth,$filingYear,$modifiedBy)
	{
		global $taxmonthAry,$constantArr;
		
		// Change month from integer to string / month name
		$monthName = date("F", mktime(0, 0, 0, $filingMonth, 10)); 
		// Get remaining month for calculation
		$filingMonthId = $taxmonthAry[$monthName];
		//$filingMonthId = $taxmonthAry[end(explode(' ',$filingMonth))];
		/*ecoh $filingYear.' , '.$filingMonthId.' , '.$exceededMileageWeight.' , '.$loggingInfo;
		die;*/
		if(isset($_SESSION['admin_filing_year']) && $_SESSION['admin_filing_year'] > 0){
			$taxYearId = $this->exceededmileageinfoDAO->getTaxFilingYearDetails($filingYear);
			$filingYear= $taxYearId['id'];
		}
		
		$errorFlag = '~error';
		$successFlag = '~success';
		$chkVin = chkVin($vin);
		if($chkVin > 0)
		{
			$message = $constantArr['EnterValidvin'][$_SESSION['lang']].$errorFlag;
		}
		else if($exceededMileageWeight == '')
		{
			$message = $constantArr['selectWeight'][$_SESSION['lang']].$errorFlag;
		}
		else if($loggingInfo == '')
		{
			$message = $constantArr['selectLogging'][$_SESSION['lang']].$errorFlag;
		}
		else 
		{
			if($licenceNo != '')
			{
				// Checking whether licence number exists
				$chkLicenceNo = chkLicenceNo($businessId, $licenceNo, $this->MCrypt->encrypt($vin), $this->MCrypt->encrypt($exceededMileageWeight), $this->MCrypt->encrypt($loggingInfo),$modifiedBy);
			}
			
			$taxAmount = $this->exceededmileageinfoDAO->getTaxAmount($filingYear,$filingMonthId,$exceededMileageWeight,$loggingInfo);
			$updateExceededMileageVehiInfo = $this->exceededmileageinfoDAO->updateExceededMileageVehiInfo($this->MCrypt->encrypt($vin),$this->MCrypt->encrypt($exceededMileageWeight),$this->MCrypt->encrypt($loggingInfo),$this->MCrypt->encrypt($taxAmount),$TaxableId,$modifiedBy);
		
			if($updateExceededMileageVehiInfo == 'updated')
			{
				$message = $constantArr['vehicle_updated'][$_SESSION['lang']].$successFlag;
			}
			else if($updateExceededMileageVehiInfo == 'not_updated')
			{
				$message = $constantArr['vehicle_not_updated'][$_SESSION['lang']].$errorFlag;
			}
		}
		return $message;
	}
}
?>