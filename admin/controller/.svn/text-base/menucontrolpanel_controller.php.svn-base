<?php
 /*************************************************************************************************************************
 *      Author		: Raja Saravanan. S.R.D.
 * 		Language 	: PHP 5.5
 * 		Project 	: Simple Truck Tax
 *  	Version		: 1
 *      File		: menucontrolpanel_controller.php
 *      Copyright (c) 2012- 2013
 *      
 **************************************************************************************************************************
 *  VERSION HISTORY:
 * 
 *      v1 [21.03.2013] - Initial Version
 *
 **************************************************************************************************************************
 */
	class Menucontrolpanel_Controller
	{
		public $template = 'menucontrolpanel';
		public function main( $reqVars )
		{
			$status = '';
			$menuControlpanelModel = new Menucontrolpanel_Model;
			
			$orderId = $menuControlpanelModel->getOrderId();
			$orderId = $orderId + 1;
			
			$request = $_SERVER['REQUEST_URI']; 
			$parsed = explode('/', $request);
			$levelCount = 0;

			if ( isset( $reqVars['addCategory'] ) )
			{				
				$catMsg = $menuControlpanelModel->addNewmenu( $reqVars );
				$_SESSION['status'] = 'Menu successfully added';
				header('location:/admin/menucontrolpanel');
			}	
			
			$tpl = new Template_Model($this->template);
			$tpl->assign('status',$status);
			$tpl->assign('levelCount',$levelCount);
			$tpl->assign('orderId',$orderId);
		}
	}
?>
