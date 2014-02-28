<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : formselection_controller.php
 * @version  : 1.0
 * @date  : 20-Jul-2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           20-Jul-2012           Initial Version - File Created
 * 
 */

class Formselection_Controller
{	
	public $template = 'formselection_new';
	
	public function main( array $reqVars )
	{	
		if(!isset($_SESSION['user_id']))
		{
			header( 'Location: '.TT_SITE_NAME.'login');	
			exit();
		}
		
		if(isset($reqVars['formfile']))
		{
			$_SESSION['formtype'] = $reqVars['formfile'];
			header( 'Location: '.TT_SITE_NAME.'taxyear');
		}
		
		$tpl = new Template_Model($this->template);				
	}		
}

?>