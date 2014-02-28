<?php 
global $constantArr;
$MCrypt	= new MCrypt;
//print_r($data['alreadyFiledVINs']);
?>

<div class="width700px">
	<div class="topgrayBG padTop10px padLeft15px">
		<div class="alignleft marTop3px"><h2><?php echo $constantArr['edit'][$_SESSION['lang']].' '.$constantArr['vincorrection'][$_SESSION['lang']]; ?></h5></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="<?php echo $constantArr['closePopup'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['closePopup'][$_SESSION['lang']]; ?>" onclick="parent.$.fancybox.close();" />
		</div>
	</div>
	<div class="pad20px">
		<form action="/vincorrection/" method="post" enctype="multipart/form-data" name="vincorrectionform" id="vincorrectionform">
			<div>
				<p class="marTop0px">
					<label class="small"><?php echo $constantArr['previousvinlbl'][$_SESSION['lang']]; ?>: </label>
					<select class="txtBox200px" name="previn" id="previn" onChange="javascript: return getTaxableGrossWeight(this.value);">
						<option value=""><?php echo $constantArr['previousvinlbl'][$_SESSION['lang']]; ?></option>
						<?php foreach( $data['alreadyFiledVINs'] as $alreadyFiledVINs ):?>
						<option value="<?=$MCrypt->decrypt($alreadyFiledVINs['vin']);?>"><?php echo $MCrypt->decrypt($alreadyFiledVINs['vin']);?></option>
						<?php endforeach ?>
					</select>
				</p>
				<p>
					<label class="small"><?php echo $constantArr['correctvinlbl'][$_SESSION['lang']]; ?>:</label>
					<input type="text" class="txtBox200px" id="vin" name="vin" maxlength="17" onblur="return checkVIN(this.id,this.value,'errorMessage','txtBox200px','errorBdr txtBox200px');" 
					onfocus="clearLicense();" onkeyPress="validateVin(this.id);"/>
					<a id="VINval" href="javascript:void(0)">
						<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
					</a>
				</p>
				<p>
					<label class="small"><?php echo $constantArr['VINType'][$_SESSION['lang']]; ?>:</label>
					<select class="txtBox150px" name="vinCorrectionType" id="vinCorrectionType">
						<option value=""> -  <?php echo $constantArr['selectDropDownType'][$_SESSION['lang']]; ?>  - </option>
						<option value="taxable">Taxable</option>
						<option value="suspend">Suspend</option>
						<option value="credit">Credit</option>
					</select>
				</p>
				<p>
					<label class="small"><?php echo $constantArr['grossweightlbl'][$_SESSION['lang']]; ?>:</label>
					<label class="small" id="grossweightlbl"></label>
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
					<input type="hidden" name="selectedFilingId" value="<?php echo $data['selectedFilingId']; ?>" />
					<input type="hidden" name="grossweightlblvalue" id="grossweightlblvalue"/>
					<input type="submit" name="editvincorrection" onclick="return validateEditVINCorrection();" class="blueButn100px" value="<?php echo $constantArr['updatebtn'][$_SESSION['lang']]; ?>" />
					<input type="button" class="blueButn100px marLeft20px marTop10px" value="<?php echo $constantArr['Cancellbl'][$_SESSION['lang']]; ?>" onclick="parent.$.fancybox.close();" />
				</p>
			</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#PVINval').tooltipster({
			content: $("<span><?=$constantArr['VIN_help_txt'][$_SESSION['lang']]?></span>")
		});
		$('#VINval').tooltipster({
			content: $("<span><?=$constantArr['VIN_help_txt'][$_SESSION['lang']]?></span>")
		});
		$('#logging').tooltipster({
			content: $("<span><?=$constantArr['logging_help_txt'][$_SESSION['lang']]?></span>")
		});
	});
</script>
