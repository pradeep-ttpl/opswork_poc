 <?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: login_entity.php
 * @version  	: 1.0
 * @date  		: 08-Jan-2014
 *
 * @description :
 *
 * @author      : Raja Saravanan S R D
 *
 * History of modifications:
 *
 * Author              			Date                  Description of modifications
 * ----------          			-----------          ------------------------------
 * Raja Saravanan S R D        	08-Jan-2014           Initial Version - File Created
 * 
 */
 
class Dashboard_DAO
{		
	public function getVersionDetails()
	{
		global $DBH;
		$result = array();
		$sql = "SELECT rv.version_name,rv.release_date,rvn.note_type,rvn.note 
				FROM `tt_release_versions` rv JOIN `tt_release_version_notes` rvn ON(rv.version_name = rvn.version_name)
				WHERE rv.active = 1 AND rvn.active = 1";
		$prepareSql = $DBH->prepare($sql);
		$prepareSql->execute(array());
		$prepareSql->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $prepareSql->fetch())
		{
			$result[$row['note_type']][] = $row;
		}
		
		return $result;
	}
}
?>
