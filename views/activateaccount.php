<?php 
include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
include_once($_SERVER['DOCUMENT_ROOT'].'/constants.php');
include_once(TT_ENTITY_PATH.'/register_entity.php');
$code = $_REQUEST['code'];

$decodedkey = base64_decode($code);
list($verifyKey,$registeredDate,$userID) = explode('/',$decodedkey); 
$userID = (int)$userID;


$registerDAO = new Register_DAO;
$userDetails = $registerDAO->getUserDetails($userID);

if(count($userDetails) == 0)
{
?>
	<script>
	$(function(){
		userID = <?php echo $userID;?>;
		registeredDate = '<?php echo $registeredDate;?>';
		var type = 'activateAccount';
		var postParams = 'type='+type+'&userID='+userID+'&registeredDate='+registeredDate;
		
		$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				return false;	
			}
		});
	});
	</script>
	<div class="pad25px width475px" align="center">
		<h2 class="greenTxt noBold"><?php echo $constantArr['accountactivated'][$_SESSION['lang']];?></h2><br/>
		<a href="javascript:void(0)" class="blueButton200 displayBlock marTop10px" onclick="parent.$.fancybox.close(),focusEmail();">
			<?php echo $constantArr['continuetologin'][$_SESSION['lang']];?>
		</a>
	</div>
<?php } else {?> 
	<div class="pad25px width475px" align="center">
		<h2 class="greenTxt noBold"><?php echo $constantArr['accountalreadyactivated'][$_SESSION['lang']];?></h2><br/>
		<a href="javascript:void(0)" class="blueButton200 displayBlock marTop10px" onclick="parent.$.fancybox.close(),focusEmail();">
			<?php echo $constantArr['continuetologin'][$_SESSION['lang']];?>
		</a>
	</div>
<?php }?>
