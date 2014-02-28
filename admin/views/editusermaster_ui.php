<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: editusermaster_ui.php
 * @version  	: 1.0
 * @date  		: 16-Dec-2013
 *
 * @description : edit user view file
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
$pageType = $_REQUEST['type'];
$request = $_SERVER['REQUEST_URI'];
$parsed = explode('/', $request);
require_once( TT_ADMIN_VIEW_PATH . '/header.php' );
global $constantArr;
$userDetails = $data['userInfoArray'];
$userDepartments = $data['allDepartmentsInfo'];
$userRoles 	 = $data['rolesArray'];
$MCrypt	= new MCrypt;
?>
<script>
//function emptyThis(id)
//{
//	if(document.getElementById(id).value == '*******')
//	document.getElementById(id).value = '';
//}
</script>
<?php if(isset($_SESSION['userUpdateStaus'])){?>
	<div class="statusMsg marTop10px"> <span class="successIcon"></span>
		<?php echo $_SESSION['userUpdateStaus'];
		unset($_SESSION['userUpdateStaus']);
		?>					
	</div>
<?php } ?>
<div class="padTop20px">
		<form method="post" action="/admin/usermaster/?type=<? echo $pageType;?>">
		<?php
			foreach( $userDetails as $key =>$value)
			{ 
			?>
			<input type="hidden" name="user_id" id="user_id" value="<?= $value['id']?>"/>
			<?php if($_REQUEST['type'] == 'myaccount'){?>
			<input type="hidden" name="type" id="type" value="myaccount"/>
			<?php }
		?>
		<h2><strong>Personal Information</strong></h2>
		<p>
			<label class="small">First Name:</label>
			<input type="text" class="txtBox320px" name="user_first_name" id="user_first_name" value="<?=$MCrypt->decrypt($value['first_name'])?>" 
			onKeypress = "javascript: return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','user_first_name_error','<?=$constantArr['firstname_error'][$_SESSION['lang']]?>');"
			onblur="return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','user_first_name_error','<?=$constantArr['firstname_error'][$_SESSION['lang']]?>'),clearErrbdr('user_first_name','user_first_name_error')"/>
			<span id="user_first_name_error" class="redTxt"></span>
		</p>	
		<p>
			<label class="small">Last Name:</label>
			<input type="text" class="txtBox320px" name="user_last_name" id="user_last_name" value="<?=$MCrypt->decrypt($value['last_name'])?>" 
			 onKeypress = "javascript: return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','user_last_name_error','<?=$constantArr['lastname_error'][$_SESSION['lang']]?>');"
			 onblur="return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','user_last_name_error','<?=$constantArr['lastname_error'][$_SESSION['lang']]?>'),clearErrbdr('user_last_name','user_last_name_error')"/>
			<span id="user_last_name_error" class="redTxt"></span>
		</p>
		<p>
			<label class="small">Phone Number:</label>
			<input type="text" class="txtBox320px" maxlength="14" name="user_phone" id="user_phone" value="<?=$MCrypt->decrypt($value['phone'])?>" onkeypress="return autoMask(this,event, '###-###-####');" />
			<span id="user_phone_error" class="redTxt"></span>
		</p>
		<p>
			<label class="small">User Type:</label>
			<select id="user_type" name="user_type" class="txtBox200px">
			<option value="0">- Select -</option>
			<option value="1"<?php if(($value['user_type'])=='1') {?> selected <?php }?>>Admin</option>
			<option value="2"<?php if(($value['user_type'])=='2') {?> selected <?php }?>>Front End User</option>
			<option value="3"<?php if(($value['user_type'])=='3') {?> selected <?php }?>>Support</option>
			</select>
			<span id="user_type_error" class="redTxt"></span>
		</p>
		<br clear="all" />
		
		<!--Role &amp; Desgination-->
		<h2 class="marTop20px"><strong>Role &amp; Desgination</strong></h2>
		<!--	If user is not an admin, then display department and role as label	-->
		<?php if($_SESSION['user_type'] != 1){?>
		<div class="marTop20px">
			<label class="small alignleft">Department:</label>
			<label>
			<b><?php echo ucfirst($value['department_name']);?></b>
			<input type="hidden" id="user_department" name="user_department" value="<?php echo $value['user_department_id'];?>" />
			</label>
			<br clear="all" />
		</div>
		<div class="marTop20px">
			<label class="small alignleft">Role:</label>
			<label>
			<b><?php echo ucfirst($value['role_name']);?></b>
			<input type="hidden" id="roles" name="user_role" value="<?php echo $value['user_role_id'];?>" />
			</label>
			<br clear="all" />
		</div>
		<?php }else{?>
		<div class="marTop20px">
			<label class="small alignleft">Department:</label>
			<div id="addDepartmentLink">
				<select id="user_department" name="user_department" class="txtBox200px alignleft" onblur="checkDepartment(this.id,'errorspan','<?php echo $userDetails[0]['user_role_id'];?>');">
					<option value="0">- Select -</option>
					<?php 
					foreach ($userDepartments as $keyloop => $valueloop)
					{
						echo '<option value="'.$valueloop['id'].'_'.$valueloop['department_name'].'"';
						if( $value['user_department_id'] == $valueloop['id'] ){
							echo 'selected';}
						echo '>'. $valueloop['department_name'] . '</option>'."\n";
					} ?>
				</select>
				<?php if($_SESSION['user_type'] == 1){?>
				<div class="alignleft marLeft10px">
					<a href="javascript:void(0)" onclick="showHideDepartment('showAddDepartment')" title="Add Department"><img title="Add Department" alt="Add Deparment" src="<?php echo TT_ADMIN_IMAGE_PATH;?>/add.png" class="marTop5px"></a>
					<a href="javascript:void(0)" onclick="deleteDepartment('<?php echo $parsed[1];?>')" title="Delete Department" >&nbsp;<img  title="Delete Department" alt="Delete Department" src="<?php echo TT_ADMIN_IMAGE_PATH;?>/delete.png"></a>
				</div>
				<?php } ?>
			</div>
			<div id="addDepartmentDiv" style="display:none;">
				<input type="text" name="Deptname" id="Deptname" class="txtBox320px alignleft"/>
				<div class="alignleft marLeft5px marTop5px">		
					<a href="javascript:void(0)" onclick="addDepartment('<?php echo $parsed[1];?>')" title="Save">&nbsp;&nbsp;<img title="Save"  alt="Save" src="<?php echo TT_ADMIN_IMAGE_PATH;?>/save_icon.png"></a>
					<a href="javascript:void(0)" onclick="showHideDepartment('showDepartmentlist')" title="Cancel" >&nbsp;&nbsp;<img  title="Cancel" alt="Cancel" src="<?php echo TT_ADMIN_IMAGE_PATH;?>/cancel-icon.png"></a>
				</div>
				<div id="newDeptError" class="redTxt marLeft10px alignleft marTop5px"></div>
			</div>
			<div id="user_department_error" class="redTxt marLeft10px alignleft marTop5px"></div>
			<br clear="all" />
		</div>
		
		<div class="marTop20px">
			<label class="small alignleft">Role:</label>
			<div id="addRoleLink">
				<select id="roles" name="user_role" class="txtBox200px alignleft" onBlur="checkRole(this.id);">
					<option value="0">- Select Role -</option>
						<?php 
							foreach( $userRoles as $roleKey => $roleValue ){ 
								echo '<option value="'.$roleValue['role_id'].'"';
								if( strtolower($roleValue['role_name']) == strtolower($value['role_name'])){
									echo 'selected';}
								echo '>'. $roleValue['role_name'] . '</option>'."\n";
							}
						?>
				</select>
				<?php 
				if($_SESSION['department_id'] <= 1 && $value['user_role_id']!=1){
					?>
				<div class="alignleft  marLeft10px">
					<a href="javascript:void(0)" onclick="showHiderole('showAddRole')" title="Add Department" ><img title="Add Department" alt="Add Department" src="<?php echo TT_ADMIN_IMAGE_PATH;?>/add.png" class="marTop5px"></a>
					<a href="javascript:void(0)" onclick="deleteRole('<?php echo $parsed[1];?>')" title="Delete Role">&nbsp;<img  title="Delete Role" alt="Delete Role" src="<?php echo TT_ADMIN_IMAGE_PATH;?>/delete.png"></a>
				</div>
				<?php } ?>
			</div>
			<div id="addRoleDiv" style="display:none;">
				<input type="text" name="Rolename" id="Rolename" class="txtBox320px alignleft"/>
				<div class="alignleft marLeft5px marTop5px">	
					<a href="javascript:void(0)" onclick="addRole('<?php echo $parsed[1];?>')" title="Save" >&nbsp;&nbsp;<img title="Save"  alt="Save" src="<?php echo TT_ADMIN_IMAGE_PATH;?>/save_icon.png"></a>
					<a href="javascript:void(0)" onclick="showHiderole('showRolelist')" title="Cancel" >&nbsp;&nbsp;<img  title="Cancel" alt="Cancel" src="<?php echo TT_ADMIN_IMAGE_PATH;?>/cancel-icon.png"></a>
				</div>
				<div id="newRollError" class="redTxt marLeft10px alignleft marTop5px"></div>
			</div>
			
			
			<div id="error" class="redTxt marLeft10px alignleft marTop5px"></div>
			<br clear="all" />
		</div>
		<?php } ?>

		<!--Access Information-->
		<h2 class="marTop20px"><strong>Access Information</strong></h2>
		<p>
			<label class="small">Email:</label>
			<input type="text" name="user_email" id="user_email" class="txtBox320px" value="<?=$MCrypt->decrypt($value['email'])?>" onblur="userEmailvalidate(this.id,'<?php echo $value['id'];?>','txtBox320px');"/>
			<span id="user_email_error" class="redTxt"></span>
		</p>
		<p>
			<label class="small">Password:</label>
			<input type="password" name="password" id="password" class="txtBox320px" value="*******"
			onblur="return checkPassword(event,this.id,'txtBox320px','txtBox320px errorBdr','password_error','<?=$constantArr['EnterValidPassword'][$_SESSION['lang']]?>')",
			onKeypress="clearErrbdr('password','password_error')" class="txtBox320px"/>
			<label class="small marTop5px">&nbsp;</label><br/>
			<span id="password_error" class="redTxt"></span>
		</p>
		<p>
			<label class="small">Confirm Password:</label>
			<input type="password" name="confirmpwd" id="confirmpwd" class="txtBox320px" value="*******"
			onblur="return checkPassword(event,this.id,'txtBox320px','txtBox320px errorBdr','confirmpwd_error','<?=$constantArr['EnterValidPassword'][$_SESSION['lang']]?>')",
			onKeypress="clearErrbdr('confirmpwd','confirmpwd_error')" class="txtBox320px"/>
			<label class="small marTop5px">&nbsp;</label><br/>
			<span id="confirmpwd_error" class="redTxt"></span>
		</p>
		<?php if($_SESSION['user_type'] == 1){?>
		<p>
			<label class="small">Admin Access:</label>
			<input id="isallowed" class="marRight10px" type="checkbox" name="isallowed" <?php if($value['admin_side_allowed'] == 1) echo 'checked'; ?>>
		</p>
		<?php } ?>
		<p>
			<label class="small">&nbsp;</label>			
			<input type="submit" name="updateUser" alt="Update" title="Update" value="Update" onclick="return addNewUserValidation();" class="blueButn80px"/>
			<a class="blueButn80px" alt="Cancel" title="Cancel" href="/admin/usermaster/?type=add"><span class="padLeft15px padRight30px">Cancel</span></a> 
		</p>
		
		<div id="subscribeLoader" style="display:none;">&nbsp; Please wait ... <img src="/images/loading_icon.gif" alt="Loading..."></div>
		<?php 
			//if($value['user_department_id'] > 1){
			?>
				<input type="hidden" name="user_dept_id" id="user_dept_id" value="<?= $value['user_department_id']?>"/>
				<input type="hidden" name="user_role_id" id="user_role_id" value="<?= $value['user_role_id']?>"/>
			<?php 
				//}
			} ?>			
	</form>
</div>
<script type="text/javascript">
	//document.getElementById('password').value='';
	//document.getElementById('confirmpwd').value='';
</script>
<?php include 'footer.php';?>