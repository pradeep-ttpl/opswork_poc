<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: viewxml_biz.php
 * @version  	: 1.0
 * @date  		: 29-Jan-2014
 *
 * @description : view xml business model file
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

class Viewxml_Model
{		
	public function __construct()
	{		
		$viewxmlDAO = new Viewxml_DAO;
		$this->viewxmlDAO = $viewxmlDAO;
	}
	
	// Fetching all users list
	public function getFilingDetails($filingId)
	{
		$file_details = $this->viewxmlDAO->getFilingDetails($filingId);
		return $file_details;		
	}		
}
?>