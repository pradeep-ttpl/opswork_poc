<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : taxablevehicleinfo_biz.php
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
class Taxablevehicleinfo_Model
{
	public function __construct()
	{		
		$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
		$this->taxablevehicleinfoDAO = $taxablevehicleinfoDAO;
		
		$exceededmileagevehicleinfoDAO = new Exceededmileage_DAO;
		$this->exceededmileageinfoDAO = $exceededmileagevehicleinfoDAO;
		 
		// Intializing MCrypt class
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
	}
	
	//Getting the list of weights from 'tt_tax_computation_master' table
	public function getTaxweight()
	{
		$taxWeightlist = $this->taxablevehicleinfoDAO->taxWeightlist();		
		return $taxWeightlist;
	}
	
	//Getting the list of weights from 'tt_tax_computation_master' table
	public function getUserVehicles($userId)
	{
		$userVehicles = $this->taxablevehicleinfoDAO->getUserVehicles($userId);		
		return $userVehicles;
	}
	
	//Inserting into tt_filing_taxable_vehicle table
	public function addTaxbleVehicle($businessId,$licenceNo,$vin,$loggingInfo,$taxableGrossweight,$filingYear,$filingMonthId,$filingid,$createdBy)
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
		else if($taxableGrossweight == '')
		{
			$message = $constantArr['selectWeight'][$_SESSION['lang']].$errorFlag;
		}
		else if($loggingInfo == '')
		{
			$message = $constantArr['selectLogging'][$_SESSION['lang']].$errorFlag;
		}
		else 
		{
			if(isset($_SESSION['admin_filing_year']) && $_SESSION['admin_filing_year'] > 0){
				$taxYearId = $this->exceededmileageinfoDAO->getTaxFilingYearDetails($filingYear);
				$filingYear= $taxYearId['id'];
			}
			
			if($licenceNo != '')
			{
				// Checking whether licence number exists
				$chkLicenceNo = chkLicenceNo($businessId, $licenceNo, $this->MCrypt->encrypt($vin), $this->MCrypt->encrypt($taxableGrossweight), $this->MCrypt->encrypt($loggingInfo),$createdBy);
			}
			
			$taxAmount = $this->taxablevehicleinfoDAO->getTaxAmount($filingYear,$filingMonthId,$taxableGrossweight,$loggingInfo);
			
			$TaxVehiInformation = $this->taxablevehicleinfoDAO->insertTaxVehiInfo($this->MCrypt->encrypt($vin),$this->MCrypt->encrypt($loggingInfo),$this->MCrypt->encrypt($taxableGrossweight),$this->MCrypt->encrypt($taxAmount),$filingid,$createdBy);
			
			if($TaxVehiInformation=='inserted')
			{	
				$message = $constantArr['vehicle_added'][$_SESSION['lang']].$successFlag;
			}
			else if($TaxVehiInformation == 'not_inserted')
			{	
				$message = $constantArr['vehicle_not_added'][$_SESSION['lang']].$errorFlag;
			}
			else if($TaxVehiInformation == 'already_exists')
			{	
				$message = $constantArr['VIN_already_exists'][$_SESSION['lang']].$errorFlag;
			}
		}
		
