<?php 
include_once 'header.php';
$totalAmt = number_format($data['total_amount_gross'],2);
$totalcredit = number_format($data['totalcredit'],2);
?>
<div class="containerLayout">
	<?php include_once 'sidebar.php';?>
	<div class="maincontainer">
		<div class="alignleft" style="width:100%">
				<div class="border">
						<div class="tableHeader">								
							<div class="alignleft marTop5px"><h5>Summary Review</h5></div>
							<div class="alignright marTop8px"><b>Selected Business:
							<span class="blueTxt"> 
								<?php
								$businessid = $_SESSION['selectedbusiness'];
								$businessdetails =  getbusinessname($businessid);
								echo $businessdetails['name'];
							    ?> 
							<span></b>
							</div>	
						</div>
							
						<div class="pad30px">
							<form method="post" action="/paymentoption">
							<table width="100%" cellspacing="0" cellpadding="5" border="0" id="table" class="border marTop30px alignright">
								<thead>
								
									<tr height="30" class="headRow">
										<td width="70%"></td>									
										<td width="30%" class="leftBdr"><span class="alignright"><b>Amount</b></span></td>
									</tr>
									<tr height="30" class="oddrow">											
										<td class="topBdr"><span class="alignright"><b>Total Tax:</b></span></td>														
										<td class="leftBdr topBdr"><span class="alignright">$<?php echo number_format($data['total_amount_gross'],2);?></span></td>														
									</tr>
									<tr height="30" class="oddrow">											
										<td class="topBdr"><span class="alignright"><b>Credits Total:</b></span></td>														
										<td class="leftBdr topBdr"><span class="alignright">$<?php echo number_format($data['totalcredit'],2);?></span></td>														
									</tr>
									<tr height="30" class="oddrow">											
										<td class="topBdr"><span class="alignright"><b>Net Amount Payable to IRS:</b></span></td>														
										<td class="leftBdr topBdr"><span class="alignright"><b>
										<?php 
										if($data['totalcredit'] > $data['total_amount_gross']) 
										{?>
											<b>$<?php echo '0.00';?></b>
										<?php } else {?>
										<b>$<?=number_format(($data['total_amount_gross'] - $data['totalcredit']), 2)?></b>
										<?php } ?>
										</b></span></td>														
									</tr>	
									
								</thead>
							</table>
							
							<br clear="all">
							<div class="marTop20px">
								<div class='blueTxt'><b>Disclaimer</b></div>
								<br clear="all">
								<p>IRS is the sole party to authorize the acceptance and verify the information in your return. We transmit the information to the IRS. Check for errors before submitting.</p>
							</div>
							<div class="alignright marTop20px">
								<a href="<?=TT_SITE_NAME?>summary" class="blueButn100px alignleft">Back</a>
								<input type='submit' name="pay" class="blueButn100px marLeft20px alignleft" value="Continue"/>
							</div>
							</form>	
						<br clear="all">
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<br clear="all">
<!---------maincontainer section ends here------------>	