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
$usersList = $data['allUsersListInfo'];
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
	if(isset($_SESSION['status'])){?>
		<div class="statusMsg">
			<span class="successIcon"></span> <?php echo $_SESSION['status']; unset($_SESSION['status']);?>
		</div>
		<div class="alignright marTop10px">
	<?php } else {?>	
		<div class="alignright">
	<?php }?>
		<a class="blueTxt marTop1px blueTxt" alt="Add User" title="Add User" href="/admin/usermaster/?type=add">
			<img src="/admin/images/add_icon.png"><span> Add User</span>
		</a>
		</div>
	<br clear="all"/>
	<table class="tablesorter" cellpadding="0" border="0" cellspacing="0">
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th class="filter-false">Email</th>
				<th class="filter-select">Role</th>
				<th class="filter-select">Department</th>
				<?php if($premissionArray['edit_privilege'] == 'Y' || $_SESSION['user_type'] == 1){?>
				<th class="filter-false">&nbsp;</th>
				<th class="filter-false">&nbsp;</th>
				<?php }?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($usersList as $key => $value){?>
			<tr>					
				<td><?php echo $MCrypt->decrypt(ucfirst($value['first_name']));?></td>
				<td><?php echo $MCrypt->decrypt(ucfirst($value['last_name']));?></td>
				<td><?php echo $MCrypt->decrypt($value['email']);?></td>
				<td><?php echo($value['role_name'] == '') ? '-':ucfirst($value["role_name"]);?></td>
				<td><?php echo($value['department_name'] == '') ? '-':ucfirst($value["department_name"]);?></td>
				<?php if($premissionArray['edit_privilege'] == 'Y' || $_SESSION['user_type'] == 1){?>
				<td><a href="/admin/usermaster/?type=edit&id=<?php echo $value['id'];?>" title="Edit User"><img src="<?php echo TT_ADMIN_IMAGE_PATH;?>/edit-icon.png"/></a></td>
				<td>
					<?php if($value['active']=='1'){?>
					<a href="javascript:void(0);" title="Make In-Active" alt="Make In-Active" onclick="updateUserStatus('<?php echo $value['id'];?>','deactivate')">
						<img src="<?php echo TT_ADMIN_IMAGE_PATH;?>/active-icon.png"/>
					</a>
					<?php }else{?>
					<a href="javascript:void(0);" title="Make Active" alt="Make Active" onclick="updateUserStatus('<?php echo $value['id'];?>','activate')">
						<img src="<?php echo TT_ADMIN_IMAGE_PATH;?>/inactive-icon.png"/>
					</a>
					<?php }?>

				</td>
				<?php }?>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<?php include_once 'footer.php';?>

