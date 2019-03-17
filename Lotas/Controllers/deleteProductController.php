<?php
if(!isset($_SESSION))
{
	session_start();
}
if($_GET['submit'] == 'DeleteProduct' && isset($_SESSION['admin']) )
{
    try
    {
        include '../Models/productClass.php';
        $product = new Product();
        $image = $product->selectProduct($_GET['id'],'image');
        $imageDir='../Resources/ProductImages/'.$image[0]['image'];
        echo $imageDir;
        include_once '../Models/fileManagerClass.php';
        $fileManager = new fileManger();
        $fileManager->delete($imageDir);
        $product->deleteProduct($_GET['id']);
        
        //header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
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