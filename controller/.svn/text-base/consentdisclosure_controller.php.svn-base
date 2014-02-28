<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : consentdisclosure_controller.php
 * @version  : 1.0
 * @date  : 19-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila         		 19-Jul-2012           Initial Version - File Created
 * 
 */
class Consentdisclosure_Controller
{
	public $template = 'consentdisclosure'; 
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
		
		$consentdisclosureModel 	=  new consentdisclosure_Model;
		
		if(isset($reqVars['savedisclosure']))
		{
			$ResultConsentdisclosure = $consentdisclosureModel->saveconsentdisclosure($reqVars);
		}
		
		$getconsentdiscosure       			= $consentdisclosureModel->getconsentdiscosure();
		
		if(($ResultConsentdisclosure =='1') || ($ResultConsentdisclosure =='0'))
		{
			header("location:/summary");
			exit();
		}
		
		// Passing the response data to UI template.
		$tpl = new Template_Model($this->template);	
		$tpl->assign('consentdisclosure',$ResultConsentdisclosure);
		$tpl->assign('getconsentdisclosure',$getconsentdiscosure);
		
	}
}
?>