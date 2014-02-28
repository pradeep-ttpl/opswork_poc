<?php 
include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/constants.php');
include_once (TT_INCLUDE_PATH.'/MCrypt.php');

$MCrypt	= new MCrypt;

$splitValues = explode('.',$MCrypt->decrypt($_REQUEST['name']));
$filename = $MCrypt->decrypt($_REQUEST['name']);

// Chnage file path according to type
if(isset($_REQUEST['type']) && $_REQUEST['type'] == "schedule1")
{
	$file = TT_SCHEDULE1_PATH.$filename;
}
else 
{
	$file = TT_UPLOAD_PATH.$filename;
}

if($splitValues[1] == 'doc')
	$contentType = 'application/msword';
else if($splitValues[1] == 'pdf')
	$contentType = 'application/pdf';

if (file_exists($file)) {
    header('Content-Type: '.$contentType);
    header('Content-Disposition: attachment; filename='.basename($filename));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}
else
{
	echo "File not found!";
}
?>
