<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename : changestatus_ui.php
 * @version  : 1.0
 * @date  : 27-Feb-2013
 *
 * @description : change customer status as Admin
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        27-Feb-2013           Initial Version - File Created
 * 
 */
?>
<?php 
global $constantArr;
$MCrypt	= new MCrypt;
$customerInfo = $data['customerInfo'];
?>
<div class="width700px">
	<div class="topgrayBG padTop10px padLeft15px">
		<div class="alignleft marTop3px"><h2>Customer Details:</h2></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="Close" title="Close" onclick="parent.$.fancybox.close();" />
		</div>
		<br clear="all"/>
	</div>
	<div class="pad20px">
		<form action="/admin/customerlist" method="post" enctype="multipart/form-data" name="customerlistform" id="customerlistform">
			<div>
				<p class="marTop10px">
					<label class="small">Name:</label>
					<label class="small"><?php echo $MCrypt->decrypt($customerInfo['first_name']).' '.$MCrypt->decrypt($customerInfo['last_name']);?></label>
				</p>
				<p class="marTop10px">
					<label class="small">Email:</label>
					<label class="small"><?php echo $MCrypt->decrypt($customerInfo['email']);?></label>
				</p>
				<p class="marTop10px">
					<label class="small">Phone:</label>
					<label class="small"><?php echo $MCrypt->decrypt($customerInfo['phone']);?></label>
				</p>
				<p class="marTop10px">
					<label class="small">Admin Access:</label>
					<label class="small">
						<input type="checkbox" class="marRight10px" name="admin_access" id="admin_access">
					</label>
				</p>
				<p>
					<label class="small">&nbsp;</label>
					<label class="small">&nbsp;</label>
					<input type="hidden" id="customerId" name="customerId" value="<?php echo $customerInfo['id'];?>"/>
					<input type="submit" class="blueButn80px" name="Update" value="Update" title="Update" alt="Update" />
					<input class="blueButn80px" type="button" value="Cancel" title="Cancel" alt="Cancel" onclick="parent.$.fancybox.close();">
				</p>
			</div>
		</form>
	</div>
</div>