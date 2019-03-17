<?php
if(!isset($_SESSION))
{
	session_start();
}
if($_GET['submit'] == 'Visible' && isset($_SESSION['admin']))
{
    try
    {
        include '../Models/productClass.php';
        $product = new Product();
        $product->visible($_GET['id']);
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
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}