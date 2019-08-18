<?php
if(!isset($_SESSION)){session_start();}
if(isset($_GET['Visible']) && isset($_SESSION['admin']))
{
    try
    {
        include '../Models/productClass.php';
        $product = new Product();
        $product->visible(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT));
        header('Location: ' . filter_var('../Veiw/Products.php', FILTER_SANITIZE_URL));
    }
    catch (Exception $ex) 
    {
        //someting wrong find an idea
        //echo $ex->getMessage();
        header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_in_system', FILTER_SANITIZE_URL));
    }
    
}
else
{
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}