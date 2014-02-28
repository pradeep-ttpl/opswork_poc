// for errror messages lang option
document.write('<scr'+'ipt type="text/javascript" src="/js/error_messages.js" ></scr'+'ipt>');

//For home page Tabs for dealing forms
function tabSwitch(new_tab, new_content) {
	document.getElementById('content_1').style.display = 'none';  
	document.getElementById('content_2').style.display = 'none';                
	document.getElementById(new_content).style.display = 'block';
	document.getElementById('tab_1').className = '';  
	document.getElementById('tab_2').className = '';                 
	document.getElementById(new_tab).className = 'active';      
}  

$(document).ready(function()
{
	// Added by Ramesh Raja 16 Nov 2012
	$("#loginform").submit(function()
	{
		var email	 			= $('input[name=email]');
		var pwd 				= $('input[name=pwd]');
		var lang 				= $('input[name=lang]');
		var emailFilter=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;				
			
		document.getElementById('error_msg').innerHTML  = '&nbsp;';
		$('input').removeClass('errorBdr');
		
		if (email.val() == 0)	
		{
			document.getElementById('email').className = 'errorBdr txtBox245px';
			errorMsg('error_msg','ENTER_EMAIL',lang.val());	
			return false;
		}
		
		if(email.val() != 0)
		{
			if(!(emailFilter.test(email.val()))) 
			{
				document.getElementById('email').className = 'errorBdr txtBox245px';
				errorMsg('error_msg','TAX_EMAIL_INVALID',lang.val());	
				return false;
			}
		}
		
		if(pwd.val() == 0)
		{
			document.getElementById('pwd').className = 'errorBdr txtBox245px';
			errorMsg('error_msg','TAX_PASSWORD_INVALID',lang.val());
//			errorMsg('error_msg','ENTER_PASSWORD',lang.val());
			return false;
		}
		
		if(pwd.val() != 0)
		{
			if ((pwd.val().length < 6)) 
			{				
				document.getElementById('pwd').className = 'errorBdr txtBox245px';
				errorMsg('error_msg','TAX_PASSWORD_INVALID',lang.val());
				return false;				
			} 
		}
	});
	
	//Registration validation
	$("#registerform").submit(function()
	{
		var firstname 			= $('input[name=firstname]');	
		var lastname 			= $('input[name=lastname]');
		var email	 			= $('input[name=email]');
//		var Conemail	 		= $('input[name=cEmail]');
		var pwd 				= $('input[name=pwd]');
//		var cpwd 				= $('input[name=cpwd]');
//		var countryCode			= $('input[name=countryCode]');
//		var phone 				= $('input[name=phone]');	
		var captcha 			= $('input[name=captcha]');	
		var termcon 			= $('input[name="termcon"]:checked');
		var lang 				= $('input[name=lang]');
		var emailFilter=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;				
		var phoneFilter = /^\+{0,1}[0-9- ]+(,[0-9- ]+)*$/;
		
		$('input').removeClass('errorBdr');
		document.getElementById('error_msg').innerHTML  = '';
		
		if (firstname.val()  == 0) 
		{
			document.getElementById('firstname').className = 'errorBdr txtBox320px';
			errorMsg('error_msg','FULLNAME_ERROR',lang.val());
			return false;
		} 
		
		if (lastname.val() == 0) 
		{
			document.getElementById('lastname').className = 'errorBdr txtBox320px';	
			errorMsg('error_msg','LASTNAME_ERROR',lang.val());
			return false;
		} 

		if (email.val() ==0) 
		{
			document.getElementById('email').className = 'errorBdr txtBox320px';
			errorMsg('error_msg','ENTEREMAIL_ERROR',lang.val());
			return false;
		} 
		
		if(!(emailFilter.test(email.val()))) 
		{
			document.getElementById('email').className = 'errorBdr txtBox320px';
			errorMsg('error_msg','EMAILFORMAT_ERROR',lang.val());		
			return false;
		}
		
//		if (Conemail.val() ==0) 
//		{
//			document.getElementById('cEmail').className = 'errorBdr txtBox320px';
//			errorMsg('error_msg','REENTER_EMAIL',lang.val());	
//			return false;
//		} 
//		
//		if(email.val() != Conemail.val())
//		{
//			document.getElementById('cEmail').className = 'errorBdr txtBox320px';
//			errorMsg('error_msg','TAX_MISMATCH_EMAIL',lang.val());							
//			return false;					
//		}
		
		if (pwd.val() ==0) 
		{
			document.getElementById('pwd').className = 'errorBdr txtBox320px';
			errorMsg('error_msg','TAX_PASSWORD_INVALID',lang.val());
			return false;
		} 
		
		if (pwd.val().length < 6) 
		{				
			document.getElementById('pwd').className = 'errorBdr txtBox320px';
			errorMsg('error_msg','TAX_PASSWORD_LENGTH',lang.val());							
			return false;				
		}
		
//		if (cpwd.val() ==0) 
//		{
//			document.getElementById('cpwd').className = 'errorBdr txtBox320px';
//			errorMsg('error_msg','REENTER_PASSWORD',lang.val());	
//			return false;
//		} 
//		
//		if(pwd.val() != cpwd.val())
//		{
//			document.getElementById('cpwd').className = 'errorBdr txtBox320px';
//			errorMsg('error_msg','TAX_MISMATCH_PASSWORD',lang.val());							
//			return false;					
//		}
		
//		if(countryCode.val() == 0)
//		{
//			document.getElementById('countryCode').className = 'errorBdr txtBox50px';
//			errorMsg('error_msg','COUNTRYCODE_ERROR',lang.val());
//			return false;
//		}
		
//		if(phone.val() == 0)
//		{
//			document.getElementById('phone').className = 'errorBdr txtBox150px';
//			errorMsg('error_msg','ENTER_PHONE',lang.val());
//			return false;
//		}
//		
//		if(!(phoneFilter.test(phone.val())) || phone.val().length < 10)
//		{
//			document.getElementById('phone').className = 'errorBdr txtBox150px';
//			errorMsg('error_msg','TAX_PHONE_VALID',lang.val());								
//			return false;
//		}
		
		if (captcha.val()  == 0) 
		{
			document.getElementById('captcha').className = 'errorBdr txtBox150px alignleft marLeft3px';
			errorMsg('error_msg','CAPTCHA_ERROR',lang.val());	
			return false;
		} 
		var returnFlag = false;
		if(captcha.val() != 0)
		{	
			captchaValue = captcha.val();
			var postParams = 'captchaValue='+captchaValue+'&type=checkCaptcha';
			$.ajax({ type: "POST",async:false, url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				if(parseInt(data) > 0)
				{
					returnFlag = false;
					document.getElementById('captcha').className = 'errorBdr txtBox150px alignleft marLeft3px';
					errorMsg('error_msg','WRONG_CAPTCHA_ERROR',lang.val());
				}
				else 
				{
					returnFlag = true;
					$("#anchorId").fancybox().trigger('click');
				}
			}
			});
		}
		return returnFlag;
	});
	
	$("#forgotpwdform").submit(function()
	{
		var email	 			= $('input[name=email]');	
		var lang 				= $('input[name=lang]');
		var emailFilter=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;				
		
		$('input').removeClass('errorBdr');
		document.getElementById('error_msg').innerHTML  = '';
		
		if (email.val() == 0)	
		{
			document.getElementById('email').className = 'errorBdr txtBox320px';	
			errorMsg('error_msg','TAX_VALIDATE_MSG',lang.val());			
			return false;		
		}
		else if(!(emailFilter.test(email.val()))) 
		{
			document.getElementById('email').className = 'errorBdr txtBox320px';
			errorMsg('error_msg','TAX_EMAIL_INVALID',lang.val());				
			return false;
		}
		
		$("#anchorId").fancybox().trigger('click');
	});
	
	
	$("#changepwdform").submit(function()
	{
		var pwd	 			= $('input[name=pwd]');	
		var cpwd	 		= $('input[name=cpwd]');	
		var lang 			= $('input[name=lang]');						
		
		$('input').removeClass('errorBdr');
		document.getElementById('error_msg').innerHTML  = '';
		
		if(document.getElementById('pwd')!=null)
		{
			var currentPwd	 	= $('input[name=currentPwd]');
			
			if (currentPwd.val() ==0) 
			{
				document.getElementById('currentPwd').className = 'errorBdr txtBox320px';
				errorMsg('error_msg','TAX_VALIDATE_MSG',lang.val());			
				return false;
			} 
		}
		
		if (pwd.val() ==0) 
		{
			document.getElementById('pwd').className = 'errorBdr txtBox320px';
			errorMsg('error_msg','TAX_VALIDATE_MSG',lang.val());			
			return false;
		} 
		
		if (pwd.val().length < 6) 
		{				
			document.getElementById('pwd').className = 'errorBdr txtBox320px';
			errorMsg('error_msg','TAX_PASSWORD_LENGTH',lang.val());							
			return false;				
		}
		
		if (cpwd.val() ==0) 
		{
			document.getElementById('cpwd').className = 'errorBdr txtBox320px';
			errorMsg('error_msg','TAX_VALIDATE_MSG',lang.val());			
			return false;
		} 
		
		if(pwd.val() != cpwd.val())
		{
			document.getElementById('cpwd').className = 'errorBdr txtBox320px';
			errorMsg('error_msg','TAX_MISMATCH_PASSWORD',lang.val());							
			return false;					
		}
		
	});
	
	$("#businessinfoform").submit(function()
	{
		var bizName 			= $('input[name=bizName]');	
		var bizType 			= $('select[name=bizType]');
		var EIN			 		= $('input[name=bizEIN]');
		var bizAddress1	 		= $('input[name=addressLine1]');
		var bizCountry 			= $('select[name=bizCountry]');
		var bizCity				= $('input[name=bizCity]');
		var bizZip 				= $('input[name=bizZip]');
		var bizPhone			= $('input[name=phone]');
		var bizEmail			= $('input[name=email]');
		var sAname 				= $('input[name=sAname]');	
		var sAtitle 			= $('input[name=sAtitle]');		
		var sAphone 			= $('input[name=sAphone]');	
		var sApin 				= $('input[name=sApin]');
		var lang 				= $('input[name=lang]');
		var bizState 			= $('select[name=bizselectState]');
		var tPdName 			= $('select[name=tPdName]');
		var tPdPhone 			= $('select[name=tPdPhone]');
		var tPdPin 				= $('select[name=tPdPin]');
		var ownerFirstName		= $('select[name=ownerFirstName]');
		var ownerLastName 		= $('select[name=ownerLastName]');
		
		var phoneFilter 		= /^(\()?\d{3}(\))?(-|\s)?\d{3}(-|\s)?\d{4}$/;
		var emailFilter			= /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;	
		var alphachar 			= /^(\s*)(\b[a-zA-Z\- ]*)$/;
		
		$('input').removeClass('loginTxtBoxErr');
		$('select').removeClass('loginTxtBoxErr');
		document.getElementById('error_msg').style.display  = '';
		
		if (bizName.val()  == 0) 
		{	
			document.getElementById('bizName').className = 'loginTxtBoxErr txtBox320px';	
			errorMsg('error_msg','ENTER_BIZNAME',lang.val());	
			return false;
		}

		if (isNaN(bizType.val()) || bizType.val() == 0) 
		{
			document.getElementById('bizType').className = 'loginTxtBoxErr txtBox320px';	
			errorMsg('error_msg','SELECT_BIZTYPE',lang.val());
			return false;
		} 
		
		if (bizType.val()  == 1) 
		{
			if (document.getElementById('ownerFirstName').value  == 0) 
			{	
				document.getElementById('ownerFirstName').className = 'loginTxtBoxErr txtBox150px';
				errorMsg('error_msg','OWNER_FIRST_NAME',lang.val());
				return false;
			} 
			
			if (document.getElementById('ownerLastName').value  == 0) 
			{	
				document.getElementById('ownerLastName').className = 'loginTxtBoxErr txtBox150px';
				errorMsg('error_msg','OWNER_LAST_NAME',lang.val());
				return false;
			} 
		}
		
		if (EIN.val()  == 0) 
		{
			document.getElementById('bizEIN').className = 'loginTxtBoxErr txtBox150px';	
			errorMsg('error_msg','ENTER_EIN',lang.val());
			return false;
		}
		
		if (EIN.val().length < 10) 
		{
			document.getElementById('bizEIN').className = 'loginTxtBoxErr txtBox150px';	
			errorMsg('error_msg','ENTER_EIN',lang.val());
			return false;
		}
		
		if (bizAddress1.val() == 0) 
		{
			document.getElementById('addressLine1').className = 'loginTxtBoxErr txtBox320px';
			errorMsg('error_msg','ENTER_ADDRESS',lang.val());
			return false;
		} 
		
		if (bizCountry.val() == 0) 
		{
			document.getElementById('bizCountry').className = 'loginTxtBoxErr txtBox320px';	
			errorMsg('error_msg','SELECT_COUNTRY',lang.val());
			return false;
		} 
		
		if (bizState.val() == 0) 
		{
			document.getElementById('bizselectState').className = 'loginTxtBoxErr txtBox320px';
			errorMsg('error_msg','SELECT_STATE',lang.val());
			return false;
		} 
					
		if(bizCity.val() == 0)
		{
			document.getElementById('bizCity').className = 'loginTxtBoxErr txtBox320px';
			errorMsg('error_msg','ENTER_CITY',lang.val());
			return false;
		}
		
		if(bizZip.val() == 0)
		{
			document.getElementById('bizZip').className = 'loginTxtBoxErr txtBox150px';
			errorMsg('error_msg','ENTER_ZIP',lang.val());
			return false;
		}
		if (bizZip.val().length < 5) 
		{
			document.getElementById('bizZip').className = 'loginTxtBoxErr txtBox150px';
			errorMsg('error_msg','ENTER_VALID_ZIP',lang.val());
			return false;
		}
		
		if( bizCountry.val() == '1')
		{	
//			var zipcodeFilter 		= new RegExp("^[0-9]+$");
			
			var zipcodeFilter       = /^[0-9]{5}(([0-9]{4})|([0-9]{7}))?$/;
			
			var USCityPattern		= /^([A-Za-z] ?)*[A-Za-z]$/;
			
			if(bizZip.val().length > 5) 
			{
				document.getElementById('bizZip').className = 'loginTxtBoxErr txtBox150px';
				errorMsg('error_msg','ENTER_VALID_ZIP',lang.val());
				return false;
			}
			if(!(zipcodeFilter).test(bizZip.val()))
			{
				document.getElementById('bizZip').className = 'loginTxtBoxErr txtBox150px';
				errorMsg('error_msg','ENTER_VALID_ZIP',lang.val());
				return false;
			}
			if(bizCity.val().length > 22) 
			{
				document.getElementById('bizCity').className = 'loginTxtBoxErr txtBox150px';
				errorMsg('error_msg','TAX_BIZ_CITY',lang.val());
				return false;
			}
			if(!(USCityPattern).test(bizCity.val()))
			{	
				document.getElementById('bizCity').className = 'loginTxtBoxErr txtBox150px';
				errorMsg('error_msg','TAX_BIZ_CITY',lang.val());
				return false;
			}
			
		}
	
		if (bizPhone.val()  == 0) 
		{
			document.getElementById('phone').className = 'loginTxtBoxErr txtBox150px';
			errorMsg('error_msg','ENTER_PHONE_NUMBER',lang.val());
			return false;
		}
		
		if(!(phoneFilter.test(bizPhone.val())) || bizPhone.val().length < 12)
		{
			document.getElementById('phone').className = 'loginTxtBoxErr txtBox150px';
			errorMsg('error_msg','ENTER_VALID_PHONE_NUMBER',lang.val());
			return false;
		}
		
		if (bizEmail.val()  == 0) 
		{
			document.getElementById('email').className = 'loginTxtBoxErr txtBox320px';
			errorMsg('error_msg','ENTEREMAIL_ERROR',lang.val());
			return false;
		} 
		
		if(!(emailFilter.test(bizEmail.val()))) 
		{
			document.getElementById('email').className = 'loginTxtBoxErr txtBox320px';
			errorMsg('error_msg','TAX_EMAIL_INVALID',lang.val());
			return false;
		}
		
		if(sAname.val() == 0)
		{
			document.getElementById('sAname').className = 'loginTxtBoxErr txtBox320px';
			errorMsg('error_msg','ENTER_SA_NAME',lang.val());
			return false;
		}
		
		if (sAtitle.val()  == 0) 
		{
			document.getElementById('sAtitle').className = 'loginTxtBoxErr txtBox320px';
			errorMsg('error_msg','ENTER_SA_TITLE',lang.val());
			return false;
		} 
		
		if (sAphone.val()  == 0) 
		{
			document.getElementById('sAphone').className = 'loginTxtBoxErr txtBox150px';
			errorMsg('error_msg','ENTER_SA_PHONE',lang.val());
			return false;
		}
		
		if(sAphone.val().length < 12)
		{
			document.getElementById('sAphone').className = 'loginTxtBoxErr txtBox150px';
			errorMsg('error_msg','ENTER_VALID_PHONE_NUMBER',lang.val());
			return false;
		}
		
		if (sApin.val()  == '') 
		{
			document.getElementById('sApin').className = 'loginTxtBoxErr txtBox150px';
			errorMsg('error_msg','ENTER_SA_PIN',lang.val());
			return false;
		} 
		
		if (sApin.val().length < 5) 
		{
			document.getElementById('sApin').className = 'loginTxtBoxErr txtBox150px';
			errorMsg('error_msg','ENTER_VALID_SA_PIN',lang.val());
			return false;
		}
		
		if(document.getElementById('thirdPartyCheckBox').checked == true)
		{
			if (document.getElementById('tPdName').value  == 0) 
			{	
				document.getElementById('tPdName').className = 'loginTxtBoxErr txtBox320px';
				errorMsg('error_msg','ENTER_DES_NAME',lang.val());
				return false;
			} 
			
			if (document.getElementById('tPdPhone').value  == 0) 
			{	
				document.getElementById('tPdPhone').className = 'loginTxtBoxErr txtBox150px';
				errorMsg('error_msg','ENTER_DES_PHONE',lang.val());
				return false;
			} 
			
			if (document.getElementById('tPdPhone').value.length < 12) 
			{	
				document.getElementById('tPdPhone').className = 'loginTxtBoxErr txtBox150px';
				errorMsg('error_msg','ENTER_VALID_DES_PHONE',lang.val());
				return false;
			}
			
			if (document.getElementById('tPdPin').value  == 0) 
			{	
				document.getElementById('tPdPin').className = 'loginTxtBoxErr txtBox150px';
				errorMsg('error_msg','ENTER_DES_PIN',lang.val());
				return false;
			}
			
			if (document.getElementById('tPdPin').value.length < 5) 
			{	
				document.getElementById('tPdPin').className = 'loginTxtBoxErr txtBox150px';
				errorMsg('error_msg','ENTER_VALID_DES_PIN',lang.val());
				return false;
			}
			
		}
		
	});

});

