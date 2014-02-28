<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : template_biz.php
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

class Template_Model
{	
	private $data = array();	
	private $render = FALSE;	
	
	public function __construct($template)
	{		
		$file = TT_SITE_PATH . '/views/' . strtolower($template) . TT_UI_SUFFIX . '.php';
		
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