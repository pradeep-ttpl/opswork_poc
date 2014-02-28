<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : solddestroycredit_biz.php
 * @version  : 1.0
 * @date  : 20-Jul-2012
 *
 * @description :
 *
 * @author      : Manojkumar
 *
 * History of modifications:
 *
 * Author                      Date                  Description of modifications
 * ----------                  ------------          ------------------------------
 * Manojkumar           	   20-Jul-2012           Initial Version - File Created
 * Akila				       23-Jul-2012           Add,edit - issue fixed.
 * Akila				       23-Jul-2012           delete functionality added.
 * Naveen					   26-Jul-2012			 Partial tax calculations implemented.
 */

class Solddestroycredit_Model
{		
	public function __construct()
	{
		$solddestroycreditDAO = new Solddestroycredit_DAO;
		$this->solddestroycredit = $solddestroycreditDAO;
		
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
		
	}
	
	public function getPendingFiling($user_id,$filingid)
	{
		$getPendingFiling = $this->solddestroycredit->getPendingFiling($user_id,$filingid);
		return $getPendingFiling;
	}
	public function addSoldDestroyInfo($businessId,$licenceNo,$user_id,$filingid,$formType,$filingMonth,$vin,$lossType,$soldYear,$firstYear,$logging,$weight,$explanation,$date,$createdBy)
	{
		global $taxmonthAry,$monthAry,$docAllowedTypes,$constantArr;
		
		$currentDate = date('Y-m-d');
		$firstUsedMonth = date('m',strtotime($firstYear));
		$firstUsedYear = date('Y',strtotime($firstYear));
		
		 if($firstUsedMonth < 7)
		 { 
			 $yearLimitFrom = $firstUsedYear - 1;
			 $yearLimitTo = $firstUsedYear;
		 }
		 else
		 { 
			$yearLimitFrom = $firstUsedYear;
			$yearLimitTo = $firstUsedYear + 1;
		 }
		 
		 $yearLimitFrom = date($yearLimitFrom.'-06-30');
		 $yearLimitTo = date($yearLimitTo.'-07-01');
		 
		$count = 1;
		if((strtotime($soldYear) > strtotime($yearLimitFrom)) && (strtotime($soldYear) < strtotime($yearLimitTo)))
		$count = 1;
		else 
		$count = 0;
		 
		$errorFlag = '~error';
		$successFlag = '~success';
		$chkVin = chkVin($vin);
		/*$checkTaxableCount = checkTaxableCreditAmount($filingid);
		
		if($checkTaxableCount == 0 && $formType == '2290')
		{
			$message = $constantArr['noTaxableVehicleFound'][$_SESSION['lang']];
		}
		else*/ if($chkVin > 0)
		{
			$message = $constantArr['EnterValidvin'][$_SESSION['lang']].$errorFlag;
		}
		else if($weight == '')
		{
			$message = $constantArr['selectWeight'][$_SESSION['lang']].$errorFlag;
		}
		else if($logging == '')
		{
			$message = $constantArr['selectLogging'][$_SESSION['lang']].$errorFlag;
		}
		else if($firstYear == '')
		{
			$message = $constantArr['selectFirstusedMonth'][$_SESSION['lang']].$errorFlag;
		}
		else if(strtotime($firstYear) > strtotime($currentDate))
		{
			$message = $constantArr['firstMonth_notSameYear'][$_SESSION['lang']].$errorFlag;
		}
		else if($soldYear == '')
		{
			$message = $constantArr['selectSoldDate'][$_SESSION['lang']].$errorFlag;
		}
		else if(strtotime($soldYear) > strtotime($currentDate))
		{
			$message = $constantArr['soldDestroyed_notSameYear'][$_SESSION['lang']].$errorFlag;
		}
		else if(strtotime($firstYear) > strtotime($soldYear))
		{
			$message = $constantArr['SoldDestroyed_WithinTaxYear'][$_SESSION['lang']].$errorFlag;
		}
		else if($count == 0)
	 	{
	 		$message = $constantArr['SoldDestroyed_WithinTaxYear'][$_SESSION['lang']].$errorFlag;
	 	}
		else if($lossType == '')
		{
			$message = $constantArr['selectLossType'][$_SESSION['lang']].$errorFlag;
		}
		else if($firstYear > $soldYear)
		{
			$message = $constantArr['soldDestroyed_withintaxyear'][$_SESSION['lang']].$errorFlag;
		}
		else if($explanation == '')
		{
			$message = $constantArr['enterExplanation'][$_SESSION['lang']].$errorFlag;
		}
		else 
		{
			 //To get Tax year
			
			 if($firstUsedMonth < 7)
			 { 
				 $taxYear = $firstUsedYear - 1;
			 }
			 else
			 { 
				$taxYear = $firstUsedYear;
			 }
			
			 $getTaxYear = $this->solddestroycredit->getTaxYear($taxYear);
			 $year = $getTaxYear['tax_year'];
			
			/*
			 * Code removed due to 8849 form,since there is no tax year for 8849.
			 * 
			$getPendingFiling = $this->solddestroycredit->getPendingFiling($user_id,$filingid);
			
			foreach ( $getPendingFiling as $key => $value ) 
			{
				$string = $value['filing_year'];
			} 
			
			//$string = strip_to_numbers_only($string);
			$year = $string - 1;
			
			*/
			
			$soldArr = array();
			$soldArr['VIN'] 		= trim($this->MCrypt->encrypt($vin));
			$soldArr['LossType'] 	= $this->MCrypt->encrypt($lossType);
			
			$solddate = $soldYear;
			$sold_date = explode("-",$solddate);
			$soldyear = $sold_date[0];
			
			//first used month
			$firstmonth = $firstYear;
			$first_month = explode("-",$firstmonth);
			$firstyear = $first_month[0];
			
			$soldArr['soldDate']	= $this->MCrypt->encrypt($soldYear);
			$soldArr['logging']		= $this->MCrypt->encrypt($logging);
			$soldArr['weight']		= $this->MCrypt->encrypt($weight);
			$soldArr['FirstUsedmonth']		= $this->MCrypt->encrypt($firstYear);
	
//			$tax_paid_upto = $string.'-07-01';
			
			//calculating total credit month
			// sold/detroyed date moth less than year end
			if($sold_date[1] > 6){
				// subtract by 12 to get remaing months add next year 6 months.
				$month_difference = 12-$sold_date[1];
				$month_difference = $month_difference + 6; 
			}else{
				$month_difference = 6-$sold_date[1];
			}
			
			$soldArr['document'] = '';
			$newFilename = '';
			if(isset($_FILES['document']['name']) && $_FILES['document']['name'] !='')
			{
				$newFilename = $user_id.'_'.$filingid.'_'.date('Ymdhis');
				$ext = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
				$soldArr['document'] = $this->MCrypt->encrypt($newFilename.'.'.$ext);
			}
			
			if(isset($explanation))
			$soldArr['explanation'] = $this->MCrypt->encrypt(trim($explanation));
			else 
			$soldArr['explanation'] = '';
			
			if($licenceNo != '')
			{
				// Checking whether licence number exists
				$chkLicenceNo = chkLicenceNo($businessId, $licenceNo, $this->MCrypt->encrypt($vin), $this->MCrypt->encrypt($weight), $this->MCrypt->encrypt($logging),$user_id);
			}
			
			$taxAmount = $this->solddestroycredit->getSoldDestroyTaxAmount($year,$month_difference,$weight,$logging);
			$taxAmount = floor($taxAmount);
			
			/*$chkCreditExceeded = chkCreditExceeded($taxAmount,$filingid,'solddestroyed','');
			
			if($chkCreditExceeded <= 0 && $formType == '2290')
			{	
				$message = $constantArr['creditExceeded'][$_SESSION['lang']];
			}
			else 
			{*/	
				$soldArr['taxAmount']	= $this->MCrypt->encrypt($taxAmount);
				
				$tmpMntYearArray = explode(' ',$filingMonth);
				
				if(isset($_FILES['document']['name']) && $_FILES['document']['name'] !='')
				{
					if(in_array($_FILES['document']['type'],$docAllowedTypes))
					{
						$target = TT_UPLOAD_PATH;
						move_uploaded_file ( $_FILES['document']['tmp_name'] ,$target.$newFilename.'.'.$ext );
						$addSoldStatus = $this->solddestroycredit->addSoldDestroyInfo( $soldArr,$filingid,$date,$createdBy);
					}
				}
				else 
				{
					if($soldYear >= $firstYear)
					{
						$addSoldStatus = $this->solddestroycredit->addSoldDestroyInfo( $soldArr,$filingid,$date,$createdBy);
					}
					else 
					{
						$message = "Sold date should be future date".$errorFlag;
					}
				}
				if($addSoldStatus=='inserted')
				{
					$message = $constantArr['vehicle_added'][$_SESSION['lang']].$successFlag;
				}
				else if($addSoldStatus=='not_inserted')
				{
					$message = $constantArr['vehicle_not_added'][$_SESSION['lang']].$errorFlag;
				}
				else if($addSoldStatus=='already_exists')
				{
					$message = $constantArr['VIN_already_exists'][$_SESSION['lang']].$errorFlag;
				}
			//}
		}
		return $message;
	}
	public function getSoldDestroyCreditInfo($userid,$filingid)
	{
		$soldArr = $this->solddestroycredit->getSoldDestroyCreditInfo($userid,$filingid);
		return $soldArr;
	}
	// Edit Information
	public function editSoldDestroyInfo($businessId,$sldDtroyCrdId)
	{
		$editSoldRes = $this->solddestroycredit->editSoldDestroyInfo($businessId,$sldDtroyCrdId);
		return $editSoldRes;
	}
	// Update Information
	public function updateSoldDestroyInfo($businessId, $licenceNo,$user_id,$filingid,$sldDtroyCrdId,$vin,$lossType,$soldYear,$firstYear,$logging,$weight,$explanation,$uploadDocumentName,$modifiedBy)
	{		
		global $monthAry,$taxmonthAry,$docAllowedTypes,$constantArr;
		
		$errorFlag = '~error';
		$successFlag = '~success';
		$chkVin = chkVin($vin);
		if($chkVin > 0)
		{
			$message = $constantArr['EnterValidvin'][$_SESSION['lang']].$errorFlag;
		}
		else if($weight == '')
		{
			$message = $constantArr['selectWeight'][$_SESSION['lang']].$errorFlag;
		}
		else if($logging == '')
		{
			$message = $constantArr['selectLogging'][$_SESSION['lang']].$errorFlag;
		}
		else if($firstYear == '')
		{
			$message = $constantArr['selectFirstusedMonth'][$_SESSION['lang']].$errorFlag;
		}
		else if($soldYear == '')
		{
			$message = $constantArr['selectSoldDate'][$_SESSION['lang']].$errorFlag;
		}
		else if($lossType == '')
		{
			$message = $constantArr['selectLossType'][$_SESSION['lang']].$errorFlag;
		}
		else if($firstYear > $soldYear)
		{
			$message = $constantArr['soldDestroyed_withintaxyear'][$_SESSION['lang']].$errorFlag;
		}
		else if($explanation == '')
		{
			$message = $constantArr['enterExplanation'][$_SESSION['lang']].$errorFlag;
		}
		else 
		{
			$soldArr = array();
			
			$soldArr['VIN'] 		= $this->MCrypt->encrypt(trim($vin));
			$soldArr['LossType'] 	= $this->MCrypt->encrypt($lossType);
			$solddate = $soldYear;
			$sold_date = explode("-",$solddate);
			$soldyear = $sold_date[0];
			
			//first used month
			$firstmonth = $firstYear;
			$first_month = explode("-",$firstmonth);
			$firstyear = $first_month[0];
			
			 if($first_month[1] < 7)
			 {
				 $year = $firstyear - 1;
			 }
			 else
			 {
				 $year = $firstyear;
			 }
			
			$soldArr['soldDate']	= $this->MCrypt->encrypt($soldYear);
			$soldArr['logging']		= $this->MCrypt->encrypt($logging);
			$soldArr['weight']		= $this->MCrypt->encrypt($weight);
			$soldArr['FirstUsedmonth']		= $this->MCrypt->encrypt($firstYear);
	
//			$tax_paid_upto = $string.'-07-01';
			if($sold_date[1] > 6){
				$month_difference = 12-$sold_date[1];
				$month_difference = $month_difference + 6; 
			}else{
				$month_difference = 6-$sold_date[1];
			}
			
			if($licenceNo != '')
			{
				// Checking whether licence number exists
				$chkLicenceNo = chkLicenceNo($businessId, $licenceNo, $this->MCrypt->encrypt($vin), $this->MCrypt->encrypt($weight), $this->MCrypt->encrypt($logging),$user_id);
			}
			
			$taxAmount = $this->solddestroycredit->getSoldDestroyTaxAmount($year,$month_difference,$weight,$logging);
			$taxAmount = floor($taxAmount);
			
			/*$chkCreditExceeded = chkCreditExceeded($taxAmount,$filingid,'solddestroyed',$sldDtroyCrdId);
			
			if($chkCreditExceeded <= 0 && $formType == '2290')
			{
				$message = $constantArr['creditExceeded'][$_SESSION['lang']];
			}
			else 
			{*/
			
				if(isset($_FILES['document']['name']) && $_FILES['document']['name'] !='')	
				{			
					$newFilename = $user_id.'_'.$filingid.'_'.date('Ymdhis');
					$ext = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
					$soldArr['document'] = $this->MCrypt->encrypt($newFilename.'.'.$ext);
				}		
				else 					
				$soldArr['document'] = $uploadDocumentName;						
				
				if(isset($explanation) && $explanation!='')
				$explanation = $this->MCrypt->encrypt(trim($explanation));
				else 
				$explanation = '';
				
				if(isset($_FILES['document']['name']) && $_FILES['document']['name'] !='')
				{
					if(in_array($_FILES['document']['type'],$docAllowedTypes))
					{
						$target = TT_UPLOAD_PATH;
						move_uploaded_file ( $_FILES['document']['tmp_name'] ,$target.$newFilename.'.'.$ext);
					}
				}
				
				if($soldYear >= $firstYear)
				{
					$this->solddestroycredit->updateSoldDestroyInfo($this->MCrypt->encrypt($taxAmount),$this->MCrypt->encrypt($lossType),$explanation,$soldArr,$sldDtroyCrdId,$this->MCrypt->encrypt($vin),$modifiedBy);
					$message = $constantArr['vehicle_updated'][$_SESSION['lang']].$successFlag;
				}
				else 
				{
					$message = "Sold date should be future date".$errorFlag;
				}
			//}
		}	
		return $message;
	}
	
