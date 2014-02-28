 <?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : register_entity.php
 * @version  : 1.0
 * @date  : 12-Jul-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila                 12-Jul-2012                   Initial Version - File Created
 * 
 */
class Register_DAO
{		
	public function insertUserdetails($firstname,$email,$password,$captcha,$user_type)
	{	
	    global $DBH;

	    $date		= date("Y-m-d H:i:s");

		$insertuser = "INSERT INTO `tt_users` (`first_name`,`email`,`password`,`created_date`,`user_type`,`active`) 
					   VALUES (?,?,?,?,?,?)";
		$prepareInsertauser = $DBH->prepare($insertuser);
		$prepareInsertauser->execute(array($firstname,$email,$password,$date,$user_type,1));											
		$userID = $DBH->lastInsertId();		
		
		return $userID;	
	}
	public function insertFBUserdetails($fb_array)
	{	
	    global $DBH;
		
	    $fb_user_id	= $fb_array['fb_user_id'];
	    $firstname	= $fb_array['first_name'];
	    $lastname 	= $fb_array['last_name'];
	    $email 		= $fb_array['fbemail'];
	    $date		= date("Y-m-d H:i:s");
	    $user_type  = '2'; 
		$insertuser = "INSERT INTO `tt_users` (`first_name`,`last_name`,`email`,`created_date`,`user_type`,`is_facebook_login`,`fb_id`,`active`) 
					   VALUES (?,?,?,?,?,?,?,?)";			
		$prepareInsertauser = $DBH->prepare($insertuser);
		$prepareInsertauser->execute(array($firstname,$lastname,$email,$date,$user_type,'Y',$fb_user_id,'1'));											
		$userID = $DBH->lastInsertId();		
		
		return $userID;	
	}	
	/**
	 * Get the user data based on User email and password
	 */ 	 
	public function userLoginCheck($email,$password)
	{
		global $DBH;
		$sql = "select * from `tt_users` where email=? and password=?  AND `active` =1";
		$getUsernamePassword = $DBH->prepare($sql);
		$getUsernamePassword->execute(array($email,$password));
		$getUsernamePassword->setFetchMode(PDO::FETCH_ASSOC);
		$row = $getUsernamePassword->fetch();
		return $row;
	}
	/**
	 * This method returns the user data based on user email
	 */
	public function getUserDataByEmail($email)
	{
		global $DBH;
		$sql 	= "SELECT * FROM `tt_users` WHERE `email` = ?";
		$rs 	= $DBH->prepare($sql);
		$rs->execute(array($email));
		$rs->setFetchMode(PDO::FETCH_ASSOC);
		$row = $rs->fetch();
		return $row;		
	}
	/**
	 * Update the users successful & failure login datails into database
	 */	
	public function insertLoggingTime($userId,$logintype)
	{
		/*$curDate = date('Y-m-d H:i:s');
		
		$loginData = "`FailureLogin` = '".$curDate."'";		
		if($logintype)
		{
			$loginData = "`LatestSuccessfulLogin`='".$curDate."'";
		}
				
		$sql = "UPDATE `tt_users` SET $loginData WHERE UserId=".$userId;
		mysql_query($sql);*/
	}
	
	/**
	 * This method return the boolean value to check the email in the database.
	 */	
	public function checkUserEmailExist($email)
	{
		global $DBH;
		$emailStatus = false;
		$sql = "SELECT * FROM `tt_users` WHERE email = ?  AND `active` =1";
		$res = $DBH->prepare($sql);
		$res->execute(array($email));
		$count = $res->rowCount();
		
		if($count > 0 )
		{
			$emailStatus = true;
		}
		return $emailStatus;
	}
	/**
	 * Update new password set into tt_users table
	 */	
	public function setNewPassword( $userId,$newpassword )
	{
		global $DBH;
		$sql = "UPDATE tt_users SET password=? WHERE id=?";
		$updatePassword = $DBH->prepare($sql);
		$updatePassword->execute(array($newpassword,$userId));
		$count = $updatePassword->rowCount();
		return $count;
		
	}
	/**
	 * Update the user active status
	 */	
	public function updateUserStatus($userId,$status,$registeredDate)
	{
		global $DBH;	
		$sql 		= "SELECT * FROM `tt_users` WHERE `id` = ? AND active = ?";
		$res = $DBH->prepare($sql);
		$res->execute(array($userId,'1'));	
		$count = $res->rowCount();
		
		if($count == 0)
		{ 	
			if(strtolower($status) == 'a')
			{
				$active = 1;			
			}
			$sql = "UPDATE `tt_users` SET `active`= ? WHERE `id` = ? AND created_date = ?";
			$updateStatus = $DBH->prepare($sql);
			$updateStatus->execute(array($active,$userId,$registeredDate));	
			$count = $updateStatus->rowCount();
			$statusMsg = true;
		}
		else
		{
			$statusMsg = false;
		}

		return $statusMsg;			
	}
	
