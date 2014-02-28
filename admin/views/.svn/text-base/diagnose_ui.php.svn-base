<?php include 'header.php';
$MCrypt	= new MCrypt;
?>
<script type="text/javascript">
	// fancy box
	$(document).ready(function() {
		$('.fancybox').fancybox();
	});
</script>
<!----------body section starts here--------------->
<div class="pad25px adminBodyMinHeight">
		<?php if((isset($_SESSION['paymentInfo'])) && !empty($_SESSION['paymentInfo'])){?>
				<div class="marTop10px successMsg"><span class="successIcon"></span><?php
				echo $_SESSION['paymentInfo']; unset($_SESSION['paymentInfo']); ?>
				</div>
		<?php } ?>
		<div class="marTop20px">
			<div class="alignleft width375px">
				<div><label class="xsmall"><strong>Filing ID:</strong></label>
					<?=(isset($data['diagnoseList']['0']['filingId'])?($data['diagnoseList']['0']['filingId']):'')?>
				</div>
				<div class="marTop10px"><label class="xsmall"><strong>Business:</strong></label>
					<?=(isset($data['diagnoseList']['0']['name'])?$MCrypt->decrypt($data['diagnoseList']['0']['name']):'')?>
				</div>
			</div>
			<div class="alignleft width375px marLeft20px">
				<div><label class="xsmall"><strong>User:</strong></label>
					<?=(isset($data['diagnoseList']['0']['first_name'])?$MCrypt->decrypt($data['diagnoseList']['0']['first_name']):'')?>
					<?=(isset($data['diagnoseList']['0']['last_name'])?$MCrypt->decrypt($data['diagnoseList']['0']['last_name']):'')?>
				</div>
				<div class="marTop10px"><label class="xsmall"><strong>Form Type:</strong></label>
					<?=(isset($data['diagnoseList']['0']['form_type'])?($data['diagnoseList']['0']['form_type']):'')?>
				</div>
			</div>
			<br clear="all" />
		</div>
		
		<!-- start --To get User Status Details -->
		<div class='marTop20px pageTipContentAreaBg'><h2>User status</h2></div>
		<div class="marTop20px">
			<div class="alignleft width375px">
				<div><label class="small"><strong>User Completed:</strong></label>
					<?php 
						if(($data['diagnoseList']['0']['user_completed']) == '1'){
							echo 'Yes';}
						else { echo '-';}
					?>
				</div>
				<div class="marTop10px"><label class="small"><strong>XML Submission:</strong></label>
					<?php 
						if(($data['diagnoseList']['0']['xml_submitted']) == '1'){
							echo 'Yes';}
						else { echo '-';}
					?>
				</div>
				<div class="marTop10px"><label class="small"><strong>Acknowledgement Received:</strong></label>
					<?php 
						if(($data['diagnoseList']['0']['ack_received']) == '1'){ 
							echo 'Yes';}
						else { echo '-';}
					?>
				</div>
				<div class="marTop10px"><label class="small"></label>&nbsp;</div>
				<div class="marTop10px"><label class="small"><strong>IRS Approved:</strong></label>
					<?php 
						if($data['diagnoseList']['0']['irs_approved'] == 0 && $data['diagnoseList']['0']['ack_received'] == 0){
							echo '<span class="orngTxt"><strong>Pending</span></strong>';
						}elseif($data['diagnoseList']['0']['irs_approved'] == 1 && $data['diagnoseList']['0']['ack_received'] == 1){
							echo '<span class="greenTxt"><strong>Approved</span></strong>';
						}elseif($data['diagnoseList']['0']['irs_approved'] == 0 && $data['diagnoseList']['0']['ack_received'] == 1){
							echo '<span class="redTxt"><strong>Rejected</span></strong>';
						}
					?>
				</div>
			</div>
			<div class="alignleft width375px marLeft20px">
				<div><label class="xsmall"><strong>Date :</strong></label>
					<?php 
						if(strtotime($data['diagnoseList']['0']['date_user_submitted'])){
							echo date("Y-m-d H:i:s",strtotime($data['diagnoseList']['0']['date_user_submitted']));}
						else{ echo '-';}
					?>
				</div>
				
				<div class="marTop10px"><label class="xsmall"><strong>Date:</strong></label>
					<?php 
							if(strtotime($data['diagnoseList']['0']['date_xml_sent'])){
							echo date("Y-m-d H:i:s",strtotime($data['diagnoseList']['0']['date_xml_sent']));}
						else{ echo '-';}
					?>
				</div>
				
				<div class="marTop10px"><label class="xsmall"><strong>Date:</strong></label>
					<?php 
							if(strtotime($data['diagnoseList']['0']['date_acknowledged'])){
							echo date("Y-m-d H:i:s",strtotime($data['diagnoseList']['0']['date_acknowledged']));}
						else{ echo '-';}
					?>
				</div>
				
				<div class="marTop10px"><label class="xsmall"><strong>Last Date Attempt :</strong></label>
					<?php 
					if(strtotime($data['diagnoseList']['0']['date_last_ack_attempt'])){
						echo date("Y-m-d H:i:s",strtotime($data['diagnoseList']['0']['date_last_ack_attempt']));}
					else{ echo '-';}
				?>
				</div>
				
				<div class="marTop10px"><label class="xsmall"><strong>Scheduled Received:</strong></label>
					<?php 
						if(($data['diagnoseList']['0']['sch1_received']) == '1')
						{
							echo '<span class="greenTxt"><strong>Received</span></strong>';
						}
						else 
						{
							echo '-';
						}
					?>
				</div>
			</div>
			<br clear="all" />
		</div>
		<!-- ends --To get User Status Details -->
		<table cellpadding="0" border="0" cellspacing="0" width="100%" class="leftBdr topBdr marTop20px tableList">
			<tr class="evenrowBlue">
				<td colspan="5"><strong>Payment Log</strong> </td>
			</tr>
			<tr>
				<th width="15%">Date</th>
				<th width="15%">Invoice no</th>
				<th width="20%">Transaction ID</th>
				<th width="15%">Payment Gateway</th>
				<th width="15%">Status</th>
			</tr>
			<?php 
			if(count($data['diagnoseList']) > 0){
			$found = false;
			foreach($data['diagnoseList'] as $values) { ?>
			<tr>
				<td><?php 
					if(strtotime($values['modified_date'])){
						echo date("Y-m-d H:i",strtotime($values['modified_date']));
					}else{ echo '-';}?>
				</td> 
				<td><?php if(strlen($values['voucher_no'])>0) {echo $values['voucher_no'];}else{echo '-';}?></td>
				<td><?php if(strlen($values['transaction_id'])>0) {echo $values['transaction_id'];}else{echo '-';}?></td>
				<td><?php if(strlen($values['payment_gateway'])>0) {echo $values['payment_gateway'];}else{echo '-';}?></td>
				<td><?php 
					echo $values['payment_status'];
					if($values['payment_status']=='success')
					{
					  $found = true;
					} 
				}	 
					if($found == false){?>
					  <a href="/admin/diagnose/add/?filingId=<?php echo $data['diagnoseList']['0']['filingId']?>&userId=<?php echo $data['diagnoseList']['0']['user_id']?>" alt="Edit Payment Status" title="Edit Payment Status" class="fancybox fancybox.ajax blueTxt">(Edit)</a>
					  <?php 
					}
					?>
				</td>
			</tr>
			<?php } else {
				echo '<tr><td colspan="5"><div align="center" class="pad25px redTxt">No Records found</div></td></tr>';
			}?>
		</table>
		<table cellpadding="0" border="0" cellspacing="0" width="100%" class="leftBdr topBdr marTop20px tableList">
			<tr class="evenrowBlue">
				<td colspan="5"><strong>Submission Log</strong> </td>
			</tr>
			<tr>
				<th width="15%">Date</th>
				<th width="15%">Submission ID</th>
				<th width="20%">Acknowledgment Status</th>
				<th width="20%">Error Type</th>
				<th width="50%">Error Detail</th>							
			</tr>
			<?php 
			if(count($data['submissionList']) > 0)
			{
				foreach($data['submissionList'] as $value) 
				{?>
					<tr valign="top">
						<td><?php echo date("Y/m/d H:i",strtotime($value['date_submit_call']));?></td>
						<td><?php if(strlen($value['submission_id'])>0) {echo $value['submission_id'];}else{echo '-';}?></td>
						<td><?php echo $value['ack_status']; ?></td>
						<td><?php if(strlen($value['error_type'])>0) {echo $value['error_type'];}else{echo '-';}?></td>
						<td>
							<?php 
							if(strlen($value['error_description'])>0) 
							{
								$errorList = getIrsErrorsDetails($value['error_description']);
								echo $errorList;
							}
							else
							{
								echo '-';
							}?>
						</td>
					<?php } ?>
					</tr>
			<?php } else {
				echo '<tr><td colspan="5"><div align="center" class="pad25px redTxt">No Records found</div></td></tr>';
			}?>
		</table>
</div>
<?php include 'footer.php'; ?>