function registerCancel()
{
	window.location.href = '/';
}

//phone munber validation
function autoMask(field, event, sMask) 
{
	var KeyTyped = String.fromCharCode(getKeyCode(event));
	var targ = getTarget(event);
	keyCount = targ.value.length;
	
	if(KeyTyped == '#')
		return false;
		
	if (getKeyCode(event) < 32)
	{
	    return true;
	}
	if(keyCount == sMask.length && getKeyCode(event) > 32)
	{
	    return false;
	}
	if ((sMask.charAt(keyCount+1) != '#') && (sMask.charAt(keyCount+1) != 'A' ) && (sMask.charAt(keyCount+1) != 'S' ) && (sMask.charAt(keyCount+1) != '~' ))
	{
		if ((sMask.charAt(keyCount) == '#') && !(isNumeric(KeyTyped)))
		return false;
		
	    field.value = field.value + KeyTyped + sMask.charAt(keyCount+1);
	    return false;
	}
	
	if (sMask.charAt(keyCount) == '*')
	    return true;
	
	if (sMask.charAt(keyCount) == KeyTyped)
	{
	    return true;
	}
	
	if ((sMask.charAt(keyCount) == '~') && isNumeric_plusdash(KeyTyped))
	    return true;
	
	if ((sMask.charAt(keyCount) == '#') && isNumeric(KeyTyped))
	    return true;
	
	if ((sMask.charAt(keyCount) == 'A') && isAlpha(KeyTyped))
	    return true;

	if((sMask.charAt(keyCount) == 'S') && isAlpha_space(KeyTyped))
	{
		return true;
	}
	
	if ((sMask.charAt(keyCount+1) == '?') )
	{
	    field.value = field.value + KeyTyped + sMask.charAt(keyCount+1);
	    return true;
	}

	return false;
}

function getTarget(e) {
    // IE5
    if (e.srcElement) {
        return e.srcElement;
    }
    if (e.target) {
        return e.target;
    }
}

function getKeyCode(e) {
    //IE5
    if (e.srcElement) {
        return e.keyCode
    }
    // NC5
    if (e.target) {
        return e.which
    }
}

function isNumeric(c)
{
    var sNumbers = "01234567890";
    if (sNumbers.indexOf(c) == -1)
        return false;
    else
        return true;


}

function isNumeric_plusdash(c)
{
    var sNumbers = "01234567890-";
    if (sNumbers.indexOf(c) == -1)
        return false;
    else
        return true;


}

function isAlpha(c)
{
    var lCode = c.charCodeAt(0);
    if (lCode >= 65 && lCode <= 122 )
    {
        return true;
    }
    else
        return false;
}

function isAlpha_space(c)
{
    var lCode = c.charCodeAt(0);
    if (lCode >= 65 && lCode <= 122 || lCode == 32)
    {
        return true;
    }
    else
        return false;
}
	
//It will allow to enter Alphabets, numbers without special characters and space
function alphaNumericWOSpecChar(evt,id,inputClass,errorInputClass,errorId,errorMessage)
{
	var letters 	= /^[A-Za-z0-9\b\ \t]+$/;
	var stringName 	= document.getElementById(id).value;

	if(stringName !='' && !(letters.test(stringName))){
		var len = stringName.length;
		document.getElementById(id).value = stringName.substr(0,len-1);
		document.getElementById(id).className = errorInputClass;
		document.getElementById(errorId).innerHTML = errorMessage;
		return false;
	}else{
		document.getElementById(id).className = inputClass;
		return true;
	}
}

