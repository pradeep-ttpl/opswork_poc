<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : taxyear_biz.php
 * @version  : 1.0
 * @date  : 19-Jul-2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           19-Jul-2012           Initial Version - File Created
 * 
 */

class Taxyear_Model
{		
	public function __construct()
	{		
		// taxPayerBusiness DAO
		$taxyearDAO = new Taxyear_DAO;
		$this->taxyear = $taxyearDAO;
		
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
	}
	public function getTaxFilingYears()
	{
		$taxFilingYears = $this->taxyear->getTaxFilingYears();
		return $taxFilingYears;
	}
	
	public function getTaxForms()
	{
		$taxForms = $this->taxyear->getTaxForms();
		return $taxForms;
	}
	
	public function saveTaxFilingYear($reqVars)
	{
		$user_id = $_SESSION['user_id'];
		$business_id = $reqVars['business'];
		$_SESSION['selectedbusiness'] = $business_id;
		$taxYear = $reqVars['taxyear'];
		$taxMonth = $reqVars['taxmonth'];
		
		$finalReturn = '';
		if(isset($_REQUEST['finalreturn'])){
			$finalReturn = $reqVars['finalreturn'];
		}
		
		$addresschange = '';
		if(isset($_REQUEST['addresschange'])){
			$addresschange = $reqVars['addresschange'];
		}
		
		$earliestDateId = 0;
		if(isset($_REQUEST['earliestDateId'])){
			$earliestDateId = $reqVars['earliestDateId'];
		}
		
		$latestDateId = 0;
		if(isset($_REQUEST['latestDateId'])){
			$latestDateId = $reqVars['latestDateId'];
		}
		
		$taxYearEndMonth = 0;
		if(isset($_REQUEST['taxYearEndMonth'])){
			$taxYearEndMonth = $reqVars['taxYearEndMonth'];
		}
		
		$_SESSION['formtype'] = $reqVars['taxForm'];
		$formType = $reqVars['taxForm'];
		$tax_year_id = $taxYear;
		$amendMentMonth = 0;
		if(isset($reqVars['amendmentMonth'])){
			$amendMentMonth = $reqVars['amendmentMonth'];
		}
		
		if($taxYear>0){
			$yearDetail =  $this->taxyear->getTaxFilingYearDetails($taxYear);
		}else{
			$yearDetail =  $this->taxyear->getTaxFilingYearList($formType); //To get tax year details for 8849S6
		}
		
		$taxYear = $yearDetail['tax_year'];
		
		if($finalReturn == "on")
		{
			$finalReturn = 1;
		}
		else
		{
			$finalReturn = 0;
		}
		
		if($addresschange == 'on'){
			$addresschange = 1;
		}else{
			$addresschange = 0;
		}

		if(isset($_SESSION['filingId']))
		{	
			$taxpayerbusinessDAO = new Taxpayerbusiness_DAO;
			$return_detail = $taxpayerbusinessDAO->getFilingDetails($_SESSION['filingId']);
			
			if($return_detail['biz_id'] == $business_id && $return_detail['form_type'] == $formType && $return_detail['filing_year'] == $taxYear && $this->MCrypt->decrypt($return_detail['filing_month']) == $taxMonth && $this->MCrypt->decrypt($return_detail['amended_month']) == $amendMentMonth && $this->MCrypt->decrypt($return_detail['tax_year_end_month']) == $taxYearEndMonth)
			{
				$filingId = $_SESSION['filingId'];
				// update on different tax informations
				$updateAddressChange = $this->taxyear->updateChanges($filingId,$this->MCrypt->encrypt($finalReturn),$this->MCrypt->encrypt($addresschange));
			}
			else
			{	
				$filingId = $this->taxyear->insertTaxFilingYear($user_id, $business_id, $taxYear, $this->MCrypt->encrypt($taxMonth), $this->MCrypt->encrypt($finalReturn),$this->MCrypt->encrypt($addresschange),
				$this->MCrypt->encrypt('0'), $formType,$this->MCrypt->encrypt($amendMentMonth),$this->MCrypt->encrypt($earliestDateId),$this->MCrypt->encrypt($latestDateId),$this->MCrypt->encrypt($taxYearEndMonth));
			}
		}		
		else
		{	
			$filingId = $this->taxyear->insertTaxFilingYear($user_id, $business_id, $taxYear, $this->MCrypt->encrypt($taxMonth), $this->MCrypt->encrypt($finalReturn),$this->MCrypt->encrypt($addresschange),
			$this->MCrypt->encrypt('0'), $formType,$this->MCrypt->encrypt($amendMentMonth),$this->MCrypt->encrypt($earliestDateId),$this->MCrypt->encrypt($latestDateId),$this->MCrypt->encrypt($taxYearEndMonth));
		}
		
		
		$_SESSION['filingId'] = $filingId;
		$_SESSION['filingMonth'] = $taxMonth;
		$_SESSION['filingYear'] = $tax_year_id;
		$_SESSION['finalReturn'] = $finalReturn;
		$_SESSION['addresschange'] = $addresschange;
		
		if(isset($reqVars['taxYearEndMonth'])){
			$_SESSION['taxYearEndFilingMonth'] = $taxYearEndMonth;
		}
		
		if(isset($reqVars['amendmentMonth'])){
			$_SESSION['amendMentMonth'] = $amendMentMonth;
		}
		
	}
}
?>