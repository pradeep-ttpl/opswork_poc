<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : taxPayerBusiness_controller.php
 * @version  : 1.0
 * @date  : 12-Jul-2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           12-Jul-2012           Initial Version - File Created
 * 
 */

class Taxpayerbusiness_Controller
{
	public $template = 'taxpayerbusiness';

	public function main( array $reqVars )
	{
		$business_list = '';
		$countryList = '';
		// Check user login
		if(!isset($_SESSION['user_id']))
		{
			header( 'Location: '.TT_SITE_NAME.'login');
			exit();
		}
		
		$taxpayerbusiness_Model = new Taxpayerbusiness_Model;
		
		$businessDetails = $taxpayerbusiness_Model->getBusinessDetails();

		if(count($businessDetails) <= 0)
		{
			$this->template = 'addbusiness';
			$addbusiness_Model = new Addbusiness_Model;
			
			$user_id 	= $_SESSION['user_id'];
			$date 	    = date('Y-m-d H:i:s');
			
			if(sizeof($reqVars) > 0 && isset($reqVars['addbusiness']))
			{
				$businessName 			= addslashes(trim($reqVars['bizName']));
				$businessType 			= trim($reqVars['bizType']);
				$EINId 					= trim($reqVars['bizEIN']);
				$EINId					= str_replace('-','',$EINId);
				$bizAddress1			= addslashes(trim($reqVars['addressLine1']));		
				$bizAddress2			= addslashes(trim($reqVars['addressLine2']));		
				$businessCountry		= addslashes(trim($reqVars['bizCountry']));
				$businessCity			= addslashes(trim($reqVars['bizCity']));
				$businessZipcode		= trim($reqVars['bizZip']);
				$businessPhone			= str_replace('-','',$reqVars['phone']);
				$businessEmail			= str_replace('-','',$reqVars['email']);
				$sigingAuthorityName	= addslashes(trim($reqVars['sAname']));
				$sigingAuthoritytitle	= addslashes(trim($reqVars['sAtitle']));	
				$sigingAuthorityPhone	= str_replace('-','',$reqVars['sAphone']);	
				$sigingAuthorityPin		= str_replace('-','',$reqVars['sApin']);	
				$businessState	   		= addslashes(trim($reqVars['bizselectState']));
				$checkboxId				= $reqVars['checkboxId'];
				
				if($businessType == 1)
				{
					$ownerFirstName = addslashes(trim($reqVars['ownerFirstName']));
					$ownerLastName 	= addslashes(trim($reqVars['ownerLastName']));
				}
				else 
				{
					$ownerFirstName = '';
					$ownerLastName = '';
				}
				
				if($checkboxId == 1)
				{
					$tPdName	    = addslashes(trim($reqVars['tPdName']));
					$tPdPhone	   	= str_replace('-','',$reqVars['tPdPhone']);
					$tPdPin	    	= str_replace('-','',$reqVars['tPdPin']);
				}
				else 
				{
					$tPdName  = '';
					$tPdPhone = '';
					$tPdPin   = '';
				}
				
				$addBusinessInfo = $addbusiness_Model->addBusinessInformation($businessName,$businessType,$ownerFirstName,$ownerLastName,$EINId,$bizAddress1,$bizAddress2,$businessCountry,$businessCity,$businessState,$businessZipcode,$businessPhone,$businessEmail,$sigingAuthorityName,$sigingAuthoritytitle,$sigingAuthorityPhone,$sigingAuthorityPin,$tPdName,$tPdPhone,$tPdPin,$user_id,$date,$checkboxId);
				
				$_SESSION['addBusinessiInfo'] = $addBusinessInfo;	
				header("location:/taxpayerbusiness/");
				exit(0);
			}
			
			$business_list  = $addbusiness_Model->getBusinessTypes();
			$countryList = $addbusiness_Model->getCountryList();
			// Get US state list
			$getbusinessstate  = $addbusiness_Model->getBusinessstate();
		}
		
		$tpl = new Template_Model($this->template);
		$tpl->assign('business_list',$business_list);
		$tpl->assign('countryList',$countryList);
		$tpl->assign('businessiInfo',$businessDetails);
		if(isset($getbusinessstate))
		{
			$tpl->assign('getstate' , $getbusinessstate);
		}
	}
}
?>