<?php
//finished
if (!isset($_SESSION)) {session_start();}
//$_SESSION['lang'] = 'en';
//$_SESSION['admin'] = 'admin';
if(isset($_SESSION['admin']))
{
    include_once '../Models/productClass.php';
    $product = new Product();
    if (isset($_POST["name"])) {
        $result = $product->checkProduct(filter_var($_POST['name'],FILTER_SANITIZE_STRING));
        if (!$result)
        {
            echo 'This Name Used Before';
        }

    } else {
        $result = $product->checkProduct('' , filter_var($_POST['name_ar'],FILTER_SANITIZE_STRING));
        if (!$result)
        {
             echo 'هذا الاسم مستخدم سابقا';
        }

    }
}