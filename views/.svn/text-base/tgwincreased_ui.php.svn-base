<?php 
include_once 'header.php';
global $constantArr;
// Intializing MCrypt class
$MCrypt	= new MCrypt;

$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
$this->taxablevehicleinfoDAO = $taxablevehicleinfoDAO;
?>
		<div class="border marTop-1px pad30px">
			<!--Instruction area-->
			<div class="botBdr padBottom10px pageTipContentAreaBg">	
				<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="Information" title="Information" class="alignleft" /></div>
				<div class="alignleft padLeft10px pageTipContentArea">
					<?php echo $constantArr['tgwidesc'][$_SESSION['lang']]; ?>
				</div>
				<br clear="all"/>
			</div>
			<div class="marTop25px">
				<?php include_once 'filingsteps.php';?>
				<!--Message area-->
				<?php 
				if((isset($_SESSION['addTGWincrease'])) || (isset($_SESSION['updatetgwincreased']))) 
				{
					if(isset($_SESSION['addTGWincrease']))
					$explodeValue = explode('~',$_SESSION['addTGWincrease']);
					else if(isset($_SESSION['updatetgwincreased']))
					$explodeValue = explode('~',$_SESSION['updatetgwincreased']);
					
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
					<div class="marTop10px <?php echo $class;?>"><?php echo $image;?> <?php 
					if(!empty($_SESSION['addTGWincrease'])){ echo $explodeValue[0]; unset($_SESSION['addTGWincrease']);}
						else{ echo $explodeValue[0]; unset($_SESSION['updatetgwincreased']);}?></div>
					<div class="marTop10px">
				<?php } else{?>	
					<div class="marTop25px">
				<?php } ?>
				<?php include_once 'sidebar.php';?>
				<div class="rightArea alignleft marLeft25px">
					<div class="alignleft">
						<a href="/tgwincreased/add/" class="fancybox fancybox.ajax blueTxt" alt="<?php echo $constantArr['addNewVehicle'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['addNewVehicle'][$_SESSION['lang']]; ?>">
							<img src="/images/add_icon.png" alt="" title="" /> <?php echo $constantArr['addNewVehicle'][$_SESSION['lang']]; ?>
						</a>
					</div>
					<?php if(isset($data['getTGWIncreasedInfo']) && count($data['getTGWIncreasedInfo'])>10)
						{include_once 'topform_navigation.php';}?>
					<table cellpadding="5" cellspacing="0" border="0" width="100%" class="leftBdr topBdr marTop5px tableList">
						<thead>
							<tr>
								<th data-sort="string"><?php echo $constantArr['vinLbl'][$_SESSION['lang']]; ?></th>
								<th data-sort="string"><?php echo $constantArr['PreviousCategorylbl'][$_SESSION['lang']]; ?></th>
								<th data-sort="string"><?php echo $constantArr['ChangingToCategorylbl'][$_SESSION['lang']]; ?></th>
								<th data-sort="string"><?php echo $constantArr['logging'][$_SESSION['lang']]; ?></th>
								<th data-sort="string"><?php echo $constantArr['taxamount'][$_SESSION['lang']]; ?> ($)</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php if(sizeof($data['getTGWIncreasedInfo']) > 0)
							{
								for($i=0; $i<count($data['getTGWIncreasedInfo']); $i++)
								{	
									$preTaxWeight = $this->taxablevehicleinfoDAO->gettaxableGrossWeight($MCrypt->decrypt($data['getTGWIncreasedInfo'][$i]['previous_category']));
									$chngTaxWeight = $this->taxablevehicleinfoDAO->gettaxableGrossWeight($MCrypt->decrypt($data['getTGWIncreasedInfo'][$i]['changed_category']));
							?>
							<tr valign="top">
								<td><?php echo $MCrypt->decrypt($data['getTGWIncreasedInfo'][$i]['vin']);?></td>
								<td><?php echo '['.$preTaxWeight['weight_category'].'] '.$preTaxWeight['weight'];?></td>
								<td><?php echo '['.$chngTaxWeight['weight_category'].'] '.$chngTaxWeight['weight'];?></td>
								<td><?php if($MCrypt->decrypt($data['getTGWIncreasedInfo'][$i]['is_logging']) == 'Y'){ echo $constantArr['yeslbl'][$_SESSION['lang']];}else { echo $constantArr['nolbl'][$_SESSION['lang']];}?></td>
								<td align="right">$<?php echo number_format($MCrypt->decrypt($data['getTGWIncreasedInfo'][$i]['difference_tax_amount']),2);?></td>
								<td align="center">
									<a href="/tgwincreased/edit/?TaxableId=<?php echo encryptID($data['getTGWIncreasedInfo'][$i]['taxableid'])?>&vehicleno=<?php echo encryptID($MCrypt->decrypt($data['getTGWIncreasedInfo'][$i]['vin']))?>" class="fancybox fancybox.ajax blueTxt" alt="Edit" title="Edit">
										<img src="/images/edit.png" alt="<?php echo $constantArr['edit'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['edit'][$_SESSION['lang']]; ?>" />
									</a>
								</td>
								<td align="center">
									<a href="javascript:void(0);" onclick="deleteTGWI('<?php echo encryptID($data['getTGWIncreasedInfo'][$i]['taxableid'])?>','<?php echo $data['getTGWIncreasedInfo'][$i]['vin']?>')">
										<img src="/images/delete.png" alt="<?php echo $constantArr['delete'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['delete'][$_SESSION['lang']]; ?>" />
									</a>
								</td>
							</tr>
							<?php } }else{
									echo '<tr><td colspan="7"><div align="center" class="pad25px redTxt">'.$constantArr['noRecordsFound'][$_SESSION['lang']].'</div></td></tr>';
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
