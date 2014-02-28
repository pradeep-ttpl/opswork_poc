<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : addbusiness_controller.php
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

class Addbusiness_Controller
{
	public $template = 'addbusiness';

	public function main( array $reqVars )
	{
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		$getBusinessiInfo = '';
		$getbusinessstate = '';
		
		/* (Assuming session already started) */
		if(isset($_SESSION['referrer'])){
		    // Get existing referrer
		    $referrer   = $_SESSION['referrer'];
		
		} elseif(isset($_SERVER['HTTP_REFERER'])){
		    // Use given referrer
		    $referrer   = $_SERVER['HTTP_REFERER'];
		
		}
		
		if(isset($referrer)){
			$tempArr = explode('/',$referrer);
			if(isset($tempArr[3]) && $tempArr[3] == 'summary'){
				$_SESSION['summary_back_button'] = true;
			}
		}
		
		// Check user login
		if(!isset($_SESSION['user_id']))
		{
			header( 'Location: '.TT_SITE_NAME.'login');
			exit();
		}
		else 
		{
			$MCrypt	= new MCrypt;
			$this->MCrypt = $MCrypt;
			
			$addbusiness_Model = new Addbusiness_Model;
			$businessTypeList = $addbusiness_Model->getBusinessTypes();
			$countryList 	  = $addbusiness_Model->getCountryList();
			
			if(isset($_SESSION['admin_biz_id']) && $_SESSION['admin_biz_id'] > 0){
				$user_id	= $_SESSION['admin_user_id'];
			}else{
				$user_id 	= $_SESSION['user_id'];
			}
			$date 			= date('Y-m-d H:i:s');
			
			$edit   = (isset($parsed[2])? $parsed[2] : '');
			$getbusinessstate  = $addbusiness_Model->getBusinessstate();
			
			if($edit == 'edit')
			{
				$bizId = decryptID((isset($parsed[3]) ? $parsed[3] : ''));
				$getBusinessiInfo = $addbusiness_Model->getUsersBusinessInfo($user_id,$bizId);
			}
			else 
			{
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
						$tPdPhone	    = str_replace('-','',$reqVars['tPdPhone']);
						$tPdPin	    	= str_replace('-','',$reqVars['tPdPin']);   
					}
					else 
					{
						$tPdName	    = '';
						$tPdPhone	    = '';
						$tPdPin	    	= '';
					}
					
					$addBusinessInfo = $addbusiness_Model->addBusinessInformation($businessName,$businessType,$ownerFirstName,$ownerLastName,$EINId,$bizAddress1,$bizAddress2,$businessCountry,$businessCity,$businessState,$businessZipcode,$businessPhone,$businessEmail,$sigingAuthorityName,$sigingAuthoritytitle,$sigingAuthorityPhone,$sigingAuthorityPin,$tPdName,$tPdPhone,$tPdPin,$user_id,$date,$checkboxId);
					
					if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
						$_SESSION['adminStatusMsg'] = $addBusinessInfo;
						header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
					}else{
						$_SESSION['addBusinessiInfo'] = $addBusinessInfo;
						header("location:/taxpayerbusiness/");	
					}
					exit(0);
				}
			}
			
			if(isset($reqVars['updatebusiness']))
			{
				$bizId 					= decryptID($reqVars['BizID']);		
				$bizName 				= addslashes(trim($reqVars['bizName']));	
				$bizType 				= trim($reqVars['bizType']);		
				$bizEIN  				= trim($reqVars['bizEIN']);
				$bizEIN	 				= str_replace('-','',$bizEIN);
				$bizAddress1			= addslashes(trim($reqVars['addressLine1']));		
				$bizAddress2			= addslashes(trim($reqVars['addressLine2']));	 
				$bizCountry 			= addslashes(trim($reqVars['bizCountry']));
				$bizselectState 		= addslashes(trim($reqVars['bizselectState']));
				$bizCity 				= addslashes(trim($reqVars['bizCity']));
				$bizZip 				= trim($reqVars['bizZip']);
				$bizPhone 				= str_replace('-','',$reqVars['phone']);
				$bizEmail 				= str_replace('-','',$reqVars['email']);
				$sigingAuthorityName	= addslashes(trim($reqVars['sAname']));
				$sigingAuthoritytitle	= addslashes(trim($reqVars['sAtitle']));	
				$sigingAuthorityPhone	= str_replace('-','',$reqVars['sAphone']);
				$sigingAuthorityPin		= str_replace('-','',$reqVars['sApin']);
				$modified_by			= $_SESSION['user_id'];		
				$checkboxId				= $reqVars['checkboxId'];		
				
				if($bizType == 1)
				{
					$ownerFirstName = addslashes(trim($reqVars['ownerFirstName']));
					$ownerLastName 	= addslashes(trim($reqVars['ownerLastName']));
				}
				else 
				{
					$ownerFirstName = '';
					$ownerLastName  = '';
				}
				
				if($checkboxId == 1)
				{
					$tPdName	    = addslashes(trim($reqVars['tPdName']));
					$tPdPhone	    = str_replace('-','',$reqVars['tPdPhone']);
					$tPdPin	    	= str_replace('-','',$reqVars['tPdPin']);   
				}
				else 
				{
					$tPdName	    = '';
					$tPdPhone	    = '';
					$tPdPin	    	= '';
				}
				
				$updatebusinessinfo = $addbusiness_Model->updateBusinessInfo($bizId,$user_id,$bizName,$bizType,$ownerFirstName,$ownerLastName,$bizEIN,$bizAddress1,$bizAddress2,$bizCountry,$bizselectState,$bizCity,$bizZip,$bizPhone,$bizEmail,$sigingAuthorityName,$sigingAuthoritytitle,$sigingAuthorityPhone,$sigingAuthorityPin,$tPdName,$tPdPhone,$tPdPin,$date,$modified_by,$checkboxId);
				
				if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
					$_SESSION['adminStatusMsg'] = $updatebusinessinfo;
					header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
				}else{
					
					if(isset($_SESSION['summary_back_button']) && $_SESSION['summary_back_button'] == true){
						$_SESSION['adminStatusMsg'] = $updatebusinessinfo;
						header("location:/summary/");	
					}else{
						$_SESSION['updateBusinessiInfo'] = $updatebusinessinfo;
						header("location:/taxpayerbusiness/");
					}
						
				}
				exit(0);
			}
		}
		
		$tpl = new Template_Model($this->template);
		$tpl->assign('business_list',$businessTypeList);
		$tpl->assign('countryList',$countryList);
		$tpl->assign('getBusinessiInfo',$getBusinessiInfo);
		$tpl->assign('getstate' , $getbusinessstate);
	}
}

?>