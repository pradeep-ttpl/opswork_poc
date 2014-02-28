<?php
/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : constants.php
 * @version  : 1.0
 * @date  : 12-Jul-2012
 *
 * @description :
 *
 * @author      : Ramya
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          -------------------------------------------
 * Ramya               	 12-Jul-2012           Initial Version - File Created
 * 
 */

/******************** 
 * GLOBAL VARIABLES *
 ********************/

define('SITE_TITLE', 'Simple Truck Tax');
$site_path = realpath(dirname(__FILE__));
define('TT_SITE_PATH', $site_path);
define('TT_MODEL_PATH', TT_SITE_PATH.'/model');
define('TT_ENTITY_PATH', TT_SITE_PATH.'/entity');
define('TT_CONTROLLER_PATH', TT_SITE_PATH.'/controller');
define('TT_VIEW_PATH', TT_SITE_PATH.'/views');
define('TT_INCLUDE_PATH', TT_SITE_PATH.'/include');
define('TT_IMAGE_PATH', TT_SITE_PATH.'/images/');
define('TT_BIZ_SUFFIX', '_biz');
define('TT_DAO_SUFFIX', '_entity');
define('TT_UI_SUFFIX', '_ui');
define('TT_UPLOAD_PATH', TT_NFS_DRIVE.'binary_attachment/');
define('TT_SCHEDULE1_PATH', TT_NFS_DRIVE.'schedule1/');
define('TT_XML_INPUT_PATH', TT_NFS_DRIVE.'filing/input/');
/**************************** 
 *	ADMIN GLOBAL VARIABLES	*
 ****************************/

define('TT_ADMIN_SITE_PATH', $site_path.'/admin');
define('TT_ADMIN_MODEL_PATH', TT_ADMIN_SITE_PATH.'/model');
define('TT_ADMIN_ENTITY_PATH', TT_ADMIN_SITE_PATH.'/entity');
define('TT_ADMIN_CONTROLLER_PATH', TT_ADMIN_SITE_PATH.'/controller');
define('TT_ADMIN_VIEW_PATH', TT_ADMIN_SITE_PATH.'/views');
define('TT_ADMIN_INCLUDE_PATH', TT_ADMIN_SITE_PATH.'/include');
define('TT_ADMIN_SITE_NAME', 'http://'.$_SERVER['SERVER_NAME'].'/admin/');
define('TT_ADMIN_IMAGE_PATH', TT_ADMIN_SITE_NAME.'/images');
define('TT_ADMIN_BIZ_SUFFIX', '_biz');
define('TT_ADMIN_DAO_SUFFIX', '_entity');
define('TT_ADMIN_UI_SUFFIX', '_ui');

/**************************** 
 *	EMAILS	*
 ****************************/

define('TT_ALERT_MAIL_FROM', 'support@simpletrucktax.com');
define('TT_ALERT_MAIL_TO', 'dev@simpletrucktax.com');
define('TT_SUPPORT_EMAIL', 'support@simpletrucktax.com');

/************************************************************************************
 *	Tax calculations - Partial tax calculation of user selected month.				*
 *	Months value and counts are specified as mentioned in Instructions form 2290	*
 ************************************************************************************/

	global $taxmonthAry,$monthAry;
	$taxmonthAry = array();
	$monthAry = array();
	$taxmonthAry = array("July"=>12,"August"=>11,"September"=>10,"October"=>9,"November"=>8,"December"=>7,
					  "January"=>6,"February"=>5,"March"=>4,"April"=>3,"May"=>2,"June"=>1);
	$monthAry 	 = array("01"=>"January", "02"=>"February", "03"=>"March", "04"=>"April", "05"=>"May", "06"=>"June",
					  "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December");
	
/********************************************************************
 *	Global array for Tax Forms Side Bar To Highlight Selected Tab	*
 ********************************************************************/
	
	global $taxFormsNameArray;
	$taxFormsNameArray 	= array(
							
							/* Display Name */								/* Tax Form URL Link ( File Name ) */
							'Taxable Vehicle Information' 					=> 'taxablevehicleinfo',
							'Reporting Suspended / Exempt Vehicles' 		=> 'currentyrsuspend',
							'Prior Year Suspended/Exempt Vehicles' 			=> 'prioryrsuspend',
							'Sold, Destroyed or Stolen Vehicles(Credit)'	=> 'solddestroycredit',
							'Low Mileage Vehicles(Credit)' 					=> 'lowmileagecredit',
							'Credit for an overpayment of tax'				=> 'overpayment',
							'Taxable Gross Weight Increase' 				=> 'tgwincreased',
							'VIN Correction'				 				=> 'vincorrection',
							'VIN Correction List'			 				=> 'vincorrectionlist'
							
						);


							
/****************************************************************
 *	Global array for Header Page Title, Fancybox, Datepicker	*
 ***************************************************************/


	global $pageArray,$fancyBoxArray,$dateLoadArray,$scrollArray;
	
	$fancyBoxArray = array('taxablevehicleinfo','currentyrsuspend','prioryrsuspend','solddestroycredit','lowmileagecredit',
						   'overpayment','tgwincreased','fleet','summary','exceededmileage','register','forgotpassword',
						   'productpayment','paymentsuccess','vincorrection');
	$dateLoadArray = array('prioryrsuspend','solddestroycredit','lowmileagecredit','overpayment','taxyear');
	$scrollArray = array('taxablevehicleinfo','currentyrsuspend','prioryrsuspend','solddestroycredit','lowmileagecredit','overpayment','tgwincreased','exceededmileage','vincorrection','vincorrectionlist');
	
	if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'EN'){
		$pageArray = array('aboutus'=>'About Us','service'=>'Our Services','pricing'=>'Pricing','faq'=>'FAQs','contactus'=>'Contact Us',
					'register'=>'Registration','forgotpassword'=>'Reset Password','taxpayerbusiness'=>'My Businesses',
					'addbusiness'=>'Add New Business','taxyear'=>'Tax Filing','solddestroycredit'=>'Sold, Destroyed or Stolen Vehicles',
					'taxablevehicleinfo'=>'Taxable Vehicle Information','lowmileagecredit'=>'Low Mileage Credits',
					'filestatus'=>'My Return Status','overpayment'=>'Over Payment Credits','tgwincreased'=>'Taxable Gross Weight Increase',
					'fleet' => 'Vehicle/Fleet Information','summary'=>'Summary','paymentoption'=>'Select IRS Payment Option','prioryrsuspend'=>'Prior Year Suspended/Exempt Vehicles',
					'currentyrsuspend'=>'Reporting Suspended / Exempt Vehicles','termsandconditions'=>'Terms and Conditions',
					'exceededmileage' => 'Exceeded Mileage Vehicles','productpayment'=>'Submission Fee','paymentsuccess'=>'IRS Submission','filingsummary'=>'Re-submitting User Filing Summary','irssubmission'=>'IRS Submission',
					'myaccount'=>'My Account','paymenttransaction'=>'My Transactions','vincorrection'=>'VIN Correction','vincorrectionlist'=>'VIN Correction List',
					'privacypolicy'=>'Privacy Policy');	
	}else if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'SP'){
		$pageArray = array('aboutus'=>'About Us','service'=>'Our Services','pricing'=>'Pricing','faq'=>'FAQs','contactus'=>'Contact Us',
					'register'=>'Registration','forgotpassword'=>'Reset Password','taxpayerbusiness'=>'My Businesses',
					'addbusiness'=>'Add New Business','taxyear'=>'Tax Filing','solddestroycredit'=>'Sold, Destroyed or Stolen Vehicles',
					'taxablevehicleinfo'=>'Taxable Vehicle Information','lowmileagecredit'=>'Low Mileage Credits',
					'filestatus'=>'My Return Status','overpayment'=>'Over Payment Credits','tgwincreased'=>'Taxable Gross Weight Increased',
					'fleet' => 'Vehicle/Fleet Information','summary'=>'Summary','paymentoption'=>'Select IRS Payment Option','prioryrsuspend'=>'Prior Year Suspended/Exempt Vehicles',
					'currentyrsuspend'=>'Reporting Suspended / Exempt Vehicles','termsandconditions'=>'Terms and Conditions',
					'exceededmileage' => 'Exceeded Mileage Vehicles','productpayment'=>'Submisstion Fee','paymentsuccess'=>'IRS Submission','filingsummary'=>'Re-submitting User Filing Summary','irssubmission'=>'IRS Submission',
					'myaccount'=>'My Account','paymenttransaction'=>'My Transactions','vincorrection'=>'VIN Correction','vincorrectionlist'=>'VIN Correction List',
					'privacypolicy'=>'Privacy Policy');		
	}
	
/****************************************************************
 *	Global array for image upload types	*
 ***************************************************************/
	
	global $docAllowedTypes;
	$docAllowedTypes = array('application/pdf');


global $constantArr;

