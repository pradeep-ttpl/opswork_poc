<?php
//Registration mail content
function registrationMailcontent($userfirstname,$usermail,$userpwd,$activeUrl)
{	
	$currentDate = date("Y-m-d");
	
	$mailMessage ='<html>
					<head>
						<title>Simple Truck Tax</title>
					</head>
					<body style="background:#FFFFFF; border-left:1px solid #EA7425; border-top:1px solid #EA7425; border-right:1px solid #0E85CA; border-bottom:1px solid #0E85CA;width:705px;margin:0px auto;font-size:13px;font-family:arial;">
						<div style="background:#F8F8F8; padding:15px;">
							<div><img src="'.TT_SITE_NAME.'/images/emailTmlt-logo.png"/></div>
						</div>
						<div style="padding:15px;">
							<div style="float:left; font-size:18px; color:#333333;">User Registration</div>	
							<div style="float:right; font-size:14px;">Date: '.date('d M Y',strtotime($currentDate)).' </div>
							<br clear="all"/>
						</div>
						<hr style="color:#E8E8E8; margin:0px;" noshade="noshade" size="1">
						<div style="padding:15px;">
							<div>Dear <span style="font-weight:bold;">'.$userfirstname.'</span></div>
							<div style="margin-top:15px;">Welcome. You have successfully registered with SimpleTruckTax.</div>';							
							//<div style="padding-top:5px">Please <a style="color:#0E85CA;text-decoration:none;" href="'.$activeUrl.'">click here</a> to confirm your account</div>
							
			//$mailMessage .='<div style="padding-top:20px;">You can access SimpleTruckTax any time at: <a href="http://www.simpleTruckTax.com" alt="www.simpleTruckTax.com" title="www.SimpleTruckTax.com">www.simpletrucktax.com</a></div>
			$mailMessage .='<div style="padding-top:20px">
								SimpleTruckTax.com helps you to figure and pay the tax that is due on the highway motor vehicles( Form 2290), Claim credits on overpaid amount, sold or destroyed vehicles and low mileage vehicles( Form 8849), Amend Form 2290 and VIN correction. 
							</div>								
							<div style="padding-top:20px;">Thank you! We hope that you file your return with ease using SimpleTruckTax.com.</div>
							<div style="padding-top:40px">Sincerely,</div>
							<div style="font-weight:bold;padding-top:30px">SimpleTruckTax Team </div>
							<div style="padding-top:5px"><a href="mailto:support@simpletrucktax.com" style="color:#0E85CA;text-decoration:none;" alt="Contact Us" title="Contact Us">support@simpletrucktax.com</div>
							<div style="padding-top:5px"><a href="http://www.simpletrucktax.com" style="color:#0E85CA;text-decoration:none;" alt="www.simpletrucktax.com" title="www.simpletrucktax.com">www.simpletrucktax.com</a></div>
						</div>
						<div style="background:#EA7425; padding:12px; margin-top:15px;">	
							<div style="float:left; font-weight:bold; color:#ffffff;" >For any queries please contact:</div>
							<div style="float:right; font-weight:bold; color:#ffffff;">
								<span> 1888-361-7644 </span> &nbsp; |
								<a style="color:#ffffff; text-decoration:none;" href="http://www.simpletrucktax.com/faq" alt="FAQ" title="FAQ">&nbsp; FAQ </a> &nbsp; |
								<a style="color:#ffffff; text-decoration:none;" href="http://www.simpletrucktax.com/contactus" alt="Contact Us" title="Contact Us">&nbsp; Contact Us </a>
							</div>
							<br clear="all"/>
						</div>
						<div style="background:#0E85CA; padding:7px 0px 15px 12px;height:15px">	
							<div style="float:left; font-weight:bold; padding-top:5px;width:300px;">
								<a style="color:#ffffff; text-decoration:none;" href="http://www.simpletrucktax.com"> www.simpletrucktax.com </a>
							</div>	
							<div style="float:right; font-weight:bold;width:300px;text-align:right">
								<a style="color:#ffffff; text-decoration:none;" href="https://www.facebook.com/SimpleTruckTax" alt="Facebook" title="Facebook"><img src="'.TT_SITE_NAME.'/images/fb.png" alt="" title=""/></a>
								<a style="color:#ffffff; text-decoration:none;" href="https://twitter.com/SimpleTruck" alt="Twitter" title="Twitter"><img src="'.TT_SITE_NAME.'/images/twt.png" alt="" title=""/></a>
								<a style="color:#ffffff; text-decoration:none;" href="http://www.linkedin.com/company/simpletrucktax-com?trk=company_name" alt="Linked In" title="Linked In"><img src="'.TT_SITE_NAME.'/images/in.png" alt="" title=""/></a>
								<a style="color:#ffffff; text-decoration:none;" href="http://www.pinterest.com/simpletrucktax/" alt="Pinterest" title="Pinterest"><img src="'.TT_SITE_NAME.'/images/prnt-icon.png" alt="" title=""/></a>
								<a style="color:#ffffff; text-decoration:none;" href="https://www.youtube.com/watch?v=k_-_bRH9GLM" alt="youTube" title="youTube"><img src="'.TT_SITE_NAME.'/images/yout-icon.png" alt="" title=""/></a>
							</div>
							<br clear="all"/>
						</div>
					</body>
				</html>';
	
	return $mailMessage;
}
/**
 * Return the mail content of forgot password
 */ 
