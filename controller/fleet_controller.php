<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : fleet_controller.php
 * @version  : 1.0
 * @date  : 20-Nov-2013
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           20-Nov-2013           Initial Version - File Created
 * 
 */

class Fleet_Controller
{	
	public $template = 'fleet';
	
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
		
		$fleetModel = new Fleet_Model;
		
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		
		$taxpayerbusiness_Model = new Taxpayerbusiness_Model;
		
		$businessDetails = $taxpayerbusiness_Model->getBusinessDetails();
		$status = '';
		// add new vehicle information
		if(isset($reqVars['addfleet']))
		{
			$businessId = $reqVars['business'];
			$licenceno = $reqVars['licenceno'];
			$vin = $reqVars['vin'];
			$taxableWeight = $reqVars['taxableWeight'];
			$logging = $reqVars['logging'];
			$add_fleet = $fleetModel->addnewfleet($businessId,$licenceno, $vin, $taxableWeight, $logging);
			if($add_fleet > 0)
			{
				$_SESSION['fleet_status'] = 'Successfully added';
				header('location:/fleet/');
				exit(0);
			}
		}
		
		// edir fleet details
		if(isset($reqVars['updatefleet']))
		{
			$businessId = $reqVars['business'];
			$licenceno = $reqVars['licenceno'];
			$vin = $reqVars['vin'];
			$taxableWeight = $reqVars['taxableWeight'];
			$logging = $reqVars['logging'];
			$vinid = decryptID($reqVars['vinid']);
			$update_fleet = $fleetModel->updatefleet($businessId,$licenceno, $vin, $taxableWeight, $logging, $vinid);
			$_SESSION['fleet_status'] = 'Successfully updated';
			header('location:/fleet/');
			exit(0);
		}
		
		if(isset($parsed[2]) && $parsed[2] == 'add')
		{
			$taxablevehicleinfoModel = new taxablevehicleinfo_Model;
			$getweight = $taxablevehicleinfoModel->getTaxweight();
			$this->template = 'add_fleet';
		}
		else if(isset($parsed[2]) && $parsed[2] == 'edit')
		{	
			$fleetDetails = $fleetModel->getfleetdetails(decryptID($reqVars['vinid']));
			$taxablevehicleinfoModel = new taxablevehicleinfo_Model;
			$getweight = $taxablevehicleinfoModel->getTaxweight();
			$this->template = 'edit_fleet';
		}
		else
		{
			$userFleets = $fleetModel->getFleets();
		}
		
		
		// Passing the response data to UI template.
		$tpl = new Template_Model($this->template);
		if(isset($userFleets))
		{
			$tpl->assign("userFleets", $userFleets);
		}
		if(isset($getweight))
		{
			$tpl->assign('taxWeights',$getweight);
		}
		if(isset($fleetDetails))
		{
			$tpl->assign('fleetDetail',$fleetDetails);
		}
		$tpl->assign('businessDetails',$businessDetails);
	}		
}

?>