<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : email_subscription.php
 * @version  : 1.0
 * @date  : 2-Aug-2012
 *
 * @description :
 *
 * @author      : Akila
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Akila        		 2-Aug-2012            Initial Version - File Created
 * 
 */
?>
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/constants.php');
ini_set("display_errors",0);

	global $DBH;

   	$sql = "SELECT email FROM `tt_email_subscription` WHERE active = 1";
	$res = $DBH->prepare($sql);
	$res->execute(array());
	$res->setFetchMode(PDO::FETCH_ASSOC);
	while($row = $res->fetch())
	{
		$email = $row['email'];
		$mail_template = sendEmailSubscribtion($email);
		SendEmail($email,'Tax 2290',$mail_template);
	}
	
function sendEmailSubscribtion($email)
{
	$hostName = TT_SITE_NAME;
	$html = '
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
		<html>
		<head><title>Eamil Subscribtion</title></head>
		<body>
			<div style="background:#F5F5F5; width:700px; margin:0px auto; padding:7px;">	
				<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background:#ffffff;">
					<!-- Header Section start -->
					<tr valign="top">
						<td height="150px" style="border-bottom:1px solid #F2882D">
							<div style="background:#C8BBBE; height:45px; border-bottom:3px solid #FBDBC0;">
								<div style="padding-left:20px; padding-top:55px;float:left; width:250px"><a href="'.$hostName.'"><img src="'.$hostName.'/images/logo.png" border="0"></a></div>
								<div style="float:right">
									<div style="float:right; font-size:24px; font-weight:bold; color:#ffffff; padding:7px 7px 0px 0px;">
									</div>
									<div style="clear:both"></div>
								</div>
							</div>
						</td>
					</tr>
					<!-- Body Section Start -->
					<tr valign="top">
						<td>
							<div style="padding-top:10px; padding-left:20px; padding-right:10px;">		
								<div style="padding-top:5px">Hi, <span style="color:#F2882D;"></span></div>
								<div style="padding-top:15px; line-height:24px;">
									Thanks for your subscription with www.simpletrucktax.com
								</div>			
								<div style="padding-top:45px; padding-bottom:10px;"><b>Thanks</b></div>
								<div style="color:#5CB3FF;">Tax Team</div>
							</div>
						</td>
					</tr>
					<!-- Footer Section Start -->
					<tr valign="top">
						<td>
							<div style="background:	#C8BBBE; height:25px; border-top:3px solid #FBDBC0; margin-top:30px; padding:5px">
								<div style="float:left;"><a href="'.$hostName.'" style="color:#000000; text-decoration:none;"></a></div>
								<div style="float:right"><img height="32px" src="'.$hostName.'images/visa.png" alt="Visa" title="Visa"></div>
								<div style="float:right"><img height="32px" src="'.$hostName.'images/master.png" alt="master" title="master"></div>
								<div style="float:right"><img height="32px" src="'.$hostName.'images/america_Exp.png" alt="American" title="American"></div>
							</div>
						</td>
					</tr>	
				</table>		
			</div>
			</div>
		  </body>
		</html>';	
	return $html;
}
function SendEmail($emailto,$subject,$message)
{
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/class.phpmailer.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/class.smtp.php');
	$mail = new PHPMailer();
	$mail->IsSMTP();  
         				  				  			// send via SMTP
	$mail->Host     = "mail.triesten.com";     				 			  // SMTP servers
	$mail->Port     = 25;     				 			 				 // SMTP servers
	$mail->SMTPAuth = true;                       				  		 // turn on SMTP authentication
	$mail->Username = "support@triesten.com";									// SMTP username
	$mail->Password = "tri123";
	$mail->From     = "info@tax2290.com";
	$mail->FromName = "TAX2290";
	$mail->AddAddress($emailto);
	$mail->AddReplyTo($emailto);
	$mail->SetLanguage('en','language/');
	$mail->IsHTML(true);                                  // send as HTML
	$mail->Subject  =  $subject;
	$mail->Body     =  $message;
	$mail->AltBody  =  "";
	$mail->Send();
	
	if(!$mail->Send())
	{
		echo "Message was not sent <p>";
		echo "Mailer Error: " . $mail->ErrorInfo;
		exit;
	}
	else 
	{
		echo "<span style='color:green;'>Successfully sent ........</span><br/>";
	}
}
?>