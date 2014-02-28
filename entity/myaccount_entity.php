<?php 
class Myaccount_DAO
{
	public function __construct()
	{	
			
	}	
	
	public function updateUserInfo($firstname,$lastname,$phone,$userId)
	{
		global $DBH;
		
		$created_date = date('Y-m-d H:i:s');
		
		$sql = "Update `tt_users` set `first_name` = ?,`last_name` = ?,`phone` = ?,`updated_date` = ? WHERE id = ?"; 
		
		$preparesql = $DBH->prepare($sql);
		$preparesql->execute(array($firstname,$lastname,$phone,$created_date,$userId));
		if($preparesql)
		{
			$status = 'updated';
		}
		
		return $status;
			
	}
	public function changeNewPassword( $userId,$currentpassword,$newpassword ) //To change password
	{
		global $DBH;
		$message = '';
		
		$sql = "SELECT * FROM `tt_users` WHERE password = ? AND id=?";
		$res = $DBH->prepare($sql);
		$res->execute(array($currentpassword,$userId));
		$count = $res->rowCount();
	
		if($count == 0 )
		{  
			$message = 'wrongpassword';
		}
		if($count > 0 )
		{  
			$sql = "UPDATE tt_users SET password=? WHERE id=?";
			$updatePassword = $DBH->prepare($sql);
			$updatePassword->execute(array($newpassword,$userId));
			$count1 = $updatePassword->rowCount();
			if($count1 > 0 )
			{  
				$message = 'success';
			}
		}
			
		return $message;
	}
}
?>