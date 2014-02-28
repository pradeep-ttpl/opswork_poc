<?php 
global $constantArr;
// Intializing MCrypt class
$MCrypt	= new MCrypt;
?>
<div class="width700px">
	<div class="topgrayBG padTop10px padLeft15px">
		<div class="alignleft marTop3px"><h2><?=$constantArr['addfleet'][$_SESSION['lang']]?></h5></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="Close Popup" title="Close Popup" onclick="parent.$.fancybox.close();" />
		</div>
	</div>
	<div class="pad20px">
		<form action="/fleet/" method="post" enctype="multipart/form-data" name="addfleet" id="fleetForm">
			<div>
				<p class="marTop0px">
					<label class="medium"><?=$constantArr['Business'][$_SESSION['lang']]?>:</label>
					<select class="txtBox320px" name="business" id="business" onchange="javascript:document.getElementById('licenceno').value='';">
						<option value="0"><?=$constantArr['SelectBusinesslbl'][$_SESSION['lang']]?></option>
						<?php
							foreach($data['businessDetails'] AS $values)
							{
								echo '<option value="'.$values['id'].'"';
								
								if(isset($_SESSION['selectedbusiness']) && $_SESSION['selectedbusiness'] == $values['id'])
								{
									echo ' selected="selected"';
								}
								
								echo '>'.$MCrypt->decrypt($values['name']).'</option>';
							}
						?>
					</select>
				</p>
				<p>
					<label class="medium"><?=$constantArr['License'][$_SESSION['lang']]?>:</label>
					<input type="text" class="txtBox320px" id="licenceno" name="licenceno" maxlength="20" onblur="chkVehicleNickname(this.id,this.value)"/>
				</p>
				<p>
					<label class="medium"><?=$constantArr['vinlbl'][$_SESSION['lang']]?>:</label>
					<input type="text" class="txtBox320px" onblur="return checkVIN(this.id,this.value,'errorMessage','txtBox320px','errorBdr txtBox320px');" 
					onkeyPress="validateVin(this.id);" maxlength="17" id="vin" name="vin" />
					<a id="VIN" href="javascript:void(0)">
						<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
					</a>
				</p>
				<p>
					<label class="medium"><?=$constantArr['grossweightlbl'][$_SESSION['lang']]?> (In pounds):</label>
					<select class="txtBox150px" name="taxableWeight" id="taxableWeight">
						<option value=""><?=$constantArr['SelectWeightlbl'][$_SESSION['lang']]?></option>
						<?php foreach( $data['taxWeights'] as $taxWeightVal ):?>
						<option value="<?=$taxWeightVal['weight_category'];?>"><?php echo $taxWeightVal['weight'];?></option>
						<?php endforeach ?>
					</select>
				</p>
				<p>
					<label class="medium"><?=$constantArr['logingcurentyearlbl'][$_SESSION['lang']]?>:</label>
					<input type="radio" id="yes" name="logging" value="Y" /> <label for="yes"><?=$constantArr['yeslbl'][$_SESSION['lang']]?></label> &nbsp;
					<input id="no" name="logging" type="radio" value="N" /> <label for="no"><?=$constantArr['nolbl'][$_SESSION['lang']]?></label>
					<a id="logging" href="javascript:void(0)">
						<img class="marLeft10px" src="/images/helpIcon.png" alt="Help" title="Help"/>
					</a>
				</p>
				<p class="marTop0px">
					<label class="medium">&nbsp;</label>
					<span class="redTxt" id="errorMessage"></span><br/>
				
					<label class="medium">&nbsp;</label>
					<input type="submit" name="addfleet" onclick="return validateFleet();" class="blueButn100px" value="<?=$constantArr['Addlbl'][$_SESSION['lang']]?>" />
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
