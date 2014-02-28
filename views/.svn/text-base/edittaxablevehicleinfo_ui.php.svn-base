<?php
global $constantArr;
if(isset($_REQUEST['vehicleno']))
$urlvin = $_REQUEST['vehicleno'];
$TaxableId = $_REQUEST['TaxableId'];
// Intializing MCrypt class
$MCrypt	= new MCrypt;
?>
	<div class="width700px">
		<div class="topgrayBG padTop10px padLeft15px">
			<div class="alignleft marTop3px"><h2><?=$constantArr['edittaxablevehicle'][$_SESSION['lang']]?></h2></div>
			<div class="alignright padRight10px marTop3px cursor">
				<img src="/images/close.png" alt="<?=$constantArr['closePopup'][$_SESSION['lang']]?>" title="<?=$constantArr['closePopup'][$_SESSION['lang']]?>" onclick="parent.$.fancybox.close();" />
			</div>
		</div>
		<div class="pad20px">
			<form action="" method="post" enctype="multipart/form-data" name="taxablevehicleform" id="taxablevehicleform">
				<div>
					<p class="marTop0px">
						<label class="small"><?=$constantArr['License'][$_SESSION['lang']]?>:</label>
						<input autocomplete="off" type="text" class="txtBox200px" name="lno" id="lno" value='<?=(isset($data['editTaxVehiInfo']['licence_no'])?$data['editTaxVehiInfo']['licence_no']:'')?>' onkeyup="lookup(this.value);" maxlength="20" >
						<div class="suggestionsBox" id="suggestions" style="display:none;">
							<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
						</div>
					</p>
					<p>
						<label class="small"><?=$constantArr['vinlbl'][$_SESSION['lang']]?>:</label>
						<input type="text" class="txtBox320px" name="vin"  id="vin" maxlength="17" value='<?=(isset($data['editTaxVehiInfo']['vin'])?$MCrypt->decrypt($data['editTaxVehiInfo']['vin']):'')?>' onblur="return checkVIN(this.id,this.value,'error_msg','txtBox320px','errorBdr txtBox320px');" 
						onfocus="clearLicense();" onkeyPress="validateVin(this.id);"/>
						<a id="VINval" href="javascript:void(0)">
							<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
						</a>
					</p>
					<p>
						<label class="small"><?=$constantArr['grossweightlbl'][$_SESSION['lang']]?>:</label>
						<select class="txtBox150px" name="taxableWeight" id="taxableWeight">
							<option value=""><?=$constantArr['SelectWeightlbl'][$_SESSION['lang']]?></option>
							<?php 
								for($i=0; $i<count($data['Taxweights']); $i++)
								{
									$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
									$this->taxablevehicleinfoDAO = $taxablevehicleinfoDAO;
									$TaxWeight = $taxablevehicleinfoDAO->gettaxableGrossWeight($MCrypt->decrypt($data['editTaxVehiInfo']['weight_category']));
									?>																			
										<option <?php if($data['Taxweights'][$i]['weight'] == $TaxWeight['weight']) {?>selected="selected" <?php }?>  value="<?php echo $data['Taxweights'][$i]['weight_category']?>"><?php echo $data['Taxweights'][$i]['weight']?></option>
								<?php }
							?>
						</select>
					</p>
					<p>
						<label class="small"><?=$constantArr['Logginglbl'][$_SESSION['lang']]?>:</label>
						<input type="radio" name="logging" id="yes" value="Y" <?php if($MCrypt->decrypt($data['editTaxVehiInfo']['is_logging'])=='Y') { ?> checked="checked" <?php } ?>/> <label for="yes"><?=$constantArr['yeslbl'][$_SESSION['lang']]?></label> &nbsp;
						<input type="radio" name="logging" id="no" value="N" <?php if($MCrypt->decrypt($data['editTaxVehiInfo']['is_logging'])=='N') { ?> checked="checked" <?php } ?>/> <label for="no"><?=$constantArr['nolbl'][$_SESSION['lang']]?></label>
						<a id="loggingval" href="javascript:void(0)">
							<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
						</a>
					</p>
					<p class="marTop0px">
						<label class="small">&nbsp;</label>
						<span class="redTxt" id="error_msg"></span><br/>
						<label class="small">&nbsp;</label>
						<input type="submit" class="blueButn100px" name="updatetaxablevehiInfo" value="<?=$constantArr['updatebtn'][$_SESSION['lang']]?>" onclick="return validatetaxablevehicleform();"/>
						<input type="button" class="blueButn100px marLeft20px marTop10px" value="<?=$constantArr['Cancellbl'][$_SESSION['lang']]?>" onclick="parent.$.fancybox.close();" />
<!--					<input type='hidden' id='vehicleno' name='vehicleno' value='<?php //echo $_REQUEST["vehicleno"]?>'/>-->
						<input type='hidden' id='TaxableId' name='TaxableId' value='<?php echo $_REQUEST["TaxableId"]?>'/>
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
	});
</script>
