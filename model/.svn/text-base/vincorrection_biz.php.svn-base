<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename 	: vincorrection_biz.php
 * @version  	: 1.0
 * @date  		: 03-Feb-2014
 *
 * @description : vin correction business logics present here 
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
class Vincorrection_Model
{
	public function __construct()
	{		
		$vinCorrectionDAO = new Vincorrection_DAO;
		$this->vinCorrectionDAO = $vinCorrectionDAO;
		
		 
		// Intializing MCrypt class
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
	}
	
	//Getting the list of VIN from 'tt_filing_vin_correction' table
	public function getAllNewCorrectingVIN($userId,$filingId,$selectedFilingId)
	{
		$vinCorrectionlist = $this->vinCorrectionDAO->getAllNewCorrectingVIN($userId,$filingId,$selectedFilingId);		
		return $vinCorrectionlist;
	}
	
	public function addVinCorrection($filingId,$previn,$vin,$vinCorrectionType,$grossWeightCategory,$logging,$createdDate,$createdBy)
	{
		
		global $constantArr,$taxmonthAry;	
		// Intializing MCrypt class
		$MCrypt	= new MCrypt;
		
		$errorFlag = '~error';
		$successFlag = '~success';
		
		$checkedPrevin = chkVin($previn);
		$checkedVin 	= chkVin($vin);

		if($checkedPrevin > 0)
		{
			$message = $constantArr['EnterValidPreviousvin'][$_SESSION['lang']].$errorFlag;
		}else if($checkedVin > 0)
		{
			$message = $constantArr['EnterValidCorrectionvin'][$_SESSION['lang']].$errorFlag;
		}
		else if($previn == $vin)
		{
			$message = $constantArr['PreAndCorrVinNotSame'][$_SESSION['lang']].$errorFlag;
		}
		else if($grossWeightCategory == '')
		{
			$message = $constantArr['selectWeight'][$_SESSION['lang']].$errorFlag;
		}
		else if($logging == '')
		{
			$message = $constantArr['selectLogging'][$_SESSION['lang']].$errorFlag;
		}
		else 
		{
		
			$addVinCorrection = $this->vinCorrectionDAO->addVinCorrection($filingId,$MCrypt->encrypt($previn),$MCrypt->encrypt($vin),$vinCorrectionType,$grossWeightCategory,$logging,$createdDate,$createdBy);		
			
			if($addVinCorrection=='inserted')
			{
				$message = $constantArr['vehicle_added'][$_SESSION['lang']].$successFlag;
			}
			else if($addVinCorrection == 'not_inserted')
			{
				$message = $constantArr['vehicle_not_added'][$_SESSION['lang']].$errorFlag;
			}
			else if($addVinCorrection == 'already_exists')
			{
				$message = $constantArr['VIN_already_exists'][$_SESSION['lang']].$errorFlag;
			}
		}
		return $message;
	}
	
	public function updateVinCorrection($filingId,$previn,$vin,$vinCorrectionType,$grossWeightCategory,$logging,$modifiedDate,$modifiedBy)
	{
		
		global $constantArr,$taxmonthAry;	
		// Intializing MCrypt class
		$MCrypt	= new MCrypt;
		
		$errorFlag = '~error';
		$successFlag = '~success';

		$checkedPrevin = chkVin($previn);
		$checkedVin 	= chkVin($vin);

		if($checkedPrevin > 0)
		{
			$message = $constantArr['EnterValidPreviousvin'][$_SESSION['lang']].$errorFlag;
		}else if($checkedVin > 0)
		{
			$message = $constantArr['EnterValidCorrectionvin'][$_SESSION['lang']].$errorFlag;
		}
		else if($previn === $vin)
		{
			$message = $constantArr['PreAndCorrVinNotSame'][$_SESSION['lang']].$errorFlag;
		}
		else if($logging == '')
		{
			$message = $constantArr['selectLogging'][$_SESSION['lang']].$errorFlag;
		}
		else 
		{
			$updateVinCorrection = $this->vinCorrectionDAO->updateVinCorrection($filingId,$MCrypt->encrypt($previn),$MCrypt->encrypt($vin),$vinCorrectionType,$grossWeightCategory,$logging,$modifiedDate,$modifiedBy);
			if($updateVinCorrection=='inserted')
			{
				$message = $constantArr['vehicle_added'][$_SESSION['lang']].$successFlag;
			}
			else if($updateVinCorrection == 'not_inserted')
			{
				$message = $constantArr['vehicle_not_added'][$_SESSION['lang']].$errorFlag;
			}
			else if($updateVinCorrection == 'already_exists')
			{
				$message = $constantArr['VIN_already_exists'][$_SESSION['lang']].$errorFlag;
			}
		}		
		return $message;
	}
	
	//Getting the list of pre-existing filings from 'tt_filings' table
	public function getSubmittedFilingList($userId,$filingYear,$filingBusiness,$filingMonth)
	{
		$submittedFilingList = $this->vinCorrectionDAO->getSubmittedFilingList($userId,$filingYear,$filingBusiness,$filingMonth);		
		return $submittedFilingList;
	}
	
	public function getAlreadyFiledVINs($filingId,$filingBusiness){
		$alreadyFiledVINsList = $this->vinCorrectionDAO->getAlreadyFiledVINs($filingId,$filingBusiness);
		return $alreadyFiledVINsList;
	}
	public function getOverAllCorrectingVIN($userId,$filingId)
	{
		$vinCorrectionlist = $this->vinCorrectionDAO->getOverAllCorrectingVIN($userId,$filingId);		
		return $vinCorrectionlist;
	}
}
?>