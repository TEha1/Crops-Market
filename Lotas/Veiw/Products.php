<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../Models/productClass.php';
include_once '../Models/categoryClass.php';
$category = new Category();
$allCategories = $category->getAllCategories();
if (!isset($_GET['c']) || $_GET['c'] == 0) {
    $categoryId = 0;
    $product = new Product();
    if (isset($_SESSION['admin'])) {
        $ProductsNumber = $product->getNumberOfProductAdmin();
    } else {
        $ProductsNumber = $product->getNumberOfProduct();
    }
    $ProductPage = ceil($ProductsNumber/12);
    if (!isset($_GET['page'])) {
        $page = 1;
    } elseif ($_GET['page'] > $ProductPage) {
        header('Location: ' . filter_var('Products.php?c=' . $categoryId, FILTER_SANITIZE_URL));
    } else {
        $page = (int) $_GET['page'];
    }
    if (isset($_SESSION['admin'])) {
        $productData = $product->GetProductByLIMITAdmin($page);
    } else {
        $productData = $product->GetProductByLIMIT($page);
    }
} else {
    if (!in_array($_GET['c'], array_column($allCategories, 'id'))) {
        header('Location: ' . filter_var('Products.php', FILTER_SANITIZE_URL));
    } else {
        $categoryId = $_GET['c'];
        $product = new Product();
        if (isset($_SESSION['admin'])) {
            $ProductsNumber = $product->getNumberOfProductOfCategoryAdmin($categoryId);
        } else {
            $ProductsNumber = $product->getNumberOfProductOfCategory($categoryId);
        }
        $ProductPage = $ProductsNumber;
        if (!isset($_GET['page'])) {
            $page = 1;
        } elseif ($_GET['page'] > $ProductPage) {
            header('Location: ' . filter_var('Products.php?c=' . $categoryId, FILTER_SANITIZE_URL));
        } else {
            $page = (int) $_GET['page'];
        }
    }
    if (isset($_SESSION['admin'])) {
        $productData = $product->GetProductByLIMITCtegoryAdmin($page, $categoryId);
    } else {
        $productData = $product->GetProductByLIMITCtegory($page, $categoryId);
    }
}
include_once 'NavBar.php';
?>
<br>
<div class="container-fluid" id="price_div">
    <div class="row content">
        <div class="col-sm-3 sidenav">
            <?php
            echo '<h4>' . $Products["categories"] . '</h4>';
            ?>
            <ul class="nav nav-pills nav-stacked">
                <?php
                if (0) {
                    if ($categoryId === 0) {
                        echo '<li class="active"><a href="Products.php">Categories</a></li>';
                    } else {
                        echo '<li><a href="Products.php">All Products</a></li>';
                    }
                } else {
                    if ($categoryId === 0) {
                        echo '<li class="active"><a href="Products.php">' . $Products["all_products"] . '</a></li>';
                    } else {
                        echo '<li><a href="Products.php">' . $Products["all_products"] . '</a></li>';
                    }
                }

                foreach ($allCategories as $value) {
                    if ($value['id'] == $categoryId) {
                        echo '<li class="active"><a href="Products.php?c=' . $value["id"] . '">' . $value['name_en'] . '</a></li>';
                    } else {
                        echo '<li><a href="Products.php?c=' . $value["id"] . '">' . $value['name_en'] . '</a></li>';
                    }
                }
                ?>

            </ul><br>
        </div>
        <div class="col-sm-9">   

            <?php
            $numOfProduct = count($productData);
            $RowCount = ceil($numOfProduct / 3);
            if (isset($_SESSION['id'])) {
                for ($i = 0; $i < $RowCount; $i++) {
                    echo'<div class="row">';
                    for ($j = $i * 3; $j < $i + 3 && $j < $numOfProduct; $j++) {
                        echo'<div class="col-sm-4">
                        <div class="panel panel-primary text-center">
                            <div class="panel-heading">' . $productData[$j]['name_en'] . '</div>
                            <div class="panel-body product_img">
                                <img src="../Resources/ProductImages/' . $productData[$j]['image'] . '" class="img-responsive" alt="Image"></div>
                            <div class="panel-footer">
                                <span>' . $productData[$j]['price'] . ' </span> EGP
                                <a href="" data-toggle="modal" data-target="#' . $productData[$j]['id'] . '" class="btn btn-primary apply_btn">Apply</a>
                            </div>
                        </div>
                    </div>';
                    }
                    echo'</div>';
                }
            } elseif (isset($_SESSION['admin'])) {
                for ($i = 0; $i < $RowCount; $i++) {
                    echo'<div class="row">';
                    for ($j = $i * 3; $j < $i + 3 && $j < $numOfProduct; $j++) {
                        if ($productData[$j]['visible'] == 1) {
                            $visible = 'btn-warning';
                        } else {
                            $visible = 'btn-danger';
                        }
                        echo'<div class="col-sm-4">
                                <div class="panel panel-success text-center">
                                    <div class="panel-heading">' . $productData[$j]['name'] . '</div>
                                    <div class="panel-body product_img"><img src="../Resources/ProductImages/' . $productData[$j]['image'] . '" alt="Image"></div>
                                    <div class="panel-footer">
                                        <a href="Admin_edit_product.php" class="btn btn-success">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a href="../Controllers/deleteProductController.php?submit=DeleteProduct&id=' . $productData[$j]['id'] . ' "class="btn btn-danger">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                        <a href="../Controllers/invisibleProductController.php?submit=Visible&id=' . $productData[$j]['id'] . ' " class="btn ' . $visible . '">
                                            <span class="glyphicon glyphicon-ban-circle"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>';
                    }
                    echo'</div>';
                }
            } else {
                for ($i = 0; $i < $RowCount; $i++) {
                    echo'<div class="row">';
                    for ($j = $i * 3; $j < $i + 3 && $j < $numOfProduct; $j++) {
                        echo'<div class="col-sm-4">
                                <div class="panel panel-primary text-center">
                                    <div class="panel-heading product"><a href="" >' . $productData[$j]['name'] . '</a></div>
                                    <div class="panel-body product_img">
                                        <img src="../Resources/ProductImages/' . $productData[$j]['image'] . '" class="img-responsive" alt="Image"></div>
                                    <div class="panel-footer">
                                        <span>' . $productData[$j]['price'] . ' </span> EGP
                                    </div>
                                </div>
                            </div>';
                    }
                    echo'</div>';
                }
            }
            ?>
            <div class="pages_number text-center">
                <ul class="pagination">
                    <?php
                    $previousPage = (int) $page - 1;
                    $nextPage = (int) $page + 1;
                    if ($page > 1) {
                        echo'<li class="previous "><a href="Products.php?c=' . $categoryId . '&page=' . $previousPage . '">' . $Products["prev"] . '</a></li>';
                    }
                    //setup starting point
                    //$max is equal to number of links shown
                    $max = 7;
                    if ($page < $max) {
                        $sp = 1;
                    } elseif ($page >= ($OrdersNumber - floor($max / 2))) {
                        $sp = $OrdersNumber - $max + 2;
                    } elseif ($page >= $max) {
                        $sp = $page - floor($max / 2);
                    }

                    /* If the current page >= $max then show link to 1st page -->* */
                    if ($page >= $max) {
                        echo'<li><a href="Products.php?c=' . $categoryId . '&page=1">1</a></li>';
                        echo'<li><a >...</a></li>';
                    }
                    //Loop though max number of pages shown and show links either side equal to $max / 2 -->
                    for ($i = $sp; $i <= ($sp + $max - 1); $i++) {
                        if ($i > $ProductPage) {
                            continue;
                        }
                        if ($page == $i) {
                            echo'<li class="active"><a href="#">' . $page . '</a></li>';
                        } else {
                            echo'<li><a href="Products.php?c=' . $categoryId . '&page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                    //<!-- If the current page is less than say the last page minus $max pages divided by 2-->
                    if ($page < ($ProductPage - floor($max / 2)) - 1) {
                        echo'<li><a >...</a></li>';
                    }
                    if ($page < ($ProductPage - floor($max / 2))) {
                        echo'<li><a href="Products.php?c=' . $categoryId . '&page=' . $ProductPage . '">' . $OrdersNumber . '</a></li>';
                    }
                    //<!-- Show last two pages if we're not near them -->
                    if ($page < $ProductPage) {
                        echo'<li class="next"><a href="Products.php?c=' . $categoryId . 'page=' . $nextPage . '">' . $Products["next"] . '</a></li>';
                    }
                    ?>
                </ul>
            </div>

        </div><br>
    </div>
    <!-- Model Order -->
    <?php
    $numOfProduct = count($productData);
    $RowCount = ceil($numOfProduct / 3);
    if (isset($_SESSION['id'])) {
        foreach ($productData as $value) {
            echo'<div class="modal fade" id="' . $value['id'] . '" role="dialog">
                    <div class="modal-dialog modal-md">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action=" " class="well" method="POST">
                                    <input type="number" name="productId" value="' . $value['id'] . '" style="display: none;">
                                    <div class="form-group">
                                        <span  class="order_dialog">Quantity :</span>
                                        <input  type="number" class="form-control" name="quantity" required>
                                    </div>

                                    <div class="form-group">
                                        <span class="order_dialog">Price For One : </span><span >' . $value['price'] . ' </span> EGP<br>
                                    </div>
                                    <div class="form-group">
                                        <span  class="order_dialog">Full Price : </span><span>0</span>  EGP<br>
                                    </div>
                                    <input name="submit" type="submit" class="btn btn-success apply_btn" value="Order" >
                                </form>
                            </div>

                        </div>

                    </div>
                </div>';
        }
    }
    ?>
    <div class="modal fade" id="orderModal" role="dialog">
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action=" " class="well" method="POST">

                        <div class="form-group">
                            <span  class="order_dialog">Quantity :</span>
                            <input  type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>

                        <div class="form-group">
                            <span class="order_dialog">Full Price : </span><span id="total_price">0 </span> EGP<br>
                        </div>
                        <input name="submit" type="submit" class="btn btn-success apply_btn" value="Order" >
                    </form>
                </div>

            </div>

        </div>
    </div>
    <script src="../Resources/JS/products.js"></script>
</div>
<?php include './footer.php'; ?>