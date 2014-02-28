<?php
include_once 'header.php';
$request = $_SERVER['REQUEST_URI'];
$parsed = explode('/', $request);

$businessInfo = (isset($data['getBusinessiInfo'])? $data['getBusinessiInfo'] : ''); 
$bizType = (isset($businessInfo['type'])? $businessInfo['type'] : '');
$bizState = (isset($businessInfo['state_id'])? $businessInfo['state_id'] : '');
$SelectedbizCountry = (isset($businessInfo['country_id'])? $businessInfo['country_id'] : '');
$result = getRegisteredEmail($_SESSION['user_id']);
$registeredEmail = $result['email'];
$registeredPhone = $result['phone'];
$MCrypt	= new MCrypt;

if(isset($parsed[2]) && $parsed[2]=='edit' ){
?>
<script>
fetchState('<?=$SelectedbizCountry?>','<?=$bizState?>');
</script>
<?php }?>
			<div class="border marTop-1px pad30px">
				 
				<?php 
				if(isset($_SESSION['regSucMsg']))
				{
					echo '<div class="marTop10px statusMsg"><span class="successIcon"></span>'; 
					echo $_SESSION['regSucMsg'];
					echo '</div>'; 
					unset($_SESSION['regSucMsg']);
				}				
				?>
				
				<!--Instruction area-->
				<div class="botBdr padBottom10px pageTipContentAreaBg">	
					<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="<?=$constantArr['information'][$_SESSION['lang']]?>" title="<?=$constantArr['information'][$_SESSION['lang']]?>" class="alignleft" /></div>
					<div class="alignleft width930px padLeft10px pageTipContentArea">
						<?=$constantArr['addBusinessInfo'][$_SESSION['lang']]?>
					</div>
					<br clear="all"/>
				</div>
				<form action="" method="post" enctype="multipart/form-data" name="businessinfoform" id="businessinfoform">
				<br clear="all"/>
				<span class="mandatory"><?=$constantArr['mandatory'][$_SESSION['lang']]?></span>
					<div class="marTop30px">
						<h2><strong><?=$constantArr['personalInformation'][$_SESSION['lang']]?></strong></h2>
						<p>
							<label class="small"><?=$constantArr['biz_name'][$_SESSION['lang']]?>:</label>
							<input type="text" id="bizName" name="bizName" class="txtBox320px" value="<?=(isset($businessInfo['name'])?$MCrypt->decrypt($businessInfo['name']):'')?>" maxlength="75" 
									onblur="return validateFields(event,this.id,'txtBox320px','txtBox320px errorBdr','bizName_error','<?=$constantArr['EnterValidBusName'][$_SESSION['lang']]?>','businessName');"
									onKeypress="clearErrbdr('bizName','bizName_error')"/>
							<span id="bizName_error" class="redTxt"></span>
						</p>
						<p>
							<label class="small"><?=$constantArr['biz_type'][$_SESSION['lang']]?>:</label>
							<select class="txtBox320px" name="bizType" id="bizType" onchange="selectedType(this.value)">
								<option><?=$constantArr['selectBusissType'][$_SESSION['lang']]?></option>
								<?php getBusinessType($data['business_list'],$bizType); ?>
							</select>
						</p>
						<div id="OwnerNameDisplayId" <?php if(isset($businessInfo['owner_first_name']) && strlen($businessInfo['owner_first_name']) > 0){?> style="display:block"<?php } else {?>style="display:none"<?php }?>>
							<p>
								<label class="small"><?=$constantArr['ownerName'][$_SESSION['lang']]?>:</label>
								<input type="text" id="ownerFirstName" name="ownerFirstName" class="txtBox150px" value="<?=(isset($businessInfo['owner_first_name'])?$MCrypt->decrypt($businessInfo['owner_first_name']):'')?>" maxlength="35" 
										onblur="return validateFields(event,this.id,'txtBox150px','txtBox150px errorBdr','ownerName_error','<?=$constantArr['EnterValidOwnerFirstName'][$_SESSION['lang']]?>','ownerName');"
										onKeypress="clearErrbdr('ownerFirstName','ownerName_error')"/>
								<input type="text" id="ownerLastName" name="ownerLastName" class="txtBox150px" value="<?=(isset($businessInfo['owner_last_name'])?$MCrypt->decrypt($businessInfo['owner_last_name']):'')?>" maxlength="35" 
										onblur="return validateFields(event,this.id,'txtBox150px','txtBox150px errorBdr','ownerName_error','<?=$constantArr['EnterValidOwnerLastName'][$_SESSION['lang']]?>','ownerName');"
										onKeypress="clearErrbdr('ownerLastName','ownerName_error')"/>
								<span id="ownerName_error" class="redTxt"></span>
							</p>
						</div>
						<p>
							<label class="small"><?=$constantArr['biz_EIN'][$_SESSION['lang']]?>:</label>
							<input onblur="checkEIN(this.id,this.value,'<?=(isset($businessInfo['ein'])?preg_replace("/^(\d{2})(\d{7})$/", "$1-$2", $businessInfo['ein']):'')?>')" type="text" id="bizEIN" name="bizEIN" class="txtBox150px" value="<?=(isset($businessInfo['ein'])?preg_replace("/^(\d{2})(\d{7})$/", "$1-$2", $MCrypt->decrypt($businessInfo['ein'])):'')?>" maxlength="10" onkeypress="return autoMask(this,event, '##-#######')"/>
							<span id="EINerror" class="redTxt"></span>
							<a id="businessEIN" href="javascript:void(0)">
								<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
							</a>
						</p>
						<p>
							<h2><strong><?=$constantArr['contactInformation'][$_SESSION['lang']]?></strong></h2>
						</p>
						<p>
							<label class="small"><?=$constantArr['biz_address1'][$_SESSION['lang']]?>:</label>
							<input type="text" id="addressLine1" name="addressLine1" class="txtBox320px" value="<?=(isset($businessInfo['address1'])?$MCrypt->decrypt($businessInfo['address1']):'')?>" maxlength="35"
									onblur="return validateFields(event,this.id,'txtBox320px','txtBox320px errorBdr','address1_error','<?=$constantArr['EnterValidAddress'][$_SESSION['lang']]?>','address');"
									onKeypress="clearErrbdr('addressLine1','address1_error')"/>
						<span id="address1_error" class="redTxt"></span>
						</p>
						<p>
							<label class="small"><?=$constantArr['biz_address2'][$_SESSION['lang']]?>:</label>
							<input type="text" id="addressLine2" name="addressLine2" class="txtBox320px" value="<?php if( isset($businessInfo['address2']) && strlen($businessInfo['address2'])>0){ echo $MCrypt->decrypt($businessInfo['address2']);}?>" maxlength="35"
									onblur="return validateFields(event,this.id,'txtBox320px','txtBox320px errorBdr','address2_error','<?=$constantArr['EnterValidAddress'][$_SESSION['lang']]?>','address');"
									onKeypress="clearErrbdr('addressLine2','address2_error')"/>
							<span id="address2_error" class="redTxt"></span>
						</p>
						<p>
							<label class="small"><?=$constantArr['biz_country'][$_SESSION['lang']]?>:</label>
							<select class="txtBox320px" name="bizCountry" id="bizCountry" onchange="javascript:fetchState(this.value,'');">
								<option value=""><?=$constantArr['select'][$_SESSION['lang']]?></option>
								<?php getCountryList($data['countryList'],$SelectedbizCountry); ?>
							</select>
						</p>
						<p>
							<label class="small"><?=$constantArr['biz_state'][$_SESSION['lang']]?>:</label>
							<select class="txtBox320px" name="bizselectState" id="bizselectState">
								<option value="0"><?=$constantArr['select'][$_SESSION['lang']]?></option>
							</select>
						</p>
						<p>
							<label class="small"><?=$constantArr['biz_city'][$_SESSION['lang']]?>:</label>
							<input type="text" id="bizCity" name="bizCity" class="txtBox320px" value="<?=(isset($businessInfo['city'])?$MCrypt->decrypt($businessInfo['city']):'')?>" maxlength="50"
									onblur = "javascript: return validateFields(event,this.id,'txtBox320px','txtBox320px errorBdr','bizCity_error','<?=$constantArr['EnterValidCity'][$_SESSION['lang']]?>','city');"
									onKeypress="clearErrbdr('bizCity','bizCity_error')"/>
							<span id="bizCity_error" class="redTxt"></span>
						</p>
						<p>
							<label class="small"><?=$constantArr['biz_zipcode'][$_SESSION['lang']]?>:</label>
							<input type="text" id="bizZip" name="bizZip" class="txtBox150px" value="<?=(isset($businessInfo['zipcode'])?$MCrypt->decrypt($businessInfo['zipcode']):'')?>" maxlength="10" 
									onblur = "javascript: return validateFields(event,this.id,'txtBox150px','txtBox150px errorBdr','bizCode_error','<?=$constantArr['EnterValidZipCode'][$_SESSION['lang']]?>','zipcode');"
									onKeypress="clearErrbdr('bizZip','bizCode_error')"/>
							<span id="bizCode_error" class="redTxt"></span>
						</p>
						<p>
							<label class="small"><?=$constantArr['phone_number'][$_SESSION['lang']]?>:</label>
							<input type="text" id="phone" name="phone" class="txtBox150px" value="<?=(isset($businessInfo['phone'])?preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $MCrypt->decrypt($businessInfo['phone'])):preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $MCrypt->decrypt($registeredPhone)))?>" maxlength="15" onkeypress="return autoMask(this,event, '###-###-####');"/>
						</p>
						<p>
							<label class="small"><?=$constantArr['emailAddress'][$_SESSION['lang']]?>:</label>
							<input type="text" id="email" name="email" class="txtBox320px" value="<?=(isset($businessInfo['email'])?$MCrypt->decrypt($businessInfo['email']): $MCrypt->decrypt($registeredEmail))?>" maxlength="65"/>
						</p>
						<p>
							<h2><strong><?=$constantArr['signAuthorityInfo'][$_SESSION['lang']]?></strong></h2>
						</p>
						<p>
							<label class="small"><?=$constantArr['Name'][$_SESSION['lang']]?>:</label>
							<input type="text" id="sAname" name="sAname" class="txtBox320px" value="<?=(isset($businessInfo['siging_authority_name'])?$MCrypt->decrypt($businessInfo['siging_authority_name']):'')?>" maxlength="35" 
									onblur = "javascript: return validateFields(event,this.id,'txtBox320px','txtBox320px errorBdr','SA_error','<?=$constantArr['EnterValidSignAuthName'][$_SESSION['lang']]?>','personName');"
									onKeypress="clearErrbdr('sAname','SA_error')"/>
							<span id="SA_error" class="redTxt"></span>
						</p>
						<p>
							<label class="small"><?=$constantArr['Title'][$_SESSION['lang']]?>:</label>
							<input type="text" id="sAtitle" name="sAtitle" class="txtBox320px" value="<?=(isset($businessInfo['siging_authority_title'])?$MCrypt->decrypt($businessInfo['siging_authority_title']):'')?>" maxlength="35" 
									onblur = "javascript: return validateFields(event,this.id,'txtBox320px','txtBox320px errorBdr','ST_error','<?=$constantArr['EnterValidSignAuthTitle'][$_SESSION['lang']]?>','title');"
									onKeypress="clearErrbdr('sAtitle','ST_error')"/>
							<span id="ST_error" class="redTxt"></span>
						</p>
						<p>
							<label class="small"><?=$constantArr['dayTimePhone'][$_SESSION['lang']]?>:</label>
							<input type="text" id="sAphone" name="sAphone" class="txtBox150px" value="<?=(isset($businessInfo['siging_authority_phone'])?preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $MCrypt->decrypt($businessInfo['siging_authority_phone'])):'')?>" maxlength="15" onkeypress="return autoMask(this,event, '###-###-####');"/>
						</p>
						<p>
							<label class="small"><?=$constantArr['pin'][$_SESSION['lang']]?>:</label>
							<input type="text" id="sApin" name="sApin" class="txtBox150px" value="<?=(isset($businessInfo['siging_authority_pin'])?$MCrypt->decrypt($businessInfo['siging_authority_pin']):'')?>" maxlength="5" 
									onblur="return validateFields(event,this.id,'txtBox150px','txtBox150px errorBdr','SP_error','<?=$constantArr['EnterValidSAPin'][$_SESSION['lang']]?>','pin');"
									onKeyPress="clearErrbdr('sApin','SP_error')"/>
							<span id="SP_error" class="redTxt"></span>
							<a class="businessPIN" href="javascript:void(0)">
								<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
							</a>
						</p>
						<p>
							<span><?php echo $constantArr['thirdPartyInfo'][$_SESSION['lang']]?></span>
							<h2 class="marTop5px"><input type="checkbox" id="thirdPartyCheckBox" name="thirdPartyCheckBox" value="" <?php if(isset($businessInfo['third_party_designee_name']) && strlen($businessInfo['third_party_designee_name']) > 0){ echo 'checked'; }?> onclick="getThirdPartyInfo()"/> 
							<strong><?=$constantArr['thirdPartyDesigneeInfo'][$_SESSION['lang']]?></strong></h2>
							
							<input type=hidden value='<?php if(isset($businessInfo['third_party_designee_name']) && strlen($businessInfo['third_party_designee_name']) > 0){ echo '1'; }?>' id='checkboxId' name='checkboxId'/>
						</p>
						<div id="thirdPartyDisplayId" <?php if(isset($businessInfo['third_party_designee_name']) && strlen($businessInfo['third_party_designee_name']) > 0){?> style="display:block"<?php } else {?>style="display:none"<?php }?>>
							<p>
								<label class="small"><?=$constantArr['Name'][$_SESSION['lang']]?>:</label>
								<input type="text" id="tPdName" name="tPdName" class="txtBox320px" value="<?=(isset($businessInfo['third_party_designee_name'])?$MCrypt->decrypt($businessInfo['third_party_designee_name']):'')?>" maxlength="35" 
										onblur="return validateFields(event,this.id,'txtBox320px','txtBox320px errorBdr','TDName_error','<?=$constantArr['EnterValidTPDesName'][$_SESSION['lang']]?>','personName')";
										onkeypress="clearErrbdr('tPdName','TDName_error')"/>
								<span id="TDName_error" class="redTxt"></span>
							</p>
							<p>
								<label class="small"><?=$constantArr['phone_number'][$_SESSION['lang']]?>:</label>
								<input type="text" id="tPdPhone" name="tPdPhone" class="txtBox150px" value="<?=((isset($businessInfo['third_party_designee_phone']) && ($businessInfo['third_party_designee_phone'])!='0')?preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $MCrypt->decrypt($businessInfo['third_party_designee_phone'])):'')?>" maxlength="15" onkeypress="return autoMask(this,event, '###-###-####');"/>
							</p>
							<p>
								<label class="small"><?=$constantArr['pin'][$_SESSION['lang']]?>:</label>
								<input type="text" id="tPdPin" name="tPdPin" class="txtBox150px" value="<?=((isset($businessInfo['third_party_designee_pin']) && ($businessInfo['third_party_designee_pin']!='0'))?$MCrypt->decrypt($businessInfo['third_party_designee_pin']):'')?>" maxlength="5" 
										onblur="return validateFields(event,this.id,'txtBox150px','txtBox150px errorBdr', 'TDPIN_error', '<?=$constantArr['EnterValidDesigneePin'][$_SESSION['lang']]?>','pin')"
										onKeyPress="clearErrbdr('tPdPin','TDPIN_error')"/>
								<span id="TDPIN_error" class="redTxt"></span>
								<a class="businessPIN" href="javascript:void(0)">
									<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
								</a>
							</p>
						</div>
						<p>
							<label class="small">&nbsp;</label>
							<span class="redTxt" id="error_msg"><?=(isset($data['status']) ? $data['status'] : '')?></span><br/>
							<input type="hidden" value="<?php if(isset($parsed[3])){echo $parsed[3];}?>" name="BizID"/>
							<label class="small">&nbsp;</label>
							<?php
							if(isset($parsed[1]) && $parsed[1]=='addbusiness' && !isset($parsed[2]))
							{
							?> 
							<input type="submit" class="blueButn100px marTop10px" name="addbusiness" id="addbusiness" value="<?=$constantArr['savebtn'][$_SESSION['lang']]?>" />
							<input type="button" class="blueButn100px marLeft20px" value="<?=$constantArr['cancelbtn'][$_SESSION['lang']]?>" onClick="window.location.href ='/taxpayerbusiness';"/>
							<?php	
							} 
							else if(isset($parsed[2]) && $parsed[2]=='edit' )
							{
								$backLink = 'taxpayerbusiness';
								if(isset($_SESSION['summary_back_button']) && $_SESSION['summary_back_button'] == true){
									$backLink = 'summary';
								} 
							?>								
							<input type="submit" class="blueButn100px marTop10px" name="updatebusiness" id="update" value="<?=$constantArr['updatebtn'][$_SESSION['lang']]?>" />
							<input type="reset" class="blueButn100px marLeft20px" value="<?=$constantArr['cancelbtn'][$_SESSION['lang']]?>" onClick="window.location.href ='/<?php echo $backLink;?>';"/>
							<?php } else {?>
							<input type="submit" class="blueButn100px marTop10px" name="addbusiness" id="addbusiness" value="<?=$constantArr['savebtn'][$_SESSION['lang']]?>" />
							
							<?php } ?>							
						</p>
					</div>
				</form>
			</div>
		</div>
	</div>
	 <script>
		$(document).ready(function() {
			$('#businessEIN').tooltipster({
				content: $("<span><?=$constantArr['EIN_help_txt'][$_SESSION['lang']]?></span>")
			});
			$('.businessPIN').tooltipster({
				content: $("<span><?=$constantArr['PIN_help_txt'][$_SESSION['lang']]?></span>")
			});
		});
	</script>
<?php include_once 'footer.php';?>

