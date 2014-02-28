<?php 
global $constantArr;
$editoverpayDet = $data['editoverpayDet'];
$MCrypt	= new MCrypt;
?>
<script>
$(function() {
	$( "#paymentdate" ).datepicker({
		showOn: "button",
		changeMonth: true,
		changeYear: true,
		buttonImage: "/js/datepicker/calendar.png",
		buttonImageOnly: true,
		dateFormat: "yy-mm-dd",
		yearRange: '-2:+0'
	});
});
</script>
<div class="width930px">
	<div class="topgrayBG padTop10px padLeft15px">
		<div class="alignleft marTop3px"><h2><?=$constantArr['edit'][$_SESSION['lang']] . " " . $constantArr['overpaymentlbl'][$_SESSION['lang']]?></h5></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="Close Popup" title="Close Popup" onclick="parent.$.fancybox.close();" />
		</div>
	</div>
	<div class="pad20px">
		<form action="/overpayment/" method="post" onsubmit="return validateCreditOverPayment()" enctype="multipart/form-data" name="overpaymentform" id="overpaymentform">
			<div>
				<p class="marTop0px">
					<label class="small"><?=$constantArr['License'][$_SESSION['lang']]?>:</label>
					<input autocomplete="off" type="text" class="txtBox200px" name="lno" id="lno" onkeyup="lookup(this.value);"  maxlength="20" value="<?php echo $editoverpayDet['licence_no']?>"/>
					<div class="suggestionsBox" id="suggestions" style="display:none;">
						<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
					</div>
				</p>
				<p>
					<label class="small"><?=$constantArr['vinlbl'][$_SESSION['lang']]?>:</label>
					<input type="text" class="txtBox260px" value="<?php echo $MCrypt->decrypt($editoverpayDet['vin'])?>" name="vin"  id="vin" maxlength="17" onblur="return checkVIN(this.id,this.value,'error_msg','txtBox260px','errorBdr txtBox260px');" onfocus="clearLicense();" onkeyPress="validateVin(this.id);"/>
					<a id="VINval" href="javascript:void(0)">
						<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
					</a>
				</p>
				<br clear="all"/>
				<div class="alignleft width475px marTop20px">
					<label class="small"><?=$constantArr['paymentdate'][$_SESSION['lang']]?>:</label>
					<input type="text" readonly id="paymentdate" name="paymentdate" class="txtBox150px marRight10px" value="<?php echo $MCrypt->decrypt($editoverpayDet['payment_date'])?>"/>
				</div>
				<div class="alignleft width375px marTop20px">
					<label class="small"><?=$constantArr['amountclaim'][$_SESSION['lang']]?>:</label>
					<input type="text" class="txtBox150px" id="amtclaim" value="<?php echo $MCrypt->decrypt($editoverpayDet['amount_of_claim'])?>" name="amtclaim" maxlength="8" onKeyPress="return numbersonly(this,event);" />
				</div>
				<br clear="all"/>
				<p>
					<label class="small alignleft"><?=$constantArr['expplanation'][$_SESSION['lang']]?>:</label>
					<textarea name="explanation" rows="3" cols="30" maxlength="9000" class="textArea" id="explanation"><?php echo $MCrypt->decrypt($editoverpayDet['explanation'])?></textarea>
				</p>
				<div class="width475px padTop20px">
					<label class="small"><?=$constantArr['uploaddocument'][$_SESSION['lang']]?>:</label>
					<input type="file" class="noborder txtBox260px" value ="Upload your logo"  name="document" id="document"/>
					<br clear="all" />
					<?php if($editoverpayDet['document_name']!=''){echo '(<i>'.$constantArr['document'][$_SESSION['lang']].'</i>: '.$MCrypt->decrypt($editoverpayDet['document_name']).')';}?>
				</div>
				<p>
					<label class="small">&nbsp;</label>
					<span class="redTxt" id="error_msg"></span><br/>
				
					<label class="small">&nbsp;</label>
					<input type="hidden" name="overpaymentId" value="<?php echo $_REQUEST['overpaymentId'];?>" />
					<input type="submit" name="updateoverpayment" class="blueButn100px" value="<?=$constantArr['updatebtn'][$_SESSION['lang']]?>" />
					<input type="button" class="blueButn100px marLeft20px marTop10px" value="<?=$constantArr['Cancellbl'][$_SESSION['lang']]?>" onclick="parent.$.fancybox.close();" />
				</p>
			</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#VINval').tooltipster({
			content: $("<span><?=$constantArr['VIN_help_txt'][$_SESSION['lang']]?></span>")
		});
		$('#logging').tooltipster({
			content: $("<span><?=$constantArr['logging_help_txt'][$_SESSION['lang']]?></span>")
		});
	});
</script>