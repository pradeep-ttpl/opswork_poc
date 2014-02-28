<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : config.php
 * @version  : 1.0
 * @date  : 12-Jul-2012
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           12-Jul-2012           Initial Version - File Created
 * 
 */

/********************
 *	Error Reporting	*
 ********************/ 
 
ini_set('display_errors','0');


/****************************
 *	Session Intialization	*
 ****************************/
session_start();
if(!isset($_SESSION['lang'])){
	$_SESSION['lang'] = 'EN';
}

/********************************************
 *	Database Connection Constant Variables	*
 ********************************************/

/*** Staging Credentials ***/
$MYSQL_SERVER   = "stt-staging.c12zhafzwriw.us-east-1.rds.amazonaws.com";
$MYSQL_PORT     = "3306";
$MYSQL_USER     = "sttmysql";
$MYSQL_PASSWORD = "sttmysql";
$MYSQL_DATABASE = "stt_staging";

/*** Demo server Credentials ***/
$MYSQL_SERVER 	= "115.160.224.175";
$MYSQL_PORT 	= "15364";
$MYSQL_USER 	= "root";
$MYSQL_PASSWORD = "39*tic0";
$MYSQL_DATABASE = "simpletrucktax_v1";
//$MYSQL_DATABASE = "simpletruck3";

/****************************************
 *	Database Conection Establishment	*
 ****************************************/
try {
  global $DBH;
  $DBH = new PDO("mysql:host=$MYSQL_SERVER;port=$MYSQL_PORT;dbname=$MYSQL_DATABASE",$MYSQL_USER,$MYSQL_PASSWORD);
}
catch(PDOException $e) {
    echo $e->getMessage();
}

/********************************************
 *	Authorize.net Payment Gateway Variables	*
 ********************************************/

// Production account
/*define('TT_AUTHORIZE_URL', 'https://secure.authorize.net/gateway/transact.dll');
define('TT_AUTHORIZE_ID', '8YZn5Ws35yG');
define('TT_AUTHORIZE_TRANSACTION_KEY', '24p65Yf8r33UT2Q3');*/

// Test account details
define('TT_AUTHORIZE_URL', 'https://test.authorize.net/gateway/transact.dll');
define('TT_AUTHORIZE_ID', '9C3gQjsE4UDW');
define('TT_AUTHORIZE_TRANSACTION_KEY', '5433zgBn44Gg7RyP');

define('TT_AUTHORIZE_TEST_MODE', 'FALSE');
define('TT_AUTHORIZE_RETURN_URL', 'http://'.$_SERVER['SERVER_NAME'].'/include/authorize_payment_success.php');
define('TT_AUTHORIZE_DESC', 'TEST TRANSACTION');


/********************************************
 *	Facebook API Integration Credientials	*
 ********************************************/

/*define('TT_FB_CLIENT_ID', '1406227362949364');
define('TT_FB_CLIENT_SECRET_ID', '6dd154f03644fda81e79bc49b3cd89fd');*/

/*** Staging Credentials ***/

/*define('TT_FB_CLIENT_ID', '1385243068403340');
define('TT_FB_CLIENT_SECRET_ID', '680bdb4832d25d5ad2c265ec562891f0');*/

/*** Demo server Credentials ***/
// demo.simpletrucktax.com Facebook API Integration Credientials //
define('TT_FB_CLIENT_ID', '740486265963991');
define('TT_FB_CLIENT_SECRET_ID', '25eeef34d363a9b855ad48af3c12258c');

/****************************************************************************************************
 *	IRS - XML file path configuration for Manual Generated Submission and Completed Submission		*
 ****************************************************************************************************/

//$API_SERVER = "10.10.1.27:8080/trucktax";

/*** Staging Credentials ***/

//$API_SERVER = "54.84.4.105:8080/trucktax";

/*** Demo server Credentials ***/

$API_SERVER = "115.160.224.171:7272/trucktaxdemo";

/*define('XSD_VALIDATION_PATH','http://'.$API_SERVER.'/json/trucktax/validate2290xml/');
define('GENERATE_SUBMISSION_XML_PATH','http://'.$API_SERVER.'/json/trucktax/get2290XML/');
define('IRS_SUBMISSION_PATH','http://'.$API_SERVER.'/json/trucktax/submitTax2290/');
define('GET_ACKNOWLEDGMENT_PATH','http://'.$API_SERVER.'/json/trucktax/getAcknowledgment/');
define('GET_SCHEDULE1_PATH','http://'.$API_SERVER.'/json/trucktax/get2290Schedule1/');
define('XML4PDF_PATH','http://'.$API_SERVER.'/json/trucktax/irspdfxml/');
*/
define('XSD_VALIDATION_PATH','http://'.$API_SERVER.'/json/trucktax/validateXML/');
define('GENERATE_SUBMISSION_XML_PATH','http://'.$API_SERVER.'/json/trucktax/getXML/');
define('IRS_SUBMISSION_PATH','http://'.$API_SERVER.'/json/trucktax/irsSubmission/');
//define('GET_ACKNOWLEDGMENT_PATH','http://'.$API_SERVER.'/json/trucktax/getAcknowledgment/');
//define('GET_SCHEDULE1_PATH','http://'.$API_SERVER.'/json/trucktax/get2290Schedule1/');

/**** To enable/disable registration *****/
define('DISABLE_REGISTRATION', '0');

/*** NFS shared drive path ****/
define('TT_NFS_DRIVE', '/opt/nfsdrv/');
define('TT_SITE_NAME', 'http://'.$_SERVER['SERVER_NAME'].'/');

/*** Encrpty-decrypt id and key ***/
define('CRYPTO_ID','fedcba9876543210');
define('CRYPTO_KEY','0123456789abcdef');

?>
