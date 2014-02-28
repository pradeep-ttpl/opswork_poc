<?php
include_once 'header.php';
$MCrypt	= new MCrypt;

$userID = $_SESSION['user_id'];
$registerDAO = new Register_DAO;
$userDetails = $registerDAO->getUserDetails($userID);
global $constantArr;
?>
	<div class="border marTop-1px pad30px">
		<div>
			<!--Message area-->
			<?php if((isset($_SESSION['message']))) {
			
				$message = explode('~',$_SESSION['message']);
				
				if($message[1] == 'success')
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
				<div class="<?php echo $class;?>"><?php echo $image;?> 
				<?php 
					  echo $message[0]; 
					  unset($_SESSION['message']);
				?>
				</div> 
				<div class="marTop10px">
				<?php } else {?>
				<div>
				<?php }?>
				<?php include_once 'userinfosidebar.php';?>
				<div class="rightArea alignleft marLeft25px">
					<form action="" method="post" enctype="multipart/form-data" name="changepwdform" id="changepwdform">
						<div>
							<h2><strong><?=$constantArr['changepwdlbl'][$_SESSION['lang']]?></strong></h2>
							<p>
								<label class="small"><?=$constantArr['currentPassword'][$_SESSION['lang']]?>:</label>
								<input type="password" id="currentPwd" name="currentPwd" class="txtBox320px" maxlength="50"
								onblur="return checkPassword(event,this.id,'txtBox320px','txtBox320px errorBdr','error_msg','<?=$constantArr['EnterValidPassword'][$_SESSION['lang']]?>')",onKeypress="clearErrbdr('currentPwd','error_msg')" />
							</p>
							<p>
								<label class="small"><?=$constantArr['newpassword'][$_SESSION['lang']]?>:</label>
								<input type="password" id="pwd" name="pwd" class="txtBox320px" maxlength="50"
								onblur="return checkPassword(event,this.id,'txtBox320px','txtBox320px errorBdr','error_msg','<?=$constantArr['EnterValidPassword'][$_SESSION['lang']]?>')",onKeypress="clearErrbdr('pwd','error_msg')"/>
							<p>
								<label class="small"><?=$constantArr['confirm_password'][$_SESSION['lang']]?>:</label>
								<input type="password" id="cpwd" name="cpwd" class="txtBox320px" maxlength="50"
								onblur="return checkPassword(event,this.id,'txtBox320px','txtBox320px errorBdr','error_msg','<?=$constantArr['EnterValidPassword'][$_SESSION['lang']]?>')",onKeypress="clearErrbdr('cpwd','error_msg')" />
							</p>
							<p class="marTop20px">
								<label class="small">&nbsp;</label>
								<span class="redTxt" id="error_msg"></span><br/>
								<label class="small">&nbsp;</label>
								<input type="submit" class="blueButn100px marTop10px" value="<?=$constantArr['updatebtn'][$_SESSION['lang']]?>" />
								<a href="/myaccount">
									<input type="button" value="<?=$constantArr['cancelbtn'][$_SESSION['lang']]?>" class="blueButn100px marLeft20px">
								</a>
							</p>
						</div>
					</form>
				</div>
				<br clear="all" />
			</div>
			</div>
		</div>
	</div>
</div>
<!---------maincontainer section ends here------------>	
<?php include_once 'footer.php';?>