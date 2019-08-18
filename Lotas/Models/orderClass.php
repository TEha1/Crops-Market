<?php
include_once 'DB.php';
class Order
{
    private $id             = 'id';
    private $product        = 'product';
    private $user           = 'user';
    private $quantity       = 'quantity';
    private $orders         = 'orders';
    private $dateOfOrder    ='dateOfOrder';
    
    public function addOrder($userId, $productId , $quantity)
    {
        $query = "INSERT INTO
                        $this->orders
                    SET 
                        $this->product = '".$productId."',
                        $this->user = '".$userId."',
                        $this->quantity = '".$quantity."'";
        $db = new DB();
        $insert = $db->prepare($query);
        $insert->execute();
        $db = NULL;
    }
    public function deleteOrder($id,$userId='')
    {
        $db = new DB(); 
        if(isset($_SESSION['admin']))
        {
            $query = "DELETE FROM $this->orders WHERE $this->id = $id";
        }
        else
        {
            $query = "DELETE FROM $this->orders WHERE $this->id = $id AND $this->user = $userId";
        }
        
        $stm = $db->prepare($query);
        $db = NULL;
        if($stm->execute()){return TRUE;} else {return false;}
    }
    public function updateOrder($id,$quantity,$userId)
    {
        $db = new DB(); 
        $query = "UPDATE
                    $this->orders 
                SET 
                    $this->quantity = '".$quantity."' 
                WHERE 
                    $this->id = ".$id."
                AND 
                $this->user =".$userId;
        $stm = $db->prepare($query);
        if($stm->execute()){return TRUE;}else{return false;}

    }
    public function getNumberOfOrders($userId='')
    {
        if(isset($_SESSION['admin']))
        {
            $query = "SELECT COUNT(id) as num  FROM $this->orders";
        }
        else
        {
            $query = "SELECT COUNT($this->id) as num  FROM `orders` WHERE `user` = $userId";
        }
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data = $result->fetch();
        $db = NULL;
        return $data['num'];
    }
    public function GetOrdersByLIMIT($pageid,$userId='')
    {
        $start = 10*($pageid-1);
        $row = 10;
        if(isset($_SESSION['admin']))
        {
            $query = "SELECT * FROM $this->orders ORDER BY $this->dateOfOrder DESC LIMIT $start,$row";
        }
        else
        {
            $query = "SELECT * FROM $this->orders WHERE $this->user = $userId ORDER BY $this->dateOfOrder DESC LIMIT $start,$row ";
        }
        $db = new DB();
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll();
        $db = NULL;
        return $result;
    }
    
}