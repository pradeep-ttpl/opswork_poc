<?php

/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: header.php
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
 if(!isset($_SESSION['user_id']))
 header('location:/');
 
if($_SESSION['admin_allowed'] != 1)
{
	header('Location: /taxpayerbusiness/');				
	exit();	
}
 
$request = $_SERVER['REQUEST_URI']; 
$parsed = explode('/', $request);

$Currentpage = preg_replace( '|[^a-z0-9-]+|', '', $parsed[2] );

$premissionArray = chkPagePermissions($Currentpage);
?>

<html>
	<head>
		<title>www.simpletrucktax.com - Simple steps to file your vehicles tax</title>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
		<meta content="utf-8" http-equiv="encoding" />
		<link type="text/css" rel="stylesheet" media="screen" href="/admin/css/style.css">
		<link type="text/css" rel="stylesheet" media="screen" href="/admin/css/layout.css">

<!--	<script type="text/javascript" src="/js/tooltip.js" ></script>	-->
<!--	<script type="text/javascript" src="/js/jquery-1.8.0.min.js"></script>-->
<!--	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>-->
		
		<script type="text/javascript" src="/js/jquery.min.js"></script>
		<script type="text/javascript" src="/js/fancybox/jquery.fancybox.js?v=2.1.0"></script>
		<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox.css?v=2.1.0" media="screen" />
		
		<script type="text/javascript" src="/js/common.js"> </script>
		<script type="text/javascript" src="/admin/js/common.js"> </script>
		<script type="text/javascript" src="/admin/js/validate.js"> </script>
		
		<!--	Table sorter -->
		<link rel="stylesheet" href="/admin/js/css/theme.blue.css">
		<script src="/admin/js/jquery.tablesorter.js"></script>
		<script src="/admin/js/jquery.tablesorter.widgets.js"></script>
		
		<!-- Date Picker JS and CSS -->
		<link rel="stylesheet" href="/js/datepicker/jquery.ui.all.css" />
			<script type="text/javascript" src="/js/datepicker/jquery.ui.core.js"> </script>
			<script type="text/javascript" src="/js/datepicker/jquery.ui.datepicker.js"> </script>
			<link rel="stylesheet" href="/js/datepicker/demos.css" />
		<!-- End of Date Picker JS and CSS -->
		
	</head>
	<script>
	// fancy box
	$(document).ready(function() {
		$('.fancybox').fancybox();
	});
	</script>
	<!----------body section starts here--------------->
	<body>
		<div class="adminContainer">
			<div class="border">
				<div class="topgrayBG">
					<div class="alignleft">
						<a href="/admin/dashboard"><img title="www.simpletrucktax.com" alt="www.simpletrucktax.com" src="/images/ettLogo.png" width="300px"/></a>
					</div>
					<div class="alignright padTop10px textAlignRight" id="topNav">
						<ul>
							<li><h3>Welcome <?php echo getUserName($_SESSION['user_id']);?>!</h3>
							<li>
								<a href="/" alt="Visit User Home Page" title="Visit User Home Page">Back to user site</a> | 
								<a href="/admin/myprofile" alt="My Profile" title="My Profile">Edit Profile</a> | 
								<a href="/logout" alt="Logout" title="Logout">Logout</a>
							</li>
						</ul>
					</div>
					<br clear="all"/>
				</div>
				<?php if($parsed[2]!='dashboard'){?>
				<div class="navList">
					<ul>
						<li><a href="/admin/dashboard" alt="Home" title="Home">Home</a></li>
						<?php 
							if(isset($_SESSION['menuArray']) && count($_SESSION['menuArray']) > 0)
							{
								foreach($_SESSION['menuArray'] as $key => $values)
								{
						?> 
									<li class="<?php echo($values['menuName'] == $Currentpage)? 'selected':''?>" >
										<a href="/admin/<?php echo $values['menuName'];?>" alt="<?php echo $values['menuDisplayName'];?>" title="<?php echo $values['menuDisplayName'];?>"><?php echo $values['menuDisplayName'];?></a>
									</li>
						<?php 		
								}
							}
						?>
					</ul>
				</div>
				<?php }?>
				<div class="pad25px">
					<h1 class="botBdr">
						<?php
							if($Currentpage == 'dashboard'){
								echo "Dashboard";
							} else if($Currentpage == 'usermaster'){
								echo "Admin User Management";
							} else if($Currentpage == 'menucontrolpanel'){
								echo "Menu Management";
							} else if($Currentpage == 'filingslist'){
								echo "Filing List";
							} else if($Currentpage == 'paymenthistory'){
								echo "Payment History";
							} else if($Currentpage == 'privilegemaster'){
								echo "Privilege Management";
							} else if($Currentpage == 'refiling'){
								echo "Re-Filing";
							} else if($Currentpage == 'customerlist'){
								echo "Customer Lists";
							} else if($Currentpage == 'diagnose'){
								echo "Filing Log";
							} else if($Currentpage == 'couponmanagement'){
								echo "Coupon Management";
							}else if($Currentpage == 'recentfilings'){
								echo "Recent Filings";
							}else{
								echo $Currentpage;
							}
						?>
					</h1>
