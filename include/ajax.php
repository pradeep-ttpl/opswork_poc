<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : ajax.php
 * @version  : 1.0
 * @date  : 12-Jul-2012
 *
 * @description :
 *
 * @author      : Ramya
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          -------------------------------------------
 * Ramya                 12-Jul-2012           Initial Version - File Created
 * 
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/constants.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/functions.php');
include_once(TT_ENTITY_PATH.'/taxablevehicleinfo_entity.php');
include_once(TT_ENTITY_PATH.'/addbusiness_entity.php');
include_once(TT_ENTITY_PATH.'/currentyrsuspend_entity.php');
include_once(TT_ENTITY_PATH.'/taxyear_entity.php');
include_once(TT_ENTITY_PATH.'/prioryrsuspend_entity.php');
include_once(TT_ENTITY_PATH.'/taxpayerbusiness_entity.php');
include_once(TT_ENTITY_PATH.'/lowmileagecredit_entity.php');
include_once(TT_ENTITY_PATH.'/solddestroycredit_entity.php');
include_once(TT_ENTITY_PATH.'/overpayment_entity.php');
include_once(TT_ENTITY_PATH.'/productpayment_entity.php');
include_once(TT_ENTITY_PATH.'/fleet_entity.php');
include_once(TT_ENTITY_PATH.'/tgwincreased_entity.php');
include_once(TT_ENTITY_PATH.'/register_entity.php');
include_once(TT_ENTITY_PATH.'/exceededmileage_entity.php');
include_once(TT_ENTITY_PATH.'/vincorrection_entity.php');
include_once(TT_INCLUDE_PATH.'/MCrypt.php');

$type = $_REQUEST['type'];
if($type == 'selectlang')
{
	$lang = $_REQUEST['lang'];	
	setcookie('lang',$lang,time()+3600,'/');
	$_SESSION['lang'] = $lang;
}

//delete from tt_filing_current_suspended table
else if( $type == 'deletecursuspendinfo')
{
	$crntYrSpndId  = $_REQUEST['crntYrSpndId'];	
	$Vin = $_REQUEST['vin'];
	
	$currentyrsuspendDAO = new Currentyrsuspend_DAO;
	$deletedesuspendVehi = $currentyrsuspendDAO->deleteSuspendVehicle($crntYrSpndId,$Vin);
}

else if( $type == 'deletetaxablevehi')
{
	$TaxableId = $_REQUEST['TaxableId'];	
	$Vin = $_REQUEST['vin'];
	
	$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
	$deletetaxableVehi = $taxablevehicleinfoDAO->deleteTaxVehiDetails($TaxableId,$Vin,$_SESSION['filingId']);
	echo $deletetaxableVehi;
}
else if( $type == 'deleteTGWI')
{
	$TaxableId 	= decryptID($_REQUEST['TaxableId']);	
	$Vin 		= $_REQUEST['vin'];
	
	$tgwincreasedDAO = new Tgwincreased_DAO;
	$deleteTgwincreased = $tgwincreasedDAO->deleteTGWIncreasedDetails($TaxableId,$Vin);
}
else if( $type == 'deleteVINCorrection')
{
	$vin 	= decryptID($_REQUEST['vin']);	
	
	$vincorrectionDAO = new Vincorrection_DAO;
	$deleteVinCorrection = $vincorrectionDAO->deleteVINCorrection($vin);
}
else if( $type == 'deleteExceededMileageVehi')
{
	$TaxableId = decryptID($_REQUEST['TaxableId']);	
	$Vin = $_REQUEST['vin'];
	
	$exceededMileageVehiDAO 	= new Exceededmileage_DAO;
	$deleteExceededMileageVehi 	= $exceededMileageVehiDAO->deleteExceededMileageVehi($TaxableId,$Vin);
}
else if( $type == 'vehicleInfo')
{
	$liscenceId = $_REQUEST['liscenceId'];	
	
	$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
	$vehicleInfo = $taxablevehicleinfoDAO->vehicleInfo($liscenceId);
	echo $vehicleInfo['vin'].'~'.$vehicleInfo['weight_category'].'~'.$vehicleInfo['is_logging'];
}
else if( $type == 'selectstates')
{
	$countryID = $_REQUEST['countryID'];	
	$stateID = $_REQUEST['stateName'];
	$addbusinessDAO = new Addbusiness_DAO;
	$selectStates = $addbusinessDAO->selectStates($countryID);
	if($stateID == '')
	$html = '<option value="0" selected="selected">Select State</option>';
	else 
	$html = '<option value="0">Select State</option>';
	foreach($selectStates as $value)
	{	
		if($value['id'] == $stateID)
		{
			$selected = 'selected="selected"';	
			$html .= '<option value="'.$value['id'].'" '.$selected.'>'.$value['state_name'].'</option>';
		}
		else 
		{
			$html .= '<option value="'.$value['id'].'">'.$value['state_name'].'</option>';
		}
	}
	echo $html;
}
else if( $type == 'deletepriorvehi')
{
	$preYrSpndId = $_REQUEST['preYrSpndId'];	
	$Vin = $_REQUEST['vin'];
	
	$prioryrsuspendDAO = new prioryrsuspend_DAO;
	$deleteprioryrsusDet = $prioryrsuspendDAO->deleteprioryrsuspend($preYrSpndId,$Vin);
}

