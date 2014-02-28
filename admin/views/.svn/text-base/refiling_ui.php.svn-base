<?php 
include 'header.php';
// Intializing MCrypt class
$MCrypt	= new MCrypt;
?>
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
<?php if(!isset($_REQUEST['search'])){?>
	<form action="" method="post" enctype="multipart/form-data" name="" id="">
		<div class="marTop20px">
			<p class="marTop0px">
				<label class="small">Ein:</label>
				<input type="text" class="txtBox200px" name="ein" id="ein" onkeypress="return autoMask(this,event, '##-#######')" value="<?php echo $data['reqVars']['ein'];?>"/>
			</p>
			<p class="marTop20px">
				<label class="small">Business Name:</label>
				<input type="text" class="txtBox200px" name="bizName" id="bizName" value="<?php echo $data['reqVars']['bizName'];?>"/>
			</p>
			<p class="marTop20px">
				<label class="small">Form Type:</label>
				<select class="txtBox320px" name="taxForm" id="taxForm" onchange="selectedForm(this.value)">
					<option value="0"> - Select Form Type - </option>
					<?php
						foreach($data['taxForms'] AS $values)
						{
							echo '<option value="'.$values['type'].'"';
							
							if($data['reqVars']['taxForm'] == $values['type'])
							{
								echo ' selected="selected"';
							}
							
							echo '>'.$values['desc'].'</option>';
						}
					?>
				</select>&nbsp;&nbsp;
			</p>
			<p>
				<label class="small">Filing Year:</label>
				<select class="txtBox150px" name="taxyear" id="taxyear" onchange="calculateMonth()">
					<option value="0"> - Select Year - </option>
					<?php
						foreach($data['taxFilingYear'] AS $values)
						{
							echo '<option value="'.$values['id'].'"';
							
							if($data['reqVars']['taxyear'] == $values['id'])
							{
								echo ' selected="selected"';
							}
							
							echo '>'.$values['display_year'].'</option>';
						}
					?>
				</select>
			</p>
			<p>
				<label class="small">Filing Month:</label>
				<span id="month_select_area">
					<select class="txtBox150px" name="taxmonth" id="taxmonth">
						<option value="0"><?php echo $constantArr['SelectMonthlbl'][$_SESSION['lang']];?></option>
					</select>
				</span>
			</p>
			<p class="marTop10px">
				<label class="small">&nbsp;</label>
				<span class="redTxt" id="errorMsg"><?php echo $data['status'];?></span><br/>
			
				<label class="small">&nbsp;</label>
				<input type="submit" value="Search" name='search' class="blueButn60px marTop5px" onClick="javascript: return validateRefilingForm();"/>
				<input type="reset" value="Reset" name='reset' class="blueButn60px marTop5px"/>
			</p>
			
		</div>
	</form>
	<?php 
	} 
	if(count($data['filingList'])>0){ ?>
	<div class="marTop20px" align="right"><a href="/admin/refiling" class="blueTxt">Back To Search</a></div>
	<table class="tablesorter" cellpadding="0" border="0" cellspacing="0">
		<thead>
			<tr>
				<th class="filter-false">Date of Sub.</th>
				<th class="filter-select">Filing ID</th>
				<th>Submission ID</th>
				<th class="filter-select">Payment Status</th>
				<th class="filter-false">&nbsp;</th>
				<th class="filter-false">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php 
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
				<td><a href="javascript:void(0);" onClick="javascript:window.open('/admin/viewxml/<?php echo $MCrypt->encrypt($data['filingList'][$i]['filingId']);?>','_blank','Resubmitting Filing','menubar=no,fullscreen=yes,toolbar=no,scrollbars=1')" alt="Resubmit" title="Resubmit" class="orngTxt">View&nbsp;XML</a></td>
				<td><a href="javascript:void(0);" onClick="javascript:window.open('/admin/filingsummary/<?php echo $MCrypt->encrypt($data['filingList'][$i]['filingId']);?>','_blank','Resubmitting Filing','menubar=no,fullscreen=yes,toolbar=no,scrollbars=1')" alt="Resubmit" title="Resubmit" class="blueTxt">View&nbsp;PDF</a></td>
			</tr>
			<?php 
				}
			?>
		</tbody>
	</table>
	<!--<table class="tablesorter" cellpadding="0" border="0" cellspacing="0">
		<thead>
			<tr>
				<th class="filter-false">Date of Sub.</th>
				<th class="filter-select">Filing ID</th>
				<th>User</th>
				<th>Business</th>
				<th class="filter-select">Form Type</th>
				<th>Submission ID</th>
				<th class="filter-select">Payment Status</th>
				<th class="filter-false">&nbsp;</th>
				<th class="filter-false">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php 
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
				<td><a href="/admin/diagnose/?filingId=<?php echo $data['filingList'][$i]['filingId']?>" alt="Diagnose" title="Diagnose" class="orngTxt">View&nbsp;Log</a></td>
				<td><a href="javascript:void(0);" onClick="javascript:window.open('/filingsummary/<?php echo $MCrypt->encrypt($data['filingList'][$i]['filingId']);?>','Resubmitting Filing','menubar=no,fullscreen=yes,toolbar=no,scrollbars=1')" alt="Resubmit" title="Resubmit" class="blueTxt">Resubmit</a></td>
			</tr>
			<?php 
				}
			?>
		</tbody>
	</table>
	--><?php }else if(isset($data['filingList']) && count($data['filingList']) == 0){
		echo '<div class="marTop20px" align="right"><a href="/admin/refiling" class="blueTxt">Back To Search</a></div>';
		echo '<div class="marTop20px errTxt">No filings found</div>';
	} ?>
<?php include 'footer.php'; ?>
