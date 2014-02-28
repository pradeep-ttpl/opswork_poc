<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : functions.php
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

// Encode the activation code
function getActiveCode($userId,$createDate,$char)
{
	$encodedkey = base64_encode($char.'/'.$createDate.'/'.$userId); // Formula: 'statuscode' + createddate + userid

	return $encodedkey;
}

function SendEmail($frommail,$to,$subject,$message)
{
	require_once("class.phpmailer.php");
	
	$from = 'SimpleTruckTax';
	if($frommail == null){
		$frommail = 'support@simpletrucktax.com';
	}
	
	$mail = new PHPMailer();
	$mail->IsSMTP();            				  				 // send via SMTP
	$mail->Host     = "mail.simpletrucktax.com";     				     // SMTP servers
	$mail->Port     = 25;     				 			 		 // SMTP servers
	$mail->SMTPAuth = true;                       				 // turn on SMTP authentication
	$mail->Username = "support@simpletrucktax.com";  					 // SMTP username
	$mail->Password = "Supp@134";                 				 // SMTP password

	$mail->From     = $frommail;
	$mail->FromName = $from;
	$mail->AddAddress($to);
	//$mail->AddReplyTo($frommail);
	$mail->SetLanguage('en','language/');
	$mail->IsHTML(true);                                         // send as HTML

	$mail->Subject  =  $subject;
	$mail->Body     =  $message;
	$mail->AltBody  =  "";

	if(!$mail->Send())
	{
	   echo "Message was not sent <p>";
	   echo "Mailer Error: " . $mail->ErrorInfo;
	   exit;
	}
}
/**
 * Decode the activation code
 */ 
function getUserIdBYRetypePwd($forgotpasswordcode)
{
	$userID = 0;
	$decodedkey = base64_decode($forgotpasswordcode);
	list($verifyKey,$registeredDate,$userID) = explode('/',$decodedkey);
	if($verifyKey == 'F')
		$userID = (int)$userID;
	
	return  $userID;
}

/**
 * Return account activation message
 */ 
function confirmlogin($activecode)
{
	// decode the activation code
	$decodedkey = base64_decode($activecode);
	list($verifyKey,$registeredDate,$userID) = explode('/',$decodedkey); 
	$userID = (int)$userID;
	
	require_once (TT_ENTITY_PATH . '/register_entity.php');
	require_once (TT_INCLUDE_PATH.'/tax_error.php');	
	$userDAO 	= new Register_DAO;
	
	// Update user verfiy status - User DAO		
	$statusacc =  $userDAO->updateUserStatus($userID,$verifyKey,$registeredDate);
	
	$defineArr			= validateData();	
	if($statusacc)
	{
		$statusacc = $defineArr['TAX_ACTIVATED_MSG'][$_SESSION['lang']];
	}
	else
	{
		$statusacc = $defineArr['TAX_EXIST_ACTIVATED_MSG'][$_SESSION['lang']];
	}
	return 	$statusacc;	
}
//display business type
function getBusinessType($data,$bizType)
{
	$key =1;
	foreach($data as $key=>$value)
	{
		echo "<option value='".$value['id']."'" .((( $value['id'] == $bizType ) && $bizType!='')? 'selected':'' )." >".$value['name']."</option>";
	}
}

//display country list
function getCountryList($data,$SelectedbizCountry)
{
	$key =1;
	foreach($data as $key=>$value)
	{
		echo "<option value='".$value['id']."'" .((( $value['id'] == $SelectedbizCountry ) && $SelectedbizCountry!='')? 'selected':'' )." >".$value['country_name']."</option>";
	}
}

