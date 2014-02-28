<?php 
include_once 'header.php';
$filingfee = $data['filingcharge']['diff'];

// Intializing MCrypt class
$MCrypt	= new MCrypt
?>
		<div class="border marTop-1px pad30px">
			<!--Instruction area-->
			<div class="botBdr padBottom10px pageTipContentAreaBg">	
				<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="Information" title="Information" class="alignleft" /></div>
				<div class="alignleft padLeft10px pageTipContentArea">
					<?=$constantArr['submissionFee_description'][$_SESSION['lang']]?>
				</div>
				<br clear="all"/>
			</div>
			<?php include_once 'filingsteps.php';?>
			
			<?php if(isset($data['trans_error'])){?><div class="marTop10px errorMsg"> Transaction Declained - <?php echo $data['trans_error']; ?> </div><?php }?>
			
			<div class="marTop25px tableList">
				<table cellpadding="0" cellspacing="0" border="0" width="100%" class="topBdr leftBdr">
					<tr class="evenrow">
						<td colspan="4"><div class="width235px alignleft"><strong><?=$constantArr['submission_fee_details'][$_SESSION['lang']]?></strong></div></td>									
					</tr>
					<tr>
						<td>
							<p><?=$constantArr['filing_fee'][$_SESSION['lang']]?><?=$data['filinginfo']['desc']?></p>
							<p><?=$constantArr['biz_name'][$_SESSION['lang']]?>: <?=$MCrypt->decrypt($data['bizinfo']['name'])?></p>
							<p><?=$constantArr['biz_EIN'][$_SESSION['lang']]?>: <?php echo preg_replace("/^(\d{2})(\d{7})$/", "$1-$2", $MCrypt->decrypt($data['bizinfo']['ein']));?></p>
							<!--<p><?=$constantArr['Monthlbl'][$_SESSION['lang']]?>: <?php echo ($MCrypt->decrypt($data['filinginfo']['filing_month']) < 7)?$data['filinginfo']['filing_year']+1:$data['filinginfo']['filing_year'];  echo " - ". date("F", mktime(0, 0, 0, $MCrypt->decrypt($data['filinginfo']['filing_month']), 10))?></p>-->
							<p><?=$constantArr['vehiclecount'][$_SESSION['lang']]?>: <?=$data['filingcharge']['vehicle_count']?></p>
							<?php if($data['filingcharge']['paid'] > 0): ?>
							<p><?=$constantArr['amntpaid'][$_SESSION['lang']]?>: <?='$'.$data['filingcharge']['paid']?></p>
							<?php endif; ?>
						</td>
						<td align="right" valign="top"><?php echo '$'.number_format($filingfee,2);?></td>
					</tr>
					<tr class="evenrow">
						<td><strong><?=$constantArr['total'][$_SESSION['lang']].' '.$constantArr['amount'][$_SESSION['lang']]?></strong> :</td>
						<td align="right"><strong><?php echo '$'.number_format($filingfee,2);?></strong></td>
					</tr>
				</table>
			</div>
			<br clear="all" />
			<?php $trans_desc = $constantArr['filing_fee'][$_SESSION['lang']].$data['filinginfo']['desc']; ?>
			<!--Form navigation-->
			<form id="paymentForm" method="post" action="<?=TT_AUTHORIZE_URL?>">
				<div class="alignright marTop10px">
					<input onclick="javascript:window.location='/summary/';" type="button" class="alignleft blueButn60px" value="<?=$constantArr['goback'][$_SESSION['lang']]?>" alt="<?=$constantArr['form_summary'][$_SESSION['lang']]?>" title="<?=$constantArr['form_summary'][$_SESSION['lang']]?>" />
						<?php
						
						$total_payment = number_format($filingfee,2);
						$_SESSION['total_amount'] = $total_payment;
						
						// To generate finger print
						$invoice_no	= $data['invoice_no'];
						$sequence	= $data['sequence'];
						$timeStamp	= $data['timeStamp'];
						
						if( phpversion() >= '5.1.2' )
						{ 
							$fingerprint = hash_hmac("md5", TT_AUTHORIZE_ID . "^" . $sequence . "^" . $timeStamp . "^" . $total_payment . "^", TT_AUTHORIZE_TRANSACTION_KEY); 
						}
						else 
						{ 
							$fingerprint = bin2hex(mhash(MHASH_MD5, TT_AUTHORIZE_ID . "^" . $sequence . "^" . $timeStamp . "^" . $total_payment . "^", TT_AUTHORIZE_TRANSACTION_KEY)); 
						}
						?>
						
						<input type='hidden' name='x_login' value='<?=TT_AUTHORIZE_ID?>' />
						<input type='hidden' id='x_amount' name='x_amount' value='<?=$total_payment?>'/>
						<input type='hidden' name='x_description' value='<?=$trans_desc?>' />
						<input type='hidden' id="x_invoice_num" name='x_invoice_num' value='<?=$data['invoice_no']?>' />
						<input type='hidden' id='x_fp_sequence' name='x_fp_sequence' value='<?=$data['sequence']?>' />
						<input type='hidden' id='x_fp_timestamp' name='x_fp_timestamp' value='<?=$data['timeStamp']?>' />
						<input type='hidden' id='x_fp_hash' name='x_fp_hash' value='<?=$fingerprint?>' />
						<input type='hidden' name='x_test_request' value='<?=TT_AUTHORIZE_TEST_MODE?>' />
						<input type='hidden' name='x_show_form' value='PAYMENT_FORM' />
						<input type='hidden' name="x_relay_response" value="TRUE" />
						<input type='hidden' name="x_relay_url" value='<?=TT_AUTHORIZE_RETURN_URL?>' />
						
						<input type='hidden' name="x_first_name" value='<?=$MCrypt->decrypt($data['userinfo']['first_name'])?>' />
						<input type='hidden' name="x_last_name" value='<?=$MCrypt->decrypt($data['userinfo']['last_name'])?>' />
						<input type='hidden' name="x_email" value='<?=$MCrypt->decrypt($data['userinfo']['email'])?>' />
						<input type='hidden' name="x_company" value='<?=$MCrypt->decrypt($data['bizinfo']['name'])?>' />
						<input type='hidden' name="x_address" value='<?=$MCrypt->decrypt($data['bizinfo']['address1'])?>' />
						<input type='hidden' name="x_city" value='<?=$MCrypt->decrypt($data['bizinfo']['city'])?>' />
						<input type='hidden' name="x_state" value='<?=$data['bizinfo']['state_name']?>' />
						<input type='hidden' name="x_zip" value='<?=$MCrypt->decrypt($data['bizinfo']['zipcode'])?>' />
						<input type='hidden' name="x_country" value='<?=$data['bizinfo']['country_name']?>' />
						<input type='hidden' name="x_phone" value='<?=$MCrypt->decrypt($data['bizinfo']['phone'])?>' />
						
<!--					<div id="loaderDiv" style="display:none" class="alignleft marLeft10px"><img src="/images/loading_icon.gif" alt="Please Wait ..." title="Please Wait ..." /></div>-->
						<input id="payButton" onclick="initiatePayment()" type="button" class="blueButn100px marLeft10px" value="<?php echo (isset($data['trans_error']))?$constantArr['retry'][$_SESSION['lang']]:$constantArr['pay'][$_SESSION['lang']];?>" alt="<?=$constantArr['pay'][$_SESSION['lang']]?>" title="<?=$constantArr['pay'][$_SESSION['lang']]?>" />
				</div>
				<br clear="all" />
			</form>
			
			<a id="payAnchorId" href="#loaderContent" class="fancybox"></a>
			<div id="loaderContent" class="width375px" style="display:none;" align="center">
				<div class="pad25px" align="center">
					<img src="/images/loading.gif" alt="Please wait" title="Please wait" width="100px" /><br/>
					Please Wait...
				</div>
			</div>
			
		</div>
	</div>
</div>
<?php include_once 'footer.php';?>
