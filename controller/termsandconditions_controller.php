<?php
/*  
 * @Copyright (c) 2011 Triesten Technologies. All Rights Reserved.              
 * @date   		:	June 29, 2012
 * 
 * @description	:	controller file for aboutus
 * 		
 * @author 		:	Akila
 * 
 * History of  modifications:
 *
 * Author	      	Date	            Description of  modifications
 * ----------       ------------	 	---------------------------------
 * Akila    		July 13, 2012       Initial Version - File Created
 * 
 */

class Termsandconditions_Controller
{	
	public $template = 'termsandconditions';
	
	public function main( array $reqVars )
	{		
		$tpl = new Template_Model($this->template);				
	}		
}
?>
