<?php 
include_once 'header.php';
global $constantArr;
$getPriorYrDetails = $data['getPriorYrDetails'];
// Intializing MCrypt class
$MCrypt	= new MCrypt;
?>
<!---------maincontainer section starts here------------>
<div class="border marTop-1px pad30px">
	<!--Instruction area-->
	<div class="botBdr padBottom10px pageTipContentAreaBg">	
		<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="Information" title="Information" class="alignleft" /></div>
		<div class="alignleft padLeft10px pageTipContentArea">
			<?=$constantArr['priorinfo'][$_SESSION['lang']]?>
		</div>
		<br clear="all"/>
	</div>
	<div class="marTop25px">
	<?php
		include_once 'filingsteps.php'; ?>
	<!--Message area-->
	<?php 
	if((isset($_SESSION['addPriorYr'])) || (isset($_SESSION['updateStatus'])))
	{
		if(isset($_SESSION['addPriorYr']))
		$explodeValue = explode('~',$_SESSION['addPriorYr']);
		else if(isset($_SESSION['updateStatus']))
		$explodeValue = explode('~',$_SESSION['updateStatus']);
		
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
		if(!empty($_SESSION['addPriorYr'])){echo $explodeValue[0]; unset($_SESSION['addPriorYr']);}
		else{echo $explodeValue[0]; unset($_SESSION['updateStatus']);}?></div>
		<div class="marTop10px">
	<?php } else{?>	
		<div class="marTop25px">
	<?php } ?>	
	<?php include_once 'sidebar.php';?>
	<div class="rightArea alignleft marLeft25px">
		<div class="alignleft">
			<a href="/prioryrsuspend/add/" class="fancybox fancybox.ajax blueTxt" alt="<?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>" title="<?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>">
				<img src="/images/add_icon.png" alt="" title="" /> <?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>
			</a>
		</div>
		<?php if(isset($data['getPriorYrDetails']) && count($data['getPriorYrDetails'])>10)
			{include_once 'topform_navigation.php';}?>
		<table cellpadding="5" cellspacing="0" border="0" width="100%" class="leftBdr topBdr marTop5px tableList">
			<thead>
				<tr>
					<th data-sort="string"><?=$constantArr['vinLbl'][$_SESSION['lang']]?></th>
					<th data-sort="string"><?=$constantArr['soldlbl'][$_SESSION['lang']]?></th>
					<th data-sort="string"><?=$constantArr['exceededmileage'][$_SESSION['lang']]?></th>
					<th data-sort="string"><?=$constantArr['soldtranstolbl'][$_SESSION['lang']]?></th>
					<th data-sort="int"><?=$constantArr['dateoftranslbl'][$_SESSION['lang']]?></th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			<?php
				if(sizeof($getPriorYrDetails) > 0){
					for($i=0; $i<count($data['getPriorYrDetails']); $i++)
					{
						$soldToWhom = ($getPriorYrDetails[$i]['sold_to_whom'] != '')? $MCrypt->decrypt($getPriorYrDetails[$i]['sold_to_whom']) : '-';
						$soldDate 	= ($getPriorYrDetails[$i]['sold_date'] != '')? $MCrypt->decrypt($getPriorYrDetails[$i]['sold_date']) : '-';
			?>
					<tr valign="top">
						<td><?php echo $MCrypt->decrypt($getPriorYrDetails[$i]['vin']);?></td>
						<td><?php if($MCrypt->decrypt($getPriorYrDetails[$i]['is_vehicle_sold']) == 'Y'){ echo $constantArr['yeslbl'][$_SESSION['lang']];}else{ echo $constantArr['nolbl'][$_SESSION['lang']];}?></td>
						<td><?php if($MCrypt->decrypt($getPriorYrDetails[$i]['is_exceeded_mileage']) == 'Y'){ echo $constantArr['yeslbl'][$_SESSION['lang']];}else{ echo $constantArr['nolbl'][$_SESSION['lang']];}?></td>
						<td><?php echo $soldToWhom;?></td>
						<td><?php echo $soldDate;?></td>
						<td align="center">
							<a 	href="/prioryrsuspend/edit/?preYrSpndId=<?php echo encryptID($getPriorYrDetails[$i]['preYrSpndId']);?>" 
								class="fancybox fancybox.ajax blueTxt" alt="Edit Vehicle Info" title="Edit Vehicle Info">
								<img src="/images/edit.png" alt="Edit" title="Edit" />
							</a>
						</td>
						<td align="center"><img src="/images/delete.png" alt="Delete" title="Delete" 
							onclick="deleteprioryyearvehicle('<?php echo $getPriorYrDetails[$i]['preYrSpndId'];?>','<?php echo $getPriorYrDetails[$i]['vin']?>')"/>
						</td>
					</tr>
			<?php
					}
				}else{
					echo '<tr><td colspan="7"><div align="center" class="pad25px redTxt">'. $constantArr['noRecordsFound'][$_SESSION['lang']] .'</div></td></tr>';
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
</div>	
<?php include_once 'footer.php';?>			
