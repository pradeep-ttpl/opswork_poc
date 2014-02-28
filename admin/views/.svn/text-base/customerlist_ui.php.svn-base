<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: dashboard_ui.php
 * @version  	: 1.0
 * @date  		: 16-Dec-2013
 *
 * @description : Login controller file
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        16-Dec-2013           Initial Version - File Created
 * 
 */
require_once( TT_ADMIN_VIEW_PATH . '/header.php' );
$usersList = $data['allCustomerlist'];
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
<div class="marTop20px">
		 
		<?php 
		//$_SESSION['customerUpdateMsg'] = 'updated';
		if(!empty($_SESSION['customerUpdateMsg']))
		{
			if($_SESSION['customerUpdateMsg'] == 'updated')
			{
				$class = 'statusMsg';
				$image = '<span class="successIcon"></span>';
				$msg   = 'Updated Successfully';
			}
			else 
			{
				$class = 'errorMsg';
				$image = '<span class="errorIcon"></span>';
				$msg   = 'Update Failed';
			}
			echo '<div class="marTop10px '.$class.'" >'; 
			echo $image.' '.$msg; 
			unset($_SESSION['customerUpdateMsg']);
			echo '</div>';
		}
		?>
		<?php if(isset($_SESSION['status']))
		{
		?>
			<div class="statusMsg">
				<span class="successIcon"></span> <?php echo $_SESSION['status']; unset($_SESSION['status']);?>
			</div>
			<div class="marTop10px">
		<?php } else {?>	
			<div>
		<?php }?>
<!--		<br clear="all" />-->
<!--		<a class="blueTxt marTop1px blueTxt" alt="Add User" title="Add User" href="/admin/usermaster/?type=add">-->
<!--			<img src="/admin/images/add_icon.png"><span> Add User</span>-->
<!--		</a>-->

	<table class="tablesorter" cellpadding="0" border="0" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Name</th>
				<th class="filter-false">Email</th>
				<th class="filter-select">Phone</th>
				<th class="filter-select">Partial Filings</th>
				<th class="filter-select">Completed Filings</th>
				<th class="filter-select">Last Login</th>
				<th class="filter-false">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($usersList as $key => $value){?>
			<tr>		
				<td>
					<a href="/admin/customerlist/changestatus/<?php echo $MCrypt->encrypt($value['id']);?>" class="fancybox fancybox.ajax blueTxt"><?php echo $MCrypt->decrypt(ucfirst($value['first_name'])).' '.$MCrypt->decrypt(ucfirst($value['last_name']));?>
					</a>
				</td>
				<td><?php echo $MCrypt->decrypt($value['email']);?></td>
				<td><?php echo ($value['phone']!='')?$MCrypt->decrypt($value['phone']):'-';?></td>
				<td><?php echo $value['partialFilings'];?></td>
				<td><?php echo $value['completedFilings'];?></td>
				<td><?php echo ($value['latest_login']!='')?$value['latest_login']:'-';?></td>
				<td><a class="blueTxt" href="/admin/filingslist/<?php echo $MCrypt->encrypt($value['id']);?>">Filings List</a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
</div>
<?php include_once 'footer.php';?>