//It will accept alphanumeric characters, hyphen, hash, parentheses, ampersand, apostrophe and spaces.
function alphaNumericWOSpecCharWIHyphen(evt,id,inputClass,errorInputClass,errorId,errorMessage)
{
	var pattern 	= /^[A-Za-z0-9\b\ \t\.\#\&\-\'\"\(\)]+$/;
	//var pattern     = /^(([A-Za-z0-9#\-\(\)]|&#x26;|&#x27;) ?)*([A-Za-z0-9#\-\(\)]|&#x26;|&#x27;)$/;
	
	var stringName 	= document.getElementById(id).value;

	if(stringName !='' && !(pattern.test(stringName))){
		document.getElementById(id).className = errorInputClass;
		document.getElementById(errorId).innerHTML = errorMessage;
		document.getElementById(id).value = '';
		return false;
	}else{
		document.getElementById(id).className = inputClass;
		document.getElementById(errorId).innerHTML = '';
		return true;
	}
}

function checkName(evt,id,inputClass,errorInputClass,errorId,errorMessage)
{
	var pattern     = /^([A-Za-z0-9'\-] ?)*[A-Za-z0-9'\-]$/;
	
	var stringName 	= document.getElementById(id).value;

	if(stringName !='' && !(pattern.test(stringName))){
		document.getElementById(id).className = errorInputClass;
		document.getElementById(errorId).innerHTML = errorMessage;
		document.getElementById(id).value = '';
		return false;
	}else{
		document.getElementById(id).className = inputClass;
		document.getElementById(errorId).innerHTML = '';
		return true;
	}
}

function validateCity(evt,id,inputClass,errorInputClass,errorId,errorMessage)
{
	var stringName 	= document.getElementById(id).value;
	var bizCountry 	= document.getElementById('bizCountry').value;
	var pattern     = /^([A-Za-z] ?)*[A-Za-z]$/;
	
	if(bizCountry == 1)
	{	
		if(stringName !='' && !(pattern.test(stringName))){
			document.getElementById(id).className = errorInputClass;
			document.getElementById(errorId).innerHTML = errorMessage;
			document.getElementById(id).value = '';
			return false;
		}else{
			document.getElementById(id).className = inputClass;
			document.getElementById(errorId).innerHTML = '';
			return true;
		}
	}
	else
	{
		return true;
	}
}

function checkAddress(evt,id,inputClass,errorInputClass,errorId,errorMessage)
{  
	var pattern     = /^[A-Za-z0-9]( ?[A-Za-z0-9\-/])*$/;
	
	var stringName 	= document.getElementById(id).value;

	if(stringName !='' && !(pattern.test(stringName))){
		document.getElementById(id).className = errorInputClass;
		document.getElementById(errorId).innerHTML = errorMessage;
		document.getElementById(id).value = '';
		return false;
	}else{
		document.getElementById(id).className = inputClass;
		document.getElementById(errorId).innerHTML = '';
		return true;
	}
}

//To check Bank Name
function checkBankName(evt,id,inputClass,errorInputClass,errorId,errorMessage)
{
	var letters 	= /^[A-Za-z0-9\b\ \t\@\&\-\_\,\'\"\(\)]+$/;
	var stringName 	= document.getElementById(id).value;

	if(stringName !='' && !(letters.test(stringName))){
		var len = stringName.length;
		document.getElementById(id).value = stringName.substr(0,len-1);
		document.getElementById(id).className = errorInputClass;
		document.getElementById(errorId).innerHTML = errorMessage;
		return false;
	}else{
		document.getElementById(id).className = inputClass;
		return true;
	}
}

//To Check Bank Account Number - alphanumeric characters with hyphens
function toCheckBankAccNo(evt,id,inputClass,errorInputClass,errorId,errorMessage)
{
	var letters 	= /^[A-Za-z0-9\-]+$/;
	
	var stringName 	= document.getElementById(id).value;

	if(stringName !='' && !(letters.test(stringName))){
		var len = stringName.length;
		document.getElementById(id).value = stringName.substr(0,len-1);
		document.getElementById(id).className = errorInputClass;
		document.getElementById(errorId).innerHTML = errorMessage;
		return false;
	}else{
		document.getElementById(id).className = inputClass;
		return true;
	}
}

//To check Routing Transit Number - beginning with 01 through 12, or 21 through 32
function toCheckRoutingNo(evt,id,inputClass,errorInputClass,errorId,errorMessage)
{
	var letters		= /^(01|02|03|04|05|06|07|08|09|10|11|12|21|22|23|24|25|26|27|28|29|30|31|32)[0-9]{7}$/;
						
	var stringName 	= document.getElementById(id).value;

	if(stringName !='' && !(letters.test(stringName))){
		var len = stringName.length;
		document.getElementById(id).value = stringName.substr(0,len-1);
		document.getElementById(id).className = errorInputClass;
		document.getElementById(errorId).innerHTML = errorMessage;
		document.getElementById(id).value = '';
		return false;
	}else{
		document.getElementById(id).className = inputClass;
		return true;
	}
	
}

//It will allow to enter Alphabets, whitspace only.
function alphabetsOnly(evt,id,inputClass,errorInputClass,errorId,errorMessage)
{
//	var letters 	= /^[a-zA-Z ]+$/;
	
	var letters 	= /^(([A-Za-z0-9#\-\(\)]|&|') ?)*([A-Za-z0-9#\-\(\)]|&|')+$/;
	
	var stringName 	= document.getElementById(id).value;
	
	if(stringName !='' && !(letters.test(stringName))){
		var len = stringName.length;
//		document.getElementById(id).value = stringName.substr(0,len-1);
		document.getElementById(id).value = '';
		document.getElementById(id).className = errorInputClass;
		document.getElementById(errorId).innerHTML = errorMessage;
		return false;
	}else{
		document.getElementById(id).className = inputClass;
		return true;
	}	
}

function getThirdPartyInfo()
{
	if(document.getElementById('thirdPartyCheckBox').checked == true)
	{	
		document.getElementById('thirdPartyDisplayId').style.display = 'block';
		document.getElementById('checkboxId').value = '1';
	}
	else
	{
		document.getElementById('thirdPartyDisplayId').style.display = 'none';
		document.getElementById('checkboxId').value = '0';
	}
}

//Fetching the state list
function fetchState(countryID,stateName)
{
	var type = 'selectstates';
	var postParams = 'type='+type+'&countryID='+countryID+'&stateName='+stateName;
	
	$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
//			document.getElementById('bizselectState').innerHTML = data;
			$('#bizselectState').html(data);
		}
	});
}

//To delete business
function deletebusiness(businessid)
{
	var ibox = confirm("Deleting Business, Tax Return Information Will Be Lost");		
	if( ibox == false )		
	{	
		return false;		
	}
	else
	{
		var type = 'deletebusinessinfo';
		var postParams = '&businessid='+businessid +'&type='+type;
		
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			window.location.reload();
		}
		});
	}
}

function selectedbusiness(business,count)
{
	var type = 'selectedbussiness';
	var postParams = 'type='+type+'&business='+business;
	$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			var url = location.protocol +"//"+ location.host+'/taxyear/';
			window.location.href = url;
		}
	});
}


function checkEIN(id,einNo,previousEin)
{
	var type = 'checkEIN';
	var postParams = 'type='+type+'&einNo='+einNo+'&previousEin='+previousEin;
	$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			if(data>0)
			{
				document.getElementById(id).value = '';
				document.getElementById(id).className = 'errorBdr txtBox150px';
				document.getElementById('EINerror').innerHTML = "EIN already exists";
			}
		}
	});
}
/**
 * Calling the function to enable the errorSpan
 * 
 * @param id
 * @param errtextboxstyle
 * @param ErrorMessage
 * @param errorSpan
 */
function enableErrorSpan(id,errtextboxstyle,ErrorMessage,errorSpan)
{
	document.getElementById(errorSpan).innerHTML = ErrorMessage;
	document.getElementById(errorSpan).style.display = '';
	document.getElementById(id).className=errtextboxstyle;
	//setAttributeToAnElement(id,"title",ErrorMessage);
// document.getElementById(id).value='';
}

/**
 * Calling the function to disable the errorSpan
 * 
 * @param id
 * @param textboxstyle
 * @param errorSpan
 */
function disableErrospan(id,textboxstyle,errorSpan)
{
	document.getElementById(errorSpan).innerHTML = "";
	document.getElementById(errorSpan).style.display = 'none';
	document.getElementById(id).className=textboxstyle;
	//setAttributeToAnElement(id,"title","");	
}

function CheckForInt(evt, id,inputClassName,errorClassName,errorspanId,errorMessage) 
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	num = (charCode >= 48 && charCode <= 57)||(charCode==8)||(charCode==13)||(charCode==9);
	if (!num) {
		if(errorMessage=='0')
		{
		errorMessage = dispMessages[0];
		}
		enableErrorSpan(id,errorClassName,errorMessage,errorspanId);
		return false;
	} else {
		
		disableErrospan(id,inputClassName,errorspanId);
		return (true);
	}

}

//Author - Ramesh Raja - 19th July 2012
//Function to call ajax to generate tax filing month respect to year selected
function calculateMonth()
{
	var type = 'changetaxmonth';
	
	var e = document.getElementById("taxyear");
	var year = e.options[e.selectedIndex].value;
	var selectedForm = document.getElementById('taxForm').value;
	
	if((document.getElementById('taxForm').value == 0) || (document.getElementById('taxyear').value == 0))
	{  
		document.getElementById('month_select_area').innerHTML = '<select id="taxmonth" name="taxmonth" class="txtBox150px"><option value="0">Select Month</option></select>';
	}
	else
	{
		var postParams = 'type='+type+'&year='+year+'&monthType=firstUsed';
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				document.getElementById('month_select_area').innerHTML = data;
			}
		});
	}
	
	if(selectedForm == '2290A1' || selectedForm == '2290A2')
	{
		document.getElementById('amendMentMonthArea').style.display = '';
		
		var type = 'changetaxmonth';
		var e = document.getElementById("taxyear");
		var year = e.options[e.selectedIndex].value;
		
		if(document.getElementById('taxyear').value == 0)
		{  	
			document.getElementById('amendmentMonth_select_area').innerHTML = '<select id="taxmonth" name="taxmonth" class="txtBox150px"><option value="0">Select Month</option></select>';
		}
		else
		{
			var postParams = 'type='+type+'&year='+year+'&monthType=amendmentMonth';
			$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
				success: function( data, textStatus )
				{
					document.getElementById('amendmentMonth_select_area').innerHTML = data;
				}
			});
		}
	}
}

