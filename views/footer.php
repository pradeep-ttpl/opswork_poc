			<?php if(DISABLE_REGISTRATION == 1){?>
			<a id="regAnchorId" href="#loaderContent" class="fancybox"></a>
				<div id="loaderContent" class="width635px" style="display:none;" align="center">
					<div class="alignright padRight10px marTop10px cursor">
						<img src="/images/close.png" alt="<?=$constantArr['closePopup'][$_SESSION['lang']]?>" title="<?=$constantArr['closePopup'][$_SESSION['lang']]?>" onclick="parent.$.fancybox.close();" /> 
					</div>
					<div class="pad25px" align="center">
						<!--<strong><h2>Hold on</h2></strong>
						<p class="marTop10px">We will come live with a bang on <strong class="orngTxt">12th Feb 2014 </strong>. Make sure that you visit our site and have a good time filing this season.</p>
						-->
						<img src="/images/holdon1a.jpg" />
					</div>
				</div>
			<?php }?>
			</div>
			<br clear="all">
			</div>
		</div>
		<!---------maincontainer section ends here------------>	
		<!---------footer section start here------------>
		<div class="footergrayBG">
			<div class="footerBG">
				<div class="padTop30px" id="footerLinks">
					<div class="width200px alignleft">
						<p><strong>QUICK LINKS</strong></p>
						<ul>
							<li><a href="/aboutus" class="blueTxt"><?php echo $constantArr['aboutus'][$_SESSION['lang']];?></a></li>
							<li><a href="/service" class="blueTxt"><?php echo $constantArr['ourservices'][$_SESSION['lang']];?></a></li>
							<li><a href="/faq" class="blueTxt"><?php echo $constantArr['faq'][$_SESSION['lang']];?></a></li>
							<li><a href="/pricing" class="blueTxt"><?php echo $constantArr['pricing'][$_SESSION['lang']];?></a></li>
							<li><a href="/contactus" class="blueTxt"><?php echo $constantArr['contactus'][$_SESSION['lang']];?></a></li>
							<li><a href="/privacypolicy" class="blueTxt"><?php echo $constantArr['privacypolicy'][$_SESSION['lang']];?></a></li>
							<li><a href="/termsandconditions" class="blueTxt"><?php echo $constantArr['tc'][$_SESSION['lang']];?></a></li>
						</ul>
					</div>
					<div class="width200px alignleft">
						<p><strong>RESOURCE CENTER</strong></p>
						<ul>
							<li><a href="http://www.irs.gov/uac/e-file-Form-2290" class="blueTxt" target="_blank"><?php echo $constantArr['efileF2290'][$_SESSION['lang']];?></a></li>
							<li><a href="http://www.irs.gov/Tax-Professionals/Requirements-for-Tax-Return-Preparers:-Frequently-Asked-Questions" class="blueTxt" target="_blank"><?php echo $constantArr['taxpreparer'][$_SESSION['lang']];?></a></li>
							<!--li><a href="/" class="blueTxt" target="_blank"><?php echo $constantArr['hvutp'][$_SESSION['lang']];?></a></li-->
							<li><a href="http://www.irs.gov/instructions/i2290/ch01.html" class="blueTxt" target="_blank"><?php echo $constantArr['F2290S1'][$_SESSION['lang']];?></a></li>
							<li><a href="http://www.irs.gov/pub/irs-pdf/f8849.pdf" class="blueTxt" target="_blank"><?php echo $constantArr['F8849'][$_SESSION['lang']];?></a></li>
							<li><a href="http://www.irs.gov/uac/Electronic-Payment-Options-Home-Page" class="blueTxt" target="_blank"><?php echo $constantArr['irspay'][$_SESSION['lang']];?></a></li>
							<!--li><a href="/" class="blueTxt" target="_blank"><?php echo $constantArr['vincorrection'][$_SESSION['lang']];?></a></li-->
						</ul>
					</div>
					<div class="width200px alignleft">
						<p><strong>IRS LINKS</strong></p>
						<ul>
							<li><a href="http://www.irs.gov/" class="blueTxt" target="_blank"><?php echo $constantArr['irsgov'][$_SESSION['lang']];?></a></li>
							<li><a href="http://www.irs.gov/pub/irs-pdf/f2290.pdf" class="blueTxt" target="_blank"><?php echo $constantArr['F2290'][$_SESSION['lang']];?></a></li>
							<li><a href="http://www.irs.gov/pub/irs-pdf/i2290.pdf" class="blueTxt" target="_blank"><?php echo $constantArr['F2290i'][$_SESSION['lang']];?></a></li>
							<li><a href="http://www.irs.gov/pub/irs-pdf/f8849.pdf" class="blueTxt" target="_blank"><?php echo $constantArr['F8849'][$_SESSION['lang']];?></a></li>
							<li><a href="http://www.irs.gov/instructions/i8849s6/index.html" class="blueTxt" target="_blank"><?php echo $constantArr['F8849S6'][$_SESSION['lang']];?></a></li>
							<li><a href="http://www.irs.gov/uac/Modernized-e-File-(MeF)-Status-Page" class="blueTxt" target="_blank"><?php echo $constantArr['irsefile'][$_SESSION['lang']];?></a></li>
							<li><a href="http://www.irs.gov/uac/Electronic-Payment-Options-Home-Page" class="blueTxt" target="_blank"><?php echo $constantArr['irspay'][$_SESSION['lang']];?></a></li>
							<li><a href="http://www.irs.gov/Businesses/Small-Businesses-&-Self-Employed/Apply-for-an-Employer-Identification-Number-(EIN)-Online" class="blueTxt" target="_blank"><?php echo $constantArr['applyEIN'][$_SESSION['lang']];?></a></li>
						</ul>
					</div>
					<div class="alignright width375px">
						<div><?php echo strtoupper($constantArr['contactus'][$_SESSION['lang']]);?></div>
						<div class="marTop10px"><strong>Simple Truck Tax - Triesten Technologies, LLC</strong></div>
						<div class="marTop5px">Westmoor Technology Park, 10955 Westmoor Drive,</div>						
						<div class="marTop5px">Suite# 4100, 4th Floor, Westminster,</div>						
						<div class="marTop5px">COLORADO - 80021, USA</div>						
						<div class="marTop15px"><?php echo $constantArr['phone'][$_SESSION['lang']];?> : 1888-361-7644</div>
						<div class="marTop5px"><?php echo $constantArr['fax'][$_SESSION['lang']];?> : +1 303 379 2100</div>
						<div class="marTop5px"><?php echo $constantArr['email'][$_SESSION['lang']];?> : <a href="mailto:info@simpletrucktax.com" class="blueTxt">info@simpletrucktax.com </a></div>
					</div>
				</div>
				<br clear="all">
				<div class="marTop30px">
					<img src="/images/footerLine.png" alt="" title="" />
					<div class="alignleft padTop40px">
						<a href="https://www.facebook.com/SimpleTruckTax" target="_blank" class="faceBook-icon" alt="Facebook" title="Facebook"></a>
						<a href="https://twitter.com/SimpleTruck" target="_blank" class="twitTer-icon"alt="Twitter" title="Twitter"></a>
						<a href="http://www.linkedin.com/company/simpletrucktax-com?trk=company_name" target="_blank" class="linkedIn-icon" alt="Linkedin" title="Linkedin"></a>
						<a href="http://www.pinterest.com/simpletrucktax/" target="_blank" class="pinterest-icon" alt="Pinterest" title="Pinterest"></a>
						<a href="https://www.youtube.com/watch?v=k_-_bRH9GLM" target="_blank" class="yt-icon" alt="youTube" title="youTube"></a>
					</div>
					<div class="alignright marTop15px">
						<div class="alignleft padRight20px padTop5px"><img src="/images/irs-icon.png"/></div>
						<!--<div class="alignleft anLogo-icon">&nbsp;</div>
						<div class="alignleft ataLogo-icon"></div>
						<div class="alignleft nortonLogo-icon">&nbsp;</div>-->
						<div class="alignleft">
							<!-- (c) 2005, 2014. Authorize.Net is a registered trademark of CyberSource Corporation --> 
							<div class="AuthorizeNetSeal"> 
								<script type="text/javascript" language="javascript">var ANS_customer_id="096f10c0-3ffa-4dab-bd07-1e6e60d845e2";</script> 
								<script type="text/javascript" language="javascript" src="//verify.authorize.net/anetseal/seal.js" ></script> 
								<a href="http://www.authorize.net/" id="AuthorizeNetText" target="_blank">Merchant Services</a> 
							</div>
						</div>				
						<div class="alignleft">
							<table width="135" border="0" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose Symantec SSL for secure e-commerce and confidential communications.">
								<tr>
									<td width="135" align="center" valign="top">
										<script type="text/javascript" src="https://seal.verisign.com/getseal?host_name=www.simpletrucktax.com&amp;size=S&amp;use_flash=NO&amp;use_transparent=NO&amp;lang=en"></script><br />
										<a href="http://www.symantec.com/verisign/ssl-certificates" target="_blank"  style="color:#000000; text-decoration:none; font:bold 7px verdana,sans-serif; letter-spacing:.5px; text-align:center; margin:0px; padding:0px;">ABOUT SSL CERTIFICATES</a>
									</td>
								</tr>
							</table>
						</div>
						<br clear="all">
					</div>
				</div>
				<br clear="all">
				<div class="marTop15px">
					<img src="/images/footerLine.png" alt="" title="" />
					<div class="marTop10px alignleft">&#169; 2014 www.simpletrucktax.com</div>
				</div>
			</div>	
			<br clear="all"/>
			<br clear="all"/>
		</div>
		<!---------footer section ends here------------>
		<script type="text/javascript">
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-47863962-1', 'simpletrucktax.com');
			ga('send', 'pageview');
		</script>
	</body>
	<!----------body section ends here--------------->
</html>
