<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['admin']) && $_GET["id"]) {
    $id = $_GET["id"];
    include '../Models/productClass.php';
    $product = new Product();
    $result = $product->checkProductId($id);
    if($result) {
        header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
    }
    $productData = $product->getProduct($id);
} else {
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}
include './NavBar.php';
?>

<div class="container-fluid myNavTabs">

    <form action="../Controllers/updateProductController.php" method="POST" enctype="multipart/form-data">
        <ul class="nav nav-tabs nav-justified">
            <?php
            echo '<li class="active"><a href="#defention" data-toggle="pill">' . $Admin_Product["definition"] . '</a></li>
                <li><a href="#structure" data-toggle="pill">' . $Admin_Product["structure"] . '</a></li>
                <li><a href="#usingWay" data-toggle="pill">' . $Admin_Product["using_way"] . '</a></li>
                <li><a href="#advantages" data-toggle="pill">' . $Admin_Product["rate_of_use"] . '</a></li>';
            ?>
        </ul>
        <div class="tab-content">
        <input name="id" style="display:none" value="<?php echo $id ?>">
            <div id="defention" class="tab-pane fade in active">
                <a class="btn btn-primary english_defenition_btn ">En</a>
                <hr>
                <div class="row english_defenition traverse_en" style="display: none">
                    <div class="col-sm-5 well" >

                        <div class=" admin_prod_img">
                        <?php echo '<img src="../Resources/ProductImages/'.$productData["image"].'">'?>
                            
                        </div>
                        <div class="text-center upload_form" >
                            <input type="file" name="image">
                        </div><br>
                        <div class="form-group">
                            <span >Select Category :</span><br>
                            <select name="category" class="deletecategory_submit">
                            <option value=""> </option>
                            <?php
                            include_once '../Models/categoryClass.php';
                            $category = new Category();
                            $data = $category->getAllCategories();
                            foreach ($data as $cat) {
                                if($cat['id'] == $productData['category'])
                                {
                                    echo '<option disabled value="' . $cat['id'] . '">' . $cat['name'] . '</option>';
                                }
                                else
                                {
                                    echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>';
                                }
                                
                            }
                            ?>
                            </select>
                        </div>

                    </div>
                    <div class="col-sm-7 prod_info ">
                        <?php
                        echo '<h4 class="">' . $English["product_name"] . ':</h4>
                        <input id="productNameEdit" class="well header_test" type="text" name="name" placeholder="'.$productData["name"].'">
                        <b id="notMatechedEdit_1" class="not_matched">not matched</b>
                        ';
                        ?>
                    </div>
                </div>

                <a class="btn btn-primary arabic_defenition_btn ">Ar</a>
                <hr>
                <div class=" arabic_defenition traverse_ar">

                    <div class=" prod_info ">
                        <?php
                        echo '<h4 class="">' . $Arabic["product_name"] . ':</h4>
                        <input id="productNameEditAr" class="well header_test" type="text" name="name_ar" placeholder="'.$productData["name_ar"].'">
                        <b id="notMatechedEdit_2" class="not_matched">not matched</b>
                        ';
                        
                        ?>
                    </div>

                </div>
        </div>
                <div id="structure" class="tab-pane fade product_struct well">
                    <a class="btn btn-primary english_structure_btn ">En</a>
                    <hr>
                    <ul class="struc_ english_structure traverse_en">
                        <?php
                        echo '
                        
                        <li>' . $English["active_ingredient"] . ':</li>
                        <textarea class="well" maxlength="545" name="active_ingredient" placeholder="'.$productData["active_ingredient"].'"></textarea>

                        <li>' . $English["properties"] . ':</li>
                        <textarea class="well" maxlength="545" name="properties" placeholder="'.$productData["properties"].'"></textarea>

                        <li>' . $English["features"] . ':</li>
                        <textarea class="well" maxlength="545" name="features" placeholder="'.$productData["features"].'"></textarea>
                        ';
                        ?>
                    </ul>
                    <a class="btn btn-primary arabic_structure_btn ">Ar</a>
                    <hr>
                    <?php
                    echo '<ul class="struc_ arabic_structure traverse_ar">
                        <li>' . $Arabic["active_ingredient"] . ':</li>
                        <textarea class="well" maxlength="545" name="active_ingredient_ar" placeholder="'.$productData["active_ingredient_ar"].'"placeholder=""></textarea>

                        <li>' . $Arabic["properties"] . ':</li>
                        <textarea class="well" maxlength="545"  name="properties_ar" placeholder="'.$productData["properties_ar"].'"></textarea>

                        <li>' . $Arabic["features"] . ':</li>
                        <textarea class="well" maxlength="545" name="features_ar" placeholder="'.$productData["features_ar"].'"></textarea>
                    </ul>';
                    ?>

                </div>

                <div id="usingWay" class="tab-pane fade product_struct well">

                    <ul class="well struc_">
                        <?php 
                        echo '
                        <li>'.$Admin_Product["explanation_video_id"].':</li>
                        <textarea class="well" maxlength="545" name="video" placeholder="'.$productData["video"].'"></textarea>
                        ';
                        ?>
                        
                    </ul>
                </div>
                <div id="advantages" class="tab-pane fade">
                    <div class="container-fluid" style="overflow-x: auto">
                        <table id="prodTable" class="prod_table">
                            <tr>
                                <?php
                                echo '
                
                <th>' . $ProductInfo["crops"] . '</th>
                <th>' . $ProductInfo["controlled_pest"] . '</th>
                <th>' . $ProductInfo["rate_of_use"] . '</th>
                <th>' . $ProductInfo["phi"] . '</th>
                <th> delete </th>'
                ;
                                ?>
                            </tr>
                            
                        <?php 
                        $num=$product->getNumberOfRate($id);
                        $rateData = $product->selectRate($id);
                        $i=0;

                        foreach($rateData as $rate)
                        {
                            $s = ($i*9)+1;
                            echo '<input name="'.($s).'" value="'.$rate['id'].'" style="display: none">';
                            echo '<tr>
                                    <td>
                                        <textarea class="well traverse_en" type="text" name="'.($s+1).'" placeholder="'.$rate['crops'].'" ></textarea><br>
                                        <textarea class="well traverse_ar"  type="text" name="'. ($s+5) .'" placeholder="'.$rate['crops_ar'].'" ></textarea>
                                    </td>
                                    <td>
                                        <textarea class="well traverse_en" type="text" name="'.($s+2) .'" placeholder="'.$rate['controlled_pest'].'" ></textarea><br>
                                        <textarea class="well traverse_ar"  type="text" name="'.($s+6) .'" placeholder="'.$rate['controlled_pest_ar'].'" ></textarea>
                                    </td>
                                    <td>
                                        <textarea class="well traverse_en" type="text" name="'.($s+3) .'" placeholder="'.$rate['rate_of_use'].'" ></textarea><br>
                                        <textarea class="well traverse_ar"  type="text" name="'.($s+7) .'" placeholder="'.$rate['rate_of_use_ar'].'" ></textarea>
                                    </td>
                                    <td>
                                        <textarea class="well traverse_en" type="text" name="'.($s+4) .'" placeholder="'.$rate['phi'].'" ></textarea><br>
                                        <textarea class="well traverse_ar"  type="text" name="'.($s+8) .'" placeholder="'.$rate['phi_ar'].'" ></textarea>
                                    </td>
                                    <td>
                                        <a href="../Controllers/deleteRateController.php?DeleteRate=1&id='.$rate['id'].'" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                    </td>
                                </tr>';
                            $i++;
                        }
                        
                        ?>
                        </table>
                    </div>
            <div class="done_container"> 
                <span class="btn btn-success btn-md" data-toggle="modal" data-target="#addRowModal">
                    <span class="glyphicon glyphicon-plus"></span>
                </span>
            </div>
                </div>
            </div>
            <div class="done_container">
                <input id="editProduct__" type="submit" name="updateProduct" value="Done"
                       class="btn btn-success btn-md done">
            </div>
    </form>
    
