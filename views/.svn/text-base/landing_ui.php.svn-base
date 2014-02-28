<?php include_once 'header.php';?>
	<div class="bannerBG alignleft">
		<div class="marLeft275px marTop10px">
			<ul class="marTop5px">
				<li>Starting from $ 6.95</li>
				<li>The much simplified e-filing solution for you</li>
				<li>We are no different in the solution we provide. We are so simple in the service we offer.</li>
				<li>We are not measured by the minutes taken to file. We are measured by the ease of use we formed to file</li>
			</ul>
			<div class="bannerHeading marTop35px" > <span class="orngTxt"></span></div>
			<h2 class="registerTxt pad10px"><span class="successIcon"></span>  File Your VIN Corrections for Free</h2>
		</div>
	</div>
	<div class="loginBanner alignright">
		<?php if(isset($_SESSION['user_type'])){?>
			<div class="headrBox">Welcome! <?php echo getUserName($_SESSION['user_id']);?></div>
			<div class="pad10px">
				<p>Welcome to Simple Truck Tax, please check the below links to access your account</p>
				<ul>
					<li class="padTop13px"><span class="myAccount-icon"></span><a href="/myaccount" alt="Edit Profile" title="Edit Profile" class="blueTxt marLeft10px">Edit your profile</a></li>
					<li class="padTop13px"><span class="myFilings-icon"></span><a href="/filestatus" alt="My Filings" title="My Filings" class="blueTxt marLeft10px">View your filings</a></li>
					<!--li class="padTop13px"><span class="myBusinesses-icon"></span><a href="/taxpayerbusiness" alt="My Businesses" title="My Businesses" class="blueTxt marLeft10px">My Businesses </a></li-->
					<!--li class="padTop13px"><span class="myVehicles-icon"></span><a href="/fleet" alt="My Vehicles" title="My Vehicles" class="blueTxt">My Vehicles </a></li-->
					<!--li class="padTop13px"><span class="myReturnstatus-icon"></span><a href="/filestatus" alt="My Returns" title="My Returns" class="blueTxt marLeft10px">My returns </a></li-->
					<li class="padTop13px "><span class="myLogout-icon"></span><a href="/logout" alt="Logout" title="Logout" class="blueTxt marLeft10px">Logout</a></li>
				</ul>
			</div>
		<?php } else {?>
			<div class="headrBox"><?=$constantArr['loginhere'][$_SESSION['lang']]?> </div>
			<form action="/login/" method="post" enctype="multipart/form-data" name="loginform" id="loginform">
				<div class="pad10px">
					<div class="marTop15px"><input value="<?php echo (isset($_POST['email']))?$_POST['email']:'';?>" type="text" id="email" name="email" maxlength="64" class="txtBox245px" placeholder="<?=$constantArr['emailAddress'][$_SESSION['lang']]?>" /></div>	
										
					<div class="marTop25px"><input type="password" id="pwd" name="pwd" maxlength="15" class="txtBox245px" placeholder="<?=$constantArr['password'][$_SESSION['lang']]?>" /></div>
					
					<div id="error_msg" class="marTop5px redTxt">&nbsp;<?php if(isset($data['status'])){ echo $data['status'];}?></div>					

					<!--<div class="marTop10px">	
						<input value="1" id="rememberMe" class="marRight5px" type="checkbox" name="rememberMe" /><?=$constantArr['rememberMe'][$_SESSION['lang']]?>	
					</div>-->
					<div class="marTop10px smallFont"><a class="blueTxt" href="/forgotpassword"><?=$constantArr['needHelpAccessingAccount'][$_SESSION['lang']]?></a></div>	
					<?php
					if(DISABLE_REGISTRATION == 1){?>
					<div class="marTop10px smallFont"><?=$constantArr['newToStt'][$_SESSION['lang']]?><a class="blueTxt" href="#" onclick="registerMessage()"> <?=$constantArr['register'][$_SESSION['lang']]?></a></div>	
					<?php } else {?>
					<div class="marTop10px smallFont"><?=$constantArr['newToStt'][$_SESSION['lang']]?><a class="blueTxt" href="/register"> <?=$constantArr['register'][$_SESSION['lang']]?></a></div>	
					<?php } ?>
					<div class="marTop40px">
						<div class="alignleft">
							<?php if(DISABLE_REGISTRATION == 1){?>
								<a href="#" onclick="registerMessage()">
									<input type="button" class="fbButton" value="<?=$constantArr['loginWithFB'][$_SESSION['lang']]?>"/>
								</a>
							<?php } else {?>
								<a href="/include/facebook.php?signin=true" alt="<?=$constantArr['loginWithFB'][$_SESSION['lang']]?>" title="<?=$constantArr['loginWithFB'][$_SESSION['lang']]?>">
									<input type="button" class="fbButton" value="<?=$constantArr['loginWithFB'][$_SESSION['lang']]?>"/>
								</a>
							<?php } ?>
						</div>
						<div class="alignright"><input class="blueButn100px" type="submit" value="<?=$constantArr['login'][$_SESSION['lang']]?>" name="Login"></div>
					</div>
					<br clear="all"/>
				</div>
			</form>
		<?php } ?>
	</div>
	<br clear="all"/>
</div>
<div class="marTop30px">
	<div class="alignleft">
		<div id="tabbed_box_1" class="tabbed_box">
			<ul class="tabs">  
				<li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Form 2290</a></li>  
				<li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Form 8849</a></li> 
			</ul>  								  
			<div id="content_1" class="content">
				<div class="marRight25px alignleft"><img src="/images/truck-image1.png"> </div>
				<div class="width635px alignleft">
					<h3>Form 2290 (Schedule-1)</h3>
					<p class="padTop5px">Filing through online has become mandate. Hence we took significant effort to make it simple</p>
					<ul>
						<li>HVUT filing in much simplified way.</li>
						<li>Form 2290, Schedule 1 filing at ease</li>
						<li>USA based support over Phone, Chat &amp; Email</li>
						<li>Safe &amp; Secure </li>
						<li>You can complete the filing in just two pages</li>
					</ul>										
				</div>
				<br clear="all"/>
			</div>  
			<div id="content_2" class="content">
				<div class="marRight25px alignleft"><img src="/images/truck-image2.png"> </div>
				<div class="width635px alignleft">
					<h3>Form 8849 (Schedule-6)</h3>
					<ul>
						<li>Claim for refund of excise taxes made easy</li>
						<li>Supports Form 8849- Schedule 6</li>
						<li>E-file Form 8849 in just few clicks</li>
						<li>With SSN or EIN you can file Form 8849</li>
						<li>Claim the amount overpaid by mistake in Form 2290</li>
						<li>Claim refund for the tax paid on vehicles that were sold, destroyed or stolen.</li>
						<li>Claim refund for the tax paid on the vehicle that was used less than the mileage limit.</li>
					</ul>									
				</div>
				<br clear="all"/>
			</div>			
		</div>
	</div>
</div>	
<?php include_once 'footer.php';?>
