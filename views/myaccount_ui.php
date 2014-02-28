<?php 
include_once 'header.php';
$MCrypt	= new MCrypt;

$userID = $_SESSION['user_id'];

$registerDAO = new Register_DAO;
$userDetails = $registerDAO->getUserDetails($userID);
?>
	<div class="border marTop-1px pad30px">
		<div>
			<!--Message area-->
			<?php if((isset($_SESSION['status']))) {?>
				<div class="statusMsg"><span class="successIcon"></span><?php 
					echo $_SESSION['status']; unset($_SESSION['status']);?>
				</div>
				<div class="marTop10px">
			<?php } else {?>
				<div>
			<?php }?>			
				<?php include_once 'userinfosidebar.php';?>
				<div class="rightArea alignleft marLeft25px">
					<form action="" method="post" enctype="multipart/form-data" name="businessinfoform" id="businessinfoform">
						<div>
							<h2><strong><?=$constantArr['myaccount'][$_SESSION['lang']]?></strong></h2>
							<p>
								<label class="small"><?=$constantArr['first_name'][$_SESSION['lang']]?>:</label>
								<input type="text" onkeypress="javascript: return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','firstname_error','<?=$constantArr['firstname_error'][$_SESSION['lang']]?>');" 
									   onblur="return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','firstname_error','<?=$constantArr['firstname_error'][$_SESSION['lang']]?>'),clearErrbdr('firstname','firstname_error')" id="firstname" name="firstname" class="txtBox320px" value="<?php echo $MCrypt->decrypt($userDetails['first_name'])?>" maxlength="50"/>
								<span class="redTxt" id="firstname_error"></span>
							</p>
							<p>
								<label class="small"><?=$constantArr['last_name'][$_SESSION['lang']]?>:</label>
								<input type="text" onkeypress="javascript: return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','lastname_error','<?=$constantArr['lastname_error'][$_SESSION['lang']]?>');"
									   onblur="return alphabetsOnly(event,this.id,'txtBox320px','txtBox320px errorBdr','lastname_error','<?=$constantArr['lastname_error'][$_SESSION['lang']]?>'),clearErrbdr('lastname','lastname_error')" id="lastname" name="lastname" class="txtBox320px" value="<?php echo $MCrypt->decrypt($userDetails['last_name'])?>" maxlength="50"/>
								<span class="redTxt" id="lastname_error"></span>
							</p>
							<p>
								<label class="small"><?=$constantArr['contact_number'][$_SESSION['lang']]?>:</label>
								<input type="text" class="txtBox150px" id="phone" name="phone" value="<?php echo $MCrypt->decrypt($userDetails['phone'])?>" maxlength="15" onkeypress="return autoMask(this,event, '###-###-####');" />
							</p>
							<p>
								<label class="small">&nbsp;</label>
								<span class="redTxt" id="error_msg"></span><br/>
								<label class="small">&nbsp;</label>
								<input type="submit" class="blueButn100px marTop10px" name="myaccount" id="myaccount" value="<?=$constantArr['updatebtn'][$_SESSION['lang']]?>" onclick="return myAccountValidate();"/>
<!--							<input type="reset" class="blueButn100px marLeft20px" value="<?=$constantArr['cancelbtn'][$_SESSION['lang']]?>" />-->
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