//get business type from DB
function getState($data,$bizState)
{
	$key =1;
	foreach($data as $key=>$value)
	{
		echo "<option value='".$value['State']."'" .((( $value['State'] == $bizState ) && $bizState!='')? 'selected':'' )." >".$value['State']."</option>";
	}
}
function getVehicleReportedinfo()
{
		$filingid = "";
		
		if(isset($_SESSION['filingId'])){ 
			$filingid = $_SESSION['filingId'];
		}
	
 		global $DBH;
 		
		$results = array();	
		
		$sql = 'SELECT fv.*, tc.weight_category, tc.weight, COUNT(fv.`weight_category`) AS count , sum(fv.`tax_amount`) as sum 
		FROM `tt_filing_taxable_vehicle` AS fv JOIN `tt_tax_computation_master` AS tc ON fv.weight_category = tc.id WHERE fv.`filing_id` = ? AND fv.`active` = 1 
		GROUP BY fv.`weight_category` ORDER BY `fv`.`weight_category` ASC';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($filingid));	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$results[] = $result;
		}
		
		return $results;
}

	function getLossVehicleinformation()
	{
		$filingid = "";
		
		if(isset($_SESSION['filingId'])){ 
			$filingid = $_SESSION['filingId'];
		}

		global $DBH;
		$results = array();	
		$sql = 'SELECT  `sc`.* ,  `tc`.`weight_category` ,  `tc`.`weight` , COUNT(`sc`.`weight_category` ) AS count, sum(sc.credit_amount) as 
				sum  FROM  `tt_filing_sold_destroyed` AS  `sc` JOIN  `tt_tax_computation_master` AS  `tc` ON  `sc`.`weight_category` =  `tc`.`id` WHERE  `sc`.`filing_id` = ? 
				AND  `sc`.`active` =1 GROUP BY  `sc`.`weight_category` ORDER BY  `sc`.`weight_category` ASC';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($filingid));	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$results[] = $result;
		}	
		return $results;
	}	
	/* Important tax dates displayed on landing page */
	function landingPageTaxDatesDetails()		
	{			
		global $DBH;
		$createdDate = date("Y-m-d h:i:s");
		$results = array();	
		$sql = "SELECT `TaxDates`, `Desc` FROM tt_ImportantTaxDates WHERE `EndDate` > ? AND `DisplayStatus` = '1' ";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($createdDate));	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$results[] = $result;
		}	
		return $results;
	}

	function getEmailSubscriptionlist($emailSubscription)		
	{			
		global $DBH;
		$results = array();	
		$sql = "SELECT email FROM `tt_email_subscription` WHERE email = ? AND active = ?";
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($emailSubscription,'1'));	
		$count 		= $preparesql->rowCount();
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$results[] = $result;
		}	
		return $results;
	}

	//get low mileage credit
	function getLowMilieagecredit()
	{
		$filingid = "";
		
		if(isset($_SESSION['filingId'])){ 
			$filingid = $_SESSION['filingId'];
		}
		
		global $DBH;
		$results = array();	
				$sql = 'SELECT  `lm`.* ,  `tc`.`weight_category` ,  `tc`.`weight` , 
				COUNT(`lm`.`weight_category`) AS count , sum(lm.credit_amount) as sum 
				FROM  `tt_filing_low_mileage` AS  `lm` 
				JOIN  `tt_tax_computation_master` AS  `tc` ON  `lm`.`weight_category` =  `tc`.`id` WHERE  `lm`.`filing_id` = ? AND  `lm`.`active` =1 
				GROUP BY  `lm`.`weight_category` ORDER BY  `lm`.`weight_category` ASC';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($filingid));	
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$results[] = $result;
		}	
		return $results;
	}
	function strip_to_numbers_only($string)
	{
	     // This regex pattern means anything that is not a number
	     $pattern = '/[^0-9]/';
	     // preg_replace searches for the pattern in the string and replaces all instances with an empty string
	     return preg_replace($pattern, '', $string);
	}
	
	//To overpayment credit details.
	function getOverPayCreditDet()
	{
		$filingid = "";
		
		if(isset($_SESSION['filingId'])){ 
			$filingid = $_SESSION['filingId'];
		}
		
		global $DBH;
		$results = array();
		$sql = "SELECT * FROM `tt_filing_credit_overpayment` WHERE `filingId` = ? AND `active` =1";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($filingid));
		$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
		while($result = $preparesql->fetch())
		{
		 	$results[] = $result;
		}
		
		return $results;
	}
	
	//Get business name from table.

	function getbusinessname($businessid)
	{
		global $DBH;
		
	   	$sql = "SELECT * FROM `tt_user_business` WHERE `id` = ? AND `active` =1";
		$res = $DBH->prepare($sql);
		$res->execute(array($businessid));
		
		$res->setFetchMode(PDO::FETCH_ASSOC);
		$row = $res->fetch();
		$businessname = $row;
		return $businessname;
	}
	
	//Get User name from table.

	function getUserName($userId)
	{
		global $DBH;
		
		$MCrypt	= new MCrypt;
		
	   	$sql = "SELECT first_name,last_name FROM `tt_users` WHERE `id` = ? AND `active` = ?";
		$res = $DBH->prepare($sql);
		$res->execute(array($userId,1));
		$res->setFetchMode(PDO::FETCH_ASSOC);
		$row = $res->fetch();
		$userName = $MCrypt->decrypt($row['first_name']).' '.$MCrypt->decrypt($row['last_name']);
		return $userName;
	}
	
	function getRegisteredEmail($userId)
{
		global $DBH;
		$sql 	= "SELECT * FROM `tt_users` WHERE `id` = ? AND active = ?";
		$rs 	= $DBH->prepare($sql);
		$rs->execute(array($userId,'1'));
		$rs->setFetchMode(PDO::FETCH_ASSOC);
		$row = $rs->fetch();
		return $row;	
}

