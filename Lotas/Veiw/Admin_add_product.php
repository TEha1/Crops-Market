<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}
include './NavBar.php';
?>

<div class="container-fluid myNavTabs">

    <form action="../Controllers/addProductController.php" method="POST" enctype="multipart/form-data" >
        <ul class="nav nav-tabs nav-justified">
            <?php
            echo '<li class="active"><a href="#defention" data-toggle="pill">' . $Admin_Product["definition"] . '</a></li>
                <li><a href="#structure" data-toggle="pill">' . $Admin_Product["structure"] . '</a></li>
                <li><a href="#usingWay" data-toggle="pill">' . $Admin_Product["using_way"] . '</a></li>
                <li><a href="#advantages" data-toggle="pill">' . $Admin_Product["rate_of_use"] . '</a></li>';
            ?>

        </ul>
        <div class="tab-content">
            <div id="defention" class="tab-pane fade in active">
                <a class="btn btn-primary english_defenition_btn ">En</a>
                <hr>
                <div class="row english_defenition prod_info traverse_en" style="display: none">
                    <div class="col-sm-5 well " >
                        <div class=" admin_prod_img">
                            <img src="https://placehold.it/270x357?text=IMAGE">
                        </div>
                        <div class="text-center upload_form">
                            <input required="required" type="file" name="image">
                        </div><br>
                        <div class="form-group">
                            <span>Select Category :</span><br>
                            <select name="category" class="" required style="width: 50%; height: 35px; border-radius: 5px;">
                                <?php
                                include_once '../Models/categoryClass.php';
                                $category = new Category();
                                $data = $category->getAllCategories();
                                foreach ($data as $cat) {
                                    echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-7 prod_info ">
                        <?php
                        echo '
                        <h4 class="">' . $English["product_name"] . ':</h4>
                        <input id="productName" class="well header_test" type = "text" name ="name" maxlength = "100" required placeholder = "English Name">
                        <b id="notMateched_1" class="not_matched">not matched</b>
                        ';
                        ?>
                    </div>
                </div>
                <a class="btn btn-primary arabic_defenition_btn ">Ar</a>
                <hr>
                <div class=" arabic_defenition traverse_ar">
                    <?php
                    echo '<div class="prod_info">
                                <h4 class="">' . $Arabic["product_name"] . ':</h4>
                                <input id="productNameAr" class="well header_test" type="text" name="name_ar" placeholder="Arabic Name">
                                <b id="notMateched_2" class="not_matched">not matched</b>
                                
                     </div>';
                    ?>

                </div>
            </div>
            <div id="structure" class="tab-pane fade product_struct well ">
                <a class="btn btn-primary english_structure_btn">En</a>
                <hr>
                <?php
                echo '<ul class="struc_ english_structure traverse_en">
                        <li>' . $English["active_ingredient"] . ':</li>
                        <textarea class="well"  maxlength="545" name="active_ingredient"></textarea>

                        <li>' . $English["properties"] . ':</li>
                        <textarea class="well"  maxlength="545" name="properties"></textarea>

                        <li>' . $English["features"] . ':</li>
                        <textarea class="well"  maxlength="545" name="features"></textarea>
                    </ul>';
                ?>

                <a class="btn btn-primary arabic_structure_btn ">Ar</a>
                <hr>
                <?php
                echo '<ul class="struc_ arabic_structure traverse_ar">
                        <li>' . $Arabic["active_ingredient"] . ':</li>
                        <textarea class="well"  maxlength="545" name="active_ingredient_ar"></textarea>

                        <li>' . $Arabic["properties"] . ':</li>
                        <textarea class="well"  maxlength="545" name="properties_ar"></textarea>

                        <li>' . $Arabic["features"] . ':</li>
                        <textarea class="well"  maxlength="545" name="features_ar"></textarea>
                    </ul>';
                ?>

            </div>
            <div id="usingWay" class="tab-pane fade product_struct well">
                <ul class="well struc_">
                   
                    <li><?php echo $Admin_Product['explanation_video_id'] ?>:</li>
                    <textarea class="well" name ="video" placeholder="" required maxlength="545"></textarea>
                    <input class="well header_test" type="number" name="price" placeholder="Price">
                </ul>
            </div>
            <div id="advantages" class="tab-pane fade">

                <div class="container-fluid" style="overflow-x: auto">
                    <table id="prodTable" class="prod_table">
                        <tr>
                            <?php
                            echo '
                <th>Number</th>
                <th>' . $ProductInfo["crops"] . '</th>
                <th>' . $ProductInfo["controlled_pest"] . '</th>
                <th>' . $ProductInfo["rate_of_use"] . '</th>
                <th>' . $ProductInfo["phi"] . '</th>';
                            ?>
                        </tr>
                        
                        <tr>
                            <td></td>
                            <td>
                                <textarea class="well traverse_en" type="text" name="1" placeholder="Field Crops" required ></textarea>
                                <br>
                                <textarea class="well traverse_ar"  type="text" name="5" placeholder="المحاصيل الزراعيه"required></textarea>
                            </td>
                            <td>
                                <textarea class="well traverse_en" type="text" name="2" placeholder="Controlled Pest" required></textarea>
                                <br>
                                <textarea class="well traverse_ar"  type="text" name="6" placeholder="الحشرات المكافحه" required></textarea>
                            </td>
                            <td>
                                <textarea class="well traverse_en" type="text" name="3" placeholder="Rate Of Use" required></textarea>
                                <br>
                                <textarea class="well traverse_ar"  type="text" name="7" placeholder="نسبه الاستعمال" required></textarea>
                            </td>
                            <td>
                                <textarea class="well traverse_en" type="text" name="4" placeholder="PHI" required></textarea>
                                <br>
                                <textarea class="well traverse_ar"  type="text" name="8" placeholder="نسيه الامان" required></textarea>
                            </td>
                        </tr>
                        <?php 
                        for($i=1; $i<5; $i++) {
                            $s = ($i*8)+1;
                            echo '<tr>
                            <td><a class="btn btn-success clearField">clear</a></td>
                            <td>
                                <textarea class="well traverse_en" type="text" name="'.$s.'" placeholder="' . $ProductInfo["crops"] . '" ></textarea><br>
                                <textarea class="well traverse_ar"  type="text" name="'. ($s+4) .'" placeholder="المحاصيل الزراعيه" ></textarea>
                            </td>
                            <td>
                                <textarea class="well traverse_en" type="text" name="'.($s+1) .'" placeholder="' . $ProductInfo["controlled_pest"] . '" ></textarea><br>
                                <textarea class="well traverse_ar"  type="text" name="'.($s+5) .'" placeholder="الحشرات المكافحه" ></textarea>
                            </td>
                            <td>
                                <textarea class="well traverse_en" type="text" name="'.($s+2) .'" placeholder="' . $ProductInfo["rate_of_use"] . '" ></textarea><br>
                                <textarea class="well traverse_ar"  type="text" name="'.($s+6) .'" placeholder="نسبه الاستعمال" ></textarea>
                            </td>
                            <td>
                                <textarea class="well traverse_en" type="text" name="'.($s+3) .'" placeholder="' . $ProductInfo["phi"] . '" ></textarea><br>
                                <textarea class="well traverse_ar"  type="text" name="'.($s+7) .'" placeholder="نسبه الامان" ></textarea>
                            </td>
                        </tr>';
                        }
                        ?>

                    </table>
                </div>


            </div>
        </div>
        <div class="done_container">
            <input id="addProduct__" type="button" name="addProduct" value="Add"
                   class="btn btn-success btn-md done disabled">
        </div>
    </form>    
</div>
<script src="../Resources/JS/add_prod.js"></script>

<script src="../Resources/JS/productTable.js"></script>
<?php
include './footer.php';
