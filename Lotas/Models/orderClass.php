<?php
include_once 'DB.php';
class Order
{
    public function addOrder($userId, $productId , $quantity)
    {
        $query = "INSERT INTO
                        `orders`
                    SET 
                        product = '".$productId."',
                        user = '".$userId."',
                        quantity = '".$quantity."'";
        $db = new DB();
        $insert = $db->prepare($query);
        $insert->execute();
        $db = NULL;
    }
    public function deleteOrder($id)
    {
        $db = new DB(); 
        $query = "DELETE FROM `orders` WHERE `id`= ".$id;
        $stm = $db->prepare($query);
        if($stm->execute())
        {
            $db = NULL;
            return TRUE;   
        } 
        else 
        {
            $db = NULL;
            return false;    
        }
    }
    public function deleteOrderByUser($userId,$orderId)
    {
        $db = new DB(); 
        $query = "DELETE FROM `orders` WHERE `id`= ".$orderId." AND `user` = ".$userId;
        $stm = $db->prepare($query);
        if($stm->execute())
        {
            $db = NULL;
            return TRUE;   
        } 
        else 
        {
            $db = NULL;
            return false;    
        }
    }
    public function updateOrder($id,$quantity,$userId)
    {
        $db = new DB(); 
        $query = "UPDATE
                    `orders` 
                SET 
                    `quantity` = '".$quantity."' 
                WHERE 
                    `id` = ".$id."
                AND 
                `user` =".$userId;
        $stm = $db->prepare($query);
        if($stm->execute())
        {
            $db = NULL;
            return TRUE;
        } 
        else 
        {
            $db = NULL;
            return FALSE; 
        }

    }
    public function getNumberOfOrders()
    {
        $query = "SELECT * FROM `orders`";
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data = $result->rowCount();
        $db = NULL;
        return $data;
    }
    public function GetOrdersByLIMIT($pageid)
    {
        $db = new DB();
        $start = 10*($pageid-1);
        $row = 10;
        $query = "SELECT * FROM `orders` ORDER BY `dateOfOrder` DESC LIMIT $start,$row";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll();
        $db = NULL;
        return $result;
    }
    public function getNumberOfOrdersOfUser($userId)
    {
        $query = "SELECT * FROM `orders` WHERE `user` =" .$userId;
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data = $result->rowCount();
        $db = NULL;
        return $data;
    }
    public function GetOrdersByLIMITUser($pageid,$userId)
    {
        $db = new DB();
        $start = 10*($pageid-1);
        $row = 10;
        $query = "select * from `orders` WHERE `user` = $userId ORDER BY `dateOfOrder` DESC LIMIT  $start,$row ";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll();
        $db = NULL;
        return $result;
    }
}