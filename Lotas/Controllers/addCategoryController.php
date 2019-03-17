<?php

if (!isset($_SESSION)) {
    session_start();
}
if ($_POST['submit'] == 'addcategory' && isset($_SESSION['admin'])) {
    try {
        include_once'../Models/categoryClass.php';
        $category = new Category();
        $result = $category->addCategory($_POST['name_en'], $_POST['name_ar']);
        if ($result == false) {
            echo '//enter category with the same name for old category find an idea';
        } elseif ($result === 'Not Inserted') {
            echo '//category not inserted find an idea';
        } else {
            //category is inserted and rout him to home
            header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
        }
    } catch (Exception $ex) {
        //someting wrong find an idea
        echo $ex->getMessage();
    }
} else {
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}