<?php 
include_once 'header.php';
$filings = $data['filings'];
global $constantArr;

// Intializing MCrypt class
$MCrypt	= new MCrypt;
?>	
				<div class="border marTop-1px pad30px">
					<div class="botBdr padBottom10px pageTipContentAreaBg">	
						<div class="alignleft width20px marTop3px marLeft5px positionAbs"><img src="/images/alert.png" alt="Information" title="Information" class="alignleft" /></div>
						<div class="alignleft padLeft10px pageTipContentArea">
							<p><?=$constantArr['myreturn_desc1'][$_SESSION['lang']]?></p>
							<ul class="listTypeSetting">
								<li><?=$constantArr['myreturn_desc2'][$_SESSION['lang']]?></li>
								<li><?=$constantArr['myreturn_desc3'][$_SESSION['lang']]?></li>
								<li><?=$constantArr['myreturn_desc4'][$_SESSION['lang']]?></li>
								<li><?=$constantArr['myreturn_desc5'][$_SESSION['lang']]?></li>
							</ul>
						</div>
						<br clear="all"/>
					</div>
					<?php if(isset($_SESSION['edit_filing_error'])){?>
					<div class="marTop10px errorMsg"><span class="errorIcon"></span> <?php echo $constantArr['editFilingError'][$_SESSION['lang']]; unset($_SESSION['edit_filing_error']);?></div>
					<?php }?>
					<div class="marTop25px">
						<div class="alignright">
							<a href="/taxyear/new" alt="" title="" class="blueTxt">
								<img src="/images/add_icon.png" alt="<?=$constantArr['startfiling'][$_SESSION['lang']]?>" title="<?=$constantArr['startfiling'][$_SESSION['lang']]?>" /> <?=$constantArr['startfiling'][$_SESSION['lang']]?>
							</a>
						</div>
						<br clear="all"/>					
						<table cellpadding="5" cellspacing="0" border="0" width="100%" class="leftBdr topBdr marTop5px tableList">
							<thead>
								<tr>
									<th data-sort="string"><?=$constantArr['Business'][$_SESSION['lang']]?></th>
									<th data-sort="int"><?=$constantArr['Monthlbl'][$_SESSION['lang']]?></th>
									<th data-sort="int"><?=$constantArr['formtype'][$_SESSION['lang']]?></th>						
									<th data-sort="string"><?=$constantArr['createddate'][$_SESSION['lang']]?></th>	
									<th data-sort="string"><?=$constantArr['status'][$_SESSION['lang']]?></th>
									<th data-sort="string" width="10%"><?=$constantArr['schedule1'][$_SESSION['lang']]?></th>
									<th width="5%">&nbsp;</th>
									<th width="5%">&nbsp;</th>
							  </tr>
							</thead>
							<tbody>
								<?php if(count($filings)>0){foreach ( $filings as $key => $value ) : ?>
								<tr <?php if($key%2 != 0){ echo 'class="evenrow"'; } ?>>
									<td><?php echo $MCrypt->decrypt($value['name']); ?></td>									
									<td>
										<?php if($value['form_type']!='8849S6'){
											echo ($MCrypt->decrypt($value['filing_month']) < 7)?$value['filing_year']+1:$value['filing_year'];  echo " - ". date("F", mktime(0, 0, 0, $MCrypt->decrypt($value['filing_month']), 10))?>
										<?php } else {
											echo '-';
										}
										?>
									</td>
									<td><?php echo $value['form']; ?></td>	
									<td><?php echo date( 'jS F Y - g:ia', strtotime($value['created_date'])); ?></td>
									<td><strong class="orngTxt"><?=$constantArr[$value['filing_status']][$_SESSION['lang']]?></strong></td>
									<td align="center"><?php if($value['filing_status'] == "SCH1_RECEIVED"){ ?><a href="/views/downloadfile.php/?name=<?=$MCrypt->encrypt($value['sch1_path'])?>&type=schedule1" ><img src="/images/pdf.png" alt="Download PDF" title="Download PDF" /></a><?php }else{ echo '&nbsp;';} ?></td>						
									<td align="center">
										<?php 
											if($value['filing_status'] == 'INCOMPLETE'){ 
										?>
												<a href="javascript:void(0);" title="Edit" onclick="selectedFiling('<?php echo encryptID($value['id']);?>')">
													<img src="/images/edit.png" alt="Edit" title="Edit" />
												</a>
										<?php 
											}else if($value['filing_status'] == 'IRS_REJECTED'){
										?>
												<a href="javascript:void(0);" title="Edit" onclick="resubmitFiling('<?php echo encryptID($value['id']);?>')">
													<img src="/images/edit.png" alt="Edit" title="Edit" />
												</a>												
										<?php
											}else{
												echo '&nbsp;';
											} 
										?>
									</td>
									<td align="center"><?php if($value['filing_status'] == 'INCOMPLETE' || $value['filing_status'] == 'IRS_REJECTED'){ ?><a href="javascript:void(0);" title="Delete" onclick="deletetaxpendinglist('<?php echo encryptID($value['id']);?>')" ><img src="/images/delete.png" alt="Delete" title="Delete" /></a><?php }else{ echo '&nbsp;';} ?></td>
								</tr>
								<?php endforeach;}else{?>
								<tr>
									<td colspan="8" align="center">
										<div class="pad25px">
											<?=$constantArr['nofiling'][$_SESSION['lang']]?>
											<a class="blueTxt" href="/taxyear/" alt="Add business" title="Add business"><?=$constantArr['startfiling'][$_SESSION['lang']]?></a>
										</div>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	<!---------maincontainer section ends here------------>	
<?php include_once 'footer.php';?>
