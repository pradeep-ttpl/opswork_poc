<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : init.php
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

function __autoload($className)
{ 	
	list($filename , $suffix) = explode('_' , $className);	

	switch (strtolower($suffix))
	{	
		case 'model':
			
			$folder = '/model/';			
			$suffix = TT_BIZ_SUFFIX;
			
		break;	

		case 'dao':
			
			$folder = '/entity/';	
			$suffix = TT_DAO_SUFFIX;			
			
		break;		
	}	
	
	$file = TT_SITE_PATH . $folder . strtolower($filename) . $suffix .'.php';		
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
$page = preg_replace( '|[^a-z0-9-]+|', '', $parsed[1] );


$getVars = array();
if( isset($_REQUEST) ) {
	$getVars = $_REQUEST;
}

$target = TT_CONTROLLER_PATH . '/' . $page . '_controller.php';
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
	header('Location: '.TT_SITE_NAME);
	exit();
}
$controller->main($getVars);

?>