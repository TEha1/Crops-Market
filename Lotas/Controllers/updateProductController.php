<?php

if (!isset($_SESSION)) {
    session_start();
}
if ($_POST['submit'] == 'UpdateProduct' && isset($_SESSION['admin'])) {
    try {
        include '../Models/productClass.php';
        $product = new Product();
        if ($_POST['name'] != '') {
            $product->updateproduct($_POST['id'], 'name', $_POST['name']);
        }
        if ($_POST['name_ar'] != '') {
            $product->updateproduct($_POST['id'], 'name_ar', $_POST['name_ar']);
        }
        if ($_POST['active_ingredient_ar'] != '') {
            $product->updateproduct($_POST['id'], 'active_ingredient_ar', $_POST['active_ingredient_ar']);
        }
        if ($_POST['properties_ar'] != '') {
            $product->updateproduct($_POST['id'], 'properties_ar', $_POST['properties_ar']);
        }
        if ($_POST['features_ar'] != '') {
            $product->updateproduct($_POST['id'], 'features_ar', $_POST['features_ar']);
        }
        if ($_POST['active_ingredient'] != '') {
            $product->updateproduct($_POST['id'], 'active_ingredient', $_POST['active_ingredient']);
        }
        if ($_POST['properties'] != '') {
            $product->updateproduct($_POST['id'], 'properties', $_POST['properties']);
        }
        if ($_POST['features'] != '') {
            $product->updateproduct($_POST['id'], 'features', $_POST['features']);
        }
        if ($_POST['image'] != '') {
            $product->updateproduct($_POST['id'], 'image', $_POST['image']);
        }
        if ($_POST['video'] != '') {
            $product->updateproduct($_POST['id'], 'video', $_POST['video']);
        }
        if ($_POST['category'] != '') {
            $product->updateproduct($_POST['id'], 'category', $_POST['category']);
        }
        if (isset($_FILES) && !empty($_FILES['image']['name'])) {
            //get the old image director and delete it
            $image = $product->selectPeoduct($_POST['id'], 'image');
            $imageDir = '../Resources/ProductImages/' . $image[0]['image'];
            include_once '../Models/fileManagerClass.php';
            $fileManager = new fileManger();
            $fileManager->delete($imageDir);
            $allowedext = array('png', 'jpeg', 'jpg', 'gif');
            $file = $_FILES['image'];
            $dir = "../Resources/ProductImages/";
            //upload the new image and save director in DB
            $diractor = $fileManager->upload($file, $allowedext, $dir);
            $product->updateproduct($_POST['id'], 'image', $diractor);
        }
        $number = $product->getNumberOfRateOfUse($_POST['id']);
        for ($i=1; $i< $number; $i++) {
            if($_POST[$i]['crops'] != '') {
                $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['crops']);
            }
            if($_POST[$i]['controlled_pest'] != '') {
                $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['controlled_pest']);
            }
            if($_POST[$i]['rate_of_use'] != '') {
                $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['rate_of_use']);
            }
            if($_POST[$i]['phi'] != '') {
                $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['phi']);
            }
            if($_POST[$i]['crops_ar'] != '') {
                $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['crops_ar']);
            }
            if($_POST[$i]['controlled_pest_ar'] != '') {
                $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['controlled_pest_ar']);
            }
            if($_POST[$i]['rate_of_use_ar'] != '') {
                $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['rate_of_use_ar']);
            }
            if($_POST[$i]['phi_ar'] != '') {
                $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['phi_ar']);
            }
        }
        header('Location: ' . filter_var('../Veiw/ProductInfo.php?id=' . $_POST['id'], FILTER_SANITIZE_URL));
    } catch (Exception $ex) {
        //someting wrong find an idea
        echo $ex->getMessage();
    }
} else {
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}