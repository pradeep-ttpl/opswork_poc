<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : authorize_payment_success.php
 * @version  : 1.0
 * @date  : 26-Jul-2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           26-Jul-2012           Initial Version - File Created
 * 
 */


require_once ('../config.php');
require_once ('../constants.php');
?>
<style>
.btn {
border: none;
width: 130px;
padding: 5px;
text-align: center;
background: #EF730F;
font-size: 14px;
color: white;
font-weight: bold;
cursor: pointer;
}
</style>

<form name="purchase" action="<?=TT_SITE_NAME?>paymentsuccess" method="POST">
<?php
foreach($_REQUEST AS $key=>$value)
{
	echo '<input type="hidden" name="transdetailskey[]" value="'.htmlspecialchars($key).'"/>';
	echo '<input type="hidden" name="transdetailsvalue[]" value="'.htmlspecialchars($value).'"/>';
}
?>
<div align="center"><img src="<?=TT_SITE_NAME?>images/loading.gif"></div>
<div align="center"> <p>You will be redirected to our site in two seconds.</p>
<p>If you see this message for more than 2 seconds, please click on the continue button below!</p></div>
<div align="center"><input type="submit" name="continue" class="btn" value="Continue"/></div>
</form>

<SCRIPT LANGUAGE="JavaScript">
setTimeout('document.purchase.submit()',2000);
</SCRIPT>