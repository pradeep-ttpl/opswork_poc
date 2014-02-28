<?php include 'header.php';
global $constantArr;
$totalCollectedAmount = '0';
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
<!----------body section starts here--------------->
<form action="" method="post" enctype="multipart/form-data" name="" id="">
	<!--Filing History page content-->
	<div class="marTop20px alignleft">
		Date:
		<input type="text" readonly id="fromDate" name="fromDate" class="txtBox100px marRight10px" value="<?php if(isset($_REQUEST['fromDate'])) echo $_REQUEST['fromDate'];?>"/>&nbsp;
		<input type="text" readonly id="toDate" name="toDate" class="txtBox100px marRight10px" value="<?php if(isset($_REQUEST['toDate'])) echo $_REQUEST['toDate'];?>"/>&nbsp;
		
		<input type="submit" value="Search" name='search' class="blueButn60px marLeft10px"/>
	</div>
	<div class="marTop30px alignright">
		<div class="padTop7px alignleft"><?=$constantArr['totalCollected'][$_SESSION['lang']]?>:</div> 
		<div id='totalCollectedAmount' class='alignright marLeft10px padTop5px orngTxt'></div>
	</div>
	<br clear="all"/>
</form>	
<table class="tablesorter" cellpadding="0" border="0" cellspacing="0">
	<thead>
		<tr>
			<th class="filter-false"><?=$constantArr['dateOfPayment'][$_SESSION['lang']]?></th>
			<th class="filter-select"><?=$constantArr['transaction_id'][$_SESSION['lang']]?></th>
			<th class="filter-select"><?=$constantArr['voucherNo'][$_SESSION['lang']]?></th>
			<th><?=$constantArr['paymentGateway'][$_SESSION['lang']]?></th>
			<th><?=$constantArr['amount'][$_SESSION['lang']]?> ($)</th>
			<th class="filter-select"><?=$constantArr['paymentStatus'][$_SESSION['lang']]?></th>								
		</tr>
	</thead>
	<tbody>
	<?php foreach($data['paymenthistoryList'] as $values) { ?>
		<tr>
			<td>
				<?php 
					 if(strtotime($values['modified_date'])){
					  	echo date("Y/m/d",strtotime($values['modified_date'])); 
					  }else{ echo '-';}
				?>
			</td>
			<td><?php if(strlen($values['transaction_id'])>0) { echo $values['transaction_id'];}else{echo '-';}?></td> 
			<td><?php if(strlen($values['voucher_no'])>0) { echo $values['voucher_no'];}else{echo '-';}?></td> 
			<td><?php if(strlen($values['payment_gateway'])>0){ echo $values['payment_gateway'];} else { echo '-';}?></td>
			<td align="right"><?=$values['amount']?></td>
			<td><?=$values['payment_status']?></td>
		</tr>
	<?php 
	$totalCollectedAmount += $values['amount'];
	} ?>
	</tbody>
</table>
	<script type="text/javascript">
		document.getElementById('totalCollectedAmount').innerHTML = '<h2 class="alignright marLeft10px orngTxt">$<?php echo number_format($totalCollectedAmount,2);?></h2>';
	</script>
<?php include 'footer.php'; ?>
