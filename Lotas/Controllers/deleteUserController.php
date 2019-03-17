<?php
if(!isset($_SESSION))
{
	session_start();
}
if($_GET['submit'] == 'DeleteUser')
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
            $user->deleteUser($_SESSION['id']);
            $user->LogOut();
            echo 'google';
            //header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
        }
        elseif(strcmp($_SESSION['oauth_provider'] , 'facebook') == 0)
        {
            include_once '../Models/fbConfig.php'; 
            $helper = NULL;
            $FB = NULL;
            $user->deleteUser($_SESSION['id']);
            $user->LogOut();
            echo 'facebook';
            //header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
        }
        else
        {
            $image = $user->selectuser($_SESSION['id'],'picture');
            $imageDir='../Resources/UserImages/'.$image[0]['picture'];
            include_once '../Models/fileManagerClass.php';
            $fileManager = new fileManger();
            $fileManager->delete($imageDir);
            $user->deleteUser($_SESSION['id']);
            $user->LogOut();
            echo 'lotus';
            //header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
        }
        
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
    //header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}