<?php
require_once( TT_VIEW_PATH . '/header.php' );
global $consentdisclosureArr;
global $taxableVehiInfoArr;
global $regConstArr;
?>
<div class="containerLayout">
	<?php include_once 'sidebar.php';?>
	<div class="maincontainer">
		<div class="alignleft" style="width:100%">
			<div class="border">
					<div class="tableHeader">								
						<div class="alignleft marTop5px"><h2>Consent Disclosure</h2></div>
						<div class="alignright marTop8px"><b>Selected Business:
							<span class="blueTxt"> 
								<?php 
									$businessid = $_SESSION['selectedbusiness'];
									$businessdetails =  getbusinessname($businessid);
									echo $businessdetails['name'];
								?>
							<span></b>
						</div>	
					</div>
					
					<div class="pad30px">
						<div style="clear:both"></div>
						<p class="pad10px">
							<?php echo $consentdisclosureArr['para1'][$_SESSION['lang']]; ?>
						</p>	
						<p class="pad10px">							
							<?php echo $consentdisclosureArr['para2'][$_SESSION['lang']]; ?>
						</p>	
						<p class="pad10px">
							<?php echo $consentdisclosureArr['para3'][$_SESSION['lang']]; ?>
						</p>
					</div>
					
					<form name="consentdisclosure" action="/consentdisclosure/" method="post" onsubmit= "return consentdisvalid();">
						<div class="pad30px">
							<p><?php echo $consentdisclosureArr['consentdisclose'][$_SESSION['lang']]; ?></p>
							<br clear="all">
							<input type="radio" name="contentdisclosure" id="consentyes" value="1" <?php if($data['getconsentdisclosure']['consent_disclosure']=='1') { ?> checked="checked" <?php } ?>> <label for="yes"><?php echo $taxableVehiInfoArr['yeslbl'][$_SESSION['lang']]; ?></label>
							<input class="marLeft10px" type="radio" name="contentdisclosure" id="consentno" value="0" <?php if($data['getconsentdisclosure']['consent_disclosure']=='0') { ?> checked="checked" <?php } ?>> <label for="no"><?php echo $taxableVehiInfoArr['nolbl'][$_SESSION['lang']]; ?></label>
							<a href="#"><img src="/images/helpIcon.png" alt="Help" title="Help" class="marLeft10px"/></a>
						
						<div id="continue" class="marTop10px">
							<input name="savedisclosure" type="submit" class="blueButn100px marRight10px" value="<?php echo $taxableVehiInfoArr['Continuelbl'][$_SESSION['lang']]; ?>"/>
						</div>
						<br clear="all">
						<span id="errorMessage" style="color:red;"></span>
						</div>
					</form>
<!--				<br clear="all">-->
			</div>
		</div>
	</div>
						
	</div>
</div>
