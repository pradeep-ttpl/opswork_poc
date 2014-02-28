<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: template_biz.php
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

class Template_Model
{	
	private $data = array();	
	private $render = FALSE;	
	
	public function __construct($template)
	{		
		$file = TT_ADMIN_SITE_PATH . '/views/' . strtolower($template) . TT_ADMIN_UI_SUFFIX . '.php';
		
		if (file_exists($file))
		{			
			$this->render = $file;
		}		
	}	
	
	public function assign($variable , $value)
	{
		$this->data[$variable] = $value;
	}
	
	public function __destruct()
	{		
		$data = $this->data;
		
		include($this->render);
	}
}


?>