//Author - Ramesh Raja - 19th July 2012
//Function to validate year and month selection in tax year filing
//Edited on - 20th Nov 2013 - Ramesh Raja
function validateTaxFilingYear()
{
	var biz = document.getElementById('business').value;
	var month = document.getElementById('taxmonth').value;
	var formType = document.getElementById('taxForm').value;
	var year = document.getElementById('taxyear').value;
	
	var firstUsedYear = $("#taxmonth option:selected").text().substring(0, 4);
	
	
	if(document.getElementById('amendmentMonth')!=null){
		var amendMonth = document.getElementById('amendmentMonth').value;
		var amendYear = $("#amendmentMonth option:selected").text().substring(0, 4);
	}
	
	document.getElementById('errorMsg').innerHTML  = '';
	$('input').removeClass('errorBdr');
	$('select').removeClass('errorBdr');
	
	if(biz == 0)
	{
		document.getElementById('errorMsg').innerHTML = "Please select business";
		document.getElementById('business').className = 'errorBdr txtBox320px';
		return false;
	}
	else if(formType == 0)
	{
		document.getElementById('errorMsg').innerHTML = "Please select form type";
		document.getElementById('taxForm').className = 'errorBdr txtBox320px';
		return false;
	}
	else if(formType != '8849S6')
	{
		if(year == 0)
		{
			document.getElementById('errorMsg').innerHTML = "Please select tax filing year";
			document.getElementById('taxyear').className = 'errorBdr txtBox150px';
			return false;
		}
		else if(month == 0)
		{
			document.getElementById('errorMsg').innerHTML = "Please select tax filing month";
			document.getElementById('taxmonth').className = 'errorBdr txtBox150px';
			return false;
		}
	}
	if(document.getElementById('amendmentMonth')!=null && document.getElementById('amendmentMonth').value == 0 && (formType == '2290A1' || formType == '2290A2'))
	{
		document.getElementById('errorMsg').innerHTML = "Please select amendment month";
		document.getElementById('amendmentMonth').className = 'errorBdr txtBox150px';
		return false;
	}
	else if(formType == '2290A1' || formType == '2290A2'){
		
		if(amendYear == firstUsedYear && amendMonth < month){
			document.getElementById('errorMsg').innerHTML = "Amendment month should not be less than first used month";
			document.getElementById('amendmentMonth').className = 'errorBdr txtBox150px';
			return false;
		}
		
		if(firstUsedYear < amendYear && month < amendMonth){
			document.getElementById('errorMsg').innerHTML = "Amendment month should not be less than first used month";
			document.getElementById('amendmentMonth').className = 'errorBdr txtBox150px';
			return false;
		}
		
		if(firstUsedYear > amendYear){
			document.getElementById('errorMsg').innerHTML = "Amendment month should not be less than first used month";
			document.getElementById('amendmentMonth').className = 'errorBdr txtBox150px';
			return false;
		}
	}
	else if(formType == '8849S6'){
		/*
		if(document.getElementById('earliestDateId')!=null && document.getElementById('earliestDateId').value == 0)
		{
			document.getElementById('errorMsg').innerHTML = "Select Earliest Date";
			document.getElementById('earliestDateId').className = 'errorBdr txtBox150px marRight10px';
			return false;
		}
		else if(document.getElementById('latestDateId')!=null && document.getElementById('latestDateId').value == 0)
		{
			document.getElementById('errorMsg').innerHTML = "Select Latest Date";
			document.getElementById('latestDateId').className = 'errorBdr txtBox150px marRight10px';
			return false;
		}
		else */ if(document.getElementById('taxYearEndMonth')!=null && document.getElementById('taxYearEndMonth').value == 0)
		{
			document.getElementById('errorMsg').innerHTML = "Select Tax Year End Month";
			document.getElementById('taxYearEndMonth').className = 'errorBdr txtBox150px';
			return false;
		}
	}
	else
	{
		return true;
	}
}
function vehicleInfo(liscenceId,errorId,inputClass)
{
	document.getElementById(errorId).innerHTML = '';
	if(document.getElementById('vin')!=null)
	document.getElementById('vin').className = inputClass;
	
	if(document.getElementById('VIN')!=null)
		document.getElementById('VIN').className = inputClass;
	
	var type = 'vehicleInfo';
	var postParams = 'liscenceId=' +liscenceId +'&type='+type;
	if(liscenceId>0)
	{
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				var splitData = data.split('~');
				
				if(document.getElementById('vin')!=null)
				document.getElementById('vin').value = splitData[0].replace(/\s/g, '');
				
				if(document.getElementById('VIN')!=null)
				document.getElementById('VIN').value = splitData[0].replace(/\s/g, '');
				
				if(document.getElementById('taxableWeight')!=null)
				document.getElementById('taxableWeight').value = splitData[1];
				
				if(document.getElementById('weight')!=null)
				document.getElementById('weight').value = splitData[1];
				
				if(splitData[2] == 'Y')
				{
					if(document.getElementById('yes')!=null)
					document.getElementById('yes').checked = 'checked';
					
					if(document.getElementById('loggingyes')!=null)
					document.getElementById('loggingyes').checked = 'checked';
				}
				
				if(splitData[2] == 'N')
				{
					if(document.getElementById('no')!=null)
					document.getElementById('no').checked = 'checked';
					
					if(document.getElementById('loggingno')!=null)
					document.getElementById('loggingno').checked = 'checked';
				}
			}
		});
	}
	else
	{
		document.getElementById('vin').value = '';
		document.getElementById('taxableWeight').value = '';
		
		if(document.getElementById('yes')!=null)
		document.getElementById('yes').checked = 'checked';
			
		if(document.getElementById('loggingyes')!=null)
		document.getElementById('loggingyes').checked = 'checked';
	}
}
function validateSoldVhle(filingId,formType)
{
	var VIN	= document.getElementById('VIN').value;
	var weight	= document.getElementById('weight').value;
	var lossType	= document.getElementById('lossType').value;
	var firstyear	= document.getElementById('firstyear').value;
	var soldyear	= document.getElementById('soldyear').value;
	var explaination = document.getElementById('explanation').value;
	var uploadDocument = document.getElementById('document').value;
	var FileExtension = uploadDocument.split('.');
	var lang 		= $('input[name=lang]');
	
	var today = document.getElementById('serverTime').value;
	var currentYear = today.split('-')[0];
	var currentMonth = today.split('-')[1];
	
	var d = new Date();
	var currentMonth = d.getMonth()+1;
    var currentYear	 = d.getFullYear();
	var minimalFilingYear = '';
	if(currentMonth > 6){
		minimalFilingYear = (currentYear-2)+'-07-'+'01';
	}else{
		minimalFilingYear = (currentYear-3)+'-07-'+'01';
	}
	
	/*if(filingId!='' && formType == '2290')
	{
		var taxableInfoFlag = true;
		var postParams = 'filingId=' +filingId+'&type=checkTaxableCreditAmount';
		
		$.ajax({ type: "POST",async:false, url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				if(parseInt(data) == 0)
				taxableInfoFlag = false;
			}
		});
		
		if(taxableInfoFlag == false)
		{
			errorMsg('error_msg','NO_TAXABLE_VEHICLE_FOUND',lang.val());
			return false;
		}
	}*/
	
	if(uploadDocument != '')
	fileSize = document.getElementById('document').files[0].size;
	
	document.getElementById('error_msg').innerHTML  = '';
	$('input').removeClass('errorBdr');
	$('select').removeClass('errorBdr');
	$('textarea').removeClass('errorBdr');
	
	if (VIN==0) 
	{
		document.getElementById('VIN').className = 'errorBdr txtBox150px';
		errorMsg('error_msg','ENTERVIN',lang.val());
		return false;
	} 
	
	if(VIN.length !=17)
	{
		document.getElementById('VIN').className = 'errorBdr txtBox150px';
		errorMsg('error_msg','ENTER_VALID_VIN',lang.val());
		return false;
	}
	
	if (weight=='Select Weight' || weight == '') 
	{
		document.getElementById('weight').className = 'errorBdr txtBox150px';
		errorMsg('error_msg','ENTER_TAX_GROSWT',lang.val());
		return false;
	} 
	
	if(document.getElementById('loggingyes').checked == false 
			&& document.getElementById('loggingno').checked == false)
	{			
		errorMsg('error_msg','SELECT_LORNOT',lang.val());
		return false;
	}
	if (lossType=='') 
	{
		document.getElementById('lossType').className = 'errorBdr txtBox150px';
		errorMsg('error_msg','SELECT_LOSS_TYPE',lang.val());
		return false;
	} 
	
	if (firstyear =='') 
	{
		document.getElementById('firstyear').className = 'errorBdr txtBox150px marRight10px hasDatepicker';
		errorMsg('error_msg','SELECT_FIRST_USED_MONTH',lang.val());
		return false;
	}
	
	if(firstyear != '')
	{
		if(checkDateNotPresentPast('firstyear')){
			document.getElementById('firstyear').className = 'errorBdr txtBox150px marRight10px hasDatepicker';
			errorMsg('error_msg','FIRST_MONTH_NOT_SAMEYEAR',lang.val());
			return false;
		}
	} 
	
	if(soldyear == '')
	{
		document.getElementById('soldyear').className = 'errorBdr txtBox150px marRight10px hasDatepicker';
		errorMsg('error_msg','SELECT_STOLEN_DESTROY_DATE',lang.val());
		return false;
	}
	
	if(soldyear != '')
	{
		if(checkDateNotPresentPast('soldyear'))
		{
			document.getElementById('soldyear').className = 'errorBdr txtBox150px marRight10px hasDatepicker';
			errorMsg('error_msg','SOLD_DESTROYED_NOT_SAMEYEAR',lang.val());
			return false;
		}
	}
	
	/*if(firstyear >= soldyear)
	{
		document.getElementById('soldyear').className = 'errorBdr txtBox150px marRight10px hasDatepicker';
		errorMsg('error_msg','SOLDDESTROYED_WITHIN_TAXYEAR',lang.val());
		return false;		
	}*/
	if(Date.parse(firstyear) > Date.parse(soldyear)){
		document.getElementById('soldyear').className = 'errorBdr txtBox150px marRight10px hasDatepicker';
		errorMsg('error_msg','SOLDDESTROYED_GREATERTHAN_FIRSTUSED',lang.val());
		return false;
	}
	if(!checkTwoDates(firstyear,soldyear))
	{
		document.getElementById('soldyear').className = 'errorBdr txtBox150px marRight10px hasDatepicker';
		errorMsg('error_msg','SOLDDESTROYED_WITHIN_TAXYEAR',lang.val());
		return false;
	}
	
	if(Date.parse(minimalFilingYear) > Date.parse(firstyear)){
		document.getElementById('firstyear').className = 'errorBdr txtBox150px marRight10px hasDatepicker';
		errorMsg('error_msg','SOLDDESTROYED_WITHIN_THREE_TAXYEAR',lang.val());
		return false;
	}
	
	
	if(explaination == 0)
	{
		errorMsg('error_msg','ENTER_SOLD_EXPLANATION',lang.val());
		document.getElementById('explanation').className = 'textArea errorBdr';
		return false;
	}
	
	if(uploadDocument != '')
	{
		if(FileExtension[1]=="pdf")
		{
			if(fileSize > 2097152)
			{
				errorMsg('error_msg','UPLOAD_SIZE_EXCEEDED',lang.val());
				return false;
			}
		}
		else
		{
			errorMsg('error_msg','UPLOAD_FILE_TYPES',lang.val());
			return false;
		}
	}
	
	return true;
}

function checkDateNotPresentPast(id)
{
	var DateValue1 = document.getElementById(id).value;
	var dvals1 = DateValue1.split('-')[0];
	var dvals2 = DateValue1.split('-')[1]-1;
	var dvals3 = DateValue1.split('-')[2];
	var selectedDate = new Date(dvals1,dvals2,dvals3);
	
	var today = document.getElementById('serverTime').value;
	var tYear = today.split('-')[0];
	var tMonth = today.split('-')[1]-1;
	var tday = today.split('-')[2];
	var currentDate = new Date(tYear,tMonth,tday);
	
	if(selectedDate >= currentDate)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}


function checkPastDate(id){
	
	 var DateValue1 = document.getElementById(id).value;

	 var dvals1 = DateValue1.split('-')[0];
	 var dvals2 = DateValue1.split('-')[1]-1;
	 var dvals3 = DateValue1.split('-')[2];
	
	 var selectedDate = new Date(dvals1,dvals2,dvals3);
	 
	 var today = document.getElementById('serverTime').value;
	 var currentMonth = today.split('-')[1]-1;
	 var currentYear = today.split('-')[0];
	 var yearLimit;
	 
	 if(currentMonth < 6)
	 {
		 yearLimit = currentYear - 1;
	 }
	 else
	 {
		 yearLimit = currentYear;
	 }
	 
	 var limit = new Date(yearLimit, "6", "1");
	 
	 if(selectedDate > limit)
	 {
		return 1;
	 }
	 else
	 {
		 return 0;
	 }	
}

function checkTwoDates(firstDate,secondDate){
	
//	 var DateValue1 = document.getElementById(firstDate).value;
//	 var DateValue2 = document.getElementById(secondDate).value;
	 var DateValue1 = firstDate;
	 var DateValue2 = secondDate;

	 var dvals1 = DateValue1.split('-')[0];
	 var dvals2 = DateValue1.split('-')[1]-1;
	 var dvals3 = DateValue1.split('-')[2];
	
	 var secondvals1 = DateValue2.split('-')[0];
	 var secondvals2 = DateValue2.split('-')[1]-1;
	 var secondvals3 = DateValue2.split('-')[2];

	 
	 var selectedFirstDate = new Date(dvals1,dvals2,dvals3);
	 var selectedSecondDate = new Date(secondvals1,secondvals2,secondvals3);
	 var yearLimit;
	 
	 if(dvals2 < 6)
	 {
		 yearLimitFrom = dvals1 - 1;
		 yearLimitTo = dvals1;
	 }
	 else
	 {
		 yearLimitFrom = dvals1;
		 yearLimitTo = parseInt(dvals1) + 1;
	 }
	 
	 yearLimitFrom 	= new Date(yearLimitFrom,'05','30');
	 yearLimitTo 	= new Date(yearLimitTo,'06','01');
	 if(selectedSecondDate > yearLimitFrom && selectedSecondDate < yearLimitTo)
	 {
		return 1;
	 }
	 else
	 {
		 return 0;
	 }	
}

