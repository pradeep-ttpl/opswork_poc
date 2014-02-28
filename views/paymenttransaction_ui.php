<?php 
include_once 'header.php';
$MCrypt	= new MCrypt;

$userID = $_SESSION['user_id'];
$registerDAO = new Register_DAO;
$userDetails = $registerDAO->getUserDetails($userID);
?>
	<div class="border marTop-1px pad30px">
		<div>
			<?php include_once 'userinfosidebar.php';?>
			<div class="rightArea alignleft marLeft25px">
				<table cellpadding="5" cellspacing="0" border="0" width="100%" class="leftBdr topBdr marTop5px tableList">
					<thead>
						<tr>
							<th data-sort="string"><?=$constantArr['dateOfPayment'][$_SESSION['lang']]?></th> 
							<th data-sort="string"><?=$constantArr['formtype'][$_SESSION['lang']]?></th>
							<th data-sort="string"><?=$constantArr['transaction_id'][$_SESSION['lang']]?></th> 
							<th data-sort="string"><?=$constantArr['voucherNo'][$_SESSION['lang']]?></th> 
							<th data-sort="string"><?=$constantArr['paymentGateway'][$_SESSION['lang']]?></th> 
							<th data-sort="string"><?=$constantArr['amount'][$_SESSION['lang']]?> ($)</th> 
<!--						<th data-sort="string"><?=$constantArr['paymentStatus'][$_SESSION['lang']]?></th> -->
						</tr>
					</thead>
					<tbody>
						<?php
						if(count($data['paymentDetails'])>0){
						foreach($data['paymentDetails'] as $values) {
						?>	
						<tr>
							<td>
								<?php if(strtotime($values['modified_date'])){
									 	echo date("Y/m/d",strtotime($values['modified_date'])); 
									  }else{ echo '-';}
								?>
							</td>
							<td><?=$values['desc']?></td>
							<td><?php if(strlen($values['transaction_id'])>0) { echo $values['transaction_id'];}else{echo '-';}?></td> 
							<td><?php if(strlen($values['voucher_no'])>0) { echo $values['voucher_no'];}else{echo '-';}?></td> 
							<td><?php if(strlen($values['payment_gateway'])>0){ echo $values['payment_gateway'];} else { echo '-';}?></td>
							<td><?=$values['amount']?></td>
<!--						<td><?=$values['payment_status']?></td>-->
						</tr>
						<?php } }else{
							echo '<tr><td colspan="7"><div align="center" class="pad25px redTxt">'.$constantArr['noRecordsFound'][$_SESSION['lang']].'</div></td></tr>';
						 } ?>
					</tbody>
				</table>
			</div>
			<br clear="all" />
		</div>
	</div>
</div>
</div>
<!---------maincontainer section ends here------------>	
<?php include_once 'footer.php';?>
