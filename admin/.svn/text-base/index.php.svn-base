<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: index.php
 * @version  	: 1.0
 * @date  		: 12-Dec-2013
 *
 * @description :
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        12-Dec-2013           Initial Version - File Created
 * 
 */
	require_once ('../config.php');
	include_once ('../constants.php');
	require_once ('../include/functions.php');
	require_once ('../include/email_templates.php');
	require_once ('../include/tax_error.php');
	include_once (TT_INCLUDE_PATH.'/MCrypt.php');

	$request = $_SERVER['REQUEST_URI'];
	$parsed = explode('/', $request);

	// Audit log or Audit trail for reference
	//auditlog();
	
	if(strlen($parsed[2])>0)
	{
		include 'init.php';
	}
	else
	{
		include TT_ADMIN_VIEW_PATH . '/login_ui.php';
	}

?>