function getFileStatus($status, $irs_status)
{
	if($status == 0 && $irs_status == 0)
	{
		$result = "Pending";
	}
	else if($status == 1 && $irs_status == 0)
	{
		$result = "<a href='#'>Submitted</a>";
	}
	else if($status == 1 && $irs_status == 1)
	{
		$result = "Approved";
	}
	return $result;
}

function activateAccount($userId,$registeredDate)
{
	global $DBH;	
	$sql = "UPDATE `tt_users` SET `active`= ? WHERE `id` = ? AND created_date = ?";
	$updateStatus = $DBH->prepare($sql);
	$updateStatus->execute(array(1,$userId,$registeredDate));	
	$count = $updateStatus->rowCount();		
	return $count;
}

function chkVin($vin)
{
	$status = 0;
	
	
	$vinNinthPositionValue = substr($vin,8,1);
	$vinTenthPositionValue = substr($vin,9,1);
	$vinLastFivePostions = substr($vin,12,5);
	
	if(strlen($vin) != 17)
	$status = 1;
	else if (!preg_match('/^([a-h j-n p r-z A-H J-N P R-Z 0-9_-]){17}$/', $vin))
	$status = 2;
	/*else if (!preg_match('/^([x X 0-9])/', $vinNinthPositionValue))
	$status = 3;
	else if (preg_match('/^([u U z Z])/', $vinTenthPositionValue))
	$status = 4;
	else if (!preg_match('/^([0-9])/', $vinLastFivePostions))
	$status = 5;*/
	
	
	return $status;
}

function checkTaxableCreditAmount($filingId)
{
	global $DBH;
	$sql		= "SELECT id FROM tt_filing_taxable_vehicle WHERE `filing_id` = ? AND active = ?";
	$preparesql = $DBH->prepare($sql);
	$executesql = $preparesql->execute(array($filingId,1));	
	return $preparesql->rowcount();
}

