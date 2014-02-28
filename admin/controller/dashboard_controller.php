<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: dashboard_controller.php
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

class Dashboard_Controller
{	
	public $template = 'Dashboard';
	
	public function main( array $reqVars )
	{
		$dashboardModel = new Dashboard_Model;
		
		$getVersionDetails = $dashboardModel->getVersionDetails();

		$tpl = new Template_Model($this->template);	
		
		$tpl->assign('getVersionDetails',$getVersionDetails);
	}		
}
?>