<?php global $constantArr; ?>

<div class="width700px">
	<div class="topgrayBG padTop10px padLeft15px">
		<div class="alignleft marTop3px"><h2><?php echo $constantArr['Addlbl'][$_SESSION['lang']].' '.$constantArr['menutgwi'][$_SESSION['lang']]; ?></h5></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="<?php echo $constantArr['closePopup'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['closePopup'][$_SESSION['lang']]; ?>" onclick="parent.$.fancybox.close();" />
		</div>
	</div>
	<div class="pad20px">
		<form action="/tgwincreased/" method="post" enctype="multipart/form-data" name="tgwincreaseform" id="tgwincreaseform">
			<div>
				<p class="marTop0px">
					<label class="small"><?php echo $constantArr['License'][$_SESSION['lang']]; ?>: </label>
					<input autocomplete="off" type="text" class="txtBox200px" name="lno" id="lno" onkeyup="lookup(this.value);"  maxlength="20"/>
					<div class="suggestionsBox" id="suggestions" style="display: none;">
						<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
					</div>
				</p>
				<p>
					<label class="small"><?php echo $constantArr['vinlbl'][$_SESSION['lang']]; ?>:</label>
					<input type="text" class="txtBox320px" id="vin" name="vin" maxlength="17" onblur="return checkVIN(this.id,this.value,'errorMessage','txtBox320px','errorBdr txtBox320px');" 
					onfocus="clearLicense();" onkeyPress="validateVin(this.id);"/>
					<a id="VINval" href="javascript:void(0)">
						<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
					</a>
				</p>
				<p>
					<label class="small"><?php echo $constantArr['PreviousCategorylbl'][$_SESSION['lang']]; ?>:</label>
					<select class="txtBox150px" name="taxableWeight" id="taxableWeight">
						<option value=""><?php echo $constantArr['SelectWeightlbl'][$_SESSION['lang']]; ?></option>
						<?php foreach( $data['Taxweights'] as $taxWeightVal ):?>
						<option value="<?=$taxWeightVal['weight_category'];?>"><?php echo $taxWeightVal['weight'];?></option>
						<?php endforeach ?>
					</select>
				</p>
				<p>
					<label class="small"><?php echo $constantArr['ChangingToCategorylbl'][$_SESSION['lang']]; ?>:</label>
					<select class="txtBox150px" name="changingWeightCategory" id="changingWeightCategory">
						<option value=""><?php echo $constantArr['SelectWeightlbl'][$_SESSION['lang']]; ?></option>
						<?php foreach( $data['Taxweights'] as $taxWeightVal ):?>
						<option value="<?=$taxWeightVal['weight_category'];?>"><?php echo $taxWeightVal['weight'];?></option>
						<?php endforeach ?>
					</select>
				</p>
				<p>
					<label class="small"><?php echo $constantArr['Logginglbl'][$_SESSION['lang']]; ?>:</label>
					<input type="radio" id="yes" name="logging" value="Y" /><label for="<?php echo $constantArr['yeslbl'][$_SESSION['lang']]; ?>"><?php echo $constantArr['yeslbl'][$_SESSION['lang']]; ?></label> &nbsp;
					<input id="no" name="logging" type="radio" value="N" /><label for="<?php echo $constantArr['nolbl'][$_SESSION['lang']]; ?>"><?php echo $constantArr['nolbl'][$_SESSION['lang']]; ?></label>
					<a id="logging" href="javascript:void(0)">
						<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
					</a>
				</p>
				<p>
					<label class="small">&nbsp;</label>
					<span class="redTxt" id="errorMessage"></span><br/>
				
					<label class="small">&nbsp;</label>
					<input type="submit" name="addtgwincreased" onclick="return validateTGWI();" class="blueButn100px" value="<?php echo $constantArr['savebtn'][$_SESSION['lang']]; ?>" />
					<input type="button" class="blueButn100px marLeft20px marTop10px" value="<?php echo $constantArr['Cancellbl'][$_SESSION['lang']]; ?>" onclick="parent.$.fancybox.close();" />
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
