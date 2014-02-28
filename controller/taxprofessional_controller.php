<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : taxprofessional_controller.php
 * @version  : 1.0
 * @date  : Dec 6, 2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           Dec 6, 2012           Initial Version - File Created
 * 
 */

class Taxprofessional_Controller
{
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header("location: /register/?register=taxprof");
			exit();	
		}
		else
		{
			header("location: /taxpayerbusiness/");
			exit();	
		}
	}
	
}