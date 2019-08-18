<?php
if (!isset($_SESSION)) {session_start();}
if(isset($_SESSION['admin']))
{
    include_once '../Models/categoryClass.php';
    $category = new Category();
    
    if (isset($_POST["name"])) {
        $result = $category->checkCategory(filter_var($_POST['name'],FILTER_SANITIZE_STRING));
    } else {
        $result = $category->checkCategory('' , filter_var($_POST['name_ar'],FILTER_SANITIZE_STRING));
    }
    if (!$result)
    {
        if($_SESSION['lang'] == 'ar'){
            echo 'هذا الاسم مستخدم سابقا';
        } else {
            echo 'This Name used before';
        }
    }
}