$constantArr = array
				(
					'home' =>	array
									(
										'EN' => 'Home',
										'SP' => 'INICIO'
									),
					'aboutus' =>	array
									(
										'EN' => 'About Us',
										'SP' => 'ACERCA DE EE.UU.'
									),
					'ourservices' =>	array
									(
										'EN' => 'Our Services',
										'SP' => 'Our Services'
									),
					'pricing' =>	array
									(
										'EN' => 'Pricing',
										'SP' => 'Pricing'
									),
					'faq' =>	array
									(
										'EN' => 'FAQ',
										'SP' => 'FAQ'
									),
					'contactus' =>	array
									(
										'EN' => 'Contact Us',
										'SP' => 'Contact Us'
									),
					'myaccount' =>	array
									(
										'EN' => 'My Account',
										'SP' => 'My Account'
									),							
					'myfilings' =>	array
									(
										'EN' => 'My Filings',
										'SP' => 'My Filings'
									),
					'admindashboard' =>	array
									(
										'EN' => 'Admin Dashboard',
										'SP' => 'Admin Dashboard'
									),
					'registerhere' =>	array
									(
										'EN' => 'Register here',
										'SP' => 'Register here'
									),
					'livechat' =>	array
									(
										'EN' => 'Live Chat',
										'SP' => 'Live Chat'
									),
					'regconf' =>	array
									(
										'EN' => 'Registration Confirmation',
										'SP' => 'Registration Confirmation'
									),
					'mybussiness' =>	array
									(
										'EN' => 'My Businesses',
										'SP' => 'My Businesses'
									),
					'myvehicles' =>	array
									(
										'EN' => 'My Vehicles',
										'SP' => 'My Vehicles'
									),
					'myreturnstatus' =>	array
									(
										'EN' => 'My Return Status',
										'SP' => 'My Return Status'
									),
					'privacypolicy' =>	array
									(
										'EN' => 'Privacy Policy',
										'SP' => 'Privacy Policy'
									),
					'tc' =>	array
									(
										'EN' => 'Terms & Conditions',
										'SP' => 'Terms & Conditions'
									),
					'efileF2290' =>	array
									(
										'EN' => 'E-file Form 2290',
										'SP' => 'E-file Form 2290'
									),
					'taxpreparer' =>	array
									(
										'EN' => 'Tax Preparer',
										'SP' => 'Tax Preparer'
									),
					'hvutp' =>	array
									(
										'EN' => 'HVUT Penalties',
										'SP' => 'HVUT Penalties'
									),
					'F2290S1' =>	array
									(
										'EN' => 'Form 2290 Schedule 1',
										'SP' => 'Form 2290 Schedule 1'
									),
					'F8849' =>	array
									(
										'EN' => 'Form 8849',
										'SP' => 'Form 8849'
									),
					'irspay' =>	array
									(
										'EN' => 'IRS Payment',
										'SP' => 'IRS Payment'
									),
					'vincorrection' =>	array
									(
										'EN' => 'VIN Corrections',
										'SP' => 'VIN Corrections'
									),
					'irsgov' =>	array
									(
										'EN' => 'IRS.GOV',
										'SP' => 'IRS.GOV'
									),
					'F2290' =>	array
									(
										'EN' => 'Form 2290',
										'SP' => 'Form 2290'
									),
					'F2290i' =>	array
									(
										'EN' => 'Form 2290 Instructions',
										'SP' => 'Form 2290 Instructions'
									),
					'F8849S6' =>	array
									(
										'EN' => 'Form 8849 Schedule 6',
										'SP' => 'Form 8849 Schedule 6'
									),
					'irsefile' =>	array
									(
										'EN' => 'IRS e-file system status',
										'SP' => 'IRS e-file system status'
									),
					'applyEIN' =>	array
									(
										'EN' => 'Apply EIN Online',
										'SP' => 'Apply EIN Online'
									),
					'phone' =>	array
									(
										'EN' => 'Phone',
										'SP' => 'Phone'
									),
					'fax' =>	array
									(
										'EN' => 'Fax',
										'SP' => 'Fax'
									),
					'file2290' =>	array
									(
										'EN' => 'FILE 2290',
										'SP' => 'ARCHIVO  2290'
									),
					'signup' =>	array
									(
										'EN' => 'Sign up',
										'SP' => 'REGÍSTRATE'
									),
					'login' =>	array
									(
										'EN' => 'Login',
										'SP' => 'LOGIN'
									),
					'loginhere' =>	array
									(
										'EN' => 'Login here',
										'SP' => 'Login here'
									),
					'callus' => array
									(			
										'EN' => 'Call us',
										'SP' => 'Llámenos'
									),
					'search' => array
									(			
										'EN' => 'Search Here',
										'SP' => 'Consulta aquí'
									),
					'welcome' => array
									(
										'EN' => 'Welcome',
										'SP' => 'bienvenida'
									),
					'administrator' => array
									(
										'EN' => 'Administrator',
										'SP' => 'administrador'
									),
					'logout' => array
									(
										'EN' => 'Logout',
										'SP' => 'Cerrar sesión'
									),
					'successlogin' => array
									(
										'EN' => 'Last Successful Login',
										'SP' => 'Inicio de sesión satisfactorio última'
									),
					'accountactivated' => array
									(
										'EN' => 'Your account has been activated successfully',
										'SP' => 'Your account has been activated successfully'
									),
					'accountalreadyactivated' => array
									(
										'EN' => 'You account has been already activated',
										'SP' => 'You account has been already activated'
									),
					'continuetologin' => array
									(
										'EN' => 'Continue to Login',
										'SP' => 'Continue to Login'
									),
					'failurelogin' => array
									(
										'EN' => 'Last Unsuccessfull Login',
										'SP' => 'Fallidos de ingresar al último'
									),
					'tax' => array
									(
										'EN' => 'Tax',
										'SP' => 'impuesto'
									),
					'credit' => array
									(
										'EN' => 'Credit',
										'SP' => 'crédito'
									),
					'total' => array
									(
										'EN' => 'Total',
										'SP' => 'Cantidad'
									),
					'back' => array
									(			
										'EN' => 'Back to Top',
										'SP' => 'Volver al principio'
									),
					'goback' => array
									(			
										'EN' => 'Back',
										'SP' => 'VOLVER'
									),
					'triesten' => array
									(			
										'EN' => 'Triesten, Inc',
										'SP' => 'Triesten, Inc'
									),
					'rights' => array
									(			
										'EN' => '2011 All rights reserved',
										'SP' => '2011  Todos los derechos reservados'
									),
					'sitelink' => array
									(			
										'EN' => 'www.simpletrucktax.com',
										'SP' => 'www.simpletrucktax.com'
									),		
					'dashboard' => array
									(			
										'EN' => 'Filing',
										'SP' => 'ARCHIVO'
									),
																				
					'registerlbl' => array
									(
										'EN' => 'New User Registeration',
										'SP' => 'Registeration  Nuevo usuario'
									),
					'select_country' => array
										(
											'EN' => 'Select Country',
										    'SP' => 'Seleccione el país'
										),
					'reg_country' =>	array
									(
										'EN' => 'Country',
										'SP' => 'País'
									),
					'first_name' =>	array
									(
										'EN' => 'First Name',
										'SP' => 'Nombre'
									),
					'last_name' =>	array
									(
										'EN' => 'Last Name',
										'SP' => 'apellido'
									),
					'email' =>	array
									(
										'EN' => 'Email',
										'SP' => 'e-mail'
									),
					'password' =>	array
									(
										'EN' => 'Password',
										'SP' => 'contraseña'
									),
					'confirm_password' =>	array
									(
										'EN' => 'Confirm Password',
										'SP' => 'Confirmar Contraseña'
									),
					'secret_question' =>	array
									(
										'EN' => 'Secret Question',
										'SP' => 'Pregunta secreta'
									),
					'secret_answer' =>	array
									(
										'EN' => 'Secret Answer',
										'SP' => 'Respuesta secreta'
									),
					'phone_number' =>	array
									(
										'EN' => 'Phone Number',
										'SP' => 'número de teléfono'
									),
					'verification_code' =>	array
									(
										'EN' => 'Verification Code',
										'SP' => 'Código de Verificación'
									),
					'term_condition' =>	array
									(
										'EN' => 'I have read and accept <a id="various3" href="views/term_condition_ui.php">Terms & conditions</a>',
										'SP' => 'He leído y acepto <a id="various3" href="views/term_condition_ui.php">Términos y condiciones</a>'
									),
					'registerbtn' =>	array
									(
										'EN' => 'Register',
										'SP' => 'REGISTRO'
									),
					'Clearlbl' =>	array
									(
										'EN' => 'Clear',
										'SP' => 'claro'
									),
					'cancelbtn' =>	array
									(
										'EN' => 'Cancel',
										'SP' => 'CANCELAR'
									),									
					'loginlbl' => array
									(
										'EN' => 'Sign in',
										'SP' => 'ingresar'
									),					
					'signinbtn' =>	array
									(
										'EN' => 'Sign in',
										'SP' => 'MI CUENTA'
									),
					'newuser' => array
									(
										'EN' => 'New User?',
										'SP' => '¿Nuevo usuario?'
									),
					'register' => array
									(
										'EN' => 'Register Here',
										'SP' => 'Aqui'
									),
					'forgotpwd'	=> array
									(
										'EN' => 'Forgot Password please <a class="blueTxt" href="/forgotpassword/">Click here</a>',
										'SP' => '¿Olvidó su contraseña por favor <a href="/forgotpassword/">haga clic aquí</a>'
									),
					'forgotpwdlbl' => array
									(
										'EN' => 'Forgot Password',
										'SP' => '¿Olvidó su contraseña'
									),
					'submitbtn' =>	array
									(
										'EN' => 'Submit',
										'SP' => 'ENVIAR'
									),
					'changepwdlbl' => array
									(
										'EN' => 'Change Password',
										'SP' => 'cambio de contraseña'
									),
					'newpassword' =>	array
									(
										'EN' => 'New Password',
										'SP' => 'nueva  Contraseña'
									),
					'bizinfolbl' => array
									(
										'EN' => 'Business Information',
										'SP' => 'Información Empresarial'
									),
					'biz_name' =>	array
									(
										'EN' => 'Business Name',
										'SP' => 'Nombre del Negocio'
									),
					'biz_type' =>	array
									(
										'EN' => 'Select Business Type',
										'SP' => 'Seleccione  Tipo de Negocio'      
									),
					'biz_EIN' =>	array
									(
										'EN' => 'EIN',
										'SP' => 'loyoN'
									),
					'biz_address1' =>	array
									(
										'EN' => 'Address Line 1',
										'SP' => 'Dirección Línea 1'
									),
					'biz_address2' =>	array
									(
										'EN' => 'Address Line 2',
										'SP' => 'Dirección Línea 2'
									),
					'biz_country' =>	array
									(
										'EN' => 'Country',
										'SP' => 'País'
									),
					'biz_state' =>	array
									(
										'EN' => 'State / Province',
										'SP' => 'Estado / Provincia'
									),
					'biz_city' =>	array
									(
										'EN' => 'City/ Town',
										'SP' => 'Ciudad / Pueblo'
									),				
					'biz_zipcode' =>	array
									(
										'EN' => 'Zip / Postal Code',
										'SP' => 'Zip / Código Postal'
									),
					'biz_phone' =>	array
									(
										'EN' => 'Business Phone Number',
										'SP' => 'Número de teléfono de'
									),
					'sign_authority' =>	array
									(
										'EN' => 'Signing Authority Name',
										'SP' => 'Firmar el nombre de Autoridad'
									),
					'sign_auth_phone' =>	array
									(
										'EN' => 'Signing Authority Phone Number',
										'SP' => 'Número de Teléfono de la firma de la Autoridad'
									),
					'savebtn' =>	array
									(
										'EN' => 'Save',
										'SP' => 'GUARDAR'
									),
					'continuebtn' =>	array
									(
										'EN' => 'Continue',
										'SP' => 'Continuar'
									),
					'select' => array
									(
										'EN' => 'Select',
										'SP' => 'seleccionar'
									),
					'selectBusissType' => array
									(
										'EN' => 'Select Type',
										'SP' => 'seleccionar Type'
									),
					'selectedBusiness' =>	array
									(
										'EN' => 'Selected Business',
										'SP' => 'Negocios seleccionado'
									),
					'edit' => array
										(
											'EN' => 'Edit',
										    'SP' => 'editar'
										),	
					'delete' => array
										(
											'EN' => 'Delete',
										    'SP' => 'borrar'
										),
					'view' => array
										(
											'EN' => 'View',
										    'SP' => 'Vista'
										),
					'consentdiscloseragreement' => array
										(
											'EN' => 'Consent Disclosure Agreement',
										    'SP' => 'Vista'
										),
					'closePopup' => array
										(
											'EN' => 'Close Popup',
										    'SP' => 'Cerrar ventana emergente'
										),
					'noRecordsFound' => array
										(
											'EN' => 'No Records Found',
										    'SP' => 'Registros no encontrados'
										),
					'information' => array
										(
											'EN' => 'Information',
										    'SP' => 'Información'
										),
					'addNew' => array
										(
											'EN' => 'Add New',
										    'SP' => 'Añadir nuevo'
										),
					'updatebtn' =>	array
									(
										'EN' => 'Update',
										'SP' => 'actualizar'
									),	
					'TaxInformationlbl' => array
									(
										'EN' => 'Tax Year Information',
										'SP' => 'Información Fiscal Año'
									),
					'Step2lbl' => array
									(
										'EN' => 'Step: 2', 
										'SP' => 'Paso: 2'
									),
					'TaxYearlbl' => array
									(
										'EN' => 'Tax Year',
										'SP' => 'de impuestos del año'
									),
					'Monthlbl' =>	array
									(
										'EN' => 'First Used Month',
										'SP' => 'Mes utilizó por primera vez'
									),
					'AmendmentMonthlbl' =>	array
									(
										'EN' => 'Amendment Month',
										'SP' => 'Amendment Month'
									),
					'FinalReturnlbl' =>	array
									(
										'EN' => 'Final Return',
										'SP' => 'Final Return'
									),
					'Addlbl' =>	array
									(
										'EN' => 'Add',
										'SP' => 'Añadir'
									),
									
					'Cancellbl' =>	array
									(
										'EN' => 'Cancel',
										'SP' => 'Cancelar'
									),
					'Lastlbl' =>	array
									(
										'EN' => 'Last Return',
										'SP' => 'la última declaración de'
									),
					'continuelbl' =>	array
									(
										'EN' => 'Continue',
										'SP' => 'continuar'
									),
					'designeesNamelbl' => array
									(
										'EN' => 'Designees Name',
										'SP' => 'Nombre de la persona designada es'
									),
					'designeesPhonelbl' => array
									(
										'EN' => 'Designees Phone', 
										'SP' => 'Teléfono designada'
									),
					'designeesPinlbl' => array
									(
										'EN' => 'Designees PIN',
										'SP' => 'PIN designada'
									),
					'returnlbl' =>	array
									(
										'EN' => 'Would you like to allow an authorized person to discuss your tax return with the IRS?',
										'SP' => '¿Desea permitir que una persona autorizada para hablar sobre su declaración de impuestos con el IRS?'
									),
									
					'taxYearlbl' => array
									(
										'EN' => 'Tax Year',
										'SP' => 'de impuestos del año'
									),
					'firstUsedMonthlbl' => array
									(
										'EN' => 'First Used Month', 
										'SP' => 'Mes utilizó por primera vez'
									),
					'taxvehiinfolbl' => array
									(
										'EN' => 'Taxable Vehicle Information',
										'SP' => 'Información sobre el vehículo imponible' 
									),
					'addNewVehicle' => array
									(
										'EN' => 'Add New Vehicle',
										'SP' => 'Crear Nuevo Vehículo' 
									),
					'edittaxablevehicle' => array
									(
										'EN' => 'Edit Taxable Vehicle',
										'SP' => 'Edite Vehículo Imponible' 
									),
					'vinlbl' => array
									(
										'EN' => 'Vehicle Identification Number',
										'SP' => 'Vehículo numero de identificacion'
									),
					'grossweightlbl' =>	array
									(
										'EN' => 'Taxable Gross Weight (in lbs)',
										'SP' => 'Peso bruto tributable'
									),
					'weightlbl' =>	array
									(
										'EN' => 'Weight',
										'SP' => 'Weight'
									),
					'taxamount' =>	array
									(
										'EN' => 'Tax Amount',
										'SP' => 'Importe de impuesto'
									),
					'creditamountlbl' =>	array
									(
										'EN' => 'Credit Amount',
										'SP' => 'Vehículos de registro'
									),
					'yeslbl' =>	array
									(
										'EN' => 'Yes',
										'SP' => 'sí'
									),
					'nolbl' =>	array
									(
										'EN' => 'No',
										'SP' => 'not'
									),
					'updatelbl' =>	array
									(
										'EN' => 'Update',
										'SP' => 'ACTUALIZACIÓN'
									),
					'Filterlbl' =>	array
									(
										'EN' => 'Filter',
										'SP' => 'filtro'
									),
					'SelectWeightlbl' =>	array
									(
										'EN' => 'Select Weight',
										'SP' => 'Seleccione Peso'
									),
					'SelectMonthlbl' =>	array
									(
										'EN' => 'Select Month',
										'SP' => 'Select Month'
									),
					'SelectBusinesslbl' =>	array
									(
										'EN' => 'Select Business',
										'SP' => 'Select Business'
									),
					'License' =>	array
									(
										'EN' => 'License',
										'SP' => 'licencia'
									),
					'SelectLiscenselbl' =>	array
									(
										'EN' => 'Select License',
										'SP' => 'Seleccione Liscense'
									),
					'Recordslbl' =>	array
									(
										'EN' => 'Records',
										'SP' => 'archivos'
									),
					'EntriesPerPagelbl' =>	array
									(
										'EN' => 'Entries Per Page',
										'SP' => 'Entradas por página'
								),
					'PreviousCategorylbl' =>	array
									(
										'EN' => 'Previous Category',
										'SP' => 'Categoría anterior'
									),
					'ChangingToCategorylbl' =>	array
									(
										'EN' => 'Changed Category',
										'SP' => 'Cambiada Categoría'
									),
					'taxablevehicleNotes' =>	array
									(
										'EN' => 'Report the vehicles that are taxable. A heavy vehicle used on the public highway is said to be taxable if it is used during the tax period with the taxable gross weight of 55,000 pounds or more.',
										'SP' => 'Informar de los vehículos que están sujetos a impuestos. Un vehículo pesado utilizado en la vía pública se dice que es imponible si se usa durante el período impositivo, con el peso bruto tributable de 55,000 libras o más.'
									),
					'vincorrectionlist' =>	array
									(
										'EN' => 'Report the vehicle identification number for correction.',
										'SP' => 'Report the vehicle identification number for correction.'
									),		
					'curentsuspendnotes' =>	array
									(
										'EN' => 'Please report the vehicles that are suspended or excempt from tax for the current year. A vehicle is said to be suspended from the tax, if 
												 it is expected to be used less then mileage use limit of 5000 miles or less ( 7500 mileage or less for agricultural vehicles ). ',
										'SP' => 'Por favor, informe a los vehículos que están suspendidos o excempt del impuesto del año en curso. Un vehículo se dice que está suspendido 
												 del impuesto, si se espera que sea utilizado menos de uso límite de millaje de 5000 millas o menos (7,500 millas o menos de los vehículos agrícolas).'
									),
				    'curentsuspendyearbl' =>	array
									(
										'EN' => 'Current Year Suspended Vehicle Information',
										'SP' => 'Este año suspendido Información del Vehículo'
									),
					'Logginglbl' =>	array
									(
										'EN' => 'Is the Vehicle used for Logging',
										'SP' => 'Es el vehículo utilizado para el registro'
									),
					'logging' =>	array
									(
										'EN' => 'Logging',
										'SP' => 'tala'
									),
					'agrilbl' =>array
									(
										'EN' => 'Is the Vehicle an agricultural Vehicle',
										'SP' => 'Es el vehículo de un vehículo agrícola'
									),
					'logingcurentyearlbl' =>array
									(
										'EN' => 'Logging Vehicle',
										'SP' => 'registro de Vehículos'
									), 
					'agricurentyearlbl' =>array
									(
										'EN' => 'Agricultural Vehicle',
										'SP' => 'vehículo agrícola'
									),
					'pryrsusvehiinfolbl' => array
									(
										'EN' => 'Prior Year Suspended Vehicle Information',
										'SP' => 'Antes de Año vehículo suspendido de Información'
									),
					'prioryrsoldtrnsfdlbl' =>	array
									(
										'EN' => 'Prior Year Sold/Transferred',
										'SP' => 'Del año anterior vendidas / transferidas'
									),
					'soldlbl' =>	array
									(
										'EN' => 'Sold',
										'SP' => 'vendido'
									),
					'transferedlbl' =>	array
									(
										'EN' => 'Transferred',
										'SP' => 'transferido'
									),
					'soldtranstolbl' =>	array
									(
										'EN' => 'Sold / Transferred To',
										'SP' => 'Vendido / Transferencia al'
									),
					'buyernamelbl' =>	array
									(
										'EN' => 'Buyer Name',
										'SP' => 'Nombre del Comprador'
									),
					'dateoftranslbl' =>	array
									(
										'EN' => 'Date of Transfer / Sold',
										'SP' => 'Fecha de la transferencia / vendido'
									),
					'exceededmileage' =>	array
									(
										'EN' => 'Exceeded Mileage',
										'SP' => 'Kilometraje excedido'
									),
					'buyerortransfer' =>	array
									(
										'EN' => 'Buyer Name / Transferred',
										'SP' => 'Nombre del Comprador / transferido'
									),
					'priorinfo' =>	array
									(
										'EN' => 'Any vehicle reported as suspended in the previous tax period, 
										 should be reported if it has exceeded the mileage use limit of 5000 miles
										 or less ( 7500 miles or less for argiculture vehicle) or sold or otherwise 
										 transferred ',
										'SP' => 'Cualquier vehículo reportado como suspendido en el período 
										impositivo anterior, debe informar si se ha excedido el límite de millaje 
										de uso de 5000 millas o menos (7500 millas o menos de los vehículos argiculture) 
										o vendido o transferido de otro modo'
									),
					'consentlbl' => array
									(
										'EN' => 'Consent to Disclosure',
										'SP' => 'El consenido de la divulgación'
									),
					'consentdisclose' => array
									(
										'EN' => 'I agree to give my consent to disclose the information on Form 2290 and Schedule 1.',
										'SP' => 'Me comprometo a dar mi consentimiento para revelar la información en la Forma 2290 y la Lista 1.'
									),
					'para1' => array
									(			
										'EN' =>'I hereby give consent to the Internal Revenue Service (IRS) disclosing 
												information about my payment of the Heavy Highway Vehicle Use Tax (HVUT) 
												for the tax period listed above to the federal Department of Transportation 
												(DOT), U.S. Customs and Border Protection (CBP), and to state Departments 
												of Motor Vehicles (DMV). The information disclosed to the DOT, CBP, and state 
												DMVs will be my Vehicle Identification Number (VIN) and verification that 
												I have paid the HVUT. The IRS may disclose the information to the DOT, CBP, 
												and to the DMVs of the 50 states and the District of Columbia who have other 
												taxing, registration, or information collecting authority. I agree that the 
												American Association of Motor Vehicle Administrators (AAMVA), a third-party 
												nonprofit organization, may be used as an intermediary to transmit my VIN and 
												payment information from the IRS to the state DMVs.',
									
										'SP' => 'Yo doy consentimiento para el Servicio de Rentas Internas (IRS) revelar 
												información sobre el pago del impuesto de uso pesado de carretera del vehículo (HVUT) 
												para el período impositivo enumerados anteriormente al Departamento de Transportación 
												Federal (DOT), EE.UU. Aduanas y Protección Fronteriza (CBP ), así como establecer los 
												Departamentos de Vehículos Motorizados (DMV). La información compartida con el Departamento
												de Transporte, el CBP y DMV del estado va a ser mi Número de Identificación Vehicular (VIN)
												y la comprobación de que he pagado el HVUT. El IRS puede revelar la información al 
												Departamento de Transporte, la CBP, así como a los DMV de los 50 estados y el Distrito 
												de Columbia que tienen otros impuestos, registro, o la recopilación de información 
												la autoridad. Estoy de acuerdo en que la Asociación Americana de Administradores de 
												Vehículos Motorizados (AAMVA), una organización sin fines de lucro de terceros, puede 
												ser utilizado como un intermediario para transmitir mi VIN y la información de pago del 
												IRS para los DMV estatales.'
									),
					'para2' => array
									(			
										'EN' =>'I understand that the information to be disclosed is generally confidential 
												under the laws applicable to the IRS and that the agency receiving the HVUT 
												information is not bound by these laws and may use the information for any 
												purpose as permitted by other federal laws and/or state law. To be effective, 
												this consent must be received to the IRS within 120 days of the date of filing 
												with the IRS.',
									
										'SP' => 'Entiendo que la información que se divulgará por lo general confidencial de 
												 conformidad con las leyes aplicables al IRS y que la agencia recibe la 
												 información HVUT no está vinculado por estas leyes, y podrá utilizar la 
												 información para cualquier propósito permitido por otras leyes federales y / o 
												 estatales la ley. Para ser eficaz, este consentimiento debe ser recibida al 
												 IRS dentro de los 120 días siguientes a la fecha de presentación ante el IRS.'
									),
					'para3' => array
									(			
										'EN' =>'If signed by a corporate officer or party other than the Taxpayer, I certify 
										 		that I have the authority to execute this consent to disclosure of tax information. 
										 		The personal identification Number will be used only if the return is electronically
										 		transmitted to the IRS..',
									
										'SP' => 'Si es firmado por un directivo de la empresa o la parte que no sea el contribuyente, 
												 yo certifico que tengo la autoridad para ejecutar este consentimiento a la divulgación
												 de información fiscal. El número de identificación personal sólo se utilizará si 
												 el retorno se transmite electrónicamente al IRS.'
									),
					'lowmileageinfo' => array
									(
										'EN' => 'You can claim a credit for the tax paid on a vehicle that was used 5000 miles or less. 
												(7500 miles or less for agriculture vehicles)',
										'SP' => 'Usted puede reclamar un crédito por el impuesto pagado en un vehículo que se utilizó de 5000 millas o menos.
												(7500 millas son menores para los vehículos agrícolas)'
									),
					'monthusedlbl' => array
									(
										'EN' => 'Month Used',
										'SP' => 'Mes usado'
									),
					'lowmileagecreditlbl' => array
									(
										'EN' => 'Low Mileage Credits',
										'SP' => 'Créditos de bajo millaje'
									),
					'vinLbl' => array
									(
										'EN'	=>	'VIN',
										'SP'	=>	'VIN'
									),
					'lossTypeLbl' => array
									(
										'EN'	=>	'Loss Type',
										'SP'	=>	'SP Losstype'
									),
					'SoldDateLbl' => array
									(
											'EN' => 'Sold/Destroyed/Stolen Date',
											'SP' => 'vendido Fecha'
									),
					'selectType' => array
									(
										'EN' => 'Select Loss Type',
										'SP' => 'Seleccione el tipo de pérdida'
									),
					'updatebtn' => array
									(
										'EN' => 'Update',
										'SP' => 'SP Update'
									),
					'Monthlbl' =>	array
									(
										'EN' => 'First Used Month',
										'SP' => 'Mes utilizó por primera vez'
									),
					'creditamountlbl' =>	array
									(
										'EN' => 'Credit Amount',
										'SP' => 'Mes utilizó por primera vez'
									),										
					'losstype' =>	array
									(
										'EN' => 'Type of Loss',
										'SP' => 'Tipo de Pérdida'
									),
					'solddestroy' =>	array
									(
										'EN' => 'Sold/Destroyed Credits',
										'SP' => 'Créditos vendidos / Destruido'
									),
					'solddestroydate' =>	array
									(
										'EN' => 'Sold / Destroyed Date',
										'SP' => 'Se vende / Destruido Fecha'
									),
					'destroyed' =>	array
									(
										'EN' => 'Destroyed',
										'SP' => 'Destroyed'
									),	
					'sold' =>	array
									(
										'EN' => 'Sold',
										'SP' => 'vendido'
									),
					'stolen' =>	array
									(
										'EN' => 'Stolen',
										'SP' => 'Stolen'
									),					
					'overpaymentlbl' => array
									(
										'EN' => 'Credit for overpayment of tax',
										'SP' => 'El crédito para un pago excesivo de impuestos'
									),
					'overpaymentDesc' => array
									(
										'EN' => 'You can claim a refund for any tax amount that was overpaid to the IRS due to a mistake in tax liability previously reported on form 2290.',
										'SP' => 'You can claim a refund for any tax amount that was overpaid to the IRS due to a mistake in tax liability previously reported on form 2290.'
									),
					'noteslbl' => array
									(
										'EN' => 'You can claim a credit for an overpayment of tax  due 
										         to a mistake in tax liability previously reported on Form 2290',
										'SP' => 'El crédito para un pago excesivo de impuestos'
									),
					'paymentdate' => array
									(
										'EN' => 'Date of tax payment',
										'SP' => 'Fecha de pago de impuestos'
									),
					'amountclaim' => array
									(
										'EN' => 'Amount of Claim',
										'SP' => 'Importe de la reclamación'
									),
					'expplanation' => array
									(
										'EN' => 'Explanation for refund',
										'SP' => 'Explicación para el reembolso'
									),
					'uploaddocument' => array
									(
										'EN' => 'Upload any supporting documents',
										'SP' => 'Subir los documentos justificativos'
									),
					'download_document' => array
									(
										'EN' => 'Download Doc.',
										'SP' => 'Download Doc.'
									),
					'download_pdf' => array
									(
										'EN' => 'Downlaod PDF',
										'SP' => 'Downlaod PDF'
									),
					'uploaded_file' => array
									(
										'EN' => 'Uploaded File',
										'SP' => 'Uploaded File'
									),
					'document' => array
									(
										'EN' => 'Documents',
										'SP' => 'Documentos'
									),
					'confirm_email' =>	array
									(
										'EN' => 'Confirm Email',
										'SP' => 'Confirm Email'
									),
					'contact_number' =>	array
									(
										'EN' => 'Contact Number',
										'SP' => 'Contact Number'
									),
					'reg_description' =>	array
									(
										'EN' => 'Please fill in the following information to create an account with simpletrucktax.com. <br/>It should only take a few minutes. All the details are mandatory.',
										'SP' => 'Please fill in the following information to create an account with simpletrucktax.com. <br/>It should only take a few minutes. All the details are mandatory.'
									),
					'agree_terms' =>	array
									(
										'EN' => 'By clicking "REGISTER" you agree to our <a target="_blank" href="/termsandconditions/" class="blueTxt"> Terms &amp; conditions</a>',
										'SP' => 'By clicking "REGISTER" you agree to our <a target="_blank" href="/termsandconditions/" class="blueTxt"> Terms &amp; conditions</a>'
									),
					'suspendedvehicletitle' =>	array
									(
										'EN' => 'Last Year Suspended Vehicle',
										'SP' => 'Last Year Suspended Vehicle'
									),
					'exceededmileage' =>	array
									(
										'EN' => 'Exceeded Mileage Use Limit',
										'SP' => 'Límite de uso Kilometraje Superó'
									),
					'soldtransfered' =>	array
									(
										'EN' => 'Sold/Transferred',
										'SP' => 'Sold/Transferred'
									),
					'myBusiness' => array
									(
										'EN' => 'My Business',
										'SP' => 'Mi Negocio'
									),
					'addNewBusiness' =>	array
									(
										'EN' => 'Add New Business',
										'SP' => 'Crear Nuevo Negocio'
									),
					'Business' =>	array
									(
										'EN' => 'Business',
										'SP' => 'negocios'
									),
					'Type' =>	array
									(
										'EN' => 'Type',
										'SP' => 'tipo'
									),
					'SA_Name' =>	array
									(
										'EN' => 'SA Name',
										'SP' => 'nombre'
									),
					'TPD_Name' =>	array
									(
										'EN' => 'TPD Name',
										'SP' => 'Nombre TPD'
									),
									
					'Start_Filing' =>	array
									(
										'EN' => 'START FILING',
										'SP' => 'Iniciar presentación'
									),
					'personalInformation' =>	array
									(
										'EN' => 'Personal Information',
										'SP' => 'Información Personal'
									),
					'contactInformation' =>	array
									(
										'EN' => 'Contact Information',
										'SP' => 'Información de Contacto'
									),
					'emailAddress' =>	array
									(
										'EN' => 'Email Address',
										'SP' => 'Dirección de correo electrónico'
									),
									
					'signAuthorityInfo' =>	array
									(
										'EN' => 'Signing Authority Information',
										'SP' => 'La firma de información para autoridades'
									),
					'Name' =>	array
									(
										'EN' => 'Name',
										'SP' => 'nombre'
									),
					'Title' =>	array
									(
										'EN' => 'Title',
										'SP' => 'título'
									),
					'dayTimePhone' =>	array
									(
										'EN' => 'Day Time Phone',
										'SP' => 'Teléfono durante el día'
									),
					'pin' =>	array
									(
										'EN' => 'PIN',
										'SP' => 'PIN'
									),
					'thirdPartyDesigneeInfo' =>	array
									(
										'EN' => 'Third Party Designee Information',
										'SP' => 'Third Party Information Designado'
									),
					'addBusinessInfo' =>	array
									(
										'EN' => 'SimpleTruckTax requires your business information such as the profile, contact details, signing authority details and third party designee details if any, to submit your return to the IRS',
										'SP' => 'SimpleTruckTax requires your business information such as the profile, contact details, signing authority details and third party designee details if any, to submit your return to the IRS'
									),			
					'DDLabel' =>	array
									(
										'EN' => 'Electronic Funds Withdrawal [Direct Debit]',
										'SP' => 'Retiro electrónico de fondos [Débito Directo]'
									),
					'authorizeDirectly' =>	array
									(
										'EN' => 'Authorize IRS to directly debit your bank account.',
										'SP' => 'Autorizar IRS a debitar directamente de su cuenta bancaria'
									),
					'paymenttype' =>	array
									(
										'EN' => 'Payment Method',
										'SP' => 'Método de pago'
									),
					'bankName' =>	array
									(
										'EN' => 'Bank Name',
										'SP' => 'Nombre del banco'
									),
					'AccountType' =>	array
									(
										'EN' => 'Account Type',
										'SP' => 'Tipo de cuenta'
									),
					'BankAccountNumber' =>	array
									(
										'EN' => 'Bank Account Number',
										'SP' => 'Número de cuenta bancaria'
									),
					'RoutingTransitNumber' =>	array
									(
										'EN' => 'Routing Transit Number',
										'SP' => 'Número de Tránsito de enrutamiento'
									),
					'paymnetDDInformation' =>	array
									(
										'EN' => 'Please note that the information entered regarding the direct debit is transmitted directly
												to the IRS. The process of withdrawing the tax due is something that the IRS handles. 
												If you notice that the amount is not being withdrawn, please double check to make sure that 
												the information entered is correct. If the information is correct and the account has not been 
												debited from the bank information you have entered, please contact the IRS at 1-800-829-4933.
										',
										'SP' => 'Tenga en cuenta que la información introducida en relación con la domiciliación bancaria se transmite directamente
												al IRS. El proceso de retirada de la contribución adeudada es algo que se encarga de la IRS.
												Si usted nota que no se está retirando la cantidad, por favor vuelva a comprobar para asegurarse de que
												la información introducida es correcta. Si la información es correcta y la cuenta no ha sido
												debitado de la información del banco que ha introducido, por favor comuníquese con el IRS al 1-800-829-4933'
									),
					'paymnetDDagreement' =>	array
									(
										'EN' => 'I hereby declare that the bank information furnished by me is true to my knowledge.',
										'SP' => 'I hereby declare that the bank information furnished by me is true to my knowledge.'
									),
					'EFTPSLabel' =>	array
									(
										'EN' => 'EFTPS - Electronic Federal Tax Payment System',
										'SP' => 'EFTPS - Sistema Electrónico de Pago de Impuestos Federales'
									),
					'EFTPNotes1' =>	array
									(
										'EN' => 'You can pay the tax due electronically to the IRS by visiting www.EFTPS.gov',
										'SP' => 'Usted puede pagar el impuesto adeudado electrónicamente al IRS visitando www.EFTPS.gov'
									),
					'EFTPNotes2' =>	array
									(
										'EN' => 'If you already have an account with EFTPS.GOV, it only takes minutes to pay the taxes. If you do not have an account with EFTPS.GOV, it will take about 15 business days to set one up.',
										'SP' => 'Si ya tiene una cuenta con EFTPS.GOV, sólo toma unos minutos para pagar los impuestos. Si usted no tiene una cuenta con EFTPS.GOV, tardará unos 15 días hábiles para configurar una.'
									),
					'paymentAcceptText' =>	array
									(
										'EN' => 'I accept that it is my responsibility to Schedule the tax due payment to the IRS using eftps.gov website.',
										'SP' => 'Acepto que es mi responsabilidad de programar el pago debido de impuestos al IRS usando eftps.gov sitio web.'
									),
					'submissionFee_description' =>	array
									(
										'EN' => 'Simpletrucktax.com charges a minimal amount as the service fee. Please make the necessary payment to complete the filing process and to transmit the prepared return to the IRS.',
										'SP' => 'Simpletrucktax.com charges a minimal amount as the service fee. Please make the necessary payment to complete the filing process and to transmit the prepared return to the IRS.'
									),
					'submission_fee_details' =>	array
									(
										'EN' => 'Submission Fee Details',
										'SP' => 'Submission Fee Details'
									),
					'receipt' =>	array
									(
										'EN' => 'Receipt',
										'SP' => 'Receipt'
									),
					'amount' =>	array
									(
										'EN' => 'Amount',
										'SP' => 'Amount'
									),
					'filing_fee' =>	array
									(
										'EN' => 'Filing fee for ',
										'SP' => 'Filing fee for '
									),
					'pay' =>	array
									(
										'EN' => 'Pay',
										'SP' => 'Pay'
									),
					'form_summary' =>	array
									(
										'EN' => 'Form Summary',
										'SP' => 'Form Summary'
									),
					'payment_mode' =>	array
									(
										'EN' => 'IRS Payment Options',
										'SP' => 'Payment Modes'
									),
					'tax_year_forms' =>	array
									(
										'EN' => 'Tax Year & Forms',
										'SP' => 'Tax Year & Forms'
									),
					'account_creation' =>	array
									(
										'EN' => 'Your account has been created successfully.',
										'SP' => 'Your account has been created successfully.'
									),
					'check_mail' =>	array
									(
										'EN' => 'Please check your mail to activate and access to your account.',
										'SP' => 'Please check your mail to activate and access to your account.'
									),
					'click_here' =>	array
									(
										'EN' => 'Click here',
										'SP' => 'Click here'
									),
					'view_home' =>	array
									(
										'EN' => 'to view home page',
										'SP' => 'to view home page'
									),
					'wrong_captcha' =>	array
									(
										'EN' => 'Verification code is incorrect. Please try again.',
										'SP' => 'Verification code is incorrect. Please try again.'
									),
					'vehiclestax' =>	array
									(
										'EN' => 'Vehicles Tax',
										'SP' => 'Vehículos de Impuestos'
									),
					'vehiclessummary' =>	array
									(
										'EN' => 'Vehicles Summary',
										'SP' => 'Vehículos Resumen'
									),
					'formtype' =>	array
									(
										'EN' => 'Form Type',
										'SP' => 'Tipo de formulario'
									),
					'paymentInformation' =>	array
									(
										'EN' => 'There are two methods to pay the tax to the IRS. You can make the payment by authorizing a direct debit or use EFTPS. If you are using EFTPS, you must initiate the transaction at least 1 business day before the date the payment is due.',
										'SP' => 'There are two methods to pay the tax to the IRS. You can make the payment by authorizing a direct debit or use EFTPS. If you are using EFTPS, you must initiate the transaction at least 1 business day before the date the payment is due.'
									),
					'Proceed' =>	array
									(
										'EN' => 'Proceed',
										'SP' => 'proceder'
									),
					'forgotpwdinfo1' =>	array
									(
										'EN' => 'If you have forgotten your password, please enter the e-mail address you used to register.',
										'SP' => 'Si ha olvidado su contraseña, por favor, introduzca la dirección de correo electrónico que utilizó para registrarse.'
									),
					'forgotpwdinfo2' =>	array
									(
										'EN' => 'We will e-mail your account details shortly.',
										'SP' => 'Nosotros le enviaremos los detalles de su cuenta en breve.'
									),
					'changePwdInfo' =>	array
									(
										'EN' => 'Please enter the password you like to use to access SimpleTruckTax.com. Keep this password safe as you have to use it every time you access the application',
										'SP' => 'Please enter the password you like to use to access SimpleTruckTax.com. Keep this password safe as you have to use it every time you access the application.'
									),
					'existingUser' =>	array
									(
										'EN' => 'Existing User',
										'SP' => 'usuario existente'
									),
					'rememberMe' => array
									(			
										'EN' => 'Remember me',
										'SP' => 'Recordarme'
									),
					'needHelpAccessingAccount' => array
									(			
										'EN' => 'Forgot your password?',
										'SP' => '¿Necesita ayuda para acceder a su cuenta?'
									),
					'newToStt' => array
									(			
										'EN' => 'New to Simple Truck Tax?',
										'SP' => '¿Nuevo en Impuesto simple Truck?'
									),
					'returninguser' => array
									(			
										'EN' => 'Returning User?',
										'SP' => 'Returning User?'
									),
					'taxcomputation' => array
									(			
										'EN' => 'Tax Computation',
										'SP' => 'Cálculo del impuesto'
									),
					'taxsummary' => array
									(			
										'EN' => 'Tax Summary',
										'SP' => 'Resumen de impuestos'
									),
					'taxdue' => array
									(			
										'EN' => 'Tax Due to the IRS',
										'SP' => 'Impuesto Debido al IRS'
									),
					'sold_destroyed_vehicles' => array
									(			
										'EN' => 'Sold &amp; Destroyed Vehicles',
										'SP' => 'Sold &amp; Destroyed Vehicles'
									),
					'lowmileage_credits_vehicles' => array
									(			
										'EN' => 'Low Mileage Credits Vehicles',
										'SP' => 'Low Mileage Credits Vehicles'
									),
					'menutaxvehinfo' => array
									(			
										'EN' => 'Taxable Vehicle Information',
										'SP' => 'Taxable Vehicle Information'
									),
					'menucursuspendvehicle' => array
									(			
										'EN' => 'Reporting Suspended / Exempt Vehicles',
										'SP' => 'Reporting Suspended / Exempt Vehicles'
									),
					'menupriorvehicle' => array
									(			
										'EN' => 'Prior Year Suspended / Exempt Vehicles',
										'SP' => 'Prior Year Suspended / Exempt Vehicles'
									),
					'menusolddest' => array
									(			
										'EN' => 'Sold, Destroyed or Stolen Vehicles (Credit)',
										'SP' => 'Sold, Destroyed or Stolen Vehicles (Credit)'
									),
					'menulowmileage' => array
									(			
										'EN' => 'Low Mileage Vehicles (Credit)',
										'SP' => 'Low Mileage Vehicles (Credit)'
									),
					'menucrdoverpay' => array
									(			
										'EN' => 'Credit for an overpayment of tax',
										'SP' => 'Credit for an overpayment of tax'
									),
					'menutgwi' => array
									(			
										'EN' => 'Taxable Gross Weight Increase',
										'SP' => 'Taxable Gross Weight Increase'
									),
					'menuexceed' => array
									(			
										'EN' => 'Exceeded Mileage Vehicles',
										'SP' => 'Exceeded Mileage Vehicles'
									),
					'vincorrection' => array
									(			
										'EN' => 'VIN Correction',
										'SP' => 'VIN Correction'
									),
					'summary_desc' => array
									(			
										'EN' => 'The following are the details furnished by you regarding your vehicle(s). Kindly verify this information before proceeding to submitting your return.',
										'SP' => 'Los siguientes son los detalles proporcionados por usted con respecto a sus vehículos. Favor verificar esta información antes de proceder a la presentación de su declaración.'
									),
					'startfiling' => array
									(			
										'EN' => 'Start New Filing',
										'SP' => 'Iniciar nueva presentación'
									),
					'submissiondate' => array
									(			
										'EN' => 'Submission Date',
										'SP' => 'Fecha de envío'
									),
					'createddate' => array
									(			
										'EN' => 'Created Date',
										'SP' => 'fecha de creación'
									),
					'status' => array
									(			
										'EN' => 'Status',
										'SP' => 'Estatus'
									),
					'schedule1' => array
									(			
										'EN' => 'Schedule 1',
										'SP' => 'Schedule 1'
									),
					'myreturn_desc1' => array
									(			
										'EN' => 'Following are the details of your return filed through SimpleTruckTax.com.',
										'SP' => 'Following are the details of your return filed through SimpleTruckTax.com.'
									),
					'myreturn_desc2' => array
									(			
										'EN' => 'IRS Approved status is a one in which the return has been transmitted to the IRS and the schedule 1 has been received.',
										'SP' => 'A Pending status is a one which is in progress.'
									),
					'myreturn_desc3' => array
									(			
										'EN' => 'IRS Rejected status is a one in which the return has been transmitted and the same rejected by the IRS.',
										'SP' => 'IRS acknowledged status is a one in which the return has been transmitted to the IRS and the schedule 1 has been received.'
									),
					'myreturn_desc4' => array
									(			
										'EN' => 'An Approval Pending status is a one which is in line waiting for status report from the IRS.',
										'SP' => 'View status displays the status information about your return from the IRS.'
									),
					'myreturn_desc5' => array
									(			
										'EN' => 'Incomplete status denotes the return is not yet complete to be transmitted to the IRS.',
										'SP' => 'View status displays the status information about your return from the IRS.'
									),
					'nofiling' => array
									(			
										'EN' => 'You do not have any filings.',
										'SP' => 'Usted no tiene ningún limaduras.'
									),
					'novehicles' => array
									(			
										'EN' => 'You do not have any vehicles.',
										'SP' => 'Usted no tiene ningún vehículo.'
									),
					'vehicle_added' => array
									(			
										'EN' => 'Vehicle information added',
										'SP' => 'Vehicle information added'
									),
					'vehicle_not_added' => array
									(			
										'EN' => 'Vehicle information not added',
										'SP' => 'Vehicle information not added'
									),
					'VIN_already_exists' => array
									(			
										'EN' => 'VIN number already exists',
										'SP' => 'VIN number already exists'
									),
					'loginWithFB' => array
									(		
										'EN' => 'Login with FB',
										'SP' => 'Ingresar con FB'
									),
					'finalreturn' => array
									(			
										'EN' => 'Final Return',
										'SP' => 'Final Return'
									),
					'addresschange' => array
									(			
										'EN' => 'Address Change',
										'SP' => 'Address Change'
									),
					'backtobiz' => array
									(			
										'EN' => 'Back to Businesses',
										'SP' => 'Back to Businesses'
									),
					'continuefiling' => array
									(			
										'EN' => 'Continue Filing',
										'SP' => 'Continue Filing'
									),									
					'taxyeardesc' => array
									(			
										'EN' => 'Simpletrucktax.com supports Form 2290, Form 2290 amendments and Form 8829.To file Form 2290, select the tax year and the first used month. First used month is the month when the vehicle is first used on a public highway during the tax period. To file Form 8849, enter the month the income tax year end for the claimant',
										'SP' => 'Simpletrucktax.com supports Form 2290, Form 2290 amendments and Form 8829.To file Form 2290, select the tax year and the first used month. First used month is the month when the vehicle is first used on a public highway during the tax period. To file Form 8849, enter the month the income tax year end for the claimant'
									),
					'sold_destroyed_description' => array
									(			
										'EN' => 'You can claim a credit for the tax paid on a vehicle that was  either  sold  destroyed or stolen before June 1 and not used during the remainder of the tax period.',
										'SP' => 'You can claim a credit for the tax paid on a vehicle that was  either  sold  destroyed or stolen before June 1 and not used during the remainder of the tax period.'
									),
					'vehicle_updated' => array
									(			
										'EN' => 'Vehicle information updated',
										'SP' => 'Vehicle information updated'
									),
					'vehicle_not_updated' => array
									(			
										'EN' => 'Vehicle information not added',
										'SP' => 'Vehicle information not added'
									),
					'continuefiling' => array
									(			
										'EN' => 'Continue Filing',
										'SP' => 'Continue Filing'
									),
					'taxyrforms' => array
									(			
										'EN' => 'Tax Year &amp; Forms',
										'SP' => 'Tax Year &amp; Forms'
									),
					'submissionfee' => array
									(			
										'EN' => 'Submission Fee',
										'SP' => 'Submission Fee'
									),
					'irssubmission' => array
									(			
										'EN' => 'IRS Submission',
										'SP' => 'IRS Submission'
									),
					'Checking' =>	array
									(
										'EN' => 'Checking',
										'SP' => 'de cheques'
									),
					'Savings' =>	array
									(
										'EN' => 'Savings',
										'SP' => 'ahorros'
									),
					'logging_help_txt' => array
									(			
										'EN' => 'A logging vehicle is a registered highway motor vehicle used exclusively in the transportation of harvested forest products.',
										'SP' => 'A logging vehicle is a registered highway motor vehicle used exclusively in the transportation of harvested forest products.'
									),
					'agriculture_help_txt' => array
									(			
										'EN' => 'An Agricultural vehicle is a registered highway motor vehicle used for farming purposes for the entire period.',
										'SP' => 'An Agricultural vehicle is a registered highway motor vehicle used for farming purposes for the entire period.'
									),
					'sold_first_used_month' => array
									(			
										'EN' => 'Enter the first used month from your prior filed return.',
										'SP' => 'Enter the first used month from your prior filed return.'
									),
					'lowmileage_first_used_month' => array
									(			
										'EN' => 'Tax year and first used month reported when the tax was paid.',
										'SP' => 'Tax year and first used month reported when the tax was paid.'
									),
					'addfleet' =>	array
									(
										'EN' => 'Add Fleet/Vehicle',
										'SP' => 'Añadir Flota/Vehículo'
									),
					'licenseplate' =>	array
									(
										'EN' => 'License Plate Number',
										'SP' => 'Número de placa'
									),
					'editfleet' =>	array
									(
										'EN' => 'Edit Fleet/Vehicle',
										'SP' => 'Editar Flota/Vehículo'
									),
					'EnterValidBusName' =>	array
									(
										'EN' => 'Enter a valid Business Name',
										'SP' => 'Enter a valid Business Name'
									),
					'EnterValidBankName' =>	array
									(
										'EN' => 'Enter a valid Bank Name',
										'SP' => 'Enter a valid Bank Name'
									),
					'EnterValidCity' =>	array
									(
										'EN' => 'Enter a valid City or Town',
										'SP' => 'Enter a valid City or Town'
									),
					'EnterValidSignAuthName' =>	array
									(
										'EN' => 'Enter a valid Signing Authority Name',
										'SP' => 'Enter a valid Signing Authority Name'
									),
					'EnterValidSignAuthTitle' =>	array
									(
										'EN' => 'Enter a valid Signing Authority Title',
										'SP' => 'Enter a valid Signing Authority Title'
									),
					'EnterValidEIN' =>	array
									(
										'EN' => 'Enter a valid EIN',
										'SP' => 'Enter a valid EIN'
									),
					'EnterValidTPDesName' =>	array
									(
										'EN' => 'Enter a valid Third party designees Name',
										'SP' => 'Enter a valid Third party designees Name'
									),
					'EnterValidSAPin' =>	array
									(
										'EN' => 'Enter a valid Signing Authority PIN',
										'SP' => 'Enter a valid Signing Authority PIN'
									),
					'EnterValidSAPin' =>	array
									(
										'EN' => 'Enter a valid Signing Authority PIN',
										'SP' => 'Enter a valid Signing Authority PIN'
									),
					'EnterValidDesigneePin' =>	array
									(
										'EN' => 'Enter a valid Designee’s PIN',
										'SP' => 'Enter a valid Designee’s PIN'
									),
					'EnterValidZipCode' =>	array
									(
										'EN' => 'Enter a valid Zipcode',
										'SP' => 'Enter a valid Zipcode'
									),
					'EnterValidOwnerFirstName' =>	array
									(
										'EN' => 'Enter a valid Owner First Name',
										'SP' => 'Enter a valid Owner First Name'
									),
					'firstname_error' =>	array
									(
										'EN' => 'Enter a valid first name',
										'SP' => 'Enter a valid first name'
									),
					'lastname_error' =>	array
									(
										'EN' => 'Enter a valid last name',
										'SP' => 'Enter a valid last name'
									),
					'EnterValidOwnerLastName' =>	array
									(
										'EN' => 'Enter a valid Owner Last Name',
										'SP' => 'Enter a valid Owner Last Name'
									),
					'business_added' =>	array
									(
										'EN' => 'Your business has been added. You can now start filing for the business.',
										'SP' => 'Your business has been added. You can now start filing for the business.'
									),
					'thirdPartyInfo' =>	array
									(
										'EN' => 'Would you like to authorize a person to discuss your tax returns with the IRS? If yes the designee name, phone number and PIN are mandatory.',
										'SP' => 'Would you like to authorize a person to discuss your tax returns with the IRS? If yes the designee name, phone number and PIN are mandatory.',
									),
					'business_not_added' =>	array
									(
										'EN' => 'Business information not inserted',
										'SP' => 'Business information not inserted'
									),
					'business_already_exists' =>	array
									(
										'EN' => 'Business Name already exists',
										'SP' => 'Business Name already exists'
									),
					'business_updated' =>	array
									(
										'EN' => 'Business information updated',
										'SP' => 'Business information updated'
									),
					'business_not_updated' =>	array
									(
										'EN' => 'Business information not updated',
										'SP' => 'Business information not updated'
									),
					'vehicle_was' =>	array
									(
										'EN' => 'The Vehicle Was',
										'SP' => 'The Vehicle Was'
									),
					'tgwidesc' => array
									(			
										'EN' => '<p>Report the vehicles for which the taxable gross weight has increased from that reported on Form 2290 elsewhere. When the taxable gross weight of the vehicle increases, the vehicle falls into a new category and the additional tax for the remainder of the period needs to be reported on Form 2290. </p><p>To amend a previously filed return, details pertaining to the tax year that you are amending and the month when the taxable gross weight increased are essential.</p>',
										'SP' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book'
									),
					'ownerName' =>	array
									(
										'EN' => 'Owner Name.',
										'SP' => 'Owner Name.'
									),
					'exceedmileagedesc' => array
									(			
										'EN' => '<p>Report increase in mileage use limit of a suspended vehicle from that reported on Form 2290 elsewhere. A vehicle becomes taxable if it exceeds the mileage use limit of 5,000 miles or more (7,500 miles or more for agricultural vehicle).</p><p>To amend a previously filed return, details pertaining to the tax year that you are amending and the month when the mileage use limit exceeded are essential.</p>',
										'SP' => 'Please report the Exceeded mileage vehicles.'
									),
					'EnterValidBankAccNo' =>	array
									(
										'EN' => 'Enter a Valid Bank Account Number',
										'SP' => 'Enter a Valid Bank Account Number'
									),
					'EnterValidRTNo' =>	array
									(
										'EN' => 'Enter a Valid Routing Transit Number',
										'SP' => 'Enter a Valid Routing Transit Number'
									),
					'cursuspenddesc' => array
									(			
										'EN' => 'Please report the vehicles that are suspended or excempt from tax for the current year. A vehicle is said 
												to be suspended from the tax, if it is expected to be used less then mileage use limit of 5000 miles or less
												(7500 mileage or less for agricultural vehicles).',
										'SP' => 'Please report the vehicles that are suspended or excempt from tax for the current year. A vehicle is said 
												to be suspended from the tax, if it is expected to be used less then mileage use limit of 5000 miles or less
												(7500 mileage or less for agricultural vehicles).'
									),
					'irs_ack' =>	array
									(
										'EN' => 'IRS Aknowledgement',
										'SP' => 'IRS Aknowledgement'
									),	
					'thankyou_returns' =>	array
									(
										'EN' => 'Thank you for using Simple Truck Tax to file your returns.',
										'SP' => 'Thank you for using Simple Truck Tax to file your returns.'
									),	
					'merchant' =>	array
									(
										'EN' => 'Merchant',
										'SP' => 'Merchant'
									),
					'description' =>	array
									(
										'EN' => 'Description',
										'SP' => 'Description'
									),
					'date_time' =>	array
									(
										'EN' => 'Date/Time',
										'SP' => 'Date/Time'
									),
					'transaction_id' =>	array
									(
										'EN' => 'Transaction ID',
										'SP' => 'Transaction ID'
									),
					'EnterVin' =>	array
									(
										'EN' => 'Enter the Vehicle Identification Number',
										'SP' => 'Enter the Vehicle Identification Number'
									),
					'EnterValidvin' =>	array
									(
										'EN' => 'Enter a Valid VIN Number',
										'SP' => 'Enter a Valid VIN Number'
									),
					'selectWeight' =>	array
									(
										'EN' => 'Please select a taxable gross weight',
										'SP' => 'Please select a taxable gross weight'
									),
					'selectLogging' =>	array
									(
										'EN' => 'Please select whether Logging vehicle or not ?',
										'SP' => 'Please select whether Logging vehicle or not ?'
									),
					'selectAgriVehicle' =>	array
									(
										'EN' => 'Please Select Vehicle used for agricultural',
										'SP' => 'Please Select Vehicle used for agricultural'
									),
					'selectFirstusedMonth' =>	array
									(
										'EN' => 'Please select first used month reported when the tax was paid.',
										'SP' => 'Please select first used month reported when the tax was paid.'
									),
					'enterExplanation' =>	array
									(
										'EN' => 'Enter a detailed description, explaining the facts for the credits claimed.',
										'SP' => 'Enter a detailed description, explaining the facts for the credits claimed.'
									),
					'selectSoldDate' =>	array
									(
										'EN' => 'Select the date on which the vehicle was either sold, destroyed or stolen.',
										'SP' => 'Select the date on which the vehicle was either sold, destroyed or stolen.'
									),
					'selectLossType' =>	array
									(
										'EN' => 'Select the type of loss.',
										'SP' => 'Select the type of loss.'
									),
					'soldDestroyed_withintaxyear' =>	array
									(
										'EN' => 'Sold / Destroyed date has to be within the same tax period.',
										'SP' => 'Sold / Destroyed date has to be within the same tax period.'
									),
					'selectPreviousWeight' =>	array
									(
										'EN' => 'Please select previous weight category.',
										'SP' => 'Please select previous weight category'
									),
					'selectChangedWeight' =>	array
									(
										'EN' => 'Please select changed weight category.',
										'SP' => 'Please select changed weight category.'
									),
					'changedCategoryNotvalid' =>	array
									(
										'EN' => 'Changed Category must be greater than Previous Category.',
										'SP' => 'Changed Category must be greater than Previous Category.'
									),
					'FirstMonth_PastDate' =>	array
									(
										'EN' => 'Refund can be claimed on a vehicle that was used 5,000 miles or less( 7,500 miles or less for agricultural vehicle)only on the first form 2290 filed for the next period. The first used month when the return was filed for the vehicle should always in the prior tax year.',
										'SP' => 'Refund can be claimed on a vehicle that was used 5,000 miles or less( 7,500 miles or less for agricultural vehicle)only on the first form 2290 filed for the next period. The first used month when the return was filed for the vehicle should always in the prior tax year.'
									),
					'selectSuspension' =>	array
									(
										'EN' => 'Please select anyone of the suspension',
										'SP' => 'Please select anyone of the suspension'
									),
					'enterSoldTransfer' =>	array
									(
										'EN' => 'Please enter name of whom to sold / transfered.',
										'SP' => 'Please enter name of whom to sold / transfered.'
									),
					'selectDate' =>	array
									(
										'EN' => 'Please select date',
										'SP' => 'Please select date'
									),
					'selectPastDate' =>	array
									(
										'EN' => 'Date should be a past date.',
										'SP' => 'Date should be a past date.'
									),
					'enterAmtClaim' =>	array
									(
										'EN' => 'Please enter the amount of claim.',
										'SP' => 'Please enter the amount of claim.'
									),
					'enterDescClaim' =>	array
									(
										'EN' => 'Enter a detailed description about credit claim.',
										'SP' => 'Enter a detailed description about credit claim.'
									),
					'firstMonth_notSameYear' =>	array
									(
										'EN' => 'The First used month when the return was filed for the vehicle previously cannot be greater than the current date.',
										'SP' => 'The First used month when the return was filed for the vehicle previously cannot be greater than the current date.'
									),
					'soldDestroyed_notSameYear' =>	array
									(
										'EN' => 'A vehicle cannot be sold/ destroyed or stolen in a future date. Enter the date when the vehicle was damaged by accident, sold or stolen and it is not economical to rebuild.',
										'SP' => 'A vehicle cannot be sold/ destroyed or stolen in a future date. Enter the date when the vehicle was damaged by accident, sold or stolen and it is not economical to rebuild.'
									),
					'SoldDestroyed_WithinTaxYear' =>	array
									(
										'EN' => 'The date when the vehicle was sold/ destroyed or stolen should always be greater than the first used month when the return was filed for the vehicle previously.',
										'SP' => 'The date when the vehicle was sold/ destroyed or stolen should always be greater than the first used month when the return was filed for the vehicle previously.'
									),
					'noTaxableVehicleFound' =>	array
									(
										'EN' => 'No taxable vehicles found in the filing. Please add taxable vehicle first.',
										'SP' => 'No taxable vehicles found in the filing. Please add taxable vehicle first.'
									),
					'creditExceeded' => array
									(			
										'EN' => 'The amount to be paid to the IRS is less than the refund amount from the IRS. We request you to add a taxable vehicle if you possess otherwise, use form 8849 to claim your credits.',
										'SP' => 'The amount to be paid to the IRS is less than the refund amount from the IRS. We request you to add a taxable vehicle if you possess otherwise, use form 8849 to claim your credits.'
									),
					'summary_error' => array
									(			
										'EN' => 'Error: Filing couldn\'t be continued! Please contact support team for more details.',
										'SP' => 'Error: Presentación no podría continuar! Por favor, póngase en contacto con equipo de soporte para más detalles.'
									),
					'myTransaction' =>	array
									(
										'EN' => 'My Transactions',
										'SP' => 'My Transactions'
									),
					'profileSuccessMsg' =>	array
									(
										'EN' => 'Sucessfully updated',
										'SP' => 'Sucessfully updated'
									),
					
					'dateOfPayment' =>	array
									(
										'EN' => 'Date of payment',
										'SP' => 'Date of payment'
									),
					'voucherNo' =>	array
									(
										'EN' => 'Voucher No',
										'SP' => 'Voucher No'
									),
					'paymentGateway' =>	array
									(
										'EN' => 'Payment Gateway',
										'SP' => 'Payment Gateway'
									),
					'paymentStatus' =>	array
									(
										'EN' => 'Payment Status',
										'SP' => 'Payment Status'
									),
					'vehiclecount' =>	array
									(
										'EN' => 'No. of Vehicles',
										'SP' => 'Conteo de vehículos'
									),
					'totalCollected' =>	array
									(
										'EN' => 'Total Collected',
										'SP' => 'Total Collected'
									),
					'download' =>	array
									(
										'EN' => 'Download',
										'SP' => 'descargar'
									),
					'consentuser' =>	array
									(
										'EN' => 'Consent for submission',
										'SP' => 'Consentimiento para la presentación'
									),
					'consentuserdesc' =>	array
									(
										'EN' => 'I hereby authorize SimpleTruckTax.com to transmit my prepared return to the IRS. I declare all the information furnished by me are true to the best of my knowledge.',
										'SP' => 'I hereby authorize SimpleTruckTax.com to transmit my prepared return to the IRS. I declare all the information furnished by me are true to the best of my knowledge.'
									),
					'proceedtosubmit' =>	array
									(
										'EN' => 'Proceed to Submit',
										'SP' => 'Proceda a que me envíen'
									),
					'irssubmission' =>	array
									(
										'EN' => 'IRS Submission',
										'SP' => 'IRS Sumisión'
									),
					'EIN_help_txt' =>	array
									(
										'EN' => 'Employer Identification Number- EIN is a unique identification number assigned to any business so that they can be easily identified by the IRS (Internal Revenue Service). This is commonly used for reporting taxes to the IRS. It is a nine digit number and is formatted as XX-XXXXXXX.',
										'SP' => 'Employer Identification Number- EIN is a unique identification number assigned to any business so that they can be easily identified by the IRS (Internal Revenue Service). 
												 This is commonly used for reporting taxes to the IRS. 
												 It is a nine digit number and is formatted as XX-XXXXXXX.'
									),
					'VIN_help_txt' =>	array
									(
										'EN' => 'Vehicle Identification Number - VIN is a series of 17 letters and alphabets used by the automotive industry to identify individual vehicles. A VIN can only be made up of the following characters: 0-9, A-Z (uppercase) excluding letters I, O and Q.',
										'SP' => 'Vehicle Identification Number - VIN is a series of 17 letters and alphabets used by the automotive industry to identify individual vehicles. 
												 A VIN can only be made up of the following characters: 0-9, A-Z (uppercase) excluding letters I, O and Q.'
									),	
					'PIN_help_txt' =>	array
									(
										'EN' => 'Personal Identification Number- PIN is a 5 digit number used by the individuals. A PIN is mainly used for any electronic financial transactions.',
										'SP' => 'Personal Identification Number- PIN is a 5 digit number used by the individuals. 
												 A PIN is mainly used for any electronic financial transactions.'
									),
					'currentPassword' =>	array
									(
										'EN' => 'Current Password',
										'SP' => 'Current Password'
									),
					'bankAccNo_txt' =>	array
									(
										'EN' => 'Bank Account Number - 17 alphanumeric characters with hyphens, maximum length 17',
										'SP' => 'Bank Account Number - 17 alphanumeric characters with hyphens, maximum length 17'
									),
					'routingTransit_txt' =>	array
									(
										'EN' => 'Routing Transit Number - 9 digits beginning with 01 through 12, or 21 through 32, maximum length 9',
										'SP' => 'Routing Transit Number - 9 digits beginning with 01 through 12, or 21 through 32, maximum length 9'
									),
					'select_payment' =>	array
									(
										'EN' => 'Please select a payment option. You can make the payment by authorizing a direct debit or use EFTPS.',
										'SP' => 'Please select a payment option. You can make the payment by authorizing a direct debit or use EFTPS.'
									),
					'taxable_as_suspended_vehicle' =>	array
									(
										'EN' => 'A taxable vehicle cannot be a suspended vehicle. A vehicle is said to be suspended from tax if it is expected to be used less than the mileage use limit during a period.',
										'SP' => 'A taxable vehicle cannot be a suspended vehicle. A vehicle is said to be suspended from tax if it is expected to be used less than the mileage use limit during a period.'
									),
					'sold_as_taxable_vehicle' =>	array
									(
										'EN' => 'A vehicle that was sold/ destroyed or stolen cannot be taxable.  Highway motor vehicles that have a taxable gross weight of 55,000 pounds or more is said to be taxable.',
										'SP' => 'A vehicle that was sold/ destroyed or stolen cannot be taxable.  Highway motor vehicles that have a taxable gross weight of 55,000 pounds or more is said to be taxable.'
									),
					'sold_as_suspended_vehicle' =>	array
									(
										'EN' => 'A vehicle that was sold/ destroyed or stolen cannot be suspended from tax. Instead, you can claim a refund from the IRS for the months for which the vehicle was not used.',
										'SP' => 'A vehicle that was sold/ destroyed or stolen cannot be suspended from tax. Instead, you can claim a refund from the IRS for the months for which the vehicle was not used.'
									),
					'priorsuspended_as_lowmileage' =>	array
									(
										'EN' => 'You can claim a credit for a vehicle only when it was used less than the mileage use limit of 5,000 miles or 7, 500 miles for the agricultural vehicles and the tax has been paid to the IRS in the previous tax year and not when it has been exempt from paying the tax amount.',
										'SP' => 'You can claim a credit for a vehicle only when it was used less than the mileage use limit of 5,000 miles or 7, 500 miles for the agricultural vehicles and the tax has been paid to the IRS in the previous tax year and not when it has been exempt from paying the tax amount.'
									),
					'currentPswNotMatching' =>	array
									(
										'EN' => 'Current password entered is not matching please try again.',
										'SP' => 'Current password entered is not matching please try again.'
									),
					'mandatory' =>	array
									(
										'EN' => '[ All fields are mandatory ]',
										'SP' => '[ All fields are mandatory ]'
									),
					'newPswNotSame' =>	array
									(
										'EN' => 'New password should not be same as current password',
										'SP' => 'New password should not be same as current password'
									),
					'amntpaid' =>	array
									(
										'EN' => 'Amount Paid',
										'SP' => 'Amount Paid'
									),
					'full_name' =>	array
									(
										'EN' => 'Full Name',
										'SP' => 'Nombre Completo'
									),
					'SCH1_RECEIVED' =>	array
									(
										'EN' => 'IRS APPROVED',
										'SP' => 'IRS APPROVED'
									),
					'IRS_APPROVED' =>	array
									(
										'EN' => 'IRS APPROVED',
										'SP' => 'IRS APPROVED'
									),
					'IRS_REJECTED' =>	array
									(
										'EN' => 'IRS REJECTED',
										'SP' => 'IRS REJECTED'
									),
					'APPROVAL_PENDING' =>	array
									(
										'EN' => 'APPROVAL PENDING',
										'SP' => 'APPROVAL PENDING'
									),
					'PENDING_SUBMISSION' =>	array
									(
										'EN' => 'PENDING SUBMISSION',
										'SP' => 'PENDING SUBMISSION'
									),
					'INCOMPLETE' =>	array
									(
										'EN' => 'INCOMPLETE',
										'SP' => 'INCOMPLETE'
									),
					'editFilingError' =>	array
									(
										'EN' => 'Cannot edit the completed filing.',
										'SP' => 'Cannot edit the completed filing.'
									),
					'EnterValidPassword' =>	array
									(
										'EN' => 'It should be a Alpha Numeric,Should contain atleast 1 special character.',
										'SP' => 'It should be a Alpha Numeric,Should contain atleast 1 special character.'
									),
					'registerAlertMsg' =>	array
									(
										'EN' => 'Please come back later,</br>we will be live from 6th Feb 2014.',
										'SP' => 'Please come back later,</br>we will be live from 6th Feb 2014.'
									),
					'createNewVinCorrection' =>	array
									(
										'EN' => 'Create new VIN Correction.',
										'SP' => 'Create new VIN Correction.'
									),
					'vincorrectionlistlbl' => array
									(
										'EN' => 'VIN Correction List',
										'SP' => 'VIN Correction List'
									),
					'previousvinlbl' => array
									(
										'EN' => 'Previous VIN',
										'SP' => 'Previous VIN'
									),
					'correctvinlbl' => array
									(
										'EN' => 'Correct VIN',
										'SP' => 'Correct VIN'
									),
					'VINType' => array
									(
										'EN' => 'Type of VIN Correction',
										'SP' => 'Type of VIN Correction'
									),
					'selectDropDownType' => array
									(
										'EN' => 'Select Type',
										'SP' => 'seleccionar Type'
									),
					'editVehicle' => array
									(
										'EN' => 'Edit Vehicles',
										'SP' => 'Edit Vehicles' 
									),
					'EnterValidPreviousvin' =>	array
									(
										'EN' => 'Enter a Valid Previous VIN Number',
										'SP' => 'Enter a Valid Previous VIN Number'
									),
					'EnterValidCorrectionvin' =>	array
									(
										'EN' => 'Enter a Valid Correction VIN Number',
										'SP' => 'Enter a Valid Correction VIN Number'
									),
					'PreAndCorrVinNotSame' =>	array
									(
										'EN' => 'Previous and Correction VIN Number should not be same',
										'SP' => 'Previous and Correction VIN Number should not be same'
									),	
					'earliestDatelbl' =>	array
									(
										'EN' => 'Earliest Date',
										'SP' => 'Earliest Date'
									),
					'LarliestDatelbl' =>	array
									(
										'EN' => 'Latest Date',
										'SP' => 'Latest Date'
									),
					'taxYearEndMonthlbl' =>	array
									(
										'EN' => 'Month Your Income Tax Year Ends',
										'SP' => 'Month Your Income Tax Year Ends'
									),
					'onlyPriorYearSubmission' =>	array
									(
										'EN' => 'You cannot submit your return only with prior year suspended vehicle unless it is your final return.',
										'SP' => 'You cannot submit your return only with prior year suspended vehicle unless it is your final return.'
									),
					'amendedWithoutVehicle' =>	array
									(
										'EN' => 'If Form 2290, "Amended Return" checkbox is checked, then the Schedule 1 must contain at least one VIN.',
										'SP' => 'If Form 2290, "Amended Return" checkbox is checked, then the Schedule 1 must contain at least one VIN.'
									),
					'EnterValidAddress' =>	array
									(
										'EN' => 'Enter a Valid Street Address',
										'SP' => 'Enter a Valid Street Address'
									),
					'addNewVehicleForVINCorrection' => array
									(
										'EN' => 'Add New Vehicle For VIN Correction',
										'SP' => 'Crear Nuevo vehículo para VIN Corrección' 
									),
					'editVehicleForVINCorrection' => array
									(
										'EN' => 'Edit Vehicle For VIN Correction',
										'SP' => 'Editar Vehículo Para VIN Corrección' 
									),
					'retry' => array
									(
										'EN' => 'Retry',
										'SP' => 'Retry' 
									),
					'enterBusinessName' =>	array
									(
										'EN' => 'Enter the Business Name',
										'SP' => 'Enter the Business Name'
									),
					'enterOwnerFirstName' =>	array
									(
										'EN' => 'This is a required entry. Enter the Owner First Name',
										'SP' => 'This is a required entry. Enter the Owner First Name'
									),
					'enterOwnerSecondName' =>	array
									(
										'EN' => 'This is a required entry. Enter the Owner Last Name',
										'SP' => 'This is a required entry. Enter the Owner Last Name'
									),
					'enterEIN' =>	array
									(
										'EN' => 'Enter the EIN',
										'SP' => 'Enter the EIN'
									),
					'enterbusinessAdress1' =>	array
									(
										'EN' => 'This is a required entry. Enter the business address',
										'SP' => 'This is a required entry. Enter the business address'
									),
					'selectCountry' =>	array
									(
										'EN' => 'Select a Country',
										'SP' => 'Select a Country'
									),
					'selectState' =>	array
									(
										'EN' => 'Select a State',
										'SP' => 'Select a State'
									),
					'enterCity' =>	array
									(
										'EN' => 'Enter the City or Town',
										'SP' => 'Enter the City or Town'
									),
					'enterZipcode' =>	array
									(
										'EN' => 'Enter the Zipcode of your business',
										'SP' => 'Enter the Zipcode of your business'
									),
					'enterPhonenumber' =>	array
									(
										'EN' => 'Enter the Phone Number',
										'SP' => 'Enter the Phone Number'
									),		
				 	'enterEmail' =>	array
									(
										'EN' => 'Enter a valid Email Address in the format xx@xxx.xxx',
										'SP' => 'Enter a valid Email Address in the format xx@xxx.xxx'
									),
					'enterSignAuthorityName' =>	array
									(
										'EN' => 'Enter the Signing Authority Name',
										'SP' => 'Enter the Signing Authority Name'
									),
					'enterSignAuthoritytitle' =>	array
									(
										'EN' => 'Enter the Signing Authority"s Title',
										'SP' => 'Enter the Signing Authority"s Title'
									),
					'entersignAuthPhone' =>	array
									(
										'EN' => 'Enter the phone number of the Signing Authority',
										'SP' => 'Enter the phone number of the Signing Authority'
									),
					'entersignAuthPin' =>	array
									(
										'EN' => 'Enter the signing authority pin',
										'SP' => 'Enter the signing authority pin'
									),
					'enterDesigneeName' =>	array
									(
										'EN' => 'This is a required field as you would like to discuss your returns with a third party. Enter the Third party designee"s Name',
										'SP' => 'This is a required field as you would like to discuss your returns with a third party. Enter the Third party designee"s Name'
									),
					'enterDesigneePhone' =>	array
									(
										'EN' => 'This is a required entry. Enter the Designee’s phone number',
										'SP' => 'This is a required entry. Enter the Designee’s phone number'
									),
					'enterDesigneePin' =>	array
									(
										'EN' => 'This is a required entry. Enter the Designee’s PIN',
										'SP' => 'This is a required entry. Enter the Designee’s PIN'
									)								
				);
				?>