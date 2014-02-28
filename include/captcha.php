<?php
header("Content-type: image/jpeg");
session_start();	
$ranStr = md5(microtime());
$ranStr = substr($ranStr, 0, 6);
$_SESSION['captcha'] = $ranStr;
$newImage = imagecreatefromjpeg("../images/captcha.jpg");
$txtColor = imagecolorallocate($newImage, 0, 0, 0);
imagestring($newImage, 5, 5, 5, $ranStr, $txtColor);
imagejpeg($newImage);
?>