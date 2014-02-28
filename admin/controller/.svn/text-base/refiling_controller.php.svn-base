<?php
class Refiling_Controller
{	
	public $template = 'refiling';
	public function main( array $reqVars )
	{	
		$refilingModel 	= new Refiling_Model;
		$MCrypt			= new MCrypt;
		
		$taxFilingYear  = getTaxFilingYears();
		$taxFormsType	= getTaxForms();

		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		
		$filingId = 0;

		if(isset($parsed[3]) && $parsed[3] != ''){
			$filingId = $parsed[3];
		}			
			
		if(isset($reqVars['search']))
		{
			$ein = str_replace('-','',$reqVars['ein']);
			$bizName = $reqVars['bizName'];
			$taxForm = $reqVars['taxForm'];
			$taxyear = $reqVars['taxyear'];
			$taxmonth = $reqVars['taxmonth'];
			
			$getfilingListResult = $refilingModel->getfilingList($MCrypt->decrypt($filingId),$MCrypt->encrypt($ein),$MCrypt->encrypt($bizName),$taxForm,$taxyear,$MCrypt->encrypt($taxmonth));
		}
		
		
		
		$tpl = new Template_Model($this->template);		
		$tpl->assign('filingList',$getfilingListResult);
		$tpl->assign('taxFilingYear',$taxFilingYear);
		$tpl->assign('taxForms',$taxFormsType);
		if(isset($reqVars)){
			$tpl->assign('reqVars',$reqVars);
		}
		
	}		
}
?>