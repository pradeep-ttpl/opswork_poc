<!--Form navigation-->
<?php 
	$formType = $_SESSION['formtype']; 
	if(isset($_SESSION['admin_form_type']) && $_SESSION['admin_form_type'] != ''){
		$formType = $_SESSION['admin_form_type'];					
	}
	
	//To get next page
	$continue = getNextPageBasedOnForm($formType,$parsed[1]);
	
	//To get previous page
	$back = getBackPageBasedOnForm($formType,$parsed[1]);
?>
<div class="alignright marTop20px">
	<input onclick="javascript:window.location='/<?=$back?>/';" type="button" class="blueButn60px" value="<?php echo $constantArr['goback'][$_SESSION['lang']]; ?>" alt="<?php echo $constantArr['tax_year_forms'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['tax_year_forms'][$_SESSION['lang']]; ?>" />
	<?php if($_SESSION['formtype']!= '8849S6'){	?>
		<input onclick="javascript:window.location='/<?=$continue?>/';" type="button" class="blueButn100px marLeft10px" value="<?php echo $constantArr['continuelbl'][$_SESSION['lang']]; ?>" alt="<?php echo $constantArr['payment_mode'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['payment_mode'][$_SESSION['lang']]; ?>" />
	<?php } else {?>
		<input onclick="javascript:window.location='/<?=$continue?>/';" type="button" class="blueButn100px marLeft10px" value="<?php echo $constantArr['continuelbl'][$_SESSION['lang']]; ?>" alt="<?php echo $constantArr['form_summary'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['form_summary'][$_SESSION['lang']]; ?>" />
	<?php }?>
</div>
<br clear="all" />