function deletetaxablevehicle(TaxableId,vin)
{
	var ibox = confirm("Are you sure to delete");		
	if( ibox == false )		
	{	
		return false;		
	}
	else
	{
		var type = 'deletetaxablevehi';
		
		var postParams = '&TaxableId=' +TaxableId +'&vin='+vin+ '&type='+type;
		
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				var result = data;
				result = result.replace(/^\s+/,"");
				
				if(result == 'updated')
				{
					var url = location.protocol +"//"+ location.host + "/taxablevehicleinfo/";						
					window.location.href = url;
				}
				else
				{
					alert('Credit amount exceeding taxable amount.Cannot delete the vehicle.');
				}
			}
		});
	}

}

function checkVIN(id,vinNo,errorId,inputClass,errorInputClass)
{
	if(document.getElementById(id)!=null)
	document.getElementById(id).className = inputClass;
	
	var lang 			= $('input[name=lang]');
	document.getElementById(errorId).innerHTML = '';
	var regExpr = /^([a-h j-n p r-z A-H J-N P R-Z 0-9_-]){17}$/;
	
	vinNo = vinNo.replace(/ /g, '');
	if(vinNo.length != 17)
	{
		document.getElementById(id).value = '';
		
		if(document.getElementById(id)!=null)
		document.getElementById(id).className = errorInputClass;
		
		errorMsg(errorId,'TAX_VIN_INVALID',lang.val());
		return false;
	}
	else if(!regExpr.test(vinNo))
	{
		if(document.getElementById(id)!=null)
		document.getElementById(id).className = errorInputClass;
		
		document.getElementById(errorId).innerHTML = 'Please enter a valid VIN ( VIN will not contain letters I, Q, O)';
		document.getElementById(id).value = '';
		return false;
	}
	else
	{
		if(document.getElementById('previn')==null)
		{	
			if(document.getElementById('vin')!=null)
				document.getElementById('vin').value = vinNo.toUpperCase();
				
			if(document.getElementById('VIN')!=null)
				document.getElementById('VIN').value = vinNo.toUpperCase();
		}
		else if(document.getElementById('previn')!=null)
		{	
			var previnVal = document.getElementById('previn').value;
			var VinVal = document.getElementById('vin').value;
			
			document.getElementById('previn').value = previnVal.toUpperCase();
			document.getElementById('vin').value = VinVal.toUpperCase();
		}
		
	}
}
//Author - Ramesh Raja - 21th July 2012
//Function to select continue pending filing
function selectedFiling(id){
	var type = 'selectfiling';
	var postParams = 'type='+type+'&id='+id;
	$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			var result = data;
			result = result.replace(/^\s+/,"");
			
			if(result == 'done' || result == 'edit')
			{
				var url = location.protocol +"//"+ location.host+'/summary/';
				window.location.href = url;
			}
			else
			{
				var url = location.protocol +"//"+ location.host+'/filestatus/';
				window.location.href = url;
			}
		}
	});
}

//Author - Ramesh Raja - 29th Jan 2014
//Function to edit failed or rejected filing
function resubmitFiling(id)
{
	var ibox = confirm("Are you sure want to edit and resubmit the return");		
	if( ibox == false )		
	{	
		return false;		
	}
	else
	{
		var type = 'selectfiling';
		var postParams = 'type='+type+'&id='+id;
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				var url = location.protocol +"//"+ location.host+'/summary/';
				window.location.href = url;
			}
		});	
	}
}

function deletesoldcredit(sldDtroyCrdId,vin)
{
	var ibox = confirm("Are you sure to delete");		
	if( ibox == false )		
	{	
		return false;		
	}
	else
	{
		var type = 'deletesolddes';
		
		var postParams = '&sldDtroyCrdId=' +sldDtroyCrdId +'&vin='+vin+ '&type='+type;
		
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				var url = location.protocol +"//"+ location.host + "/solddestroycredit/";						
				window.location.href = url;	
			}
		});
	}
}

function deletelowmileage(lowMlgId,vin)
{
	var ibox = confirm("Are you sure to delete");		
	if( ibox == false )		
	{	
		return false;		
	}
	else
	{
		var type = 'deletecreditinfo';
		var postParams = '&lowMlgId=' +lowMlgId +'&vin='+vin+ '&type='+type;
		
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				var url = location.protocol +"//"+ location.host + "/lowmileagecredit/";						
				window.location.href = url;	
			}
		});
	}

}
function validatetaxablevehicleform()
{
		var vin	 			= $('input[name=vin]');
		var grossweight 	= $('select[name=taxableWeight]');
		var lang 			= $('input[name=lang]');
		
		document.getElementById('error_msg').innerHTML  = '';
		$('input').removeClass('errorBdr');
		$('select').removeClass('errorBdr');
		$('textarea').removeClass('errorBdr');
	
		if(vin.val()==0)
		{
			document.getElementById('vin').className = 'loginTxtBoxErr txtBox320px';
			errorMsg('error_msg','ENTERVIN',lang.val());
			return false;
		}
		if(vin.val().length !=17)
		{
			document.getElementById('vin').className = 'loginTxtBoxErr txtBox320px';
			errorMsg('error_msg','ENTER_VALID_VIN',lang.val());
			return false;
		}
		if(grossweight.val()==0)
		{
			document.getElementById('taxableWeight').className = 'loginTxtBoxErr txtBox150px';
			errorMsg('error_msg','ENTER_TAX_GROSWT',lang.val());
			return false;
		}
		if(document.getElementById('yes').checked == false && document.getElementById('no').checked == false)
		{
			errorMsg('error_msg','SELECT_LORNOT',lang.val());
			return false;								
		}
		return true;
		
}
function validateLowMileage(filingId,formType)
{
	var vin	 			= document.getElementById('vin').value;
	var grossweight 	= document.getElementById('taxableWeight').value;
	var Taxmonth 		= document.getElementById('monthused').value;
	var explaination = document.getElementById('explanation').value;
	var uploadDocument = document.getElementById('document').value;
	var FileExtension = uploadDocument.split('.');
	var lang = $('input[name=lang]');
	
	/*if(filingId!='' && formType == '2290')
	{
		var taxableInfoFlag = true;
		var postParams = 'filingId=' +filingId+'&type=checkTaxableCreditAmount';
		
		$.ajax({ type: "POST",async:false, url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				if(parseInt(data) == 0)
				taxableInfoFlag = false;
			}
		});
		
		if(taxableInfoFlag == false)
		{
			errorMsg('errorMessage','NO_TAXABLE_VEHICLE_FOUND',lang.val());
			return false;
		}
	}
	*/
	if(uploadDocument != '')
	fileSize = document.getElementById('document').files[0].size;
	
	document.getElementById('errorMessage').innerHTML  = '';
	$('input').removeClass('errorBdr');
	$('select').removeClass('errorBdr');
	$('textarea').removeClass('errorBdr');
	
	if(vin == 0)
	{
		document.getElementById('vin').className = 'errorBdr txtBox150px';
		errorMsg('errorMessage','ENTERVIN',lang.val());
		return false;
	}
	
	if(vin.length != 17)
	{
		document.getElementById('vin').className = 'errorBdr txtBox150px';
		errorMsg('errorMessage','ENTER_VALID_VIN',lang.val());
		return false;
	}
	
	if(grossweight == 0)
	{
		document.getElementById('taxableWeight').className = 'errorBdr txtBox150px';
		errorMsg('errorMessage','ENTER_TAX_GROSWT',lang.val());
		return false;
	}
									
	if(document.getElementById('loggingyes').checked == false 
			&& document.getElementById('loggingno').checked == false)
	{
		errorMsg('errorMessage','SELECT_LORNOT',lang.val());
		return false;
	}
	if(Taxmonth == 0)
	{
		document.getElementById('monthused').className = 'errorBdr txtBox150px marRight10px hasDatepicker';
		errorMsg('errorMessage','SELECT_FIRST_USED_MONTH',lang.val());
		return false;
	}
	
	if(explaination == 0)
	{
		document.getElementById('explanation').className = 'textArea errorBdr';
		errorMsg('errorMessage','ENTER_SOLD_EXPLANATION',lang.val());
		return false;
	}
	
	if(checkPastDate('monthused') == 1)
	{
		document.getElementById('monthused').className = 'errorBdr txtBox150px marRight10px hasDatepicker';
		errorMsg('errorMessage','FIRST_MONTH_PAST_DATE',lang.val());
		return false;
	}
	
	if(uploadDocument != '')
	{
		if(FileExtension[1]!="pdf")
		{
			errorMsg('errorMessage','UPLOAD_FILE_TYPES',lang.val());
			return false;
		}
	}
	
	if(fileSize > 2097152)
	{
		errorMsg('errorMessage','UPLOAD_SIZE_EXCEEDED',lang.val());
		return false;
	}
	
	return true;
	
}
function deleteoverpayment(id)
{
	var ibox = confirm("Are you sure to delete");		
	if( ibox == false )		
	{	
		return false;		
	}
	else
	{
		var type = 'deleteoverpaymentinfo';
		var postParams = '&id=' +id + '&type='+type;
		
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				var url = location.protocol +"//"+ location.host + "/overpayment/";						
				window.location.href = url;	
			}
		});
	}

}

function deleteTGWI(TaxableId,vin)
{
	var ibox = confirm("Are you sure to delete");		
	if( ibox == false )		
	{	
		return false;		
	}
	else
	{
		var type = 'deleteTGWI';
		
		var postParams = '&TaxableId=' +TaxableId +'&vin='+vin+ '&type='+type;
		
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				var url = location.protocol +"//"+ location.host + "/tgwincreased/";						
				window.location.href = url;	
			}
		});
	}

}
function deleteVINCorrection(vinId,page)
{
	var ibox = confirm("Are you sure to delete");		
	if( ibox == false )		
	{	
		return false;		
	}
	else
	{
		var type = 'deleteVINCorrection';
		
		var postParams = '&vin='+vinId+ '&type='+type;
		
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				var url = location.protocol +"//"+ location.host + "/vincorrection/"+page;						
				window.location.href = url;	
			}
		});
	}

}
//To check for enter numbers only
function numbersonly(myfield, e, dec)
{
var key;
var keychar;
 
if (window.event)
   key = window.event.keyCode;
else if (e)
   key = e.which;
else
   return true;
keychar = String.fromCharCode(key);
// control keys
if ((key==null) || (key==0) || (key==8) || 
    (key==9) || (key==13) || (key==27) )
   return true;

// numbers
else if ((("0123456789.").indexOf(keychar) > -1))
   return true;

// decimal point jump
//else if (dec && (keychar == "."))
//   {
//   myfield.form.elements[dec].focus();
//   return false;
//   }
else
   return false;
}

function validateCreditOverPayment()
{
	var vin = document.getElementById('vin').value;
	var paymentdate = $('input[name=paymentdate]');
	var amtclaim = $('input[name=amtclaim]');
	var explanation = $('textarea[name=explanation]');
	var uploadDocument = document.getElementById('document').value;
	var FileExtension = uploadDocument.split('.');	
	var lang = $('input[name=lang]');
	
	document.getElementById('error_msg').innerHTML  = '';
	$('input').removeClass('errorBdr');
	$('textarea').removeClass('errorBdr');
	
	if(uploadDocument != '')
		fileSize = document.getElementById('document').files[0].size;

	if(vin == 0)
	{
		document.getElementById('vin').className = 'errorBdr txtBox320px';
		errorMsg('error_msg','ENTERVIN',lang.val());
		return false;
	}
	
	else if(vin.length != 17)
	{
		document.getElementById('vin').className = 'errorBdr txtBox320px';
		errorMsg('error_msg','ENTER_VALID_VIN',lang.val());
		return false;
	}
	
	else if (paymentdate.val()==0) 
	{
		errorMsg('error_msg','SELECT_DATE',lang.val());
		document.getElementById('paymentdate').className = 'errorBdr txtBox150px marRight10px hasDatepicker';
		return false;
	}
	else if (amtclaim.val()=='') 
	{
		errorMsg('error_msg','CLAIM_AMOUNT',lang.val());
		document.getElementById('amtclaim').className = 'errorBdr txtBox150px';
		return false;
	}
	else if (amtclaim.val()==0) 
	{
		errorMsg('error_msg','CLAIM_AMOUNT_NOT_ZERO',lang.val());
		document.getElementById('amtclaim').className = 'errorBdr txtBox150px';
		return false;
	}
	else if(explanation.val()==0)
	{
		errorMsg('error_msg','OVER_PAY_EXPLAIN',lang.val());
		document.getElementById('explanation').className = 'errorBdr textArea255px';
		return false;
	}
	else if(uploadDocument != '')
	{
		if(FileExtension[1]!="pdf")
		{
			errorMsg('error_msg','UPLOAD_FILE_TYPES',lang.val());
			return false;
		}
	}
	else if(fileSize > 2097152)
	{
		errorMsg('error_msg','UPLOAD_SIZE_EXCEEDED',lang.val());
		return false;
	}
	else
	return true;
}

