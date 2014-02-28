<?php 
include_once 'header.php';
if(isset($parsed[2]) && $parsed[2] == 'new'){

	if(isset($_SESSION['selectedbusiness']))
		unset($_SESSION['selectedbusiness']);
		
	if(isset($_SESSION['formtype']))
		unset($_SESSION['formtype']);
		
	if(isset($_SESSION['filingId']))
		unset($_SESSION['filingId']);
		
	if(isset($_SESSION['filingMonth']))
		unset($_SESSION['filingMonth']);
		
	if(isset($_SESSION['filingYear']))
		unset($_SESSION['filingYear']);
		
	if(isset($_SESSION['finalReturn']))
		unset($_SESSION['finalReturn']);
		
	if(isset($_SESSION['addresschange']))
		unset($_SESSION['addresschange']);
		
	if(isset($_SESSION['amendMentMonth']))
		unset($_SESSION['amendMentMonth']);	
	
	if(isset($_SESSION['taxYearEndFilingMonth']))
		unset($_SESSION['taxYearEndFilingMonth']);
	
}
// Intializing MCrypt class
$MCrypt	= new MCrypt;

if(!empty($_SESSION['filingMonth']))
{
	echo '
		<script type="text/javascript">
			window.onload = function()
			{
				calculateMonth();
			};
		</script>';
}
if(!empty($_SESSION['taxYearEndFilingMonth'])) //To get tax year details for 8849S6
{
	echo '
		<script type="text/javascript">
			window.onload = function()
			{
				calculateTaxYearMonth();
			};
		</script>';
}
?>	
<script>
//$(function() {
//	$( "#earliestDateId,#latestDateId" ).datepicker({
//		showOn: "button",
//		changeMonth: true,
//		changeYear: true,
//		buttonImage: "/js/datepicker/calendar.png",
//		buttonImageOnly: true,
//		dateFormat: "yy-mm-dd",
//		yearRange: '-2:+0'
//	});
//});
</script>

	<div class="border marTop-1px pad30px">
		<!--Instruction area-->
		<div class="botBdr padBottom10px pageTipContentAreaBg">	
			<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="Information" title="Information" class="alignleft" /></div>
			<div class="alignleft padLeft10px pageTipContentArea">
				<?php echo $constantArr['taxyeardesc'][$_SESSION['lang']];?>
			</div>
			<br clear="all"/>
		</div>
		<?php include_once 'filingsteps.php';?>
		<form action="" method="post" enctype="multipart/form-data" name="taxfilingyear" id="taxfilingyear" onsubmit="return validateTaxFilingYear()">
			<div>
				<p>
					<label class="small"><?php echo $constantArr['biz_name'][$_SESSION['lang']];?>:</label>
					<select class="txtBox320px" name="business" id="business">
						<option value="0"><?php echo $constantArr['SelectBusinesslbl'][$_SESSION['lang']];?></option>
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
					<label class="small"><?php echo $constantArr['formtype'][$_SESSION['lang']];?>:</label>
					<select class="txtBox320px" name="taxForm" id="taxForm" onchange="selectedForm(this.value)">
						<option value="0"><?php echo $constantArr['select'][$_SESSION['lang']];?></option>
						<?php
							foreach($data['taxForms'] AS $values)
							{
								echo '<option value="'.$values['type'].'"';
								
								if(isset($_SESSION['formtype']) &&  $_SESSION['formtype'] == $values['type'])
								{
									echo ' selected="selected"';
								}
								
								echo '>'.$values['desc'].'</option>';
							}
						?>
					</select>&nbsp;&nbsp;
	<!--				<select class="txtBox150px marLeft10px" name="taxFrom" id="taxForm">-->
	<!--					<option>Select</option>-->
	<!--					<option selected>Schedule 6 </option>-->
	<!--				</select>-->
				</p>
				<p id="taxyearArea" style="display:<?php if(isset($_SESSION['formtype']) && $_SESSION['formtype']== '8849S6'){?>none;"<?php }else{?>block;"<?php }?>>
					<label class="small"><?php echo $constantArr['TaxYearlbl'][$_SESSION['lang']];?>:</label>
					<span id="taxYear_select_area">
					<select class="txtBox150px" name="taxyear" id="taxyear" onchange="calculateMonth()">
						<option value="0"><?php echo $constantArr['select'][$_SESSION['lang']];?></option>
						<?php
							foreach($data['taxFilingYear'] AS $values)
							{
								echo '<option value="'.$values['id'].'"';
								
								if(isset($_SESSION['filingYear']) && $_SESSION['filingYear'] == $values['id'])
								{
									echo ' selected="selected"'; 
								}
								
								echo '>'.$values['display_year'].'</option>';
							}
						?>
					</select>
					</span>
				</p>
				<p id='taxmonthArea' style="display:<?php if(isset($_SESSION['formtype']) && $_SESSION['formtype']== '8849S6'){?>none;"<?php }else{?>block;"<?php }?>>
					<label class="small"><?php echo $constantArr['Monthlbl'][$_SESSION['lang']];?>:</label>
					<span id="month_select_area">
						<select class="txtBox150px" name="taxmonth" id="taxmonth">
							<option value="0"><?php echo $constantArr['SelectMonthlbl'][$_SESSION['lang']];?></option>
						</select>
					</span>
				</p>
				<p id="amendMentMonthArea" style="display:<?php if(isset($_SESSION['formtype']) && $_SESSION['formtype']== '2290A1' || $_SESSION['formtype'] == '2290A2'){?>block;"<?php }else{?>none;"<?php }?>>
					<label class="small"><?php echo $constantArr['AmendmentMonthlbl'][$_SESSION['lang']];?>:</label>
					<span id="amendmentMonth_select_area">
						<select class="txtBox150px" name="amendmentMonth" id="amendmentMonth">
							<option value="0"><?php echo $constantArr['SelectMonthlbl'][$_SESSION['lang']];?></option>
						</select>
					</span>
				</p>
				<!-- 
				<p id="earliestDateArea" style="display:<?php if(isset($_SESSION['formtype']) && $_SESSION['formtype']== '8849S6'){?>block;"<?php }else{?>none;"<?php }?>>
					<label class="small"><?php echo $constantArr['earliestDatelbl'][$_SESSION['lang']];?>:</label>
					<span id="erliesstDate_select_area">
						<input type="text" readonly id="earliestDateId" name="earliestDateId" class="txtBox150px marRight10px" />
					</span>
				</p>
				<p id="latestDateArea" style="display:<?php if(isset($_SESSION['formtype']) && $_SESSION['formtype']== '8849S6'){?>block;"<?php }else{?>none;"<?php }?>>
					<label class="small"><?php echo $constantArr['LarliestDatelbl'][$_SESSION['lang']];?>:</label>
					<span id="latestDate_select_area">
						<input type="text" readonly id="latestDateId" name="latestDateId" class="txtBox150px marRight10px" />
					</span>
				</p>
				 -->
				<p id="taxYearEndMonthArea" style="display:<?php if(isset($_SESSION['formtype']) && $_SESSION['formtype']== '8849S6'){?>block;"<?php }else{?>none;"<?php }?>>
					<label class="small"><?php echo $constantArr['taxYearEndMonthlbl'][$_SESSION['lang']];?>:</label>
					<span id="taxYearEndMonth_select_area">
						<select class="txtBox150px" name="taxYearEndMonth" id="taxYearEndMonth">
							<option value="0"><?php echo $constantArr['SelectMonthlbl'][$_SESSION['lang']];?></option>
						</select>
					</span>
				</p>
				<div id="finalreturndiv" style="display:<?php if(isset($_SESSION['formtype']) && ( $_SESSION['formtype']== '8849S6' || $_SESSION['formtype']== '2290V')){?>none;"<?php }else{?>block;"<?php }?>>
				<p>
					<label class="small">&nbsp;</label>
					<input name="finalreturn" id="finalreturn" class="marRight10px" type="checkbox" <?php if(isset($_SESSION['finalReturn']) && $_SESSION['finalReturn'] == 1) echo 'checked'; ?>/>
					<b><label for="finalreturn"><?php echo $constantArr['finalreturn'][$_SESSION['lang']];?></label></b>
				</p>
				</div>
				<div id="addresschangediv" style="display:<?php if(isset($_SESSION['formtype']) && ( $_SESSION['formtype']== '8849S6' || $_SESSION['formtype']== '2290V')){?>none;"<?php }else{?>block;"<?php }?>>
				<p>
					<label class="small">&nbsp;</label>
					<input name="addresschange" id="addresschange" class="marRight10px" type="checkbox" <?php if(isset($_SESSION['addresschange']) && $_SESSION['addresschange'] == 1) echo 'checked'; ?> />
					<b><label for="addresschange"><?php echo $constantArr['addresschange'][$_SESSION['lang']];?></label></b>
				</p>
				</div>
				<p class="marTop0px">
					<label class="small">&nbsp;</label>
					<span class="redTxt" id="errorMsg"><?php if(isset($data['status'])){ echo $data['status'];}?></span><br/>
				
					<label class="small">&nbsp;</label>
					<input type="button" onclick="window.location='/filestatus/';" class="blueButn100px marTop10px" value="<?php echo $constantArr['goback'][$_SESSION['lang']];?>" alt="<?php echo $constantArr['backtobiz'][$_SESSION['lang']];?>" title="<?php echo $constantArr['backtobiz'][$_SESSION['lang']];?>" />
					<input type="submit" class="blueButn100px marLeft20px" value="<?php echo $constantArr['continuebtn'][$_SESSION['lang']];?>" alt="<?php echo $constantArr['continuefiling'][$_SESSION['lang']];?>" title="<?php echo $constantArr['continuefiling'][$_SESSION['lang']];?>" />
				</p>
			</div>
		</form>
	</div>
</div>
<?php include_once 'footer.php';?>