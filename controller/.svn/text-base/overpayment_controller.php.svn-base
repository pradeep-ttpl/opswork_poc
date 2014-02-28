<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : overpayment_controller.php
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
class Overpayment_Controller
{
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
	
		
		if(isset($_SESSION['admin_user_id']) && $_SESSION['admin_user_id'] > 0){
			$userId = $_SESSION['admin_user_id'];
		}else{
			$userId = $_SESSION['user_id'];
		}
		
		if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
			$filingId = $_SESSION['admin_filing_id'];
		}else{
			$filingId = $_SESSION['filingId'];
		}

		if(isset($_SESSION['admin_biz_id']) && $_SESSION['admin_biz_id'] > 0){
			$businessId = $_SESSION['admin_biz_id'];
		}else{
			$businessId = $_SESSION['selectedbusiness'];
		}

		
		$template = 'overpayment';
		
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		
		$overpaymentModel = new Overpayment_Model;
		$MCrypt	= new MCrypt;
		
		$addOverpayment = '';
		if(isset($reqVars['addoverpayment']))
		{
			$vin 			= $reqVars['vin'];
			$paymentdate 	= $reqVars['paymentdate'];
		 	$amtclaim 		= $reqVars['amtclaim'];
		 	$explanation	= $reqVars['explanation'];
		 	$createdBy		= $_SESSION['user_id'];
		 	
			$addOverpayment	= $overpaymentModel->addOverpayment($userId,$filingId,$vin,$paymentdate,$amtclaim,$explanation,$createdBy);
			
			if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$_SESSION['adminStatusMsg'] = $addOverpayment;
				header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
			}else{
				$_SESSION['addOverpayment'] = $addOverpayment;
				header("location:/overpayment/");
			}
			exit();
		}
		
		if(isset($parsed[2]) && $parsed[2]=='add')
		{
			$template = 'addoverpayment';
		}
		
		if(isset($parsed[2]) && $parsed[2]=='edit')
		{
			$template = 'editoverpayment';
			
			$overpaymentId = decryptID($_REQUEST['overpaymentId']);
			$editoverpayDet 		= $overpaymentModel->editoverpaymentdet($overpaymentId,$businessId);
		}
		
		if(isset($reqVars['updateoverpayment']))
		{
			$vin 			= $reqVars['vin'];
			$overpaymentId	= decryptID($reqVars['overpaymentId']);
			$paymentdate 	= $reqVars['paymentdate'];
		 	$amtclaim	 	= $reqVars['amtclaim'];
		 	$explanation 	= $reqVars['explanation'];
		 	$modifiedBy		= $_SESSION['user_id'];
		 	
			$overpaymentDetails = $overpaymentModel->updateOverpaymentDet($userId,$filingId,$vin,$overpaymentId,$paymentdate,$amtclaim,$explanation,$modifiedBy);
			
			if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$_SESSION['adminStatusMsg'] = $overpaymentDetails;
				header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
			}else{
				$_SESSION['updateOverpayment'] = $overpaymentDetails;
				header("location:/overpayment/");
			}
			exit();
		}
		
		$getOverpayment = $overpaymentModel->getOverpayment($userId,$filingId);
		
		$tpl = new Template_Model($template);
		$tpl->assign('getOverpayment',$getOverpayment);	
		$tpl->assign('addOverpayment',$addOverpayment);	
		if(isset($editoverpayDet)){
			$tpl->assign('editoverpayDet',$editoverpayDet);
		}	
		
	}
	
}
?>