<?php

if (!isset($_SESSION)) {
    session_start();
}
include_once '../Models/adminClass.php';
$admin = new Admin();
$result = $admin->Check(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
if ($result) {
    if ($_SESSION['lang'] == 'ar') {
        echo 'هذا البريد الالكتروني مستخدم سابقا';
    } else {
        echo 'This email is already used';
    }
} else {
    echo '';
}
