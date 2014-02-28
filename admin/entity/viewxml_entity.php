<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: viewxml_entity.php
 * @version  	: 1.0
 * @date  		: 29-Jan-2014
 *
 * @description : view xml entity file
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja	         29-Jan-2014           Initial Version - File Created
 * 
 */

class Viewxml_DAO
{
	// Fetching all customer list
	public function getFilingDetails($filingId)
	{
		global $DBH;
		$sql = 'SELECT tf.*, ty.id AS tax_year_id,ty.display_year, forms.desc FROM `tt_filings` AS tf
				JOIN tt_tax_year AS ty ON (tf.filing_year = ty.tax_year)
				JOIN `tt_forms` AS forms ON (tf.form_type = forms.type)
				WHERE  tf.id = ?  AND tf.active = 1';
		$preparesql = $DBH->prepare($sql);
		$executesql = $preparesql->execute(array($filingId));		
		$preparesql->setFetchMode(PDO::FETCH_ASSOC);
		$result = $preparesql->fetch();
		return $result;			
	}
}
?>