function chkCreditExceeded($taxAmount,$filingId,$selectedForm,$id)
{
	$MCrypt	= new MCrypt;
	
	global $DBH;
	
	$connSql = '';
	if($id != '' && $id > 0)
	$connSql = ' AND id != '.$id;
	
	$sql		= "SELECT tax_amount FROM tt_filing_taxable_vehicle WHERE `filing_id` = ? AND active = ?";
	$preparesql = $DBH->prepare($sql);
	$executesql = $preparesql->execute(array($filingId,1));	
	$preparesql->setFetchMode(PDO::FETCH_ASSOC);
	$taxedAmount = 0;
	while($row = $preparesql->fetch())
	{
		$taxedAmount +=  $MCrypt->decrypt($row['tax_amount']);
	}
		
	if($selectedForm == 'solddestroyed')
	{
		$sql1		= "SELECT tax_amount FROM tt_filing_sold_destroyed WHERE `filing_id` = ? AND active = ?".$connSql;
		$preparesql1 = $DBH->prepare($sql1);
		$executesql1 = $preparesql1->execute(array($filingId,1));	
		$preparesql1->setFetchMode(PDO::FETCH_ASSOC);
		$creditAmount = 0;
		while($row1 = $preparesql1->fetch())
		{
			$creditAmount +=  $MCrypt->decrypt($row1['tax_amount']);
		}
	}
	else if($selectedForm == 'lowmileage')
	{
		$sql1		= "SELECT credit_amount FROM tt_filing_low_mileage WHERE `filing_id` = ? AND active = ?.$connSql";
		$preparesql1 = $DBH->prepare($sql1);
		$executesql1 = $preparesql1->execute(array($filingId,1));	
		$preparesql1->setFetchMode(PDO::FETCH_ASSOC);
		$creditAmount = 0;
		while($row1 = $preparesql1->fetch())
		{
			$creditAmount +=  $MCrypt->decrypt($row1['credit_amount']);
		}
	}
	
	$finalTaxAmount = $taxedAmount - ($creditAmount+$taxAmount);
	return $finalTaxAmount;
}	
function chkLicenceNo($businessId,$licenceno, $vin, $taxableWeight, $logging,$userId)
{
	global $DBH;
	
	$sql = "SELECT id FROM tt_user_vehicles WHERE licence_no = ?";
	$chksql = $DBH->prepare($sql);
	$chksql->execute(array($licenceno));
	if($chksql->rowcount() == 0)
	{
		$sql = 'INSERT INTO `tt_user_vehicles` (`business_id`, `licence_no`, `vin`, `weight_category`, `is_logging`, `user_id`, `active`) VALUES (?, ?, ?, ?, ?, ?, ?)';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($businessId,$licenceno, $vin, $taxableWeight, $logging, $userId, '1'));
	}
}	

function allSummaryErrors()
{
	global $constantArr;
	$html = '<div class="marTop10px errorMsg"><span class="errorIcon"></span> ';
			 
	if(in_array(1,$_SESSION['errorArray']))
	$html.= $constantArr['EnterValidEIN'][$_SESSION['lang']].'<br/>';
	
	if(in_array(2,$_SESSION['errorArray']))
	$html.= $constantArr['EnterValidvin'][$_SESSION['lang']].'<br/>';
	
	if(in_array(9,$_SESSION['errorArray']))
	$html.= $constantArr['noTaxableVehicleFound'][$_SESSION['lang']].'<br/>';
	
	if(in_array(3,$_SESSION['errorArray']))
	$html.= $constantArr['creditExceeded'][$_SESSION['lang']].'<br/>';
	
	if(in_array(4,$_SESSION['errorArray']))
	$html.= $constantArr['select_payment'][$_SESSION['lang']].'<br/>';
	
	if(in_array(5,$_SESSION['errorArray']))
	$html.= $constantArr['taxable_as_suspended_vehicle'][$_SESSION['lang']].'<br/>';
	
	if(in_array(6,$_SESSION['errorArray']))
	$html.= $constantArr['sold_as_taxable_vehicle'][$_SESSION['lang']].'<br/>';
	
	if(in_array(7,$_SESSION['errorArray']))
	$html.= $constantArr['sold_as_suspended_vehicle'][$_SESSION['lang']].'<br/>';
	
	if(in_array(8,$_SESSION['errorArray']))
	$html.= $constantArr['priorsuspended_as_lowmileage'][$_SESSION['lang']].'<br/>';
	
	if(in_array(10,$_SESSION['errorArray']))
	$html.= $constantArr['onlyPriorYearSubmission'][$_SESSION['lang']].'<br/>';
	
	if(in_array(11,$_SESSION['errorArray']))
	$html.= $constantArr['amendedWithoutVehicle'][$_SESSION['lang']].'<br/>';
	
	$html.= '</div>';
	unset($_SESSION['errorArray']);
	
	return $html;
}

