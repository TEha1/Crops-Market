<?php
if(!isset($_SESSION))
{
	session_start();
}
include_once 'Facebook/autoload.php';
$config =
[
	'app_id'                =>'263363864422538',
	'app_secret'            =>'6b78cc5cea74147f206f30b7562b2013',
	'default_graph_version' =>'v3.1'
];
$FB = new \Facebook\Facebook($config);
$helper = $FB->getRedirectLoginHelper();
$redirectURL = 'https://teha43.000webhostapp.com/Controllers/facebookUserController.php';