else if( $type == 'deletecreditinfo')
{
	$lowMlgId = $_REQUEST['lowMlgId'];	
	$Vin = $_REQUEST['vin'];
	
	$lowmileagecreditDAO = new Lowmileagecredit_DAO;
	$deleteprioryrsusDet = $lowmileagecreditDAO->deletecreditvehicle($lowMlgId,$Vin);
}
else if( $type == 'checkTaxableCreditAmount')
{
	$filingId = $_REQUEST['filingId'];	
	$count = checkTaxableCreditAmount($filingId);
	echo $count;
}
else if( $type == 'selectedFormType')
{
	$FormType = $_REQUEST['FormType'];
	$_SESSION['formtype'] = $FormType;
	if($FormType=='8849'){
		$taxyearDAO = new Taxyear_DAO;
		$yearDetails = $taxyearDAO->getTaxFilingYears();
		echo '1~'.$yearDetails[0]['id'].'~'.date('Y F');
	}else{
		echo 1;
	}
}

else if( $type == 'deletesolddes')
{
	$sldDtroyCrdId = $_REQUEST['sldDtroyCrdId'];	
	$Vin = $_REQUEST['vin'];
	
	$solddestroycreditDAO = new Solddestroycredit_DAO;
	$deleteprioryrsusDet = $solddestroycreditDAO->deletesolddestroy($sldDtroyCrdId,$Vin);
}

else if( $type == 'deletethirdpartyinfo')
{
	$thirdpartyid = $_REQUEST['thirdpartyid'];	
	
	$thirdpartyDAO = new Thirdparty_DAO;
	$deletethirdparty = $thirdpartyDAO->deletethirdparty($thirdpartyid);
}

else if( $type == 'deleteoverpaymentinfo')
{
	$id = decryptID($_REQUEST['id']);	
	
	$overpaymentDAO = new Overpayment_DAO;
	$overpayment = $overpaymentDAO->deletetoverpayment($id);
}


