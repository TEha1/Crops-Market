<?php
if (!isset($_SESSION)) {
session_start();
}
if (!isset($_SESSION['admin'])) {
header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}
include_once '../Models/orderClass.php';
include_once '../Models/userClass.php';
$order = new Order();
$user = new User();
$OrdersNumber = $order->getNumberOfOrders();
$UsersNumber = $user->getNumberOfUsers();
$OrdersPages = ceil($OrdersNumber / 10);
$UsersPages = ceil($UsersNumber / 10);
if (!isset($_GET['pageOrder'])) {
$pageOrder = 1;
} elseif ($_GET['pageOrder'] > $OrdersPages) {
header('Location: ' . filter_var('Orders_and_Users.php', FILTER_SANITIZE_URL));
} else {
$pageOrder = (int) $_GET['pageOrder'];
}
if (!isset($_GET['pageUser'])) {
$pageUser = 1;
} elseif ($_GET['pageUser'] > $UsersPages) {
header('Location: ' . filter_var('Orders_and_Users.php', FILTER_SANITIZE_URL));
} else {
$pageUser = (int) $_GET['pageUser'];
}
include_once '../Models/productClass.php';
$product = new Product();

$Orderdata = $order->GetOrdersByLIMIT($pageOrder);
$dataUser = $user->GetUsersByLIMIT($pageUser);
include 'NavBar.php';
?>