function forgotPwdMailcontent($firstname,$email,$forgotpwdUrl)
{
	$currentDate = date("d-m-Y");
	$message = '<html>
					<head>
						<title>Simple Truck Tax</title>
					</head>
					<body style="background:#FFFFFF; border-left:1px solid #EA7425; border-top:1px solid #EA7425; border-right:1px solid #0E85CA; border-bottom:1px solid #0E85CA;width:705px;margin:0px auto;font-size:13px;font-family:arial;">
						<div style="background:#F8F8F8; padding:15px;">
							<div><img src="'.TT_SITE_NAME.'/images/emailTmlt-logo.png"/></div>
						</div>
						<div style="padding:15px;">
							<div style="float:left; font-size:18px; color:#333333;">Forgot Password</div>	
							<div style="float:right; font-size:14px;">Date: '.date('d M Y',strtotime($currentDate)).' </div>
							<br clear="all"/>
						</div>
						<hr style="color:#E8E8E8; margin:0px;" noshade="noshade" size="1">
						<div style="padding:15px;">
							<div>Dear <span style="font-weight:bold;">'.ucfirst($firstname).'</span></div>
							<div style="margin-top:20px;">As requested, to change the password for <a style="color:#1983CD;text-decoration:underline;" href="">Simple Truck Tax</a> is given below:</div>
							<div style="padding-top:10px">Email : '.$email.'</div>
							<div style="padding-top:5px">Please <a href="'.$forgotpwdUrl.'">click here </a> to create a new password</div>
							<p align="justify" style="padding-top:10px">
							We recommend you to change the password after the first time you login. To change the password, please click the My Account tab. Do save the account information as you require it every time you login SimpleTruckTax.com
							</p>
							<p align="justify">
							SimpleTruckTax.com helps you to figure and pay the tax that is due on the highway motor vehicles( Form 2290), Claim credits on overpaid amount, sold or destroyed vehicles and low mileage vehicles( Form 8849), Amend Form 2290 and VIN correction. 
							</p>
							<p>
								Thank you! We hope that you benefit using SimpleTruckTax.com.
							</p>
							
							<div style="padding-top:40px">Sincerely,</div>
							<div style="font-weight:bold;padding-top:30px">SimpleTruckTax Team </div>
							<div style="padding-top:5px"><a href="mailto:support@simpletrucktax.com" style="color:#0E85CA;text-decoration:none;" alt="Contact Us" title="Contact Us">support@simpletrucktax.com</div>
							<div style="padding-top:5px"><a href="http://www.simpletrucktax.com" style="color:#0E85CA;text-decoration:none;" alt="www.simpletrucktax.com" title="www.simpletrucktax.com">www.simpletrucktax.com</a></div>
						</div>
						<div style="background:#EA7425; padding:12px; margin-top:15px;">	
							<div style="float:left; font-weight:bold; color:#ffffff;" >For any queries please contact:</div>
							<div style="float:right; font-weight:bold; color:#ffffff;">
								<span> 1888-361-7644 </span> &nbsp; |
								<a style="color:#ffffff; text-decoration:none;" href="http://www.simpletrucktax.com/faq" alt="FAQ" title="FAQ">&nbsp; FAQ </a> &nbsp; |
								<a style="color:#ffffff; text-decoration:none;" href="http://www.simpletrucktax.com/contactus" alt="Contact Us" title="Contact Us">&nbsp; Contact Us </a>
							</div>
							<br clear="all"/>
						</div>
						<div style="background:#0E85CA; padding:7px 0px 15px 12px;height:15px">	
							<div style="float:left; font-weight:bold; padding-top:5px;width:300px;">
								<a style="color:#ffffff; text-decoration:none;" href="http://www.simpletrucktax.com"> www.simpletrucktax.com </a>
							</div>	
							<div style="float:right; font-weight:bold;width:300px;text-align:right">
								<a style="color:#ffffff; text-decoration:none;" href="https://www.facebook.com/SimpleTruckTax" alt="Facebook" title="Facebook"><img src="'.TT_SITE_NAME.'/images/fb.png" alt="" title=""/></a>
								<a style="color:#ffffff; text-decoration:none;" href="https://twitter.com/SimpleTruck" alt="Twitter" title="Twitter"><img src="'.TT_SITE_NAME.'/images/twt.png" alt="" title=""/></a>
								<a style="color:#ffffff; text-decoration:none;" href="http://www.linkedin.com/company/simpletrucktax-com?trk=company_name" alt="Linked In" title="Linked In"><img src="'.TT_SITE_NAME.'/images/in.png" alt="" title=""/></a>
								<a style="color:#ffffff; text-decoration:none;" href="http://www.pinterest.com/simpletrucktax/" alt="Pinterest" title="Pinterest"><img src="'.TT_SITE_NAME.'/images/prnt-icon.png" alt="" title=""/></a>
								<a style="color:#ffffff; text-decoration:none;" href="https://www.youtube.com/watch?v=k_-_bRH9GLM" alt="youTube" title="youTube"><img src="'.TT_SITE_NAME.'/images/yout-icon.png" alt="" title=""/></a>
							</div>
							<br clear="all"/>
						</div>
					</body>
				</html>';
	return $message;
}

