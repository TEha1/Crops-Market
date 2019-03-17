<?php
if (!isset($_SESSION)) {
	session_start();	
}
//Include Google client library 
include_once 'Google/Google_Client.php';
include_once 'Google/contrib/Google_Oauth2Service.php';

$clientId = '1024606970921-45ac7ppjg3ke5g5amcip09i5lfc9dv61.apps.googleusercontent.com'; 
$clientSecret = 'q5WPV0sitv-1nteW8G-0mNOT'; 
$redirectURL = 'http://localhost/Lotas/Controllers/googleUserController.php'; 

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Lotas');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>