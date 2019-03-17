<?php
include_once 'DB.php';
class Category
{
    /*
    **check if category is already exist or not
    **is exist return false
    **is inserted return Inserted
    **is not inserted return "Not Inserted"
    */
    public function addCategory($name_en,$name_ar)
    {
        $db = new DB();
        $querySelect = "SELECT * 
                        FROM 
                            `category` 
                        WHERE 
                            `name_en` ='".$name_en."'
                        OR 
                            `name_ar` ='".$name_ar."'";
        $result = $db->prepare($querySelect);
        $result->execute();
        if($result->rowCount() > 0)
        {
            return false;
        }
        else
        {
            $queryInsert = "INSERT INTO 
                                `category` 
                                (`name_en`, 
                                `name_ar`) 
                            VALUES 
                                ('".$name_en.
                                "', '".$name_ar."')";
            $sql = $db->prepare($queryInsert);
            $result = $sql->execute();
            if(!$result)
            {
                $db = NULL;
                return 'Not Inserted';
            }
            else
            {
                $db = NULL;
                return $result;
            }
        }
    }
    /*
    **delete category by id and return true if deleted and false id not deleted
    */
    public function deleteCategory($id)
    {
        $db = new DB(); 
        $query = "DELETE FROM `category` WHERE `id`= ".$id;
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
    /*
    **function getAllCategories return all categories
    */
    public function getAllCategories()
    {
        $query = "SELECT * FROM `category`";
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data =$result->fetchAll();
        return $data;
    }
}