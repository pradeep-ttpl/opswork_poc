<?php 

if(isset($_SESSION['user_id']))
 header('location:/taxpayerbusiness/');
 
if((isset($_SESSION['user_type']) && $_SESSION['user_type'] !=2 && isset($_SESSION['user_id'])) )
{
	header('Location: '.TT_ADMIN_SITE_NAME.'dashboard/');				
	exit();	
}
 

$request = $_SERVER['REQUEST_URI']; 
$parsed = explode('/', $request);
$Currentpage = preg_replace( '|[^a-z0-9-]+|', '', $parsed[1] );
?>
<html lang="en-US">
	<head>
		<title>simple truck tax</title>
		<link type="text/css" rel="stylesheet" media="screen" href="/css/style.css">
		<link type="text/css" rel="stylesheet" media="screen" href="/css/layout.css">
		<script type="text/javascript" src="/js/jquery-1.6.1.min.js"> </script>
		<script type="text/javascript" src="/js/common.js"> </script>
	</head>
<!----------body section starts here--------------->
	<body class='blueBackGroud'>
		<div id="mainBG">
<!----------header section starts here--------------->
			<div id="topNavigationBG" class="padRight50px padLeft50px"> 
				<ul>
					<li class="<?php echo $Currentpage == '' ? 'selected' : ''; ?>"><a href="landing">Home</a></li>
					<li class="<?php echo $Currentpage == 'aboutus' ? 'selected' : ''; ?>"><a href="aboutus">About us</a></li>
					<li class="<?php echo $Currentpage == 'service' ? 'selected' : ''; ?>"><a href="service">Services</a></li>
					<li class="<?php echo $Currentpage == 'pricing' ? 'selected' : ''; ?>"><a href="pricing">Pricing</a></li>
					<li class="<?php echo $Currentpage == 'whyus' ? 'selected' : ''; ?>"><a href="whyus">Why us</a></li>
					<li class="nopadright <?php echo $Currentpage == 'contactus' ? 'selected' : ''; ?>"><a href="contactus">Contact us</a></li>
				</ul>
			</div>
			<div class="pad50px">
				<div class="logo">
					<a href="index.html"><img title="simple truck tax" alt="simple truck tax" src="/images/ettLogo.png"></a>
				</div>
				<div class="alignright marTop10px">
					<!--<a href="/include/facebook.php?signin=true"><img title="Facebook" alt="Facebook" src="/images/blueButton100.png"></a> -->
					<a href="/register"><img title="Register" alt="Register" src="/images/registerButton.png"></a>
					<a href="/login"class="marLeft15px"><img title="Register" alt="Register" src="/images/loginButton.png"></a>
				</div>
				<br clear="all">
<!----------header section ends here---------------->	