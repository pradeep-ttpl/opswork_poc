<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : index.php
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
	require_once ('config.php');
	include_once ('constants.php');
	require_once (TT_INCLUDE_PATH.'/functions.php');
	require_once (TT_INCLUDE_PATH.'/summary_validations.php');
	require_once (TT_INCLUDE_PATH.'/tax_error.php');
	require_once (TT_INCLUDE_PATH.'/email_templates.php');
	include_once (TT_INCLUDE_PATH.'/MCrypt.php');

	$request = $_SERVER['REQUEST_URI'];
	$parsed = explode('/', $request);

	if(strlen($parsed[1])>0)
	{
		include 'init.php';
	}
	else
	{
		include TT_VIEW_PATH . '/landing_ui.php';
	}

?>