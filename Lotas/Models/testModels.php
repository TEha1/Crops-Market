<?php
/*
**
**    USER CLASS
**
*/
//update user
/*
echo '
<form action="../Controllers/updateUserController.php" method="post" enctype="multipart/form-data">
    <input type="text" name="first_name" placeholder="first name">
    <input type="text" name="last_name" placeholder="last Name">
    <input type="text" name="phone" placeholder="Phone">
    <input type="file"  name="image">
    <input type="submit" name="submit" value="UpdateUser">
</form>
'; 
*/
//Block User
/*
echo'<form action="../Controllers/blockUserController.php" method="post">
    <textarea name="id" placeholder="id"></textarea>
    <input type="submit" name="submit" value="block">
</form>';
*/
//delete user
/*
echo'<form action="../Controllers/deleteUserController.php" method="post">
    <input type="submit" name="submit" value="DeleteUser">
</form>';
*/
/////////////////////////////////////////////////////////////////////////

/*
**
**    PRODUCT CLASS
**
*/

//addProduct
/*
echo'<form action="../Controllers/addProductController.php" method="post" enctype="multipart/form-data">
    <textarea name="script_en" placeholder="English Script"></textarea>
    <textarea name="script_ar" placeholder="Arabic Script"></textarea>
    <input type="text" name="name_en" placeholder="English Name">
    <input type="text" name="name_ar" placeholder="Arabic Name">
    <input type="text" name="video" placeholder="YouTube ID">
    <input type="number" name="price" placeholder="Price">
    <input type="text" name="category" placeholder="categoryId">
    <input type="file"  name="image">
    <input type="submit" name="submit" value="addProduct">
</form>';
*/
//DeleteProduct
/*
echo'<form action="../Controllers/deleteProductController.php" method="post" enctype="multipart/form-data">
    <textarea name="id" placeholder="id"></textarea>
    <input type="submit" name="submit" value="DeleteProduct">
</form>';
*/
//updateProduct
/*
echo '
<form action="../Controllers/updateProductController.php" method="post" enctype="multipart/form-data">
    <input type="text" name="id" placeholder="id">
    <textarea name="script_en" placeholder="English Script"></textarea>
    <textarea name="script_ar" placeholder="Arabic Script"></textarea>
    <input type="text" name="name_en" placeholder="English Name">
    <input type="text" name="name_ar" placeholder="Arabic Name">
    <input type="text" name="video" placeholder="YouTube ID">
    <input type="number" name="price" placeholder="Price">
    <input type="file"  name="image">
    <input type="submit" name="submit" value="UpdateProduct">
</form>
'; 
*/
//visible
/*
echo'<form action="../Controllers/invisibleProductController.php" method="post">
    <textarea name="id" placeholder="id"></textarea>
    <input type="submit" name="submit" value="Visible">
</form>';
*/
//GetProductByLIMITAr
/*
include_once 'productClass.php';
$product = new Product();
$data = $product->GetProductByLIMITAr(1);
print_r($data);
*/
//getNumberOfProduct
/*
include_once 'productClass.php';
$product = new Product();
$_SESSION['lang'] ='en';
$data = $product->getProduct(31);
print_r($data);
if($data == false)
{
    echo 'false';
}
*/
echo  $_SERVER['PHP_SELF'];
echo $_SERVER['SCRIPT_FILENAME'];
echo $_SERVER['REQUEST_URI'];
echo  $_SERVER['HTTP_HOST'];
echo $_SERVER['QUERY_STRING'];
//checkProduct
//echo ' <a href="../Controllers/checkProductController.php?name=s&name_ar=s">CheckProduct</a>';
///////////////////////////////////////////////////////////////////////////////////

/*
**
**   CATEGORY CLASS
**
*/

//add category
/*
echo'<form action="../Controllers/addCategoryController.php" method="get">
    <input type="text" name="name_ar" placeholder="Arabic Name">
    <input type="text" name="name_en" placeholder="English Name">
    <input type="submit" name="submit" value="addcategory">
</form>';
*/
//DeleteProduct
/*
echo'<form action="../Controllers/deleteCategoryController.php" method="post">
    <textarea name="id" placeholder="id"></textarea>
    <input type="submit" name="submit" value="DeleteCategory">
</form>';

*/

//get all categries
/*
include_once '../Models/categoryClass.php';
$category = new Category();
$data = $category->getAllCategories();
foreach($data as $cat)
{
    print_r($cat['id']);
}

*/

//////////////////////////////////////////////////////////////////////////////////////
/*
**
**     ORDER CLASS
**
*/

//addOrder

/*
echo'<form action="../Controllers/addOrderController.php" method="get">
    <input type="text" name="productId" placeholder="productId">
    <input type="number" name="quantity" placeholder="quantity">
    <input type="submit" name="submit" value="addOrder">
</form>';
*/
//updateOrder
/*
echo'<form action="../Controllers/updateOrderController.php" method="get">
    <input type="text" name="id" placeholder="id">
    <input type="number" name="quantity" placeholder="quantity">
    <input type="submit" name="submit" value="updateOrder">
</form>';
*/
//DeleteOrder
/*
echo'<form action="../Controllers/deleteOrderController.php" method="get">
    <input name="id" placeholder="id">
    <input type="submit" name="submit" value="deleteOrder">
</form>';

//GetOrdersByLIMIT

include_once 'orderClass.php';
$order = new Order();
$data = $order->GetOrdersByLIMIT(1);
print_r($data);
$num = $order->getNumberOfOrders();
echo $num;


$num1 = 49;
$num2 =ceil ($num1 / 5);
echo $num2;
*/
