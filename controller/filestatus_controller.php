<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : filestatus_controller.php
 * @version  : 1.0
 * @date  : 23-Dec-2013
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           23-Dec-2013           Initial Version - File Created
 * 
 */

class Filestatus_Controller
{
	public $template = 'filestatus';

	public function main( array $reqVars )
	{
		$business_list = '';
		// Check user login
		if(!isset($_SESSION['user_id']))
		{
			header( 'Location: '.TT_SITE_NAME.'login');
			exit();
		}
		
		// To get list of pending filing list
		$taxpayerbusiness_Model = new Taxpayerbusiness_Model;
		$filelist = $taxpayerbusiness_Model->getFilingList();
		
		$tpl = new Template_Model($this->template);
		$tpl->assign('filings',$filelist);
	}
}
?>