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
                <li><a href="#advantages" data-toggle="pill">' . $Admin_Product["advantages"] . '</a></li>';
            ?>

        </ul>
        <div class="tab-content">
            <div id="defention" class="tab-pane fade in active">
                <a class="btn btn-primary english_defenition_btn">En</a>
                <hr>
                <div class="row english_defenition prod_info" style="display: none">
                    <div class="col-sm-5 well " >
                        <div class=" admin_prod_img">
                            <img src="https://placehold.it/270x357?text=IMAGE">
                        </div>
                        <div class="text-center upload_form" >
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
                                    echo '<option value="' . $cat['id'] . '">' . $cat['name_en'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-7 prod_info ">
                        <h4 class="">Name:</h4>
                        <input class="well header_test" type="text" name="name_en" maxlength="100" required placeholder="English Name">
                        <h4 class="">Definition:</h4>
                        <div class="new_definition well text-center">
                            <textarea class="well" name="script_en" placeholder="English Script" required maxlength="545"></textarea>
                        </div>
                    </div>
                </div>
                <a class="btn btn-primary arabic_defenition_btn">Ar</a>
                <hr>
                <div class=" arabic_defenition">
                    <?php
                    echo '<div class="prod_info">
                                <h4 class="">' . $Admin_Product["product_name"] . ':</h4>
                                <input class="well header_test" type="text" name="name_ar" placeholder="English Name">
                                <div class="form-group">
                                    <span>' . $Admin_Product["select_category"] . ':</span><br>
                                    <select name="category" class="" required style="width: 50%; height: 35px; border-radius: 5px;">';
                    include_once "../Models/categoryClass.php";
                    $category = new Category();
                    $data = $category->getAllCategories();
                    foreach ($data as $cat) {
                        echo '<option value = "' . $cat['id'] . '">' . $cat['name_en'] . '</option > ';
                    }
                    echo '</select>
                                </div>
                                <h4 class="">' . $Admin_Product["definition"] . ':</h4>
                                <div class="new_definition well text-center">
                                    <textarea class="well" name="script_ar" placeholder="Arabic Script" required maxlength="545"></textarea>
                                </div>
                            </div>';
                    ?>

                </div>
            </div>
            <div id="structure" class="tab-pane fade product_struct well">
                <a class="btn btn-primary english_structure_btn">En</a>
                <hr>
                <ul class="struc_ english_structure">
                    <li>Effective Material:</li>
                    <textarea class="well"  maxlength="545"></textarea>

                    <li>Chemical Group:</li>
                    <textarea class="well"  maxlength="545"></textarea>

                    <li>Chemical Increase:</li>
                    <textarea class="well"  maxlength="545"></textarea>
                </ul>
                <a class="btn btn-primary arabic_structure_btn">Ar</a>
                <hr>
                <?php
                echo '<ul class="struc_ arabic_structure">
                        <li>' . $Admin_Product["effective_material"] . ':</li>
                        <textarea class="well"  maxlength="545"></textarea>

                        <li>' . $Admin_Product["chemical_group"] . ':</li>
                        <textarea class="well"  maxlength="545"></textarea>

                        <li>' . $Admin_Product["chemical_increase"] . ':</li>
                        <textarea class="well"  maxlength="545"></textarea>
                    </ul>';
                ?>

            </div>
            <div id="usingWay" class="tab-pane fade product_struct well">
                <ul class="well struc_">
                    <a class="btn btn-primary english_usingway_btn">En</a>
                    <hr>
                    <div class="english_usingway">
                        <li>How To Use:</li>
                        <textarea class="well"  maxlength="545"></textarea>
                    </div>
                    <a class="btn btn-primary arabic_usingway_btn">Ar</a>
                    <hr>
                    <div class="arabic_usingway">
                        <?php
                        echo '<li>' . $Admin_Product["how_to_use"] . ':</li>';
                        ?>

                        <textarea class="well"  maxlength="545"></textarea>
                    </div>
                    <li>Explanation Video URL:</li>
                    <textarea class="well" name ="video" placeholder="YouTube ID" required maxlength="545"></textarea>
                    <input class="well header_test" type="number" name="price" placeholder="Price">
                </ul>
            </div>
            <div id="advantages" class="tab-pane fade new_definition well">
                <a class="btn btn-primary english_advantages_btn">En</a>
                <hr>
                <textarea class="well english_advantages "  maxlength="545"></textarea>

                <a class="btn btn-primary arabic_advantages_btn">Ar</a>
                <hr>
                <textarea class="well arabic_advantages "  maxlength="545"></textarea>

            </div>
        </div>
        <div class="done_container">
            <input type="submit" name="submit" value="addProduct"
                   class="btn btn-success btn-md done">
        </div>
    </form>    
</div>
<script src="../Resources/JS/add_prod.js"></script>
<?php
include './footer.php';
