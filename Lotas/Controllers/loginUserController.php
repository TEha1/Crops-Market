<?php
//finish
/*
 * *this is the login controller in first we check if user email exist in database or not 
 * *and if it exist get password and compare with password he was enter and if equal
 * *redirect to home.php and insert his info in session
 */
if (!isset($_SESSION)) {session_start();}
if (isset($_POST['Login'])) {
    try {
        if($_POST['email']=='manager@lotus.com')
        {
            $_SESSION['manegerlog'] = 1;
            $_SESSION['email'] = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            $_SESSION['password'] = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
            header('Location: ' . filter_var('loginManagerController.php', FILTER_SANITIZE_URL));
        }
        elseif (preg_match("/^(admin).+(@lotus.com)$/", $_POST['email'])) {
            $_SESSION['adminlog'] = 1;
            $_SESSION['email'] = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            $_SESSION['password'] = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
            header('Location: ' . filter_var('loginAdminController.php', FILTER_SANITIZE_URL));
        }
        else
        {
            $user_data['email'] = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            include_once '../Models/userClass.php';
            $user = new User();
            $result = $user->LogIn($user_data);
            if ($result != false) {
                if ($result['password'] == filter_var($_POST['password'],FILTER_SANITIZE_STRING)) {
                    if ($result['block'] == 0) {
                        $_SESSION['id']             = $result['id'];
                        $_SESSION['oauth_provider'] = $result['oauth_provider'];
                        $_SESSION['first_name']     = $result['first_name'];
                        $_SESSION['last_name']      = $result['last_name'];
                        $_SESSION['email']          = $result['email'];
                        $_SESSION['gender']         = $result['gender'];
                        $_SESSION['picture']        = $result['picture'];
                        $_SESSION['phone']          = $result['phone'];
                        header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
                    } else {
                        //echo 'block';
                        header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
                    }
                } else {
                    //Wrong password find an idea
                    //echo'Wrong password find an idea';
                    header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_password', FILTER_SANITIZE_URL));
                }
            } else {
                //Wrong email find an idea
                //echo 'Wrong email find an idea';
                header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_email', FILTER_SANITIZE_URL));
            }
        }
        
    } catch (Exception $ex) {
        //someting wrong find an idea
        //echo $ex->getMessage();
        header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_in_system', FILTER_SANITIZE_URL));
    }
} else {
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}