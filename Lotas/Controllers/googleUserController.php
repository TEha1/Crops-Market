<?php
/*
**get the code from google api get info of user from User class by function
**GoogleLogin and give it two parameters from gpConfig.php
*/
if(isset($_GET['code']))
{
	try
    {
        include_once '../Models/userClass.php';
        include_once '../Models/gpConfig.php';
        $user = new User();
        $userData = $user->GoogleLogin($_GET['code'],$gClient,$google_oauthV2);
        if($userData['block'] == 0)
        {
            $_SESSION['id']             = $userData['id'];
            $_SESSION['oauth_provider'] = $userData['oauth_provider'];
            $_SESSION['oauth_uid']      = $userData['oauth_uid'];
            $_SESSION['first_name']     = $userData['first_name'];
            $_SESSION['last_name']      = $userData['last_name'];
            $_SESSION['email']          = $userData['email'];
            $_SESSION['gender']         = $userData['gender'];
            $_SESSION['picture']        = $userData['picture'];
            $_SESSION['link']           = $userData['link'];
            if(isset($userData['phone'])) 
            {
                //if user is exist and have phone number in database it will store in session
                $_SESSION['phone'] = $userData['phone'];
            }
            header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
        }
        else
        {
            header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
        }

    }
    catch (Exception $ex) 
    {
        //something wrong happen find an idea
        //echo $ex->getMessage();
        header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_email', FILTER_SANITIZE_URL));
    }
}
else
{
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}