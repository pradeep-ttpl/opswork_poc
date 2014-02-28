<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : taxyear_controller.php
 * @version  : 1.0
 * @date  : 18-Jul-2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           18-Jul-2012           Initial Version - File Created
 * 
 */

class Taxyear_Controller
{
	public $template = 'taxyear';

	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header( 'Location: '.TT_SITE_NAME.'login');
			exit();
		}
		
		$taxpayerbusiness_Model = new Taxpayerbusiness_Model;
		
		$businessDetails = $taxpayerbusiness_Model->getBusinessDetails();
		
		$taxyear_Model = new Taxyear_Model;
		
		if(isset($reqVars['taxyear']))
		{
			$taxyear_Model->saveTaxFilingYear($reqVars);
			if($_SESSION['formtype'] == '2290'):
			header( 'Location: '.TT_SITE_NAME.'taxablevehicleinfo');
			endif;
			
			if($_SESSION['formtype'] == '8849S6'):
			header( 'Location: '.TT_SITE_NAME.'solddestroycredit');
			endif;
			
			if($_SESSION['formtype'] == '2290A1'):
			header( 'Location: '.TT_SITE_NAME.'tgwincreased');
			endif;
			
			if($_SESSION['formtype'] == '2290A2'):
			header( 'Location: '.TT_SITE_NAME.'exceededmileage');
			endif;
			
			if($_SESSION['formtype'] == '2290V'):
			header( 'Location: '.TT_SITE_NAME.'vincorrectionlist');
			endif;
			
			exit();
		}
		
		$taxFilingYear = $taxyear_Model->getTaxFilingYears();
		$taxForms = $taxyear_Model->getTaxForms();

		$tpl = new Template_Model($this->template);
		$tpl->assign('taxFilingYear',$taxFilingYear);
		$tpl->assign('taxForms',$taxForms);
		$tpl->assign('businessDetails',$businessDetails);
	}
}

?>