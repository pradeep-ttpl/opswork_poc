<?php 
global $constantArr;
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
		<div class="alignleft marTop3px"><h2><?=$constantArr['Addlbl'][$_SESSION['lang']] . " " . $constantArr['overpaymentlbl'][$_SESSION['lang']]?></h5></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="Close Popup" title="Close Popup" onclick="parent.$.fancybox.close();" />
		</div>
	</div>
	<div class="pad20px">
		<form action="/overpayment/" method="post" onsubmit="return validateCreditOverPayment()" enctype="multipart/form-data" name="overpaymentform" id="overpaymentform">
			<div>
				<p class="marTop0px">
					<label class="small"><?=$constantArr['License'][$_SESSION['lang']]?>:</label>
					<input autocomplete="off" type="text" class="txtBox200px" name="lno" id="lno" onkeyup="lookup(this.value);"  maxlength="20"/>
					<div class="suggestionsBox" id="suggestions" style="display:none;">
						<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
					</div>
				</p>
				<p>
					<label class="small"><?=$constantArr['vinlbl'][$_SESSION['lang']]?>:</label>
					<input type="text" class="txtBox260px" name="vin"  id="vin" maxlength="17" onblur="return checkVIN(this.id,this.value,'error_msg','txtBox260px','errorBdr txtBox260px');" 
					onfocus="clearLicense();" onkeyPress="validateVin(this.id);"/>
					<a id="VIN" href="javascript:void(0)">
						<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
					</a>
				</p>
				<br clear="all"/>
				<div class="alignleft width475px marTop20px">
					<label class="small"><?=$constantArr['paymentdate'][$_SESSION['lang']]?>:</label>
					<input type="text" readonly id="paymentdate" name="paymentdate" class="txtBox150px marRight10px" />
				</div>
				<div class="alignleft width375px marTop20px">
					<label class="small"><?=$constantArr['amountclaim'][$_SESSION['lang']]?>: ($)</label>
					<input type="text" class="txtBox150px" id="amtclaim" name="amtclaim" maxlength="8" onKeyPress="return numbersonly(this,event);" />
				</div>
				<br clear="all"/>
				<p>
					<label class="small alignleft"><?=$constantArr['expplanation'][$_SESSION['lang']]?>:</label>
					<textarea name="explanation" rows="3" cols="30" maxlength="9000" class="textArea" id="explanation"></textarea>
				</p>
				<div class="width475px padTop20px">
					<label class="small"><?=$constantArr['uploaddocument'][$_SESSION['lang']]?>:</label>
					<input type="file" class="noborder txtBox260px" value ="Upload your logo"  name="document" id="document"/>
					<br clear="all" />
				</div>
				<p>
					<label class="small">&nbsp;</label>
					<span class="redTxt" id="error_msg"></span><br/>
				
					<label class="small">&nbsp;</label>
					<input type="submit" name="addoverpayment" class="blueButn100px" value="<?=$constantArr['savebtn'][$_SESSION['lang']]?>" />
					<input type="button" class="blueButn100px marLeft20px marTop10px" value="<?=$constantArr['Cancellbl'][$_SESSION['lang']]?>" onclick="parent.$.fancybox.close();" />
				</p>
			</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#VIN').tooltipster({
			content: $("<span><?=$constantArr['VIN_help_txt'][$_SESSION['lang']]?></span>")
		});
		$('#logging').tooltipster({
			content: $("<span><?=$constantArr['logging_help_txt'][$_SESSION['lang']]?></span>")
		});
	});
</script>
