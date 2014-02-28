<!--Selected Business Name-->
	<?php 
	$MCrypt	= new MCrypt;
	if(isset($_SESSION['selectedbusiness'])){?>
	<div class="marTop20px">
		<strong class="blueTxt"><?php echo $constantArr['selectedBusiness'][$_SESSION['lang']];?></strong>: 
		<?php 
		$businessid = $_SESSION['selectedbusiness'];
		$businessdetails =  getbusinessname($businessid);
		echo $MCrypt->decrypt($businessdetails['name']);
		?>
	</div>
	<?php }?>
	<!--Tax Filing wizard starts here--->
	<div id="wizardList" class="marTop20px">
		<ul>
			<li class="<?php echo $Currentpage == 'taxyear' ? 'selected' : ''; ?>"><?php echo $constantArr['taxyrforms'][$_SESSION['lang']];?></li>
			<li class="<?php echo ($Currentpage == 'taxablevehicleinfo' || $Currentpage == 'lowmileagecredit' 
									|| $Currentpage == 'tgwincreased' || $Currentpage == 'overpayment' || $Currentpage == 'solddestroycredit'
									|| $Currentpage == 'currentyrsuspend' || $Currentpage == 'prioryrsuspend' || $Currentpage == 'exceededmileage') ? 'selected' : ''; ?>"><?php echo $constantArr['vehiclestax'][$_SESSION['lang']];?></li>
			<?php if(isset($_SESSION['formtype']) && $_SESSION['formtype']!= "8849S6"){ ?><li class="<?php echo ($Currentpage == 'paymentoption')? 'selected' : '';?>"><?php echo $constantArr['payment_mode'][$_SESSION['lang']];?></li><?php } ?>
			<li class="<?php echo $Currentpage == 'summary' ? 'selected' : ''; ?>"><?php echo $constantArr['form_summary'][$_SESSION['lang']];?></li>
			<li class="<?php echo $Currentpage == 'productpayment' ? 'selected' : ''; ?>"><?php echo $constantArr['submissionfee'][$_SESSION['lang']];?></li>
			<li class="<?php echo $Currentpage == 'paymentsuccess' ? 'selected' : ''; ?>"><?php echo $constantArr['irssubmission'][$_SESSION['lang']];?></li>
		</ul>
		<br clear="all"/>
	</div>