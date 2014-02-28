<?php
/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: exceededmileage_ui.php
 * @version  	: 1.0
 * @date  	 	: 26-Dec-2013
 *
 * @description : Exceededmileage view file
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        26-Dec-2013           Initial Version - File Created
 * 
 */
$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
$Taxweights = $taxablevehicleinfoDAO->taxWeightlist();

if(isset($_REQUEST['vehicleno']))
$urlvin = $_REQUEST['vehicleno'];

if(isset($_REQUEST['TaxableId']))
$TaxableId = $_REQUEST['TaxableId'];

global $constantArr;
?>
	<div class="width700px">
		<div class="topgrayBG padTop10px padLeft15px">
			<div class="alignleft marTop3px"><h5><?php echo $constantArr['Addlbl'][$_SESSION['lang']].' '.$constantArr['menuexceed'][$_SESSION['lang']]; ?></h5></div>
			<div class="alignright padRight10px marTop3px cursor">
				<img src="/images/close.png" alt="<?php echo $constantArr['closePopup'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['closePopup'][$_SESSION['lang']]; ?>" onclick="parent.$.fancybox.close();" />
			</div>
		</div>
		<div class="pad20px">
			<form action="" method="post" enctype="multipart/form-data" name="exceededmileagevehicleform" id="exceededmileagevehicleform">
				<div>
					<p class="marTop0px">
						<label class="medium"><?php echo $constantArr['License'][$_SESSION['lang']]; ?>: </label>
						<input autocomplete="off" type="text" class="txtBox200px" name="lno" id="lno" onkeyup="lookup(this.value);"  maxlength="20"/>
						<div class="suggestionsBoxMedium" id="suggestions" style="display: none;">
							<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
						</div>
					</p>
					<p>
						<label class="medium"><?php echo $constantArr['vinlbl'][$_SESSION['lang']]; ?>:</label>
						<input type="text" class="txtBox320px" name="vin"  id="vin" maxlength="17" onblur="return checkVIN(this.id,this.value,'error_msg','txtBox320px','errorBdr txtBox320px');" 
						onfocus="clearLicense();" onkeyPress="validateVin(this.id);"/>
						<a id="VIN" href="javascript:void(0)">
							<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
						</a>
					</p>
					<p>
						<label class="medium"><?php echo $constantArr['grossweightlbl'][$_SESSION['lang']]; ?>:</label>
						<select class="txtBox150px" name="taxableWeight" id="taxableWeight">
							<option value=""><?php echo $constantArr['SelectWeightlbl'][$_SESSION['lang']]; ?></option>
							<?php 
								for($j=0; $j<count($Taxweights); $j++)
								{
								?>																			
									<option value="<?php echo $Taxweights[$j]['weight_category']?>"><?php echo $Taxweights[$j]['weight']?></option>
								<?php
								}
							?>
						</select>
					</p>
					<p>
						<label class="medium"><?php echo $constantArr['Logginglbl'][$_SESSION['lang']]; ?>:</label>
						<input type="radio" id="yes" name="logging" value="Y" /><label for="<?php echo $constantArr['yeslbl'][$_SESSION['lang']]; ?>"><?php echo $constantArr['yeslbl'][$_SESSION['lang']]; ?></label> &nbsp;
						<input id="no" name="logging" type="radio" value="N" /><label for="<?php echo $constantArr['nolbl'][$_SESSION['lang']]; ?>"><?php echo $constantArr['nolbl'][$_SESSION['lang']]; ?></label>
						<a id="logging" href="javascript:void(0)">
							<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
						</a>
					</p>
					<p>
						<label class="medium">&nbsp;</label>
						<span class="redTxt" id="error_msg"></span><br/>
						<label class="medium">&nbsp;</label>
						<input type="submit" class="blueButn100px" name="addexceededmileage" value="<?php echo $constantArr['savebtn'][$_SESSION['lang']]; ?>" onclick="return validateExceedMileageVehicleform();"/>
						<input type="button" class="blueButn100px marLeft20px marTop10px" value="<?php echo $constantArr['Cancellbl'][$_SESSION['lang']]; ?>" onclick="parent.$.fancybox.close();" />
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
