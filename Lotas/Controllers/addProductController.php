<?php

//finished

if (!isset($_SESSION)) {session_start();}
if (isset($_POST['addProduct'])&& isset($_SESSION['admin'])) {
    
    if (isset($_FILES) && !empty($_FILES['image']['name']) ) {
        try {
            include_once'../Models/productClass.php';
            $product = new Product();
            include_once '../Models/fileManagerClass.php';
            $allowedext = array('png', 'jpeg', 'jpg', 'gif');
            $file = $_FILES['image'];
            $dir = "../Resources/ProductImages/";
            $fileManager = new fileManger();
            $diractor = $fileManager->upload($file, $allowedext, $dir);
            $productInfo['name']                    = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
            $productInfo['name_ar']                 = filter_var($_POST['name_ar'],FILTER_SANITIZE_STRING);
            $productInfo['active_ingredient_ar']    = filter_var($_POST['active_ingredient_ar'],FILTER_SANITIZE_STRING);
            $productInfo['properties_ar']           = filter_var($_POST['properties_ar'],FILTER_SANITIZE_STRING);
            $productInfo['features_ar']             = filter_var($_POST['features_ar'],FILTER_SANITIZE_STRING);
            $productInfo['active_ingredient']       = filter_var($_POST['active_ingredient'],FILTER_SANITIZE_STRING);
            $productInfo['properties']              = filter_var($_POST['properties'],FILTER_SANITIZE_STRING);
            $productInfo['features']                = filter_var($_POST['features'],FILTER_SANITIZE_STRING);
            $productInfo['image']                   = filter_var($diractor,FILTER_SANITIZE_STRING);
            $productInfo['video']                   = filter_var($_POST['video'],FILTER_SANITIZE_STRING);
            $productInfo['category']                = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
            $productInfo['price']                   = filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);
            $id = $product->addProduct($productInfo);
            
            for ( $i = 0 ; $i < 5 ; $i++)
            {
                $s = ($i*8)+1;
                if($_POST[$s] != '')
                {
                    $rateInfo['crops']              = filter_var($_POST[$s],FILTER_SANITIZE_STRING);
                    $rateInfo['controlled_pest']    = filter_var($_POST[$s+1],FILTER_SANITIZE_STRING);
                    $rateInfo['rate_of_use']        = filter_var($_POST[$s+2],FILTER_SANITIZE_STRING);
                    $rateInfo['phi']                = filter_var($_POST[$s+3],FILTER_SANITIZE_STRING);
                    $rateInfo['crops_ar']           = filter_var($_POST[$s+4],FILTER_SANITIZE_STRING);
                    $rateInfo['controlled_pest_ar'] = filter_var($_POST[$s+5],FILTER_SANITIZE_STRING);
                    $rateInfo['rate_of_use_ar']     = filter_var($_POST[$s+6],FILTER_SANITIZE_STRING);
                    $rateInfo['phi_ar']             = filter_var($_POST[$s+7],FILTER_SANITIZE_STRING);
                    $product->addRate($id,$rateInfo);
                }
            }
            header('Location: ' . filter_var('../Veiw/ProductInfo.php?id=' . $id, FILTER_SANITIZE_URL));
        } catch (Exception $ex) {
            header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_in_system', FILTER_SANITIZE_URL));
        }
    } 
} else {
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}

?>