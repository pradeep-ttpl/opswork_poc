<?php 
include 'header.php';
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
			<input type="text" readonly id="fromDate" name="fromDate" class="txtBox100px marRight10px" value="<?php echo $data['fromdate'];?>"/>&nbsp;
			<input type="text" readonly id="toDate" name="toDate" class="txtBox100px marRight10px" value="<?php echo $data['todate'];?>"/>&nbsp;
			<input type="submit" value="Search" name='search' class="blueButn60px marLeft10px"/>
		</div>
	</form>
	<table class="tablesorter" cellpadding="0" border="0" cellspacing="0">
		<thead>
			<tr>
				<th class="filter-select">Filing ID</th>
				<th>User</th>
				<th>Business</th>
				<th class="filter-select">Form Type</th>
				<th class="filter-select">Vehicle Count</th>
				<th class="filter-select">Payment Status</th>
				<th class="filter-select">IRS Status</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if(count($data['filinglist'])>0){
				for($i=0; $i<count($data['filinglist']); $i++)
				{
				?>
				<tr>
					<td><?=$data['filinglist'][$i]['filingId']?></td>
					<td><?=$MCrypt->decrypt($data['filinglist'][$i]['first_name']).' '.$MCrypt->decrypt($data['filinglist'][$i]['last_name'])?></td>
					<td><?php echo $MCrypt->decrypt($data['filinglist'][$i]['BusinessName'])?></td>
					<td><?=$data['filinglist'][$i]['form_type']?></td>
					<td><?=$data['filinglist'][$i]['vcnt']?></td>
					<td>
						<?php  echo $data['filinglist'][$i]['payment_status'];?>
					</td>
					<td>
						<?php  
							if($data['filinglist'][$i]['irs_approved'] == 0 && $data['filinglist'][$i]['ack_received'] == 0){
								echo '-';
							}elseif($data['filinglist'][$i]['irs_approved'] == 1 && $data['filinglist'][$i]['ack_received'] == 1){
								echo '<b>Approved</b>';
							}elseif($data['filinglist'][$i]['irs_approved'] == 0 && $data['filinglist'][$i]['ack_received'] == 1){
								echo '<b>Rejected</b>';
							}
						?>
					</td>
				</tr>
				<?php 
					}
				}?>
		</tbody>
	</table>
<?php include 'footer.php'; ?>