<?php
class Refiling_DAO
{
	public function __construct()
	{	
	
	}

	public function getfilingList($filingId,$ein,$bizName,$taxForm,$taxyear,$taxmonth)
	{
		global $DBH;
		$filingList = array();
	   	$sql = "SELECT tf.id as filingId,tf.user_id,ub.name as BusinessName,tf.form_type,
	   			tf.submission_id,ts.first_name,ts.last_name,tf.date_xml_sent,
	   			tf.payment_status
				FROM `tt_user_business` ub 
				JOIN `tt_filings` tf ON (ub.id = tf.biz_id)
				JOIN `tt_users` ts ON (tf.user_id = ts.id) 
				JOIN `tt_tax_year` ty ON (tf.filing_year = ty.tax_year) 
				WHERE tf.id = ? AND tf.active = ? AND ub.active = ? 
				AND ub.ein = ? AND ub.name = ? AND tf.form_type = ? AND ty.id = ? AND tf.filing_month = ?   
				ORDER BY tf.id DESC";
	   	
		$res = $DBH->prepare($sql);
		$res->execute(array($filingId,'1','1',$ein,$bizName,$taxForm,$taxyear,$taxmonth));
		$res->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $res->fetch())
		{
			$filingList[] = $row;
		}
		return $filingList;
	}
}
?>