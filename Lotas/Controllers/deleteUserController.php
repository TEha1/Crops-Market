<?php
//finish
if(!isset($_SESSION)){session_start();}
if(isset($_GET['DeleteUser'])&& isset($_SESSION['id']))
{
    try
    {
        include '../Models/userClass.php';
        $user = new User();
        if(strcmp ($_SESSION['oauth_provider'] , 'google') == 0)
        {
            include_once '../Models/gpConfig.php';
            $gClient = NULL;
            $google_oauthV2 = NULL;
            $user->DeleteUser($_SESSION['id']);
            $lang = $_SESSION['lang'];
            $user->LogOut();
            if(!isset($_SESSION)){session_start();}
            $_SESSION['lang'] = $lang;
            //echo 'google';
            header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
        }
        elseif(strcmp($_SESSION['oauth_provider'] , 'facebook') == 0)
        {
            include_once '../Models/fbConfig.php'; 
            $helper = NULL;
            $FB = NULL;
            $user->DeleteUser($_SESSION['id']);
            $lang = $_SESSION['lang'];
            $user->LogOut();
            if(!isset($_SESSION)){session_start();}
            $_SESSION['lang'] = $lang;
            //echo 'facebook';
            header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
        }
        else
        {
            $image = $user->SelectUser($_SESSION['id'],'picture');
            $imageDir='../Resources/UserImages/'.$image['picture'];
            include_once '../Models/fileManagerClass.php';
            $fileManager = new fileManger();
            $fileManager->delete($imageDir);
            $user->DeleteUser($_SESSION['id']);
            $lang = $_SESSION['lang'];
            $user->LogOut();
            if(!isset($_SESSION)){session_start();}
            $_SESSION['lang'] = $lang;
            //echo 'lotus';
            header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
        }
        
    }
    catch (Exception $ex) 
    {
        //someting wrong find an idea
        //echo $ex->getMessage();
        header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_in_system', FILTER_SANITIZE_URL));
    }
    
}
else
{
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}