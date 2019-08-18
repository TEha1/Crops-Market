<?php
//finish
/*
**this is log out controller check the oauth_provider and distroy $_SESSION
**and if you not loged in you routed to home.php
*/
if(!isset($_SESSION)){session_start();}
if(isset($_SESSION['oauth_provider']))
{
    //if i log in with gmail i will distroy $gClient and $google_oauthV2
    if(strcmp($_SESSION['oauth_provider'] , 'google')==0)
    {
        include_once '../Models/gpConfig.php';
        $gClient = NULL;
        $google_oauthV2 = NULL;
    }
    //if i log with facebook i will distroy $helper and $FB
    elseif(strcmp($_SESSION['oauth_provider'] , 'facebook')==0)
    {
        include_once '../Models/fbConfig.php'; 
        $helper = NULL;
        $FB = NULL;
    }
    try
    {
        //here we distroy session by LogOut function in User Class 
        include_once '../Models/userClass.php';
        $user = new User();
        $user->LogOut();
        if(!isset($_SESSION)){session_start();}
        header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
    }
    catch (Exception $ex) 
    {
        //someting wrong find an idea
        echo $ex->getMessage();
    }
}
else
{
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}

