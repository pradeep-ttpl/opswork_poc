<?php include_once 'header.php';
$MCrypt	= new MCrypt;?>
	<!---------maincontainer section starts here------------>
		<div class="border marTop-1px pad30px">
			<!--Instruction area-->
			<div class="botBdr padBottom10px pageTipContentAreaBg">	
				<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="<?=$constantArr['information'][$_SESSION['lang']]?>" title="<?=$constantArr['information'][$_SESSION['lang']]?>" class="alignleft" /></div>
				<div class="alignleft width930px padLeft10px pageTipContentArea">
					<?=$constantArr['paymentInformation'][$_SESSION['lang']]?>
				</div>
				<br clear="all"/>
			</div>
			<?php include_once 'filingsteps.php';?>
			<form action="" method="post" enctype="multipart/form-data" onsubmit="return validatePaymentOptionForm();">
<!--			<p>-->
<!--				You need to pay the tax due of  <strong class="blueTxt">$152.17</strong> to the IRS. There are a few ways you can do this,-->
<!--			</p>-->
				<div class="marTop20px">
					<input type="radio" name="paymentMode" id="paymentMode1" class="alignleft" value='Direct Debit' onclick='ShowHidePaymentOption("1")' 
					<?php if(isset($data['filingPaymentDetails']['bank_name']) && (strlen($data['filingPaymentDetails']['bank_name'])>0)){?>checked<?php }?>/>
					<div class="marLeft20px">
						<strong><?=$constantArr['DDLabel'][$_SESSION['lang']]?></strong> <br/>
						<i><?=$constantArr['authorizeDirectly'][$_SESSION['lang']]?></i>
					</div>
					<!--Details section-->
					<div id='directDebitId' style='display:<?php if(isset($data['filingPaymentDetails']['bank_name']) && (strlen($data['filingPaymentDetails']['bank_name'])>0)){?>block<?php }else{?>none<?php }?>'/>
						<div class="evenrow pad20px marTop20px">
							<p class="marTop0px">
								<label class="small"><?=$constantArr['bankName'][$_SESSION['lang']]?>: </label>
								<input type="text" id="bankName" name="bankName" class="txtBox260px" maxlength="25" value="<?=(isset($data['filingPaymentDetails']['bank_name'])?$MCrypt->decrypt($data['filingPaymentDetails']['bank_name']):'')?>"
								onKeypress = "javascript: return checkBankName(event,this.id,'txtBox260px','txtBox260px errorBdr','bankName_error','<?=$constantArr['EnterValidBankName'][$_SESSION['lang']]?>');" 
								onblur="return checkBankName(event,this.id,'txtBox260px','txtBox260px errorBdr','bankName_error','<?=$constantArr['EnterValidBankName'][$_SESSION['lang']]?>'),clearErrbdr('bankName','bankName_error')"/>
								<span id="bankName_error" class="redTxt"></span>
							</p>
							<p>
								<label class="small"><?=$constantArr['AccountType'][$_SESSION['lang']]?>: </label>
								<select id="accountType" name="accountType" class="txtBox150px" >
									<option value='0'><?=$constantArr['select'][$_SESSION['lang']]?></option>
									<option value='Savings' <?php if($MCrypt->decrypt($data['filingPaymentDetails']['acct_type'])=='Savings') {?> selected <?php }?>><?=$constantArr['Savings'][$_SESSION['lang']]?></option>
									<option value='Checking' <?php if($MCrypt->decrypt($data['filingPaymentDetails']['acct_type'])=='Checking') {?> selected <?php }?>><?=$constantArr['Checking'][$_SESSION['lang']]?></option>
								</select>
							</p>
							<p>
								<label class="small"><?=$constantArr['BankAccountNumber'][$_SESSION['lang']]?>: </label>
								<input type="text" id="acNumber" name="acNumber" class="txtBox260px" maxlength="17" value="<?=(isset($data['filingPaymentDetails']['acct_number'])?$MCrypt->decrypt($data['filingPaymentDetails']['acct_number']):'')?>" 
								onblur="return validateFields(event,this.id,'txtBox260px','txtBox260px errorBdr','acNumber_error','<?=$constantArr['EnterValidBankAccNo'][$_SESSION['lang']]?>','bankAccountNo');"
								onKeyPress = "clearErrbdr('acNumber','acNumber_error')"/>								
								<span id="acNumber_error" class="redTxt"></span>
								<a id="bankAccNo" href="javascript:void(0)">
									<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
								</a>
							</p>
							<p>
								<label class="small"><?=$constantArr['RoutingTransitNumber'][$_SESSION['lang']]?>: </label>
								<input type="text" id="rountingTransitNumber" name="rountingTransitNumber" class="txtBox260px" maxlength="9" value="<?=(isset($data['filingPaymentDetails']['routing_transit_no'])?$MCrypt->decrypt($data['filingPaymentDetails']['routing_transit_no']):'')?>" 
								onblur = "javascript: return toCheckRoutingNo(event,this.id,'txtBox260px','txtBox260px errorBdr','rTNumber_error','<?=$constantArr['EnterValidRTNo'][$_SESSION['lang']]?>');"
								onmouseout = "clearErrbdr('rountingTransitNumber','rTNumber_error')" />
								<span id="rTNumber_error" class="redTxt"></span>
								<a id="routingTransit" href="javascript:void(0)">
									<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
								</a>
							</p>
							<p>
								<?=$constantArr['paymnetDDInformation'][$_SESSION['lang']]?>
							</p>
							<p>
								<input type="checkbox" id="DirectDebit" name="DirectDebit" <?php if(isset($data['filingPaymentDetails']['bank_name']) && (strlen($data['filingPaymentDetails']['bank_name'])>0)){?>checked<?}?>/>
								<?=$constantArr['paymnetDDagreement'][$_SESSION['lang']];?>
							</p>
						</div>
				</div>
			</div>
			<div class="marTop20px">
				<input type="radio" name="paymentMode" id="paymentMode2" class="alignleft" value='EFTPS' onclick='ShowHidePaymentOption("2")' <?php if(isset($data['filingPaymentDetails']['bank_name']) && strlen($data['filingPaymentDetails']['bank_name'])==0){?>checked<?php }?>/>
				<div class="marLeft20px">
					<strong><?=$constantArr['EFTPSLabel'][$_SESSION['lang']]?></strong> <br/>
					<i><?=$constantArr['EFTPNotes1'][$_SESSION['lang']]?></i>
					<i><?=$constantArr['EFTPNotes2'][$_SESSION['lang']]?></i>
				</div>
				<!--Details section-->
				<div id='EFTPSId' style='display:<?php if(isset($data['filingPaymentDetails']['bank_name']) && strlen($data['filingPaymentDetails']['bank_name'])==0){?>block<?php }else{?>none<?php }?>'>
					<div class="evenrow pad20px marTop20px">
						<input type="checkbox" id="eftps" name="eftps" class="alignleft" <?php if(isset($data['filingPaymentDetails']['bank_name']) && strlen($data['filingPaymentDetails']['bank_name'])==0){?>checked<?}?>/>
						<div class="marLeft20px">
							<?=$constantArr['paymentAcceptText'][$_SESSION['lang']]?>
						</div>
					</div>
				</div>
			</div>
			<!--Form navigation-->
			<div class="alignright marTop30px">
				<span class="redTxt" id="error_msg"></span>
				<?php 
				$redirect = 'taxablevehicleinfo';
				if($_SESSION['formtype'] == '2290A1')
				$redirect = 'tgwincreased';
				else if($_SESSION['formtype'] == '2290A2')
				$redirect = 'exceededmileage';
				?>
				<input type="button" onclick="window.location='/<?php echo $redirect;?>/';" title="<?=$constantArr['back'][$_SESSION['lang']]?>" alt="<?=$constantArr['goback'][$_SESSION['lang']]?>" value="<?=$constantArr['goback'][$_SESSION['lang']]?>" class="blueButn60px">
				<input type="submit" name='savePaymentOption' title="<?=$constantArr['continuelbl'][$_SESSION['lang']]?>" alt="<?=$constantArr['continuelbl'][$_SESSION['lang']]?>" value="<?=$constantArr['continuelbl'][$_SESSION['lang']]?>" class="blueButn100px marLeft10px">
			</div>
			<br clear="all" />
		</form>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#bankAccNo').tooltipster({
			content: $("<span><?=$constantArr['bankAccNo_txt'][$_SESSION['lang']]?></span>")
		});
		$('#routingTransit').tooltipster({
			content: $("<span><?=$constantArr['routingTransit_txt'][$_SESSION['lang']]?></span>")
		});
	});
</script>
<!---------maincontainer section ends here------------>	
<?php include_once 'footer.php';?>
