<?php 
include_once 'header.php';
global $constantArr;
?>
<!---------maincontainer section starts here------------>
	<div class="border marTop-1px pad30px">
		<?php include_once 'filingsteps.php';?>
		<div class="marTop25px">
			<form action="/irssubmission" method="post" onsubmit="return validateuserconsent();">
				<?php if(isset($data['transacdetails']['x_response_code'])){ ?>
				<div class="summaryHeading botBdr marTop20px"><?=$constantArr['submissionfee'][$_SESSION['lang']].' '.$constantArr['receipt'][$_SESSION['lang']];?></div>			
				<div class="marTop20px summaryHeaderBg pad10px">
					<strong><?=$constantArr['thankyou_returns'][$_SESSION['lang']];?></strong>
				</div>
				<div class="border pad10px">
					<p>
						<label class="xsmall"><?=$constantArr['merchant'][$_SESSION['lang']];?>:</label> Triesten Technologies LLC
					</p>
					<p class="marTop10px">
						<label class="xsmall"><?=$constantArr['description'][$_SESSION['lang']];?>:</label> Tax Submission Fee
					</p>
					<p class="marTop10px">
						<label class="xsmall"><?=$constantArr['date_time'][$_SESSION['lang']];?>:</label> <?php echo date('g:ia jS F Y'); ?>
					</p>
					<p class="marTop10px">
						<label class="xsmall"><?=$constantArr['transaction_id'][$_SESSION['lang']];?>:</label> <?=$data['transacdetails']['x_trans_id'];?>
					</p>
					<p class="marTop10px">
						<label class="xsmall"><?=$constantArr['amount'][$_SESSION['lang']];?></label> $<?=$data['transacdetails']['x_amount'];?>
					</p>
					<p class="marTop10px">
						<label class="xsmall"><?=$constantArr['status'][$_SESSION['lang']];?>:</label><span class="<?php echo ($data['transacdetails']['x_response_code'] == 1)?'greenTxt':'redTxt';?>"><strong><?php echo $data['status'];?></strong></span>
					</p>
				</div>
				<?php } ?>
				
				<!--<div class="summaryHeading botBdr marTop20px"><?=$constantArr['download'][$_SESSION['lang']]?></div>
				<div class="marTop20px summaryHeaderBg pad10px">
					<a href="/pdf_generation/xsltohtml.php" alt="" title="" class="marLeft10px blueTxt">
						<img src="/images/pdf.png" alt="Download PDF" title="Download PDF" /> <?=$constantArr['download_pdf'][$_SESSION['lang']]?>
					</a>
				</div>
				-->
				<?php if($data['status'] == "Payment success" || $data['last_trans']['payment_status'] == "success" || $data['form_type'] == "2290V" || ($_SESSION['finalReturn'] == 1 && $data['amount_paid'] == 0)){ ?>
				<div class="summaryHeading botBdr marTop20px"><?=$constantArr['consentuser'][$_SESSION['lang']]?></div>
				<div class="marTop20px summaryHeaderBg pad10px">
					<label class="checkBoxTextAlingnment">
						<input id="concentDiscloser" type="checkbox" name="concentDiscloser" onclick="javascript:document.getElementById('errMsg').innerHTML='';"/>
						<?=$constantArr['consentuserdesc'][$_SESSION['lang']]?>
					</label>
				</div>
				<div class="alignright">
					<div class="redTxt marTop10px marTop25px alignleft" id="errMsg"></div>
					<div class="alignright marTop20px">
						<input type="submit" class="blueButn140px marLeft10px" value="<?=$constantArr['proceedtosubmit'][$_SESSION['lang']]?>" alt="<?=$constantArr['irssubmission'][$_SESSION['lang']]?>" title="<?=$constantArr['irssubmission'][$_SESSION['lang']]?>" />
					</div>
				</div>
				<?php } ?>
			</form>
			
			<a id="successAnchorId" href="#loaderContent" class="fancybox"></a>
			<div id="loaderContent" class="width375px" style="display:none;" align="center">
				<div class="pad25px" align="center">
					<img src="/images/loading.gif" alt="Please wait" title="Please wait" width="100px" /><br/>
					Please Wait...
				</div>
			</div>
			<br clear="all" />
		</div>
	</div>
</div>
</div>
<!---------maincontainer section ends here------------>	
<?php include_once 'footer.php';?>