function validateTGWI()
{
	var vin	 			= $('input[name=vin]');
	var preWeightCat 	= $('select[name="taxableWeight"]');
	var chnWeightCat 	= $('select[name="changingWeightCategory"]');
	var lang 			= $('input[name=lang]');
	
	document.getElementById('errorMessage').innerHTML  = '';
	$('input').removeClass('errorBdr');
	$('select').removeClass('errorBdr');
	
	if(vin.val()==0)
	{
		document.getElementById('vin').className = 'errorBdr txtBox320px';
		errorMsg('errorMessage','TAX_VIN_INVALID',lang.val());
		return false;
	}
	
	if(vin.val().length !=17)
	{
		document.getElementById('vin').className = 'errorBdr txtBox320px';
		document.getElementById('errorMessage').innerHTML = 'Please enter a 17 digit VIN numbers';
		return false;
	}
	
	if(preWeightCat.val()==0)
	{
		document.getElementById('taxableWeight').className = 'errorBdr txtBox150px';
		errorMsg('errorMessage','PRE_CAT_INVALID',lang.val());
		return false;
	}
	
	if(chnWeightCat.val()==0)
	{
		document.getElementById('changingWeightCategory').className = 'errorBdr txtBox150px';
		errorMsg('errorMessage','CHN_CAT_INVALID',lang.val());
		return false;
	}
	
	if(preWeightCat.val() < chnWeightCat.val()){
	}else{
		document.getElementById('taxableWeight').className = 'errorBdr txtBox150px';
		document.getElementById('changingWeightCategory').className = 'errorBdr txtBox150px';
		errorMsg('errorMessage','TGW_CHG_CAT_GRATER_INVALID',lang.val());
		return false;
	}
	
	if(document.getElementById('yes').checked == false && document.getElementById('no').checked == false)
	{
		errorMsg('errorMessage','TAX_LOGGINGVEHI_MSG',lang.val());
		return false;								
	}
	return true;
}
function validateExceedMileageVehicleform()
{
		var vin	 			= $('input[name=vin]');
		var grossweight 	= $('select[name=taxableWeight]');
		var lang 			= $('input[name=lang]');
		
		document.getElementById('error_msg').innerHTML  = '';
		$('input').removeClass('errorBdr');
		$('select').removeClass('errorBdr');
		$('textarea').removeClass('errorBdr');
	
		if(vin.val()==0)
		{
			document.getElementById('vin').className = 'loginTxtBoxErr txtBox320px';
			errorMsg('error_msg','ENTERVIN',lang.val());
			return false;
		}
		if(vin.val().length !=17)
		{
			document.getElementById('vin').className = 'loginTxtBoxErr txtBox320px';
			errorMsg('error_msg','ENTER_VALID_VIN',lang.val());
			return false;
		}
		if(grossweight.val()==0)
		{
			document.getElementById('taxableWeight').className = 'loginTxtBoxErr txtBox150px';
			errorMsg('error_msg','ENTER_TAX_GROSWT',lang.val());
			return false;
		}
		if(document.getElementById('yes').checked == false && document.getElementById('no').checked == false)
		{
			errorMsg('error_msg','SELECT_LORNOT',lang.val());
			return false;								
		}
		return true;
		
}
function validateFleet()
{
	document.getElementById('errorMessage').innerHTML  = '';
	$('input').removeClass('errorBdr');
	$('select').removeClass('errorBdr');
	
	var businessId 	= $('select[name=business]');
	var licencePlateNo	= $('input[name=licenceno]');
	var vin	 			= $('input[name=vin]');
	var grossweight 	= $('select[name=taxableWeight]');
	var lang 			= $('input[name=lang]');
	
	if(businessId.val()==0)
	{
		errorMsg('errorMessage','ERROR_SELECT_BIZ',lang.val());
		document.getElementById('business').className = 'errorBdr txtBox320px';
		return false;
	}
	
	if(licencePlateNo.val()==0)
	{
		errorMsg('errorMessage','ERROR_LICENSE',lang.val());
		document.getElementById('licenceno').className = 'errorBdr txtBox320px';
		return false;
	}
	
	if(vin.val()==0)
	{
		errorMsg('errorMessage','ENTERVIN',lang.val());
		document.getElementById('vin').className = 'errorBdr txtBox320px';
		return false;
	}
	
	if(vin.val().length !=17)
	{
		errorMsg('errorMessage','ENTER_VALID_VIN',lang.val());
		document.getElementById('vin').className = 'errorBdr txtBox320px';
		return false;
	}
	
	if(grossweight.val()==0)
	{
		errorMsg('errorMessage','ENTER_TAX_GROSWT',lang.val());
		document.getElementById('taxableWeight').className = 'errorBdr txtBox150px';
		return false;
	}
	
	if(document.getElementById('yes').checked == false && document.getElementById('no').checked == false)
	{
		errorMsg('errorMessage','TAX_LOGGINGVEHI_MSG',lang.val());
		return false;								
	}
	
	
	return true;
}

//To Delete fleet
function deletefleet(fleetid)
{
	var ibox = confirm("Are you sure to delete");	
	if( ibox == false )		
	{	
		return false;		
	}
	else
	{
		var type = 'deletefleet';
		var postParams = '&fleetid=' +fleetid +'&type='+type;
		
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				window.location.reload();
			}
		});
	}

}
function radioValue(soldtransfrd)
{
	if(soldtransfrd=='1')
	{
		document.getElementById('TransSoldTo').style.display = 'none';
		document.getElementById('buyerName').style.display = '';
	}
	else if(soldtransfrd=='0')
	{
		document.getElementById('TransSoldTo').style.display = '';
		document.getElementById('buyerName').style.display = 'none';
	}
}
function priorYrSusVehicleValidate()
{
	var vin	 				= $('input[name=vin]');
	var soldTransfrdTo 		= $('input[name=soldTransfrdTo]');
	var transferSold_date 	= $('input[name=transferSold_date]');
	var lang 				= $('input[name=lang]');
	
	var today = document.getElementById('serverTime').value;
	var year = today.split('-')[0];
	var month = today.split('-')[1];
	var day = today.split('-')[2];
	
	if(month<10)
	{
		date = year+'-0'+month+'-0'+day;
	}
	else
	{
		date = year+'-'+month+'-'+day;
	}
	
	if(vin.val()==0)
	{
		errorMsg('errorMessage','TAX_VALIDATE_MSG',lang.val());
		document.getElementById('vin').className = 'loginTxtBoxErr txtBox320px';
		return false;
	}
	else if(vin.val().length !=17)
	{
		errorMsg('errorMessage','TAX_VIN_INVALID',lang.val());
		document.getElementById('vin').className = 'loginTxtBoxErr txtBox320px';
		return false;
	}
	
	else if(document.getElementById('milegae').checked == false 
			&& document.getElementById('sold').checked == false)
	{
		errorMsg('errorMessage','SELECT_SUSPENSION',lang.val())
		document.getElementById('vin').className = 'txtBox320px';
		return false;
	}
	
	else if(document.getElementById('sold').checked == true)
	{
		if(soldTransfrdTo.val()==0)
		{
			errorMsg('errorMessage','SOLD_TRANSFER_TO',lang.val());
			document.getElementById('vin').className = 'txtBox320px';
			document.getElementById('soldTransfrdTo').className = 'loginTxtBoxErr txtBox320px';
			return false;
		}
		
		else if(transferSold_date.val()==0)
		{
			errorMsg('errorMessage','SELECT_DATE',lang.val());
			document.getElementById('vin').className = 'txtBox320px';
			document.getElementById('soldTransfrdTo').className = 'txtBox320px';
			document.getElementById('transferSold_date').className = 'loginTxtBoxErr txtBox100px marRight5px hasDatepicker';
			return false;
		}
		
		else if(transferSold_date.val() >= date)
		{
			errorMsg('errorMessage','VALID_PAST_DATE',lang.val());
			document.getElementById('vin').className = 'txtBox320px';
			document.getElementById('soldTransfrdTo').className = 'txtBox320px';
			document.getElementById('transferSold_date').className = 'txtBox100px marRight5px hasDatepicker';
			return false;
		}
	}
	else
	return true;
}
function deleteprioryyearvehicle(preYrSpndId,vin)
{
	var ibox = confirm("Are you sure to delete");		
	if( ibox == false )		
	{	
		return false;		
	}
	else
	{
		var type = 'deletepriorvehi';
		
		var postParams = '&preYrSpndId=' +preYrSpndId +'&vin='+vin+ '&type='+type;
		
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				var url = location.protocol +"//"+ location.host + "/prioryrsuspend";						
				window.location.href = url;	
			}
		});
	}

}

//Show hide payment option fields
function ShowHidePaymentOption(option_id)
{
	$('input').removeClass('errorBdr');
	document.getElementById('error_msg').innerHTML  = '';
	
	switch(option_id)
	{
		case "1":
			document.getElementById('directDebitId').style.display = 'block';
			document.getElementById('EFTPSId').style.display = 'none';
			break;
		case "2":
			document.getElementById('directDebitId').style.display = 'none';
			document.getElementById('EFTPSId').style.display = 'block';
			break;
	}
}

