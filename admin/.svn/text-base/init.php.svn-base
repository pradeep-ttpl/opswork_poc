<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: init.php
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

function __autoload($className)
{ 	
	list($filename , $suffix) = explode('_' , $className);	

	switch (strtolower($suffix))
	{	
		case 'model':
			
			$folder = '/model/';			
			$suffix = TT_ADMIN_BIZ_SUFFIX;
			
		break;	

		case 'dao':
			
			$folder = '/entity/';	
			$suffix = TT_ADMIN_DAO_SUFFIX;			
			
		break;		
	}	
	
	$file = TT_ADMIN_SITE_PATH . $folder . strtolower($filename) . $suffix .'.php';		
	if (file_exists($file))
	{		
		include_once($file);		
	}
	else
	{		
		die("File '$filename' containing class '$className' not found in '$folder'.");	
	}
}

// GET URL VALUE...
$request = $_SERVER['REQUEST_URI']; 

$parsed = explode('/', $request);
$page = preg_replace( '|[^a-z0-9-]+|', '', $parsed[2] );


$getVars = array();
if( isset($_REQUEST) ) {
	$getVars = $_REQUEST;
}

$target = TT_ADMIN_CONTROLLER_PATH . '/' . $page . '_controller.php';
if (file_exists($target))
{	
	include_once($target);	
	
	$class = ucfirst($page) . '_Controller';	
	if (class_exists($class))
	{
		$controller = new $class;
	}
	else
	{		
		die('Class does not exist!');
	}
}
else
{	
	header('Location: '.TT_ADMIN_SITE_NAME);
	exit();
}
$controller->main($getVars);

?>