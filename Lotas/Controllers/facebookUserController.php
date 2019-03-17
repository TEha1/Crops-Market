<?php
/*
**get the code from facebook api get info of user from User class by function
**FacebookLogin and give it two parameters from fbConfig.php
*/
if(isset($_GET['code']))
{
    try
    {
        include_once '../Models/userClass.php';
        include_once '../Models/fbConfig.php'; 
        //Initialize User class
        $user = new User();
        //get user data from FacebookLogin
        $userData = $user->FacebookLogin($helper,$FB);
        //Storing user data into session
        if($userData[0]['block'] == 0)
        {
            $_SESSION['id'] = $userData[0]['id'];
            $_SESSION['oauth_provider'] = $userData[0]['oauth_provider'];
            $_SESSION['oauth_uid'] = $userData[0]['oauth_uid'];
            $_SESSION['first_name'] = $userData[0]['first_name'];
            $_SESSION['last_name'] = $userData[0]['last_name'];
            $_SESSION['email'] = $userData[0]['email'];
            $_SESSION['gender'] = $userData[0]['gender'];
            $_SESSION['picture'] = $userData[0]['picture'];
            $_SESSION['link'] = $userData[0]['link'];
            //if user is exist and have phone number in database it will store in session
            if(isset($userData[0]['phone'])) 
            {
                $_SESSION['phone'] = $userData[0]['phone'];
            }
            header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
        }
        else
        {
            echo'block';
        }
        
    }
    catch (Exception $ex) 
    {
        //something wrong happen find an idea
        echo $ex->getMessage();
    }
}
else
{
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}