<?php 
include_once 'header.php';
global $constantArr;
?>
<!---------maincontainer section starts here------------>
	<div class="border marTop-1px pad30px">
		<?php include_once 'filingsteps.php';?>
		<div class="marTop25px">
			<?php if($data['status']=="success"){ ?>
				<div class="marTop20px statusMsg">
					<strong> <span class="successIcon"></span> Successfully Submitted</strong>
				</div>
				<p class="pad10px">
					Your return has been successfully submitted to IRS. To know the status of your return you can check My Returns page in the application.</br>
					Thank you for using SimpleTruckTax.com. Hope you had a wonderful filing season.
				</p>
			<?php }else if($data['status']=="pending"){ ?>
				<div class="marTop20px statusMsg">
					<strong> <span class="successIcon"></span> Return Queued</strong>
				</div>
				<p class="pad10px">
					Your return is been queued for submission. To know the status of your return you can check My Returns page in the application.</br>
					Thank you for using SimpleTruckTax.com. Hope you had a wonderful filing season.
				</p>
			<?php }else if($data['status']=="duplicate"){ ?>
				<div class="marTop20px errorMsg">
					<strong> <span class="errorIcon"></span> Duplicate Submission</strong>
				</div>	
				<p class="pad10px">To know the status of your return you can check My Returns page in the application.</p>	
			<?php } ?>
			<br clear="all" />
		</div>
	</div>
</div>
</div>
<!---------maincontainer section ends here------------>	
<?php include_once 'footer.php';?>