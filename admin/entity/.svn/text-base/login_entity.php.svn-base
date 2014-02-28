 <?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: login_entity.php
 * @version  	: 1.0
 * @date  		: 12-Dec-2013
 *
 * @description :
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        12-Dec-2013           Initial Version - File Created
 * 
 */
 
class Login_DAO
{		
	/**
	 * Get the user data based on User email and password
	 */ 	 
	public function userLoginCheck($email,$password)
	{
		global $DBH;
		
		$sql = "SELECT u.*,d.department_name,r.role_name FROM 
				`tt_users` AS u 
				JOIN 
				`t_admin_departments` AS d ON (u.user_department_id = d.id) 
				JOIN 
				`t_admin_roles` AS r ON (u.user_role_id = r.id) 
				WHERE u.email=? AND u.password=? AND u.active = ? AND user_type != ? AND d.publish = ? AND r.publish = ? ";
		$getUsernamePassword = $DBH->prepare($sql);
		$getUsernamePassword->execute(array($email,$password,1,2,'Y','Y'));
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
}
?>