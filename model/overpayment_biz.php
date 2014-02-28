<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : overpayment_biz.php
 * @version  : 1.0
 * @date  : 27-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila                27-Jul-2012            Initial Version - File Created
 * 
 */
class Overpayment_Model
 {
	 public function __construct()
	 {
		 $overpaymentDAO = new Overpayment_DAO;
		 $this->overpaymentDAO = $overpaymentDAO;
		 
		 $MCrypt	= new MCrypt;
		 $this->MCrypt = $MCrypt;
	 }
	 
	 public function addOverpayment($userid,$filingid,$vin,$paymentdate,$amtclaim,$explanation,$createdBy)
	 {	 	
	 	global $constantArr,$docAllowedTypes;
	 	$target = TT_UPLOAD_PATH;
	 	$document = '';
	 	$newFilename = '';
	 	$errorFlag = '~error';
		$successFlag = '~success';
		$checkVin  = chkVin($vin);
	 	
	 	if($vin == '')
		{
			$message = $constantArr['EnterVin'][$_SESSION['lang']].$errorFlag;
		}
		else if($checkVin > 0)
		{
			$message = $constantArr['EnterValidvin'][$_SESSION['lang']].$errorFlag;
		}
	 	else if($paymentdate == '')
		{
			$message = $constantArr['selectDate'][$_SESSION['lang']].$errorFlag;
		}
		else if($amtclaim == '')
		{
			$message = $constantArr['enterAmtClaim'][$_SESSION['lang']].$errorFlag;
		}
	 	else if($explanation == '')
		{
			$message = $constantArr['enterDescClaim'][$_SESSION['lang']].$errorFlag;
		}
	 	else
	 	{
	 	
		 	if(isset($_FILES['document']['name']) && $_FILES['document']['name']!='')
		 	{
		 		$newFilename = $userid.'_'.$filingid.'_'.date('Ymdhis');
		 		$ext = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
				$document = $newFilename.'.'.$ext;
		 		
		 		if(in_array($_FILES['document']['type'],$docAllowedTypes))
		 		move_uploaded_file ( $_FILES['document']['tmp_name'] ,$target.$newFilename.'.'.$ext );
		 	}
		 	
		 	$OverpaymentInfo = $this->overpaymentDAO->addOverpayment($this->MCrypt->encrypt($vin),
							   $this->MCrypt->encrypt($paymentdate),$this->MCrypt->encrypt($amtclaim),$this->MCrypt->encrypt(trim($explanation)),
							   $this->MCrypt->encrypt($document),$filingid,$createdBy);
		 	
			if($OverpaymentInfo=='inserted')
			{
				$message = $constantArr['vehicle_added'][$_SESSION['lang']].$successFlag;
			}
			else 
			$message = $constantArr['vehicle_not_added'][$_SESSION['lang']].$errorFlag;
		
	 	}
		
		return $message;	 	
	 }
	 
 	public function getOverpayment($userid,$filingid)
	{
		$getOverpaymentInfo = $this->overpaymentDAO->getOverpaymentDet($userid,$filingid);	
		return $getOverpaymentInfo;
	}
	
 	public function editoverpaymentdet($overpaymentId,$businessId)
	{
		$overPaymentDet = $this->overpaymentDAO->editoverpaymentdetails($overpaymentId,$businessId);
		return $overPaymentDet;
	}
	
 	public function updateOverpaymentDet($userid,$filingid,$vin,$overpaymentId,$paymentdate,$amtclaim,$explanation,$modifiedBy)
	{
		global $constantArr,$docAllowedTypes;
		
		$target = TT_UPLOAD_PATH;
	 	$document = '';
	 	$newFilename = '';
	 	$errorFlag = '~error';
		$successFlag = '~success';
		$checkVin  = chkVin($vin);
	 	
	 	if($vin == '')
		{
			$message = $constantArr['EnterVin'][$_SESSION['lang']].$errorFlag;
		}
		else if($checkVin > 0)
		{
			$message = $constantArr['EnterValidvin'][$_SESSION['lang']].$errorFlag;
		}
	 	else if($paymentdate == '')
		{
			$message = $constantArr['selectDate'][$_SESSION['lang']].$errorFlag;
		}
		else if($amtclaim == '')
		{
			$message = $constantArr['enterAmtClaim'][$_SESSION['lang']].$errorFlag;
		}
	 	else if($explanation == '')
		{
			$message = $constantArr['enterDescClaim'][$_SESSION['lang']].$errorFlag;
		}
	 	else 
	 	{
			if(isset($_FILES['document']['name']) && $_FILES['document']['name']!='')
		 	{
		 		$newFilename = $userid.'_'.$filingid.'_'.date('Ymdhis');
		 		$ext = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
				$document = $newFilename.'.'.$ext;
		 		
		 		if(in_array($_FILES['document']['type'],$docAllowedTypes))
		 		move_uploaded_file ( $_FILES['document']['tmp_name'] ,$target.$newFilename.'.'.$ext );
		 	}
			
			$PaymentDet = $this->overpaymentDAO->updateCreditDetails($this->MCrypt->encrypt($vin),$this->MCrypt->encrypt($paymentdate),
						  $this->MCrypt->encrypt($amtclaim),$this->MCrypt->encrypt(trim($explanation)),$this->MCrypt->encrypt($document),
						  $overpaymentId,$modifiedBy);
			
			if($PaymentDet>0)
			$message = $constantArr['vehicle_updated'][$_SESSION['lang']].$successFlag;
			else 
			$message = $constantArr['vehicle_not_updated'][$_SESSION['lang']].$errorFlag;
		
	 	}
		
		return $message;
		
	}
	
 }
?>