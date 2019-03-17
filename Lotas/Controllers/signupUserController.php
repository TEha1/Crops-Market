<?php
/*
**this is sgin up controller check if password equal to resetpassword    
**and check if user email exist or not and if exist 
**(this step work in user class in function SignUp) blablabla
**and if not exist insert it in database and save his data in $_SESSION
*/
//start session if not started
include '../Resources/arabic_worlds.php';
if(!isset($_SESSION))
{
	session_start();
}
if($_POST['submit'] == 'SignUp' || $_POST['submit'] == $NavBar["login"])
{
	try
    {
        //check that the password equal to resetpasword
        if ($_POST['password'] == $_POST['resetpassword']) 
        {
            //Initialize User class
            include_once '../Models/userClass.php';
            $user = new User();
            $check = $user->Check($_POST['email']);
            if ($check != false) 
            {
                if(!empty($_FILES['image']['name']))
                {
                    include_once '../Models/fileManagerClass.php';
                    $allowedext = array('png','jpeg','jpg','gif');
                    $file = $_FILES['image'];
                    $dir = "../Resources/UserImages/";
                    $fileManager = new fileManger();
                    $diractor = $fileManager->upload($file,$allowedext,$dir);
                    $user_data['first_name']     = $_POST['first_name'];
                    $user_data['last_name']      = $_POST['last_name'];
                    $user_data['email']          = $_POST['email'];
                    $user_data['password']       = $_POST['password'];
                    $user_data['gender']         = $_POST['gender'];
                    $user_data['picture']        = $diractor;
                    $user_data['oauth_provider'] = "lotus";
                    $result = $user->SignUp($user_data);
                    $_SESSION['id']             = $result[0]['id'];
                    $_SESSION['oauth_provider'] = $result[0]['oauth_provider'];
                    $_SESSION['first_name']     = $result[0]['first_name'];
                    $_SESSION['last_name']      = $result[0]['last_name'];
                    $_SESSION['email']          = $result[0]['email'];
                    $_SESSION['gender']         = $result[0]['gender'];
                    $_SESSION['picture']        = $result[0]['picture'];
                    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
                }
                
            }
            else
            {
                //this email is exist find an idea
                echo'this email is exist find an idea';
            }
        }
        else
        {
            //password not equal to resetpassword find an idea
            echo'password not equal to resetpassword find an idea';
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
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}