<?php 
global $constantArr;
$MCrypt	= new MCrypt;

$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
$this->taxablevehicleinfoDAO = $taxablevehicleinfoDAO;

$TaxWeight = $this->taxablevehicleinfoDAO->gettaxableGrossWeight($MCrypt->decrypt($data['editSoldDestInfo']['weight_category']));
?>
<div class="width930px">
	<div class="topgrayBG padTop10px padLeft15px">
		<div class="alignleft marTop3px"><h1><?php echo $constantArr['sold_destroyed_vehicles'][$_SESSION['lang']];?></h1></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="<?php echo $constantArr['closePopup'][$_SESSION['lang']];?>" title="<?php echo $constantArr['closePopup'][$_SESSION['lang']];?>" onclick="parent.$.fancybox.close();" />
		</div>
	</div>
	<div class="pad20px">
		<table cellpadding="5px" cellspacing="0" border="0" width="100%" class="topBdr leftBdr tablelist">
			<tr align="left">
				<td colspan="4" align="right" class="tableListtd">
					<a href="/solddestroycredit/edit/?sldDtroyCrdId=<?=$_REQUEST['sldDtroyCrdId']?>" alt="Edit Form" title="Edit Form" class="fancybox fancybox.ajax blueTxt">Edit Form</a>
				</td>
			</tr>
			<tr align="left">
				<th class="tableListth"><?php echo $constantArr['vinLbl'][$_SESSION['lang']];?></th>
				<th class="tableListth"><?php echo $constantArr['grossweightlbl'][$_SESSION['lang']];?></th>
				<th class="tableListth"><?php echo $constantArr['logging'][$_SESSION['lang']];?></th>
				<th class="tableListth"><?php echo $constantArr['amount'][$_SESSION['lang']].' ($)';?></th>
			</tr>
			<tr>
				<td class="tableListtd"><?php echo $MCrypt->decrypt($data['editSoldDestInfo']['vin']);?></td>
				<td class="tableListtd"><?php echo '['.$TaxWeight['weight_category'].'] '.$TaxWeight['weight'];?></td>
				<td class="tableListtd"><?php echo ($MCrypt->decrypt($data['editSoldDestInfo']['is_logging'])=='Y')?$constantArr['yeslbl'][$_SESSION['lang']]:$constantArr['nolbl'][$_SESSION['lang']];?></td>
				<td class="tableListtd"><?php echo $MCrypt->decrypt($data['editSoldDestInfo']['credit_amount']);?></td>
			</tr>
			<tr align="left"><td colspan="4" class="tableListtd">&nbsp;</td></tr>
			<tr align="left" valign="top">
				<th colspan="4" class="tableListth"><?php echo $constantArr['lowmileage_first_used_month'][$_SESSION['lang']]; ?></th>				
			</tr>
			<tr>
				<td colspan="4" width="50%" class="tableListtd"><?php echo $MCrypt->decrypt($data['editSoldDestInfo']['first_used_month']);?></td>
			</tr>
			<tr align="left"><td colspan="4" class="tableListtd">&nbsp;</td></tr>
			<tr align="left">
				<th width="20%" class="tableListth"><?php echo $constantArr['vehicle_was'][$_SESSION['lang']]; ?></th>
				<th width="20%" class="tableListth"><?php echo $constantArr['vehicle_was'][$_SESSION['lang']].' '.$constantArr[$MCrypt->decrypt($data['editSoldDestInfo']['loss_type'])][$_SESSION['lang']];?> On</th>
				<th width="40%" class="tableListth"><?php echo $constantArr['expplanation'][$_SESSION['lang']]; ?></th>
				<th width="20%" class="tableListth"><?php echo $constantArr['uploaded_file'][$_SESSION['lang']]; ?></th>
			</tr>
			<tr valign="top">
				<td class="tableListtd"><?php echo $constantArr[$MCrypt->decrypt($data['editSoldDestInfo']['loss_type'])][$_SESSION['lang']];?></td>
				<td class="tableListtd"><?php echo $MCrypt->decrypt($data['editSoldDestInfo']['sold_destroyed_date']);?></td>
				<td class="tableListtd"><?php echo $MCrypt->decrypt($data['editSoldDestInfo']['refund_explanation']); ?></td>
				<td class="tableListtd"><?php if($data['editSoldDestInfo']['document_name']!=''){?><a href="/views/downloadfile.php/?name=<?php echo $data['editSoldDestInfo']['document_name']; ?>" class="blueTxt"><?php echo $constantArr['download_document'][$_SESSION['lang']];?></a><?php }else{echo ' - ';}?></td>
			</tr>
		</table>
	</div>
</div>
