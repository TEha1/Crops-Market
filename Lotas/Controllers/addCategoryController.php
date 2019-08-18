<?php
//finished
if (!isset($_SESSION)) {session_start();}
if (isset($_POST['addcategory']) && isset($_SESSION['admin'])) {
    try {
        include_once'../Models/categoryClass.php';
        $category = new Category();
        $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $name_ar = filter_var($_POST['name_ar'],FILTER_SANITIZE_STRING);
        $category->addCategory($name,$name_ar );
        header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
        
    } catch (Exception $ex) {
        //someting wrong find an idea
        header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_in_system', FILTER_SANITIZE_URL));
    }
} else {
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}