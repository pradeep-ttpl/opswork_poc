<?php 
global $constantArr;

if(date('m') <= 6)
$year = date('Y');
else 
$year = date('Y') - 1;

$PriorStartyear = $year -3;
$PriorEndyear = $year;
?>
<script>
$(function() {
	$( "#firstyear,#soldyear" ).datepicker({
		showOn: "button",
		changeMonth: true,
		changeYear: true,
		buttonImage: "/js/datepicker/calendar.png",
		buttonImageOnly: true,
		dateFormat: "yy-mm-dd",
		minDate: "<?php echo $PriorStartyear.'-07-01';?>",
		maxDate: "<?php echo $PriorEndyear.'-06-30';?>"
	});
});
</script>
<div class="width1024px">
	<div class="topgrayBG padTop10px padLeft15px">
		<div class="alignleft marTop3px"><h2><?php echo $constantArr['addNew'][$_SESSION['lang']].' '.$constantArr['sold_destroyed_vehicles'][$_SESSION['lang']]?></h5></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="<?php echo $constantArr['closePopup'][$_SESSION['lang']];?>" title="<?php echo $constantArr['closePopup'][$_SESSION['lang']];?>" onclick="parent.$.fancybox.close();" />
		</div>
	</div>
	<div class="pad20px">
		<form action="/solddestroycredit/" method="post" enctype="multipart/form-data" name="solddestroycreditForm" id="solddestroycreditForm">
			<div>
				<div class="marTop0px">
					<div class="width475px alignleft">
						<label class="small"><?php echo $constantArr['License'][$_SESSION['lang']];?> :</label>
						<input autocomplete="off" type="text" class="txtBox200px" name="lno" id="lno" onkeyup="lookup(this.value);"  maxlength="20"/>
						<div class="suggestionsBox" id="suggestions" style="display: none;">
							<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
						</div>	
					</div>
					<div class="width475px alignleft marLeft20px">
						<label class="small"><?php echo $constantArr['vinlbl'][$_SESSION['lang']]; ?>:</label>
						<input type="text" class="txtBox150px" id="VIN" name="VIN" maxlength="17" onblur="return checkVIN(this.id,this.value,'error_msg','txtBox150px','errorBdr txtBox150px');" 
						onfocus="clearLicense();" onkeyPress="validateVin(this.id);"/>
						<a id="VINval" href="javascript:void(0)">
							<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
						</a>
					</div>
					<br clear="all"/>
				</div>
				<div class="marTop20px">
					<div class="width475px alignleft">
						<label class="small"><?php echo $constantArr['grossweightlbl'][$_SESSION['lang']]; ?>:</label>
						<select class="txtBox150px" name="weight" id="weight">
							<option value=""><?php echo $constantArr['SelectWeightlbl'][$_SESSION['lang']]; ?></option>
							<?php foreach( $data['weightArr'] as $taxWeightVal ):?>
							<option value="<?=$taxWeightVal['weight_category'];?>"><?php echo $taxWeightVal['weight'];?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="width375px alignleft marLeft20px">
						<label class="small"><?php echo $constantArr['Logginglbl'][$_SESSION['lang']]; ?>:</label>
						<input type="radio" value="Y" name="logging" id="loggingyes" /> <?php echo $constantArr['yeslbl'][$_SESSION['lang']]; ?> &nbsp;
						<input type="radio" value="N" name="logging" id="loggingno"  /> <?php echo $constantArr['nolbl'][$_SESSION['lang']]; ?>
						<a id="logging" href="javascript:void(0)">
							<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
						</a>
					</div>
					<br clear="all"/>
				</div>
				<div class="marTop20px">
					<div class="width475px alignleft" >
						<label class="small alignleft"><?php echo $constantArr['sold_first_used_month'][$_SESSION['lang']];?> :</label>
						<input type="text" readonly id="firstyear" name="firstyear" class="txtBox150px marRight10px" />
					</div>
					<div class="width375px alignleft marLeft20px">
						<label class="small"><?php echo $constantArr['losstype'][$_SESSION['lang']];?>:</label>
						<select class="txtBox150px" name="lossType" id="lossType">
							<option value=""><?=$constantArr['selectType'][$_SESSION['lang']]?></option>
							<option value="sold"><?=$constantArr['sold'][$_SESSION['lang']]?></option>
							<option value="destroyed"><?=$constantArr['destroyed'][$_SESSION['lang']]?></option>
							<option value="stolen"><?=$constantArr['stolen'][$_SESSION['lang']]?></option>
						</select>
					</div>
					<br clear="all"/>
				</div>
				<div class="marTop20px">
					<div class="width475px alignleft">
						<label class="small alignleft"><?php echo $constantArr['solddestroydate'][$_SESSION['lang']]; ?>:</label>
						<input type="text" readonly id="soldyear" name="soldyear" class="txtBox150px marRight10px" />
					</div>
					<br clear="all"/>
				</div>
				<div class="marTop20px">
					<div class="alignleft width475px">
						<label class="small alignleft"><?php echo $constantArr['expplanation'][$_SESSION['lang']]; ?>:</label>
						<textarea type="text" name="explanation" id="explanation" rows="3" cols="27" maxlength="9000" class="textArea"></textarea>
					</div>
					<div class="alignleft marLeft20px">
						<label class="small alignleft"><?php echo $constantArr['uploaddocument'][$_SESSION['lang']];?></label>
						<input type="file" class="noborder txtBox260px" name="document" id="document" />
					</div>
					<br clear="all"/>
				</div>
				<div class="marTop20px topBdr">
					<div class="redTxt marTop10px" align="right" id="error_msg"></div>
					<input type="hidden" id="serverTime" name="serverTime" value="<?php echo date("Y-m-d h:i:s");?>"/>
					<input type="button" class="blueButn100px marLeft20px marTop10px alignright" alt="<?php echo $constantArr['Cancellbl'][$_SESSION['lang']];?>" title="<?php echo $constantArr['Cancellbl'][$_SESSION['lang']];?>" value="<?php echo $constantArr['Cancellbl'][$_SESSION['lang']];?>" onclick="parent.$.fancybox.close();" />
					<input type="submit" class="blueButn100px marTop10px alignright" name="addSoldInfo" onclick="return validateSoldVhle('<?php echo $_SESSION['filingId'];?>','<?php echo $_SESSION['formtype'];?>');" alt="<?php echo $constantArr['savebtn'][$_SESSION['lang']];?>" title="<?php echo $constantArr['savebtn'][$_SESSION['lang']];?>" value="<?php echo $constantArr['savebtn'][$_SESSION['lang']];?>" />
				</div>
				<br clear="all"/>
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
