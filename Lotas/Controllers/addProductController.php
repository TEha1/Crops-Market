<?php

/*
 * *this page for admin to add product in database and product must have unique name_en
 * *and unique name_ar and the extension of image file like array $allawedext
 * *and you have unlimeted size of your image you upload
 */
if (!isset($_SESSION)) {
    session_start();
}
if ($_POST['submit'] == 'addProduct' && isset($_SESSION['admin'])) {
    if (isset($_FILES)) {
        if (!empty($_FILES['image']['name'])) {
            try {
                include_once'../Models/productClass.php';
                $product = new Product();
                $id = $product->checkProduct($POST["name"], $POST["name_ar"]);
                if ($id == false) {
                    echo '//enter product with the same name for old product find an idea';
                } else {
                    //product is inserted and rout him to productinfo
                    include_once '../Models/fileManagerClass.php';
                    $allowedext = array('png', 'jpeg', 'jpg', 'gif');
                    $file = $_FILES['image'];
                    $dir = "../Resources/ProductImages/";
                    $fileManager = new fileManger();
                    $diractor = $fileManager->upload($file, $allowedext, $dir);
                    $productInfo['name'] = $_POST['name'];
                    $productInfo['name_ar'] = $_POST['name_ar'];
                    $productInfo['active_ingredient_ar'] = $_POST['active_ingredient_ar'];
                    $productInfo['properties_ar'] = $_POST['properties_ar'];
                    $productInfo['features_ar'] = $_POST['features_ar'];
                    $productInfo['active_ingredient'] = $_POST['active_ingredient'];
                    $productInfo['properties'] = $_POST['properties'];
                    $productInfo['features'] = $_POST['features'];
                    $productInfo['image'] = $diractor;
                    $productInfo['video'] = $_POST['video'];
                    $productInfo['category'] = $_POST['category'];

                    $id = $product->addProduct($productInfo);


                    if ($id === 'Not Inserted') {
                        echo '//product not inserted find an idea';
                    } else {
                        header('Location: ' . filter_var('../Veiw/ProductInfo.php?id=' . $id, FILTER_SANITIZE_URL));
                        if ($_POST[$i]['crops'] != '') {
                            $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['crops']);
                        }
                        if ($_POST[$i]['controlled_pest'] != '') {
                            $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['controlled_pest']);
                        }
                        if ($_POST[$i]['rate_of_use'] != '') {
                            $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['rate_of_use']);
                        }
                        if ($_POST[$i]['phi'] != '') {
                            $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['phi']);
                        }
                        if ($_POST[$i]['crops_ar'] != '') {
                            $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['crops_ar']);
                        }
                        if ($_POST[$i]['controlled_pest_ar'] != '') {
                            $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['controlled_pest_ar']);
                        }
                        if ($_POST[$i]['rate_of_use_ar'] != '') {
                            $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['rate_of_use_ar']);
                        }
                        if ($_POST[$i]['phi_ar'] != '') {
                            $product->updateRateOfUse($_POST[$i]['id'], 'crops', $_POST[$i]['phi_ar']);
                        }
                    }
                }
            } catch (Exception $ex) {
                //someting wrong find an idea
                echo $ex->getMessage();
            }
        } else {
            //file not exist find an idea
        }
    } else {
        //file not exist find an idea
    }
} else {
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}
?>