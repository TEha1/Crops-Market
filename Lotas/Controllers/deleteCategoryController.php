<?php
//finished
if(!isset($_SESSION)){session_start();}
if(isset($_POST['DeleteCategory']) && isset($_SESSION['admin']))
{
    try
    {
        include_once'../Models/categoryClass.php';
        $category = new Category();
        $category->deleteCategory(filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT));
        //echo '//order deleted and route him to home';
        header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
    }
    catch (Exception $ex) 
    {
        header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_in_system', FILTER_SANITIZE_URL));
    }
}
else
{
    //echo '//someone go direct to this page and route to home';
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}