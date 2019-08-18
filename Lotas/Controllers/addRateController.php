<?php
//finished
if(!isset($_SESSION)){session_start();}
if(isset($_POST["addNewRow"]) && isset($_SESSION['admin']) )
{
    try
    {
        include '../Models/productClass.php';
        $product = new Product();
        $rateInfo['crops']              = filter_var($_POST['crops'],FILTER_SANITIZE_STRING);
        $rateInfo['controlled_pest']    = filter_var($_POST['controlled_pest'],FILTER_SANITIZE_STRING);
        $rateInfo['rate_of_use']        = filter_var($_POST['rate_of_use'],FILTER_SANITIZE_STRING);
        $rateInfo['phi']                = filter_var($_POST['phi'],FILTER_SANITIZE_STRING);
        $rateInfo['crops_ar']           = filter_var($_POST['crops_ar'],FILTER_SANITIZE_STRING);
        $rateInfo['controlled_pest_ar'] = filter_var($_POST['controlled_pest_ar'],FILTER_SANITIZE_STRING);
        $rateInfo['rate_of_use_ar']     = filter_var($_POST['rate_of_use_ar'],FILTER_SANITIZE_STRING);
        $rateInfo['phi_ar']             = filter_var($_POST['phi_ar'],FILTER_SANITIZE_STRING);
        $product->addRate($_POST['product_id'],$rateInfo);
        header('Location: ' . filter_var('../Veiw/Admin_edit_product.php?id='.$_POST['product_id'], FILTER_SANITIZE_URL));
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