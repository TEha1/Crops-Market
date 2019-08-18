<?php
include_once 'DB.php';
class Admin {
    public function check($email)
    {
        $db = new DB();
        $querySelect = "SELECT
                            * 
                        FROM 
                            `admin`
                        WHERE 
                            email = '" . $email . "'";
        $result = $db->prepare($querySelect);
        $result->execute();
        $db=null;
        if ($result->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function addAdmin($adminData)
    {
        $db = new DB();
        $querySelect = "INSERT INTO 
                            `admin` (`email`, `password`) 
                        VALUES 
                            ('".$adminData['email']."', '".$adminData['password']."')";
        $result = $db->prepare($querySelect);
        $db=null;
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteAdmin($id)
    {
        $db = new DB();
        $query = "DELETE FROM `admin` WHERE `admin`.`id` =".$id;
        $result = $db->prepare($query);
        $db=null;
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function selectAdmin()
    {
        $query = "SELECT * FROM `admin`";
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data =$result->fetchAll();
        $db = NULL;
        return $data;
    }
    public function loginAdmin($email) {
        $db = new DB();
        $querySelect = "SELECT
                            * 
                        FROM 
                            `admin`
                        WHERE 
                            email = '" . $email . "'";
        $result = $db->prepare($querySelect);
        $result->execute();
        $db=null;
        if ($result->rowCount() > 0) {
            $data = $result->fetchAll();
            return $data;
        } else {
            return false;
        }
    }
    public function selectManager($id,$col)
    {
        $db = new DB();
        $querySelect = "SELECT $col FROM `manager` WHERE id = $id";
        $result = $db->prepare($querySelect);
        $result->execute();
        $data =$result->fetch();
        $db = NULL;
        return $data;
    }
    public function updateManager($id,$col,$data)
    {
        $db = new DB(); 
        $query = "UPDATE 
                    `manager`
                SET 
                    `".$col."` = '".$data."' 
                WHERE 
                    `id` = '".$id."'" ;
        $stm = $db->prepare($query);
        $db = NULL;
        if($stm->execute()){return TRUE;} else {return false;}
    }
}
