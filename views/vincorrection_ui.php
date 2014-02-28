<?php 
include_once 'header.php';
// Intializing MCrypt class
$MCrypt	= new MCrypt;

$request = $_SERVER['REQUEST_URI'];
$parsed = explode('/', $request);

$submittedFilingList = $data['submittedFilingList'];

$backLink = 'taxyear';
/*if(count($submittedFilingList) == 0){
	$backLink = 'filestatus';
}*/
?>
<div class="border marTop-1px pad30px">
	<!--Instruction area-->
	<div class="botBdr padBottom10px pageTipContentAreaBg">	
		<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="<?=$constantArr['information'][$_SESSION['lang']]?>" title="<?=$constantArr['information'][$_SESSION['lang']]?>" class="alignleft" /></div>
		<div class="alignleft width930px padLeft10px pageTipContentArea">
			<?=$constantArr['vincorrectionlist'][$_SESSION['lang']]?>
		</div>
		<br clear="all"/>
	</div>
	<!--Selected Business Name-->
	<!--Tax Filing wizard starts here--->
	<div class="marTop25px">
		<!--Message area-->
	<?php 
		if((isset($_SESSION['addVINCorrection'])) || (isset($_SESSION['updateVinCorrection']))) 
		{
			if(isset($_SESSION['addVINCorrection']))
			$explodeValue = explode('~',$_SESSION['addVINCorrection']);
			else if(isset($_SESSION['updateVinCorrection']))
			$explodeValue = explode('~',$_SESSION['updateVinCorrection']);
			
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
			if(!empty($_SESSION['addVINCorrection'])){ echo $explodeValue[0]; unset($_SESSION['addVINCorrection']);}
				else{ echo $explodeValue[0]; unset($_SESSION['updateVinCorrection']);}?></div>
			<div class="marTop10px">
		<?php } else{?>	
			<div class="marTop25px">
		<?php } ?>
		<?php include_once 'sidebar.php';?>
		<div class="alignleft">
			<?php
				$deletePara = '';  
				if($data['selectedFilingId'] == 'new' || $parsed[2] == 'new'){
				$deletePara = 'new';
			?>
			<a title="<?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>" alt="<?=$constantArr['addNewVehicleForVINCorrection'][$_SESSION['lang']]?>" href="/vincorrection/add/" class="fancybox fancybox.ajax blueTxt">
				<img src="/images/add_icon.png" alt="<?=$constantArr['addNewVehicleForVINCorrection'][$_SESSION['lang']]?>" title="<?=$constantArr['addNewVehicleForVINCorrection'][$_SESSION['lang']]?>"/> <?=$constantArr['addNewVehicleForVINCorrection'][$_SESSION['lang']]?>
			</a>
			<?php }else{
				$deletePara = $MCrypt->encrypt($data['selectedFilingId']);
			?>
			<a title="<?=$constantArr['editVehicleForVINCorrection'][$_SESSION['lang']]?>" alt="<?=$constantArr['editVehicleForVINCorrection'][$_SESSION['lang']]?>" 
				href="/vincorrection/edit/<?php echo $MCrypt->encrypt($data['selectedFilingId']);?>" class="fancybox fancybox.ajax blueTxt">
				<img src="/images/add_icon.png" alt="<?=$constantArr['editVehicleForVINCorrection'][$_SESSION['lang']]?>" title="<?=$constantArr['editVehicleForVINCorrection'][$_SESSION['lang']]?>"/> <?=$constantArr['editVehicleForVINCorrection'][$_SESSION['lang']]?>
			</a>
			<?php	
			}?>
		</div>
		<br clear="all"/>
		<div>
			<?php
			if(isset($data['vinCorrectionlist']) && count($data['vinCorrectionlist'])>10){ 
			include_once 'topform_navigation.php';}?>
			<table cellpadding="5" cellspacing="0" border="0" width="100%" class="leftBdr topBdr marTop5px tableList">
				<thead>
					<tr>
						<th data-sort="string"><?=$constantArr['previousvinlbl'][$_SESSION['lang']]?></th>
						<th data-sort="string"><?=$constantArr['correctvinlbl'][$_SESSION['lang']]?></th>
						<th data-sort="string"><?=$constantArr['VINType'][$_SESSION['lang']]?></th>
						<th data-sort="string"><?=$constantArr['grossweightlbl'][$_SESSION['lang']]?></th>
						<th data-sort="string"><?=$constantArr['logging'][$_SESSION['lang']]?></th>
						<!--<th>&nbsp;</th>-->
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(count($data['vinCorrectionlist'])>0){
					for($i=0; $i<count($data['vinCorrectionlist']); $i++)
					{
						$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
						$this->taxablevehicleinfoDAO = $taxablevehicleinfoDAO;
						$TaxWeight = $this->taxablevehicleinfoDAO->gettaxableGrossWeight($MCrypt->decrypt($data['vinCorrectionlist'][$i]['weight_category']));
						
					?>	
					<tr>
						<td><?php echo $MCrypt->decrypt($data['vinCorrectionlist'][$i]['previous_vin']); ?></td>
						<td><?php echo $MCrypt->decrypt($data['vinCorrectionlist'][$i]['correct_vin']); ?></td>
						<td><?php echo ucfirst($data['vinCorrectionlist'][$i]['vin_type']); ?></td>
						<td><?php echo "[".$MCrypt->decrypt($data['vinCorrectionlist'][$i]['weight_category'])."] ".$TaxWeight['weight']; ?></td>
						<td><?php if($MCrypt->decrypt($data['vinCorrectionlist'][$i]['is_logging']) == 'Y'){ echo $constantArr['yeslbl'][$_SESSION['lang']];}else { echo $constantArr['nolbl'][$_SESSION['lang']];}?></td>
						<!--
						<td align="center">
							<a href="/vincorrection/edit/?TaxableId=<?php echo encryptID($data['vinCorrectionlist'][$i]['taxableid']);?>" class="fancybox fancybox.ajax blueTxt" alt="<?=$constantArr['edittaxablevehicle'][$_SESSION['lang']]?>" title="<?=$constantArr['edittaxablevehicle'][$_SESSION['lang']]?>"> 
								<img src="/images/edit.png" alt="<?=$constantArr['edit'][$_SESSION['lang']]?>" title="<?=$constantArr['edit'][$_SESSION['lang']]?>"/>
							</a>
						</td>-->
						<td align="center"><a href="javascript:void(0);" 
							onclick="deleteVINCorrection('<?php echo encryptID($data['vinCorrectionlist'][$i]['correctionVINId']);?>','<?php echo $deletePara;?>')"><img src="/images/delete.png" alt="<?=$constantArr['delete'][$_SESSION['lang']]?>" title="<?=$constantArr['delete'][$_SESSION['lang']]?>"/></a></td>
					</tr>
					<?php } }else{
						echo '<tr><td colspan="6"><div align="center" class="pad25px redTxt">'.$constantArr['noRecordsFound'][$_SESSION['lang']].'</div></td></tr>';
					} ?>
				</tbody>
			</table>
		</div>
		<br clear="all" />
	</div>
		<div class="alignright marTop20px">
			<input onclick="javascript:window.location='/<?php echo $backLink;?>/';" type="button" class="blueButn60px" value="<?php echo $constantArr['goback'][$_SESSION['lang']]; ?>" alt="<?php echo ucfirst($backLink);?>" title="<?php echo ucfirst($backLink);?>" />
			<input onclick="javascript:window.location='/summary/';" type="button" class="blueButn100px marLeft10px" value="<?php echo $constantArr['continuebtn'][$_SESSION['lang']]; ?>" alt="<?php echo $constantArr['continuebtn'][$_SESSION['lang']]; ?>" title="<?php echo $constantArr['continuebtn'][$_SESSION['lang']]; ?>" />
		</div>
		<br clear="all" /></div>
</div>
</div>
<!---------maincontainer section ends here------------>	
<?php include_once 'footer.php';?>