</div>

<div class="modal fade" id="addRowModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="../Controllers/addRateController.php" method="POST">

                <div class="container-fluid" style="overflow-x: auto">
                    <table class="prod_table">
                    <tr>
                    <?php
                    echo '
                    <th>' . $ProductInfo["crops"] . '</th>
                    <th>' . $ProductInfo["controlled_pest"] . '</th>
                    <th>' . $ProductInfo["rate_of_use"] . '</th>
                    <th>' . $ProductInfo["phi"] . '</th>'
                    ;
                    ?>
                    </tr>
                <tr>
                                <td>
                                    <textarea class="well traverse_en" type="text" name="crops" placeholder="Crops" required></textarea><br>
                                    <textarea class="well traverse_ar"  type="text" name="crops_ar" placeholder="المحاصيل الزراعيه" required></textarea>
                                </td>
                                <td>
                                    <textarea class="well traverse_en" type="text" name="controlled_pest" placeholder="Controlled Pest" required></textarea><br>
                                    <textarea class="well traverse_ar"  type="text" name="controlled_pest_ar" placeholder="الحشرات المكافحه" required></textarea>
                                </td>
                                <td>
                                    <textarea class="well traverse_en" type="text" name="rate_of_use" placeholder="Rate Of Use" required></textarea><br>
                                    <textarea class="well traverse_ar"  type="text" name="rate_of_use_ar" placeholder="نسبه الاستعمال" required></textarea>
                                </td>
                                <td>
                                    <textarea class="well traverse_en" type="text" name="phi" placeholder="PHI" required></textarea><br>
                                    <textarea class="well traverse_ar"  type="text" name="phi_ar" placeholder="نسبه الامان" required></textarea>
                                </td>
                                <input name="product_id" style="display:none" value="<?php echo $id; ?>"> 
                    </tr>
                    </table>
                    </div>
                    <div class="done_container">
                        <input id="editProduct__" type="submit" name="addNewRow" value="Add"
                            class="btn btn-success btn-md done">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="../Resources/JS/add_prod.js"></script>
<script src="../Resources/JS/editProduct.js"></script>

<?php
include './footer.php';
