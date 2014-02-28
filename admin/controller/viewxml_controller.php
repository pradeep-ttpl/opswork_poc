<?php
class Viewxml_Controller
{	
	public $template = 'viewxml';
	public function main( array $reqVars )
	{	
		$viewxmlModel 	= new Viewxml_Model;
		$MCrypt			= new MCrypt;

		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		
		if(isset($parsed[3]) && $parsed[3] != '')
		{	
			$filingId = $MCrypt->decrypt($parsed[3]);		
			$filingDetails = $viewxmlModel->getFilingDetails($filingId);
			
			// Get xml from stored location if xml is submitted
			if($filingDetails['xml_submitted'] == "1")
			{
				$filename = $filingId."_submission_".$filingDetails['submission_id'].".xml";				
				$xmlpage = file_get_contents(TT_XML_INPUT_PATH.$filename);
			}
			// Get/Generate xml using Java API
			else
			{
				$xmlpage = file_get_contents(GENERATE_SUBMISSION_XML_PATH.$filingId);
			}
		}
		
		// Display xml generated/submitted
		ob_clean();
		header ("Content-Type:text/xml");
		echo $xmlpage;
	}		
}
?>