<?php
if(!isset($_SESSION))
{
	session_start();
}
if($_POST['submit'] == 'DeleteCategory' && isset($_SESSION['admin']))
{
    try
    {
        include_once'../Models/categoryClass.php';
        $category = new Category();
        $category->deleteCategory($_POST['id']);
        
        header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
    }
    catch (Exception $ex) 
    {
        //someting wrong find an idea
        echo $ex->getMessage();
    }
    
}
else
{
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}