<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : paymentoption_biz.php
 * @version  : 1.0
 * @date  : 18-Aug-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila         		 18-Aug-2012           Initial Version - File Created
 * 
 */

class Paymentoption_Model
{		
	public function __construct()
	{		
		$paymentoptionDAO = new Paymentoption_DAO;
		$this->paymentoptionDAO = $paymentoptionDAO;
		
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
	}
	
	public function savePaymentOptionInfo($filingid,$paymentMode,$bankName,$accountType,$acNumber,$rountingTransitNumber)
	{
		$this->paymentoptionDAO->savePaymentOptionInfo($filingid,$this->MCrypt->encrypt($paymentMode),$this->MCrypt->encrypt($bankName),
								$this->MCrypt->encrypt($accountType),$this->MCrypt->encrypt($acNumber),$this->MCrypt->encrypt($rountingTransitNumber));	
	}
	
	public function getfilingPaymentDetails($filingid)
	{
		$paymentDetails = $this->paymentoptionDAO->getfilingPaymentDetails($filingid);
		return $paymentDetails;
	}
	
}