//validate anyone of payment option and its check box is checked
function validatePaymentOptionForm()
{
	var DirectDebit 			= document.getElementById('paymentMode1');
	var EFTPS 					= document.getElementById('paymentMode2');
	var DirectDebitCheckBox		= $('input[name="DirectDebit"]:checked');
	var eftpsCheckBox			= $('input[name="eftps"]:checked');
	var phoneFilter 			= /^\+{0,1}[0-9- ]+(,[0-9- ]+)*$/;
	var lang 					= $('input[name=lang]');
	
	if(DirectDebit.checked)
	{	
		var bankName	 			= $('input[name=bankName]');
		var accountType	 			= $('select[name=accountType]');
		var acNumber	 			= $('input[name=acNumber]');
		var rountingTransitNumber	= $('input[name=rountingTransitNumber]');
		
		$('input').removeClass('errorBdr');
		document.getElementById('error_msg').innerHTML  = '';

		if (bankName.val() ==0) 
		{
			document.getElementById('bankName').className = 'loginTxtBoxErr txtBox260px';
			errorMsg('error_msg','ENTER_BANKNAME',lang.val());
			return false;
		}
		else
		{
			document.getElementById('bankName').className = 'txtBox260px';
		}
		if (accountType.val() ==0) 
		{
			document.getElementById('accountType').className = 'loginTxtBoxErr txtBox150px';
			errorMsg('error_msg','SELECT_ACCTYPE',lang.val());
			return false;
		}
		else
		{
			document.getElementById('accountType').className = 'txtBox150px';
		}
		if (acNumber.val() ==0) 
		{
			document.getElementById('acNumber').className = 'loginTxtBoxErr txtBox260px';
			errorMsg('error_msg','ENTER_ACCNO',lang.val());
			return false;
		}
//		else if(acNumber.val().length < 17 && !(phoneFilter.test(acNumber)))
//		{
//			document.getElementById('acNumber').className = "loginTxtBoxErr txtBox260px";
//			document.getElementById('error_msg').innerHTML = 'Enter valid Bank Account Number.';
//			return false;
//		}
		else
		{
			document.getElementById('acNumber').className = 'txtBox260px';
		}
		if (rountingTransitNumber.val() ==0) 
		{
			document.getElementById('rountingTransitNumber').className = 'loginTxtBoxErr txtBox260px';
			errorMsg('error_msg','ENTER_ROUTINGNO',lang.val());
			return false;
		}
//		else if(rountingTransitNumber.val().length < 9)
//		{
//			document.getElementById('rountingTransitNumber').className = "loginTxtBoxErr txtBox260px";
//			document.getElementById('error_msg').innerHTML = 'Enter valid Routing Transit Number.';
//			return false;
//		}
		else
		{
			document.getElementById('rountingTransitNumber').className = 'txtBox260px';
		}
		if (DirectDebitCheckBox.val() != 'on') 
		{ 	
			errorMsg('error_msg','PAYMENT_TERM_CONTIDION',lang.val());
			return false;
		}
		
		return true;
		
	}
	else if(EFTPS.checked)
	{	
		if(eftpsCheckBox.val() != 'on') 
		{ 		
			errorMsg('error_msg','ACCEPTTERMS',lang.val());
			return false;
		}
		return true;
	}
	else
	{		
		errorMsg('error_msg','SELECT_PAYMODE',lang.val());
		return false;
	}
	
}
function currentsuspendForm()
{
	var vin = document.getElementById('vin').value;
	var lang = document.getElementById('lang').value;

	$('input').removeClass('errorBdr');
	document.getElementById('errorMessage').innerHTML  = '';
	/*if(liscense == 0)
	{
		document.getElementById('selectLiscense').className = 'loginTxtBoxErr alignleft txtBox320px';
		document.getElementById('errorMessage').innerHTML = 'please select License';
		return false;		
	}else{
		document.getElementById('selectLiscense').className = 'alignleft txtBox320px';
		document.getElementById('errorMessage').innerHTML = '';
	}*/
	if(vin.length == 0)
	{
		document.getElementById('vin').className = 'loginTxtBoxErr alignleft txtBox320px';
		document.getElementById('errorMessage').innerHTML = 'please enter all required fields';
		return false;		
	}
	else if(vin.length !=17)
	{
		document.getElementById('vin').className = 'loginTxtBoxErr alignleft txtBox320px';
		document.getElementById('errorMessage').innerHTML = 'Please enter a 17 digit VIN number';
		return false;
	}
	else if(document.getElementById('loggingyes').checked == false && document.getElementById('loggingno').checked == false)
	{
		document.getElementById('errorMessage').innerHTML = 'Please Select Vehicle used for Logging';
		return false;
	}
	else if(document.getElementById('agriyes').checked == false && document.getElementById('agrino').checked == false)
	{
		document.getElementById('errorMessage').innerHTML = 'Please Select Vehicle used for agricultural';
		return false;
	}
	else
	{
		return true;		
	}
	
}

function deletecurrentsuspendvehicle(crntYrSpndId ,vin)
{
	var ibox = confirm("Are you sure to delete");		
	if( ibox == false )		
	{	
		return false;		
	}
	else
	{
		var type = 'deletecursuspendinfo';
		var postParams = '&crntYrSpndId=' +crntYrSpndId  +'&vin='+vin+ '&type='+type;
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				var url = location.protocol +"//"+ location.host + "/currentyrsuspend";						
				window.location.href = url;	
			}
		});
	}

}
function deleteExceededMileageVehi(TaxableId,vin)
{
	var ibox = confirm("Are you sure to delete");		
	if( ibox == false )		
	{	
		return false;		
	}
	else
	{
		var type = 'deleteExceededMileageVehi';
		
		var postParams = '&TaxableId=' +TaxableId +'&vin='+vin+ '&type='+type;
		
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				var url = location.protocol +"//"+ location.host + "/exceededmileage/";						
				window.location.href = url;	
			}
		});
	}

}
function selectedForm(selectedForm)
{
//	document.getElementById('earliestDateArea').style.display = 'none';
//	document.getElementById('latestDateArea').style.display = 'none';
	document.getElementById('taxYearEndMonthArea').style.display = 'none';
	document.getElementById('amendMentMonthArea').style.display = 'none';
	document.getElementById('taxyearArea').style.display = 'block';	
	document.getElementById('taxmonthArea').style.display = 'block';
	
	if(selectedForm == '8849S6'){
		document.getElementById('finalreturndiv').style.display = 'none';
		document.getElementById('addresschangediv').style.display = 'none';
		document.getElementById('taxyearArea').style.display = 'none';	
		document.getElementById('taxmonthArea').style.display = 'none';	
	}else if(selectedForm == '2290V'){
		document.getElementById('finalreturndiv').style.display = 'none';
		document.getElementById('addresschangediv').style.display = 'none';
	}else{
		document.getElementById('finalreturndiv').style.display = 'block';
		document.getElementById('addresschangediv').style.display = 'block';
		document.getElementById('taxyearArea').style.display = 'block';	
		document.getElementById('taxmonthArea').style.display = 'block';	
	}
	
	if(selectedForm == '2290A1' || selectedForm == '2290A2')
	{
		document.getElementById('amendMentMonthArea').style.display = '';
		
		var type = 'changetaxmonth';
		var e = document.getElementById("taxyear");
		var year = e.options[e.selectedIndex].value;
		
		if(document.getElementById('taxyear').value == 0)
		{  	
			document.getElementById('amendmentMonth_select_area').innerHTML = '<select id="taxmonth" name="taxmonth" class="txtBox150px"><option value="0">Select Month</option></select>';
		}
		else
		{
			var postParams = 'type='+type+'&year='+year+'&monthType=amendmentMonth';
			$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
				success: function( data, textStatus )
				{
					document.getElementById('amendmentMonth_select_area').innerHTML = data;
				}
			});
		}
	}
	if(selectedForm == '8849S6')
	{  
//		document.getElementById('earliestDateArea').style.display = 'block';
//		document.getElementById('latestDateArea').style.display = 'block';
		document.getElementById('taxYearEndMonthArea').style.display = 'block';
		
		var type = 'getMonthList';

		var postParams = 'type='+type;

		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				document.getElementById('taxYearEndMonth_select_area').innerHTML = data;
			}
		});
	}
}
//To Delete Tax Return Pending list
function deletetaxpendinglist(filingid)
{
	var ibox = confirm("Are you sure to delete");	
	if( ibox == false )		
	{	
		return false;		
	}
	else
	{
		var type = 'deletetaxpendinglist';
		var postParams = '&filingid=' +filingid +'&type='+type;
		
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				window.location.reload();
			}
		});
	}

}

// licence number auto search

function lookup(inputString) {
	if(inputString.length == 0) {
        // Hide the suggestion box.
        document.getElementById('suggestions').style.display = 'none';
    } else {
        var type = 'autotext';
        var postParams = 'queryString=' +inputString +'&type='+type;
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
//				data = data.trim();
				var result = data;
				result = result.replace(/^\s+/,"");
				
				if(result == '')
				{
					document.getElementById('suggestions').style.display = 'none';
					//document.getElementById('autoSuggestionsList').innerHTML = ('<span class="redTxt">No licence found.</span>');
				}
				else
				{	
					document.getElementById('suggestions').style.display = 'block';
					document.getElementById('autoSuggestionsList').innerHTML = result;
					
				}
			}
		});
        
    }
} // lookup
function fill(lno, vin, twg, logging) {
	$('#lno').val(lno);
	
	if ($('#vin').length)
		//$('#vin').val(vin);
		document.getElementById('vin').value = vin.toUpperCase();
	
	if ($('#VIN').length)
		//$('#VIN').val(vin);
		document.getElementById('VIN').value = vin.toUpperCase();
	
	if ($('#weight').length)
    $('#weight').val(twg).selected;
	
	if ($('#taxableWeight').length)
	    $('#taxableWeight').val(twg).selected;
	
   	if(logging == 'Y'){
   		if ($('#yes').length)
   			$('#yes').attr("checked", "checked");
   		
   		if ($('#loggingyes').length)
   	       	$('#loggingyes').attr("checked", "checked");
   		
   	}else{
   		if ($('#no').length)
   			$('#no').attr("checked", "checked");
   		
   		if ($('#loggingno').length)
   			$('#loggingno').attr("checked", "checked");
   	}
    setTimeout("$('#suggestions').hide();", 200);
}
function showSoldDetails()
{
	$("#transferSold_date").removeAttr("disabled");
	$("#soldTransfrdTo").removeAttr("disabled");
	//document.getElementById('sold_details').style.display = 'block';
}

function hideSoldDetails()
{
	$("#transferSold_date").attr("disabled", "disabled"); 
	$("#soldTransfrdTo").attr("disabled", "disabled"); 
	document.getElementById('transferSold_date').value = '';
	document.getElementById('soldTransfrdTo').value = '';
	//document.getElementById('sold_details').style.display = 'none';
}

function selectedType(selectedType)
{
	document.getElementById('OwnerNameDisplayId').style.display = 'none';
	
	if(selectedType == '1')
	{
		document.getElementById('OwnerNameDisplayId').style.display = 'block';
	}
	
}
function initiatePayment()
{
	var returnFlag = false;
	
	document.getElementById('payButton').style.display = 'none';
//	document.getElementById('loaderDiv').style.display = '';
	var voucherNo = document.getElementById('x_invoice_num').value;
	filingAmount = document.getElementById('x_amount').value;
	var postParams = 'voucherNo='+voucherNo+'&filingAmount='+filingAmount+'&type=initiatePayment';
	$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			if(parseInt(data)>0)
			{
				returnFlag = true;
				$("#payAnchorId").fancybox().trigger('click');
				document.getElementById('paymentForm').submit();
			}
			
		}
	});
	
	return returnFlag;
}