function chkFilingEdit($filingId)
{
	global $DBH;
	
	$sql = "SELECT sch1_received,irs_approved,ack_received,xml_submitted,user_completed
			FROM `tt_filings` WHERE id = ? AND active = 1";
	$chksql = $DBH->prepare($sql);
	$chksql->execute(array($filingId));
	$chksql->setFetchMode(PDO::FETCH_ASSOC);
	$row = $chksql->fetch();
	if(($row['sch1_received'] == 1 && $row['irs_approved'] == 1) || ($row['ack_received'] == 1 && $row['irs_approved'] == 1) || 
		($row['ack_received'] == 0 && $row['xml_submitted'] == 1) || ($row['xml_submitted'] == 0 && $row['user_completed'] == 1))
		{
			$status = 'no_edit';
		}
		else 
		{
			$status = 'edit';
		}
	return $status;
}

/************************************** Admin Functions ***********************************/
function getMenuDetails($menuId)
{
	global $DBH;
	$sql = "SELECT * from `t_admin_menus` where id = ?";
	$preparesql = $DBH->prepare($sql);
	$preparesql->execute(array($menuId));
	$preparesql->setFetchMode(PDO::FETCH_ASSOC);
	$row = $preparesql->fetch();		
	return $row;
}
	function getAllparentMenus()
{
	global $DBH;
	$newResult = array();
	$sql = "SELECT * FROM `t_admin_menus` ORDER BY `id` ASC";
	$preparesql = $DBH->prepare($sql);
	$preparesql->execute(array());
	$preparesql->setFetchMode(PDO::FETCH_ASSOC);
	while($row = $preparesql->fetch())
	{
		$newResult[] = $row;
	}
	return $newResult;
}	
	function getCatCount()
{
	global $DBH;
	$sql = "SELECT * FROM t_admin_menus WHERE publish = ?";
	$preparesql = $DBH->prepare($sql);
	$preparesql->execute(array('Y'));
	$count = $preparesql->rowcount();
	return $count;
}	
	function generateCategory($parent)
{
	$editFlag = '';
	$request = $_SERVER['REQUEST_URI'];
	$parsed = explode('/', $request);
	$cat_id = 0;
	if(count($parsed)>4)
	$cat_id = $parsed[4];
	
	if(isset($_REQUEST['type'])){
		$editFlag 		= $_REQUEST['type'];
	}
	
	if(isset($_REQUEST['id'])){
		$templateId 		= $_REQUEST['id'];
	}
	global $DBH;	
	$menu_array = array();
	$sql = "SELECT * FROM  t_admin_menus ORDER BY order_id,menu_display_name ASC";
	$getAllCategory = $DBH->prepare($sql);
	$getAllCategory->execute(array());
	$getAllCategory->setFetchMode(PDO::FETCH_ASSOC);
	while($row = $getAllCategory->fetch()){
			$menu_array[$row['id']] = array('cat_id'=>$row['id'],'name' => $row['menu_display_name'],'parent' => $row['menu_parent_id'],'orderId' => $row['order_id']);
	}
	
	$has_childs = false;
	//this prevents printing 'ul' if we don't have subcategories for this category

	
	//use global array variable instead of a local variable to lower stack memory requierment

	foreach($menu_array as $key => $value)
	{			
		if ($value['parent'] == $parent) 
		{
			//if this is the first child print '<ul>'			
			if ($has_childs === false)
			{
				//don't print '<ul>' multiple times				
				$has_childs = true;
				echo '<ul class="child">';
			}
			?>
			<li id="catRow<?=$value['cat_id']?>">
				<?php 
					if( $editFlag != 'edit') 
					{?>
						<input id="CatId<?=$value['cat_id']?>" value ="<?=$value['cat_id']?>" type="radio" class='hide' name="parentNode" />						
					<?php } else { ?>					
					<input id="CatId<?=$value['cat_id']?>" value ="<?=$value['cat_id']?>" type="radio" name="parentNode" /> 
					<?php 
					} ?>
					
<!--				<a href="/menucontrolpanel/edit/<?=$value['cat_id']?>">-->
				    <a href="javascript:void(0)" onclick="EditMenuControlPanel(<?=$value['cat_id']?>);" id="edit_menu<?=$value['cat_id']?>"> 
					<?php 
						if($cat_id == $value['cat_id']){
							echo '<b class="blacktxt">'.$value['name'].'</b>';
						}else{
							echo '<span id="order_name_'.$value['cat_id'].'">'.$value['name'].' -</span>' ?>
							<?php echo '<span id="order_id_'.$value['cat_id'].'">('.$value['orderId'].')</span>' ?>
						<?php }
					?>
				</a>
			<?php
			#call function again to generate nested list for subcategories belonging to this category
			 generateCategory($key); ?>
			
			</li>
			<?php
		}
	}
	if ($has_childs === true) echo '</ul>';
}
//checking permission for a page
function chkPagePermissions($pageName)
{
	$permissionArray = array();
	global $DBH;
	
	$usersql = "SELECT * FROM t_admin_role_user_privilege WHERE apex_user_id = ?";
	$userpreparesql = $DBH->prepare($usersql);
	$userpreparesql->execute(array($_SESSION['user_id']));
	if($userpreparesql->rowcount() > 0)
	{
		$sql = "SELECT arp.page_access,arp.edit_privilege FROM `t_admin_role_user_privilege` arp
				LEFT JOIN `t_admin_menus` am ON(am.`id` = arp.`menu_id`)
				WHERE am.`menu_name` = ? AND arp.`role_id` = ? AND arp.apex_user_id = ?";
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($pageName,$_SESSION['role_id'],$_SESSION['user_id']));
	}
	else
	{
		$sql = "SELECT arp.page_access,arp.edit_privilege FROM `t_admin_role_privilege` arp
				LEFT JOIN `t_admin_menus` am ON(am.`id` = arp.`menu_id`)
				WHERE am.`menu_name` = ? AND arp.`role_id` = ?";
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($pageName,$_SESSION['role_id']));
	}
	
	$preparesql->setFetchMode(PDO::FETCH_ASSOC);
	$row = $preparesql->fetch();
	$permissionArray = $row;
	return $permissionArray;
}
/* For Admin Panel To get filing years and form types- */
include_once(TT_ENTITY_PATH.'/taxyear_entity.php');

