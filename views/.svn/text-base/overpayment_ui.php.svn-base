<?php 
include_once 'header.php';
global $constantArr;
$MCrypt	= new MCrypt;

$getOverpayment = $data['getOverpayment'];
?>
		<div class="border marTop-1px pad30px">
			<!--Instruction area-->
			<div class="botBdr padBottom10px pageTipContentAreaBg">	
				<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="Information" title="Information" class="alignleft" /></div>
				<div class="alignleft padLeft10px pageTipContentArea">
					You can claim a refund for any tax amount that was overpaid to the IRS due to a mistake in tax liability previously reported on form 2290.
				</div>
				<br clear="all"/>
			</div>
			<?php include_once 'filingsteps.php';?>
				<!--Message area-->
				<?php 
				if(isset($_SESSION['addOverpayment']) || isset($_SESSION['updateOverpayment'])) 
				{
					if(isset($_SESSION['addOverpayment']))
					$explodeValue = explode('~',$_SESSION['addOverpayment']);
					else if(isset($_SESSION['updateOverpayment']))
					$explodeValue = explode('~',$_SESSION['updateOverpayment']);
					
					if($explodeValue[1] == 'success')
					{
						$class = 'statusMsg';
						$image = '<span class="successIcon"></span>';
					}
					else 
					{
						$class = 'errorMsg';
						$image = '<span class="errorIcon"></span>';
					}
				?>
					<div class="marTop10px <?php echo $class;?>"><?php echo $image;?> 
					<?php if(isset($_SESSION['addOverpayment'])){ echo $explodeValue[0]; unset($_SESSION['addOverpayment']);}
					elseif(isset($_SESSION['updateOverpayment'])){ echo $explodeValue[0]; unset($_SESSION['updateOverpayment']);}?>
					</div>
					<div class="marTop10px">
				<?php } else{?>	
					<div class="marTop25px">
				<?php } ?>	
				<?php include_once 'sidebar.php';?>
				<div class="rightArea alignleft marLeft25px">
					<div class="alignleft">
						<a href="/overpayment/add/" class="fancybox fancybox.ajax blueTxt" alt="Add Over Payment Credit" title="Add Over Payment Credit">
							<img src="/images/add_icon.png" alt="" title="" /> <?=$constantArr['addNewVehicle'][$_SESSION['lang']];?>
						</a>
					</div>
					<?php if(isset($data['getOverpayment']) && count($data['getOverpayment'])>10)
					{include_once 'topform_navigation.php';}?>
					<table cellpadding="5" cellspacing="0" border="0" width="100%" class="leftBdr topBdr marTop5px tableList">
						<thead>
							<tr> 
								<th data-sort="string"><?=$constantArr['vinLbl'][$_SESSION['lang']]?></th>
								<th data-sort="string"><?=$constantArr['paymentdate'][$_SESSION['lang']];?></th>
								<th data-sort="string"><?=$constantArr['amountclaim'][$_SESSION['lang']];?></th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php if(sizeof($getOverpayment) > 0)
							{
								for($i=0; $i<count($getOverpayment); $i++)
								{	
							?>
							<tr valign="top">
								<td><?php echo $MCrypt->decrypt($getOverpayment[$i]['vin']);?></td>
								<td><?php echo $MCrypt->decrypt($getOverpayment[$i]['payment_date']);?></td>
								<td align="right">$<?php echo number_format($MCrypt->decrypt($getOverpayment[$i]['amount_of_claim']),2);?></td>
								<td align="center">
									<a href="/overpayment/edit/?overpaymentId=<?php echo encryptID($getOverpayment[$i]['overpaymentId'])?>" class="fancybox fancybox.ajax blueTxt" alt="Edit" title="Edit">
										<img src="/images/edit.png" alt="Edit" title="Edit" />
									</a>
								</td>
								<td align="center">
									<a href="javascript:void(0);" onclick="deleteoverpayment('<?php echo encryptID($getOverpayment[$i]['overpaymentId'])?>')">
										<img src="/images/delete.png" alt="Delete" title="Delete" />
									</a>
								</td>
							</tr>
							<?php } }else{
									echo '<tr><td colspan="5"><div align="center" class="pad25px redTxt">'. $constantArr['noRecordsFound'][$_SESSION['lang']] .'</div></td></tr>';
								}  ?>
						</tbody>
					</table>
				</div>
				<br clear="all" />
			</div>
			<?php include_once 'formnavigation.php';?>
		</div>
	</div>
<?php include_once 'footer.php';?>
