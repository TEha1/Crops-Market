<?php

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['submit']) && (isset($_SESSION['id']))) {
    try {
        include_once '../Models/orderClass.php';
        $order = new Order();
        $order->updateOrder($_GET['id'], $_GET['quantity'], $_SESSION['id']);
        echo '//order is updated and rout him to myprofile';
        //header('Location: ' . filter_var('../Veiw/ProductInfo.php?id='.$id, FILTER_SANITIZE_URL));    
    } catch (Exception $ex) {
        //someting wrong find an idea
        echo $ex->getMessage();
    }
} else {
    //someone go direct to this page and route to home
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}
?>