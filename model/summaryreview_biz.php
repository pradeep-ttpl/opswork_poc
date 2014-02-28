<?php
/*  
 * @Copyright (c) 2011 Triesten Technologies. All Rights Reserved.              
 * @date   		:	August 4, 2011 
 * 
 * @description	:	model file for summaryreview
 * 		
 * @author 		:	Akila 
 * 
 * History of  modifications:
 *
 * Author	      	Date	            Description of  modifications
 * ----------       ------------	 	---------------------------------
 * Akila            August 4, 2011      Initial Version - File Created
 * 
 */

class Summaryreview_Model
{		
	public function __construct()
	{		
		$summaryreviewDAO = new Summaryreview_DAO;
		$this->summaryreview = $summaryreviewDAO;
	}
	
	//get filing fee from tt_fee_plan_master table
	public function getfilingfee()
	{
		$result = $this->summaryreview->getfilingfee();
		return $result;			
	}
	
	// Get cosent disclosure status
	public function checkConsentDisclosure()
	{
		$result = $this->summaryreview->checkConsentDisclosure();
		return $result;	
	}
}
?>
