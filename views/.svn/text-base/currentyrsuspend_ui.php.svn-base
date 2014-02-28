<?php 
include_once 'header.php';
global $constantArr;
$getcurrentsuspend = $data['getcurrentsuspendinfo'];
// Intializing MCrypt class
$MCrypt	= new MCrypt;
?>
<!---------maincontainer section starts here------------>
<div class="border marTop-1px pad30px">
	<!--Instruction area-->
	<div class="botBdr padBottom10px pageTipContentAreaBg">	
		<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="Information" title="Information" class="alignleft" /></div>
		<div class="alignleft padLeft10px pageTipContentArea">
			<p>
				<?=$constantArr['curentsuspendnotes'][$_SESSION['lang']]?>
			</p>
		</div>
		<br clear="all"/>
	</div>
	<div class="marTop25px">
		<?php
			include_once 'filingsteps.php';?>
		<!--Message area-->
		<?php if((isset($_SESSION['addsuspendVehiInfo'])) || (isset($_SESSION['updatecurrentsuspendInfo']))) 
		{
			if(isset($_SESSION['addsuspendVehiInfo']))
			$explodeValue = explode('~',$_SESSION['addsuspendVehiInfo']);
			else if(isset($_SESSION['updatecurrentsuspendInfo']))
			$explodeValue = explode('~',$_SESSION['updatecurrentsuspendInfo']);
			
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
			if(!empty($_SESSION['addsuspendVehiInfo'])){echo $explodeValue[0]; unset($_SESSION['addsuspendVehiInfo']);}
				else{echo $explodeValue[0]; unset($_SESSION['updatecurrentsuspendInfo']);}?></div>
			<div class="marTop10px">
		<?php } else{?>	
				<div class="marTop25px">
		<?php } ?>
		<?php include_once 'sidebar.php';?>
		<div class="rightArea alignleft marLeft25px">
			<div class="alignleft">
				<a href="/currentyrsuspend/add/" class="fancybox fancybox.ajax blueTxt" alt="<?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>" title="<?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>">
					<img src="/images/add_icon.png" alt="" title="" /> <?=$constantArr['addNewVehicle'][$_SESSION['lang']]?>
				</a>
			</div>
			<?php 
			if(isset($data['getcurrentsuspendinfo']) && count($data['getcurrentsuspendinfo'])>10)
			{ include_once 'topform_navigation.php';}?>
			<table cellpadding="5" cellspacing="0" border="0" width="100%" class="leftBdr topBdr marTop5px tableList">
				<thead>
					<tr height="30" class="headRow">
						<th class="filter-select" data-placeholder="Select"><?=$constantArr['vinLbl'][$_SESSION['lang']]?></th>									
						<th class="filter-select" data-placeholder="Select"><?=$constantArr['logging'][$_SESSION['lang']]?></th>
						<th class="filter-select" data-placeholder="Select"><?=$constantArr['agricurentyearlbl'][$_SESSION['lang']]?></th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(count($getcurrentsuspend) > 0){	
						foreach ($getcurrentsuspend as $key => $value)
						{			
							$rowCnt = count($getcurrentsuspend);				
					?>
						<tr id="rowId-<?php echo $value['filing_id'];?>" height="30" class="oddrow">
							<td class="topBdr <?php echo ($rowCnt == ($key+1))? 'botBdr':'';?>" id="tablewrapper"><?php echo $MCrypt->decrypt($value['vin']);?></td>	
							<td class="leftBdr topBdr <?php echo ($rowCnt == ($key+1))? 'botBdr':'';?>"><?php if($MCrypt->decrypt($value['is_logging']) == 'Y') { echo $constantArr['yeslbl'][$_SESSION['lang']];} else { echo $constantArr['nolbl'][$_SESSION['lang']];}?></td>	
							<td class="leftBdr topBdr <?php echo ($rowCnt == ($key+1))? 'botBdr':'';?>"><?php if($MCrypt->decrypt($value['is_agriculture']) == 'Y') { echo $constantArr['yeslbl'][$_SESSION['lang']];} else { echo $constantArr['nolbl'][$_SESSION['lang']];}?></td>	
							<td class="leftBdr topBdr <?php echo ($rowCnt == ($key+1))? 'botBdr':'';?>">
							<a href="/currentyrsuspend/edit/?crntYrSpndid=<?= encryptID($value['crntYrSpndId']) ?>" title="<?=$constantArr['edit'][$_SESSION['lang']]?>" class="fancybox fancybox.ajax blueTxt"><img src="/images/edit.png" class="padLeft5px" 
							alt="Edit Vehicle Info" title="Edit Vehicle Info">
							</a>
							</td>
							<td class="topBdr <?php echo ($rowCnt == ($key+1))? 'botBdr':'';?>"><a href="javascript:void(0);" onclick="deletecurrentsuspendvehicle('<?php echo $value['crntYrSpndId'];?>','<?php echo $value['vin']?>')" title="Delete"><img src="/images/delete.png" class="padLeft10px"></a></td>															
						</tr>
					<?php } }else{
						echo '<tr><td colspan="6"><div align="center" class="pad25px redTxt">No Records found</div></td></tr>';
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
<?php include_once 'footer.php';?>
