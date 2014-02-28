<?php 
include_once 'header.php';
global $constantArr,$monthAry;
$formType = $data['formType']; 

if(isset($_SESSION['summary_back_button'])){ unset($_SESSION['summary_back_button']); }

// For VIN Correction -  clearing selected VIN from the session
if(isset($_SESSION['selectedFIdForVin'])){ unset($_SESSION['selectedFIdForVin']); }

// Intializing MCrypt class
$MCrypt	= new MCrypt;
$total_tax = 0;
$total_credit = 0;
?>
<!--commented the nicescroll js and jquery function for double click issue-->
<!--script type="text/javascript" src="/js/jquery.nicescroll.min.js"></script-->
<script type="text/javascript">
	/*$(document).ready(function() {
		$("#summaryScroll").niceScroll({cursorborder:"",cursorcolor:"#CCC",boxzoom:true}); // First scrollable DIV
	});*/
	// fancy box
	$(document).ready(function() {
		$('.fancybox').fancybox();
	});
</script>
<!---------maincontainer section starts here------------>

	<div class="border marTop-1px pad30px">
		<!--Instruction area-->
		<div class="botBdr padBottom10px pageTipContentAreaBg">	
			<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="Information" title="Information" class="alignleft" /></div>
			<div class="alignleft padLeft10px pageTipContentArea">
				<?=$constantArr['summary_desc'][$_SESSION['lang']]?>
			</div>
			<br clear="all"/>
		</div>
		<?php 
		include_once 'filingsteps.php';
		if(!empty($_SESSION['adminStatusMsg']))
		{
			$explodeValue = explode('~',$_SESSION['adminStatusMsg']);
			if($explodeValue[1] == 'success')
			{	
				echo '<div class="marTop10px statusMsg"><span class="successIcon"></span>';
			}
			else 
			{ 	
				echo '<div class="marTop10px errorMsg"><span class="errorIcon"></span>';
			}
			
			echo $explodeValue[0]; unset($_SESSION['adminStatusMsg']);
			echo '</div>';
		}
		
		if(isset($_SESSION['validation_error'])){
				echo '<div class="marTop10px errorMsg"><span class="errorIcon"></span> '; 
				echo $_SESSION['validation_error'];
				echo '</div>';
				unset($_SESSION['validation_error']);
			}
			
		if(isset($_SESSION['errorArray']))
		{
			$allSummaryErrors = allSummaryErrors($_SESSION['errorArray']); 
			echo $allSummaryErrors;
		}
		
		// Display errors from IRS on approval failed
		if($data['fileDetails']['error_description'] != '')
		{
			$error_list = populateIrsErrors($data['fileDetails']['error_description']);
			echo $error_list;
		}
		?>
		<div class="marTop20px">
			<div class="summaryHeading botBdr"><?=$constantArr['bizinfolbl'][$_SESSION['lang']]?></div>
			<div class="marTop20px summaryHeaderBg pad10px">
				<strong><?=$MCrypt->decrypt($data['businessInfo']['name'])?></strong>
				<a href="/addbusiness/edit/<?=encryptId($data['businessInfo']['id'])?>" alt="" title="">
					<img src="/images/edit.png" align="right" alt="<?=$constantArr['edit'][$_SESSION['lang']]. " " .$constantArr['bizinfolbl'][$_SESSION['lang']]?>" title="<?=$constantArr['edit'][$_SESSION['lang']]. " " .$constantArr['bizinfolbl'][$_SESSION['lang']]?>" />
				</a>
			</div>
			<div class="border pad10px">
				<div class="width235px alignleft">
					<p><strong><?=$constantArr['personalInformation'][$_SESSION['lang']]?></strong></p>
					<p class="marTop10px"><?=$constantArr['biz_name'][$_SESSION['lang']]?>: <?=$MCrypt->decrypt($data['businessInfo']['name'])?></p>
					<p>EIN: <?php echo preg_replace("/^(\d{2})(\d{7})$/", "$1-$2", $MCrypt->decrypt($data['businessInfo']['ein']));?></p>
				</div>
				<div class="width235px alignleft">
					<p><strong><?=$constantArr['contactInformation'][$_SESSION['lang']]?></strong></p>
					<p class="marTop10px"><?=$MCrypt->decrypt($data['businessInfo']['address1'])?></p>
					<p><?=$MCrypt->decrypt($data['businessInfo']['city'])?></p>
					<p><?=$data['businessInfo']['state_name']?></p>
					<p><?=$data['businessInfo']['country_name']?> - <?=$MCrypt->decrypt($data['businessInfo']['zipcode'])?></p>
					<p>Phone: 
					<?php 
						$num = $MCrypt->decrypt($data['businessInfo']['phone']);
						echo $formatted = substr($num, 0, 3).'-'.substr($num, 3, 3).'-'.substr($num,6,4);
					?>
					</p>
				</div>
				<div class="width235px alignleft">
					<p><strong><?=$constantArr['signAuthorityInfo'][$_SESSION['lang']]?></strong></p>
					<p class="marTop10px"><?=$MCrypt->decrypt($data['businessInfo']['siging_authority_name'])?></p>
					<p><?=$MCrypt->decrypt($data['businessInfo']['siging_authority_title'])?></p>
					<p>Phone: 
					<?php 
						$num = $MCrypt->decrypt($data['businessInfo']['siging_authority_phone']);
						echo $formatted = substr($num, 0, 3).'-'.substr($num, 3, 3).'-'.substr($num,6,4);
					?>
					</p>
					<p>PIN: <?=$MCrypt->decrypt($data['businessInfo']['siging_authority_pin'])?></p>
				</div>
				<div class="width235px alignleft">
					<?php if($MCrypt->decrypt($data['businessInfo']['third_party_designee_name']) != '') {?>
					<p><strong><?=$constantArr['thirdPartyDesigneeInfo'][$_SESSION['lang']]?></strong></p>
					<p class="marTop10px"><?=$MCrypt->decrypt($data['businessInfo']['third_party_designee_name'])?></p>
					<p>Phone: 
					<?php 
						$num = $MCrypt->decrypt($data['businessInfo']['third_party_designee_phone']);
						echo $formatted = substr($num, 0, 3).'-'.substr($num, 3, 3).'-'.substr($num,6,4);
					?>
					</p>
					<p>PIN: <?=$MCrypt->decrypt($data['businessInfo']['third_party_designee_pin'])?></p>
					<?php } ?>
				</div>
				<br clear="all"/>
			</div>
			
			
			<div class="summaryHeading botBdr marTop20px"><?=$constantArr['TaxInformationlbl'][$_SESSION['lang']]?></div>
			<div class="marTop20px summaryHeaderBg pad10px">
				<strong><?=$constantArr['information'][$_SESSION['lang']]?></strong>
				<a href="/taxyear" alt="" title="">
					<img src="/images/edit.png" align="right" alt="<?=$constantArr['edit'][$_SESSION['lang']]. " " .$constantArr['TaxInformationlbl'][$_SESSION['lang']]?>" title="<?=$constantArr['edit'][$_SESSION['lang']]. " " .$constantArr['TaxInformationlbl'][$_SESSION['lang']]?>" />
				</a>
			</div>
			<div class="border pad10px">
				<p>
					<label class="small"><?=$constantArr['formtype'][$_SESSION['lang']]?>: </label> <?=$data['fileDetails']['desc']?>
				</p>
				<?php if($formType != '8849S6'){?>
				<p class="marTop10px">
					<label class="small"><?=$constantArr['TaxYearlbl'][$_SESSION['lang']]?>: </label> <?=$data['fileDetails']['display_year'];?>
				</p>
				<p class="marTop10px">
					<label class="small"><?=$constantArr['Monthlbl'][$_SESSION['lang']]?>: </label> 
					<?php echo ($MCrypt->decrypt($data['fileDetails']['filing_month']) < 7)?$data['fileDetails']['filing_year']+1:$data['fileDetails']['filing_year'];  echo " - ". date("F", mktime(0, 0, 0, $MCrypt->decrypt($data['fileDetails']['filing_month']), 10))?>
				</p>
				<?php } ?>
				<?php if($formType == '2290A1' || $formType == '2290A2'){?>
				<p class="marTop10px">
					<label class="small"><?=$constantArr['AmendmentMonthlbl'][$_SESSION['lang']]?>: </label> 
					<?php echo ($MCrypt->decrypt($data['fileDetails']['amended_month']) < 7)?$data['fileDetails']['filing_year']+1:$data['fileDetails']['filing_year'];  echo " - ". date("F", mktime(0, 0, 0, $MCrypt->decrypt($data['fileDetails']['amended_month']), 10))?>
				</p>
				<?php }?>
				<?php if($_SESSION['finalReturn'] == 1){?>
				<p class="marTop10px">
					<label class="small"><?=$constantArr['FinalReturnlbl'][$_SESSION['lang']]?>: </label> Yes
				</p>
				<?php }?>
				<?php if($formType == '8849S6'){?>
				<!-- 
				<p class="marTop10px">
					<label class="small"><?=$constantArr['earliestDatelbl'][$_SESSION['lang']]?>: </label> 
					<?php echo $MCrypt->decrypt($data['fileDetails']['earliest_date']);?>
				</p>
				<p class="marTop10px">
					<label class="small"><?=$constantArr['LarliestDatelbl'][$_SESSION['lang']]?>: </label> 
					<?php echo $MCrypt->decrypt($data['fileDetails']['latest_date']);?>
				</p>-->
				<p class="marTop10px">
					<label class="small"><?=$constantArr['taxYearEndMonthlbl'][$_SESSION['lang']]?>: </label> 
					<?php echo date("F", mktime(0, 0, 0, $MCrypt->decrypt($data['fileDetails']['tax_year_end_month']), 10));?>
				</p>
				<?php }?>
			</div>			
			
			<?php 
				if(isset($_SESSION['admin_form_type']) && $_SESSION['admin_form_type'] != ''){
					$formType = $_SESSION['admin_form_type'];					
				}
				// Link to proper vehicle edit with respect to their form type
				if($formType == '2290'):
				$link = "/lowmileagecredit";
				endif;
				
				if($formType == '8849S6'):
				$link = "/overpayment";
				endif;
				
				if($formType == '2290A1'):
				$link = "/tgwincreased";
				endif;
				
				if($formType == '2290A2'):
				$link = "/exceededmileage";
				endif;
				
				if($formType == '2290V'):
				$link = "/vincorrectionlist";
				endif;
			?>
			
			<div class="summaryHeading botBdr marTop20px">
				<?=$constantArr['vehiclessummary'][$_SESSION['lang']]?>
				<?php 
				// Edit icon displayed when no vehicle is added
				if(	count($data['reportedVehicleInfo']) == 0 && 
					count($data['suspendedVehicleInfo']) == 0 && 
					count($data['priorsuspendedVehicleInfo']) == 0 && 
					count($data['lossVehicleInfo']) == 0 && 
					count($data['lowMilieageClaimInfo']) == 0 && 
					count($data['overPaymentCredit']) == 0 && 
					count($data['tgwIncreasedVehicles']) == 0 && 
					count($data['exceededMileage']) == 0){?>
				<!--
				<a href="<?=$link?>" alt="" title="">
					<img src="/images/edit.png" align="right" alt="<?=$constantArr['edit'][$_SESSION['lang']]. " " .$constantArr['vehiclestax'][$_SESSION['lang']]?>" title="<?=$constantArr['edit'][$_SESSION['lang']]. " " .$constantArr['vehiclestax'][$_SESSION['lang']]?>" />
				</a>-->
				<?php } ?>
			</div>
			<?php 
			$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
			$this->taxablevehicleinfoDAO = $taxablevehicleinfoDAO;
			?>
			<div class="marTop20px tableList" id="summaryScroll">
				<?php if($formType == "2290"){ ?>
			
					<!-- Table vehicle informations -->
					<?php //if($data['reportedVehicleInfo']){ ?>	
						<table cellpadding="0" cellspacing="0" border="0" width="100%" class="topBdr leftBdr">
							<tr align="left">
								<th width="90%" class="noRightborder"><?=$constantArr['taxvehiinfolbl'][$_SESSION['lang']]?></th>
								<th width="10%" align="right">
									<a href="/taxablevehicleinfo" alt="" title="">
										<img src="/images/edit.png" align="right" alt="<?=$constantArr['edit'][$_SESSION['lang']]. " " .$constantArr['taxvehiinfolbl'][$_SESSION['lang']]?>" title="<?=$constantArr['edit'][$_SESSION['lang']]. " " .$constantArr['taxvehiinfolbl'][$_SESSION['lang']]?>" />
									</a>
								</th>
							</tr>
							<?php 
								$total = 0;
								$vehicle_count = 0;
								foreach($data['reportedVehicleInfo'] as $key => $value){
									$total += $MCrypt->decrypt($value['tax_amount']);
									$vehicle_count++; 
								} 
								$total_tax += $total;
							?>
							<tr>
								<td align="right"><?=$constantArr['vehiclecount'][$_SESSION['lang']]?></td>
								<td align="right"><strong class="orngTxt"><?=$vehicle_count?></strong></td>
							</tr>
							<tr>
								<td align="right"><?=$constantArr['total'][$_SESSION['lang']]. " " .$constantArr['taxamount'][$_SESSION['lang']]?> ($)</td>
								<td align="right"><strong class="blueTxt"><?=number_format($total, 2)?></strong></td>
							</tr>
						</table>
					<?php //} ?>
			
			
					<!-- Current year Suspended Vehicles  -->
					<?php //if($data['suspendedVehicleInfo']){ ?>	
						<table cellpadding="0" cellspacing="0" border="0" width="100%" class="topBdr leftBdr marTop20px">
							<tr align="left">
								<th width="90%" class="noRightborder"><?=$constantArr['curentsuspendyearbl'][$_SESSION['lang']]?></th>
								<th width="10%" align="right">
									<a href="/currentyrsuspend" alt="" title="">
										<img src="/images/edit.png" align="right" alt="<?=$constantArr['edit'][$_SESSION['lang']]. " " .$constantArr['curentsuspendyearbl'][$_SESSION['lang']]?>" title="<?=$constantArr['edit'][$_SESSION['lang']]. " " .$constantArr['curentsuspendyearbl'][$_SESSION['lang']]?>" />
									</a>
								</th>
							</tr>						
							<?php 
								$vehicle_count = 0;
								foreach($data['suspendedVehicleInfo'] as $key => $value){ 
									$vehicle_count++; 
								} 
							?>
							<tr>
								<td align="right"><?=$constantArr['vehiclecount'][$_SESSION['lang']]?></td>
								<td align="right"><strong class="orngTxt"><?=$vehicle_count?></strong></td>
							</tr>
						</table>
					<?php //} ?>
				
				
					<!--Prior year Suspended Vehicles  -->
					<?php //if($data['priorsuspendedVehicleInfo']){ ?>	
						<table cellpadding="0" cellspacing="0" border="0" width="100%" class="topBdr leftBdr marTop20px">
							<tr align="left">
								<th width="90%" class="noRightborder"><?=$constantArr['pryrsusvehiinfolbl'][$_SESSION['lang']]?></th>
								<th width="10%" align="right">
									<a href="/prioryrsuspend" alt="" title="">
										<img src="/images/edit.png" align="right" alt="<?=$constantArr['edit'][$_SESSION['lang']] . " " . $constantArr['pryrsusvehiinfolbl'][$_SESSION['lang']]?>" title="<?=$constantArr['edit'][$_SESSION['lang']] . " " . $constantArr['pryrsusvehiinfolbl'][$_SESSION['lang']]?>" />
									</a>
								</th>
							</tr>						
							<?php 
								$vehicle_count = 0;
								foreach($data['priorsuspendedVehicleInfo'] as $key => $value){ 
									$vehicle_count++; 
								} 
							?>
							<tr>
								<td align="right"><?=$constantArr['vehiclecount'][$_SESSION['lang']]?></td>
								<td align="right"><strong class="orngTxt"><?=$vehicle_count?></strong></td>
							</tr>
						</table>
					<?php } ?>
				<?php //} ?>
				
				
				<?php if($formType == "2290" || $formType == "8849S6"){?>
				
					<!-- Reported Credits - Sold/Destroyed/Stolen -->
					<?php //if($data['lossVehicleInfo']){ ?>
						<table cellpadding="0" cellspacing="0" border="0" width="100%" class="topBdr leftBdr marTop20px">
							<tr align="left">
								<th width="90%" class="noRightborder"><?=$constantArr['solddestroy'][$_SESSION['lang']]?></th>
								<th width="10%" align="right">
									<a href="/solddestroycredit" alt="" title="">
										<img src="/images/edit.png" align="right" alt="<?=$constantArr['edit'][$_SESSION['lang']]. " " .$constantArr['solddestroy'][$_SESSION['lang']]?>" title="<?=$constantArr['edit'][$_SESSION['lang']]. " " .$constantArr['solddestroy'][$_SESSION['lang']]?>" />
									</a>
								</th>
							</tr>
							<?php 
								$vehicle_count = 0;
								$total = 0;
								foreach($data['lossVehicleInfo'] as $key => $value){
									$total += $MCrypt->decrypt($value['credit_amount']);
									$vehicle_count++; 
								} 
								$total_credit += $total;
							?>
							<tr>
								<td align="right"><?=$constantArr['vehiclecount'][$_SESSION['lang']]?></td>
								<td align="right"><strong class="orngTxt"><?=$vehicle_count?></strong></td>
							</tr>
							<tr>
								<td align="right"><?=$constantArr['total'][$_SESSION['lang']]. " " .$constantArr['creditamountlbl'][$_SESSION['lang']]?> ($)</td>
								<td align="right"><strong class="blueTxt"><?=number_format($total, 2)?></strong></td>
							</tr>
						</table>
					<?php //} ?>

					<!-- Reported Credits - Low Mileage Claim -->
					<?php ///if($data['lowMilieageClaimInfo']){ ?>
						<table cellpadding="0" cellspacing="0" border="0" width="100%" class="topBdr leftBdr marTop20px">
							<tr align="left">
								<th width="90%" class="noRightborder"><?=$constantArr['lowmileagecreditlbl'][$_SESSION['lang']]?></th>
								<th width="10%" align="right">
									<a href="/lowmileagecredit" alt="" title="">
										<img src="/images/edit.png" align="right" alt="<?=$constantArr['edit'][$_SESSION['lang']]. " " .$constantArr['lowmileagecreditlbl'][$_SESSION['lang']]?>" title="<?=$constantArr['edit'][$_SESSION['lang']]. " " .$constantArr['lowmileagecreditlbl'][$_SESSION['lang']]?>" />
									</a>
								</th>
							</tr>
							<?php 
								$vehicle_count = 0;
								$total = 0;
								foreach($data['lowMilieageClaimInfo'] as $key => $value){
									$total += $MCrypt->decrypt($value['credit_amount']);
									$vehicle_count++;
								} 
								$total_credit += $total;
							?>
							<tr>
								<td align="right"><?=$constantArr['vehiclecount'][$_SESSION['lang']]?></td>
								<td align="right"><strong class="orngTxt"><?=$vehicle_count?></strong></td>
							</tr>
							<tr>
								<td align="right"><?=$constantArr['total'][$_SESSION['lang']]. " " .$constantArr['creditamountlbl'][$_SESSION['lang']]?> ($)</td>
								<td align="right"><strong class="blueTxt"><?=number_format($total, 2)?></strong></td>
							</tr>
						</table>
					<?php } ?>
				<?php //} ?>


				<?php if($formType == "8849S6"){?>
					<!-- Over Payment Credits -->
					<?php //if($data['overPaymentCredit']){ ?>
						<table cellpadding="0" cellspacing="0" border="0" width="100%" class="topBdr leftBdr marTop20px">
							<tr align="left">
								<th width="90%" class="noRightborder"><?=$constantArr['overpaymentlbl'][$_SESSION['lang']]?></th>
								<th width="10%" align="right">
									<a href="/overpayment" alt="" title="">
										<img src="/images/edit.png" align="right" alt="<?=$constantArr['edit'][$_SESSION['lang']] . " " . $constantArr['overpaymentlbl'][$_SESSION['lang']]?>" title="<?=$constantArr['edit'][$_SESSION['lang']] . " " . $constantArr['overpaymentlbl'][$_SESSION['lang']]?>" />
									</a>
								</th>
							</tr>
							<?php 
								$vehicle_count = 0;
								$total = 0;
								foreach($data['overPaymentCredit'] as $key => $value)
								{
									$total += $MCrypt->decrypt($value['amount_of_claim']);
									$vehicle_count++;
								} 
								$total_credit += $total;
							?>
							<tr>
								<td align="right"><?=$constantArr['vehiclecount'][$_SESSION['lang']]?></td>
								<td align="right"><strong class="orngTxt"><?=$vehicle_count?></strong></td>
							</tr>
							<tr>
								<td align="right"><?=$constantArr['total'][$_SESSION['lang']]. " " .$constantArr['creditamountlbl'][$_SESSION['lang']]?> ($)</td>
								<td align="right"><strong class="blueTxt"><?=number_format($total, 2)?></strong></td>
							</tr>
						</table>
					<?php //} ?>
				
				<?php } ?>
				
				<?php if($formType == "2290A1"){?>
					<!-- Amended Vehicle - Gross Weight Increased -->
					<?php //if($data['tgwIncreasedVehicles']){?>	
						<table cellpadding="0" cellspacing="0" border="0" width="100%" class="topBdr leftBdr">
							<tr align="left">
								<th width="90%" class="noRightborder">Gross Weight Increased</th>
								<th width="10%" align="right">
									<a href="/tgwincreased" alt="" title="">
										<img src="/images/edit.png" align="right" alt="Gross Weight Increased" title="Gross Weight Increased" />
									</a>
								</th>
							</tr>
							<?php 
								$total = 0;
								$vehicle_count = 0;
								foreach($data['tgwIncreasedVehicles'] as $key => $value)
								{
									$total += $MCrypt->decrypt($value['difference_tax_amount']);
									$vehicle_count++;
								} 
								$total_tax = $total;
							?>
							<tr>
								<td align="right"><?=$constantArr['vehiclecount'][$_SESSION['lang']]?></td>
								<td align="right"><strong class="orngTxt"><?=$vehicle_count?></strong></td>
							</tr>
							<tr>
								<td align="right"><?=$constantArr['total'][$_SESSION['lang']]. " " .$constantArr['taxamount'][$_SESSION['lang']]?> ($)</td>
								<td align="right"><strong class="blueTxt"><?=number_format($total, 2)?></strong></td>
							</tr>
						</table>
					<?php //} ?>					
				<?php } ?>
				
				<?php if($formType == "2290A2"){?>
					<!-- Amended Vehicle - Exceeded Mileage -->
					<?php //if($data['exceededMileage']){ ?>	
						<table cellpadding="0" cellspacing="0" border="0" width="100%" class="topBdr leftBdr">
							<tr align="left">
								<th width="90%" class="noRightborder">Mileage Exceeded Vehicles</th>
								<th width="10%" align="right">
									<a href="/exceededmileage" alt="" title="">
										<img src="/images/edit.png" align="right" alt="Mileage Exceeded Vehicles" title="Mileage Exceeded Vehicles" />
									</a>
								</th>
							</tr>
							<?php 
								$total = 0;
								$vehicle_count = 0;
								foreach($data['exceededMileage'] as $key => $value)
								{
									$total += $MCrypt->decrypt($value['tax_amount']);
									$vehicle_count++;
								} 
								$total_tax = $total;
							?>
							<tr>
								<td align="right"><?=$constantArr['vehiclecount'][$_SESSION['lang']]?></td>
								<td align="right"><strong class="orngTxt"><?=$vehicle_count?></strong></td>
							</tr>
							<tr>
								<td align="right"><?=$constantArr['total'][$_SESSION['lang']]. " " .$constantArr['taxamount'][$_SESSION['lang']]?> ($)</td>
								<td align="right"><strong class="blueTxt"><?=number_format($total, 2)?></strong></td>
							</tr>
						</table>
					<?php //} ?>					
				<?php } 
				
				if($formType == "2290V"){?>
					<!-- VIN Correction-->
						<table cellpadding="0" cellspacing="0" border="0" width="100%" class="topBdr leftBdr">
							<tr align="left">
								<th width="90%" class="noRightborder"><?=$constantArr['vincorrection'][$_SESSION['lang']]?></th>
								<th width="10%" align="right">
									<a href="/vincorrectionlist" alt="VIN Correction List" title="VIN Correction List">
										<img src="/images/edit.png" align="right" alt="Mileage Exceeded Vehicles" title="Mileage Exceeded Vehicles" />
									</a>
								</th>
							</tr>
							<?php 
								$total = 0;
								$vehicle_count = 0;
								$vehicle_count = count($data['vinCorrectionlist']);
								$total_tax = $total;
							?>
							<tr>
								<td align="right"><?=$constantArr['vehiclecount'][$_SESSION['lang']]?></td>
								<td align="right"><strong class="orngTxt"><?=$vehicle_count?></strong></td>
							</tr>
							<tr>
								<td align="right"><?=$constantArr['total'][$_SESSION['lang']]. " " .$constantArr['taxamount'][$_SESSION['lang']]?> ($)</td>
								<td align="right"><strong class="blueTxt"><?=number_format($total, 2)?></strong></td>
							</tr>
						</table>
				<?php } ?>
			</div>
			
			
			<?php if($formType != "8849S6" && $formType != "2290V"){ ?>

				<div class="summaryHeading botBdr marTop20px">
					<?=$constantArr['paymenttype'][$_SESSION['lang']]?>
					<a href="/paymentoption" alt="" title="">
						<img src="/images/edit.png" align="right" alt="<?=$constantArr['edit'][$_SESSION['lang']] . " " . $constantArr['paymenttype'][$_SESSION['lang']]?>" title="<?=$constantArr['edit'][$_SESSION['lang']] . " " . $constantArr['paymenttype'][$_SESSION['lang']]?>" />
					</a>
				</div>
				<div class="marTop20px summaryHeaderBg pad10px">
					<strong><?=$MCrypt->decrypt($data['paymentDetails']['payment_mode'])?></strong>
				</div>
				
				<?php if($MCrypt->decrypt($data['paymentDetails']['payment_mode']) == "Direct Debit"){ ?>
				<div class="border pad10px">
					<p>
						<label class="small"><?=$constantArr['bankName'][$_SESSION['lang']]?>: </label> <?=$MCrypt->decrypt($data['paymentDetails']['bank_name'])?>
					</p>
					<p class="marTop10px">
						<label class="small"><?=$constantArr['AccountType'][$_SESSION['lang']]?>: </label> <?=$MCrypt->decrypt($data['paymentDetails']['acct_type'])?>
					</p>
					<p class="marTop10px">
						<label class="small"><?=$constantArr['BankAccountNumber'][$_SESSION['lang']]?>: </label> <?=$MCrypt->decrypt($data['paymentDetails']['acct_number'])?>
					</p>
					<p class="marTop10px">
						<label class="small"><?=$constantArr['RoutingTransitNumber'][$_SESSION['lang']]?>: </label> <?=$MCrypt->decrypt($data['paymentDetails']['routing_transit_no'])?>
					</p>
				</div>
				<?php } ?>
	
				<div class="summaryHeading botBdr marTop20px"><?=$constantArr['consentlbl'][$_SESSION['lang']]?><span style="color:#0091E4"> (Optional)</span></div>
				<div class="marTop20px summaryHeaderBg pad10px">
					 <input type="checkbox" name="concentDiscloser" id="concentDiscloser" onclick="updateConsentDiscloser()" <?php if($MCrypt->decrypt($data['fileDetails']['consent_disclosure']) == "1"){ echo "checked"; } ?>/>
					 <?=$constantArr['consentdisclose'][$_SESSION['lang']]?>
					 <a href="/include/consentDiscloser.php" alt="Consent Discloser" title="Consent Discloser" class="blueTxt fancybox fancybox.ajax"><?=$constantArr['view'][$_SESSION['lang']]?> <?=$constantArr['consentdiscloseragreement'][$_SESSION['lang']]?></a>
				</div>
			<?php }

			if($formType != '2290V'){
			?>
			
			<div class="summaryHeading botBdr marTop20px"><?=$constantArr['taxcomputation'][$_SESSION['lang']]?></div>
			<div class="marTop20px summaryHeaderBg pad10px">
				<strong><?=$constantArr['taxsummary'][$_SESSION['lang']]?></strong>
			</div>
			<div class="border pad10px">
				<div class="alignright">
					<?php 
						// Total tax amount payable to IRS
						$total_due = (isset($total_tax) ? $total_tax : 0) - (isset($total_credit) ? $total_credit : 0);
						
						if($total_due < 0)
						{
							$total_due = 0.00;
						}
					
					/* This code need to be moved to Biz */
					
						if($total_due <= 0){
							removeIRSPayment($_SESSION['filingId']);
						}
					
					/* This code need to be moved to Biz */
					
					if(isset($total_tax) && $total_tax > 0):?>
					<p>
						<div class="width200px alignleft"><strong><?=$constantArr['total'][$_SESSION['lang']]. " " .$constantArr['taxamount'][$_SESSION['lang']]?>:</strong> </div> <div class="alignright">$<?=number_format($total_tax, 2)?></div>
						<br clear="all"/>
					</p>
					<?php endif; ?>
					<?php if(isset($total_credit) &&  $total_credit > 0):?>
					<p class="marTop10px">
						<div class="width200px alignleft"><strong><?=$constantArr['total'][$_SESSION['lang']]. " " .$constantArr['creditamountlbl'][$_SESSION['lang']]?>:</strong> </div> <div class="alignright">$<?=number_format($total_credit, 2)?></div>
						<br clear="all"/>
					</p>
					<?php endif; ?>
					<p class="marTop10px topBdr padTop10px">
						<div class="width200px alignleft"><strong><?=$constantArr['taxdue'][$_SESSION['lang']]?>:</strong> </div> <div class="alignright"><span class="orngTxt"><strong>$<?=number_format($total_due, 2)?></strong></span></div>
						<br clear="all"/>
					</p>
				</div>
				<br clear="all" />
			</div>
			<?php 
			}
				if(isset($_SESSION['validation_error'])){
					echo '<div class="marTop10px errorMsg"><span class="errorIcon"></span> '; 
					echo $_SESSION['validation_error'];
					echo '</div>';
				}
			?>
			<div class="alignright marTop20px">
				<?php if($formType!= '8849S6' && $formType != "2290V"){	?>
				<input type="button" onclick="window.location='/paymentoption/';" title="Payment Mode" alt="Payment Mode" value="<?=$constantArr['goback'][$_SESSION['lang']]?>" class="blueButn60px">
				<?php } else {?>
				<input type="button" onclick="window.location='<?php echo $link;?>/';" title="Vehicles Tax" alt="Vehicles Tax" value="<?=$constantArr['goback'][$_SESSION['lang']]?>" class="blueButn60px">
				<?php }?>
				<?php if($data['vehicleCount'] > 0 || ( $_SESSION['finalReturn'] == 1 && $data['vehicleCount'] == 0)){ ?><input type="button" onclick="window.location='/productpayment/';" title="Submission Fee" alt="Submission Fee" value="<?=$constantArr['continuebtn'][$_SESSION['lang']]?>" class="blueButn100px marLeft10px"><?php } ?>
			</div>
			<br clear="all" />
		</div>
	</div>
</div>
</div>
<!---------maincontainer section ends here------------>	
		
<?php include_once 'footer.php';?>
<!-- To be removed --- only for testing  -->
<input name="filingId" type="hidden" value="<?php echo $_SESSION['filingId'];?>" />
<input type="hidden" name="xmlError" value="<?php echo $_SESSION['xmlValidationError'];?>" /> 
<?php unset($_SESSION['xmlValidationError']);?>