//selected business
else if( $type == 'selectedbussiness')
{
	$selectedbussiness = $_REQUEST['business'];
	
	$_SESSION['selectedbusiness'] = $selectedbussiness;
	
	if(isset($_SESSION['formtype']))
		unset($_SESSION['formtype']);
		
	if(isset($_SESSION['filingId']))
		unset($_SESSION['filingId']);
		
	if(isset($_SESSION['filingMonth']))
		unset($_SESSION['filingMonth']);
		
	if(isset($_SESSION['filingYear']))
		unset($_SESSION['filingYear']);
		
	if(isset($_SESSION['finalReturn']))
		unset($_SESSION['finalReturn']);
		
	if(isset($_SESSION['addresschange']))
		unset($_SESSION['addresschange']);
		
	if(isset($_SESSION['amendMentMonth']))
		unset($_SESSION['amendMentMonth']);	
		
	if(isset($_SESSION['taxYearEndFilingMonth']))
		unset($_SESSION['taxYearEndFilingMonth']);
	
	echo "selected";	
}

else if( $type == 'changemonth')
{
	$selectedYear = $_REQUEST['year'];
	
	$selectyr = explode("_",$selectedYear);
	
	$month_start = array ("July"=>"07","August"=>"08","September"=>"09","October"=>"10","November"=>"11","December"=>"12");
	$month_end = array ("January"=>"01", "February"=>"02", "March"=>"03", "April"=>"04", "May"=>"05", "June"=>"06");
	
	echo '<select class="marLeft10px smallSelectbox" id="'.$_REQUEST['selid'].'" name="'.$_REQUEST['selid'].'"><option value="month">Month</option>';
	
	if($selectyr[1] == '1')
	{
		foreach($month_start AS  $key => $value)
		{
			echo '<option value="'. $value .'">'.$key .'</option>';
		}
	}
	else 
	{
		foreach($month_end AS $key => $value)
		{
			echo '<option value="'. $value .'">'.$key .'</option>';
		}
	}
	
	echo '</select>';
}

//To get month  details for 8849
else if($type == 'getMonthDetails')
{
	$monthAry;
	$filingId = $_SESSION['filingId'];
	
	// Intializing MCrypt class
	$MCrypt	= new MCrypt;
	
	$taxyearDAO = new Taxyear_DAO;
	$filingDetails = $taxyearDAO->getTaxFilingDetails($filingId);
	$earliestDate = $MCrypt->decrypt($filingDetails['earliest_date']);
	$latestDate = $MCrypt->decrypt($filingDetails['latest_date']);
	
	echo '<select id="taxYearEndMonth" name="taxYearEndMonth" class="txtBox150px"><option value="0">Select Month</option>';
	
	foreach($monthAry AS $key => $value)
	{
		echo '<option value="'. $key .'"';
		
		if(isset($_SESSION['taxYearEndFilingMonth']) && $_SESSION['taxYearEndFilingMonth'] == $key)
			{
				echo ' selected="selected"';
			}
		
		echo '>'. $value .'</option>';
	}
	if(isset($_SESSION['taxYearEndFilingMonth']) && $earliestDate && $latestDate){
		echo "</select>"."|".$earliestDate."|".$latestDate;
	}
}

else if($type == 'getMonthList')
{
	$monthAry;
	$filingId = $_SESSION['filingId'];
	
	echo '<select id="taxYearEndMonth" name="taxYearEndMonth" class="txtBox150px"><option value="0">Select Month</option>';
	
	foreach($monthAry AS $key => $value)
	{
		echo '<option value="'. $key .'"';
		
		if(isset($_SESSION['taxYearEndFilingMonth']) && $_SESSION['taxYearEndFilingMonth'] == $key)
			{
				echo ' selected="selected"';
			}
		
		echo '>'. $value .'</option>';
	}
	
	echo "</select>";
}

