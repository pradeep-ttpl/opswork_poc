<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : consentdisclosure_biz.php
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

class Consentdisclosure_Model
{
	public function __construct()
	{		
		$consentdisclosureDAO = new consentdisclosure_DAO;
		$this->consentdisclosureDAO = $consentdisclosureDAO;
	}
	public function saveconsentdisclosure( array $reqVars )
	{			
		$consentdisclosure = $reqVars['contentdisclosure'];
		$filingid = $_SESSION['filingId'];
		
		$contentdisclosureData = $this->consentdisclosureDAO->savedisclosure($reqVars,$filingid);
		
		return $consentdisclosure;
	}
	
	public function getconsentdiscosure()
	{
		$filingId = $_SESSION['filingId'];
		$result = $this->consentdisclosureDAO->consentdiscosure($filingId);
		return $result;
	}
}
?>