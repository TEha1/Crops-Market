<?php

//finished
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['addAdmin']) && isset($_SESSION['manager'])) {
    try {
        include_once '../Models/adminClass.php';
        $admin = new Admin();
        $adminData['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $adminData['password'] = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $admin->addAdmin($adminData);
        //echo '//order is inserted and rout him to myprofile';
        header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
    } catch (Exception $ex) {
        header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_in_system', FILTER_SANITIZE_URL));
    }
} else {
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}