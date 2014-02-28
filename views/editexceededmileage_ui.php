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
global $constantArr;
// Intializing MCrypt class
$MCrypt	= new MCrypt; 
?>
<div class="width700px">
	<div class="topgrayBG padTop10px padLeft15px">
		<div class="alignleft marTop3px"><h2><?php echo $constantArr['edit'][$_SESSION['lang']].' '.$constantArr['menuexceed'][$_SESSION['lang']]; ?></h5></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="<?php echo $constantArr['closePopup'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['closePopup'][$_SESSION['lang']]; ?>" onclick="parent.$.fancybox.close();" />
		</div>
	</div>
	<div class="pad20px">
		<form action="" method="post" enctype="multipart/form-data" name="exceededmileagevehicleform" id="exceededmileagevehicleform">
			<div>
				<p class="marTop0px">
					<label class="medium"><?php echo $constantArr['License'][$_SESSION['lang']]; ?>: </label>
					<input autocomplete="off" type="text" class="txtBox200px" name="lno" id="lno" onkeyup="lookup(this.value);" value="<?php echo $data['editTaxVehiInfo']['licence_no'];?>"  maxlength="20"/>
					<div class="suggestionsBoxMedium" id="suggestions" style="display: none;">
						<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
					</div>
				</p>
				<p>
					<label class="medium"><?php echo $constantArr['vinlbl'][$_SESSION['lang']]; ?>:</label>
					<input type="text" class="txtBox320px" value="<?php echo $MCrypt->decrypt($data['editTaxVehiInfo']['vin']);?>" id="vin" name="vin" maxlength="17" onblur="return checkVIN(this.id,this.value,'errorMessage','txtBox320px','errorBdr txtBox320px');" 
					onfocus="clearLicense();" onkeyPress="validateVin(this.id);"/>
					<a id="VIN" href="javascript:void(0)">
						<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
					</a>
				</p>
				<p>
					<label class="medium"><?php echo $constantArr['grossweightlbl'][$_SESSION['lang']]; ?>:</label>
					<select class="txtBox320px" name="taxableWeight" id="taxableWeight">
						<option value=""><?php echo $constantArr['SelectWeightlbl'][$_SESSION['lang']]; ?></option>
						<?php 
							for($i=0; $i<count($data['Taxweights']); $i++)
							{
								$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
								$this->taxablevehicleinfoDAO = $taxablevehicleinfoDAO;
								$TaxWeight = $taxablevehicleinfoDAO->gettaxableGrossWeight( $MCrypt->decrypt($data['editTaxVehiInfo']['weight_category']));
								?>																			
									<option <?php if($data['Taxweights'][$i]['weight'] == $TaxWeight['weight']) {?>selected="selected" <?php }?>  value="<?php echo $data['Taxweights'][$i]['weight_category']?>"><?php echo $data['Taxweights'][$i]['weight']?></option>
							<?php }
						?>
					</select>
				</p>
				<p>
					<label class="medium"><?php echo $constantArr['Logginglbl'][$_SESSION['lang']]; ?>:</label>
					<input type="radio" name="logging" id="yes" value="Y" <?php if($MCrypt->decrypt($data['editTaxVehiInfo']['is_logging'])=='Y') { ?> checked="checked" <?php } ?>/> <label for="<?php echo $constantArr['yeslbl'][$_SESSION['lang']]; ?>"><?php echo $constantArr['yeslbl'][$_SESSION['lang']]; ?></label> &nbsp;
					<input type="radio" name="logging" id="no" value="N" <?php if($MCrypt->decrypt($data['editTaxVehiInfo']['is_logging'])=='N') { ?> checked="checked" <?php } ?>/> <label for="<?php echo $constantArr['nolbl'][$_SESSION['lang']]; ?>"><?php echo $constantArr['nolbl'][$_SESSION['lang']]; ?></label>
					<a id="logging" href="javascript:void(0)">
						<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
					</a>
				</p>
				<p class="marTop0px">
					<label class="medium">&nbsp;</label>
					<span class="redTxt" id="error_msg"></span><br/>
					<label class="medium">&nbsp;</label>
					<input type="submit" class="blueButn100px" name="updateexceededmileage" value="<?php echo $constantArr['updatebtn'][$_SESSION['lang']]; ?>" onclick="return validateExceedMileageVehicleform();"/>
					<input type="button" class="blueButn100px marLeft20px marTop10px" value="<?php echo $constantArr['cancelbtn'][$_SESSION['lang']]; ?>" onclick="parent.$.fancybox.close();" />
					<input type="hidden" id="emId" name="emId" value="<?php echo $_REQUEST['emId'];?>"/>
					<input type="hidden" id="vehicleno" name="vehicleno" value="<?php echo $_REQUEST['vehicleno'];?>"/>
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
