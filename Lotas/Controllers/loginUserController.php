<?php

/*
 * *this is the login controller in first we check if user email exist in database or not 
 * *and if it exist get password and compare with password he was enter and if equal
 * *redirect to home.php and insert his info in session
 */
include '../Resources/Ln/arabic_ln.php';
if (!isset($_SESSION)) {
    session_start();
}
if ($_POST['submit'] == 'Login' || $_POST['submit'] == $NavBar["login"] ) {
    try {
        if ($_POST['email'] == 'admin@lotus.com') {
            $_SESSION['adminlog'] = 1;
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            header('Location: ' . filter_var('loginAdminController.php', FILTER_SANITIZE_URL));
        }
        $user_data['email'] = $_POST['email'];
        //Initialize User class
        include_once '../Models/userClass.php';
        $user = new User();
        $result = $user->LogIn($user_data);
        if ($result != false) {
            if ($result[0]['password'] == $_POST['password']) {
                if ($result[0]['block'] == 0) {
                    $_SESSION['id'] = $result[0]['id'];
                    $_SESSION['oauth_provider'] = $result[0]['oauth_provider'];
                    $_SESSION['first_name'] = $result[0]['first_name'];
                    $_SESSION['last_name'] = $result[0]['last_name'];
                    $_SESSION['email'] = $result[0]['email'];
                    $_SESSION['gender'] = $result[0]['gender'];
                    $_SESSION['picture'] = $result[0]['picture'];
                    if (isset($result[0]['phone'])) {
                        //if user is exist and have phone number in database it will store in session
                        $_SESSION['phone'] = $result[0]['phone'];
                    }
                    //print_r($_SESSION);
                    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
                } else {
                    echo 'block';
                }
            } else {
                //Wrong password find an idea
                echo'Wrong password find an idea';
            }
        } else {
            //Wrong email find an idea
            echo 'Wrong email find an idea';
        }
    } catch (Exception $ex) {
        //someting wrong find an idea
        echo $ex->getMessage();
    }
} else {
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}