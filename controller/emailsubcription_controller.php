<?php
/*  
 * @Copyright (c) 2011 Triesten Technologies. All Rights Reserved.              
 * @date   		:	Aug 01, 2012
 * 
 * @description	:	controller file for email subcription
 * 		
 * @author 		:	Naveen
 * 
 * History of  modifications:
 *
 * Author	      	Date	            Description of  modifications
 * ----------       ------------	 	---------------------------------
 * Naveen    		Aug 01, 2012       Initial Version - File Created
 * 
 */

class Emailsubcription_Controller
{	
	public $template = 'emailsubcription';
	
	public function main( array $reqVars )
	{		
		if(isset($reqVars)){
			$emailSubcriptionModel = new Emailsubcription_Model;
			$emailSubStatus = $emailSubcriptionModel->emailSubscription($reqVars);
			header( 'Location: '.TT_SITE_NAME);
			exit();
			
		}
		//$tpl = new Template_Model($this->template);				
	}		
}
?>