<?php 
include_once 'header.php';
global $constantArr;

// Intializing MCrypt class
$MCrypt	= new MCrypt;
?>	
		<div class="border marTop-1px pad30px">			
			<div>
				<?php if(isset($_SESSION['fleet_status']) && $_SESSION['fleet_status'] !='') { ?>
					<div class="statusMsg"><span class="successIcon"></span> <?php echo $_SESSION['fleet_status']; unset($_SESSION['fleet_status']);?></div>
				<?php } ?>
				<div class="alignright marTop10px">
					<a title="Add Fleet" alt="Add Fleet" href="/fleet/add/" class="fancybox fancybox.ajax blueTxt">
						<img src="/images/add_icon.png" alt="" title="" /> <?=$constantArr['addfleet'][$_SESSION['lang']]?>
					</a>
				</div>
				<br clear="all" />
				<table cellpadding="5" cellspacing="0" border="0" width="100%" class="leftBdr topBdr marTop5px tableList">
					<thead>
						<tr>
							<th data-sort="string"><?=$constantArr['biz_name'][$_SESSION['lang']]?></th>
							<th data-sort="int"><?=$constantArr['License'][$_SESSION['lang']]?></th>	
							<th data-sort="int"><?=$constantArr['vinLbl'][$_SESSION['lang']]?></th>									
							<th data-sort="string"><?=$constantArr['grossweightlbl'][$_SESSION['lang']]?></th>
							<th data-sort="string"><?=$constantArr['logging'][$_SESSION['lang']]?></th>	
							<th>&nbsp;</th>
							<th>&nbsp;</th>
					  </tr>
					</thead>
					<tbody>
						<?php 
						if(sizeof($data['userFleets']) > 0) 
						{
							foreach ( $data['userFleets'] as $key => $fleetDetails ) : 
								$taxablevehicleinfoDAO = new Taxablevehicleinfo_DAO;
								$this->taxablevehicleinfoDAO = $taxablevehicleinfoDAO;
								$TaxWeight = $this->taxablevehicleinfoDAO->gettaxableGrossWeight($MCrypt->decrypt($fleetDetails['weight_category']));
						?>
						<tr <?php if($key%2 != 0){ echo 'class="evenrow"'; } ?>>
							<td><?=$MCrypt->decrypt($fleetDetails['name'])?></td>									
							<td><a href=""><?=$fleetDetails['licence_no']?></a></td>
							<td><?=$MCrypt->decrypt($fleetDetails['vin'])?></td>	
							<td><?="[".$MCrypt->decrypt($fleetDetails['weight_category'])."] ". $TaxWeight['weight']?></td>
							<td><?php echo ($MCrypt->decrypt($fleetDetails['is_logging']) == 'Y')? $constantArr['yeslbl'][$_SESSION['lang']] : $constantArr['nolbl'][$_SESSION['lang']]; ?></td>
							<td><a class="fancybox fancybox.ajax" href="/fleet/edit/?vinid=<?=encryptID($fleetDetails['id']);?>" title="Edit"><img src="/images/edit.png" alt="Edit" title="Edit" /></a></td>
							<td><a href="javascript:void(0);" title="Delete" onclick="deletefleet('<?=encryptID($fleetDetails['id'])?>')" ><img src="/images/delete.png" alt="Delete" title="Delete" /></a></td>
						</tr>
						<?php endforeach; }else{
						?>
						<tr>
							<td colspan="7" align="center">
								<div class="pad25px">
									<?=$constantArr['novehicles'][$_SESSION['lang']]?>
									<a title="Add Fleet" alt="Add Fleet" href="/fleet/add/" class="fancybox fancybox.ajax blueTxt">
										<?=$constantArr['addfleet'][$_SESSION['lang']]?>
									</a>
								</div>
							</td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
	<!---------maincontainer section ends here------------>	
<?php 
include_once 'footer.php';?>
