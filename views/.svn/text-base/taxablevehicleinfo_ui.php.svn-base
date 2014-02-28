<?php 
include_once 'header.php';
// Intializing MCrypt class
$MCrypt	= new MCrypt;
?>
<div class="border marTop-1px pad30px">
	<!--Instruction area-->
	<div class="botBdr padBottom10px pageTipContentAreaBg">	
		<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="<?=$constantArr['information'][$_SESSION['lang']]?>" title="<?=$constantArr['information'][$_SESSION['lang']]?>" class="alignleft" /></div>
		<div class="alignleft width930px padLeft10px pageTipContentArea">
			<?=$constantArr['taxablevehicleNotes'][$_SESSION['lang']]?>
		</div>
		<br clear="all"/>
	</div>
	<!--Selected Business Name-->
	<!--Tax Filing wizard starts here--->
	<div class="marTop25px">
		<?php
			include_once 'filingsteps.php'; ?>
		<!--Message area-->
		<?php 
		if((isset($_SESSION['addTaxVehiInfo'])) || (isset($_SESSION['updateTaxVehiInfo']))) 
		{
			if(isset($_SESSION['addTaxVehiInfo']))
			$explodeValue = explode('~',$_SESSION['addTaxVehiInfo']);
			else if(isset($_SESSION['updateTaxVehiInfo']))
			$explodeValue = explode('~',$_SESSION['updateTaxVehiInfo']);
			
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
			if(!empty($_SESSION['addTaxVehiInfo']))
			{ 
				echo $explodeValue[0]; 
				unset($_SESSION['addTaxVehiInfo']);
			}
			else
			{ 
				echo $explodeValue[0]; 
				unset($_SESSION['updateTaxVehiInfo']);
			}
			?>
			</div>
			<div class="marTop10px">
		<?php } else{?>	
			<div class="marTop25px">
		<?php } ?>	
		<?php include_once 'sidebar.php';?>
		<div class="rightArea alignleft marLeft25px">
			<div class="alignleft">
				<a title="<?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>" alt="<?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>" href="/taxablevehicleinfo/add/" class="fancybox fancybox.ajax blueTxt">
					<img src="/images/add_icon.png" alt="<?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>" title="<?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>"/> <?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>
				</a>
			</div>
			<?php
			if(isset($data['getTaxVehiInfo']) && count($data['getTaxVehiInfo'])>10){ 
			include_once 'topform_navigation.php';}?>
			<table cellpadding="5" cellspacing="0" border="0" width="100%" class="leftBdr topBdr marTop5px tableList">
				<thead>
					<tr>
						<th data-sort="string"><?=$constantArr['vinLbl'][$_SESSION['lang']]?></th>
						<th data-sort="string"><?=$constantArr['grossweightlbl'][$_SESSION['lang']]?></th>
						<th data-sort="string"><?=$constantArr['logging'][$_SESSION['lang']]?></th>
						<th data-sort="string"><?=$constantArr['taxamount'][$_SESSION['lang']]?></th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(count($data['getTaxVehiInfo'])>0){
					for($i=0; $i<count($data['getTaxVehiInfo']); $i++)
					{
						$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
						$this->taxablevehicleinfoDAO = $taxablevehicleinfoDAO;
						$TaxWeight = $this->taxablevehicleinfoDAO->gettaxableGrossWeight($MCrypt->decrypt($data['getTaxVehiInfo'][$i]['weight_category']));
						
					?>	
					<tr>
						<td><?php echo $MCrypt->decrypt($data['getTaxVehiInfo'][$i]['vin']); ?></td>
						<td><?php echo "[".$MCrypt->decrypt($data['getTaxVehiInfo'][$i]['weight_category'])."] ".$TaxWeight['weight']; ?></td>
						<td><?php if($MCrypt->decrypt($data['getTaxVehiInfo'][$i]['is_logging']) == 'Y'){ echo $constantArr['yeslbl'][$_SESSION['lang']];} else { echo $constantArr['nolbl'][$_SESSION['lang']];}?></td>
						<td align="right">$<?php echo $MCrypt->decrypt($data['getTaxVehiInfo'][$i]['tax_amount']);?></td>
						<td align="center">
							<a href="/taxablevehicleinfo/edit/?TaxableId=<?php echo encryptID($data['getTaxVehiInfo'][$i]['taxableid']);?>" class="fancybox fancybox.ajax blueTxt" alt="<?=$constantArr['edittaxablevehicle'][$_SESSION['lang']]?>" title="<?=$constantArr['edittaxablevehicle'][$_SESSION['lang']]?>"> 
								<img src="/images/edit.png" alt="<?=$constantArr['edit'][$_SESSION['lang']]?>" title="<?=$constantArr['edit'][$_SESSION['lang']]?>"/>
							</a>
						</td>
						<td align="center"><a href="javascript:void(0);" onclick="deletetaxablevehicle('<?php echo $data['getTaxVehiInfo'][$i]['taxableid']?>','<?php echo $data['getTaxVehiInfo'][$i]['vin']?>')"><img src="/images/delete.png" alt="<?=$constantArr['delete'][$_SESSION['lang']]?>" title="<?=$constantArr['delete'][$_SESSION['lang']]?>"/></a></td>
					</tr>
					<?php } }else{
						echo '<tr><td colspan="6"><div align="center" class="pad25px redTxt">'.$constantArr['noRecordsFound'][$_SESSION['lang']].'</div></td></tr>';
					} ?>
				</tbody>
			</table>
		</div>
		<br clear="all" />
	</div>
	<?php include_once 'formnavigation.php';?>
</div>
</div>
</div>
<!---------maincontainer section ends here------------>	
<?php include_once 'footer.php';?>
