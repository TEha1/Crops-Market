<?php
if(!isset($_SESSION))
{
	session_start();
}
if($_POST['submit'] == 'Update' && $_SESSION['oauth_provider'] != 'lotus')
{
    try
    {
        include '../Models/userClass.php';
        $user = new User();  
        if($_POST['phone']!='')
        {
            if(preg_match("/^(015|010|011|012)[0-9]{8}$/", $_POST['phone']))
            {
                if($user->updateuser($_SESSION['id'],'phone',$_POST['phone']))
                {
                    $_SESSION['phone'] = $_POST['phone'];
                }
            }
            else
            {
                //Wrong phone number
                //phone number not match find an idea
                echo'Wrong phone number';
            }
        }
        
        
        //header('Location: ' . filter_var('../Veiw/myProfile.php', FILTER_SANITIZE_URL));
    }
    catch (Exception $ex) 
    {
        //someting wrong find an idea
        echo $ex->getMessage();
    }
}
else
{
    echo '//someone go direct to this page and route to home';
    //header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}