		return $message;
	}
	
	//getting records from tt_filing_taxable_vehicle table
	public function getTaxVehiInfo($filingid,$user_id)
	{
		$TaxVehiInfo = $this->taxablevehicleinfoDAO->getTaxVehiDetails($filingid,$user_id);
		return $TaxVehiInfo;
	}
	
	//edit
	public function editTaxFilingVehiDetails($TaxableId)
	{
		$TaxFilingVehiInfo = $this->taxablevehicleinfoDAO->TaxFilingVehiDetails($TaxableId);
		return $TaxFilingVehiInfo;
	}
	
	//update
	public function updateTaxVehiInfo($businessId,$licenceNo,$vin,$taxableGrossweight,$loggingInfo,$TaxableId,$filingYear,$filingMonthId,$filingid,$modifiedBy)
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
		else if($taxableGrossweight == '')
		{
			$message = $constantArr['selectWeight'][$_SESSION['lang']].$errorFlag;
		}
		else if($loggingInfo == '')
		{
			$message = $constantArr['selectLogging'][$_SESSION['lang']].$errorFlag;
		}
		else
		{
			if(isset($_SESSION['admin_filing_year']) && $_SESSION['admin_filing_year'] > 0){
				$taxYearId = $this->exceededmileageinfoDAO->getTaxFilingYearDetails($filingYear);
				$filingYear= $taxYearId['id'];
			}
			
			if($licenceNo != '')
			{
				// Checking whether licence number exists
				$chkLicenceNo = chkLicenceNo($businessId, $licenceNo, $this->MCrypt->encrypt($vin), $this->MCrypt->encrypt($taxableGrossweight), $this->MCrypt->encrypt($loggingInfo),$modifiedBy);
			}
			
			$taxAmount = $this->taxablevehicleinfoDAO->getTaxAmount($filingYear,$filingMonthId,$taxableGrossweight,$loggingInfo);
			
			$updateTaxVehiInfo = $this->taxablevehicleinfoDAO->updateTaxVehiInfo($this->MCrypt->encrypt($vin),$this->MCrypt->encrypt($taxableGrossweight),$this->MCrypt->encrypt($loggingInfo),$this->MCrypt->encrypt($taxAmount),$TaxableId,$modifiedBy);
			
			if($updateTaxVehiInfo=='updated')
			{
				$message = $constantArr['vehicle_updated'][$_SESSION['lang']].$successFlag;
			}
			else if($updateTaxVehiInfo == 'not_updated')
			{
				$message = $constantArr['vehicle_not_updated'][$_SESSION['lang']].$errorFlag;
			}
		}
		
		return $message;
	
	}
	
	//Excel upload process
	public function uploadExcel($filingMonthId,$filingYear,$filingid)
	{		
		require_once TT_SITE_PATH.'/excel_upload/reader.php';
		error_reporting(0);
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$name = $_FILES['excel']['name'];
		$name1 = substr($name, 0,strrpos($name,'.'));
		$tmp_folder_name = $_FILES['excel']['tmp_name'];
		$folderName = TT_SITE_PATH."/excelsheets/";	
		$moved = move_uploaded_file($_FILES["excel"]["tmp_name"],$folderName.$_FILES["excel"]["name"]);	
		$filename = $folderName.$name;
		//$temp_table_name = $date1.'_'.str_replace(" ","_",$name1);
		if($name=="")
		{
			$message = "Please select a file to upload";
		}
		else if(file_exists($filename))
		{
			$data->read($filename);
			foreach($data->sheets as $k=>$data1)
			 {
				if($data1[numRows]>0)
				{
					$i=1;	
					foreach ($data1['cells'] as $key => $value)
					{
						if($key > 1)
						{	
							
							foreach ($data1['cells'][$key] as $key1 => $value1)
							{								
								$VIN = $data1['cells'][$key][1];
								$GrossWeight = $data1['cells'][$key][2];
								$GrossWeightCategory = substr($GrossWeight,0,1);
								$IsLogging = $data1['cells'][$key][3];
								if($IsLogging == '1')
								{
									$IsLogging = 'Y';
								}
								else
								{
									$IsLogging = 'N';
								}
								
								$taxAmount = $this->taxablevehicleinfoDAO->getTaxAmount($filingYear,$filingMonthId,$GrossWeightCategory,$IsLogging);								
							}
							if(!empty($VIN) && !empty($GrossWeight) && !empty($IsLogging))
							{
								$InsertTaxVehiDetails = $this->taxablevehicleinfoDAO->insertTaxVehiInfo($VIN,$IsLogging,$GrossWeightCategory,$taxAmount,$filingid);							
							}
						}
						$i++;
					}
					
				}
			 }	
			 $message = $InsertTaxVehiDetails;
		}
		return $message;
	}
}
?>