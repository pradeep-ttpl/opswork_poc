<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : contactus_controller.php
 * @version  : 1.0
 * @date  : Dec 11, 2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           Dec 11, 2012           Initial Version - File Created
 * 
 */

class Contactus_Controller
{	
	public $template = 'contactus';
	
	public function main( array $reqVars )
	{		
		$tpl = new Template_Model($this->template);				
	}		
}

?>