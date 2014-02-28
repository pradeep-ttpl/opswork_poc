<?php 
include_once 'header.php';
// Intializing MCrypt class
$MCrypt	= new MCrypt;
$submittedFilingList = $data['submittedFilingList'];
?>
<div class="border marTop-1px pad30px">
	<!--Instruction area-->
	<div class="botBdr padBottom10px pageTipContentAreaBg">	
		<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="<?=$constantArr['information'][$_SESSION['lang']]?>" title="<?=$constantArr['information'][$_SESSION['lang']]?>" class="alignleft" /></div>
		<div class="alignleft width930px padLeft10px pageTipContentArea">
			<?=$constantArr['vincorrectionlist'][$_SESSION['lang']]?>
		</div>
		<br clear="all"/>
	</div>
	<!--Selected Business Name-->
	<!--Tax Filing wizard starts here--->
	<div class="marTop25px">
		<form action="/vincorrection" name="vincorrectionlistform" id="vincorrectionlistform" method="post">
		<!--Message area-->
		<div class="border pad20px">
			<p class="marTop0px">
					<input type="radio" id="new" name="selectedFilingId" value="<?php echo $MCrypt->encrypt('new');?>" checked/>
					<label class="small"><?php echo $constantArr['createNewVinCorrection'][$_SESSION['lang']]; ?></label>
			</p>
			<?php foreach ($submittedFilingList as $key => $value){
					echo '<p  class="marTop10px">
							<input type="radio" id='.$MCrypt->encrypt($value['id']).' value='.$MCrypt->encrypt($value['id']).' name="selectedFilingId"> '.$value['submission_id'].' - '.$MCrypt->decrypt($value['filing_month']).' - '.$value['filing_year'].'</p> ';
			}?>
		</div>
		<br clear="all" />
		<div class="alignright marTop20px">
			<input onclick="javascript:window.location='/taxyear/';" type="button" class="blueButn60px" value="<?php echo $constantArr['goback'][$_SESSION['lang']]; ?>" alt="<?php echo $constantArr['tax_year_forms'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['tax_year_forms'][$_SESSION['lang']]; ?>" />
			<input type="submit" class="blueButn100px marLeft10px" value="<?php echo $constantArr['continuebtn'][$_SESSION['lang']]; ?>" alt="<?php echo $constantArr['continuebtn'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['continuebtn'][$_SESSION['lang']]; ?>" />
		</div>
		</form>
		<br clear="all" />
		
	</div>
</div>
</div>
</div>
<!---------maincontainer section ends here------------>	
<?php include_once 'footer.php';?>