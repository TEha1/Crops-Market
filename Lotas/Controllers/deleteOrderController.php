<?php
//finished
if(!isset($_SESSION)){session_start();}
if(isset($_GET['id']) && (isset($_SESSION['admin']) || isset($_SESSION['id']) ) )
{
    try
    {
        include_once '../Models/orderClass.php';
        $order = new Order();
        if(isset($_SESSION['admin']))
        {
            $order->deleteOrder(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT));
            //echo '//order is deleted by admin and rout him to myprofile';
            header('Location: ' . filter_var('../Veiw/Orders_and_Users.php?pageUser=1&pageOrder=1', FILTER_SANITIZE_URL));
        }
        else
        {
            $order->deleteOrder(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT),$_SESSION['id']);
            //echo '//order is deleted by user and rout him to myprofile';
            header('Location: ' . filter_var('../Veiw/myProfile.php', FILTER_SANITIZE_URL));
        }
        //header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));    
    }
    catch (Exception $ex) 
    {
        header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_in_system', FILTER_SANITIZE_URL));
        //echo $ex;
    }
}
else
{
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}
?>