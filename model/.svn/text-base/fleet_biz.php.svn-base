<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : fleet_biz.php
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

class Fleet_Model
{		
	public function __construct()
	{		
		// taxPayerBusiness DAO
		$fleetDAO = new Fleet_DAO;
		$this->fleetDAO = $fleetDAO;
		
		// Intializing MCrypt class
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;		
	}
	
	public function getFleets()
	{
		$userFleets = $this->fleetDAO->getUserFleets();
		return $userFleets;
	}
	
	public function addnewfleet($businessId,$licenceno, $vin, $taxableWeight, $logging)
	{
		$status = $this->fleetDAO->addnewfleet($businessId, $licenceno, $this->MCrypt->encrypt($vin), $this->MCrypt->encrypt($taxableWeight), $this->MCrypt->encrypt($logging));
		return $status;
	}
	
	public function getfleetdetails($vinid)
	{
		$fleetDetails = $this->fleetDAO->getfleetdetails($vinid);
		return $fleetDetails;		
	}
	
	public function updatefleet($businessId, $licenceno, $vin, $taxableWeight, $logging, $vinid)
	{
		$status = $this->fleetDAO->updatefleet($businessId, $licenceno, $this->MCrypt->encrypt($vin), $this->MCrypt->encrypt($taxableWeight), $this->MCrypt->encrypt($logging), $vinid);
		return $status;		
	}
}

?>