<?php
global $constantArr;

if(date('m') <= 6)
$year = date('Y');
else 
$year = date('Y') - 1;

$PriorStartyear = $year -2;
$PriorEndyear = $year -1;
?>
<script id="js">
	$(function() {
		$( "#transferSold_date" ).datepicker({
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
<div class="width700px">
	<div class="topgrayBG padTop10px padLeft15px">
		<div class="alignleft marTop3px"><h2><?=$constantArr['Addlbl'][$_SESSION['lang']] . " " . $constantArr['pryrsusvehiinfolbl'][$_SESSION['lang']]?></h5></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="Close Popup" title="Close Popup" onclick="parent.$.fancybox.close();" />
		</div>
	</div>
	<div class="pad20px">
		
		<form action="" method="post" enctype="multipart/form-data" name="priorYrSusVehicle" id="priorYrSusVehicle">
			<div>
				<p class="marTop0px">
					<label class="small"><?=$constantArr['License'][$_SESSION['lang']]?>:</label>
					<input autocomplete="off" type="text" class="txtBox200px" name="lno" id="lno" onkeyup="lookup(this.value);"  maxlength="20"/>
					<div class="suggestionsBox" id="suggestions" style="display: none;">
						<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
					</div>
				</p>
				<p>
					<label class="small"><?=$constantArr['vinLbl'][$_SESSION['lang']]?>:</label>
					<input type="text" class="txtBox320px" name="vin" id="vin" maxlength="17" onblur="return checkVIN(this.id,this.value,'errorMessage','txtBox320px','errorBdr txtBox320px');" 
						onfocus="clearLicense();" onkeyPress="validateVin(this.id);"/>
					<a id="VINval" href="javascript:void(0)">
						<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
					</a>
				</p>
				<p>
					<label class="small"><?=$constantArr['suspendedvehicletitle'][$_SESSION['lang']]?>:</label>
					<input type="radio" name="report_type" id="milegae" value="mileage" onclick="hideSoldDetails()"/> <?=$constantArr['exceededmileage'][$_SESSION['lang']]?> &nbsp;
					<input type="radio" name="report_type" id="sold" value="sold" onclick="showSoldDetails()"/> <?=$constantArr['soldtransfered'][$_SESSION['lang']]?>
				</p>
				<div id="sold_details">
					<p>
						<label class="small"><?=$constantArr['soldtranstolbl'][$_SESSION['lang']]?>:</label>
						<input class="txtBox320px" name="soldTransfrdTo" id="soldTransfrdTo" disabled="disabled"/>
					</p>
					<p>
						<label class="small"><?=$constantArr['dateoftranslbl'][$_SESSION['lang']]?>:</label>
						<input type="text" readonly id="transferSold_date" name="transferSold_date" class="txtBox100px marRight5px" id="datepicker" disabled="disabled"/>
					</p>
				</div>
				<p class="marTop0px">
					<label class="small">&nbsp;</label>
					<span class="redTxt" id="errorMessage"></span><br/>
				
					<label class="small">&nbsp;</label>
					<input type="submit" class="blueButn100px" value="<?=$constantArr['savebtn'][$_SESSION['lang']]?>" name="AddPriorYrSusVehi" onclick="return priorYrSusVehicleValidate();"/>
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
	});
</script>
