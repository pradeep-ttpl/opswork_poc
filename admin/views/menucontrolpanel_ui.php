<?php 
include_once 'header.php';

$request 	= $_SERVER['REQUEST_URI'];
$parsed 	= explode('/', $request);
$pagename = '';
$edit = '';
$menuId = '';

if(isset($parsed[1]))
$pagename 	= $parsed[1];
 
if(isset($parsed[2]))
$edit = $parsed[2];

if(isset($parsed[3]))
$menuId = $parsed[3];

$menuDetails 	= getMenuDetails($menuId);
$publish	= $menuDetails['publish'];
$menuName 		= $menuDetails['menu_name'];
$menuDisplayName = $menuDetails['menu_display_name'];
$menuParent = $menuDetails['menu_parent_id'];
$menuOrder = $menuDetails['order_id'];
$allParentmenus = getAllparentMenus();
$catCount	=	getCatCount();
?>
<br clear='all'/>
<div id='successMsg'>
	<?php //echo $_SESSION['status']; unset($_SESSION['status']);?>					
</div>
<div class="marTop20px">
	<div class="alignleft" id="previewlist">
		<h3>List of Menus</h3>
		<ul id="categories" class="parentmenu marTop10px">
			<li>
				<?php generateCategory(0); ?>
			</li>
		</ul>
	</div>
	<div class="alignleft marLeft20px">
		<h2 class="blueTxt"><?php echo( $edit == 'edit' ) ? 'Edit Menu Name' : 'Add New Menu'?></h2>
		
		<form action=""  method="post" name="addNewCat" id="addNewCat">
			<input type="hidden" id="menuId"  name="menuId" value ="<?=($edit == 'edit') ? $menuId : ''?>"/>
			<div>
				<label class="label150px">Menu Name :</label>
				<br clear="all"/>
				<input type="text" name="menu_display_name" id="menu_display_name" class="alignleft txtBox260px" value ="<?=($edit == 'edit') ? $menuDisplayName : ''?>"/>
				<span style="font-size:11px;" class="alignleft marTop5px marLeft5px" >(e.g Product Group Master) </span>
				<div id="category_error" class="redtxt marTop5px alignleft marLeft10px"></div>
			</div>
			<br clear="all" />
			<div class="marTop15px">
				<label class="label150px">Menu Url Name :</label>
				<br clear="all"/>
				<input type="text" name="menu_name" id="menu_name" class="alignleft txtBox260px" value ="<?=($edit == 'edit') ? $menuName : ''?>"/>
				<span style="font-size:11px;" class="alignleft marTop5px marLeft5px" >(e.g productgroupmaster) </span>
				<div id="category_error" class="redtxt marTop5px alignleft marLeft10px"></div>
			</div>
			<br clear="all" />
			<?php if($data['levelCount'] == 0){?>
			<div class="marTop15px">
				<label class="label150px">Menu Parent:</label>
				<br clear="all"/>
				<select id="menu_parent" name="menu_parent" class="txtBox260px">
					<option value="0">Select Parent</option>
					<?php 	
					foreach( $allParentmenus as $key => $value )
					{ 
						if( $edit != 'edit' )
						{
								echo '<option value="'.$value['id'].'">'. $value['menu_display_name'] . '</option>'."\n";	
						}
						else
						{
							if ( $catCount > 1 )
							{	
								echo '<option value="'.$value['id'].'"';
								if( $value['id'] == $menuParent ){
								echo 'selected';}
								echo '>'. $value['menu_display_name'] . '</option>'."\n";
							}
						}	
					}
					?>
				</select>
			</div>
			<?php }?>
			<br clear="all" />
			<?php //if($edit == 'edit'){?>
			<div class="marTop15px" id="menu_order_displayId" style="display:none">
				<label class="label150px">Menu Order :</label>
				<br clear="all"/>
				<input type="text" name="menu_order" id="menu_order" class="alignleft txtBox260px" value ="<?php echo $menuOrder;?>"/>
				<div id="category_error" class="redtxt marTop5px alignleft marLeft10px"></div>
			</div>
			<br clear="all" />
			<?php //}?>
			<div class="marTop15px" id="publishHolder">
				<div class="alignleft padRight10px">Publish :</div>
				<input type="radio" name="menu_publish" value="yes" <?php echo ($publish == 'Y') ? 'checked' : '';?> checked id="menu_publish_yes"/> Yes &nbsp;
				<input type="radio" name="menu_publish" value="no" <?php echo ($publish == 'N') ? 'checked' : '';?> id="menu_publish_no"/> No
				<input type="hidden" name="orderId" id="orderId" value="<?php echo $data['orderId'];?>" class="alignleft"/>
			</div>
			<br clear="all"/>
			<div class="marTop15px">
				<?php //if($edit == 'edit') { ?> 
					<div class="alignleft" id="delete_displayId" style="display:none">
						<input type="button" onclick="deleteMenu('<?=$menuId?>')" name="deleteCategory" value="Delete Menu" alt="Delete Menu" title="Delete Menu" class="blueButn100px alignleft marRight10px"/>
						<input type="button" name="updateCategory" value="Update Menu" alt="Update Menu" title="Update Menu" class="blueButn100px alignleft marRight10px" onclick="return validateMenuForm()"/>
						<input onclick="javascript:window.location='/admin/';" type="button" value="Cancel" alt="Cancel" title="Cancel" class="blueButn80px alignleft marRight10px"/> 
					</div>
					
				<?php //}
				//else //{ ?>
					<div class="alignleft" id="addmenu_displayId" style="display:block">
						<input type="submit" name="addCategory" value="Add Menu" alt="Add New Menu" title="Add New Menu" class="blueButn80px alignleft marRight10px" onclick="return validateaddMenuForm()"/> 
						<input onclick="javascript:window.location='/admin/';" type="button" value="Cancel" alt="Cancel" title="Cancel" class="blueButn80px alignleft marRight10px"/> 
					</div>
				<?php //} ?>			
				<div class="marTop5px maxRigh10px alignright">											
					<span id="updateMsg" class="greenTxt marLeft10px"></span>
					<span id="errorspan" class="alignright marLeft10px redTxt"></span>
				</div>
			</div>
		</form>
	</div>
	<br clear="all"/>
</div>
<?php include 'footer.php';?>