function getTaxFilingYears()
{
	/* taxPayerBusiness DAO */
	$taxyearDAO = new Taxyear_DAO;
	$taxFilingYears = $taxyearDAO::getTaxFilingYears();
	return $taxFilingYears;
}

function getTaxForms()
{
	$taxyearDAO = new Taxyear_DAO;
	$taxFilingYears = $taxyearDAO::getTaxFilingYears();
	$taxForms = $taxyearDAO::getTaxForms();
	return $taxForms;
}
function encryptID($id){
	
	$MCrypt	= new MCrypt;
	$encryptId = '';
	
	$encryptId = $MCrypt->encrypt($id.'#'.$_SESSION['user_id'].'#'.rand(0,5));
	
	return $encryptId;
}
function decryptID($id){
	
	$MCrypt	= new MCrypt;
	$decryptId = '0';

	list($tempId,$userId,$random) = explode('#',$MCrypt->decrypt($id));
	
	if($userId == $_SESSION['user_id']){
		$decryptId = $tempId;
	}
	return $decryptId;
} 	

function populateIrsErrors($data)
{
	$irsApprovalErrors = json_decode($data, true);
	
	$html = '<div class="marTop10px errorMsg">';
	$html.= "<strong>IRS Rejection Errors</strong></br>";
	foreach($irsApprovalErrors AS $value)
	{
		$error1 = explode("Message:", $value);
		$error2 = explode("   Severity:", $error1[1]);
		if($error2[0]):
		$html.= "&#10006; ".$error2[0]."</br>";
		endif;
	}
	$html.= '</div>';

	return $html;
}

//To get Error Details for admin - diagnose screen.
function getIrsErrorsDetails($data)
{
	$irsApprovalErrors = json_decode($data, true);
	
	foreach($irsApprovalErrors AS $value)
	{
		$error1 = explode("Message:", $value);
		$error2 = explode("   Severity:", $error1[1]);
		if($error2[0]):
		$html.= "&#42; ".$error2[0]."</br>";
		endif;
	}

	return $html;
}

