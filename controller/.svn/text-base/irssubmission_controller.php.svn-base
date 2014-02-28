<?php
/*  
 * @Copyright (c) 2011 Triesten Technologies. All Rights Reserved.              
 * @date   		:	Jan 23, 2012
 * 
 * @description	:	controller file for irs submission
 * 		
 * @author 		:	Ramesh Raja
 * 
 * History of  modifications:
 *
 * Author	      	Date	            Description of  modifications
 * ----------       ------------	 	---------------------------------
 * Ramesh Raja		Jan 23, 2012        Initial Version - File Created
 * 
 */

class Irssubmission_Controller
{	
	public $template = 'irssubmission';
	
	public function main( array $reqVars )
	{	
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
		
		if($reqVars['concentDiscloser'] == "on")
		{
			$filingid = $_SESSION['filingId'];
			
			// get file tax year and form type details
			$taxpayerbusinessDAO = new Taxpayerbusiness_DAO;
			$file_details = $taxpayerbusinessDAO->getFilingDetails($filingid);
			
			if($file_details['user_completed'] == "1")
			{
				$status = "duplicate";
			}
			else
			{
				$irssubmissionModel = new Irssubmission_Model;
				$result = $irssubmissionModel->updateFiling($filingid);
				
				////////////////// API CALL - IRS Submission /////////////////
				
				$postdata = http_build_query(
				    array(
				        'filingId' => $filingid
				    )
				);
				$opts = array('http' =>
				    array(
				        'method'  => 'POST',
				        'header'  => 'Content-type: application/x-www-form-urlencoded',
				        'content' => $postdata
				    )
				);
				
				$context = stream_context_create($opts);
				
				$json = file_get_contents(IRS_SUBMISSION_PATH, false, $context);
				$validation_result = json_decode($json, true);
				// submitted,noreceipt,xsdfailed and nofilingid
				if($validation_result['result'] == "submitted"){ 
					$status = "success";
				}
				else if($validation_result['result'] == "noreceipt"){ 
					$status = "pending";
				}
				else if($validation_result['result'] == "xsdfailed"){ 
					$status = "pending";
				}
				else if($validation_result['result'] == "nofilingid"){ 
					$status = "pending";
				}
				else{
					$status = "pending";
				}
				
				// API Communication error reporting to admin
				if($json === FALSE) 
				{ 
					// To create the mailing content
					$message = APICommunicationErrorContent("summary", TT_SITE_NAME);
					$subject = "Alert: http://".$_SERVER['SERVER_NAME']." - Error Connecting API";
					// send communication error mail to administrator
					$sendMail =  SendEmail(TT_ALERT_MAIL_FROM,TT_ALERT_MAIL_TO,$subject,$message);
				}	
			}
		}
		else
		{
			header('Location: /error/');
			exit();			
		}
		
		$tpl = new Template_Model($this->template);	
		$tpl->assign('status',$status);			
	}		
}
?>