<div class="container-fluid ">
    <div class="row content">
        <?php
        echo '<h2 class="page-header">' . $Orders["orders_and_users"] . '</h2>
        <div class="col-sm-3 sidenav">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#orders" data-toggle="pill">' . $Orders["current_orders"] . '</a></li>
                <li><a href="#users"  data-toggle="pill">' . $Orders["current_users"] . '</a></li>
            </ul><br>
             
        </div>';
        ?>

        <div class="col-sm-9 tab-content edit__">
            <div id="orders" class="list-group tab-pane fade in active">
                <?php
                foreach ($Orderdata as $value) {

                $productData = $product->getProduct($value['product']);
                echo '<span class="list-group-item products_" style="overflow: hidden">
                    ' . $productData["name"] . '
                    <a href="../Controllers/deleteOrderController.php?id=' . $value["id"] . '" id="" class="btn btn-danger delete_order delete_order_" role="button" >
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                    <button id="editButton" class="btn btn-info order_info order_info_" role="button" data-toggle="modal" data-target="#' . $value["id"] . '">
                        <i class="glyphicon glyphicon-info-sign"></i>
                    </button>
                    </span>';
                }
                ?>
                <div class="pages_number text-center">
                    <ul class="pagination">
                        <?php
                        $previousPage = (int) $pageOrder - 1;
                        $nextPage = (int) $pageOrder + 1;
                        if ($pageOrder > 1) {
                        echo'<li class="previous "><a href="Orders_and_Users.php?pageOrder=' . $previousPage . '&pageUser=' . $pageUser . '">previous</a></li>';
                        }
                        $max = 7;
                        if ($pageOrder < $max) {
                        $sp = 1;
                        } elseif ($pageOrder >= ($OrdersPages - floor($max / 2))) {
                        $sp = $OrdersPages - $max + 2;
                        } elseif ($pageOrder >= $max) {
                        $sp = $pageOrder - floor($max / 2);
                        }
                        if ($pageOrder >= $max) {
                        echo'<li><a href="Orders_and_Users.php?pageOrder=1&pageUser=' . $pageUser . '">1</a></li>';
                        echo'<li><a >...</a></li>';
                        }
                        for ($i = $sp;
                        $i <= ($sp + $max - 1);
                        $i++) {
                        if ($i > $OrdersPages) {
                        continue;
                        }
                        if ($pageOrder == $i) {
                        echo'<li class="active"><a href="#">' . $pageOrder . '</a></li>';
                        } else {
                        echo'<li><a href="Orders_and_Users.php?pageOrder=' . $i . '&pageUser=' . $pageUser . '">' . $i . '</a></li>';
                        }
                        }
                        if ($pageOrder < ($OrdersPages - floor($max / 2)) - 1) {
                        echo'<li><a >...</a></li>';
                        }
                        if ($pageOrder < ($OrdersPages - floor($max / 2))) {
                        echo'<li><a href="Orders_and_Users.php?pageOrder=' . $OrdersPages . '&pageUser=' . $pageUser . '">' . $OrdersPages . '</a></li>';
                        }
                        if ($pageOrder < $OrdersPages) {
                        echo'<li class="next"><a href="Orders_and_Users.php?pageOrder=' . $nextPage . '&pageUser=' . $UsersPages . '">next</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div><br>

            <div id="users" class="list-group tab-pane fade">
                <?php
                foreach ($dataUser as $value) {
                if ($value["block"] == 0) {
                $btn = "warning";
                } else {
                $btn = "danger";
                }
                echo '<span class="list-group-item products_ user_list" >
                        
                                <a href="" data-toggle="modal" data-target="#' . $value["id"] . 'user" >' . $value["first_name"] . ' ' . $value["last_name"] . '</a>
                                <a class="btn btn-danger delete_user delete_user_" role="button">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                                <a href="../Controllers/blockUserController.php?block=1&id=' . $value["id"] . '" class="order_info order_info_ btn btn-' . $btn . '" role="button">
                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                </a>
                            </span>';
                }
                ?>

                <div class="pages_number text-center">
                    <ul class="pagination">
                        <?php
                        $previousPage = (int) $pageUser - 1;
                        $nextPage = (int) $pageUser + 1;
                        if ($pageUser > 1) {
                        echo'<li class="previous "><a href="Orders_and_Users.php?pageUser=' . $previousPage . '&pageOrder=' . $pageOrder . '">previous</a></li>';
                        }
                        $max = 7;
                        if ($pageUser < $max) {
                        $sp = 1;
                        } elseif ($pageUser >= ($UsersPages - floor($max / 2))) {
                        $sp = $UsersPages - $max + 2;
                        } elseif ($pageUser >= $max) {
                        $sp = $pageUser - floor($max / 2);
                        }
                        if ($pageUser >= $max) {
                        echo'<li><a href="Orders_and_Users.php?pageUser=1&pageOrder=' . $pageOrder . '">1</a></li>';
                        echo'<li><a >...</a></li>';
                        }

                        for ($i = $sp;
                        $i <= ($sp + $max - 1);
                        $i++) {
                        if ($i > $UsersPages) {
                        continue;
                        }
                        if ($pageUser == $i) {
                        echo'<li class="active"><a href="#">' . $pageUser . '</a></li>';
                        } else {
                        echo'<li><a href="Orders_and_Users.php?pageUser=' . $i . '&pageOrder=' . $pageOrder . '">' . $i . '</a></li>';
                        }
                        }
                        if ($pageUser < ($UsersPages - floor($max / 2)) - 1) {
                        echo'<li><a >...</a></li>';
                        }
                        if ($pageUser < ($UsersPages - floor($max / 2))) {
                        echo'<li><a href="Orders_and_Users.php?pageUser=' . $UsersPages . '&pageOrder=' . $pageOrder . '">' . $UsersPages . '</a></li>';
                        }
                        if ($pageUser < $UsersPages) {
                        echo'<li class="next"><a href="Orders_and_Users.php?pageUser=' . $nextPage . '&pageOrder=' . $OrdersPages . '">next</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div><br>
        </div>
        <!-- Model Info -->
        <?php
        foreach ($Orderdata as $value) {
        $userData = $user->getUser($value['user']);
        echo '<div class="modal fade" id="' . $value["id"] . '" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body ">
                                    <span class="order_dialog">' . $Orders["order_date"] . ' : </span><span>' . $value["dateOfOrder"] . '</span><br>
                                    <hr>
                                    <span class="order_dialog">' . $Orders["order_quantity"] . ' : </span><span> ' . $value["quantity"] . '</span><br>
                                    <hr>
                                    <span class="order_dialog">' . $Orders["order_full_price"] . ' : </span><span> 5000 ' . $Orders["egp"] . '</span><br>
                                    <hr>
                                    <span class="order_dialog">' . $Orders["ordered_by"] . ' : </span><a href="" class="" data-dismiss="modal" data-toggle="modal" data-target="#'.$userData["id"].'user"> ' . $userData["first_name"] . ' ' . $userData["last_name"] . '</a>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
        ?>


        <!-- Model User Info -->
        <?php
        foreach ($dataUser as $value) {

        if ($value["phone"] != '') {
        $phone = '<br><hr><span  class="order_dialog">' . $Orders["mobile"] . ' : </span><span>' . $value["phone"] . '</span>';
        } else {
        $phone = '';
        }

        if ($value["oauth_provider"] == "facebook") {
        $link = '<br><hr><span  class="order_dialog">' . $Orders["facebook_profile"] . ' : </span><a href="' . $value["link"] . '">' . $value["first_name"] . ' ' . $value["last_name"] . '</a>';
        } elseif ($value["oauth_provider"] == "google") {
        $link = '<br><hr><span  class="order_dialog">' . $Orders["google+"] . ' : </span><a href="' . $value["link"] . '">' . $value["first_name"] . ' ' . $value["last_name"] . '</a>';
        } else {
        $link = '';
        }
        echo '<div class="modal fade" id="' . $value["id"] . 'user" role="dialog">
                    <div class="modal-dialog modal-md">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body ">
                                <span class="order_dialog">' . $Orders["user_name"] . ' : </span><span> ' . $value["first_name"] . ' ' . $value["last_name"] . '</span><br>
                                <hr>
                                <span class="order_dialog">' . $Orders["user_email"] . ' : </span><span>' . $value["email"] . '</span>
                                
                                ' . $phone . '
                                ' . $link . '
                            </div>
                        </div>
                    </div>
                </div>
                ';
        }
        ?>

    </div>
</div>

<?php
include './footer.php';
