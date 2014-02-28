<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : prioryrsuspend.php
 * @version  : 1.0
 * @date  : 20-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila         		 20-Jul-2012           Initial Version - File Created
 * 
 */
class Prioryrsuspend_Controller
{	
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
		
		
		$template = 'prioryrsuspend';
		$userId = $_SESSION['user_id'];
		$filingId = $_SESSION['filingId'];
		
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
        
        $taxablevehicleinfoModel 	= new taxablevehicleinfo_Model;
		$userVehicles = $taxablevehicleinfoModel->getUserVehicles($userId);
        
		$prioryrModel 	= new prioryrsuspend_Model;
		$MCrypt	= new MCrypt;
		
		$addPriorYrSuspend = '';
		$ResulteditsuspendvehiDet = '';
		
		if (isset($parsed[2]) && $parsed[2] == 'add')
		{
			$template = 'addprioryrsuspend';
		}
		
		if(isset($reqVars['AddPriorYrSusVehi']))
		{
			$licenceNo		= $reqVars['lno'];
			$vin 			= $reqVars['vin'];
			
			$soldTransTo = '';
			if(isset($_REQUEST['soldTransfrdTo'])){
				$soldTransTo 	= $reqVars['soldTransfrdTo'];
			}
			
			$transSold_date = '';
			if(isset($_REQUEST['transferSold_date'])){
				$transSold_date = $reqVars['transferSold_date'];
			}
			
			$createdBy 		= $_SESSION['user_id'];
			
			if($reqVars['report_type'] == "mileage")
			{
				$exceededMileage = "Y";
				$priorSoldorTrans = "N";
			}
			if($reqVars['report_type'] == "sold")
			{
				$exceededMileage = "N";
				$priorSoldorTrans = "Y";		
			}
			
			$addPriorYrSuspend = $prioryrModel->addPriorYrSuspend($businessId,$licenceNo,$vin,$exceededMileage,$priorSoldorTrans,$soldTransTo,$transSold_date,$filingId,$createdBy);
			
			if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
				$_SESSION['adminStatusMsg'] = $addPriorYrSuspend;
				header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
			}else{
				$_SESSION['addPriorYr'] = $addPriorYrSuspend;
				header('location:/prioryrsuspend/');
			}
			exit(0);
		}
		
		$getPriorYrSuspend = $prioryrModel->getPriorYrSusinfo($userId,$filingId);
		
		if((isset($parsed[2]) && $parsed[2]=='edit'|| isset($reqVars['updatePriorYrSuspend']) ))
		{
			$template = 'editprioryrsuspend';
			
			$preYrSpndId = decryptID($reqVars['preYrSpndId']);
			
			$ResulteditsuspendvehiDet = $prioryrModel->getprioryrsuspendvehiDet($preYrSpndId);
			
			if(isset($reqVars['updatePriorYrSuspend']))
			{
				$preYrSpndId = decryptID($_POST['preYrSpndId']);
				
				$licenceNo			= $reqVars['lno'];
				$vin 			= $reqVars['vin'];
				
				$soldTrans = '';
				if(isset($_REQUEST['soldTransfrdTo'])){
					$soldTrans 	= $reqVars['soldTransfrdTo'];
				}
				
				$transSold_date = '';
				if(isset($_REQUEST['transferSold_date'])){
					$transSold_date = $reqVars['transferSold_date'];
				}
				
				$modifiedBy		= $_SESSION['user_id'];
				
				if($reqVars['report_type'] == "mileage")
				{
					$exceededMileage = "Y";
					$priorYrSoldTrans = "N";
				}
				if($reqVars['report_type'] == "sold")
				{
					$exceededMileage = "N";
					$priorYrSoldTrans = "Y";		
				}

				$updateprioryrsuspend = $prioryrModel->updatePriorYrSusVehi($businessId, $licenceNo,$vin,$soldTrans,$transSold_date,$exceededMileage,$priorYrSoldTrans,$preYrSpndId,$modifiedBy);
				
				if(isset($_SESSION['admin_filing_id']) && $_SESSION['admin_filing_id'] > 0){
					$_SESSION['adminStatusMsg'] = $updateprioryrsuspend;
					header("location:/filingsummary/".$MCrypt->encrypt($_SESSION['admin_filing_id']));
				}else{
					$_SESSION['updateStatus'] = $updateprioryrsuspend;
					header("location:/prioryrsuspend/?type=edit");
				}
				exit(0);
			}
		}
		
		$tpl = new Template_Model($template);	
		$tpl->assign('getPriorYrDetails',$getPriorYrSuspend);
		$tpl->assign('editPriorYrDetails',$ResulteditsuspendvehiDet);
		$tpl->assign('userVehicles',$userVehicles);
	}
}
?>