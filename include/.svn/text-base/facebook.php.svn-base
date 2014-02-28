<?php
require_once 'class.xhttp.php';
require_once '../config.php';
require_once '../constants.php';
require_once 'MCrypt.php';

$MCrypt	= new MCrypt;
		 
$client_id     = TT_FB_CLIENT_ID; # the application ID
$client_secret = TT_FB_CLIENT_SECRET_ID;

$callbackURL   = TT_SITE_NAME.'include/facebook.php';
$extendedPermissions = 'email,friends_likes';



if(isset($_GET['signin'])) {

        # STEP 1: Redirect user to Facebook, to grant permission for our application
        $url = 'https://graph.facebook.com/oauth/authorize?' . xhttp::toQueryString(array(
                'client_id'    => $client_id,
                'redirect_uri' => $callbackURL,
                'scope'        => $extendedPermissions,
        ));
        header("Location: $url", true, 303);
        die();
}

if(isset($_GET['code'])) {

        # STEP 2: Exchange the code that we have for an access token
        $data = array();
        $data['get'] = array(
                'client_id'     => $client_id,
                'client_secret' => $client_secret,
                'code'              => $_GET['code'],
                'redirect_uri'  => $callbackURL,
                );
        $response = xhttp::fetch('https://graph.facebook.com/oauth/access_token', $data);
        
        if($response['successful'])
        {

                $data = xhttp::toQueryArray($response['body']);
                $_SESSION['access_token'] = $data['access_token'];
                $fb_user_array = array();
                //get Facbook user profile
                $user = json_decode(file_get_contents('https://graph.facebook.com/me?access_token='.$_SESSION['access_token']));
                $fb_user_array['fb_user_id'] = $user->{'id'};
                $fb_user_array['fbaccess_token'] = $data['access_token'];
                $fb_user_array['first_name'] = $MCrypt->encrypt($user->{'first_name'});
                $fb_user_array['last_name'] = $MCrypt->encrypt($user->{'last_name'});
                $fb_user_array['fbemail'] = $MCrypt->encrypt($user->{'email'});
                $fb_user_array['profileimg'] = "http://graph.facebook.com/". $user->{'id'}."/picture?type=large";

                //checking weather user registered or not
                if(!empty($fb_user_array['fb_user_id']))
                {
                	include_once($_SERVER['DOCUMENT_ROOT'].'/entity/register_entity.php');
                	$registerDAO = new Register_DAO;
					global $DBH;
					$sql = 'SELECT * FROM `tt_users` WHERE `fb_id` = ? AND `active` = ?';
					$chkFBRegistrationStatus = $DBH->prepare($sql);
					$chkFBRegistrationStatus->execute(array($fb_user_array['fb_user_id'],1));		
					$count = $chkFBRegistrationStatus->rowCount();
					$chkFBRegistrationStatus->setFetchMode(PDO::FETCH_ASSOC);
					$row = $chkFBRegistrationStatus->fetch();
					if($count == 0)
					{

						$userId = $registerDAO->insertFBUserdetails($fb_user_array);
						$_SESSION['user_id'] = $userId;			
						$_SESSION['first_name'] = $MCrypt->decrypt($fb_user_array['first_name']);
//						$_SESSION['user_privilages'] = '0';
						$_SESSION['user_type'] = '2';
						
						$registerDAO->insertLoggingTime($userId,true);
						$userLoginStatus = 'ok';
					}
					else 
					{
						$_SESSION['user_id'] = $row['id'];			
						$_SESSION['first_name'] = $MCrypt->decrypt($row['first_name']);
//						$_SESSION['user_privilages'] = $row['user_privileges'];
						$_SESSION['user_type'] = $row['user_type'];
						
						$registerDAO->insertLoggingTime($row['id'],true);
						$userLoginStatus = 'ok';						
					}
					header('Location: '.TT_SITE_NAME.'taxpayerbusiness/');				
					exit();	
                }
        }
        else
        {
                print_r($response['body']);
        }
}

if(isset($_GET['error']) and isset($_GET['error_reason']) and isset($_GET['error_description'])) {
        # error_reason: user_denied
        # error: access_denied
        # error_description: The user denied your request.
        header('Location: '.TT_SITE_NAME);		
		exit();	
}
?>