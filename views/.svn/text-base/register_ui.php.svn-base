<?php 
include_once 'header.php';
?>
<script>
$(document).ready(function(){
	  $('#cEmail,#cpwd').bind("paste",function(e) {
	      e.preventDefault();
	  });
	});
	$(function() { 			
        $('#reload').click(function(){
            var d = new Date();
            $('img#captcha').attr('src', '<?php echo TT_SITE_NAME; ?>include/captcha.php?' + d.getTime());
         });
    });
</script>
<div class="border marTop-1px pad30px">
	<!--Instruction area-->
	<div class="botBdr padBottom10px pageTipContentAreaBg">	
		<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="Information" title="Information" class="alignleft" /></div>
		<div class="alignleft padLeft10px pageTipContentArea">
			<?=$constantArr['reg_description'][$_SESSION['lang']]?>
		</div>
		<br clear="all"/>
	</div>
	<form action="" method="post" enctype="multipart/form-data" name="registerform" id="registerform">
		<div class="marTop20px">
			<?php if(isset($data['msg']['value']) && $data['msg']['value']!= 'wrongcaptcha') { ?>
				<div class="errorMsg"><span class="errorIcon"></span> <?php echo $data['msg']['value'];?></div>
			<?php }	else if(isset($data['msg']['value']) && $data['msg']['value']== 'wrongcaptcha') { ?>
				<label class="small">&nbsp;</label>
				<span class="redTxt"><?=$constantArr['wrong_captcha'][$_SESSION['lang']]?></span>
			<?php }?>
			
			<p>
				<label class="small"><?=$constantArr['full_name'][$_SESSION['lang']]?>:</label>
				<input type="text" onkeypress="javascript: return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','firstname_error','<?=$constantArr['firstname_error'][$_SESSION['lang']]?>');" 
						onblur="return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','firstname_error','<?=$constantArr['firstname_error'][$_SESSION['lang']]?>'),clearErrbdr('firstname','firstname_error')" id="firstname" name="firstname" class="txtBox320px" value="<?php if(isset($data['regValue']['firstname'])) { echo $data['regValue']['firstname']; }?>" maxlength="50"/>
				<span class="redTxt" id="firstname_error"></span>
			</p>
			<!--<p>
				<label class="small"><?=$constantArr['last_name'][$_SESSION['lang']]?>:</label>
				<input type="text" onkeypress="javascript: return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','lastname_error','<?=$constantArr['lastname_error'][$_SESSION['lang']]?>');"
					   onblur="return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','lastname_error','<?=$constantArr['lastname_error'][$_SESSION['lang']]?>'),clearErrbdr('lastname','lastname_error')" id="lastname" name="lastname" class="txtBox320px" value="<?php if(isset($data['regValue']['lastname'])) { echo $data['regValue']['lastname']; }?>" maxlength="50"/>
				<span class="redTxt" id="lastname_error"></span>
			</p>
			--><p>
				<label class="small"><?=$constantArr['email'][$_SESSION['lang']]?>:</label>
				<input type="text" id="email" name="email" class="txtBox320px" value="<?php if(isset($data['regValue']['email'])) { echo $data['regValue']['email']; }?>" maxlength="65"/>
			</p>
			<!--<p>
				<label class="small"><?=$constantArr['confirm_email'][$_SESSION['lang']]?>:</label>
				<input type="text" id="cEmail" name="cEmail" class="txtBox320px" value="<?php if(isset($data['regValue']['cEmail'])) { echo $data['regValue']['cEmail']; }?>" maxlength="65"/>
			</p>
			--><p>
				<label class="small"><?=$constantArr['password'][$_SESSION['lang']]?>:</label>
				<input type="password" id="pwd" name="pwd" class="txtBox320px" value="<?php if(isset($data['regValue']['pwd'])) { echo $data['regValue']['pwd']; }?>" maxlength="15"
				onblur="return checkPassword(event,this.id,'txtBox320px','txtBox320px errorBdr','error_msg','<?=$constantArr['EnterValidPassword'][$_SESSION['lang']]?>')",onKeypress="clearErrbdr('pwd','error_msg')" />
			</p>
			<!--<p>
				<label class="small"><?=$constantArr['confirm_password'][$_SESSION['lang']]?>:</label>
				<input type="password" id="cpwd" name="cpwd" class="txtBox320px" value="<?php if(isset($data['regValue']['cpwd'])) { echo $data['regValue']['cpwd']; }?>" maxlength="15"/>
			</p>
			--><!--<p>
				<label class="small"><?=$constantArr['contact_number'][$_SESSION['lang']]?>:</label>
				<input onkeyup="switchFocus(this.value)" type="text" class="txtBox50px" id="countryCode" value="<?php //if(isset($data['regValue']['countryCode'])) { echo $data['regValue']['countryCode']; }?>" name="countryCode" maxlength="2" onkeypress="return autoMask(this,event, '##');" />&nbsp;
				<input type="text" class="txtBox150px" id="phone" name="phone" value="<?php if(isset($data['regValue']['phone'])) { echo $data['regValue']['phone']; }?>" maxlength="15" onkeypress="return autoMask(this,event, '###-###-####');" />
			</p>
			--><p>
				<label class="small alignleft"><?=$constantArr['verification_code'][$_SESSION['lang']]?>:</label>
				<input autocomplete="off" type="text" class="txtBox150px alignleft marLeft3px" id="captcha" name="captcha" maxlength="8"/> 
				<img src="<?php echo TT_SITE_NAME; ?>include/captcha.php" class="marLeft20px alignleft" alt="Captcha Code" title="Captcha Code" id="captcha"/>
				<a href="javascript:void(0)" id="reload" class="alignleft marLeft10px marTop3px blueTxt">
					<img src="/images/refresh.png" alt="Refresh" title="Refresh" class="marTop3px" />
				</a>
				<br clear="all"/>
			</p>
			<p>
				<label class="small">&nbsp;</label>
				<?=$constantArr['agree_terms'][$_SESSION['lang']]?>
			</p>
			<p class="marTop10px">
				<label class="small">&nbsp;</label>
				<span class="redTxt" id="error_msg"></span><br/>
				<label class="small">&nbsp;</label>
				
				<input type="hidden" id="user_type" name="user_type" value="2"/>
					
				<input type="submit" class="blueButn100px marTop10px" value="<?=$constantArr['registerbtn'][$_SESSION['lang']]?>" />
<!--				<input type="button" onclick="registerCancel()" class="blueButn100px marLeft20px" value="<?=$constantArr['cancelbtn'][$_SESSION['lang']]?>" />-->
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
