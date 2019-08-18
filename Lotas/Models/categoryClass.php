<?php
include_once 'DB.php';
class Category
{
    private $id         = 'id' ;
    private $name       = 'name' ;
    private $name_ar    = 'name_ar' ;
    private $category   = 'category' ;
    public function checkCategory($name = "", $name_ar = "")
    {
        $db = new DB();
        $querySelect = "SELECT $this->id
                        FROM 
                            $this->category 
                        WHERE 
                            $this->name ='" . $name . "'
                        OR 
                            $this->name_ar = '" . $name_ar . "'";
        $result = $db->prepare($querySelect);
        $result->execute();
        $db=NULL;
        if($result->rowCount() > 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    /*
    **check if category is already exist or not
    **is exist return false
    **is inserted return Inserted
    **is not inserted return "Not Inserted"
    */
    public function addCategory($name,$name_ar)
    {
        $db = new DB();
        $queryInsert = "INSERT INTO 
                            $this->category 
                            ($this->name, 
                            $this->name_ar) 
                        VALUES 
                            ('".$name.
                            "', '".$name_ar."')";
        $sql = $db->prepare($queryInsert);
        $result = $sql->execute();
        $db = NULL;
        if(!$result){return 'Not Inserted';}else{return $result;}
        
    }
    /*
    **delete category by id and return true if deleted and false id not deleted
    */
    public function deleteCategory($id)
    {
        $db = new DB(); 
        $query = "DELETE FROM $this->category WHERE $this->id= ".$id;
        $stm = $db->prepare($query);
        $db = NULL;
        if($stm->execute()){return TRUE;} else {return false;}
    }
    /*
    **function getAllCategories return all categories
    */
    public function getAllCategories()
    {
        if($_SESSION['lang']=='ar')
        {
            $query = "SELECT
                        $this->name_ar as name,
                        $this->id
                    FROM
                        $this->category";
        }
        else
        {
            $query = "SELECT 
                        $this->name as name,
                        $this->id
                    FROM 
                    $this->category";
        }
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data =$result->fetchAll();
        $db = NULL;
        return $data;
    }
}