//For continue button - Redirection
function getNextPageBasedOnForm($formType,$controllerName)
{
	$pageName = $controllerName;
	
	if($formType!='8849S6'){
		switch ($pageName) 
		{
				case 'taxablevehicleinfo': 
					$page ='currentyrsuspend';
					break;
				case 'currentyrsuspend': 
					$page='prioryrsuspend';
					break;
				case 'prioryrsuspend': 
					$page='solddestroycredit';
					break;
				case 'solddestroycredit': 
					$page='lowmileagecredit';
					break;
				case 'lowmileagecredit': 
					$page='paymentoption';
					break;
				case 'tgwincreased':
					$page='paymentoption';
					break;
				case 'exceededmileage':
					$page='paymentoption';
					break;
				case 'vincorrection':
					$page='summary';
					break;
			
		}
	}
	if($formType == '8849S6'){
		switch ($pageName) 
		{
				case 'solddestroycredit': 
					$page='lowmileagecredit';
					break;
				case 'lowmileagecredit': 
					$page='overpayment';
					break;
				case 'overpayment': 
					$page='summary';
					break;
			
		}
	}

	return $page;
	
}
//Back button  - Redirection
function getBackPageBasedOnForm($formType,$controllerName)
{
	$pageName = $controllerName;
	
	if($formType!='8849S6'){
		switch ($pageName) 
		{
				case 'taxablevehicleinfo': 
					$page='taxyear';
					break;
				case 'currentyrsuspend': 
					$page='taxablevehicleinfo';
					break;
				case 'prioryrsuspend': 
					$page='currentyrsuspend';
					break;
				case 'solddestroycredit': 
					$page='prioryrsuspend';
					break;
				case 'lowmileagecredit': 
					$page='solddestroycredit';
					break;
				case 'tgwincreased':
					$page='taxyear';
					break;
				case 'exceededmileage':
					$page='taxyear';
					break;
				case 'vincorrection':
					$page='taxyear';
					break;
			
		}
	}
	if($formType == '8849S6'){
		switch ($pageName) 
		{
				case 'solddestroycredit': 
					$page='taxyear';
					break;
				case 'lowmileagecredit': 
					$page='solddestroycredit';
					break;
				case 'overpayment': 
					$page='lowmileagecredit';
					break;
			
		}
	}
	
	return $page;
}

// Get the full URL of the current page
function current_page_url(){
    $page_url   = 'http';
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
        $page_url .= 's';
    }
    return $page_url.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
}
//To check Business Name
function checkBusName($businessName)
{
	$status = 0;
	
	if(!preg_match('/^[A-Za-z0-9\b\ \t\.\#\&\-\'\"\(\)]+$/', $businessName))
	$status = 1;
	
	return $status;
}
//To check Designee Name, Signature authority name
function checkName($name)
{
	$status = 0;
	
	if(!preg_match("/^([A-Za-z0-9'\-] ?)*[A-Za-z0-9'\-]$/", $name))
	$status = 1;
	
	return $status;
}
//To check Address
function checkAddress($address)
{
	$status = 0;
	
	if(!preg_match("/^[A-Za-z0-9]( ?[A-Za-z0-9\/-])*$/", $address))
	$status = 1;

	return $status;
}

//To check city for US
function checkCity($businessCity)
{
	$status = 0;
	
	if(!preg_match("/^([A-Za-z] ?)*[A-Za-z]$/", $businessCity))
	$status = 1;
	
	return $status;
}
// If no Taxable vehciles is added or Total tax is zero, Then  payment entry from  tt_filing_payment is removed
function removeIRSPayment($filingId){
	global $DBH;
	
	$sql = "UPDATE tt_filing_payment set active = 0 WHERE filing_id = ?";
	$preparesql = $DBH->prepare($sql);
	$preparesql->execute(array($filingId));
}

// Show known xsd validation errors to user
function getKnownXSDErrors($error)
{
	if (strpos($error,'VINType') !== false || strpos($error,'BusinessNameControlType') !== false) {
		$error_msg = "Please check VIN";
	}
	else if (strpos($error,'#AnonType_NameFilerReturnHeaderType') !== false) {
		$error_msg = "Please check your business name. Should not contain any special characters.";
	}else if (strpos($error,'PINType') !== false) {
		$error_msg = "Please check pin entered. Should atleast contain 5 digit.";
	}else if (strpos($error,'PhoneNumberType') !== false) {
		$error_msg = "Please check Phone number entered";
	}
	
	return $error_msg;
}
?>