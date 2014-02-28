<?php 
$formType = $_SESSION['formtype']; 
if(isset($_SESSION['admin_form_type']) && $_SESSION['admin_form_type'] != '')
{
	$formType = $_SESSION['admin_form_type'];
}

//To get next page
$continue = getNextPageBasedOnForm($formType,$parsed[1]);

//To get previous page
$back = getBackPageBasedOnForm($formType,$parsed[1]);
?>
<div class="alignright">
	<a href="<?php echo '/'.$back;?>" class="blueTxt" alt="<?php echo $constantArr['tax_year_forms'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['tax_year_forms'][$_SESSION['lang']]; ?>"><b><span class="backIcon"></span><?php echo $constantArr['goback'][$_SESSION['lang']]; ?></b></a> 
	<?php if($_SESSION['formtype']!= '8849S6'){	?>
	<a class="blueTxt" href="<?php echo '/'.$continue;?>" alt="<?php echo $constantArr['payment_mode'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['payment_mode'][$_SESSION['lang']]; ?>"><b><?php echo $constantArr['continuelbl'][$_SESSION['lang']]; ?> <span class="continueIcon"></span></b></a>
	<?php } else{?>
	<a class="blueTxt" href="<?php echo '/'.$continue;?>" alt="<?php echo $constantArr['form_summary'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['form_summary'][$_SESSION['lang']]; ?>"><b><?php echo $constantArr['continuelbl'][$_SESSION['lang']]; ?> <span class="continueIcon"></span></b></a>
	<?php }?>
</div>
<br clear="all"/>