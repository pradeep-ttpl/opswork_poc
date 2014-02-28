<?php include_once 'header.php'; ?>
<div class="border marTop-1px pad30px">
	<!--Instruction area-->
	<div class="botBdr padBottom10px pageTipContentAreaBg">	
		<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="<?=$constantArr['information'][$_SESSION['lang']]?>" title="<?=$constantArr['information'][$_SESSION['lang']]?>" class="alignleft" /></div>
		<div class="alignleft width930px padLeft10px pageTipContentArea">
			<?=$constantArr['forgotpwdinfo1'][$_SESSION['lang']]?></br>
			<?=$constantArr['forgotpwdinfo2'][$_SESSION['lang']]?>
		</div>
		<br clear="all"/>
	</div>
	<form action="" method="post" enctype="multipart/form-data" name="forgotpwdform" autocomplete="off" id="forgotpwdform">
		<div class="marTop30px">
			<p><b><?=$constantArr['forgotpwdlbl'][$_SESSION['lang']]?> </b></p>
			<p>
				<?php if(!empty($data['status'])) 
				{
					if(isset($data['status']))
					$explodeValue = explode('~',$data['status']);
					
					if($explodeValue[1] == 'success')
					{
						$class = 'statusMsg';
						$image = '<span class="successIcon"></span>';
					}
					else 
					{
						$class = 'errorMsg';
						$image = '<span class="errorIcon"></span>';
					}
				?>
				<div class="<?php echo $class;?>"><?php echo $image;?> <?php echo $explodeValue[0]; } ?></div> 
			</p>
			<p>
				<label class="xsmall"><?=$constantArr['emailAddress'][$_SESSION['lang']]?>:</label>
				<input type="text" id="email" name="email" class="txtBox320px" maxlength="65"/>
			</p>
			<p class="marTop0px">
				<label class="xsmall">&nbsp;</label>
				<span class="redTxt" id="error_msg"></span><br/>
				<label class="xsmall">&nbsp;</label>				
				<input type="submit" class="blueButn100px marTop10px" value="<?=$constantArr['Proceed'][$_SESSION['lang']]?>" />
			</p>
		</div>
	</form>
	<a id="anchorId" href="#loaderContent" class="fancybox"></a>
	<div id="loaderContent" class="width375px" style="display:none;" align="center">
		<div class="pad25px" align="center">
			<img src="/images/loading.gif" alt="Please wait" title="Please wait" width="100px" /><br/>
			Please Wait...
		</div>
	</div>
</div>
<?php include_once 'footer.php';?>
