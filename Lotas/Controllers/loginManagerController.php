<?php
//finish
if (!isset($_SESSION)) {session_start();}
if ($_SESSION['managerlog'] = 1) {
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    session_destroy();
    session_start();
    include_once '../Models/adminClass.php';
    $admin = new Admin();
    $pass = $admin->selectManager(1,'password');
    try {
         if ($password == $pass['password']) {
            $_SESSION['manager'] = 1;
            $_SESSION['admin'] = 1 ;
            //echo $_SESSION['admin'];
            header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
        } else {
            //echo 'Wrong Admin Password';
            header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_password', FILTER_SANITIZE_URL));
        }
        
    } catch (Exception $ex) {
        //someting wrong find an idea
        //echo $ex->getMessage();
        header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_in_system', FILTER_SANITIZE_URL));
    }
} else {
    //echo '//someone go direct to this page and route to home';
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}