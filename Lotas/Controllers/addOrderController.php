<?php

//finished
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['addOrder']) && isset($_SESSION['id'])) {
    try {
        include_once '../Models/orderClass.php';
        $order = new Order();
        $quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT);
        $productId = filter_var($_POST['productId'], FILTER_SANITIZE_NUMBER_INT);
        $order->addOrder($_SESSION['id'], $productId, $quantity);
        if(isset($_SESSION['phone']))
        {
            $phone = $_SESSION['phone'];
        }
        else
        {
            $phone = 'NO PHONE NUMBER';
        }
        include_once'../Models/productClass.php';
        include_once'../Models/mailerConfig.php';
        $product = new Product();
        $productName = $product->selectProduct($productId, 'name');
        $content = "User Name : " . $_SESSION['first_name'] . " " . $_SESSION['last_name'] . "
User Email : " . $_SESSION['email'] . "
Phone Number : " . $phone . "
Product Name : " . $productName['name'] . "
Quantity : " . $quantity . " ";
        $mail->Body = $content;
        $mail->send();
        header('Location: ' . filter_var('../Veiw/myProfile.php', FILTER_SANITIZE_URL));
    } catch (Exception $ex) {
        header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_in_system', FILTER_SANITIZE_URL));
    }
} else {
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}
?>