function updateConsentDiscloser()
{
	var concentDiscloser = document.getElementById("concentDiscloser").checked;
	var status;
	if(concentDiscloser == true)
	{
		status = '1';
	}
	else
	{
		status = '0';
	}
	
	var postParams = 'type=consentdiscloser&status='+status;
	$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			//alert(data);
		}
	});
}
function switchFocus(typedValue)
{
	if(typedValue.length == 2)
		document.getElementById('phone').focus();
}
function clearErrbdr(id,errorId)
{
	$('#'+id).removeClass('errorBdr');
	document.getElementById(errorId).innerHTML  = '';
}
function myAccountValidate()
{
	var firstname 			= $('input[name=firstname]');	
	var lastname 			= $('input[name=lastname]');
	var phone 				= $('input[name=phone]');	
	var lang 				= $('input[name=lang]');
	var phoneFilter = /^\+{0,1}[0-9- ]+(,[0-9- ]+)*$/;
	
	if (firstname.val()  == 0) 
	{
		document.getElementById('firstname').className = 'errorBdr txtBox320px';
		errorMsg('error_msg','FIRSTNAME_ERROR',lang.val());
		return false;
	} 
	
	if (lastname.val() == 0) 
	{
		document.getElementById('lastname').className = 'errorBdr txtBox320px';	
		errorMsg('error_msg','LASTNAME_ERROR',lang.val());
		return false;
	} 

	if(phone.val() == 0)
	{
		document.getElementById('phone').className = 'errorBdr txtBox150px';
		errorMsg('error_msg','ENTER_PHONE',lang.val());
		return false;
	}
	
	if(!(phoneFilter.test(phone.val())) || phone.val().length < 10)
	{
		document.getElementById('phone').className = 'errorBdr txtBox150px';
		errorMsg('error_msg','TAX_PHONE_VALID',lang.val());								
		return false;
	}
	
}
function validateuserconsent()
{
	var returnFlag = false;
	
	var lang 				= $('input[name=lang]');
	var concentDiscloser = document.getElementById("concentDiscloser").checked;
	var status;
	if(concentDiscloser == true)
	{
		returnFlag = true;
		$("#successAnchorId").fancybox().trigger('click');
		return true;
	}
	else
	{
		errorMsg('errMsg','TAX_CONSENT_ERROR',lang.val());	
		return false;
	}
	
	return returnFlag;
}
function chkVehicleNickname(id,vehicleNo)
{
	document.getElementById('errorMessage').innerHTML  = '';
	$('input').removeClass('errorBdr');
	$('select').removeClass('errorBdr');
	var lang 			= $('input[name=lang]');
	var businessId = document.getElementById('business').value;
	if(businessId == 0)
	{
		document.getElementById(id).value = '';
		document.getElementById('business').className = 'errorBdr txtBox320px';
		errorMsg('errorMessage','ERROR_SELECT_BIZ',lang.val());
	}
	else
	{
		var postParams = 'vehicleNo='+vehicleNo+'&type=chkVehicleNickname&businessId='+businessId;
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				if(parseInt(data)>0)
				{
					document.getElementById(id).value = '';
					errorMsg('errorMessage','NICKNAME_EXISTS',lang.val());
				}
			}
		});
	}
}
function getServerDateTime(){
	
	var postParams = 'type=getServerDateTime';
	var serverDate = '';
	
	$.ajax({ type: "POST",async:false, url: "/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			serverDate = data;
		}
	});
	return serverDate; 
}
//To check password 
/*It should be a Alpha Numeric
It should be minimum 6 characters
It should contain atleast 1 special character
*/
function checkPassword(evt,id,inputClass,errorInputClass,errorId,errorMessage)
{
	var password = document.getElementById(id).value;
	
	if (password == 0) 
	{
		document.getElementById(id).className = errorInputClass;
		document.getElementById(errorId).innerHTML = 'Password should contain at least 6 letters or numbers.';
		return false;
	} 
	else if (password.length < 6) 
	{				
		document.getElementById(id).className = errorInputClass;
		document.getElementById(errorId).innerHTML = 'Password should contain at least 6 letters or numbers.';							
		return false;				
	}
	else
	{
		document.getElementById(id).className = inputClass;
		document.getElementById(errorId).innerHTML = '';
		return true;
	}
	
//	var password = document.getElementById(id).value;
//
//	var pattern = new RegExp("^(?=.*?[0-9])(?=.*?[a-zA-Z])(?=.*[!@#$%^&*()_+-,.?/\<>])[0-9a-zA-Z!@#$%^&*()_+-,.?/\<>0-9]{6,}$");
//	
//	if(!pattern.test(password))
//	{   
//		document.getElementById(id).className = errorInputClass;
//		document.getElementById(errorId).innerHTML = errorMessage;
//		document.getElementById(id).value = '';
//		return false;
//	}else{
//		document.getElementById(id).className = inputClass;
//		document.getElementById(errorId).innerHTML = '';
//		return true;
//	}
	
}
//alert message for registration link
function registerMessage()
{
	$("#regAnchorId").fancybox().trigger('click');
	return false;
}
function validateVINCorrection()
{
	var previn	 			= $('input[name=previn]');
	var vin	 				= $('input[name=vin]');
	var vinCorrectionType 	= $('select[name="vinCorrectionType"]');
	var grossWeightCategory	= $('select[name="grossWeightCategory"]');
	
	var lang 			= $('input[name=lang]');
	
	document.getElementById('errorMessage').innerHTML  = '';
	$('input').removeClass('errorBdr');
	$('select').removeClass('errorBdr');
	
	if(previn.val()==0)
	{
		document.getElementById('previn').className = 'errorBdr txtBox200px';
		errorMsg('errorMessage','TAX_VIN_INVALID',lang.val());
		return false;
	}
	
	if(previn.val().length !=17)
	{
		document.getElementById('previn').className = 'errorBdr txtBox200px';
		document.getElementById('errorMessage').innerHTML = 'Please enter a 17 digit previous VIN numbers';
		return false;
	}
	if(vin.val()==0)
	{
		document.getElementById('vin').className = 'errorBdr txtBox200px';
		errorMsg('errorMessage','TAX_VIN_INVALID',lang.val());
		return false;
	}
	
	if(vin.val().length !=17)
	{
		document.getElementById('vin').className = 'errorBdr txtBox200px';
		document.getElementById('errorMessage').innerHTML = 'Please enter a 17 digit VIN numbers';
		return false;
	}
	if(previn.val() == vin.val())
	{
		document.getElementById('previn').className = 'errorBdr txtBox200px';
		document.getElementById('vin').className = 'errorBdr txtBox200px';
		document.getElementById('errorMessage').innerHTML = 'Previous and Correction VIN should not be same';
		return false;
	}
	if(vinCorrectionType.val()==0)
	{
		document.getElementById('vinCorrectionType').className = 'errorBdr txtBox150px';
		errorMsg('errorMessage','VIN_TYPE',lang.val());
		return false;
	}
	if(grossWeightCategory.val()==0)
	{
		document.getElementById('grossWeightCategory').className = 'errorBdr txtBox150px';
		errorMsg('errorMessage','TAX_GROSWT',lang.val());
		return false;
	}
		
	if(document.getElementById('yes').checked == false && document.getElementById('no').checked == false)
	{
		errorMsg('errorMessage','SELECT_LORNOT',lang.val());
		return false;								
	}
	
	return true;
}
function validateEditVINCorrection()
{
	var previn	 			= $('select[name=previn]');
	var vin	 				= $('input[name=vin]');
	var vinCorrectionType 	= $('select[name="vinCorrectionType"]');

	
	var lang 			= $('input[name=lang]');
	
	document.getElementById('errorMessage').innerHTML  = '';
	$('input').removeClass('errorBdr');
	$('select').removeClass('errorBdr');
	
	if(previn.val()==0)
	{
		document.getElementById('previn').className = 'errorBdr txtBox200px';
		errorMsg('errorMessage','TAX_VIN_INVALID',lang.val());
		return false;
	}
	
	if(previn.val().length !=17)
	{
		document.getElementById('previn').className = 'errorBdr txtBox200px';
		document.getElementById('errorMessage').innerHTML = 'Please enter a 17 digit previous VIN numbers';
		return false;
	}
	if(vin.val()==0)
	{
		document.getElementById('vin').className = 'errorBdr txtBox200px';
		errorMsg('errorMessage','TAX_VIN_INVALID',lang.val());
		return false;
	}
	
	if(vin.val().length !=17)
	{
		document.getElementById('vin').className = 'errorBdr txtBox200px';
		document.getElementById('errorMessage').innerHTML = 'Please enter a 17 digit VIN numbers';
		return false;
	}
	if(previn.val() == vin.val())
	{
		document.getElementById('previn').className = 'errorBdr txtBox200px';
		document.getElementById('vin').className = 'errorBdr txtBox200px';
		document.getElementById('errorMessage').innerHTML = 'Previous and Correction VIN should not be same';
		return false;
	}
	if(vinCorrectionType.val()==0)
	{
		document.getElementById('vinCorrectionType').className = 'errorBdr txtBox150px';
		errorMsg('errorMessage','VIN_TYPE',lang.val());
		return false;
	}
	
	if(document.getElementById('yes').checked == false && document.getElementById('no').checked == false)
	{
		errorMsg('errorMessage','SELECT_LORNOT',lang.val());
		return false;								
	}
	return true;
}
function getTaxableGrossWeight(vin){
	
	var postParams = '&type=getTaxableGrossWeight&vin='+vin;
	$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
		success: function( data, textStatus )
		{
			var splitData = data.split('~');
			document.getElementById('grossweightlbl').innerHTML  = splitData[0];
			document.getElementById('grossweightlblvalue').value  = splitData[1];
		}
	});	
}
//To get tax year details for 8849S6
function calculateTaxYearMonth()
{ 
	var selectedForm = document.getElementById('taxForm').value;
	
	if(selectedForm == '8849S6')
	{  
		/*
		document.getElementById('earliestDateArea').style.display = 'block';
		document.getElementById('latestDateArea').style.display = 'block';
	
		var type = 'getMonthDetails';
		var postParams = 'type='+type;
		
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				var newData = data.split('|');
				
				document.getElementById('earliestDateId').value = newData['1'];
				document.getElementById('latestDateId').value = newData['2'];
				document.getElementById('taxYearEndMonth_select_area').innerHTML = newData['0'];
			}
		});*/
		
		document.getElementById('taxYearEndMonthArea').style.display = 'block';
		
		var type = 'getMonthList';

		var postParams = 'type='+type;

		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				document.getElementById('taxYearEndMonth_select_area').innerHTML = data;
			}
		});
		
	}
}

function validateVin(vin)
{
	var vinVal = $("#"+vin).val().toUpperCase();
	document.getElementById(vin).value = vinVal;
}

function validateFields(evt,id,inputClass,errorInputClass,errorId,errorMessage,name)
{	
	if(name == 'businessName')
	{	
		var pattern     = /^(([A-Za-z0-9#\-\(\)]|&|') ?)*([A-Za-z0-9#\-\(\)]|&|')+$/;
	}
	else if(name == 'ownerName')
	{	
		var pattern 	= /^(([A-Za-z0-9#\-\(\)]|&|') ?)*([A-Za-z0-9#\-\(\)]|&|')+$/;
	}
	else if(name == 'address')
	{	
		var pattern 	= /^[A-Za-z0-9]( ?[A-Za-z0-9/\-])*$/;
	}
	else if(name == 'personName')
	{	
		var pattern     = /^([A-Za-z0-9'\-] ?)*[A-Za-z0-9'\-]+$/;
	}
	else if(name == 'pin')
	{	
		var pattern     = /^[0-9]{5}$/;
	}
	else if(name == 'city')
	{	
		var bizCountry 	= document.getElementById('bizCountry').value;
		if( bizCountry == '1')
		{	
			var pattern     = /^([A-Za-z] ?)*[A-Za-z]$/;
		}
		else
		{	
			return true;
		}
	}
	else if(name == 'zipcode')
	{	
		var bizCountry 	= document.getElementById('bizCountry').value;
		if( bizCountry == '1')
		{	
			var pattern     = /^[0-9]{5}(([0-9]{4})|([0-9]{7}))?$/;
		}
		else
		{	
			return true;
		}
	}
	else if(name == 'title')
	{	
		var pattern     = /^([!-~] ?)*[!-~]$/;
	}
	else if(name == 'bankAccountNo')
	{	
		var pattern     = /^[A-Za-z0-9\-]+$/;
	}
	
	var stringName 	= document.getElementById(id).value;

	if(stringName !='' && !(pattern.test(stringName))){
		document.getElementById(id).className = errorInputClass;
		document.getElementById(errorId).innerHTML = errorMessage;
		document.getElementById(id).value = '';
		return false;
	}else{
		document.getElementById(id).className = inputClass;
		document.getElementById(errorId).innerHTML = '';
		return true;
	}
	
}

function validateZipcode(evt,id,inputClass,errorInputClass,errorId,errorMessage)
{
	var bizZip 				= document.getElementById('bizZip').value;
	var bizCountry 			= document.getElementById('bizCountry').value;
	var zipcodeFilter 		= new RegExp("^[0-9]+$");
	
	document.getElementById('error_msg').innerHTML  = '';
	$('input').removeClass('errorBdr');
	
	if( bizCountry == '1')
	{   
		if(bizZip.length < 5 || bizZip.length > 5) 
		{	
			document.getElementById('bizZip').className = errorInputClass;
			document.getElementById('bizZip').value = '';
			document.getElementById(errorId).innerHTML = errorMessage;
			return false;
		}
		else if(!(zipcodeFilter).test(bizZip))
		{	
			document.getElementById('bizZip').className = errorInputClass;
			document.getElementById('bizZip').value = '';
			document.getElementById(errorId).innerHTML = errorMessage;
			return false;
		}
		
		document.getElementById(errorId).innerHTML = '';
	}
	else
	{
		document.getElementById(errorId).innerHTML = '';
		document.getElementById('bizZip').className = inputClass;
	}
}
function clearLicense()
{ 
	document.getElementById('suggestions').style.display = 'none';
}
function validateVin(vin)
{
	var vinVal = $("#"+vin).val().toUpperCase();
	document.getElementById(vin).value = vinVal;
}