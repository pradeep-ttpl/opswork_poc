<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : lowmileagecredit_biz.php
 * @version  : 1.0
 * @date  : 21-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Manojkumar            21-Jul-2012           Initial Version - File Created
 * 
 */
 class Lowmileagecredit_Model
 {
	 public function __construct()
	 {
		 $lowMileageCrditDAO = new Lowmileagecredit_DAO;
		 $this->lowMileageCrditDAO = $lowMileageCrditDAO;
		 
		 $exceededmileagevehicleinfoDAO = new Exceededmileage_DAO;
		 $this->exceededmileageinfoDAO = $exceededmileagevehicleinfoDAO;
		 
		 $MCrypt	= new MCrypt;
		 $this->MCrypt = $MCrypt;
	 }
	 
	//Getting the list of weights from 'tt_tax_computation_master' table
	public function getTaxweight()
	{
		$taxWeightlist = $this->lowMileageCrditDAO->taxWeightlist();		
		return $taxWeightlist;
	}
	
 	public function getcreditVehiInfo($userid,$filingid)
	{
		$CreditVehiInfo = $this->lowMileageCrditDAO->getcreditVehiDet($userid,$filingid);
		return $CreditVehiInfo;
	}
	
	//Inserting taxable vehicle information in 'tt_filing_low_mileage' table
	public function addLowMileage($businessId, $licenceNo,$vin,$TaxweightId,$loggingInfo,$monthused,$explanation,$user_id,$filingid,$formType,$filingYear,$date,$createdBy)
	{
		global $monthAry,$taxmonthAry,$constantArr,$docAllowedTypes;
		
		$currentMonth = date('m');
		$currentYear = date('Y');
		
		if($currentMonth < 7)
		$yearLimit = $currentYear - 1;
		else
		$yearLimit = $currentYear;
		
		$dateLimit = date($yearLimit.'-07-01');
		
		//To get Tax year
		$firstUsedMonth = date('m',strtotime($monthused));
		$firstUsedYear = date('Y',strtotime($monthused));
		
		if($firstUsedMonth < 7)
		{ 
			$filingYear = $firstUsedYear - 1;
		}
	    else
		{ 
			$filingYear = $firstUsedYear;
		}

		if(isset($_SESSION['admin_filing_year']) && $_SESSION['admin_filing_year'] > 0){
			$taxYearId = $this->exceededmileageinfoDAO->getTaxFilingYearDetails($filingYear);
			$filingYear= $taxYearId['id'];
		}
		else 
		{ 
			$taxYearId = $this->lowMileageCrditDAO->getTaxYearDetails($filingYear);
			$filingYear= $taxYearId['id'];
		}
		
		$errorFlag = '~error';
		$successFlag = '~success';
		$chkVin = chkVin($vin);
		/*$checkTaxableCount = checkTaxableCreditAmount($filingid);
		
		if($checkTaxableCount == 0 && $formType == '2290')
		{
			$message = $constantArr['noTaxableVehicleFound'][$_SESSION['lang']];
		}
		else */if($chkVin > 0)
		{
			$message = $constantArr['EnterValidvin'][$_SESSION['lang']].$errorFlag;
		}
		else if($TaxweightId == '')
		{
			$message = $constantArr['selectWeight'][$_SESSION['lang']].$errorFlag;
		}
		else if($loggingInfo == '')
		{
			$message = $constantArr['selectLogging'][$_SESSION['lang']].$errorFlag;
		}
		else if($monthused == '')
		{
			$message = $constantArr['selectFirstusedMonth'][$_SESSION['lang']].$errorFlag;
		}
		else if(strtotime($monthused) >= strtotime($dateLimit))
		{
			$message = $constantArr['FirstMonth_PastDate'][$_SESSION['lang']].$errorFlag;
		}
		else if($explanation == '')
		{
			$message = $constantArr['enterExplanation'][$_SESSION['lang']].$errorFlag;
		}
		else 
		{
			$document = '';
			$newFilename = '';
			if(isset($_FILES['document']['name']) && $_FILES['document']['name']!='')
			{
				$newFilename = $user_id.'_'.$filingid.'_'.date('Ymdhis');
				$ext = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
				$document = $newFilename.'.'.$ext;
			}
			
			//include TT_ENTITY_PATH.'/taxablevehicleinfo_entity.php';
			$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
			
			
			//$taxAmountArray = $taxablevehicleinfoDAO->taxAmount($TaxweightId);
			$tmpUsedMonthSplitAry	= explode('-',$monthused);
			$tmpUsedMntYear 	= $monthAry[$tmpUsedMonthSplitAry['1']];
			$calculatedMonth = $taxmonthAry[$tmpUsedMntYear];
			
			if($licenceNo != '')
			{
				// Checking whether licence number exists
				$chkLicenceNo = chkLicenceNo($businessId, $licenceNo, $this->MCrypt->encrypt($vin), $this->MCrypt->encrypt($TaxweightId), $this->MCrypt->encrypt($loggingInfo),$user_id);
			}
			
			//$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
			$creditTaxAmount = $taxablevehicleinfoDAO->getTaxAmount($filingYear, $calculatedMonth,$TaxweightId,$loggingInfo);
			$creditTaxAmount = floor($creditTaxAmount);
					
			/*
			if($reqVars['logging'] == 'Y')
			{
				if($tmpUsedMntYear != 'July'){
					$creditTaxAmount = (($taxAmountArray['taxLoggingVehicle'] * $calculatedMonth)/12);
				}else{
			 		$creditTaxAmount = $taxAmountArray['taxLoggingVehicle'];
				}
			}
			else
			{
				if($tmpUsedMntYear != 'July'){
					$creditTaxAmount = (($taxAmountArray['taxExceptLoggingVehicle'] * $calculatedMonth)/12);	
				}else{
					$creditTaxAmount = $taxAmountArray['taxExceptLoggingVehicle'];
				}
			}
			*/
			
			/*$chkCreditExceeded = chkCreditExceeded($creditTaxAmount,$filingid,'lowmileage','');
			
			if($chkCreditExceeded <= 0 && $formType == '2290')
			{
				$message = $constantArr['creditExceeded'][$_SESSION['lang']];
			}
			else 
			{*/
				if(isset($_FILES['document']['name']) && $_FILES['document']['name'] !='')
				{
					if(in_array($_FILES['document']['type'],$docAllowedTypes))
					{
						$target = TT_UPLOAD_PATH;
						move_uploaded_file ( $_FILES['document']['tmp_name'] ,$target.$newFilename.'.'.$ext );
						$TaxVehiInfo = $this->lowMileageCrditDAO->addlowmileageinfo($this->MCrypt->encrypt($vin),
										$this->MCrypt->encrypt($TaxweightId),$this->MCrypt->encrypt($loggingInfo),
										$this->MCrypt->encrypt($monthused),$filingid,$this->MCrypt->encrypt($explanation),
										$this->MCrypt->encrypt($document),$this->MCrypt->encrypt($creditTaxAmount),$date,$createdBy);
					}
				}
				else 
				{
					$TaxVehiInfo = $this->lowMileageCrditDAO->addlowmileageinfo($this->MCrypt->encrypt($vin),$this->MCrypt->encrypt($TaxweightId),
												$this->MCrypt->encrypt($loggingInfo),$this->MCrypt->encrypt($monthused),$filingid,$this->MCrypt->encrypt(trim($explanation)),
												$this->MCrypt->encrypt($document),$this->MCrypt->encrypt($creditTaxAmount),$date,$createdBy);
				}
				if($TaxVehiInfo=='inserted')
				{
					$message = $constantArr['vehicle_added'][$_SESSION['lang']].$successFlag;
				}
				else if($TaxVehiInfo=='not_inserted')
				{
					$message = $constantArr['vehicle_not_added'][$_SESSION['lang']].$errorFlag;
				}
				else if($TaxVehiInfo=='already_exists')
				{
					$message = $constantArr['VIN_already_exists'][$_SESSION['lang']].$errorFlag;
				}
			//}
		}
		return $message;
		 
	}
	 
 	public function getcreditdetails($lowMlgId,$businessId)
	{
		$CreditVehicleDet = $this->lowMileageCrditDAO->getcreditdet($lowMlgId,$businessId);
		return $CreditVehicleDet;
	}
	
	//Update
	public function updateCreditDetails($businessId, $licenceNo,$vin,$taxableGrossweight,$TaxweightId,$loggingInfo,$monthused,$explanation,$user_id,$filingid,$filingYear,$lowMlgId,$uploadDocumentName,$modifiedBy,$formType)
	{
		global $monthAry,$taxmonthAry,$constantArr,$docAllowedTypes;
		
		$currentMonth = date('m');
		$currentYear = date('Y');
		
		if($currentMonth < 7)
		$yearLimit = $currentYear - 1;
		else
		$yearLimit = $currentYear;
		
		$dateLimit = date($yearLimit.'-07-01');
		
		//To get Tax year
		$firstUsedMonth = date('m',strtotime($monthused));
		$firstUsedYear = date('Y',strtotime($monthused));
		
		if($firstUsedMonth < 7)
		{ 
			$filingYear = $firstUsedYear - 1;
		}
	    else
		{ 
			$filingYear = $firstUsedYear;
		}
		
		if(isset($_SESSION['admin_filing_year']) && $_SESSION['admin_filing_year'] > 0){
			$taxYearId = $this->exceededmileageinfoDAO->getTaxFilingYearDetails($filingYear);
			$filingYear= $taxYearId['id'];
		}
		else 
		{
			$taxYearId = $this->lowMileageCrditDAO->getTaxYearDetails($filingYear);
			$filingYear= $taxYearId['id'];
		}
		
		$errorFlag = '~error';
		$successFlag = '~success';
		$chkVin = chkVin($vin);
		if($chkVin > 0)
		{
			$message = $constantArr['EnterValidvin'][$_SESSION['lang']].$errorFlag;
		}
		else if($TaxweightId == '')
		{
			$message = $constantArr['selectWeight'][$_SESSION['lang']].$errorFlag;
		}
		else if($loggingInfo == '')
		{
			$message = $constantArr['selectLogging'][$_SESSION['lang']].$errorFlag;
		}
		else if($monthused == '')
		{
			$message = $constantArr['selectFirstusedMonth'][$_SESSION['lang']].$errorFlag;
		}
		else if(strtotime($monthused) >= strtotime($dateLimit))
		{
			$message = $constantArr['FirstMonth_PastDate'][$_SESSION['lang']].$errorFlag;
		}
		else if($explanation == '')
		{
			$message = $constantArr['enterExplanation'][$_SESSION['lang']].$errorFlag;
		}
		else 
		{
			if(isset($_FILES['document']['name']) && $_FILES['document']['name']!='')
			{
				$newFilename = $user_id.'_'.$filingid.'_'.date('Ymdhis');
				$ext = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
				$document = $this->MCrypt->encrypt($newFilename.'.'.$ext);
			}
			else 
			$document = $uploadDocumentName;
			
			//include TT_ENTITY_PATH.'/taxablevehicleinfo_entity.php';
			//$taxAmountArray = $taxablevehicleinfoDAO->taxAmountid($taxableGrossweight);
			
			$tmpUsedMonthSplitAry	= explode('-',$monthused);
			$tmpUsedMntYear 	= $monthAry[$tmpUsedMonthSplitAry['1']];
			$calculatedMonth = $taxmonthAry[$tmpUsedMntYear];
			
			$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
			$creditTaxAmount = $taxablevehicleinfoDAO->getTaxAmount($filingYear, $calculatedMonth,$TaxweightId,$loggingInfo);
			$creditTaxAmount = floor($creditTaxAmount);
			
			if($licenceNo != '')
			{
				// Checking whether licence number exists
				$chkLicenceNo = chkLicenceNo($businessId, $licenceNo, $this->MCrypt->encrypt($vin), $this->MCrypt->encrypt($TaxweightId), $this->MCrypt->encrypt($loggingInfo),$user_id);
			}
			
			/*
			if($reqVars['logging'] == 'Y')
			{
				if($tmpUsedMntYear != 'July'){
					$creditTaxAmount = (($taxAmountArray['taxLoggingVehicle'] * $calculatedMonth)/12);
				}else{
			 		$creditTaxAmount = $taxAmountArray['taxLoggingVehicle'];
				}
			}
			else
			{
				if($tmpUsedMntYear != 'July'){
					$creditTaxAmount = (($taxAmountArray['taxExceptLoggingVehicle'] * $calculatedMonth)/12);	
				}else{
					$creditTaxAmount = $taxAmountArray['taxExceptLoggingVehicle'];
				}
			}
			*/
			
			//$taxAmount = $this->lowMileageCrditDAO->taxAmountid($taxableGrossweight);
			
			//$TaxweightId = $taxAmountArray['id'];
			
			/*$chkCreditExceeded = chkCreditExceeded($creditTaxAmount,$filingid,'lowmileage',$lowMlgId);
			
			if($chkCreditExceeded <= 0 && $formType == '2290')
			{
				$message = $constantArr['creditExceeded'][$_SESSION['lang']];
			}
			else 
			{*/
				if(isset($_FILES['document']['name']) && $_FILES['document']['name'] !='')
				{
					if(in_array($_FILES['document']['type'],$docAllowedTypes))
					{
						$target = TT_UPLOAD_PATH;
						move_uploaded_file ( $_FILES['document']['tmp_name'] ,$target.$newFilename.'.'.$ext );
						//$CreditVehicleDet = $this->lowMileageCrditDAO->updateCreditDetails($vin,$TaxweightId,$loggingInfo,$monthused,$lowMlgId,$urlvin,$explanation,$document,$creditTaxAmount);
					}
				}
				
				$CreditVehicleDet = $this->lowMileageCrditDAO->updateCreditDetails($this->MCrypt->encrypt($vin),$this->MCrypt->encrypt($TaxweightId),
												$this->MCrypt->encrypt($loggingInfo),$this->MCrypt->encrypt($monthused),$lowMlgId,
												$this->MCrypt->encrypt(trim($explanation)),$document,$this->MCrypt->encrypt($creditTaxAmount),$modifiedBy);
				
				if($CreditVehicleDet=='updated')
				{
					$message = $constantArr['vehicle_updated'][$_SESSION['lang']].$successFlag;
				}
				else
				{
					$message = $constantArr['vehicle_not_updated'][$_SESSION['lang']].$errorFlag;
				}
			//}
		}
		return $message;
		
	}
	
 	//Excel bulk upload process
	public function uploadExcel($filingid,$filingYear)
	{
		global $monthAry,$taxmonthAry;
		//include TT_ENTITY_PATH.'/taxablevehicleinfo_entity.php';
		
		$errorFlag = '~error';
		$successFlag = '~success';
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
			$message = "Please select a file to upload".$errorFlag;
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
							$explanation = '';
							$document = '';
							$UserBizTaxFilingId = 1;							
							$VIN = $data1['cells'][$key][1];
							$GrossWeight = $data1['cells'][$key][2];
							$GrossWeightCategory = substr($GrossWeight,0,1);						
							$IsLogging = $data1['cells'][$key][3];
							$FirstUsedmon = $data1['cells'][$key][4];
							$timestamp = ($FirstUsedmon - 25569) * 86400; 
							$FirstUsedMonth = date('Y-m-d', $timestamp);
							
							if($IsLogging == '1')
							$IsLogging = 'Y';								
							else if($IsLogging == '0')
							$IsLogging = 'N';
							
							$grossWeightDetails = $this->lowMileageCrditDAO->grossWeightDetails($GrossWeightCategory);							
							$TaxWeightID = $grossWeightDetails['id'];	
							
							//Credit amount calculations
							
							//$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
							//$taxAmountArray = $taxablevehicleinfoDAO->taxAmount($TaxWeightID);
							$tmpUsedMonthSplitAry	= explode('-',$FirstUsedMonth);
							
							$tmpUsedMntYear 	= $monthAry[$tmpUsedMonthSplitAry['1']];
							$calculatedMonth    = $taxmonthAry[$tmpUsedMntYear];
								
						}		

							if(!empty($VIN) && !empty($TaxWeightID) && !empty($IsLogging) && !empty($FirstUsedMonth))
							{
								
								$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
								$creditTaxAmount = $taxablevehicleinfoDAO->getTaxAmount($filingYear, $calculatedMonth,$GrossWeightCategory,$IsLogging);
								
								/*
								if($IsLogging == 'Y')
								{
									if($tmpUsedMntYear != 'July'){
										$creditTaxAmount = (($taxAmountArray['taxLoggingVehicle'] * $calculatedMonth)/12);
									}else{
								 		$creditTaxAmount = $taxAmountArray['taxLoggingVehicle'];
									}
								}
								else
								{
									if($tmpUsedMntYear != 'July'){
										$creditTaxAmount = (($taxAmountArray['taxExceptLoggingVehicle'] * $calculatedMonth)/12);	
									}else{
										$creditTaxAmount = $taxAmountArray['taxExceptLoggingVehicle'];
									}
								}
								*/
								$InsertTaxVehiDetails = $this->lowMileageCrditDAO->addlowmileageinfo($VIN,$GrossWeightCategory,$IsLogging,$FirstUsedMonth,$filingid,$explanation,$document,$creditTaxAmount);							
							}
					}
					$i++;
				}
				
			}
		 }	
		$message = 'Uploaded Successfully'.$successFlag;
		}
		return $message;
	}
	
 }
?>