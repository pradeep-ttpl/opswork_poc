<?php include 'header.php';
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
	<!--Filing History page content-->
	<form action="" method="post" enctype="multipart/form-data" name="" id="">
		<div class="marTop20px">
			Date: &nbsp;
			<input type="text" readonly id="fromDate" name="fromDate" class="txtBox100px marRight10px" value="<?php if(isset($_REQUEST['fromDate'])) echo $_REQUEST['fromDate'];?>"/>&nbsp;
			<input type="text" readonly id="toDate" name="toDate" class="txtBox100px marRight10px" value="<?php if(isset($_REQUEST['toDate'])) echo $_REQUEST['toDate'];?>"/>&nbsp;
			<input type="submit" value="Search" name='search' class="blueButn60px marLeft10px"/>
		</div>
	</form>
	<table class="tablesorter" cellpadding="0" border="0" cellspacing="0">
		<thead>
			<tr>
				<th class="filter-false">Date of Sub.</th>
				<th class="filter-select">Filing ID</th>
				<th>User</th>
				<th>Business</th>
				<th class="filter-select">Form Type</th>
				<th>Submission ID</th>
				<th class="filter-select">Payment Status</th>
				<th class="filter-select">IRS Status</th>
				<th class="filter-select">Ack. Status</th>
				<th class="filter-select">Schedule Status</th>
				<th class="filter-false">&nbsp;</th>
				<th class="filter-false">&nbsp;</th>
				<?php if($_SESSION['user_id'] == 1){ ?><th class="filter-false">&nbsp;</th><?php }?>
			</tr>
		</thead>
		<tbody>
			<?php 
			if(count($data['filingList'])>0){
				for($i=0; $i<count($data['filingList']); $i++)
				{
				?>
				<tr>
					<td>
					<?php if(strtotime($data['filingList'][$i]['date_xml_sent'])){
							echo date("Y/m/d",strtotime($data['filingList'][$i]['date_xml_sent']));
						}else{ echo '-';}?>
					</td> 
					<td><?=$data['filingList'][$i]['filingId']?></td>
					<td><?=$MCrypt->decrypt($data['filingList'][$i]['first_name']).' '.$MCrypt->decrypt($data['filingList'][$i]['last_name'])?></td>
					<td><?php echo $MCrypt->decrypt($data['filingList'][$i]['BusinessName'])?></td>
					<td><?=$data['filingList'][$i]['form_type']?></td>
					<td>
							<?php
							if(strlen($data['filingList'][$i]['submission_id'])>0){
								 echo $data['filingList'][$i]['submission_id'];
							} else { echo '-'; }
							?>
					</td>  
					<td>
						<?php  echo $data['filingList'][$i]['payment_status'];?>
					</td>
					<td>
						<?php  
							if($data['filingList'][$i]['irs_approved'] == 0 && $data['filingList'][$i]['ack_received'] == 0){
								echo 'Pending';
							}elseif($data['filingList'][$i]['irs_approved'] == 1 && $data['filingList'][$i]['ack_received'] == 1){
								echo '<b>Approved</b>';
							}elseif($data['filingList'][$i]['irs_approved'] == 0 && $data['filingList'][$i]['ack_received'] == 1){
								echo '<b>Rejected</b>';
							}
						?>
					</td>
					<td>
						<?php  echo ($data['filingList'][$i]['ack_received'] == 0)? 'Pending':'<b>Received</b>';?>
					</td>
					<td>
						<?php  echo ($data['filingList'][$i]['sch1_received'] == 0)? 'Pending':'<b>Received</b>';?>
					</td>
					<td><a href="/admin/diagnose/?filingId=<?php echo $data['filingList'][$i]['filingId']?>" alt="Diagnose" title="Diagnose" class="orngTxt">View&nbsp;Log</a></td>
					<td><a href="/admin/refiling/<?php echo $MCrypt->encrypt($data['filingList'][$i]['filingId']);?>" alt="Resubmitting Filing" title="Resubmitting Filing" class="orngTxt">Resubmit</a></td>
					<?php
						if($_SESSION['user_id'] == 1){ 
							if($data['filingList'][$i]['sch1_received'] != 0)
							{ 
								echo '<td>&nbsp;</td>'; } else{
					?>
								<td><a href="#" onClick="javascript:window.open('/filingsummary/<?php echo $MCrypt->encrypt($data['filingList'][$i]['filingId']);?>','Resubmitting Filing','menubar=no,fullscreen=yes,toolbar=no,scrollbars=1')" alt="Resubmit" title="Resubmit" class="blueTxt">View Forms</a></td>
					<?php 
							}
						}
					?>
				</tr>
				<?php 
					}
				}?>
		</tbody>
	</table>
<?php include 'footer.php'; ?>