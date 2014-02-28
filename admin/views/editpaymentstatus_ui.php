<?php
if(isset($_REQUEST['filingId']))
$filingId = $_REQUEST['filingId'];
$userId   = $_REQUEST['userId'];
?>
<div class="width635px">
	<div class="topgrayBG padTop10px padLeft15px">
		<div class="alignleft marTop3px"><h2>Edit Payment Status</h2></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="Close Popup" title="Close Popup" onclick="parent.$.fancybox.close();" />
		</div>
		<br clear="all"/>
	</div>
	<div class="pad20px">
		<form action="" method="post" enctype="multipart/form-data" name="" id="">
			<p class="marTop0px">
				<label class="small">Payment Status:</label>
				<select class="txtBox150px" name="paymentstatus" id="paymentstatus">
					<option value='0'>Select</option>
					<option value='initiated'>Initiated</option>
					<option value='success'>Success</option>
					<option value='failed'>Failed</option>
				</select>
			</p>
			<p>
				<label class="small">Transaction ID:</label>
				<input type="text" class="txtBox260px" id='transactionId' name='transactionId' />
			</p>
			<p>
				<label class="small">&nbsp;</label>
				<span class="redTxt" id="error_msg"></span>
				<input type="submit" class="blueButn60px" value="Save" id='submitPaymentStatus' name='submitPaymentStatus' onClick="return checkPaymentStatus()" />
				<input type="button" class="blueButn60px marLeft10px" value="Close" onclick="parent.$.fancybox.close();" />
			</p>
			
			<input type='hidden' id='filingId' name='filingId' value='<?php echo $filingId;?>'/>
			<input type='hidden' id='userId' name='userId' value='<?php echo $userId;?>'/>
			
		</form>
	</div>
</div>
