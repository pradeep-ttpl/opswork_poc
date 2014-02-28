<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : currentyrsuspend_controller.php
 * @version  : 1.0
 * @date  : 18-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila         		 18-Jul-2012           Initial Version - File Created
 * 
 */
class Currentyrsuspend_Controller
{
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
		
		$template = 'currentyrsuspend';
		
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
		
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		
		if(isset($_REQUEST['crntYrSpndid']))
		$crntYrSpndid = $_REQUEST['crntYrSpndid'];
		
		$currentyrsuspendModel 	= new currentyrsuspend_Model;
		$MCrypt	= new MCrypt;
		
		$editcurrentsuspend = '';
		
		if(isset($parsed[2]) && $parsed[2] == 'add')
		{						
			$template = 'addcurrentyrsuspend';			
		}
		else if(isset($reqVars['addcurrentsuspend']))
		{			
			$licenceNo	 = $reqVars['lno'];
			$vin 		 = $reqVars['vin'];
			$logcurrent  = $reqVars['log_current'];
			$agrivehicle = $reqVars['agri_vehicle'];
			$createdBy 	 = $_SESSION['user_id'];
			
			$addNewCurrentsuspendinfoResult = $currentyrsuspendModel->addNewCurrentsuspend($businessId,$licenceNo,$vin,$logcurrent,$agrivehicle,$filingId,$createdBy);
			
			if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$_SESSION['adminStatusMsg'] = $addNewCurrentsuspendinfoResult;
				header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
			}else{
				$_SESSION['addsuspendVehiInfo'] = $addNewCurrentsuspendinfoResult;
				header("location:/currentyrsuspend/");
			}
			exit(0);
		}
		else if((isset($parsed[2]) && $parsed[2]=='edit'|| isset($reqVars['updatecurrentsuspend'])) )
		{
			$template = 'editcurrentyrsuspend';
			
			$crntYrSpndid = decryptID($reqVars['crntYrSpndid']);
			
			$editcurrentsuspend = $currentyrsuspendModel->editCurrentSuspendVehi($crntYrSpndid);
			
			if(isset($reqVars['updatecurrentsuspend']))
			{						
				$crntYrSpndid = decryptID($_POST['crntYrSpndid']);
				
				$licenceNo			= $reqVars['lno'];
				$vin 	 			= $reqVars['vin'];
				$logging 			= $reqVars['log_current'];
				$modifiedBy			= $_SESSION['user_id'];
				$farmingAgriculture = $reqVars['agri_vehicle'];
				
				$updatecurrentsuspendInfo = $currentyrsuspendModel->updatesuspend($businessId,$licenceNo,$crntYrSpndid,$vin,$logging,$farmingAgriculture,$modifiedBy);
				
				if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
					$_SESSION['adminStatusMsg'] = $updatecurrentsuspendInfo;
					header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
				}else{
					$_SESSION['updatecurrentsuspendInfo'] = $updatecurrentsuspendInfo;
					header("location:/currentyrsuspend/?type=edit");
				}
				exit(0);
			}
		}
		
		$taxablevehicleinfoModel 	= new taxablevehicleinfo_Model;
		
		$userVehicles = $taxablevehicleinfoModel->getUserVehicles($userId);
		
		$getCurrentyrsuspendInfo = $currentyrsuspendModel->getCursuspendInfo($userId,$filingId);
		$tpl = new Template_Model($template);	
		$tpl->assign('getcurrentsuspendinfo',$getCurrentyrsuspendInfo);
		$tpl->assign('editcurrentsuspend',$editcurrentsuspend);
		$tpl->assign('userVehicles',$userVehicles);
		
	}
}
?>