/**
 * Return the mail content of userLoginDetails
 */ 
function userLoginDetails($user_first_name,$user_email,$pwd)
{
	$currentDate = date("d-m-Y");
	$message = '<html>
					<head>
						<title>Simple Truck Tax</title>
					</head>
					<body style="background:#FFFFFF; border-left:1px solid #EA7425; border-top:1px solid #EA7425; border-right:1px solid #0E85CA; border-bottom:1px solid #0E85CA;width:705px;margin:0px auto;font-size:13px;font-family:arial;">
						<div style="background:#F8F8F8; padding:15px;">
							<div><img src="'.TT_SITE_NAME.'/images/emailTmlt-logo.png"/></div>
						</div>
						<div style="padding:15px;">
							<div style="float:left; font-size:18px; color:#333333;">User Registration</div>	
							<div style="float:right; font-size:14px;">Date: '.date('d M Y',strtotime($currentDate)).' </div>
							<br clear="all"/>
						</div>
						<hr style="color:#E8E8E8; margin:0px;" noshade="noshade" size="1">
						<div style="padding:15px;">
							<div>Dear <span style="font-weight:bold;">'.ucfirst($user_first_name).'</span></div>
							<div style="margin-top:20px;">The login details for <a style="color:#1983CD;text-decoration:underline;" href="">Simple Truck Tax</a> is given below:</div>
							<div style="padding-top:10px">Email : '.$user_email.'</div>
							<div style="padding-top:10px">Password : '.$pwd.'</div>
							<p align="justify">
							SimpleTruckTax.com helps you to figure and pay the tax that is due on the highway motor vehicles( Form 2290), Claim credits on overpaid amount, sold or destroyed vehicles and low mileage vehicles( Form 8849), Amend Form 2290 and VIN correction. 
							</p>
							<p>
								Thank you! We hope that you benefit using SimpleTruckTax.com.
							</p>
							
							<div style="padding-top:40px">Sincerely,</div>
							<div style="font-weight:bold;padding-top:30px">SimpleTruckTax Team </div>
							<div style="padding-top:5px"><a href="mailto:support@simpletrucktax.com" style="color:#0E85CA;text-decoration:none;" alt="Contact Us" title="Contact Us">support@simpletrucktax.com</div>
							<div style="padding-top:5px"><a href="http://www.simpletrucktax.com" style="color:#0E85CA;text-decoration:none;" alt="www.simpletrucktax.com" title="www.simpletrucktax.com">www.simpletrucktax.com</a></div>
						</div>
						<div style="background:#EA7425; padding:12px; margin-top:15px;">	
							<div style="float:left; font-weight:bold; color:#ffffff;" >For any queries please contact:</div>
							<div style="float:right; font-weight:bold; color:#ffffff;">
								<span> 1888-361-7644 </span> &nbsp; |
								<a style="color:#ffffff; text-decoration:none;" href="http://www.simpletrucktax.com/faq" alt="FAQ" title="FAQ">&nbsp; FAQ </a> &nbsp; |
								<a style="color:#ffffff; text-decoration:none;" href="http://www.simpletrucktax.com/contactus" alt="Contact Us" title="Contact Us">&nbsp; Contact Us </a>
							</div>
							<br clear="all"/>
						</div>
						<div style="background:#0E85CA; padding:7px 0px 15px 12px;height:15px">	
							<div style="float:left; font-weight:bold; padding-top:5px;width:300px;">
								<a style="color:#ffffff; text-decoration:none;" href="http://www.simpletrucktax.com"> www.simpletrucktax.com </a>
							</div>	
							<div style="float:right; font-weight:bold;width:300px;text-align:right">
								<a style="color:#ffffff; text-decoration:none;" href="https://www.facebook.com/SimpleTruckTax" alt="Facebook" title="Facebook"><img src="'.TT_SITE_NAME.'/images/fb.png" alt="" title=""/></a>
								<a style="color:#ffffff; text-decoration:none;" href="https://twitter.com/SimpleTruck" alt="Twitter" title="Twitter"><img src="'.TT_SITE_NAME.'/images/twt.png" alt="" title=""/></a>
								<a style="color:#ffffff; text-decoration:none;" href="http://www.linkedin.com/company/simpletrucktax-com?trk=company_name" alt="Linked In" title="Linked In"><img src="'.TT_SITE_NAME.'/images/in.png" alt="" title=""/></a>
								<a style="color:#ffffff; text-decoration:none;" href="http://www.pinterest.com/simpletrucktax/" alt="Pinterest" title="Pinterest"><img src="'.TT_SITE_NAME.'/images/prnt-icon.png" alt="" title=""/></a>
								<a style="color:#ffffff; text-decoration:none;" href="https://www.youtube.com/watch?v=k_-_bRH9GLM" alt="youTube" title="youTube"><img src="'.TT_SITE_NAME.'/images/yout-icon.png" alt="" title=""/></a>
							</div>
							<br clear="all"/>
						</div>
					</body>
				</html>';
	return $message;
}
/**
 * mail content on Java API call failed
 */ 
