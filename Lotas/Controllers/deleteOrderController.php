<?php
if(!isset($_SESSION))
{
	session_start();
}
if(isset($_GET['id']) && isset($_SESSION['id']) )
{
    try
    {
        echo'enter';
        include_once '../Models/orderClass.php';
        $order = new Order();
        $order->deleteOrderByUser($_SESSION['id'],$_GET['id']);
        echo '//order is deleted and rout him to myprofile';
        //header('Location: ' . filter_var('../Veiw/ProductInfo.php?id='.$id, FILTER_SANITIZE_URL));    
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
?>