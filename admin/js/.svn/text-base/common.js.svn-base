$(document).ready(function()
{
	// Added by Naveen R Kumar 12 Dec 2013
	$("#adminloginform").submit(function()
	{
		var email	 			= $('input[name=email]');
		var pwd 				= $('input[name=pwd]');
		var lang 				= $('input[name=lang]');
		var emailFilter=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;				
			
		if (email.val() == 0 || pwd.val() == 0)	
		{
			if (email.val() ==0) 
			{
				document.getElementById('email').className = 'errorBdr alignleft txtBox320px';		
			} 
			else 
			{
				document.getElementById('email').className = 'alignleft txtBox320px';
			}
			
			if (pwd.val() ==0) 
			{
				document.getElementById('pwd').className = 'errorBdr alignleft txtBox320px';
			} 
			else
			{
				document.getElementById('pwd').className = 'alignleft txtBox320px';
			}
			errorMsg('error_msg','TAX_VALIDATE_MSG',lang.val());			
			return false;
		}
		if(email.val() != 0 || pwd.val() != 0)
		{
			if(!(emailFilter.test(email.val()))) 
			{
				document.getElementById('email').className = 'errorBdr alignleft txtBox320px';
				errorMsg('error_msg','TAX_EMAIL_INVALID',lang.val());				
				
				return false;
			}
			else
			{
				document.getElementById('email').className = 'alignleft txtBox320px';
				document.getElementById('error_msg').innerHTML = '';			
			}
			if ((pwd.val().length < 6)) 
			{				
				document.getElementById('pwd').className = 'errorBdr alignleft txtBox320px';
				errorMsg('error_msg','TAX_PASSWORD_INVALID',lang.val());				
				return false;				
			} else {
				document.getElementById('pwd').className = 'alignleft txtBox320px';
				document.getElementById('error_msg').innerHTML = '';
			} 
		}
	});
});
function EditMenuControlPanel(menuId)
{
	document.getElementById('publishHolder').style.display = '';
	//if(menuId == 164 || menuId == 10 || menuId ==6)
	//document.getElementById('publishHolder').style.display = 'none';
	
	$('a').removeClass('selectedMenu');
	
	document.getElementById('edit_menu'+menuId).className = '';
	
//	document.getElementById('successMsg').innerHTML = '';
//	document.getElementById('successMsg').className = '';
	
	document.getElementById('menu_order_displayId').style.display = 'block';
	document.getElementById('delete_displayId').style.display = 'block';
	document.getElementById('addmenu_displayId').style.display = 'none';
	document.getElementById('menuId').value = menuId;
	
	document.getElementById('edit_menu'+menuId).className = 'selectedMenu';
	
	var postParams = 'type=EditMenu&menuId='+menuId;
	
	$.ajax({ type: "POST",async:false, url: "/admin/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			var newData = data.split('|');
			var publish = newData[4];
			
			document.getElementById('menu_display_name').value = newData[0];
			document.getElementById('menu_name').value = newData[1];
			document.getElementById('menu_parent').value = newData[2];
			document.getElementById('menu_order').value = newData[3];
			
			if(publish == 'Y')
			{ 	
				document.getElementById('menu_publish_yes').checked = true;
				document.getElementById('menu_publish_no').checked = false;
			}
			else if(publish == 'N')
			{
				document.getElementById('menu_publish_yes').checked = false;
				document.getElementById('menu_publish_no').checked = true;
			}
			
		}
	});
	
}
function validateaddMenuForm()
{
	var menu_display_name = document.getElementById('menu_display_name').value;
	var menu_name = document.getElementById('menu_name').value;
	
	$('input').removeClass('errorBdr');
	
	if(document.getElementById('menu_display_name').value == 0)
	{
		document.getElementById('menu_display_name').className = 'alignleft txtBox260px errorBdr';
		document.getElementById('errorspan').innerHTML = 'Please enter menu display name';
		return false;
	}
	else if(document.getElementById('menu_name').value == 0)
	{
		document.getElementById('menu_name').className = 'alignleft txtBox260px errorBdr';
		document.getElementById('errorspan').innerHTML = 'Please enter menu name';
		return false;
	}
}
function validateMenuForm()
{
	var menu_display_name = document.getElementById('menu_display_name').value;
	var menu_name = document.getElementById('menu_name').value;
	var menu_parent = document.getElementById('menu_parent').value;
	var menu_order = document.getElementById('menu_order').value;
	var publish_yes = document.getElementById('menu_publish_yes').checked;
	var menu_publish_no = document.getElementById('menu_publish_no').checked;
	var menuId = document.getElementById('menuId').value;
	
	if(publish_yes == true)
	{
		var publish = 'Y';
	}
	else if(menu_publish_no == true)
	{
		var publish = 'N';
	}
	
	$('input').removeClass('errorBdr');
	if(document.getElementById('menu_name').value == 0)
	{
		document.getElementById('menu_name').className = 'alignleft txtBox260px errorBdr';
		document.getElementById('errorspan').innerHTML = 'Please enter menu name';
		return false;
	}
	else if(document.getElementById('menu_display_name').value == 0)
	{
		document.getElementById('menu_display_name').className = 'alignleft txtBox260px errorBdr';
		document.getElementById('errorspan').innerHTML = 'Please enter menu display name';
		return false;
	}
	
	var postParams = 'type=UpdateMenu&menu_display_name='+menu_display_name+'&menu_name='+menu_name+'&menu_parent='+menu_parent+'&menu_order='+menu_order+'&publish='+publish+'&menuId='+menuId;
	
	$.ajax({ type: "POST",async:false, url: "/admin/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			var newData = data.split('|');
			
			document.getElementById('order_name_'+menuId).innerHTML = newData[0]+" -";
			document.getElementById('order_id_'+menuId).innerHTML = '('+newData[3]+')';
			document.getElementById('successMsg').className = 'successMsg';
			document.getElementById('successMsg').innerHTML = 'Menu successfully updated';
		}
	});
	
}
function deleteMenu(menuId)
{
	menuId = document.getElementById('menuId').value;
	var ibox = confirm("Are you sure to delete the menu? You will loose the sub menu belongs to this menu");	
	if( ibox == true )		
	{
		var postParams = 'menuId='+menuId+'&type=deleteMenu';
		$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				window.location.href = '/admin/menucontrolpanel/';
			}
		});
	}
}
//check selected department and fetch related roles
function checkDepartment(id,errorspan,existingRoleId){
	
	if(document.getElementById('user_department_error')!=null){
		document.getElementById('user_department_error').innerHTML = '';
		document.getElementById('user_department').className = 'txtBox200px alignleft';
	}

	if(document.getElementById('dept_role_user')!=null)
		document.getElementById('dept_role_user').innerHTML = '';
	
	if(document.getElementById('user_designation')!=null)
	document.getElementById('user_designation').value = '';	
	
	var roleId = '';
	if(existingRoleId>0){
		roleId = existingRoleId;
	}
//	var inputs = document.getElementsByTagName("input");
//	for (var i = 0; i < inputs.length; i++){
//	    if (inputs[i].type == "checkbox"){
//	    	inputs[i].checked = false;
//	        inputs[i].disabled = true;
//	    }
//	}	
	var department = document.getElementById(id).value;
	var type = 'getRoles';
	var deptArray = department.split("_");
	var postParams = 'type='+type+'&deptId='+deptArray['0']+'&roleId='+roleId;
	
	$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			var result = data.split("~");
			
			if(result[1] == 'filled')
			{    
				document.getElementById('roles').innerHTML = data;
			}
			else
			{	
				if(document.getElementById('user_department').value == 0)
				{ 
					document.getElementById('roles').innerHTML = '';
				}
				else
				{ 
					document.getElementById('roles').innerHTML = data;
				}
			}
		}
	});	
}
//Fetching saved privileges
function savedPrivileges(selectedID,SavedType)
{
	//$.fancybox.open('<div class="pad25px" align="center" style="height:50px;width:200px;"><img src="/admin/images/loading.gif"/> <br/>Please wait...</div>');
	var roleId = document.getElementById('roles').value;
	var inputs = document.getElementsByTagName("input");
	for (var i = 0; i < inputs.length; i++){
	    if (inputs[i].type == "checkbox"){
	        inputs[i].disabled = false;
	    }
	}	
	
	var elem = document.forms['privilegemgmt'].elements;
	for ( var j = 0; j < elem.length; j++) 
	{
		if (elem[j].type == 'checkbox')
			elem[j].checked = false;
	}
		
	var postParams = 'type=savedPrivileges&selectedID=' +selectedID+'&SavedType='+SavedType+'&roleId='+roleId;
	
	$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			var result = data.split("|");	
			for(i=0; i<result.length; i++)
			{
				submenus = result[i].split(",");
								
				if(document.getElementById(submenus[0]+"_greatparent")!=null)
				document.getElementById(submenus[0]+"_greatparent").checked=true;
				
				if(document.getElementById(submenus[0]+"_parent")!=null)
				document.getElementById(submenus[0]+"_parent").checked=true;
				
				if(document.getElementById(submenus[0]+"_child")!=null)
				document.getElementById(submenus[0]+"_child").checked=true;
				
				if(document.getElementById(submenus[1]+"_greatparent")!=null)
				document.getElementById(submenus[1]+"_greatparent").checked=true;
				
				if(document.getElementById(submenus[1]+"_parent")!=null)
				document.getElementById(submenus[1]+"_parent").checked=true;
				
				if(document.getElementById(submenus[1]+"_child")!=null)
				document.getElementById(submenus[1]+"_child").checked=true;
				
				if(submenus[2] == 'Y')
				{
					if(document.getElementById(submenus[1]+"_view") != null)
					document.getElementById(submenus[1]+"_view").checked=true;
				}
				
				if(submenus[3] == 'Y')
				{
					if(document.getElementById(submenus[1]+"_edit") != null)
					document.getElementById(submenus[1]+"_edit").checked=true;
				}
				
				if(document.getElementById(submenus[4]+"_greatparent")!=null)
				document.getElementById(submenus[4]+"_greatparent").checked=true;							
				
			}
		}
	});
	
	if(SavedType == 'role')
	{
		var postParams1 = 'type=selectUsers&roleId=' +selectedID;
		$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams1, dataType: "html",
			success: function( data, textStatus )
			{
				document.getElementById("dept_role_user").innerHTML=data;
			}
		});
	}
	if(SavedType == 'user')
	{
		var postParams1 = 'type=selectAssignedUsers&userId=' +selectedID+'&roleId=' +roleId;
		$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams1, dataType: "html",
			success: function( data, textStatus )
			{
				document.getElementById("dept_role_user").innerHTML=data;
			}
		});
	}
	//$.fancybox.close();
	setTimeout("parent.$.fancybox.close();",500);
}
//to check selected checkbox and its attributes
function checkThis(chkboxID,totalChilds)
{
	if(document.getElementById(chkboxID+"_greatparent").checked==true)
	{
		if(totalChilds > 0)
		{
			var postParams = 'type=selectSubparent&ParentId=' +chkboxID;
			$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams, dataType: "html",
				success: function( data, textStatus )
				{
					var result = data.split(",");
					for(i=0; i<result.length; i++)
					{
						if(document.getElementById(result[i]+"_view")!=null)
						{
							document.getElementById(result[i]+"_parent").checked=true;
							document.getElementById(result[i]+"_view").checked=true;
							document.getElementById(result[i]+"_edit").checked=true;
						}
						else
						{
							if(document.getElementById(result[i]+"_parent")!=null)
							{
								document.getElementById(result[i]+"_parent").checked=true;
								var postParams1 = 'type=selectSubparent&ParentId=' +result[i];
								$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams1, dataType: "html",
									success: function( data1, textStatus )
									{
										var result1 = data1.split(",");
										for(k=0; k<result1.length; k++)
										{
											if(document.getElementById(result1[k]+"_child")!=null)
											document.getElementById(result1[k]+"_child").checked=true;
											
											if(document.getElementById(result1[k]+"_view")!=null)
											document.getElementById(result1[k]+"_view").checked=true;
											
											if(document.getElementById(result1[k]+"_edit")!=null)
											document.getElementById(result1[k]+"_edit").checked=true;
										}
									}
								});
							}
						}
					}
				}
			});
		}
		else
		{
			if(document.getElementById(chkboxID+"_view")!=null)
			{
				document.getElementById(chkboxID+"_view").checked=true;
				document.getElementById(chkboxID+"_edit").checked=true;
			}
		}
	}
	else
	{
		if(totalChilds > 0)
		{
			var postParams = 'type=selectSubparent&ParentId=' +chkboxID;
			$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams, dataType: "html",
				success: function( data, textStatus )
				{
					var result = data.split(",");
					for(i=0; i<result.length; i++)
					{
						if(document.getElementById(result[i]+"_view")!=null)
						{
							document.getElementById(result[i]+"_parent").checked=false;
							document.getElementById(result[i]+"_view").checked=false;
							document.getElementById(result[i]+"_edit").checked=false;
						}
						else
						{
							if(document.getElementById(result[i]+"_parent")!=null)
							{
								document.getElementById(result[i]+"_parent").checked=false;
								var postParams1 = 'type=selectSubparent&ParentId=' +result[i];
								$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams1, dataType: "html",
									success: function( data1, textStatus )
									{
										var result1 = data1.split(",");
										for(k=0; k<result1.length; k++)
										{
											if(document.getElementById(result1[k]+"_child")!=null)
											document.getElementById(result1[k]+"_child").checked=false;
											
											if(document.getElementById(result1[k]+"_view")!=null)
											document.getElementById(result1[k]+"_view").checked=false;
											
											if(document.getElementById(result1[k]+"_edit")!=null)
											document.getElementById(result1[k]+"_edit").checked=false;
										}
									}
								});
							}
						}
					}
				}
			});
		}
		else
		{
			if(document.getElementById(chkboxID+"_view")!=null)
			{
				document.getElementById(chkboxID+"_view").checked=false;
				document.getElementById(chkboxID+"_edit").checked=false;
			}
		}
	}
}
//to check selected checkbox and its attributes
function checksubParent(chkboxID,totalSubChilds)
{
	if(document.getElementById(chkboxID+"_parent").checked==true)
	{
		if(totalSubChilds > 0)
		{
			var postParams1 = 'type=selectSubparent&ParentId='+chkboxID;
			$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams1, dataType: "html",
				success: function( data1, textStatus )
				{
					var result1 = data1.split(",");
					for(i=0; i<result1.length; i++)
					{
						if(document.getElementById(result1[i]+"_child") != null)
						{
							document.getElementById(result1[i]+"_child").checked=true;
							document.getElementById(result1[i]+"_view").checked=true;
							document.getElementById(result1[i]+"_edit").checked=true;
						}
					}
				}
			});
		}
		else
		{
			document.getElementById(chkboxID+"_view").checked=true;
			document.getElementById(chkboxID+"_edit").checked=true;
		}
	}
	else
	{
		if(totalSubChilds > 0)
		{
			var postParams1 = 'type=selectSubparent&ParentId='+chkboxID;
			$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams1, dataType: "html",
				success: function( data1, textStatus )
				{
					var result1 = data1.split(",");
					for(i=0; i<result1.length; i++)
					{
						if(document.getElementById(result1[i]+"_child") != null)
						{
							document.getElementById(result1[i]+"_child").checked=false;
							document.getElementById(result1[i]+"_view").checked=false;
							document.getElementById(result1[i]+"_edit").checked=false;
						}
					}
				}
			});
		}
		else
		{
			document.getElementById(chkboxID+"_view").checked=false;
			document.getElementById(chkboxID+"_edit").checked=false;
		}
	}
}
//to check selected checkbox and its attributes
function checkchild(chkboxID)
{
	if(document.getElementById(chkboxID+"_child").checked == true)
	{
		document.getElementById(chkboxID+"_view").checked=true;
		document.getElementById(chkboxID+"_edit").checked=true;
	}
	else
	{
		document.getElementById(chkboxID+"_view").checked=false;
		document.getElementById(chkboxID+"_edit").checked=false;
	}
}
//Validate department and role selection
function chkprivilege()
{
	if(document.getElementById('user_department').value == 0)
	{
		document.getElementById('user_department').className = 'selectbox210px errorBdr';
		document.getElementById('error').innerHTML = 'Please select the Department';
		window.scrollTo(0,0);
		return false;
	}
	else if(document.getElementById('roles').value == 0)
	{
		document.getElementById('roles').className = 'selectbox210px alignleft errorBdr';
		document.getElementById('error').innerHTML = 'Please select the role';
		window.scrollTo(0,0);
		return false;
	}
}
//show and hide dynamic department text box when adding new department
function showHideDepartment(showType)
{
	if(document.getElementById('user_department_error')!=null)
	document.getElementById('user_department_error').innerHTML =  "";
	if(document.getElementById('user_role_error')!=null)
	document.getElementById('user_role_error').innerHTML =  "";	
	if(showType == 'showAddDepartment')
	{
		document.getElementById('addDepartmentLink').style.display = 'none';
		document.getElementById('addDepartmentDiv').style.display = '';
		document.getElementById('user_department').selectedIndex = '';
		document.getElementById('user_department').value = '';
	}
	else if(showType == 'showDepartmentlist')
	{
		//$('input').removeClass('errorBdr');
		document.getElementById('addDepartmentDiv').style.display = 'none';
		document.getElementById('addDepartmentLink').style.display = '';
		document.getElementById('newDeptError').innerHTML =  "";
	}
}
//Adding new dynamic department
function addDepartment(pageName)
{
	var deptName = document.getElementById('Deptname').value;
	if(deptName == 0)
	{
		document.getElementById('Deptname').className = 'alignleft txtBox320px errorBdr';
		document.getElementById('newDeptError').innerHTML = "Please enter department name";
		return false;
	}
	else
	{
		document.getElementById('Deptname').className = 'alignleft txtBox320px';
		document.getElementById('newDeptError').innerHTML =  "";			
		
		var postParams = 'type=addDepartment&DeptName='+deptName;
		
		$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				if(data == 'department exist')
				{
					document.getElementById('Deptname').value = '';
					document.getElementById('Deptname').className = 'alignleft txtBox320px errorBdr';
					document.getElementById('newDeptError').innerHTML = 'Department name already exists';
				}
				else
				{
					document.getElementById('Deptname').value = '';
					document.getElementById('addDepartmentDiv').style.display = 'none';
					document.getElementById('addDepartmentLink').style.display = '';
					document.getElementById('user_department').innerHTML = data;
					document.getElementById('roles').innerHTML = '';
				}
			}
		});
	}
}
//Deleting a department
function deleteDepartment(pageName)
{
	var deptId = document.getElementById('user_department').value; 	
	
	var postParams = 'type=checkDeptAvailable';
	
	$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			//If no departments found
			if(data == 0)
			{
				document.getElementById('user_department_error').innerHTML = "No departments found";
				return false;
			}
			else
			{
				if(deptId == '' || deptId == 0)
				{		
					//document.getElementById('user_department').className = 'selectBox150px errorBdr';
					document.getElementById('user_department_error').innerHTML = "Please select a department to delete";
					return false;
				}
				else
				{		
					document.getElementById('user_department_error').innerHTML =  "";			
					
					var confirmDelete = confirm("Do you really want to delete the department");

					var deptArrayValue = deptId.split("_");
										
					if(confirmDelete == true)		
					{
						var postParams = 'type=deleteDept&deptId=' +deptId+'&deptArrayValue='+deptArrayValue['0'];
						
						$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams, dataType: "html",
							success: function( data, textStatus )
							{
								document.getElementById('user_department').innerHTML = data;
								
								if(document.getElementById('roles')!=null)
								{
									//document.getElementById('roles').value = 0; 
									document.getElementById('roles').innerHTML = "<option value=''>-No Roles found-</option>"; 
								}
								
							}
						});
					}
				}
			}
		}
	});
	
}
//show and hide dynamic role text box when adding new role
function showHiderole(showType)
{
	if(document.getElementById('user_department_error')!=null)
	document.getElementById('user_department_error').innerHTML =  "";
	if(document.getElementById('user_role_error')!=null)
	document.getElementById('user_role_error').innerHTML =  "";
	
	if(document.getElementById('newRollError')!=null)
		document.getElementById('newRollError').innerHTML = '';

	
	if(showType == 'showAddRole')
	{
		document.getElementById('addRoleLink').style.display = 'none';
		document.getElementById('addRoleDiv').style.display = '';
		document.getElementById('roles').selectedIndex = '';
		document.getElementById('roles').value = '';
	}
	else if(showType == 'showRolelist')
	{
		document.getElementById('addRoleDiv').style.display = 'none';
		document.getElementById('addRoleLink').style.display = '';
		if(document.getElementById('error')!=null){
		document.getElementById('error').innerHTML =  "";
		}
	}
}
//Adding new dynamic role
function addRole(pageName)
{
	var userDepartment = document.getElementById('user_department').value;
	var userDepartmentArray = userDepartment.split("_");
	var userDepartmentId = userDepartmentArray['0'];
	var roleName = document.getElementById('Rolename').value;


	if(document.getElementById('newRollError')!=null)
		document.getElementById('newRollError').innerHTML = '';
	
	if(userDepartment == 0)
	{
		document.getElementById('user_department').className = 'txtBox200px alignleft errorBdr';
		document.getElementById('user_department_error').style.display='';
		document.getElementById('user_department_error').innerHTML = "Please select the department";
		return false;
	}
	if(roleName == '')
	{
		document.getElementById('Rolename').className = 'alignleft txtBox320px errorBdr';
		document.getElementById('newRollError').innerHTML = "Please enter role";
		return false;
	}
	else
	{
		document.getElementById('Rolename').className = 'alignleft txtBox320px';
		document.getElementById('newRollError').innerHTML =  "";			
		//document.getElementById('subscribeLoader').style.display = 'block';
		
		var type = 'addRole';
		
		var postParams = 'type='+type+'&roleName='+roleName+'&deptId='+userDepartmentId;
		
		$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				//document.getElementById('subscribeLoader').style.display = 'none';
				var result = data.split("|");				
				if(result[1] == 'inserted')
				{	
					if(document.getElementById('Rolename')!=null)
					document.getElementById('Rolename').value = '';
					
					document.getElementById('newRollError').style.color = 'green';
					document.getElementById('newRollError').innerHTML = 'Role added';
					//setTimeout(function () { window.location.href= pageName },3000);
					document.getElementById('addRoleLink').style.display = '';
					document.getElementById('roles').innerHTML = result[0];
					
					if(document.getElementById('addRoleDiv')!=null)
					document.getElementById('addRoleDiv').style.display = 'none';
					
					var inputs = document.getElementsByTagName("input");
					for (var i = 0; i < inputs.length; i++){
					    if (inputs[i].type == "checkbox"){
					        inputs[i].disabled = false;
					    }
					}						
				}else{
					document.getElementById('newRollError').style.color = 'red';
					document.getElementById('newRollError').innerHTML = 'Role already exist';
				}
			}
		});
	}

}
//Delete a role
function deleteRole(pageName)
{
	var department = document.getElementById('user_department').value;
	var departmentArray = department.split("_");
	var departmentId = departmentArray['0'];
	var roleID = document.getElementById('roles').value; 	
	
	var postParams = 'type=checkRoleAvailable&department=' +department;
	
	$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			if(data == '0')
			{   
				document.getElementById('error').innerHTML = "No role found";
				return false;
			}
			else
			{   
				if(roleID == '' || roleID == 0)
				{		
					//document.getElementById('roles').className = 'selectBox150px errorBdr';
					document.getElementById('error').innerHTML = "Please select a role to delete";
					return false;
				}
				else
				{
					if(document.getElementById('error') != null)
					document.getElementById('error').innerHTML =  "";			
					//document.getElementById('subscribeLoader').style.display = 'block';
					
					var postParams = 'type=deleteRole&departmentId=' +departmentId+'&roleID=' +roleID;
					
					var confirmDelete = confirm("Do you really want to delete the role");
					
					if(confirmDelete == true)
					{
						$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams, dataType: "html",
							success: function( data, textStatus )
							{
								var result = data.split("~");
								if(result[1] == 'filled')
								{
									document.getElementById('roles').innerHTML = data;
								}
								else
								document.getElementById('roles').innerHTML = data;
							}
						});
					}
				}
			}
			
		}
	});
	
}
//Activate or De-activate an user
function updateUserStatus(userId,status)
{
	var type = 'updateUserStatus';
	var postParams = '&userId=' +userId+'&type='+type+'&status='+status;
	$.ajax({ type: "POST", url: "/admin/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			if( data == 'updated')
			{
				window.location.href= '/admin/usermaster';
			}
		}
	});
}
function checkPaymentStatus()
{
	var paymentstatus = document.getElementById('paymentstatus').value;
	
	if(paymentstatus == 0)
	{
		document.getElementById('paymentstatus').className = 'txtBox150px errorBdr';
		document.getElementById('error_msg').innerHTML = 'This a required field.Please enter payment status.';
		return false;
	}

}
//User Name validation
function nameValidate(id,msg){
	var userName = document.getElementById(id).value;
	if(trim(userName)=='')
	{
		document.getElementById(id+'_error').style.display = '';
		document.getElementById(id+'_error').innerHTML = 'Enter '+msg;
		document.getElementById(id).className = 'txtBox320px errorBdr';
		document.getElementById(id).focus();
	}
	else
	{
		document.getElementById(id+'_error').style.display = '';
		document.getElementById(id+'_error').innerHTML = '';
		document.getElementById(id).className = 'txtBox320px';
	}
}
//To check the value is alphanumeric
function isAlphabet(evt,val,error,assignedClass) 
{  
	var keyCode = evt.which ? evt.which : evt.keyCode;
	var alpha = (keyCode >= 'a'.charCodeAt() && keyCode <= 'z'.charCodeAt())
	|| (keyCode >= 'A'.charCodeAt() && keyCode <= 'Z'.charCodeAt())
	|| (keyCode >= 8 && keyCode <= 46);		

	if (!alpha) 
	{        
	return false;
	}
	if(alpha)
	{
	if((keyCode==37)||(keyCode==39))
	{
	return true;                 
	}			
	if(document.getElementById(val).value.length == 0)
	{       
	if(keyCode==46)
	{ 					
	return false;
	}
	else if(keyCode==32)
	{ 						
	return false;
	}
	else if((keyCode>=33 && keyCode<=45)||(keyCode>=58 && keyCode<=64)||(keyCode>=91
	&& keyCode<=96)||(keyCode>=123 && keyCode<=255)||(keyCode==47))
	{                
	document.getElementById(val).className = assignedClass+' errorBdr';
	document.getElementById(error).innerHTML = ' unwanted symbols';
	document.getElementById(val).scrollIntoView();
	return false;
	}			        
	}
	else if((keyCode>=33 && keyCode<=45)||(keyCode>=58 && keyCode<=64)||(keyCode>=91
	&& keyCode<=96)||(keyCode>=123 && keyCode<=255)||(keyCode==47))
	{  			
	document.getElementById(val).className = assignedClass+' errorBdr';
	document.getElementById(error).innerHTML = ' unwanted symbols';
	document.getElementById(val).scrollIntoView();
	return false;
	}  
	else 
	{			
		document.getElementById(val).className = assignedClass;
		document.getElementById(error).innerHTML = '';				
		return (true);
	}
	}	
}
// To remove the whitespace left and right side of the text
function trim(s)
{   
	  var i;
	  var returnString = "";
	  // Search through string's characters one by one.
	  // If character is not a whitespace, append to returnString.
	  for (i = 0; i < s.length; i++)
	  {   
	      // Check that current character isn't whitespace.
	      var c = s.charAt(i);
	      if (c != " ") returnString += c;
	  }
	  return returnString;
}
//To check whether user email is valid
function userEmailvalidate(id,userid,selectedClass)
{
	var email = document.getElementById(id).value;
	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

	if(email != '' && regMail.test(email) == false)
	{
		document.getElementById(id+'_error').style.display = '';
		document.getElementById(id+'_error').innerHTML = 'Email address is not valid.';
		document.getElementById(id).value = "";
		document.getElementById(id).className = selectedClass+' errorBdr';
		//document.getElementById(id).scrollIntoView();
		return false;
	}
	else
	{
		document.getElementById(id+'_error').style.display = '';
		document.getElementById(id+'_error').innerHTML = '';
		document.getElementById(id).className = selectedClass;
		// To check whether user email already exist
		//checkExistingEmail(id,userid,selectedClass);
	}

}
//To vlaidate phone number
function phoneValidate(id,errorspan,assignedClass){
	var phoneFilter = /^(?:[+]?)(?:[0-9\-()] ?){9,11}[0-9]$/;
	var phone = document.getElementById(id).value;
	if(phone!='' && !(phoneFilter.test(phone)) && phone.length <= 7)
	{
		document.getElementById(errorspan).style.display = '';
		document.getElementById(errorspan).innerHTML = 'Enter a valid phone number';
		document.getElementById(id).className = assignedClass+' errorBdr';
		document.getElementById(id).value = '';
		return false;
	}else{
		document.getElementById(errorspan).style.display = 'none';
		document.getElementById(errorspan).innerHTML = '';
		document.getElementById(id).className = assignedClass;
	}	
}

