<?php 
global $constantArr;
// Intializing MCrypt class
$MCrypt	= new MCrypt;
?>
<div class="width700px">
	<div class="topgrayBG padTop10px padLeft15px">
		<div class="alignleft marTop3px"><h2><?=$constantArr['edit'][$_SESSION['lang']] . " " . $constantArr['curentsuspendyearbl'][$_SESSION['lang']]?></h5></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="Close Popup" title="Close Popup" onclick="parent.$.fancybox.close();" />
		</div>
	</div>
	<div class="pad20px">
		<form name="taxablVehicle_information" action="" method="post" id="editsuspendvehicleform" onSubmit="return currentsuspendForm();">
			<div>
				<p class="marTop0px">
					<label class="small"><?=$constantArr['License'][$_SESSION['lang']]?>:</label>
					<input autocomplete="off" type="text" class="txtBox200px" name="lno" id="lno" value='<?=(isset($data['editcurrentsuspend']['licence_no'])?$data['editcurrentsuspend']['licence_no']:'')?>' onkeyup="lookup(this.value);"  maxlength="20"/>
					<div class="suggestionsBoxMedium" id="suggestions" style="display: none;">
						<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
					</div>
				</p>
				<p>
					<label class="small"><?=$constantArr['vinlbl'][$_SESSION['lang']]?>:</label>
					<input type="text" class="txtBox320px" value="<?php echo $MCrypt->decrypt($data['editcurrentsuspend']['vin']);?>" name="vin" id="vin" maxlength="17" onkeyPress="validateVin(this.id);"/>
					<a id="VINval" href="javascript:void(0)">
						<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
					</a>
				</p>
				<p>
					<label class="small"><?=$constantArr['Logginglbl'][$_SESSION['lang']]?>:</label>
					<input id="loggingyes" name="log_current" type="radio" value="Y" <?php if($MCrypt->decrypt($data['editcurrentsuspend']['is_logging'])=='Y') { ?> checked="checked" <?php } ?>/> <label for="loggingyes"><?=$constantArr['yeslbl'][$_SESSION['lang']]?></label>
					<input class="marLeft10px" type="radio" id="loggingno" name="log_current" value="N" <?php if($MCrypt->decrypt($data['editcurrentsuspend']['is_logging'])=='N') { ?> checked="checked" <?php } ?>/> <label for="loggingno"><?=$constantArr['nolbl'][$_SESSION['lang']]?></label>
					<a id="loggingval" href="javascript:void(0)">
						<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
					</a>
				</p>
				<p>
					<label class="small"><?=$constantArr['agrilbl'][$_SESSION['lang']]?>:</label>
					<input type="radio" value="Y" id="agriyes" name="agri_vehicle" <?php if($MCrypt->decrypt($data['editcurrentsuspend']['is_agriculture'])=='Y'){ ?> checked="checked" <?php } ?> /> <label for="agriyes"><?=$constantArr['yeslbl'][$_SESSION['lang']]?></label>
					<input id="agrino" class="marLeft10px" type="radio" value="N" name="agri_vehicle" <?php if($MCrypt->decrypt($data['editcurrentsuspend']['is_agriculture'])=='N') { ?> checked="checked" <?php } ?> /> <label for="agrino"><?=$constantArr['nolbl'][$_SESSION['lang']]?></label>
					<a id="agriculture" href="javascript:void(0)">
						<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
					</a>
				</p>
				<p class="marTop10px">
					<label class="small">&nbsp;</label>
					<span class="redTxt" id="errorMessage"></span><br/>
					<label class="small">&nbsp;</label>
					<input class="blueButn100px" type="submit" value="<?=$constantArr['updatelbl'][$_SESSION['lang']]?>" name="updatecurrentsuspend" onClick="return checkVIN('vin',document.getElementById('vin').value,'errorMessage','txtBox320px','errorBdr txtBox320px');" onfocus="clearLicense();"/>
					<input class="blueButn100px marLeft20px marTop10px" type="reset" value="<?=$constantArr['Cancellbl'][$_SESSION['lang']]?>" onclick="parent.$.fancybox.close();"/>

					<input type="hidden" id="crntYrSpndid" name="crntYrSpndid" value="<?php echo $_REQUEST['crntYrSpndid'];?>"/>
<!--				<input type="hidden" id="vehicleno" name="vehicleno" value="<?php //echo $_REQUEST['vehicleno'];?>"/>-->
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
		$('#loggingval').tooltipster({
			content: $("<span><?=$constantArr['logging_help_txt'][$_SESSION['lang']]?></span>")
		});
		$('#agriculture').tooltipster({
			content: $("<span><?=$constantArr['agriculture_help_txt'][$_SESSION['lang']]?></span>")
		});
	});
</script>
