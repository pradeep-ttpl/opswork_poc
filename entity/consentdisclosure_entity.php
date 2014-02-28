<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : consentdisclosure_entity.php
 * @version  : 1.0
 * @date  : 19-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila         		 19-Jul-2012           Initial Version - File Created
 * 
 */
class Consentdisclosure_DAO
{
		public function __construct()
		{	
		
		}
		
		//inserting contentdisclosure value '1' into TT_FilingMaster table
		public function savedisclosure($reqVars,$filingid)
		{
			global $DBH;
			
			$consentdisclosure = $reqVars['contentdisclosure'];
			
			if($consentdisclosure == '1')
			{
				$updatefilingmaster = "Update `tt_filings` set `consent_disclosure` = 1 WHERE id = ? AND active = 1";	  
				$prepareupdatefilingInfo = $DBH->prepare($updatefilingmaster);
				$prepareupdatefilingInfo->execute(array($filingid));
			}
			else if($consentdisclosure == '0')
			{
				$updatefilingmaster = "Update `tt_filings` set `consent_disclosure` = 0 WHERE id = ?  AND active = 1";	
				$prepareupdatefilingInfo = $DBH->prepare($updatefilingmaster);
				$prepareupdatefilingInfo->execute(array($filingid));
			}

		}
		
		public function consentdiscosure($filingId)
		{
			global $DBH;
			$result = array();
			$sql = "SELECT * FROM `tt_filings` WHERE `id` = ?  AND active = 1";
			$preparesql = $DBH -> prepare($sql);
			$preparesql -> execute(array($filingId));
			$preparesql -> setFetchMode(PDO::FETCH_ASSOC);
			$result = $preparesql ->fetch();
			
			return $result;
		}
}
?>