//To vlaidate Admin - Refiling form
function validateRefilingForm(){
	
	var ein = document.getElementById('ein').value;
	var biz = document.getElementById('bizName').value;
	var month = document.getElementById('taxmonth').value;
	var formType = document.getElementById('taxForm').value;
	var year = document.getElementById('taxyear').value;
	
	document.getElementById('errorMsg').innerHTML  = '';
	$('input').removeClass('errorBdr');
	$('select').removeClass('errorBdr');
	
	if (ein == '') 
	{
		document.getElementById('ein').className = 'loginTxtBoxErr txtBox200px';
		document.getElementById('errorMsg').innerHTML = "Please enter EIN";
		return false;
	}
	
	if (ein.length < 10) 
	{
		document.getElementById('bizName').className = 'loginTxtBoxErr txtBox200px';	
		document.getElementById('errorMsg').innerHTML = "Please enter valid EIN";
		return false;
	}
	if(biz == 0)
	{
		document.getElementById('errorMsg').innerHTML = "Please select business";
		document.getElementById('bizName').className = 'errorBdr txtBox200px';
		return false;
	}
	else if(formType == 0)
	{
		document.getElementById('errorMsg').innerHTML = "Please select form type";
		document.getElementById('taxForm').className = 'errorBdr txtBox320px';
		return false;
	}
	else if(year == 0)
	{
		document.getElementById('errorMsg').innerHTML = "Please select filing year";
		document.getElementById('taxyear').className = 'errorBdr txtBox150px';
		return false;
	}
	else if(month == 0)
	{
		document.getElementById('errorMsg').innerHTML = "Please select filing month";
		document.getElementById('taxmonth').className = 'errorBdr txtBox150px';
		return false;
	}
	else
	{
		return true;
	}
}
//To check password is valid
function checkPwd(id){
	var password = document.getElementById(id).value;
	document.getElementById('confirmpwd_error').innerHTML = '';
	document.getElementById('confirmpwd').className = 'txtBox320px';

	if(trim(password)=='')
	{
		document.getElementById(id+'_error').style.display = '';
		document.getElementById(id+'_error').innerHTML = 'Enter a password';
		document.getElementById(id).className = 'txtBox320px errorBdr';
		document.getElementById(id).value = '';
		return false;
	}else if(password.length < 6){
		document.getElementById(id+'_error').style.display = '';
		document.getElementById(id+'_error').innerHTML = 'Password should be minimum 6 characters';
		document.getElementById(id).className = 'txtBox320px errorBdr';
		document.getElementById(id).value = '';
		return false;
	}else{
		document.getElementById(id+'_error').innerHTML = '';
		document.getElementById(id).className = 'txtBox320px';
	}
}
function passwordCheck()
{
	var password = document.getElementById('password').value;
	var cPassword = document.getElementById('confirmpwd').value;
	if(trim(cPassword)=='')
	{
		document.getElementById('confirmpwd_error').style.display = '';
		document.getElementById('confirmpwd_error').innerHTML = 'Enter a confirm password';
		document.getElementById('confirmpwd').className = 'txtBox320px errorBdr';
		document.getElementById('confirmpwd').value = '';
		return false;
	}else if( password != cPassword )
	{
		document.getElementById('confirmpwd_error').style.display = '';
		document.getElementById('confirmpwd_error').innerHTML = 'Password and Confirm password mismatch.';
		document.getElementById('confirmpwd').className = 'txtBox320px errorBdr';
		document.getElementById('confirmpwd').value = '';
		return false;
	}
	else
	{
		document.getElementById('confirmpwd_error').innerHTML = '';
		document.getElementById('confirmpwd').className = 'txtBox320px';
	}
}
//Validate role selection
function checkRole(id){
	var role = document.getElementById(id).value;
	if (role=='0') 
	{
		document.getElementById('error').style.display = '';
		document.getElementById('error').innerHTML = 'Select role';
		document.getElementById(id).className = 'txtBox200px errorBdr alignleft';
		return false;
	}else{
		document.getElementById('error').style.display = '';
		document.getElementById('error').innerHTML = '';
		document.getElementById(id).className = 'txtBox200px alignleft';
	}	
}
function showHideDiscountType(selectedType){
	if(selectedType == 'amount'){
		document.getElementById('amountPara').style.display = 'block';
		document.getElementById('percentagePara').style.display = 'none';
		document.getElementById('discountPercentage_error').innerHTML = "";
		document.getElementById('discountPercentage').className = 'txtBox50px';

	}else if(selectedType == 'percentage'){
		document.getElementById('amountPara').style.display = 'none';
		document.getElementById('percentagePara').style.display = 'block';
		document.getElementById('discountAmount_error').innerHTML = "";
		document.getElementById('discountAmount').className = 'txtBox50px';

	}
}
function addNewSchemeValidation(){
	
	var schemeName		= document.getElementById('schemeName').value;
	var noOfCoupons = document.getElementById('noOfCoupons').value;
	var fromDate 	= document.getElementById('dateFrom').value;
	var toDate 		= document.getElementById('dateTo').value;
	var discountType= document.getElementById('discountType').value;
	var toWhom		= document.getElementById('toWhom').value;
	
	if(discountType == 'amount'){
		var discountAmount	= document.getElementById('discountAmount').value;	
	}else{
		var discountPercentage	= document.getElementById('discountPercentage').value;	
	}
	
	$('input').removeClass('errorBdr');
	$('select').removeClass('errorBdr');
	
	if (schemeName == '') 
	{
		document.getElementById('schemeName').className = 'txtBox320px errorBdr';
		document.getElementById('schemeName_error').innerHTML = "Please enter Purpose / To Whom";
		return false;
	}	
	else if(noOfCoupons == '')
	{
		document.getElementById('noOfCoupons').className = 'errorBdr txtBox50px';
		document.getElementById('noOfCoupons_error').innerHTML = "Please enter No.of.Coupons";
		document.getElementById('schemeName').className = 'txtBox320px';
		document.getElementById('schemeName_error').innerHTML = "";
		return false;
	}
	else if(noOfCoupons == 0)
	{
		document.getElementById('noOfCoupons').className = 'errorBdr txtBox50px';
		document.getElementById('noOfCoupons_error').innerHTML = "No.of.Coupons should be greater than zero";
		document.getElementById('schemeName_error').innerHTML = "";
		return false;
	}
	else if(fromDate == '')
	{
		document.getElementById('dateFrom').className = 'errorBdr txtBox100px marRight10px';
		document.getElementById('date_range_error').innerHTML = "Please enter From date";
		document.getElementById('noOfCoupons_error').innerHTML = "";
		document.getElementById('schemeName_error').innerHTML = "";
		return false;
	}
	else if(toDate == '')
	{
		document.getElementById('dateTo').className = 'errorBdr txtBox100px marRight10px';
		document.getElementById('date_range_error').innerHTML = "Please enter To date";
		document.getElementById('noOfCoupons_error').innerHTML = "";
		document.getElementById('schemeName_error').innerHTML = "";
		return false;
	}
	else if(Date.parse(fromDate) > Date.parse(toDate))
	{
		document.getElementById('dateFrom').className = 'errorBdr txtBox100px marRight10px';
		document.getElementById('dateTo').className = 'errorBdr txtBox100px marRight10px';
		document.getElementById('date_range_error').innerHTML = "From date should be lesser than To date";
		document.getElementById('noOfCoupons_error').innerHTML = "";
		document.getElementById('schemeName_error').innerHTML = "";
		return false;
	}
	else if(discountType == 'amount' && discountAmount == '')
	{
		
		document.getElementById('discountAmount').className = 'errorBdr txtBox50px';
		document.getElementById('discountAmount_error').innerHTML = "Please enter discount amount";
		document.getElementById('date_range_error').innerHTML = "";
		document.getElementById('date_range_error').innerHTML = "";
		document.getElementById('noOfCoupons_error').innerHTML = "";
		document.getElementById('schemeName_error').innerHTML = "";
		return false;
		
	}
	else if(discountType == 'percentage' && discountPercentage == '')
	{
		
		document.getElementById('discountPercentage').className = 'errorBdr txtBox50px';
		document.getElementById('discountPercentage_error').innerHTML = "Please enter discount percentage";
		document.getElementById('date_range_error').innerHTML = "";
		document.getElementById('date_range_error').innerHTML = "";
		document.getElementById('noOfCoupons_error').innerHTML = "";
		document.getElementById('schemeName_error').innerHTML = "";
		return false;
	}
	else if(toWhom == '')
	{
		document.getElementById('toWhom').className = 'errorBdr txtBox50px';
		document.getElementById('toWhom_error').innerHTML = "Please enter To Whom";
		
		if(discountType == 'amount'){
			document.getElementById('discountAmount').className = 'txtBox50px';
			document.getElementById('discountAmount_error').innerHTML = "";
		}else{
			document.getElementById('discountPercentage').className = 'txtBox50px';
			document.getElementById('discountPercentage_error').innerHTML = "";			
		}
		document.getElementById('date_range_error').innerHTML = "";
		document.getElementById('date_range_error').innerHTML = "";
		document.getElementById('noOfCoupons_error').innerHTML = "";
		document.getElementById('schemeName_error').innerHTML = "";
		return false;
	}
	else
	{
		return true;
	}
}