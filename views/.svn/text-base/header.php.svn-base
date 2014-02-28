<?php 
// Manual - session expire after last activity
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1440)) {
	header( 'Location: /logout/expires');
	exit();
}
$_SESSION['LAST_ACTIVITY'] = time();
/*if((isset($_SESSION['user_type']) && $_SESSION['user_type'] !=2 && $_SESSION['admin_allowed'] != 1 && isset($_SESSION['user_id'])) )
{
	header('Location: '.TT_ADMIN_SITE_NAME.'dashboard');				
	exit();	
}*/
$request = $_SERVER['REQUEST_URI']; 
$parsed = explode('/', $request);
$Currentpage = preg_replace( '|[^a-z0-9-]+|', '', $parsed[1] );

$pageHeading = '';

global $pageArray,$fancyBoxArray,$dateLoadArray,$constantArr,$scrollArray;

/* if user logged in and clicks home page, it should redirect to home page but login form will not be there.
if(isset($_SESSION['user_id']) && ($Currentpage == 'login' || $Currentpage == ''))
 header('location:/taxpayerbusiness/');
*/
/*to identify the IE7 and lower version and show the alert message*/
preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
if(count($matches)<2){
  preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
}

if (count($matches)>1){
  //Then we're using IE
  $version = $matches[1];

  switch(true){
    case ($version<=7):      
      echo '<script type="text/javascript">alert("For better view, please use IE8 and above version");</script>';
      break;
    default:
  }
}
?>
<html>
	<head>
		<title>www.simpletrucktax.com - Simple steps to file your vehicles tax</title>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
		<meta content="utf-8" http-equiv="encoding" />
		
		<link rel="shortcut icon" type="image/x-icon" href="/images/fav-icon.png"/>
		<link type="text/css" rel="stylesheet" media="screen" href="/css/style.css" />
		<link type="text/css" rel="stylesheet" media="screen" href="/css/layout.css" />
		<link type="text/css" rel="stylesheet" media="screen" href="/js/tooltip/tooltipster.css" />
		<!-- to enable html 5 for IE 8-->
		<script type="text/javascript" src="/js/placeholders.min.js"></script>
		<script type="text/javascript" src="/js/jquery.min.js"> </script>
		<script type="text/javascript" src="/js/tablesorter.js"> </script>
		<script type="text/javascript" src="/js/common.js"> </script>
		<script type="text/javascript" src="/js/tooltip/jquery.tooltipster.js"> </script>
		
		<?php 
		if(in_array($Currentpage,$fancyBoxArray) || ($Currentpage == 'login' && (isset($parsed[2]) && strlen($parsed[2]) > 0)) || DISABLE_REGISTRATION == '1')
		{
		?>
			<script type="text/javascript" src="/js/fancybox/jquery.fancybox.js?v=2.1.0"></script>
			<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox.css?v=2.1.0" media="screen" />
			
			<script>
			// fancy box
			$(document).ready(function() {
				$('.fancybox').fancybox();
			});
			</script>
		<?php 
		}
		if(in_array($Currentpage,$dateLoadArray))
		{
		?>
			<!--Date Picker Files-->
			<link rel="stylesheet" href="/js/datepicker/jquery.ui.all.css" />
			<script type="text/javascript" src="/js/datepicker/jquery.ui.core.js"> </script>
			<script type="text/javascript" src="/js/datepicker/jquery.ui.datepicker.js"> </script>
			<link rel="stylesheet" href="/js/datepicker/demos.css" />
		<?php }?>
	</head>
	<?php if($Currentpage == 'login' && (isset($parsed[2]) && strlen($parsed[2]) > 0)){?>
		<script>
		$(function(){
		    $("#myFancybox").fancybox().trigger('click');
		});

		function focusEmail()
		{
			var type = 'findEmail';
			id = '<?php echo $parsed[2];?>';
			var postParams = 'id='+id +'&type='+type;
			
			$.ajax({ type: "POST", url: "/include/ajax.php", data: postParams, dataType: "html",
			success: function( data, textStatus )
			{
				document.getElementById('email').value = data.replace(/\s/g, "");
				document.getElementById('pwd').focus();
				document.getElementById('email').className = 'txtBox245px';
			}
			});
			
		}
		</script>
	<?php }?>
	<script type="text/javascript">
		// for Table sorting		
		$(function(){
			// Helper function to convert a string of the form "Mar 15, 1987" into a Date object.
			var date_from_string = function(str) {
			  var months = ["jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec"];
			  var pattern = "^([a-zA-Z]{3})\\s*(\\d{1,2}),\\s*(\\d{4})$";
			  var re = new RegExp(pattern);
			  var DateParts = re.exec(str).slice(1);
	
			  var Year = DateParts[2];
			  var Month = $.inArray(DateParts[0].toLowerCase(), months);
			  var Day = DateParts[1];
	
			  return new Date(Year, Month, Day);
			}
	
			var table = $("table").stupidtable({
			  "date": function(a,b) {
				// Get these into date objects for comparison.
				aDate = date_from_string(a);
				bDate = date_from_string(b);
				return aDate - bDate;
			  }
			});
	
			table.on("beforetablesort", function (event, data) {
			  // Apply a "disabled" look to the table while sorting.
			  // Using addClass for "testing" as it takes slightly longer to render.
			  $("#msg").text("Sorting...");
			  $("table").addClass("disabled");
			});
	
			table.on("aftertablesort", function (event, data) {
			  // Reset loading message.
			  $("#msg").html("&nbsp;");
			  $("table").removeClass("disabled");
	
			  var th = $(this).find("th");
			  th.find(".arrow").remove();
			  var dir = $.fn.stupidtable.dir;
	
			  var arrow = data.direction === dir.ASC ? "&uarr;" : "&darr;";
			  th.eq(data.column).append('<span class="arrow">' + arrow +'</span>');
			});
		});
		
	</script>
	<!----------body section starts here--------------->
	<body>
		<div class="topgrayBG">
			<a id="myFancybox" href="/views/activateaccount.php?code=<?php if(isset($parsed[2])){ echo $parsed[2];}?>" class="fancybox fancybox.ajax"></a>
			<!----------header section starts here--------------->
			<?php //if($_SESSION['admin_allowed'] != 1){?>
			<div id="topNavigationBGArea"> 
				<div id="topNavigation">
					<ul class="alignleft">
						<li  class="<?php echo $Currentpage == '' ? 'selected' : ''; ?>"><a href="/" alt="<?php echo $constantArr['home'][$_SESSION['lang']];?>" title="<?php echo $constantArr['home'][$_SESSION['lang']];?>" ><?php echo $constantArr['home'][$_SESSION['lang']];?></a></li>
						<li class="<?php echo $Currentpage == 'aboutus' ? 'selected' : ''; ?>"><a href="/aboutus" alt="<?php echo $constantArr['aboutus'][$_SESSION['lang']];?>" title="<?php echo $constantArr['aboutus'][$_SESSION['lang']];?>"><?php echo $constantArr['aboutus'][$_SESSION['lang']];?></a></li>
						<li class="<?php echo $Currentpage == 'service' ? 'selected' : ''; ?>"><a href="/service" alt="<?php echo $constantArr['ourservices'][$_SESSION['lang']];?>" title="<?php echo $constantArr['ourservices'][$_SESSION['lang']];?>"><?php echo $constantArr['ourservices'][$_SESSION['lang']];?></a></li>
						<li class="<?php echo $Currentpage == 'pricing' ? 'selected' : ''; ?>"><a href="/pricing" alt="<?php echo $constantArr['pricing'][$_SESSION['lang']];?>" title="<?php echo $constantArr['pricing'][$_SESSION['lang']];?>" ><?php echo $constantArr['pricing'][$_SESSION['lang']];?></a></li>
						<li class="<?php echo $Currentpage == 'faq' ? 'selected' : ''; ?>"><a href="/faq" alt="<?php echo $constantArr['faq'][$_SESSION['lang']];?>" title="<?php echo $constantArr['faq'][$_SESSION['lang']];?>"><?php echo $constantArr['faq'][$_SESSION['lang']];?></a></li>
						<li class="<?php echo $Currentpage == 'contactus' ? 'selected' : ''; ?>"><a href="/contactus" alt="<?php echo $constantArr['contactus'][$_SESSION['lang']];?>" title="<?php echo $constantArr['contactus'][$_SESSION['lang']];?>"><?php echo $constantArr['contactus'][$_SESSION['lang']];?></a></li>
					</ul>
				</div>
				<?php if(isset($_SESSION['user_type'])){?>
				<div id="topNavRight">
					<ul class="alignright">
						<li><a href="/logout" alt="<?php echo $constantArr['logout'][$_SESSION['lang']];?>" title="<?php echo $constantArr['logout'][$_SESSION['lang']];?>"><span class="myLogout-icon"></span><?php echo $constantArr['logout'][$_SESSION['lang']];?></a></li>
						<li><a href="/myaccount" alt="<?php echo $constantArr['myaccount'][$_SESSION['lang']];?>" title="<?php echo $constantArr['myaccount'][$_SESSION['lang']];?>"><span class="myAccount-icon"></span><?php echo $constantArr['myaccount'][$_SESSION['lang']];?></a></li>						
						<li><a href="/filestatus" alt="<?php echo $constantArr['myfilings'][$_SESSION['lang']];?>" title="<?php echo $constantArr['myfilings'][$_SESSION['lang']];?>" ><span class="myFilings-icon"></span><?php echo $constantArr['myfilings'][$_SESSION['lang']];?></a></li>
						<?php if(isset($_SESSION['admin_allowed']) && $_SESSION['admin_allowed'] == 1){?>
						<li><a href="/admin/dashboard" alt="<?php echo $constantArr['admindashboard'][$_SESSION['lang']];?>" title="<?php echo $constantArr['myfilings'][$_SESSION['lang']];?>" ><span class="myAdmindash-icon"></span><?php echo $constantArr['admindashboard'][$_SESSION['lang']];?></a></li>
						<?php }?>
						<li><a href="#">&nbsp;</a></li>
					</ul>
				</div>
				<?php } else{?>
				<div class="padTop13px">
					<ul class="alignright">
						<?php if($Currentpage == 'register'){?>
							<li><?php echo $constantArr['returninguser'][$_SESSION['lang']];?> <a class="registerTxt" href="/"> <?php echo ucwords($constantArr['loginhere'][$_SESSION['lang']]);?>!</a></li>
						<?php } else{ ?>
						<?php if(DISABLE_REGISTRATION == 1){?>
							<li><?php echo $constantArr['newToStt'][$_SESSION['lang']];?> <a class="registerTxt" href="#" onclick="registerMessage()"> <?php echo ucwords($constantArr['registerhere'][$_SESSION['lang']]);?></a></li>
							<?php } else {?>
							<li><?php echo $constantArr['newToStt'][$_SESSION['lang']];?> <a class="registerTxt" href="/register"> <?php echo ucwords($constantArr['registerhere'][$_SESSION['lang']]);?></a></li>
							<?php } ?>
						<?php } ?>
					</ul>
				</div>
				<?php } ?>
			</div>
			<?php //} ?>
		</div>
		<div id="mainBG">
			<div class="padTop30px">
				<?php //if($_SESSION['admin_allowed'] != 1){?>
				<div>
					<div class="logo width375px">
						<?php if(DISABLE_REGISTRATION == 1){?>
							<a href="/"><img title="www.simpletrucktax.com" alt="www.simpletrucktax.com" src="/images/STT-beta-logo.png" /></a>
						<?php }else{?>
							<a href="/"><img title="www.simpletrucktax.com" alt="www.simpletrucktax.com" src="/images/ettLogo.png" /></a>
						<?php }?>
					</div>
					<div class="alignright width375px">						
						<div alt="Contact number" title="Contact number" class="orngTxt20" align="right">
							<img src="/images/phone-icon.png" alt="" title="" /> 1888-361-7644
						</div>
						<!--div class="blueTxt20 marTop10px" alt="Live Chat" title="Live Chat"  align="right">
							<img src="/images/headphones-icon.png" alt="" title="" /> <?php echo $constantArr['livechat'][$_SESSION['lang']];?>
						</div-->
						<div class="marTop10px" alt="Contact us" title="Contact us" align="right">
							<a class="blueTxt20" href="mailto:info@simpletrucktax.com"> <img src="/images/email-icon.png" alt="Contact us" title="Contact us" /> info@simpletrucktax.com</a>
						</div>
					</div>
					<br clear="all">
				</div>
				<?php //}?>
				<!----------header section ends here---------------->
				<!---------maincontainer section starts here------------>
				<div class="marTop30px" id="scrollId">
				<!--Tab heading place the condition, if it is homepage, don't show this section and if session has user id, show it-->
				<?php if($Currentpage != '' && $Currentpage != 'login'){?>
				<div>
					<div class="tabHeading"><h1><?php 
						if($Currentpage == 'register' && isset($parsed[2]) && $parsed[2]=='confirm'){ echo $constantArr['regconf'][$_SESSION['lang']];}
						else if($Currentpage == 'myaccount' && isset($parsed[2]) && $parsed[2]=='profilechangepassword'){ echo $constantArr['changepwdlbl'][$_SESSION['lang']];}
						else{ echo $pageArray[$Currentpage];}?></h1>
					</div>
					<?php
					//if($_SESSION['admin_allowed'] != 1){ 
						if(isset($_SESSION['user_type'])){?>
					<div class="alignright marTop3px" id="tabRightArea">
						<ul>
							<li class="<?php echo $Currentpage == 'taxpayerbusiness' ? 'selected' : ''; ?>">
								<a href="/taxpayerbusiness" alt="<?php echo $constantArr['mybussiness'][$_SESSION['lang']];?>" title="<?php echo $constantArr['mybussiness'][$_SESSION['lang']];?>">
									<span class="myBusinesses-icon"></span><?php echo $constantArr['mybussiness'][$_SESSION['lang']];?>
								</a>
							</li>
							<li class="<?php echo $Currentpage == 'fleet' ? 'selected' : ''; ?>">
								<a href="/fleet/" alt="<?php echo $constantArr['myvehicles'][$_SESSION['lang']];?>" title="<?php echo $constantArr['myvehicles'][$_SESSION['lang']];?>">
									<span class="myVehicles-icon"></span><?php echo $constantArr['myvehicles'][$_SESSION['lang']];?>
								</a>
							</li>
							<li class="<?php echo $Currentpage == 'filestatus' ? 'selected' : ''; ?>">
								<a href="/filestatus/" alt="<?php echo $constantArr['myreturnstatus'][$_SESSION['lang']];?>" title="<?php echo $constantArr['myreturnstatus'][$_SESSION['lang']];?>">
									<span class="myReturnstatus-icon"></span><?php echo $constantArr['myreturnstatus'][$_SESSION['lang']];?>
								</a>
							</li>
						</ul>
					</div>
					<?php } else if($Currentpage != 'register') {?>
					<div class="alignright marTop3px" id="tabRightArea">
						<ul>
							<li>
								<a href="/" alt="<?php echo $constantArr['loginhere'][$_SESSION['lang']];?>" title="<?php echo $constantArr['loginhere'][$_SESSION['lang']];?>">
									<span class="myLogin-icon"></span><?php echo $constantArr['loginhere'][$_SESSION['lang']];?>
								</a>
							</li>
						</ul>
					</div>
					<?php }
					//} 
					?>
					<br clear="all"/>
				</div>
				<?php } if(in_array($Currentpage,$scrollArray)){?>
				<script>
				$(function(){
					if ( $('#scrollId').length )
					{
						$('html, body').animate({scrollTop: $('#scrollId').offset().top}, 100);
					}
				});
				</script>
				<?php }?>
				<!-- Selected language assigned for js validation calls  -->
				<input type="hidden" id="lang" name="lang" value="<?php echo $_SESSION['lang'];?>"/>
				<input type="hidden" name="serverTime" id="serverTime" value="<?php echo date('Y-m-d');?>" />
				<?php
				// Save current page as next page's referrer
				$_SESSION['referrer']   = current_page_url(); 
				?>
