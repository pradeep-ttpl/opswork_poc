<?php
/**
 * PHP version 5.3.2
 *
 * @Copyright (c) 2013. All Rights Reserved.
 * @filename 	: exceededmileage_ui.php
 * @version  	: 1.0
 * @date  	 	: 26-Dec-2013
 *
 * @description : Exceededmileage view file
 *
 * @author      : Naveen R Kumar
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Naveen R Kumar        26-Dec-2013           Initial Version - File Created
 * 
 */
include_once 'header.php';
// Intializing MCrypt class
$MCrypt	= new MCrypt;
?>
<div class="border marTop-1px pad30px">
	<!--Instruction area-->
	<div class="botBdr padBottom10px pageTipContentAreaBg">	
		<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="Information" title="Information" class="alignleft" /></div>
		<div class="alignleft padLeft10px pageTipContentArea">
			<?php echo $constantArr['exceedmileagedesc'][$_SESSION['lang']]; ?>
		</div>
		<br clear="all"/>
	</div>
	<div class="marTop25px">
		<?php include_once 'filingsteps.php';?>
		<!--Message area-->
		<?php 
		if((isset($_SESSION['addExceededMileageMsg'])) || (isset($_SESSION['updateExceededMileageMsg']))) 
		{
			if(isset($_SESSION['addExceededMileageMsg']))
			$explodeValue = explode('~',$_SESSION['addExceededMileageMsg']);
			else if(isset($_SESSION['updateExceededMileageMsg']))
			$explodeValue = explode('~',$_SESSION['updateExceededMileageMsg']);
			
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
			if(!empty($_SESSION['addExceededMileageMsg'])){ echo $explodeValue[0]; unset($_SESSION['addExceededMileageMsg']);}
				else{ echo $explodeValue[0]; unset($_SESSION['updateExceededMileageMsg']);}?></div>
			<div class="marTop10px">
		<?php } else{?>	
			<div class="marTop25px">
		<?php } ?>
		<?php include_once 'sidebar.php';?>
		<div class="rightArea alignleft marLeft25px">
			<div class="alignleft">
				<a href="/exceededmileage/add/" class="fancybox fancybox.ajax blueTxt" alt="<?php echo $constantArr['addNewVehicle'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['addNewVehicle'][$_SESSION['lang']]; ?>">
					<img src="/images/add_icon.png" alt="" title="" /> <?php echo $constantArr['addNewVehicle'][$_SESSION['lang']]; ?>
				</a>
			</div>
			<?php if(isset($data['getExceededMileageVehiInfo']) && count($data['getExceededMileageVehiInfo'])>10)
					{include_once 'topform_navigation.php';}?>
			<table cellpadding="5" cellspacing="0" border="0" width="100%" class="leftBdr topBdr marTop5px tableList">
				<thead>
					<tr>
						<th data-sort="string"><?php echo $constantArr['vinLbl'][$_SESSION['lang']]; ?></th>
						<th data-sort="string"><?php echo $constantArr['grossweightlbl'][$_SESSION['lang']]; ?></th>
						<th data-sort="string"><?php echo $constantArr['logging'][$_SESSION['lang']]; ?></th>
						<th data-sort="string"><?php echo $constantArr['taxamount'][$_SESSION['lang']]; ?> ($)</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(count($data['getExceededMileageVehiInfo']) > 0){
						for($i=0; $i<count($data['getExceededMileageVehiInfo']); $i++)
						{
							$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
							$this->taxablevehicleinfoDAO = $taxablevehicleinfoDAO;
							$TaxWeight = $this->taxablevehicleinfoDAO->gettaxableGrossWeight($MCrypt->decrypt($data['getExceededMileageVehiInfo'][$i]['weight_category']));
					?>	
							<tr>
								<td><?php echo $MCrypt->decrypt($data['getExceededMileageVehiInfo'][$i]['vin']);?></td>
								<td><?php echo "[".$MCrypt->decrypt($data['getExceededMileageVehiInfo'][$i]['weight_category'])."] ".$TaxWeight['weight'];?></td>
								<td><?php if($MCrypt->decrypt($data['getExceededMileageVehiInfo'][$i]['is_logging']) == 'Y'){ echo $constantArr['yeslbl'][$_SESSION['lang']];}else { echo $constantArr['nolbl'][$_SESSION['lang']];}?></td>
								<td align="right">$<?php echo number_format($MCrypt->decrypt($data['getExceededMileageVehiInfo'][$i]['tax_amount']),2);?></td>
								<td align="center">
									<a href="/exceededmileage/edit/?emId=<?php echo encryptID($data['getExceededMileageVehiInfo'][$i]['taxableid'])?>&vehicleno=<?php echo $data['getExceededMileageVehiInfo'][$i]['vin']?>" class="fancybox fancybox.ajax blueTxt" alt="Add New Vehicle" title="Add New Vehicle">
										<img src="/images/edit.png" alt="<?php echo $constantArr['edit'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['edit'][$_SESSION['lang']]; ?>" />
									</a>
								</td>
								<td align="center"><a href="javascript:void(0);" onclick="deleteExceededMileageVehi('<?php echo encryptID($data['getExceededMileageVehiInfo'][$i]['taxableid'])?>','<?php echo $data['getExceededMileageVehiInfo'][$i]['vin']?>')"><img src="/images/delete.png" alt="<?php echo $constantArr['delete'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['delete'][$_SESSION['lang']]; ?>"/></a></td>
							</tr>
					<?php 
						}
					}else{
							echo '<tr><td colspan="6"><div align="center" class="pad25px redTxt">'.$constantArr['noRecordsFound'][$_SESSION['lang']].'</div></td></tr>';
					} 
					?>
				</tbody>
			</table>
			</div>
					<br clear="all" />
				</div>
				<?php include_once 'formnavigation.php';?>
			</div>
		</div>			
<?php include_once 'footer.php';?>
