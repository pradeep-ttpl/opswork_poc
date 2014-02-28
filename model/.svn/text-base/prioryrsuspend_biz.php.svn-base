<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : prioryrsuspend_biz.php
 * @version  : 1.0
 * @date  : 20-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila         		 20-Jul-2012           Initial Version - File Created
 * 
 */

class Prioryrsuspend_Model
{
	public function __construct()
	{		
		$prioryrsuspendDAO = new Prioryrsuspend_DAO;
		$this->prioryrsuspendDAO = $prioryrsuspendDAO;
		
		// Intializing MCrypt class
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;		
	}
	
	//Adding the prior year suspended vehicle information in 'TT_FilingPreviousYear' Table
	public function addPriorYrSuspend($businessId,$licenceNo,$vin,$exceededMileage,$priorSoldorTrans,$soldTransTo,$transSold_date,$filingid,$createdBy)
	{
//		$transBuyerName = $buyer_name;
		global $constantArr;
		
		$currentMonth = date('m');
		$currentYear = date('Y');
		
		if($currentMonth < 7)
		$yearLimit = $currentYear - 1;
		else
		$yearLimit = $currentYear;
		
		$dateLimit = date($yearLimit.'-07-01');
		
		$checkVin  = chkVin($vin);
		$errorFlag = '~error';
		$successFlag = '~success';
		
		if($vin == '')
		{
			$message = $constantArr['EnterVin'][$_SESSION['lang']].$errorFlag;
		}
		else if($checkVin > 0)
		{
			$message = $constantArr['EnterValidvin'][$_SESSION['lang']].$errorFlag;
		}
		else if($exceededMileage == '' || $priorSoldorTrans == '')
		{
			$message = $constantArr['selectSuspension'][$_SESSION['lang']].$errorFlag;
		}
		else if($priorSoldorTrans != '')
		{	
			if($priorSoldorTrans == "Y")
			{	
				if($soldTransTo == '')
				{	
					$message = $constantArr['enterSoldTransfer'][$_SESSION['lang']].$errorFlag;
				}
				else if($transSold_date == '')
				{	
					$message = $constantArr['selectDate'][$_SESSION['lang']].$errorFlag;
				}
				else if($transSold_date != '')
				{	
					if(strtotime($transSold_date) >= strtotime($dateLimit))
					{
						$message = $constantArr['selectPastDate'][$_SESSION['lang']].$errorFlag;
					}
				}
				
			}
			
		}
		if(!isset($message))
		{
			if($licenceNo != '')
			{
				// Checking whether licence number exists
				$chkLicenceNo = chkLicenceNo($businessId, $licenceNo, $this->MCrypt->encrypt($vin), '', '',$createdBy);
			}
			
			$addPriYrSusDetails = $this->prioryrsuspendDAO->addPriorYrSusDet($this->MCrypt->encrypt($vin),$this->MCrypt->encrypt($exceededMileage),$this->MCrypt->encrypt($priorSoldorTrans),$this->MCrypt->encrypt($soldTransTo),$this->MCrypt->encrypt($transSold_date),$filingid,$createdBy);					

			if($addPriYrSusDetails=='inserted')
			{
				$message = $constantArr['vehicle_added'][$_SESSION['lang']].$successFlag;
			}
			else if($addPriYrSusDetails=='not_inserted')
			{
				$message = $constantArr['vehicle_not_added'][$_SESSION['lang']].$errorFlag;
			}
			else if($addPriYrSusDetails=='already_exists')
			{
				$message = $constantArr['VIN_already_exists'][$_SESSION['lang']].$errorFlag;
			}
			
		}
	
		return $message;
		
	}
	
	//Getting the all details of 'TT_FilingPreviousYear'
	public function getPriorYrSusinfo($userid,$filingid)
	{
		$PriorYrSusVehiInfo = $this->prioryrsuspendDAO->PriorYrSusVehiInfo($userid,$filingid);
		return $PriorYrSusVehiInfo;
	}
	
	//Getting the details of prior year suspended vehicle based on the VIN ID and TaxFilingId
	public function getprioryrsuspendvehiDet($preYrSpndId)
	{
		$PriorYrSusVehiDet = $this->prioryrsuspendDAO->getpriorsuspendvehiDet($preYrSpndId);
		return $PriorYrSusVehiDet;
	}
	
	//updating the prior year suspended vehicle details
	public function updatePriorYrSusVehi($businessId, $licenceNo,$vin,$soldTrans,$transSold_date,$exceededMileage,$priorYrSoldTrans,$preYrSpndId,$modifiedBy)
	{
		global $constantArr;
		
		$transBuyerName = $soldTrans;
		
		$currentMonth = date('m');
		$currentYear = date('Y');
		
		if($currentMonth < 7)
		$yearLimit = $currentYear - 1;
		else
		$yearLimit = $currentYear;
		
		$dateLimit = date($yearLimit.'-07-01');
		
		$checkVin  = chkVin($vin);
		$errorFlag = '~error';
		$successFlag = '~success';
		
		if($vin == '')
		{
			$message = $constantArr['EnterVin'][$_SESSION['lang']].$errorFlag;
		}
		else if($checkVin > 0)
		{
			$message = $constantArr['EnterValidvin'][$_SESSION['lang']].$errorFlag;
		}
		else if($exceededMileage == '' || $priorYrSoldTrans == '')
		{
			$message = $constantArr['selectSuspension'][$_SESSION['lang']].$errorFlag;
		}
		else if($priorYrSoldTrans != '')
		{	
			if($priorYrSoldTrans == "Y")
			{	
				if($soldTrans == '')
				{	
					$message = $constantArr['enterSoldTransfer'][$_SESSION['lang']].$errorFlag;
				}
				else if($transSold_date == '')
				{	
					$message = $constantArr['selectDate'][$_SESSION['lang']].$errorFlag;
				}
				else if($transSold_date != '')
				{	
					if(strtotime($transSold_date) >= strtotime($dateLimit))
					{
						$message = $constantArr['selectPastDate'][$_SESSION['lang']].$errorFlag;
					}
				}
			}
			
		}
		if(!isset($message))
		{
			if($licenceNo != '')
			{
				// Checking whether licence number exists
				$chkLicenceNo = chkLicenceNo($businessId, $licenceNo, $this->MCrypt->encrypt($vin), '', '',$modifiedBy);
			}
			
			$updatePriorYrSusVehiDetails = $this->prioryrsuspendDAO->updatePriorYrSusVehiDetails($this->MCrypt->encrypt($vin),$this->MCrypt->encrypt($exceededMileage),$this->MCrypt->encrypt($priorYrSoldTrans),$this->MCrypt->encrypt($transBuyerName),$this->MCrypt->encrypt($transSold_date),$preYrSpndId,$modifiedBy);
			
			if($updatePriorYrSusVehiDetails=='updated')
			{
				$message = $constantArr['vehicle_updated'][$_SESSION['lang']].$successFlag;
			}
			else if($updatePriorYrSusVehiDetails == 'not_updated')
			{
				$message = $constantArr['vehicle_not_updated'][$_SESSION['lang']].$errorFlag;
			}
		}

		return $message;
		
	}
}
?>