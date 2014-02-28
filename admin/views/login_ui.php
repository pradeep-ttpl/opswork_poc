<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: login_ui.php
 * @version  	: 1.0
 * @date  		: 12-Dec-2013
 *
 * @description :
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        12-Dec-2013           Initial Version - File Created
 * 
 */

if((isset($_SESSION['user_type']) && $_SESSION['user_type'] !=2 && isset($_SESSION['user_id'])) )
{
	header('Location: '.TT_ADMIN_SITE_NAME.'dashboard/');				
	exit();	
}
else if(isset($_SESSION['user_type']) && $_SESSION['user_type'] ==2 )
{
	header('Location: /taxpayerbusiness/');				
	exit();	
}

$request = $_SERVER['REQUEST_URI']; 
$parsed = explode('/', $request);
$Currentpage = preg_replace( '|[^a-z0-9-]+|', '', $parsed[2] );
?>
<html>
	<head>
		<title>www.simpletrucktax.com - Simple steps to file your vehicles tax</title>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
		<meta content="utf-8" http-equiv="encoding" />
		<link type="text/css" rel="stylesheet" media="screen" href="css/style.css">
		<link type="text/css" rel="stylesheet" media="screen" href="css/layout.css">
		<script type="text/javascript" src="/js/jquery-1.6.1.min.js"> </script>
		<script type="text/javascript" src="/js/common.js"> </script>
	</head>
	<body>
		<div class="loginContainer">
			<img title="www.simpletrucktax.com" alt="www.simpletrucktax.com" src="images/ettLogo.png" width="300px"/>
			<div class="border marTop20px">
				<div class="loginBox pad10px">
					<h1>Admin Login</h1>
				</div>
				<div class="loginFormArea pad10px">
					<form action="/admin/login" method="post" autocomplete="off" enctype="multipart/form-data" name="adminloginform" id="adminloginform">
						<p>
							<label class="xsmall">Email Address:</label>
							<input type="text" id="email" name="email" class="txtBox245px">
						</p>
						<p>
							<label class="xsmall">Password:</label>
							<input type="password" id="pwd" name="pwd" class="txtBox245px">
						</p>
						<p class="marTop10px">
							<label class="xsmall">&nbsp;</label>
							<span id="error_msg" class="redTxt"><?php if(isset($data['status'])){ echo $data['status'];}?></span><br/>
							<label class="xsmall">&nbsp;</label>
							<input type="submit" value="Login"  name="Login" class="blueButn100px marTop5px"/>
							<input type="reset" value="Reset" class="blueButn100px marLeft10px" onclick="cleartext();"/>
						</p>
					</form>
					<br clear="all"/>
				</div>
			</div>
		</div>
	</body>
<!----------body section ends here--------------->
</html>					
					