// tax year change populate tax months
else if( $type == 'changetaxmonth')
{
	$selectedYear = $_REQUEST['year'];
	$monthType = $_REQUEST['monthType'];
	
	$currentYear =  date("Y");
	$currentMonth = date("F");
	
	$taxyearDAO = new Taxyear_DAO;
	$yearDetails = $taxyearDAO->getTaxFilingYearDetails($selectedYear);
	$yearTo = $yearDetails['tax_year']+1;
	$yearFrom = $yearDetails['tax_year'];
	
	$month_start = array ("07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December");
	$month_end = array ("01"=>"January", "02"=>"February", "03"=>"March", "04"=>"April", "05"=>"May", "06"=>"June");
	
	if($monthType == 'firstUsed')
	echo '<select id="taxmonth" name="taxmonth" class="txtBox150px"><option value="0">Select Month</option>';
	else if($monthType == 'amendmentMonth')
	echo '<select id="amendmentMonth" name="amendmentMonth" class="txtBox150px"><option value="0">Select Month</option>';
	
	
	foreach($month_start AS $key => $value)
	{
		echo '<option value="'. $key .'"';

		if($monthType == 'firstUsed'){
			if(isset($_SESSION['filingMonth']) && $_SESSION['filingMonth'] == $key)
			{
				echo ' selected="selected"';
			}
			
		}else if($monthType == 'amendmentMonth'){
			if(isset($_SESSION['amendMentMonth']) && $_SESSION['amendMentMonth'] == $key)
			{
				echo ' selected="selected"';
			}
		}
		
		
		echo '>'. $yearFrom .' '. $value .'</option>';
		
		// Break the loop once it reaches the current time.
		if($currentYear == $yearFrom && $currentMonth == $value)
		{
			$closeLoop = 1;
			break;
		}
	}
	/*if(isset($closeLoop) && $closeLoop != 1)
	{*/
		foreach($month_end AS $key => $value)
		{
			echo '<option value="'. $key .'"';
			
		if($monthType == 'firstUsed'){
			if($_SESSION['filingMonth'] == $key)
			{
				echo ' selected="selected"';
			}
			
		}else if($monthType == 'amendmentMonth'){
			if($_SESSION['amendMentMonth'] == $key)
			{
				echo ' selected="selected"';
			}
		}			
			
			echo '>'. $yearTo .' '. $value .'</option>';
			
			// Break the loop once it reaches the current time.
			if($currentYear == $yearTo && $currentMonth == $value)
			{
				break;
			}
		}
	//}
	echo "</select>";
}

else if($type == 'contentdisclosure')
{
	$disclosureno = $_REQUEST['disclosureno'];
	$disclosureyes = $_REQUEST['disclosureyes'];
}
// To select a incomplete filing from dashboard
else if( $type == 'selectfiling')
{
	$filingId = decryptID($_REQUEST['id']);
	
	$chkFilingEdit = chkFilingEdit($filingId);
	if($chkFilingEdit == 'edit')
	{
		// Intializing MCrypt class
		$MCrypt	= new MCrypt;	
		
		$taxpayerbusinessDAO = new Taxpayerbusiness_DAO;
		$result = $taxpayerbusinessDAO->getFilingDetails($filingId);
		
		$reset = $taxpayerbusinessDAO->resetSubmissionData($filingId);
	
		$_SESSION['selectedbusiness'] = $result['biz_id'];
		$_SESSION['filingId'] = $result['id'];
		$_SESSION['filingMonth'] = $MCrypt->decrypt($result['filing_month']);
		$_SESSION['taxYearEndFilingMonth'] = $MCrypt->decrypt($result['tax_year_end_month']);
		$_SESSION['formtype'] = $result['form_type'];
		$_SESSION['filingYear'] = $result['tax_year_id'];
	
		if($result['form_type'] != '8849S6'){
			
			$_SESSION['finalReturn'] 	= $MCrypt->decrypt($result['final_return']);	
			$_SESSION['addresschange']	= $MCrypt->decrypt($result['address_change']);
				
		}
		if($result['form_type'] == '2290A1' || $result['form_type'] == '2290A2'){
			
			$_SESSION['amendMentMonth'] = $MCrypt->decrypt($result['amended_month']);
			 	
		}
		echo 'done';	
	}
	else 
	{
		echo '';
		$_SESSION['edit_filing_error'] = 'Cannot edit filing'; 
	}
}

