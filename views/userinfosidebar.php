<div id="leftNav" class="alignleft">
	<ul>
		<li class="<?php echo ($Currentpage == 'myaccount' && $parsed[2] !='profilechangepassword')? 'selected':'';?>">
		<a href="/myaccount/"><?php echo $constantArr['myaccount'][$_SESSION['lang']];?></a>
		</li>
		<?php if($userDetails['is_facebook_login'] == 'N'){?>
		<li class="<?php echo (isset($parsed[2]) && $parsed[2] == 'profilechangepassword')? 'selected':'';?>">
			<a href="/myaccount/profilechangepassword/"><?php echo $constantArr['changepwdlbl'][$_SESSION['lang']];?></a>
		</li>
		<?php }?>
		<li class="<?php echo ($Currentpage == 'paymenttransaction')? 'selected':'';?>">
			<a href="/paymenttransaction/"><?php echo $constantArr['myTransaction'][$_SESSION['lang']];?></a>
		</li>
	</ul>
</div>