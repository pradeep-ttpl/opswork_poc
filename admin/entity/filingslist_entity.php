<?php
class filingslist_DAO
{
	public function __construct()
	{	
	
	}

	public function getfilingList($fromDate,$toDate,$userId)
	{
		global $DBH;
		$filingList = array();
	   	$sql = "SELECT tf.id as filingId,tf.user_id,ub.name as BusinessName,tf.form_type,
	   			tf.submission_id,ts.first_name,ts.last_name,tf.date_xml_sent,
	   			tf.payment_status,tf.irs_approved,tf.ack_received,tf.sch1_received 
				FROM `tt_user_business` ub 
				JOIN `tt_filings` tf ON (ub.id = tf.biz_id)
				JOIN `tt_users` ts ON (tf.user_id = ts.id) 
				WHERE ts.id = ? AND tf.active = ? AND ub.active = ?";
	   	
				if($fromDate != '' && $toDate != ''){
		 			$sql .= " AND DATE(tf.modified_date) BETWEEN ? AND ?";
				}
				$sql .= " ORDER BY tf.modified_date DESC ";
				$res = $DBH->prepare($sql);
				
				if($fromDate != '' && $toDate != ''){
					$res->execute(array($userId,'1','1',$fromDate,$toDate));
				}else{
					$res->execute(array($userId,'1','1'));
				}
				
		$res->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $res->fetch())
		{
			$filingList[] = $row;
		}
		return $filingList;
	}
	
	public function getRecentfilingList($fromDate,$toDate)
	{
		global $DBH;
		$filingList = array();
	   	$sql = "SELECT tf.id as filingId,tf.user_id,ub.name as BusinessName,tf.form_type,
	   			tf.submission_id,ts.first_name,ts.last_name,tf.date_xml_sent,
	   			tf.payment_status,tf.irs_approved,tf.ack_received,tf.sch1_received, ifnull(vcount.vcnt,0) as vcnt
				FROM `tt_user_business` ub 
				JOIN `tt_filings` tf ON (ub.id = tf.biz_id)
				JOIN `tt_users` ts ON (tf.user_id = ts.id) 
				left join (select filing_id, count(*) as  vcnt from view_filing_vehicles group by filing_id) vcount 
				on (tf.id=vcount.filing_id) 
				WHERE tf.active = ? AND ub.active = ? AND DATE(tf.modified_date) BETWEEN ? AND ?
				ORDER BY tf.modified_date DESC ";
	   	
		$res = $DBH->prepare($sql);
		$res->execute(array('1','1',$fromDate,$toDate));
		$res->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $res->fetch())
		{
			$filingList[] = $row;
		}
		
		return $filingList;		
	}
	//get SubmissionList
	public function getSubmissionList($fromDate,$toDate)
	{
		global $DBH;
		
		$getSubmissionList = array();
		
		$sql = "Select ttu.first_name,ttu.last_name,ttu.email,ttf.id as filingId,ttf.form_type,ifnull(vcount.vcnt,0) as vcnt,ttf.created_date,
				ttf.date_xml_sent,ttf.irs_approved,ttf.sch1_received,ttf.sch1_path,ttf.xml_submitted,ttf.ack_received,
				ttf.payment_status
				FROM tt_users ttu
				JOIN tt_filings ttf ON (ttu.id = ttf.user_id)
				left join (select filing_id, count(*) as  vcnt from view_filing_vehicles group by filing_id) vcount 
				on (ttf.id=vcount.filing_id) 
				where ttf.user_completed = ? and ttf.active = ? and (ttf.payment_status='success' or ttf.xml_submitted=1)";
		
				if($fromDate != '' && $toDate != ''){
		 			$sql .= " AND DATE(ttf.created_date) BETWEEN ? AND ?";
				}
				
				$sql .= " ORDER BY ttf.created_date DESC ";
				
				$res = $DBH->prepare($sql);
				
				if($fromDate != '' && $toDate != ''){
					$res->execute(array('1','1',$fromDate,$toDate));
				}else{
					$res->execute(array('1','1'));
				}
				
		$res->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $res->fetch())
		{
			$getSubmissionList[] = $row;
		}
		return $getSubmissionList;
		
	}
}
?>