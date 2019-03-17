<?php
if(!isset($_SESSION))
{
	session_start();
}
if($_GET['submit'] == 'block' && isset($_SESSION['admin']) && (strcmp($_SERVER['HTTP_REFERER'] , 'http://localhost/Lotas/Models/testModels.php') >=0))
{
    try
    {
        include '../Models/UserClass.php';
        $user = new User();
        $user->block($_GET['id']);
        echo ' Route to home';
        //header('Location: ' . filter_var('../View/ProductInfo.php?id='.$_GET['id'], FILTER_SANITIZE_URL));
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
    //header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}