<?php
class Myaccount_Controller
{	
	public function main( array $reqVars )
	{
		if(!isset($_SESSION['user_id']))
		{
			header('Location: /login/');
			exit();
		}
		
		$template 		    = 'myaccount';
		
		$myaccountModel 	= new Myaccount_Model;
		$registerModel 		= new Register_Model;
		
		$request = $_SERVER['REQUEST_URI'];
		$parsed = explode('/', $request);
		
		$userId = $_SESSION['user_id'];
		
		$newpassword 	 	= '';
	    $confirmpassword 	= '';	
		
	    //To change profile password
		if(isset($parsed[2]) && $parsed[2] =='profilechangepassword')
		{
			$template = 'profilechangepassword';
		
			if((int)$userId > 0)
			{
				$currentpassword 	= (isset($reqVars['currentPwd']) ? $reqVars['currentPwd'] : '');
				$newpassword 	 	= (isset($reqVars['pwd']) ? $reqVars['pwd'] : '');
				$confirmpassword 	= (isset($reqVars['cpwd']) ? $reqVars['cpwd'] : '');
				
				if($newpassword != '')
				{
					$status 		= $myaccountModel->changeNewPassword($userId,$currentpassword,$newpassword);
					
					$_SESSION['message'] = $status;
					header("location:/myaccount/profilechangepassword/");
					exit(0);
				}
			}
			
		}
		if(isset($reqVars['myaccount'])) //To edit profile
		{
			$firstname = $reqVars['firstname'];
		    $lastname  = $reqVars['lastname'];
		    $phone     = $reqVars['phone'];
		    
		    $userInfo = $myaccountModel->updateUserInfo($firstname,$lastname,$phone,$userId);
		    $_SESSION['status'] = $userInfo;
			header("location:/myaccount/");
			exit(0);
					
		}
		
		$tpl = new Template_Model($template);	

	}		
}
?>