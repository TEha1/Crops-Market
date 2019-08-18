<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include '../Models/productClass.php';
    $product = new Product();
    $productData = $product->getProduct($id);
    if (!is_array($productData)) {
        header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
    }
    $rateData = $product->selectRate($id);
} else {
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}
?>
<?php include 'NavBar.php'; ?>

<div class="container-fluid myNavTabs">
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
            <div class="row">
                <div class="col-sm-5 prod_img ">

                    <img src="../Resources/ProductImages/<?php echo $productData['image']; ?>">
                </div>
                <?php
                echo '<div class="col-sm-7 prod_info ">
                    <h4 class=""></h4>
                    <p class="well">' . $productData["name"] . '</p>
                    <div class="qr_">
                        <img src="../Resources/QRimages/'.$id.'.png" />
                    </div>    
                </div>';
                echo '
                
                ';
                ?>

            </div>

        </div>
        <div id="structure" class="tab-pane fade">
            <?php
            echo '<ul class="well struc_">
                <li>' . $Admin_Product["active_ingredient"] . ':</li>
                <p class="">
                    ' . $productData['active_ingredient'] . '  
                </p>

                <li>' . $Admin_Product["properties"] . ':</li>
                    ' . $productData['properties'] . '
                <p>
                        
                </p>
                <li>' . $Admin_Product["features"] . ':</li>
                <p>
                      ' . $productData['features'] . '
                </p>
            </ul>';
            ?>
        </div>
        <div id="usingWay" class="tab-pane fade">
            <ul class="well struc_">

                <div class="ex_video">
                    <?php
                    echo'<iframe src="https://www.youtube.com/embed/' . $productData['video'] . '">';
                    ?>
                    <iframe src="https://www.youtube.com/embed/">
                    </iframe>
                </div>
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
                <th>' . $ProductInfo["phi"] . '</th>'
                        ;
                        ?>
                    </tr>

                    <?php
                    foreach ($rateData as $rate) {


                        echo '<tr>
                                    <td>
                                        ' . $rate['crops'] . '
                                    </td>
                                    <td>
                                       ' . $rate['controlled_pest'] . '
                                    </td>
                                    <td>
                                        ' . $rate['rate_of_use'] . '
                                    </td>
                                    <td>
                                       ' . $rate['phi'] . '
                                    </td>
                                </tr>';
                    }
                    ?>
                </table>
            </div>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>