<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/constants.php');
global $constantArr; 
?>
<div class="width635px">
	<div class="topgrayBG padTop10px padLeft15px">
		<div class="alignleft marTop3px"><h5><?=$constantArr['consentlbl'][$_SESSION['lang']]?></h5></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="Close Popup" title="Close Popup" onclick="parent.$.fancybox.close();" />
		</div>
	</div>
	<div class="padLeft20px padRight20px">
		<p align="justify">
			<?=$constantArr['para1'][$_SESSION['lang']]?>
		</p>
		<p align="justify" class="padTop10px">
			<?=$constantArr['para2'][$_SESSION['lang']]?>
		</p>
		<p align="justify" class="padTop10px">
			<?=$constantArr['para3'][$_SESSION['lang']]?>
		</p>
		<br clear="all"/>
	</div>
</div>