	//Excel bulk upload process
	public function uploadExcel($filingid)
	{
		global $monthAry,$taxmonthAry;
		include TT_ENTITY_PATH.'/taxablevehicleinfo_entity.php';
		
		require_once TT_SITE_PATH.'/excel_upload/reader.php';
		$errorFlag = '~error';
		$successFlag = '~success';
		
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
		
		if(sizeof($data->sheets[0]['cells']) > 1){
					$i=1;
					foreach ($data->sheets[0]['cells'] as $key => $value)
					{
						if($key > 1)
						{	
								$explanation = '';
								$document = '';
								$UserBizTaxFilingId = 1;							
								$VIN = $value[1];
								$GrossWeight = $value[2];
								$GrossWeightCategory = substr($GrossWeight,0,1);						
								$IsLogging = $value[3];
								$LossTypevalue = $value[4];
								
								if($IsLogging == '1')
								$IsLogging = 'Y';								
								else if($IsLogging == '0')
								$IsLogging = 'N';
								
								$Sold_date = '';
								if($value[5] !='' && $value[6] !=''){
									$FirstUsedmon = $value[5];
									$Sold_date = $value[6];
									$timestamp = ($Sold_date - 25569) * 86400; 
									$SoldDate = date('Y-m-d', $timestamp);//sold date
									$sold_date = explode("-",$SoldDate);
									$timestamp = ($FirstUsedmon - 25569) * 86400; 
									$FirstUsedMonth = date('Y-m-d', $timestamp);
									//first used month
									$first_month = explode("-",$FirstUsedMonth);
									$firstyear = $first_month[0];
				
									if($first_month[1] < 6)
									{
										$year = $firstyear - 1;
									 	$yearLimitFrom = $firstyear - 1;
									 	$yearLimitTo = $firstyear;
									}
									else
									{
									 	$year = $firstyear;
									 	$yearLimitFrom = $firstyear;
									 	$yearLimitTo = $firstyear+1;								 
									}
					 				$yearLimitFrom	= $yearLimitFrom.'-06-30';
			 						$yearLimitTo 	= $yearLimitTo.'-07-01';
//									$tax_paid_upto = $string.'-07-01';
									if($sold_date[1] > 6){
										$month_difference = 12-$sold_date[1];
										$month_difference = $month_difference + 6; 
									}else{
										$month_difference = 6-$sold_date[1];
									}
									
									$creditTaxAmount = $this->solddestroycredit->getSoldDestroyTaxAmount($year,$month_difference,$GrossWeightCategory,$IsLogging);
								}							
							if($SoldDate > $yearLimitFrom && $SoldDate < $yearLimitTo && $SoldDate !=''){							
								if(!empty($VIN) && !empty($GrossWeightCategory) && !empty($IsLogging) && !empty($FirstUsedMonth))
								{
									if($SoldDate >= $FirstUsedMonth)
									{
										$InsertTaxVehiDetails =  $this->solddestroycredit->addbulksoldvehicle( $filingid,$VIN,$GrossWeightCategory,$IsLogging,$LossTypevalue,$FirstUsedMonth,$creditTaxAmount,$SoldDate);	
									}
									else 
									{
										$fileErrorMsg .= $VIN."- Sold date should be future date<br/>";
									}
								}
							}else{
								$fileErrorMsg .= "VIN: ".$VIN." - Invalid date<br/>";
							}
						}
						$i++;
					}
			if($fileErrorMsg != ''){
				$message = $fileErrorMsg.$errorFlag;
			}else{
				$message = 'Uploaded Successfully'.$successFlag;	
			}				 
		 }else{
		 	$message = 'Excel file contains no records.'.$errorFlag;
		 }	
		}
		return $message;
	}
}
?>