<?php 
include_once 'header.php';
$businessinfo = $data['businessiInfo'];
$MCrypt	= new MCrypt;
?>	
	<div class="border marTop-1px pad30px">
		<?php 
		if((isset($_SESSION['addBusinessiInfo'])) || (isset($_SESSION['updateBusinessiInfo']))) 
		{
			if(isset($_SESSION['addBusinessiInfo']))
			$explodeValue = explode('~',$_SESSION['addBusinessiInfo']);
			else if(isset($_SESSION['updateBusinessiInfo']))
			$explodeValue = explode('~',$_SESSION['updateBusinessiInfo']);
			
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
		<div class="<?php echo $class;?>"><?php echo $image;?> 
			<?php 
			if(!empty($_SESSION['addBusinessiInfo'])){ echo $explodeValue[0]; unset($_SESSION['addBusinessiInfo']);}
			else if(!empty($_SESSION['updateBusinessiInfo'])){ echo $explodeValue[0]; unset($_SESSION['updateBusinessiInfo']);}
			?>
		</div>
		<div class="marTop10px">
		<?php } else{?>	
		<div>
		<?php } ?>
		<div class="alignright">
			<a href="/addbusiness" alt="" title="" class="blueTxt">
				<img src="/images/add_icon.png" alt="<?=$constantArr['addNewBusiness'][$_SESSION['lang']]?>" title="<?=$constantArr['addNewBusiness'][$_SESSION['lang']]?>" /> <?=$constantArr['addNewBusiness'][$_SESSION['lang']]?>
			</a>
		</div><br clear="all" />
		<table cellpadding="5" cellspacing="0" border="0" width="100%" class="leftBdr topBdr marTop5px tableList">
			<thead>
				<tr>
					<th data-sort="string" width="20%"><?=$constantArr['Business'][$_SESSION['lang']]?></th>
					<th data-sort="string" width="25%"><?=$constantArr['Type'][$_SESSION['lang']]?></th>
					<th data-sort="string" width="10%"><?=$constantArr['biz_EIN'][$_SESSION['lang']]?></th>
					<!--th data-sort="string">Phone</th>
					<th data-sort="string">Email</th-->
<!--				<th data-sort="string"><?=$constantArr['SA_Name'][$_SESSION['lang']]?></th>-->
					<th data-sort="int" width="15%"><?=$constantArr['phone'][$_SESSION['lang']]?></th> 
<!--				<th data-sort="int"><?=$constantArr['TPD_Name'][$_SESSION['lang']]?></th>-->
<!--				<th data-sort="int"><?=$constantArr['phone'][$_SESSION['lang']]?></th> -->
					<!--th data-sort="int">PIN</th-->
					<th>&nbsp;</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
			  </tr>
			</thead>
			<tbody>
				<?php foreach ( $businessinfo as $key => $value ) : ?>
				<tr <?php if($key%2 != 0){ echo 'class="evenrow"'; } ?>>
					<td><?php echo $MCrypt->decrypt($value['name'])?></td>
					<td><?php echo $value['busType']?></td>
					<td><?php echo preg_replace("/^(\d{2})(\d{7})$/", "$1-$2", $MCrypt->decrypt($value['ein']));?></td>
					<!--td><?php //echo $value['phone']?></td>
					<td><?php //echo $value['email']?></td-->
<!--				<td><?php echo $MCrypt->decrypt($value['siging_authority_name'])?></td>-->
					<td><?php echo preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $MCrypt->decrypt($value['phone']));?>
<!--				<td><?php if(strlen($value['third_party_designee_name'])>0){ echo $MCrypt->decrypt($value['third_party_designee_name']); } else { echo '-';}?></td>-->
<!--				<td><?php if(strlen($value['third_party_designee_phone'])>1){ echo preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $MCrypt->decrypt($value['third_party_designee_phone'])); } else { echo '-';}?></td>-->
					<!--td><?php //if(strlen($value['third_party_designee_pin'])>1){ echo $value['third_party_designee_pin']; } else { echo '-';}?></td-->
					<td><a class="blueTxt" href="javascript:void(0);" onclick="selectedbusiness('<?php echo $value['id'];?>','<?php echo $key+1?>')" alt="<?=$constantArr['Start_Filing'][$_SESSION['lang']]?>" title="<?=$constantArr['Start_Filing'][$_SESSION['lang']]?>">
							<?=$constantArr['Start_Filing'][$_SESSION['lang']]?></a></td> 
					<td><a href="/addbusiness/edit/<?=encryptID($value['id'])?>"><img src="/images/edit.png" alt="<?=$constantArr['edit'][$_SESSION['lang']]?>" title="<?=$constantArr['edit'][$_SESSION['lang']]?>"></a></td>
					<td><a href="javascript:void(0);" onclick="deletebusiness('<?=encryptID($value['id'])?>')"><img src="/images/delete.png" alt="<?=$constantArr['delete'][$_SESSION['lang']]?>" title="<?=$constantArr['delete'][$_SESSION['lang']]?>"></a></td>
				</tr>
				<?php endforeach;?>
				</tbody>
			</table>	
		</div>
	</div>
</div>
<!---------maincontainer section ends here------------>	
<?php include_once 'footer.php';?>
