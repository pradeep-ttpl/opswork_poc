<?php
/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: dashboard_biz.php
 * @version  	: 1.0
 * @date  		: 08-Jan-2014
 *
 * @description :
 *
 * @author      : Raja Saravanan S R D
 *
 * History of modifications:
 *
 * Author                       Date                  Description of modifications
 * ----------                  ------------          ------------------------------
 * Raja Saravanan S R D        08-Jan-2014           Initial Version - File Created
 * 
 */

class Dashboard_Model
{
	public function __construct()
	{
		$dashboardDAO = new Dashboard_DAO;
		$this->dashboardDAO = $dashboardDAO;
	}	
	
	public function getVersionDetails()
	{
		$getVersionDetails = $this->dashboardDAO->getVersionDetails();
		return $getVersionDetails;
	}
}
?>