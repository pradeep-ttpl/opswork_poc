<?php 
include_once 'header.php';

$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
$this->taxablevehicleinfoDAO = $taxablevehicleinfoDAO;

$MCrypt	= new MCrypt;
?>
		<div class="border marTop-1px pad30px">
			<!--Instruction area-->
			<div class="botBdr padBottom10px pageTipContentAreaBg">
				<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="Information" title="Information" class="alignleft" /></div>
				<div class="alignleft padLeft10px pageTipContentArea">
					<?=$constantArr['lowmileageinfo'][$_SESSION['lang']];?>
				</div>
				<br clear="all"/>
			</div>
			<div class="marTop25px">
			<?php
				include_once 'filingsteps.php'; ?> 
			<!--Message area-->
			<?php 
			if((isset($_SESSION['addLowMilMsg'])) || (isset($_SESSION['updateLowMilMsg'])) || (isset($_SESSION['uploadExcelMsg']))) 
			{
				if(isset($_SESSION['addLowMilMsg']))
				$explodeValue = explode('~',$_SESSION['addLowMilMsg']);
				else if(isset($_SESSION['updateLowMilMsg']))
				$explodeValue = explode('~',$_SESSION['updateLowMilMsg']);
				else if(isset($_SESSION['uploadExcelMsg']))
				$explodeValue = explode('~',$_SESSION['uploadExcelMsg']);
				
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
				<?php 
				if(!empty($_SESSION['addLowMilMsg'])){ echo $explodeValue[0]; unset($_SESSION['addLowMilMsg']);}
				else if(!empty($_SESSION['updateLowMilMsg'])){ echo $explodeValue[0]; unset($_SESSION['updateLowMilMsg']);}
				else if(!empty($_SESSION['uploadExcelMsg'])) { echo $explodeValue[0]; unset($_SESSION['uploadExcelMsg']);}?></div>
				<div class="marTop10px">
			<?php } else{?>	
				<div class="marTop25px">
			<?php } ?>	
			<?php include_once 'sidebar.php';?>
			<div class="rightArea alignleft marLeft25px">
				<div class="alignleft">
					<a href="/lowmileagecredit/add/" class="fancybox fancybox.ajax blueTxt" alt="<?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>" title="<?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>">
						<img src="/images/add_icon.png" alt="<?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>" title="<?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>" /> <?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>
					</a>
				</div>
				<?php if(isset($data['getcreditvehicle']) && count($data['getcreditvehicle'])>10)
						{include_once 'topform_navigation.php';}?>
				<table cellpadding="5" cellspacing="0" border="0" width="100%" class="leftBdr topBdr marTop5px tableList">
					<thead>
						<tr>
							<th data-sort="string"><?php echo $constantArr['vinLbl'][$_SESSION['lang']]; ?></th>
							<th data-sort="string"><?php echo $constantArr['grossweightlbl'][$_SESSION['lang']]; ?></th>
							<th data-sort="string"><?php echo $constantArr['logging'][$_SESSION['lang']]; ?></th>
							<th data-sort="string"><?php echo $constantArr['Monthlbl'][$_SESSION['lang']]; ?></th>
							<th data-sort="string"><?php echo $constantArr['taxamount'][$_SESSION['lang']]; ?></th>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<?php if(sizeof($data['getcreditvehicle']) > 0)
						{
							for($i=0; $i<count($data['getcreditvehicle']); $i++)
							{	
								$TaxWeight = $this->taxablevehicleinfoDAO->gettaxableGrossWeight($MCrypt->decrypt($data['getcreditvehicle'][$i]['weight_category']));
						?>
						<tr valign="top">
							<td><?php echo $MCrypt->decrypt($data['getcreditvehicle'][$i]['vin']);?></td>
							<td><?php echo '['.$TaxWeight['weight_category'].'] '.$TaxWeight['weight'];?></td>
							<td><?php if($MCrypt->decrypt($data['getcreditvehicle'][$i]['is_logging']) == 'Y') { echo $constantArr['yeslbl'][$_SESSION['lang']];} else { echo $constantArr['nolbl'][$_SESSION['lang']];} ?></td>
							<td><?php echo $MCrypt->decrypt($data['getcreditvehicle'][$i]['first_used_month']);?></td>
							<td align="right">$<?php echo number_format($MCrypt->decrypt($data['getcreditvehicle'][$i]['credit_amount']),2);?></td>
							<td align="center">
								<a href="/lowmileagecredit/view/?lowMlgId=<?php echo encryptID($data['getcreditvehicle'][$i]['lowMlgId'])?>" class="fancybox fancybox.ajax blueTxt" alt="View" title="View">
									<img src="/images/viewDetails.png" alt="<?php echo $constantArr['view'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['view'][$_SESSION['lang']]; ?>" />
								</a>
							</td>
							<td align="center">
								<a href="/lowmileagecredit/edit/?lowMlgId=<?php echo encryptID($data['getcreditvehicle'][$i]['lowMlgId'])?>" class="fancybox fancybox.ajax blueTxt" alt="Edit" title="Edit">
									<img src="/images/edit.png" alt="<?php echo $constantArr['edit'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['edit'][$_SESSION['lang']]; ?>" />
								</a>
							</td>
							<td align="center">
								<a href="javascript:void(0);" onclick="deletelowmileage('<?php echo $data['getcreditvehicle'][$i]['lowMlgId']?>','<?php echo $data['getcreditvehicle'][$i]['vin']?>')">
									<img src="/images/delete.png" alt="<?php echo $constantArr['delete'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['delete'][$_SESSION['lang']]; ?>" />
								</a>
							</td>
						</tr>
						<?php } }else{
								echo '<tr><td colspan="8"><div align="center" class="pad25px redTxt">'.$constantArr['noRecordsFound'][$_SESSION['lang']].'</div></td></tr>';
							}  ?>
					</tbody>
				</table>
			</div>
			<br clear="all" />
		</div>
		<?php include_once 'formnavigation.php';?>
	</div>
</div>
</div>
<?php include_once 'footer.php';?>
