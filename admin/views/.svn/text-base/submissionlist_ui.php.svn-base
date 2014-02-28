<?php
/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: submissionlist_ui.php
 * @version  	: 1.0
 * @date  		: 25-Feb-2014
 *
 * @description : submissionList controller file
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila       			 25-Feb-2014           Initial Version - File Created
 * 
 */
require_once( TT_ADMIN_VIEW_PATH . '/header.php' );
$submissionList = $data['submissionList'];
$MCrypt	= new MCrypt;
?>
<script>
$(function() {
	$( "#fromDate,#toDate" ).datepicker({
		showOn: "button",
		changeMonth: true,
		changeYear: true,
		buttonImage: "/js/datepicker/calendar.png",
		buttonImageOnly: true,
		dateFormat: "yy-mm-dd"
	});
});
</script>
<script id="js">
	$(function() {	
		$("table").tablesorter({
			theme: 'blue',
			widthFixed : true,
			widgets: [ 'blue', 'zebra', 'stickyHeaders', 'filter' ],
			widgetOptions : {
				filter_cssFilter   : 'tablesorter-filter',
				filter_childRows   : false,
				filter_hideFilters : false,
				filter_ignoreCase  : true,
				filter_reset : '.reset',
				filter_searchDelay : 300,
				filter_startsWith  : false,
				filter_hideFilters : false,
				filter_functions : {
					1 : function(e, n, f, i) {
						return e === f;
					},
				}
			}
		})
	});
</script>
<div class="marTop20px">
<div>
	<form action="" method="post" enctype="multipart/form-data" name="" id="">
		<div class="marTop20px">
			Created Date: &nbsp;
			<input type="text" readonly id="fromDate" name="fromDate" class="txtBox100px marRight10px" value="<?php if(isset($_REQUEST['fromDate'])) echo $_REQUEST['fromDate'];?>"/>&nbsp;
			<input type="text" readonly id="toDate" name="toDate" class="txtBox100px marRight10px" value="<?php if(isset($_REQUEST['toDate'])) echo $_REQUEST['toDate'];?>"/>&nbsp;
			<input type="submit" value="Search" name='search' class="blueButn60px marLeft10px"/>
		</div>
	</form>
	<table class="tablesorter" cellpadding="0" border="0" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th class="filter-false">First Name</th>
				<th class="filter-select">Last Name</th>
				<th class="filter-select">Email</th>
				<th class="filter-select">Filing Id</th>
				<th class="filter-select">Form Type</th>
				<th class="filter-select">Vehicle Count</th>
				<th class="filter-select">Created Date</th>
				<th class="filter-select">XML Submitted</th>
				<th class="filter-select">IRS Approved</th>
				<th class="filter-select">Schedule Received</th>
				<th class="filter-select">Schedule Path</th>
				<th class="filter-select">Payment Status</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($submissionList as $key => $value){ ?>
			<tr>		
				<td><?php echo ($value['first_name']!='')?$MCrypt->decrypt($value['first_name']):'-';?></td>
				<td><?php echo ($value['last_name']!='')?$MCrypt->decrypt($value['last_name']):'-';?></td>
				<td>
					<?php 
					if(strlen($value['email']) > 60)
					{ 
						$email = $MCrypt->decrypt($value['email']);?>
						<a class="blueTxt" title="<?php echo $MCrypt->decrypt($value['email'])?>" alt="<?php echo $MCrypt->decrypt($value['email']);?>" href="/"><?php echo substr($email,0,10).'...';?></a>
					<?php } else { ?>
						<a class="blueTxt" title="<?php echo $MCrypt->decrypt($value['email'])?>" alt="<?php echo $MCrypt->decrypt($value['email']);?>" href="/"><?php echo $MCrypt->decrypt($value['email']);?></a>
						<?php 	
					 }?>
				</td>
				<td><?php echo $value['filingId'];?></td>
				<td><?php echo $value['form_type'];?></td>
				<td><?php echo $value['vcnt'];?></td>
				<td>
					<?php 
						if(strtotime($value['created_date'])){
							echo date("Y-m-d H:i:s",strtotime($value['created_date']));}
						else{ echo '-';}
					?>
				</td>
				<td>
					<?php 
						if(($value['xml_submitted']) == '1'){
							echo 'Yes';}
						else { echo 'no';}
					?>
				</td>
				<td>
					<?php 
						if($value['irs_approved'] == 0 && $value['ack_received'] == 0){
							echo '<span class="orngTxt"><strong>Pending</span></strong>';
						}elseif($value['irs_approved'] == 1 && $value['ack_received'] == 1){
							echo '<span class="greenTxt"><strong>Approved</span></strong>';
						}elseif($value['irs_approved'] == 0 && $value['ack_received'] == 1){
							echo '<span class="redTxt"><strong>Rejected</span></strong>';
						}
					?>	
				</td>
				<td>
					<?php 
						if(($value['sch1_received']) == '1'){
							echo 'Yes';}
						else { echo 'No';}
					?>
				</td>
				<td>
					<?php 
					if(strlen($value['sch1_path']) > 20)
					{ ?>
						<a class="blueTxt" title="<?php echo $value['sch1_path']?>" alt="<?php echo $value['sch1_path'];?>" href="/"><?php echo substr($value['sch1_path'],0,10).'...';?></a>
					<?php } else { ?>
						<a class="blueTxt" title="<?php echo$value['sch1_path']?>" alt="<?php echo $value['sch1_path'];?>" href="/"><?php echo $value['sch1_path'];?></a>
						<?php 	
					 }?>
				<td>
					<?php 
					if($value['payment_status'] == 'success'){
						echo '<span class="greenTxt"><strong>Success</span></strong>';
					}elseif($value['payment_status'] == 'failed'){
						echo '<span class="redTxt"><strong>Failed</span></strong>';
					}elseif($value['payment_status'] == 'pending'){
						echo '<span class="orngTxt"><strong>Pending</span></strong>';
					}?>
					</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
</div>
<?php include_once 'footer.php';?>