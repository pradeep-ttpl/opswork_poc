<?php 
include_once 'header.php';
?>
<div class="border marTop-1px pad30px">
	<!--Instruction area-->
	<div>
		<h2 class="greenTxt"><?=$constantArr['account_creation'][$_SESSION['lang']]?></h2>
		<p class="padTop5px"><?=$constantArr['check_mail'][$_SESSION['lang']]?></p>
		<p class="padTop10px"><a href="/" alt="Home" title="Home" class="blueTxt"><?=$constantArr['loginhere'][$_SESSION['lang']]?></a></p>
	</div>
</div>
<?php include_once 'footer.php';?>
