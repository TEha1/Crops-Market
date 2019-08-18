<?php

if (!isset($_SESSION)) {session_start();}
if (isset($_GET['updateOrder']) && (isset($_SESSION['id']))) {
    try {
        include_once '../Models/orderClass.php';
        $order = new Order();
        $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
        $quantity = filter_var($_GET['quantity'],FILTER_SANITIZE_NUMBER_INT);
        $order->updateOrder($id, $quantity, $_SESSION['id']);
        //echo '//order is updated and rout him to myprofile';
        header('Location: ' . filter_var('../Veiw/myProfile.php', FILTER_SANITIZE_URL));    
    } catch (Exception $ex) {
        //someting wrong find an idea
        //echo $ex->getMessage();
        header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_in_system', FILTER_SANITIZE_URL));
    }
} else {
    //echo '//someone go direct to this page and route to home';
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}
?>