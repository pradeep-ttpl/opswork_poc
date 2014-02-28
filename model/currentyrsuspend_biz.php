<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : currentyrsuspend_biz.php
 * @version  : 1.0
 * @date  : 18-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila         		 18-Jul-2012           Initial Version - File Created
 * 
 */
class Currentyrsuspend_Model
{
	public function __construct()
	{		
		$currentyrsuspend = new currentyrsuspend_DAO;
		$this->currentyrsuspendDAO = $currentyrsuspend;
		
		// Intializing MCrypt class
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;		
	}
	//Inserting into TT_FilingSuspendVehicle table
	public function addNewCurrentsuspend($businessId,$licenceNo,$vin,$logcurrent,$agrivehicle,$filingid,$createdBy)
	{
		global $constantArr;
		
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
		else if($logcurrent == '')
		{
			$message = $constantArr['selectLogging'][$_SESSION['lang']].$errorFlag;
		}
		else if($agrivehicle == '')
		{
			$message = $constantArr['selectAgriVehicle'][$_SESSION['lang']].$errorFlag;
		}
		else 
		{
			if($licenceNo != '')
			{
				// Checking whether licence number exists
				$chkLicenceNo = chkLicenceNo($businessId, $licenceNo, $this->MCrypt->encrypt($vin), '', $this->MCrypt->encrypt($logcurrent),$createdBy);
			}
			
			$TaxVehiInformation = $this->currentyrsuspendDAO->addCurrentsuspend($this->MCrypt->encrypt($vin),$this->MCrypt->encrypt($logcurrent),$this->MCrypt->encrypt($agrivehicle),$filingid,$createdBy);
		
			if($TaxVehiInformation=='inserted')
			{
				$message = $constantArr['vehicle_added'][$_SESSION['lang']].$successFlag;
			}
			else if($TaxVehiInformation=='not_inserted')
			{
				$message = $constantArr['vehicle_not_added'][$_SESSION['lang']].$errorFlag;
			}
			else if($TaxVehiInformation=='already_exists')
			{
				$message = $constantArr['VIN_already_exists'][$_SESSION['lang']].$errorFlag;
			}
		}
		
		return $message;
		
	}
	
	//getting records from TT_FilingSuspendVehicle table
	public function getCursuspendInfo($userid,$filingid)
	{
		$currsuspendVehiInfo = $this->currentyrsuspendDAO->CurrentsuspendInfo($userid,$filingid);
		return $currsuspendVehiInfo;
	}
	
	//edit
	public function editCurrentSuspendVehi($crntYrSpndid)
	{
		$editcurrentsuspendvehivle = $this->currentyrsuspendDAO->editCurrentsuspend($crntYrSpndid);
		return $editcurrentsuspendvehivle;
	}
	
	//update
	public function updatesuspend($businessId,$licenceNo,$crntYrSpndid,$vin,$logging,$farmingAgriculture,$modifiedBy)
	{
//		$currentsuspendUpdateStatus = array();

		global $constantArr;
		
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
		else if($logging == '')
		{
			$message = $constantArr['selectLogging'][$_SESSION['lang']].$errorFlag;
		}
		else if($farmingAgriculture == '')
		{
			$message = $constantArr['selectAgriVehicle'][$_SESSION['lang']].$errorFlag;
		}
		else 
		{
			if($licenceNo != '')
			{
				// Checking whether licence number exists
				$chkLicenceNo = chkLicenceNo($businessId, $licenceNo, $this->MCrypt->encrypt($vin), '', $this->MCrypt->encrypt($logging),$modifiedBy);
			}
			
			$suspendData = $this->currentyrsuspendDAO->updateCurrentsuspend($crntYrSpndid,$this->MCrypt->encrypt($vin),$this->MCrypt->encrypt($logging),$this->MCrypt->encrypt($farmingAgriculture),$modifiedBy);
		
			if($suspendData=='updated')
			{
				$message = $constantArr['vehicle_updated'][$_SESSION['lang']].$successFlag;
			}
			else if($suspendData == 'not_updated')
			{
				$message = $constantArr['vehicle_not_updated'][$_SESSION['lang']].$errorFlag;
			}
		}
		
		return $message;
		
//		return $currentsuspendUpdateStatus;	
	}
}
?>