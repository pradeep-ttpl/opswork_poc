<?php
	$formType = $_SESSION['formtype']; 
	if(isset($_SESSION['admin_form_type']) && $_SESSION['admin_form_type'] != ''){
		$formType = $_SESSION['admin_form_type'];					
	} 
?>
<div id="leftNav" class="alignleft">
	<ul>
		<?php 
		
		/* If selected Form Type equal to 2290, Then display only these menus in side bar */
		
		if($formType == '2290'){
		?>
			<li class="<?php echo ($Currentpage == 'taxablevehicleinfo')? 'selected':'';?>">
				<a href="/taxablevehicleinfo/"><?php echo $constantArr['menutaxvehinfo'][$_SESSION['lang']];?></a>
			</li>
			<li class="<?php echo ($Currentpage == 'currentyrsuspend')? 'selected':'';?>">
				<a href="/currentyrsuspend/"><?php echo $constantArr['menucursuspendvehicle'][$_SESSION['lang']];?></a>
			</li>
			<li class="<?php echo ($Currentpage == 'prioryrsuspend')? 'selected':'';?>">
				<a href="/prioryrsuspend/"><?php echo $constantArr['menupriorvehicle'][$_SESSION['lang']];?></a>
			</li>
		<?php
		}
		
		/* If selected Form Type equal to 2290 OR 8849S6, Then display only these menus in side bar */
		
		if($formType == '8849S6' || $formType == '2290'){
		?>
			<li class="<?php echo ($Currentpage == 'solddestroycredit')? 'selected':'';?>">
				<a href="/solddestroycredit/"><?php echo $constantArr['menusolddest'][$_SESSION['lang']];?></a>
			</li>
			<li class="<?php echo ($Currentpage == 'lowmileagecredit')? 'selected':'';?>">
				<a href="/lowmileagecredit/"><?php echo $constantArr['menulowmileage'][$_SESSION['lang']];?></a>
			</li>
		<?php 
		}
		
		
		/* If selected Form Type equal to 8849S6, Then display only these menus in side bar */
		
		if($formType == '8849S6'){
		?>
			<li class="<?php echo ($Currentpage == 'overpayment')? 'selected':'';?>">
				<a href="/overpayment/"><?php echo $constantArr['menucrdoverpay'][$_SESSION['lang']];?></a>
			</li>
		<?php 
		}
		
		/* If selected Form Type equal to 2290A1, Then display only these menus in side bar */
		
		if($formType == '2290A1'){
		?>
			<li class="<?php echo ($Currentpage == 'tgwincreased')? 'selected':'';?>">
				<a href="/tgwincreased/"><?php echo $constantArr['menutgwi'][$_SESSION['lang']];?></a>
			</li>
		<?php 
		}
		
		
		/* If selected Form Type equal to 2290A2, Then display only these menus in side bar */
		
		if($formType == '2290A2'){
		?>
			<li class="<?php echo ($Currentpage == 'exceededmileage')? 'selected':'';?>">
				<a href="/exceededmileage/"><?php echo $constantArr['menuexceed'][$_SESSION['lang']];?></a>
			</li>
		<?php 
		}
		?>
	</ul>
</div>