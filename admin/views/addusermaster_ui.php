<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename : addusermaster_ui.php
 * @version  : 1.0
 * @date  : 27-Feb-2013
 *
 * @description : add new user view file
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        27-Feb-2013           Initial Version - File Created
 * 
 */
$request = $_SERVER['REQUEST_URI'];
$parsed = explode('/', $request);
require_once( TT_ADMIN_VIEW_PATH . '/header.php' );
global $constantArr;
$userDepartments = $data['allDepartmentsInfo'];
?>
<?php
if(isset($_SESSION['errorStatus'])){?>
	<div class="errorMsg marTop10px"> <span class="errorIcon"></span> 
		<?php echo $_SESSION['errorStatus'];
		unset($_SESSION['errorStatus']);
		?>					
	</div>
<?php } ?>
<div class="padTop20px">
	<form action="/admin/usermaster/"  method="post" name="addnewuserform" id="addnewuserform">
		<h2><strong>Personal Information</strong></h2>
		<p>
			<label class="small">First Name:</label>
			<input type="text" class="txtBox320px" name="user_first_name" id="user_first_name" onKeypress = "javascript: return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','user_first_name_error','<?=$constantArr['firstname_error'][$_SESSION['lang']]?>');"
			onblur="return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','user_first_name_error','<?=$constantArr['firstname_error'][$_SESSION['lang']]?>'),clearErrbdr('user_first_name','user_first_name_error')"/>
			<span id="user_first_name_error" class="redTxt"></span>
		</p>
		<p>
			<label class="small">Last Name:</label>
			<input type="text" class="txtBox320px" name="user_last_name" id="user_last_name" onKeypress = "javascript: return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','user_last_name_error','<?=$constantArr['lastname_error'][$_SESSION['lang']]?>');"
			onblur="return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','user_last_name_error','<?=$constantArr['lastname_error'][$_SESSION['lang']]?>'),clearErrbdr('user_last_name','user_last_name_error')"/>
			<span id="user_last_name_error" class="redTxt"></span>
		</p>
		<p>
			<label class="small">Phone Number:</label>
			<input type="text" class="txtBox320px" maxlength="14" name="user_phone" id="user_phone" onkeypress="return autoMask(this,event, '###-###-####');" >
			<span id="user_phone_error" class="redTxt"></span>
		</p>
		<p>
			<label class="small">User Type:</label>
			<select id="user_type" name="user_type" class="txtBox200px" onchange="javascript:document.getElementById('user_type_error').innerHTML='';">
			<option value="0">- Select -</option>
			<option value="1">Admin</option>
			<option value="2">Front End User</option>
			<option value="3">Support</option>
			</select>
			<span id="user_type_error" class="redTxt"></span>
		</p>
		<br clear="all" />
		<!--Role &amp; Desgination-->
		<h2 class="marTop20px"><strong>Role &amp; Desgination</strong></h2>
		<div class="marTop20px">
			<label class="small alignleft">Department:</label>
			<div id="addDepartmentLink">
				<select id="user_department" name="user_department" class="txtBox200px alignleft" onchange="checkDepartment(this.id,'errorspan','');">
					<option value="0">- Select -</option>
					<?php 
					foreach ($userDepartments as $key => $value)
					{
					?>	
						<option value="<?php echo $value['id'].'_'.$value['department_name'];?>" id="<?php echo $value['id'].'_'.$value['department_name'];?>" name="department" > 
							<?php echo $value['department_name'];?> 
						</option>
					<?php 
					} ?>
				</select>
				<?php if($_SESSION['role_id'] < 2){?>
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
				<select id="roles" name="user_role" class="txtBox200px alignleft">
					<option value="0"> </option>
				</select>
				<div class="alignleft  marLeft10px">
					<a href="javascript:void(0)" onclick="showHiderole('showAddRole')" title="Add Role" ><img title="Add Role" alt="Add Role" src="<?php echo TT_ADMIN_IMAGE_PATH;?>/add.png" class="marTop5px"></a>
					<a href="javascript:void(0)" onclick="deleteRole('<?php echo $parsed[1];?>')" title="Delete Role">&nbsp;<img  title="Delete Role" alt="Delete Role" src="<?php echo TT_ADMIN_IMAGE_PATH;?>/delete.png"></a>
				</div>
			</div>
			<div id="addRoleDiv" style="display:none;">
				<input type="text" name="Rolename" id="Rolename" class="txtBox320px alignleft"/>
				<div class="alignleft marLeft5px marTop5px">	
					<a href="javascript:void(0)" onclick="addRole('<?php echo $parsed[1];?>')" title="Save" >&nbsp;&nbsp;<img title="Save"  alt="Save" src="<?php echo TT_ADMIN_IMAGE_PATH;?>/save_icon.png"></a>
					<a href="javascript:void(0)" onclick="showHiderole('showRolelist')" title="Cancel" >&nbsp;&nbsp;<img  title="Cancel" alt="Cancel" src="<?php echo TT_ADMIN_IMAGE_PATH;?>/cancel-icon.png"></a>
				</div>
				<div id="newRollError" class="redTxt marLeft10px alignleft marTop5px"></div>
			</div>
			<div id="user_role_error" class="redTxt marLeft10px alignleft marTop5px"></div>
			<br clear="all" />
		</div>
		<!--Access Information-->
		<h2 class="marTop20px"><strong>Access Information</strong></h2>
		<p>
			<label class="small">Email:</label>
			<input type="text" name="user_email" id="user_email" onblur="userEmailvalidate(this.id,'','txtBox320px');" class="txtBox320px"/>
			<span id="user_email_error" class="redTxt"></span>
		</p>
		<p>
			<label class="small">Password:</label>
			<input type="password" name="password" id="password" 
			onblur="return checkPassword(event,this.id,'txtBox320px','txtBox320px errorBdr','password_error','<?=$constantArr['EnterValidPassword'][$_SESSION['lang']]?>')",
			onKeypress="clearErrbdr('password','password_error')" class="txtBox320px"/><br/>
			<label class="small marTop5px">&nbsp;</label>
			<span id="password_error" class="redTxt"></span>
		</p>
		<p>
			<label class="small">Confirm Password:</label>
			<input type="password"  name="confirmpwd" id="confirmpwd" class="txtBox320px"
			onblur="return checkPassword(event,this.id,'txtBox320px','txtBox320px errorBdr','confirmpwd_error','<?=$constantArr['EnterValidPassword'][$_SESSION['lang']]?>')",
			onKeypress="clearErrbdr('confirmpwd','confirmpwd_error')" class="txtBox320px"/><br/>
			<label class="small marTop5px">&nbsp;</label>	
			<span id="confirmpwd_error" class="redTxt"></span>
		</p>
		<p>
			<label class="small">Admin Access:</label>
			<input id="isallowed" class="marRight10px" type="checkbox" name="isallowed">
		</p>
		<p>
			<label class="small">&nbsp;</label>	
			<input type="submit" onclick="return addNewUserValidation();" class="blueButn80px" alt="Save" title="Save" value="Save" name="addUser" />
			<input type="reset" class="blueButn80px" alt="Reset Form" title="Reset Form" value="Reset" />
		</p>
	</form>
</div>
<?php include 'footer.php';?>