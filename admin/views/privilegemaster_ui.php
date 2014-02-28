<?php 
include_once 'header.php';
$userDepartments = $data['allDepartmentsInfo'];
if(isset($data['selectedRoleID']) && $data['selectedRoleID'] != '')
{
	if($data['selectedUserID'] > 0)
	{
		$selectedID = $data['selectedUserID'];
		$savedType = 'user';
	}
	else 
	{
		$selectedID = $data['selectedRoleID'];
		$savedType = 'role';
	}
	
?>
	<script type="text/javascript">
	$(function()
	{
		savedPrivileges('<?php echo $selectedID;?>','<?php echo $savedType;?>');
	});
	</script>
	
<?php 
}
?>	
<!---------maincontainer section starts here------------>
<?php if(isset($data['status']) && $data['status'] != ''){?>
	<div class="statusMsg">	<span class="successIcon"></span> Changes has been saved successfully. </div>
<?php }?>

<form action=""  name="privilegemgmt" id="privilegemgmt" method="post" onsubmit="return chkprivilege()">
	<table cellspacing="0px" cellpadding="5p"  border="0" width="100%" class="marTop20px">
		<tbody>
			<tr height="50" valign="top">
				<td width="25%" id="addDeptLink">
					<label><strong>Select Department:</strong><br clear="all"/>
					<select id="user_department" name="user_department" class="txtBox200px" onchange="checkDepartment(this.id,'errorspan','');">
						<option value="0">- Select Department -</option>
						<?php 
						foreach ($userDepartments as $key => $value)
						{
						?>	
							<option value="<?php echo $value['id'].'_'.$value['department_name'];?>" 
								id="<?php echo $value['id'].'_'.$value['department_name'];?>" name="department" <?php if(isset($data['selectedDepartmentID']) && $data['selectedDepartmentID'] ==($value['id'].'_'.$value['department_name'])){?>selected<?php }?>> 
								<?php echo $value['department_name'];?> 
							</option>
						<?php 
						} ?>
					</select>
				</td>
				<td width="25%" id="addRoleLink">
					<label><strong>Select Role:</strong></label><br clear="all"/>
					<select name="roles" id="roles" onchange="savedPrivileges(this.value,'role')" class="txtBox200px">
						<option value="">- Select Role -</option>
						<?php 
						if(isset($data['Allroles']) && count($data['Allroles']) > 0){	
						foreach($data['Allroles'] as $value){?>
						<option value="<?=$value['id']?>" <?php if(isset($data['selectedRoleID'])){ if($value['id'] == $data['selectedRoleID']){?>selected="selected"<?php } }?>><?=$value['role_name']?></option>
						<?php } }?>																			
					</select>
				</td>
				<td id="addUserLink">
					<label><strong>Select User:</strong><br clear="all"/>
					<select id="dept_role_user" name="dept_role_user" onchange="savedPrivileges(this.value,'user')" class="txtBox200px">											
					</select>
				</td>
			</tr>
			<tr><td colspan="3" class="botBdr">&nbsp;</td></tr>
		</tbody>
	</table>
	<div><span id="user_department_error"></span></div>
	<img alt="Loading..." style="display:none;" id="subscribeLoader" src='<?php echo TT_ADMIN_IMAGE_PATH;?>/loading_icon.gif' />
	<?php 
		foreach($data['ParentMenus'] as $key => $values)
		{
	?>
		<div class="" id="boxscroll">
			<div class="pad5px">
				<div class="padTop10px">
					<?php if($values['Publish'] == 'Y'){?>
					<input onclick="checkThis('<?=$values['Id']?>','<?php echo $values['Childs'];?>')" type="checkbox" name="<?php echo $values['Id'].'_greatparent';?>" id="<?php echo $values['Id'].'_greatparent';?>" />
					<?php }?>
					<strong class="padLeft5px orangetxt <?php echo ($values['Publish'] == 'N')? 'grayTxt':''?>"><?php echo $values['menuDisplayName'];?></strong>
				</div>
				<?php 
					if($values['Childs'] > 0)
					{
						foreach($values['Child'] as $values1)
						{
				?>		
				<div class="padLeft20px">									
					<div class="marTop15px headingtxt">
						<?php if($values1['Publish'] == 'Y' && $values['Publish'] == 'Y'){?>
							<input onclick="checksubParent('<?=$values1['Id']?>','<?php echo $values1['subChilds'];?>')" type="checkbox" name="<?php echo $values1['Id'].'_parent'?>" id="<?php echo $values1['Id'].'_parent'?>" />
						<?php }?>
						<span class="padLeft5px <?php echo ($values1['Publish'] == 'N' || $values['Publish'] == 'N')? 'grayTxt':''?>"><?php echo $values1['menuDisplayName'];?></span><br>
					</div>
				</div>
				<?php 
					if($values1['subChilds'] > 0 )
					{
						foreach($values1['subChild'] as $value2)
						{
				?>
				<div class="padLeft40px">									
					<div class="marTop15px"> 
						<div>
							<?php if($value2['Publish'] == 'Y' && $values1['Publish'] == 'Y' && $values['Publish'] == 'Y'){?>
								<input onclick="checkchild('<?=$value2['Id']?>')" type="checkbox" name="<?php echo $value2['Id'].'_child';?>" id="<?php echo $value2['Id'].'_child';?>" class="alignleft">
							<?php }?>
							<span class="padLeft5px alignleft <?php echo ($value2['Publish'] == 'N' || $values1['Publish'] == 'N' || $values['Publish'] == 'N')? 'grayTxt':'';?>"><?php echo $value2['menuDisplayName'];?></span>
						</div>
						<br>
						<?php if($value2['Publish'] == 'Y' && $values1['Publish'] == 'Y' && $values['Publish'] == 'Y'){?>
							<div class="padLeft20px">	
								<div class="alignleft marTop10px">
									<label for="<?php echo $value2['Id'].'_view'?>" id="<?php echo 'view_'.$value2['Id']?>" style="cursor:pointer">
										<input value="<?php echo $value2['Id'];?>" name="<?php echo $value2['Id'].'_view'?>" id="<?php echo $value2['Id'].'_view'?>" type="checkbox" /> View  
									</label>
								</div>
								<div class="alignleft marTop10px marLeft10px marRight10px hide_edit">  | </div>
								<div class="alignleft  marTop10px">
									<label for="<?php echo $value2['Id'].'_edit'?>" id="<?php echo 'edit_'.$value2['Id'];?>" style="cursor:pointer">
										<input value="<?php echo $value2['Id'];?>" name="<?php echo $value2['Id'].'_edit'?>" id="<?php echo $value2['Id'].'_edit'?>" type="checkbox" /> Edit
									</label>
								</div>
								<br clear="all"/>
							</div>
						<?php }?>
					</div>
				</div>
				<?php } } else { 
					if($values1['Publish'] == 'Y')
					{
				?> 
					<div class="padLeft40px">	
						<div class="alignleft marTop10px">
							<label for="<?php echo $values1['Id'].'_view'?>" for="<?php echo 'view_'.$values1['Id']?>" style="cursor:pointer">
								<input value="<?php echo $values1['Id'];?>" name="<?php echo $values1['Id'].'_view'?>" id="<?php echo $values1['Id'].'_view'?>" type="checkbox" /> View  
							</label>
						</div>
						<div class="alignleft marTop10px marLeft10px marRight10px hide_edit">  | </div>
						<div class="alignleft  marTop10px">
							<label for="<?php echo $values1['Id'].'_edit'?>" id="<?php echo 'edit_'.$values1['Id']?>" style="cursor:pointer">
								<input value="<?php echo $values1['Id'];?>" name="<?php echo $values1['Id'].'_edit'?>" id="<?php echo $values1['Id'].'_edit'?>" type="checkbox" /> Edit
							</label>
						</div>
						<br clear="all"/>
					</div>
				<?php } } } } else {
					if($values['Publish'] == 'Y')
					{
				?>
					<div class="padLeft20px">	
						<div class="alignleft marTop10px">
							<label for="<?php echo $values['Id'].'_view'?>" id="<?php echo 'view_'.$values['Id'];?>" style="cursor:pointer">
								<input value="<?php echo $values['Id'];?>" name="<?php echo $values['Id'].'_view'?>" id="<?php echo $values['Id'].'_view'?>" type="checkbox" /> View  
						</label>
					</div>
					<div class="alignleft marTop10px marLeft10px marRight10px hide_edit">  | </div>
					<div class="alignleft  marTop10px">
						<label for="<?php echo $values['Id'].'_edit'?>" id="<?php echo 'edit_'.$values['Id'];?>" style="cursor:pointer">
							<input value="<?php echo $values['Id'];?>" name="<?php echo $values['Id'].'_edit'?>" id="<?php echo $values['Id'].'_edit'?>" type="checkbox" /> Edit
						</label>
					</div>
					<br clear="all"/>
				</div>
			<?php } }?>
		</div>
	</div>
	<?php }?>
	<div class="alignright">
		<span id="error" class="errTxt marRight10px"></span>
		<a href="/"><input type="button" alt="Cancel" title="Cancel" class="blueButn80px" value="Cancel"/></a>
		<input type="submit" name="managePrivilege" alt="Save" title="Save" value="Save" class="blueButn80px"/>
	</div>
</form>
<!---------maincontainer section ends here------------>	

<script>
var inputs = document.getElementsByTagName("input");
for (var i = 0; i < inputs.length; i++){
	if (inputs[i].type == "checkbox"){
		inputs[i].disabled = true;
	}
}			
</script>	
	
<?php include_once 'footer.php';?>
