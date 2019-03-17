<?php

if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['adminlog'] = 1) {
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    session_destroy();
    session_start();
    try {
        include_once '../Models/adminClass.php';
        $admin = new Admin();

        $adminData = $admin->loginAdmin($email);
        if ($adminData != false) {
            if ($password == $adminData[0]['password']) {
                $_SESSION['admin'] = $adminData[0]['id'] . $adminData[0]['email'];
                echo $_SESSION['admin'];
                //header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
            } else {
                echo ' Wrong Admin Password';
            }
        } else {
            echo ' Wrong Admin Mail';
        }
    } catch (Exception $ex) {
        //someting wrong find an idea
        echo $ex->getMessage();
    }
} else {
    echo '//someone go direct to this page and route to home';
    //header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}