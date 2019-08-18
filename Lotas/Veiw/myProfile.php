<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('Location: ' . filter_var('home.php', FILTER_SANITIZE_URL));
}
include_once '../Models/orderClass.php';
$order = new Order();
$num = $order->getNumberOfOrders($_SESSION["id"]);
$OrdersNumber = ceil($num / 10);
//$OrdersNumber=$num;
if (!isset($_GET['page'])) {
    $page = 1;
} elseif ($_GET['page'] > $OrdersNumber) {
    header('Location: ' . filter_var('myProfile.php', FILTER_SANITIZE_URL));
} else {
    $page = (int) $_GET['page'];
}
$OrdersData = $order->GetOrdersByLIMIT($page, $_SESSION["id"]);
include_once '../Models/productClass.php';
include_once 'NavBar.php';
?>
<div class="container-fluid main_profile">    
    <div class="row ">
        <div class="col-sm-3 well  text-center">
            <div class="well profile_img">
                <?php
                if ($_SESSION["oauth_provider"] == "lotus") {
                    echo '<img src="../Resources/UserImages/' . $_SESSION['picture'] . '" class="img-circle" height="65" width="65" alt="Avatar">';
                } else {
                    echo '<img src="' . $_SESSION['picture'] . '" class="img-circle" height="65" width="65" alt="Avatar">';
                }
                ?>
            </div>
            <div class="">
                <table >
                    <tbody>
                        <tr>
                            <td class="glyphicon glyphicon-user icons__"> </td>
                            <td><?php echo $_SESSION["first_name"] . ' ' . $_SESSION["last_name"]; ?></td>
                        </tr>
                        <tr>
                            <td class="glyphicon glyphicon-envelope icons__"></td>
                            <td><?php echo $_SESSION["email"]; ?></td><br>
                    </tr>
                    <?php
                    if (isset($_SESSION['phone'])) {
                        echo '<tr>
                                <td class="glyphicon glyphicon-earphone icons__"> </td>
                                <td>' . $_SESSION["phone"] . '</td>
                            </tr>';
                    }
                    ?>

                    </tbody>
                </table>
            </div><br>
            <div class="well">
                <?php
                if ($_SESSION['oauth_provider'] == 'lotus') {
                    echo '
                        <span class="btn btn-success edit_profile_data"  data-toggle="modal" data-target="#updateModal" role="button">
                            <i class="glyphicon glyphicon-edit"></i>
                        </span>';
                } else {
                    echo '
                        <span class="btn btn-success edit_profile_data"  data-toggle="modal" data-target="#updatePhoneModal" role="button">
                            <i class="glyphicon glyphicon-edit"></i>
                        </span>';
                }
                ?>

                <a href="../Controllers/deleteUserController.php?DeleteUser=1"class="btn btn-danger" role="button" >
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="page-header">
                <?php
                echo '<h1><small>' . $SignIn["your_orders"] . '</small></h1>';
                ?>

            </div>
            <div class="list-group">
                <?php
                $product = new Product();
                foreach ($OrdersData as $value) {
                    $productData = $product->getProduct($value['product']);
                    if ($_SESSION['lang'] == 'ar') {
                        echo '<span class="list-group-item myOrders myOrders_">
                                <a href="ProductInfo.php?id=' . $productData["id"] . '">' . $productData["name"] . '</a>

                                <form action="../Controllers/updateOrderController.php" method="GET">
                                    <input type="number" name="quantity" placeholder="quantity: ' . $value["quantity"] . '">
                                    <input type"text" name="id" value="' . $value["id"] . '" style="display:none" >
                                    <div>
                                        <input type="submit" name="updateOrder"  value="Update">
                                        <a href="../Controllers/deleteOrderController.php?id=' . $value["id"] . '"class="btn btn-danger delete_order_ delete_order" role="button">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </a>
                                    </div>
                                </form>
                            </span> ';
                    } else {
                        echo '<span class="list-group-item myOrders">
                                <a href="ProductInfo.php?id=' . $productData["id"] . '">' . $productData["name"] . '</a>

                                <form action="../Controllers/updateOrderController.php" method="GET">
                                    <input type="number" name="quantity" placeholder="quantity: ' . $value["quantity"] . '">
                                    <input type"text" name="id" value="' . $value["id"] . '" style="display:none" >
                                    <div>
                                        <input type="submit" name="updateOrder"  value="Update">
                                        <a href="../Controllers/deleteOrderController.php?id=' . $value["id"] . '"class="btn btn-danger delete_order" role="button">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </a>
                                    </div>
                                </form>
                            </span> ';
                    }
                }
                ?>
            </div> 
            <div class="pages_number text-center">
                <ul class="pagination">
                    <?php
                    $previousPage = (int) $page - 1;
                    $nextPage = (int) $page + 1;
                    if ($page > 1) {
                        echo'<li class="previous "><a href="myProfile.php?page=' . $previousPage . '">Previous</a></li>';
                    }
                    $max = 7;
                    if ($page < $max) {
                        $sp = 1;
                    } elseif ($page >= ($OrdersNumber - floor($max / 2))) {
                        $sp = $OrdersNumber - $max + 2;
                    } elseif ($page >= $max) {
                        $sp = $page - floor($max / 2);
                    }
                    if ($page >= $max) {
                        echo'<li><a href="myProfile.php?page=1">1</a></li>';
                        echo'<li><a >...</a></li>';
                    }
                    for ($i = $sp; $i <= ($sp + $max - 1); $i++) {
                        if ($i > $OrdersNumber) {
                            continue;
                        }
                        if ($page == $i) {
                            echo'<li class="active"><a href="#">' . $page . '</a></li>';
                        } else {
                            echo'<li><a href="myProfile.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                    if ($page < ($OrdersNumber - floor($max / 2)) - 1) {
                        echo'<li><a >...</a></li>';
                    }
                    if ($page < ($OrdersNumber - floor($max / 2))) {
                        echo'<li><a href="myProfile.php?page=' . $OrdersNumber . '">' . $OrdersNumber . '</a></li>';
                    }
                    if ($page < $OrdersNumber) {
                        echo'<li class="next"><a href="myProfile.php?page=' . $nextPage . '">next</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php
    if ($_SESSION['oauth_provider'] == 'lotus') {

        if (isset($_SESSION["phone"])) {
            $phone = $_SESSION["phone"];
        } else {
            $phone = 'Enter Your Phone Number';
        }

        echo'<!-- Model Update -->
            <div class="modal fade" id="updateModal" role="dialog">
                <div class="modal-dialog modal-md">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">';

        echo '<form action="../Controllers/updateUserController.php" class="well" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>' . $SignIn["first_name"] . ':</label>
                                    <input  type="text" class="form-control" placeholder="' . $_SESSION["first_name"] . '" name="first_name" minlength="2" maxlength="100" >
                                </div>
                                <div class="form-group">
                                    <label>' . $SignIn["last_name"] . ':</label>
                                    <input  type="text" class="form-control" placeholder=" ' . $_SESSION["last_name"] . '"  name="last_name" minlength="2" maxlength="100" >
                                </div>
                                <div class="form-group">
                                    <label>' . $SignIn["password"] . ':</label>
                                    <input type="password" id="pass" class="form-control" placeholder="Enter password" name="password" minlength="10" maxlength="100" >
                                </div>
                                <div class="form-group">
                                    <label >' . $SignIn["re_password"] . ':</label>
                                    <input type="password" id="rpass" class="form-control" id="re_pwd" placeholder="Enter password again" name="resetpassword"  minlength="10" maxlength="100">
                                    <b id="not_matched" class="not_matched"><span class="glyphicon glyphicon-remove" ></span></b>
                                    <b id="matched_" class="matched"><span class="glyphicon glyphicon-ok" ></span></b>
                                </div>
                                <div class="form-group">
                                    <label >' . $SignIn["mobile"] . ':</label>
                                    <input type="text" class="form-control" placeholder="' . $phone . '" name="phone" maxlength="15">
                                </div>
                                <div class="form-group">
                                    <label>' . $SignIn["photo"] . ':</label>
                                    <div class="text-center upload_form" >
                                        <input  class="form-control" type="file" name="image">
                                    </div>
                                </div>
                                <input id="update" name="Update" type="submit" class="btn btn-success edit_profile_data_submit" value="' . $SignIn["update"] . '" >
                            </form>';

        echo '</div>
                    </div>
                </div>
            </div>';
    } else {
        if (isset($_SESSION["phone"])) {
            $phone = $_SESSION["phone"];
        } else {
            $phone = $SignIn['enter_phone'];
        }
        echo'<div class="modal fade" id="updatePhoneModal" role="dialog">
                <div class="modal-dialog modal-md">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="../Controllers/updatePhoneUserController.php" class="well" method="POST" >
                                <div class="form-group">
                                    <label >' . $SignIn['phone'] . '</label>
                                    <input type="text" class="form-control" placeholder="' . $phone . '" name="phone" >
                                </div>
                                <input name="Update" type="submit" class="btn btn-success edit_profile_data_submit" value="Update" >
                            </form>
                        </div>
                    </div>
                </div>
            </div>';
    }
    ?>    
</div>

<script src="../Resources/JS/mainProfile.js"></script>

<?php
include 'footer.php';
?>