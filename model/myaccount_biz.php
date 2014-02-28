<?php 
class Myaccount_Model
{		
	public function __construct()
	{		
		$myaccountDAO = new Myaccount_DAO;
		$this->myaccountDAO = $myaccountDAO;
		$defineArr			= validateData();
		$this->defineArr	= $defineArr;   
		
		$MCrypt	= new MCrypt;
		$this->MCrypt = $MCrypt;
	}
	
	public function updateUserInfo($firstname,$lastname,$phone,$userId)
	{
		global $constantArr;
		
		$updateInfo = $this->myaccountDAO->updateUserInfo($this->MCrypt->encrypt($firstname),$this->MCrypt->encrypt($lastname),
					  $this->MCrypt->encrypt($phone),$userId);
					  
		if($updateInfo=='updated')
		{
			$message = $constantArr['profileSuccessMsg'][$_SESSION['lang']];
		}
		
		return $message;
		
	}
	public function changeNewPassword( $userId,$currentpassword,$newpassword ) //To change password
	{
		global $constantArr;
		
		$errorFlag = '~error';
		$successFlag = '~success';
		$statusUpdate = '';
		
		if($currentpassword == $newpassword)
		{
			$statusUpdate = $constantArr['newPswNotSame'][$_SESSION['lang']].$errorFlag;
		}
		else 
		{	
			$affectedrow = $this->myaccountDAO->changeNewPassword( $userId,$this->MCrypt->encrypt($currentpassword),$this->MCrypt->encrypt($newpassword));		
			if($affectedrow == 'wrongpassword')
			{	
				$statusUpdate = $constantArr['currentPswNotMatching'][$_SESSION['lang']].$errorFlag;
			}
			if($affectedrow == 'success') 
			{	
				$statusUpdate = $this->defineArr['TAX_UPDATE_PWD'][$_SESSION['lang']].$successFlag;
			}
			
		}
		
		return $statusUpdate;
	}
}
?>