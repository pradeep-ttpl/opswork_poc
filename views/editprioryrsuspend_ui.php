<?php 
global $constantArr;
$getPriorYrDetails = $data['getPriorYrDetails'];
// Intializing MCrypt class
$MCrypt	= new MCrypt;

if(date('m') <= 6)
$year = date('Y');
else 
$year = date('Y') - 1;

$PriorStartyear = $year -2;
$PriorEndyear = $year -1;
?>
<script>
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
		<div class="alignleft marTop3px"><h2><?=$constantArr['edit'][$_SESSION['lang']] . " " . $constantArr['pryrsusvehiinfolbl'][$_SESSION['lang']]?></h5></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="Close Popup" title="Close Popup" onclick="parent.$.fancybox.close();" />
		</div>
	</div>
	<div class="pad20px">				

		<form action="" method="post" enctype="multipart/form-data" name="editpriorYrSusVehicle" id="editpriorYrSusVehicle">
			<div>
				<p class="marTop0px">
					<label class="small"><?=$constantArr['License'][$_SESSION['lang']]?>:</label>
					<input autocomplete="off" type="text" class="txtBox200px" name="lno" id="lno" value='<?=(isset($data['editPriorYrDetails']['licence_no'])?$data['editPriorYrDetails']['licence_no']:'')?>' onkeyup="lookup(this.value);"  maxlength="20"/>
					<div class="suggestionsBox" id="suggestions" style="display: none;">
						<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
					</div>
				</p>
				<p>
					<label class="small"><?=$constantArr['vinLbl'][$_SESSION['lang']]?>:</label>
					<input type="text" class="txtBox320px" name="vin" id="vin" maxlength="17" value="<?php echo $MCrypt->decrypt($data['editPriorYrDetails']['vin']); ?>" onblur="return checkVIN(this.id,this.value,'errorMessage','txtBox320px','errorBdr txtBox320px');" 
						onfocus="clearLicense();" onkeyPress="validateVin(this.id);"/>
					<a id="VINval" href="javascript:void(0)">
						<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
					</a>
				</p>
				<p>
					<label class="small"><?=$constantArr['suspendedvehicletitle'][$_SESSION['lang']]?>:</label>
					<input type="radio" name="report_type" id="milegae" value="mileage" onclick="hideSoldDetails()" <?php if($MCrypt->decrypt($data['editPriorYrDetails']['is_exceeded_mileage'])=='Y') {?> checked <?php }?>/> <?=$constantArr['exceededmileage'][$_SESSION['lang']]?> &nbsp; &nbsp;
					<input type="radio" name="report_type" id="sold" value="sold" onclick="showSoldDetails()" <?php if($MCrypt->decrypt($data['editPriorYrDetails']['is_vehicle_sold'])=='Y') {?> checked <?php }?>/> <?=$constantArr['soldtransfered'][$_SESSION['lang']]?>
				</p>
				<div id="sold_details">
					<p>
						<label class="small"><?=$constantArr['soldtranstolbl'][$_SESSION['lang']]?>:</label>
						<input class="txtBox320px" name="soldTransfrdTo" id="soldTransfrdTo" value="<?php echo $MCrypt->decrypt($data['editPriorYrDetails']['sold_to_whom']); ?>" <?php if($MCrypt->decrypt($data['editPriorYrDetails']['is_vehicle_sold'])=='N') {?> disabled="disabled" <?php } ?>/>
					</p>
					<p>
						<label class="small"><?=$constantArr['dateoftranslbl'][$_SESSION['lang']]?>:</label>
						<input type="text" readonly id="transferSold_date" name="transferSold_date" class="txtBox100px marRight5px" id="datepicker" value="<?php echo $MCrypt->decrypt($data['editPriorYrDetails']['sold_date'])?>" <?php if($MCrypt->decrypt($data['editPriorYrDetails']['is_vehicle_sold'])=='N') {?> disabled="disabled" <?php } ?>/>
					</p>
				</div>
				<p class="marTop0px">
					<label class="small">&nbsp;</label>
					<span class="redTxt" id="errorMessage"></span><br/>
				
					<label class="small">&nbsp;</label>
					<input type="submit" class="blueButn100px" value="<?=$constantArr['updatelbl'][$_SESSION['lang']]?>" name="updatePriorYrSuspend" onclick="return priorYrSusVehicleValidate();"/>
					<input type="button" class="blueButn100px marLeft20px marTop10px" value="<?=$constantArr['Cancellbl'][$_SESSION['lang']]?>" onclick="parent.$.fancybox.close();" />
					<input type="hidden" id="preYrSpndId" name="preYrSpndId" value="<?php echo $_REQUEST['preYrSpndId'];?>"/>
<!--				<input type="hidden" id="Vehicleno" name="Vehicleno" value="<?php //echo $_REQUEST['Vehicleno'];?>"/>-->
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
	});
</script>
