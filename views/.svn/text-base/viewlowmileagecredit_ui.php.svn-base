<?php
global $constantArr;
$MCrypt	= new MCrypt;

$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
$this->taxablevehicleinfoDAO = $taxablevehicleinfoDAO;

$TaxWeight = $this->taxablevehicleinfoDAO->gettaxableGrossWeight($MCrypt->decrypt($data['editcreditdata']['weight_category']));
?>
<div class="width930px">
	<div class="topgrayBG padTop10px padLeft15px">
		<div class="alignleft marTop3px"><h1><?php echo $constantArr['lowmileage_credits_vehicles'][$_SESSION['lang']];?></h1></div>
		<div class="alignright padRight10px marTop3px cursor">
			<img src="/images/close.png" alt="<?php echo $constantArr['closePopup'][$_SESSION['lang']];?>" title="<?php echo $constantArr['closePopup'][$_SESSION['lang']];?>" onclick="parent.$.fancybox.close();" />
		</div>
	</div>
	<div class="pad20px tablelist">
		<table cellpadding="5px" cellspacing="0" border="0" width="100%" class="topBdr leftBdr">
			<tr align="left">
				<td colspan="4" align="right" class="tableListtd">
					<a href="/lowmileagecredit/edit/?lowMlgId=<?php echo $_REQUEST['lowMlgId']?>" alt="Edit Form" title="Edit Form" class="fancybox fancybox.ajax blueTxt">Edit Form</a>
				</td>
			</tr>
			<tr align="left">
				<th class="tableListth"><?php echo $constantArr['vinLbl'][$_SESSION['lang']];?></th>
				<th class="tableListth"><?php echo $constantArr['grossweightlbl'][$_SESSION['lang']];?></th>
				<th class="tableListth"><?php echo $constantArr['logging'][$_SESSION['lang']];?></th>
				<th class="tableListth"><?php echo $constantArr['amount'][$_SESSION['lang']].' ($)';?></th>
			</tr>
			<tr>
				<td class="tableListtd"><?php echo $MCrypt->decrypt($data['editcreditdata']['vin']);?></td>
				<td class="tableListtd"><?php echo '['.$TaxWeight['weight_category'].'] '.$TaxWeight['weight'];?></td>
				<td class="tableListtd"><?php echo ($MCrypt->decrypt($data['editcreditdata']['is_logging'])=='Y')?$constantArr['yeslbl'][$_SESSION['lang']]:$constantArr['nolbl'][$_SESSION['lang']];?></td>
				<td class="tableListtd"><?php echo number_format($MCrypt->decrypt($data['editcreditdata']['credit_amount']),2);?></td>
			</tr>
			<tr align="left"><td colspan="4" class="tableListtd">&nbsp;</td></tr>
			<tr align="left" valign="top">
				<th colspan="4" width="50%" class="tableListth"><?php echo $constantArr['lowmileage_first_used_month'][$_SESSION['lang']]; ?></th>				
			</tr>
			<tr>
				<td colspan="4" width="50%" class="tableListtd"><?php echo $MCrypt->decrypt($data['editcreditdata']['first_used_month']);?></td>
			</tr>
			<tr align="left"><td colspan="4" class="tableListtd">&nbsp;</td></tr>
			<tr align="left">
				<th width="50%" colspan="2" class="tableListth"><?php echo $constantArr['expplanation'][$_SESSION['lang']]; ?></th>
				<th width="50%" colspan="2" class="tableListth"><?php echo $constantArr['uploaded_file'][$_SESSION['lang']]; ?></th>
			</tr>
			<tr valign="top">
				<td colspan="2" class="tableListtd"><?php echo $MCrypt->decrypt($data['editcreditdata']['refund_explanation']); ?></td>
				<td colspan="2" class="tableListtd"><?php if($data['editcreditdata']['document_name']!=''){?><a href="/views/downloadfile.php/?name=<?php echo $data['editcreditdata']['document_name']; ?>" class="blueTxt"><?php echo $constantArr['download_document'][$_SESSION['lang']];?></a><?php }else{echo ' - ';}?></td>
			</tr>
		</table>
	</div>
</div>
