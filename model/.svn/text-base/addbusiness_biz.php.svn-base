<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : addbusiness_biz.php
 * @version  : 1.0
 * @date  : 13-Jul-2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           13-Jul-2012           Initial Version - File Created
 * 
 */

class Addbusiness_Model
{		
	public function __construct()
	{		
		// taxPayerBusiness DAO
		$addbusinessDAO = new Addbusiness_DAO;
		$this->addbusiness = $addbusinessDAO;
		
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
	}
	public function getBusinessTypes()
	{
		$businessTypes = $this->addbusiness->getBusinessTypes();
		return $businessTypes;
	}
	
	public function getCountryList()
	{
		$getCountryList = $this->addbusiness->getCountryList();
		return $getCountryList;
	}
	//Inserting into BizInfo
	public function addBusinessInformation($businessName,$businessType,$ownerFirstName,$ownerLastName,$EINId,$bizAddress1,$bizAddress2,$businessCountry,$businessCity,$businessState,$businessZipcode,$businessPhone,$businessEmail,$sigingAuthorityName,$sigingAuthoritytitle,$sigingAuthorityPhone,$sigingAuthorityPin,$tPdName,$tPdPhone,$tPdPin,$user_id,$date,$checkboxId)
	{
		global $constantArr;
		
		$errorFlag = '~error';
		$successFlag = '~success';
		
		$checkBusName   = checkBusName($businessName);
		$signAuthName   = checkName($sigingAuthorityName);
		$tPDesigneeName = checkName($tPdName);
		$checkAddress1  = checkAddress($bizAddress1);
		$checkAddress2  = checkAddress($bizAddress2);
		$checkCity  	= checkCity($businessCity);
		
	 	if($businessName == '')
		{
			$message = $constantArr['enterBusinessName'][$_SESSION['lang']].$errorFlag;
		}
		else if($checkBusName > 0)
		{
			$message = $constantArr['EnterValidBusName'][$_SESSION['lang']].$errorFlag;
		}
		else if($businessType == 0 || $businessType == '')
		{	
			$message = $constantArr['biz_type'][$_SESSION['lang']].$errorFlag;
		}
		else if($businessType == 1 && $ownerFirstName == '')
		{  
			if($ownerFirstName == '')
			{	
				$message = $constantArr['enterOwnerFirstName'][$_SESSION['lang']].$errorFlag;
			}
		}
		else if($businessType == 1 && $ownerLastName == '')
		{
			if($ownerLastName == '')
			{	
				$message = $constantArr['enterOwnerSecondName'][$_SESSION['lang']].$errorFlag;
			}
		}
		else if(strlen($EINId) == 0)
		{	
			$message = $constantArr['enterEIN'][$_SESSION['lang']].$errorFlag;
		} 
		else if($bizAddress1 == '')
		{	
			$message = $constantArr['enterbusinessAdress1'][$_SESSION['lang']].$errorFlag;
		}
		else if($checkAddress1 > 0)
		{
			$message = $constantArr['EnterValidAddress'][$_SESSION['lang']].$errorFlag;
		}
		else if($bizAddress2 !='' && $checkAddress2 > 0)
		{
			$message = $constantArr['EnterValidAddress'][$_SESSION['lang']].$errorFlag;
		}
		else if($businessCountry == '')
		{	
			$message = $constantArr['selectCountry'][$_SESSION['lang']].$errorFlag;
		}
		else if($businessState == '' || $businessState == 0)
		{	
			$message = $constantArr['selectState'][$_SESSION['lang']].$errorFlag;
		}
		else if($businessCity == '')
		{	
			$message = $constantArr['enterCity'][$_SESSION['lang']].$errorFlag;
		}
		else if($businessCountry == 1 && $checkCity > 0)
		{
			$message = $constantArr['EnterValidCity'][$_SESSION['lang']].$errorFlag;
		}
		else if($businessZipcode == '')
		{	
			$message = $constantArr['enterZipcode'][$_SESSION['lang']].$errorFlag;
		}
		else if($businessPhone == '')
		{	
			$message = $constantArr['enterPhonenumber'][$_SESSION['lang']].$errorFlag;
		}
		else if($businessEmail == '')
		{	
			$message = $constantArr['enterEmail'][$_SESSION['lang']].$errorFlag;
		}
		else if($sigingAuthorityName == '')
		{	
			$message = $constantArr['enterSignAuthorityName'][$_SESSION['lang']].$errorFlag;
		}
		else if($signAuthName > 0)
		{
			$message = $constantArr['EnterValidSignAuthName'][$_SESSION['lang']].$errorFlag;
		}
		else if($sigingAuthoritytitle == '')
		{	
			$message = $constantArr['enterSignAuthoritytitle'][$_SESSION['lang']].$errorFlag;
		}
		else if($sigingAuthorityPhone == '')
		{	
			$message = $constantArr['entersignAuthPhone'][$_SESSION['lang']].$errorFlag;
		}
		else if($sigingAuthorityPin == '')
		{	
			$message = $constantArr['entersignAuthPin'][$_SESSION['lang']].$errorFlag;
		}
		else if($checkboxId == 1)
		{	
			if($tPdName == '')
			{	
				$message = $constantArr['enterDesigneeName'][$_SESSION['lang']].$errorFlag;
			}
			else if($tPDesigneeName > 0)
			{
				$message = $constantArr['EnterValidTPDesName'][$_SESSION['lang']].$errorFlag;
			}
			else if($tPdPhone == '')
			{
				$message = $constantArr['enterDesigneePhone'][$_SESSION['lang']].$errorFlag;
			}
			else if($tPdPin == '')
			{
				$message = $constantArr['enterDesigneePin'][$_SESSION['lang']].$errorFlag;
			}
		}
		if(!isset($message))
		{
			//insert user business data into DB
			$addBusinessInfo = $this->addbusiness->addBusinessInformation($this->MCrypt->encrypt($businessName),$businessType,$this->MCrypt->encrypt($ownerFirstName),
							   $this->MCrypt->encrypt($ownerLastName),$this->MCrypt->encrypt($EINId),$this->MCrypt->encrypt($bizAddress1),
							   $this->MCrypt->encrypt($bizAddress2),$businessCountry,$this->MCrypt->encrypt($businessCity),$businessState,
							   $this->MCrypt->encrypt($businessZipcode),$this->MCrypt->encrypt($businessPhone),$this->MCrypt->encrypt($businessEmail),
							   $this->MCrypt->encrypt($sigingAuthorityName),$this->MCrypt->encrypt($sigingAuthoritytitle),
							   $this->MCrypt->encrypt($sigingAuthorityPhone),$this->MCrypt->encrypt($sigingAuthorityPin),$this->MCrypt->encrypt($tPdName),
							   $this->MCrypt->encrypt($tPdPhone),$this->MCrypt->encrypt($tPdPin),$user_id,$date);		
			
			if($addBusinessInfo=='inserted')
			{
				$message = $constantArr['business_added'][$_SESSION['lang']].$successFlag;
			}
			else if($addBusinessInfo=='not_inserted')  
			{
				$message = $constantArr['business_not_added'][$_SESSION['lang']].$errorFlag;
			}
			else if($addBusinessInfo=='already_exists')
			{
				$message = $constantArr['business_already_exists'][$_SESSION['lang']].$errorFlag;
			}
		}
		return $message;
		
	}
	public function getUsersBusinessInfo($user_id,$bizId)
	{
		$status = $this->addbusiness->getUsersBusinessInfo($user_id,$bizId);		
		return $status;
	}
	public function updateBusinessInfo($bizId,$user_id,$bizName,$bizType,$ownerFirstName,$ownerLastName,$bizEIN,$bizAddress1,$bizAddress2,$bizCountry,$bizselectState,$bizCity,$bizZip,$bizPhone,$bizEmail,$sigingAuthorityName,$sigingAuthoritytitle,$sigingAuthorityPhone,$sigingAuthorityPin,$tPdName,$tPdPhone,$tPdPin,$date,$modified_by,$checkboxId)
	{
		global $constantArr;
		
		$updatebusinessinfo = array();
		$errorFlag = '~error';
		$successFlag = '~success';
		
		$checkBusName   = checkBusName($bizName);
		$signAuthName   = checkName($sigingAuthorityName);
		$tPDesigneeName = checkName($tPdName);
		$checkAddress1  = checkAddress($bizAddress1);
		$checkAddress2  = checkAddress($bizAddress2);
		$checkCity  	= checkCity($bizCity);
		
		if($bizName == '')
		{
			$message = $constantArr['enterBusinessName'][$_SESSION['lang']].$errorFlag;
		}
		else if($checkBusName > 0)
		{
			$message = $constantArr['EnterValidBusName'][$_SESSION['lang']].$errorFlag;
		}
		else if($bizType == 0 || $bizType == '')
		{	
			$message = $constantArr['biz_type'][$_SESSION['lang']].$errorFlag;
		}
		else if($bizType == 1 && $ownerFirstName == '')
		{  
			if($ownerFirstName == '')
			{	
				$message = $constantArr['enterOwnerFirstName'][$_SESSION['lang']].$errorFlag;
			}
		}
		else if($bizType == 1 && $ownerLastName == '')
		{
			if($ownerLastName == '')
			{	
				$message = $constantArr['enterOwnerSecondName'][$_SESSION['lang']].$errorFlag;
			}
		}
		else if(strlen($bizEIN) == 0)
		{	
			$message = $constantArr['enterEIN'][$_SESSION['lang']].$errorFlag;
		} 
		else if($bizAddress1 == '')
		{	
			$message = $constantArr['enterbusinessAdress1'][$_SESSION['lang']].$errorFlag;
		}
		else if($checkAddress1 > 0)
		{
			$message = $constantArr['EnterValidAddress'][$_SESSION['lang']].$errorFlag;
		}
		else if($bizAddress2 !='' && $checkAddress2 > 0)
		{
			$message = $constantArr['EnterValidAddress'][$_SESSION['lang']].$errorFlag;
		}
		else if($bizCountry == '')
		{	
			$message = $constantArr['selectCountry'][$_SESSION['lang']].$errorFlag;
		}
		else if($bizselectState == '' || $bizselectState == 0)
		{	
			$message = $constantArr['selectState'][$_SESSION['lang']].$errorFlag;
		}
		else if($bizCity == '')
		{	
			$message = $constantArr['enterCity'][$_SESSION['lang']].$errorFlag;
		}
		else if($bizCountry == 1 && $checkCity > 0)
		{
			$message = $constantArr['EnterValidCity'][$_SESSION['lang']].$errorFlag;
		}
		else if($bizZip == '')
		{	
			$message = $constantArr['enterZipcode'][$_SESSION['lang']].$errorFlag;
		}
		else if($bizPhone == '')
		{	
			$message = $constantArr['enterPhonenumber'][$_SESSION['lang']].$errorFlag;
		}
		else if($bizEmail == '')
		{	
			$message = $constantArr['enterEmail'][$_SESSION['lang']].$errorFlag;
		}
		else if($sigingAuthorityName == '')
		{	
			$message = $constantArr['enterSignAuthorityName'][$_SESSION['lang']].$errorFlag;
		}
		else if($signAuthName > 0)
		{
			$message = $constantArr['EnterValidSignAuthName'][$_SESSION['lang']].$errorFlag;
		}
		else if($sigingAuthoritytitle == '')
		{	
			$message = $constantArr['enterSignAuthoritytitle'][$_SESSION['lang']].$errorFlag;
		}
		else if($sigingAuthorityPhone == '')
		{	
			$message = $constantArr['entersignAuthPhone'][$_SESSION['lang']].$errorFlag;
		}
		else if($sigingAuthorityPin == '')
		{	
			$message = $constantArr['entersignAuthPin'][$_SESSION['lang']].$errorFlag;
		}
		else if($checkboxId == 1)
		{	
			if($tPdName == '')
			{	
				$message = $constantArr['enterDesigneeName'][$_SESSION['lang']].$errorFlag;
			}
			else if($tPDesigneeName > 0)
			{
				$message = $constantArr['EnterValidTPDesName'][$_SESSION['lang']].$errorFlag;
			}
			else if($tPdPhone == '')
			{
				$message = $constantArr['enterDesigneePhone'][$_SESSION['lang']].$errorFlag;
			}
			else if($tPdPin == '')
			{
				$message = $constantArr['enterDesigneePin'][$_SESSION['lang']].$errorFlag;
			}
		}
		if(!isset($message))
		{
			$businessinfoData = $this->addbusiness->updateBusinessInfo($bizId,$user_id,$this->MCrypt->encrypt($bizName),
								$bizType,$this->MCrypt->encrypt($ownerFirstName),$this->MCrypt->encrypt($ownerLastName),
								$this->MCrypt->encrypt($bizEIN),$this->MCrypt->encrypt($bizAddress1),$this->MCrypt->encrypt($bizAddress2),
								$bizCountry,$bizselectState,$this->MCrypt->encrypt($bizCity),$this->MCrypt->encrypt($bizZip),
								$this->MCrypt->encrypt($bizPhone),$this->MCrypt->encrypt($bizEmail),$this->MCrypt->encrypt($sigingAuthorityName),
								$this->MCrypt->encrypt($sigingAuthoritytitle),$this->MCrypt->encrypt($sigingAuthorityPhone),
								$this->MCrypt->encrypt($sigingAuthorityPin),$this->MCrypt->encrypt($tPdName),$this->MCrypt->encrypt($tPdPhone),
								$this->MCrypt->encrypt($tPdPin),$date,$modified_by);	
	
			if($businessinfoData=='updated')
			{
				$message = $constantArr['business_updated'][$_SESSION['lang']].$successFlag;
			}
			else if($businessinfoData == 'not_updated')
			{
				$message = $constantArr['business_not_updated'][$_SESSION['lang']].$errorFlag;
			}
		}
		
		return $message;						
												
	}
	//get state
	public function getBusinessstate()
	{
		$status = $this->addbusiness->getstate();		
		return $status;
	}
}

?>