<?php
//finished
if(!isset($_SESSION)){session_start();}
if(isset($_GET['DeleteProduct'])  && isset($_SESSION['admin']) )
{
    try
    {
        include '../Models/productClass.php';
        $product = new Product();
        $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
        $image = $product->selectProduct($id,'image');
        $imageDir='../Resources/ProductImages/'.$image['image'];
        include_once '../Models/fileManagerClass.php';
        $fileManager = new fileManger();
        $fileManager->delete($imageDir);
        $imageDir = "../Resources/QRimages/".$id.".png" ;
        $fileManager->delete($imageDir);
        $product->deleteProduct($id);
        //echo'product Deleted';
        header('Location: ' . filter_var('../Veiw/Products.php', FILTER_SANITIZE_URL));
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