//to delete business 
else if ($type == 'deletebusinessinfo')
{
	$businessid = decryptID($_REQUEST['businessid']);
	
	$taxpayerbusinessDAO = new Taxpayerbusiness_DAO;
	$result = $taxpayerbusinessDAO->deletebusiness($businessid);
}
//delete tax return pending list
else if ($type == 'deletetaxpendinglist')
{
	$filingid = decryptID($_REQUEST['filingid']);
	
	$taxpayerbusinessDAO = new Taxpayerbusiness_DAO;
	$result = $taxpayerbusinessDAO->deletetaxpendinglist($filingid);
}
// to check discount avail code
else if ($type == 'availdiscount')
{
	$code = $_REQUEST['code'];
	$discountID = $_REQUEST['discountID'];	
	
	if($code == "TEST")
	{
		echo "1";
		
		$productpaymentDAO = new Productpayment_DAO;
		$result = $productpaymentDAO->getDiscountDetails($discountID);
		
		$_SESSION['discounts'][$discountID] = $result['discount_percentage'];
		
		$_SESSION['discount_total'] = array_sum($_SESSION['discounts']);
		
		echo "~".$_SESSION['discount_total'];
		
		$filing_amount = $_SESSION['filing_fee'];
		
		$discount_amount = (($filing_amount / 100 ) * $_SESSION['discount_total']);
		
		echo "~".$discount_amount;
		
		$total_amount = $filing_amount - $discount_amount;
		
		echo "~".$total_amount;
		
		$_SESSION['total_amount'] = $total_amount;
	}
	else
	{
		echo "0";
	}
}
// To remove discount from list
else if ($type == 'removediscount')
{
	$discountID = $_REQUEST['discountID'];
	
	$discountArray = $_SESSION['discounts'];
	
	unset($discountArray[$discountID]);
	
	unset($_SESSION['discounts']);
	
	$_SESSION['discounts'] = $discountArray;
	
	$_SESSION['discount_total'] = array_sum($_SESSION['discounts']);
	
	echo "~".$_SESSION['discount_total'];
	
	$filing_amount = $_SESSION['filing_fee'];
	
	$discount_amount = (($filing_amount / 100 ) * $_SESSION['discount_total']);
	
	echo "~".$discount_amount;
	
	$total_amount = $filing_amount - $discount_amount;
	
	echo "~".$total_amount;
	
	$_SESSION['total_amount'] = $total_amount;
}
// To calculate fingerprint for payment gateway
else if ($type == 'calculatefingerprint')
{
	$sequence	= $_REQUEST['sequence'];
	$timeStamp	= $_REQUEST['timestamp'];
	$filingfee  = number_format($_SESSION['total_amount'],2);
	
	if( phpversion() >= '5.1.2' )
	{ 
		$fingerprint = hash_hmac("md5", TT_AUTHORIZE_ID . "^" . $sequence . "^" . $timeStamp . "^" . $filingfee . "^", TT_AUTHORIZE_TRANSACTION_KEY); 
	}
	else 
	{ 
		$fingerprint = bin2hex(mhash(MHASH_MD5, TT_AUTHORIZE_ID . "^" . $sequence . "^" . $timeStamp . "^" . $filingfee . "^", TT_AUTHORIZE_TRANSACTION_KEY)); 
	}	
	
	echo $fingerprint;
}
//to delete business 
else if ($type == 'deletefleet')
{
	$fleetid = decryptID($_REQUEST['fleetid']);
	
	$fleetDAO = new Fleet_DAO;
	$result = $fleetDAO->deleteFleet($fleetid);
}
else if ($type == 'chkVehicleNickname')
{
	$fleetNo = $_REQUEST['vehicleNo'];
	$businessId = $_REQUEST['businessId'];
	
	$fleetDAO = new Fleet_DAO;
	$result = $fleetDAO->chkVehicleNickname($fleetNo,$businessId);
	echo $result;
}
else if ($type == 'findEmail')
{
	$MCrypt	= new MCrypt;
	$activecode = $_REQUEST['id'];
	$decodedkey = base64_decode($activecode);
	list($verifyKey,$registeredDate,$userID) = explode('/',$decodedkey); 
	$userID = (int)$userID;
	
	$registerDAO = new Register_DAO;
	$email = $registerDAO->getUserDetails($userID);
	$email = preg_replace('/\s+/', '', $MCrypt->decrypt($email['email']));
	echo $email;
}
else if ($type == 'checkCaptcha')
{
	$captchaValue = $_REQUEST['captchaValue'];
	if($captchaValue != $_SESSION['captcha'])
	echo 1;
	else 
	echo 0;
}
else if ($type == 'activateAccount')
{
	$userID = $_REQUEST['userID'];
	$registeredDate = $_REQUEST['registeredDate'];
	$activateAccount = activateAccount($userID,$registeredDate);
	echo $activateAccount;
}
else if ($type == 'checkEIN')
{
	$einNo = $_REQUEST['einNo'];
	$einNo = str_replace('-','',$einNo);
	$user_id = $_SESSION['user_id'];
	$previousEin = $_REQUEST['previousEin'];
	$selectEIN = 0;
	$MCrypt	= new MCrypt;
	if($previousEin == '' || $MCrypt->encrypt($einNo) != $previousEin)
	{
		$addbusinessDAO = new Addbusiness_DAO;
		$selectEIN = $addbusinessDAO->selectEIN($MCrypt->encrypt($einNo),$user_id);
	}
	echo $selectEIN;
}
else if ($type == 'autotext')
{
	$lno = $_REQUEST['queryString'];
	$fleetDAO = new Fleet_DAO;
	$result = $fleetDAO->getFleet($lno);
	
	// Intializing MCrypt class
	$MCrypt	= new MCrypt;

	foreach($result as $value)
	{
		echo '<li onClick="fill(\''.$value['licence_no'].'\',\''.$MCrypt->decrypt($value['vin']).'\',\''.$MCrypt->decrypt($value['weight_category']).'\',\''.$MCrypt->decrypt($value['is_logging']).'\')">'.$value['licence_no'].'</li>';
	} 
}
//Recording the initiation of payment
else if ($type == 'initiatePayment')
{
	$filingAmount = $_REQUEST['filingAmount'];
	$voucherNo = $_REQUEST['voucherNo'];
	$productpaymentDAO = new Productpayment_DAO;
	$result = $productpaymentDAO->initiatePayment($voucherNo,$filingAmount);
}
else if ($type == 'consentdiscloser')
{
	$filingid = $_SESSION['filingId'];
	$status = $_REQUEST['status'];
	
	// Intializing MCrypt class
	$MCrypt	= new MCrypt;	
	$taxyearDAO = new Taxyear_DAO;
	
	$result = $taxyearDAO->updateConsentDiscloser($MCrypt->encrypt($status),$filingid);
}
else if ($type == 'getServerDateTime')
{
	echo $date = date('Y-m-d H:i:s');
}
else if ($type == 'getTaxableGrossWeight')
{
	// Intializing MCrypt class
	$MCrypt	= new MCrypt;	
	$vincorrectionDAO = new Vincorrection_DAO;
	$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
	
	$vin = $_REQUEST['vin'];
	
	$taxableGrossWeight = $vincorrectionDAO->getTaxableGrossWeight($MCrypt->encrypt($vin));
	$chngTaxWeight = $taxablevehicleinfoDAO->gettaxableGrossWeight($MCrypt->decrypt($taxableGrossWeight));
	
	if($chngTaxWeight['weight_category'] == ''){
		$returnVal = '-';
	}else{
		$returnVal = '['.$chngTaxWeight['weight_category'].']  '.$chngTaxWeight['weight'].'~'.$chngTaxWeight['weight_category'];
	}
	
	echo $returnVal;
}
?>