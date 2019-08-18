<?php
//finished
if(!isset($_SESSION)){session_start();}
if(isset($_GET['block'])&& isset($_SESSION['admin']) )
{
    try
    {
        include '../Models/UserClass.php';
        $user = new User();
        $user->block(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT));
        header('Location: ' . filter_var('../Veiw/Orders_and_Users.php', FILTER_SANITIZE_URL));
    }
    catch (Exception $ex) 
    {
        header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_in_system', FILTER_SANITIZE_URL));
    }
    
}
else
{
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}