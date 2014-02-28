<?php include_once 'header.php';
global $constantArr;
?>
<div class="border marTop-1px pad30px">
	<!--Instruction area-->
	<div class="botBdr padBottom10px pageTipContentAreaBg">	
		<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="<?=$constantArr['information'][$_SESSION['lang']]?>" title="<?=$constantArr['information'][$_SESSION['lang']]?>" class="alignleft" /></div>
		<div class="alignleft width930px padLeft10px pageTipContentArea">
			<?=$constantArr['changePwdInfo'][$_SESSION['lang']]?>
		</div>
		<br clear="all"/>
	</div>
	<form action="" method="post" enctype="multipart/form-data" name="changepwdform" id="changepwdform">
		<div class="marTop30px">
				<p><b><?=$constantArr['changepwdlbl'][$_SESSION['lang']]?></b></p> 
				<p>
					<?php 
					if(!empty($data['status']))
					{?>
					<div class="statusMsg"><span class="successIcon"></span><?php echo $data['status']; }?></div> 
				</p>
				<p>
					<label class="small"><?=$constantArr['newpassword'][$_SESSION['lang']]?>:</label>
					<input type="password" id="pwd" name="pwd" class="txtBox320px" maxlength="50"
					onblur="return checkPassword(event,this.id,'txtBox320px','txtBox320px errorBdr','error_msg','<?=$constantArr['EnterValidPassword'][$_SESSION['lang']]?>')",onKeypress="clearErrbdr('pwd','error_msg')" />
				</p>
				<p>
					<label class="small"><?=$constantArr['confirm_password'][$_SESSION['lang']]?>:</label>
					<input type="password" id="cpwd" name="cpwd" class="txtBox320px" maxlength="50"
					onblur="return checkPassword(event,this.id,'txtBox320px','txtBox320px errorBdr','error_msg','<?=$constantArr['EnterValidPassword'][$_SESSION['lang']]?>')",onKeypress="clearErrbdr('cpwd','error_msg')" />
				</p>
				<p class="marTop20px">
					<label class="small">&nbsp;</label>
					<span class="redTxt" id="error_msg"></span><br/>
					<label class="small">&nbsp;</label>
					<input type="submit" class="blueButn100px marTop10px" value="<?=$constantArr['submitbtn'][$_SESSION['lang']]?>" />
				</p>
			</div>
	</form>
</div>
<?php include_once 'footer.php';?>
