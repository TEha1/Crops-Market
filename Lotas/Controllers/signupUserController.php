<?php
//finished for all 
if(!isset($_SESSION)){session_start();}
if(isset($_POST['SignUp']))
{
	try
    {
        include_once '../Models/userClass.php';
        $user = new User();
        if(!empty($_FILES['image']['name']))
        {
            include_once '../Models/fileManagerClass.php';
            $allowedext = array('png','jpeg','jpg','gif');
            $file = $_FILES['image'];
            $dir = "../Resources/UserImages/";
            $fileManager = new fileManger();
            $diractor = $fileManager->upload($file,$allowedext,$dir);
            $user_data['first_name']     = filter_var($_POST['first_name'],FILTER_SANITIZE_STRING);
            $user_data['last_name']      = filter_var($_POST['last_name'],FILTER_SANITIZE_STRING);
            $user_data['email']          = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            $user_data['password']       = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
            $user_data['gender']         = filter_var($_POST['gender'],FILTER_SANITIZE_STRING);
            $user_data['phone']          = filter_var($_POST['phone'],FILTER_SANITIZE_STRING);
            $user_data['picture']        = $diractor;
            $user_data['oauth_provider'] = "lotus";
            $result = $user->SignUp($user_data);
            $_SESSION['id']             = $result['id'];
            $_SESSION['oauth_provider'] = $result['oauth_provider'];
            $_SESSION['first_name']     = $result['first_name'];
            $_SESSION['last_name']      = $result['last_name'];
            $_SESSION['email']          = $result['email'];
            $_SESSION['gender']         = $result['gender'];
            $_SESSION['picture']        = $result['picture'];
            $_SESSION['phone']          = $result['phone'];
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