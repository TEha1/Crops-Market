<?php
if (!isset($_SESSION)) {session_start();}
if (isset($_POST['updateProduct'])&& isset($_SESSION['admin'])) {
    try {
        include '../Models/productClass.php';
        $product = new Product();
        $id = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT );
        if ($_POST['name'] != '') {
            $product->updateProduct($id, 'name', filter_var($_POST['name'],FILTER_SANITIZE_STRING));
        }
        if ($_POST['name_ar'] != '') {
            $product->updateProduct($id, 'name_ar', filter_var($_POST['name_ar']),FILTER_SANITIZE_STRING);
        }
        if ($_POST['active_ingredient_ar'] != '') {
            $product->updateProduct($id, 'active_ingredient_ar', filter_var($_POST['active_ingredient_ar'],FILTER_SANITIZE_STRING));
        }
        if ($_POST['properties_ar'] != '') {
            $product->updateProduct($id, 'properties_ar', filter_var($_POST['properties_ar'],FILTER_SANITIZE_STRING));
        }
        if ($_POST['features_ar'] != '') {
            $product->updateProduct($id, 'features_ar',filter_var( $_POST['features_ar'],FILTER_SANITIZE_STRING));
        }
        if ($_POST['active_ingredient'] != '') {
            $product->updateProduct($id, 'active_ingredient',filter_var( $_POST['active_ingredient'],FILTER_SANITIZE_STRING));
        }
        if ($_POST['properties'] != '') {
            $product->updateProduct($id, 'properties', filter_var($_POST['properties'],FILTER_SANITIZE_STRING));
        }
        if ($_POST['features'] != '') {
            $product->updateProduct($id, 'features',filter_var( $_POST['features'],FILTER_SANITIZE_STRING));
        }
        if ($_POST['video'] != '') {
            $product->updateProduct($id, 'video', filter_var($_POST['video'],FILTER_SANITIZE_STRING));
        }
        if ($_POST['category'] != '') {
            $product->updateProduct($id, 'category', filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT));
        }
        if (isset($_FILES) && !empty($_FILES['image']['name'])) {
            $image = $product->selectProduct($id, 'image');
            $imageDir = '../Resources/ProductImages/' . $image['image'];
            include_once '../Models/fileManagerClass.php';
            $fileManager = new fileManger();
            $fileManager->delete($imageDir);
            $allowedext = array('png', 'jpeg', 'jpg', 'gif');
            $file = $_FILES['image'];
            $dir = "../Resources/ProductImages/";
            $diractor = $fileManager->upload($file, $allowedext, $dir);
            $product->updateProduct($id, 'image', $diractor);
        }
        $number = $product->getNumberOfRate($id);
        for ( $i = 0 ; $i < $number ; $i++)
        {
            $s = ($i*9)+1;
            $idR = filter_var($_POST[$s],FILTER_SANITIZE_NUMBER_INT);
            if ($_POST[$s+1] != '') {
                $product->updateRate($idR,'crops',filter_var($_POST[$s+1],FILTER_SANITIZE_STRING));
                
            }
            if ($_POST[$s+2] != '') {
                $product->updateRate($idR,'controlled_pest',filter_var($_POST[$s+2],FILTER_SANITIZE_STRING));
            }
            if ($_POST[$s+3] != '') {
                $product->updateRate($idR,'rate_of_use',filter_var($_POST[$s+3],FILTER_SANITIZE_STRING));
            }
            if ($_POST[$s+4] != '') {
                $product->updateRate($idR,'phi',filter_var($_POST[$s+4],FILTER_SANITIZE_STRING));
            }
            if ($_POST[$s+5] != '') {
                $product->updateRate($idR,'crops_ar',filter_var($_POST[$s+5],FILTER_SANITIZE_STRING));
            }
            if ($_POST[$s+6] != '') {
                $product->updateRate($idR,'controlled_pest_ar',filter_var($_POST[$s+6],FILTER_SANITIZE_STRING));
            }
            if ($_POST[$s+7] != '') {
                $product->updateRate($idR,'rate_of_use_ar',filter_var($_POST[$s+7],FILTER_SANITIZE_STRING));
            }
            if ($_POST[$s+8] != '') {
                $product->updateRate($idR,'phi_ar',filter_var($_POST[$s+8],FILTER_SANITIZE_STRING));
            }
        }
        header('Location: ' . filter_var('../Veiw/ProductInfo.php?id=' . $_POST['id'], FILTER_SANITIZE_URL));
    } catch (Exception $ex) {
        //someting wrong find an idea
        //echo $ex->getMessage();
        header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_in_system', FILTER_SANITIZE_URL));
    }
} else {
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}