function APICommunicationErrorContent($reason, $site)
{
	$currentDate = date("d-m-Y");
	$message = '<html>
					<head>
						<title>Error contacting JAVA API</title>
					</head>
					<body style="background:#FFFFFF; border-left:1px solid #EA7425; border-top:1px solid #EA7425; border-right:1px solid #0E85CA; border-bottom:1px solid #0E85CA;width:705px;margin:0px auto;font-size:13px;font-family:arial;">

						<div style="padding:15px;">
							<div>Could not connect to JAVA API</div>
							<div>Site: '.$site.'</div>
							<div style="margin-top:20px;">Time: '.date('d M Y',strtotime($currentDate)).'</div>
						</div>

					</body>
				</html>';
	return $message;
}

/**
 * mail content on XSD validation error list
 */ 
function summaryXSDValidationFailed($user_name, $user_mail, $user_phone, $error_list, $filingId, $site)
{
	$currentDate = date("d-m-Y");
	$message = '<html>
					<head>
						<title>XSD Validation Errors</title>
					</head>
					<body style="background:#FFFFFF; border-left:1px solid #EA7425; border-top:1px solid #EA7425; border-right:1px solid #0E85CA; border-bottom:1px solid #0E85CA;width:705px;margin:0px auto;font-size:13px;font-family:arial;">

						<div style="padding:15px;">
							<div>XSD Validation Errors</div>
							<div>Site: '.$site.'</div>
							<div style="margin-top:20px;">Time: '.date('d M Y',strtotime($currentDate)).'</div>
							<div style="margin-top:20px;">Username: '.$user_name.'</div>
							<div style="margin-top:10px;">User email: '.$user_mail.'</div>
							<div style="margin-top:10px;">User Phone: '.$user_phone.'</div>
							<div style="margin-top:10px;">Filing ID: '.$filingId.'</div>
							<div style="margin-top:20px;">Errors: <br/>';

	foreach ($error_list AS $values)
	{
		$message .= '   * '. $values . '</br>';
	}
	
	$message .=			'</div>
						</div>

					</body>
				</html>';
	return $message;
}
?>