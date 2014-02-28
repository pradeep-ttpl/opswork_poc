<?php
/*  
 * @Copyright (c) 2011 Triesten Technologies. All Rights Reserved.              
 * @date   		:	August 4, 2011 
 * 
 * @description	:	entity file for summaryreview
 * 					It contains only sql query and logic.
 * 		
 * @author 		:	Akila 
 * 
 * History of  modifications:
 *
 * Author	      	Date	            Description of  modifications
 * ----------       ------------	 	---------------------------------
 * Akila            August 4, 2011      Initial Version - File Created
 * 
 */

class Summaryreview_DAO
{		
	public function __construct()
	{	
		
	}

	//get filing fee from tt_fee_plan_master table
	public function getfilingfee()
	{
		global $DBH;
		$date = date('Y-m-d');
		$result = array();
		$sql = "SELECT fee, wef FROM tt_fee_plan_master WHERE wef IN ( SELECT max( wef ) FROM tt_fee_plan_master WHERE wef <= '$date') AND active = ?";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array('1'));
		$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql ->fetch();
		
		return $result;
	}
	
	public function checkConsentDisclosure()
	{
		$filingId = $_SESSION['filingId'];
		global $DBH;
		$result = array();
		$sql = "SELECT consent_disclosure FROM `tt_filings` WHERE  `id` = ? AND active = 1";
		$preparesql = $DBH -> prepare($sql);
		$preparesql -> execute(array($filingId));
		$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql ->fetch();
		
		return $result;		
	}
}
?>