	public function getUserDetails($user_id)
	{
		global $DBH;
		$row = array();
		$sql = "SELECT * FROM `tt_users` WHERE `id` = ? AND active = ?";
		$rs = $DBH->prepare($sql);
		$rs->execute(array($user_id,1));
		$rs->setFetchMode(PDO::FETCH_ASSOC);
		
		if($rs->rowCount()>0)
		$row = $rs->fetch();
		
		return $row;		
	}
	
	//Selecting privileges based on the role
	public function getUsersAllAccessPrivileges($userId,$roleID)
	{
		global $DBH;
		
		$usersql = "SELECT * FROM t_admin_role_user_privilege WHERE user_id = ?";
		$userpreparesql = $DBH->prepare($usersql);
		$userpreparesql->execute(array($userId));
		if($userpreparesql->rowcount() > 0)
		{
			$sql2 = "SELECT id,menu_name,menu_display_name,publish FROM t_admin_menus 
							 WHERE menu_parent_id = ? AND id IN(
							 SELECT am.`id` FROM `t_admin_menus` am
							 JOIN `t_admin_role_user_privilege` arp ON(arp.`menu_id` = am.id)
							 WHERE arp.role_id = ? AND am.publish = ?) ORDER BY order_id,menu_display_name ASC";
			$preparesql = $DBH->prepare($sql2);
			$preparesql->execute(array(0,$roleID,'Y'));
			$preparesql->setFetchMode(PDO::FETCH_ASSOC);
			$i = 0;
			while($row = $preparesql->fetch())
			{
				$menuArray[$i]['Id'] = $row['id'];
				$menuArray[$i]['menuName'] = $row['menu_name'];
				$menuArray[$i]['menuDisplayName'] = $row['menu_display_name'];
				$menuArray[$i]['Publish'] = $row['publish'];
				
				$i++;	
			}			
		}else{

			$sql2 = "SELECT id,menu_name,menu_display_name,publish FROM t_admin_menus 
								 WHERE menu_parent_id = ? AND id IN(
								 SELECT am.`id` FROM `t_admin_menus` am
								 JOIN `t_admin_role_privilege` arp ON(arp.`menu_id` = am.id)
								 WHERE arp.role_id = ? AND am.publish = ?) ORDER BY order_id,menu_display_name ASC";
			$preparesql = $DBH->prepare($sql2);
			$preparesql->execute(array(0,$roleID,'Y'));
			$preparesql->setFetchMode(PDO::FETCH_ASSOC);
			$i = 0;
			while($row = $preparesql->fetch())
			{
				$menuArray[$i]['Id'] = $row['id'];
				$menuArray[$i]['menuName'] = $row['menu_name'];
				$menuArray[$i]['menuDisplayName'] = $row['menu_display_name'];
				$menuArray[$i]['Publish'] = $row['publish'];
				
				$i++;	
			}			
		}
		return $menuArray;
	}
	
	function insertUserLastLogin($user_id, $ip, $status)
	{
		global $DBH;

		$insert = "INSERT INTO `tt_user_login_log` (`user_id`,`log_time`,`ip_address`,`log_status`) VALUES (?, CURRENT_TIMESTAMP , ?, ?)";
		$prepareInsert = $DBH->prepare($insert);
		$prepareInsert->execute(array($user_id, $ip, $status));
		$result = $DBH->lastInsertId();		
		
		return $result;
	}
}
?>