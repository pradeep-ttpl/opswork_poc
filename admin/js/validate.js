//Add New User validation
function addNewUserValidation()
{
	var firstName 	= document.getElementById('user_first_name').value;
	var lastName 	= document.getElementById('user_last_name').value;
	var email 		= document.getElementById('user_email').value;
	var mobile 		= document.getElementById('user_phone').value;
	var userType	= document.getElementById('user_type').value;
	var department	= document.getElementById('user_department').value;
	var role 		= document.getElementById('roles').value;
	var pwd	= document.getElementById('password').value;
	var confirmpwd	= document.getElementById('confirmpwd').value;
	
	$('input').removeClass('errorBdr');
	$('select').removeClass('errorBdr');
	
	if(trim(firstName)==''){
		document.getElementById('user_first_name_error').innerHTML = 'Enter First Name';
		document.getElementById('user_first_name').className = 'txtBox320px errorBdr';
		//$('html, body').animate({scrollTop: $("#defaultId").offset().top}, 2000);
		return false;
	}else if(trim(lastName)==''){
		document.getElementById('user_last_name_error').innerHTML = 'Enter Last Name';
		document.getElementById('user_last_name').className = 'txtBox320px errorBdr';
		//$('html, body').animate({scrollTop: $("#defaultId").offset().top}, 2000);
		return false;
	}else if(trim(mobile)==''){
		document.getElementById('user_phone_error').innerHTML = 'Enter mobile number';
		document.getElementById('user_phone').className = 'txtBox320px errorBdr';
		//$('html, body').animate({scrollTop: $("#defaultId").offset().top}, 2000);		
		return false;
	}
	else if(userType=='0'){
		document.getElementById('user_type_error').innerHTML = 'Select user type';
		document.getElementById('user_type').className = 'txtBox200px errorBdr';
		return false;
	}/*else if(department=='0'){
		document.getElementById('user_department_error').innerHTML = 'Choose department';
		document.getElementById('user_department').className = 'txtBox200px alignleft errorBdr';
		//$('html, body').animate({scrollTop: $("#user_mobile").offset().top}, 2000);
		return false;
	}else if(role=='0'){
		document.getElementById('user_role_error').innerHTML = 'Choose role';
		document.getElementById('roles').className = 'txtBox200px alignleft errorBdr';
		//$('html, body').animate({scrollTop: $("#user_mobile").offset().top}, 2000);
		return false;
	}else if(role == ''){
		var rolename = document.getElementById('Rolename').value;
		if(rolename != ''){
			document.getElementById('newRollError').innerHTML = 'Save new role and then proceed';
			document.getElementById('Rolename').className = 'txtBox320px alignleft errorBdr';
			document.getElementById('Rolename').scrollIntoView();
			return false;
		}else if(rolename == ''){
			document.getElementById('newRollError').innerHTML = 'Enter new role';
			document.getElementById('Rolename').className = 'txtBox320px alignleft errorBdr';
			document.getElementById('Rolename').scrollIntoView();
			return false;
		}
	}*/
	else if(trim(email)==''){
		document.getElementById('user_email_error').innerHTML = 'Enter email';
		document.getElementById('user_email').className = 'txtBox320px errorBdr';
		//$('html, body').animate({scrollTop: $("#defaultId").offset().top}, 2000);
		return false;
	}

	if(pwd.length < 6){
		document.getElementById('password_error').innerHTML = 'Password should be minimum 6 characters';
		document.getElementById('password').className = 'txtBox320px errorBdr';
		return false;
	}else{
		document.getElementById('password_error').innerHTML = '';
		document.getElementById('password').className = 'txtBox320px';
	}
	
	if(pwd != confirmpwd)
	{
		document.getElementById('confirmpwd_error').innerHTML = 'Password and Confirm password mismatch';
		document.getElementById('confirmpwd').className = 'txtBox320px errorBdr';
		return false;
	}else{
		document.getElementById('confirmpwd_error').innerHTML = '';
		document.getElementById('confirmpwd').className = 'txtBox320px';
	}	
	document.getElementById('subscribeLoader').style.display = 'block';
	return true;
}