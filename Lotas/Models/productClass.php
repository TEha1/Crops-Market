<?php
include_once 'phpqrcode/qrlib.php';
include_once 'DB.php';
/*
  this class about everything about product and table product in database
 */
class Product {
    
    private $id                     = 'id';
    private $name                   = 'name' ;
    private $name_ar                = 'name_ar';
    private $active_ingredient_ar   = 'active_ingredient_ar';
    private $properties_ar          = 'properties_ar';
    private $features_ar            = 'features_ar';
    private $active_ingredient      = 'active_ingredient';
    private $properties             = 'properties';
    private $features               = 'features';
    private $image                  = 'image';
    private $video                  = 'video';
    private $visible                = 'visible';
    private $category               = 'category';
    private $product                = 'product';
    private $crops                  = 'crops';
    private $controlled_pest        = 'controlled_pest';
    private $rate_of_use            = 'rate_of_use';
    private $phi                    = 'phi';
    private $crops_ar               = 'crops_ar';
    private $controlled_pest_ar     = 'controlled_pest_ar';
    private $rate_of_use_ar         = 'rate_of_use_ar';
    private $phi_ar                 = 'phi_ar';
    private $product_id             = 'product_id';
    private $rate                   = 'rate';
    private $price                  = 'price';
    private $url                    = 'lotus.com';
    
    public function getProduct($id) {
        $db = new DB();
        if(isset($_SESSION['admin']))
        {
            
                $query = "SELECT
                           *
                         FROM
                            $this->product 
                         WHERE
                            $this->id =" . $id;
            
        }
        else
        {
            if($_SESSION['lang'] == 'ar')
            {
                $query = "SELECT
                            $this->id, 
                            $this->name_ar as name,
                            $this->active_ingredient_ar as active_ingredient,
                            $this->properties_ar as properties,
                            $this->features_ar as features,
                            $this->image,
                            $this->video,
                            $this->visible,
                            $this->category
                         FROM
                            $this->product
                         WHERE 
                            $this->visible = 1
                         AND
                            $this->id =" . $id;
            }
            else
            {
                 $query = "SELECT
                            $this->id, 
                            $this->name as name,
                            $this->active_ingredient as active_ingredient,
                            $this->properties as properties,
                            $this->features as features,
                            $this->image,
                            $this->video,
                            $this->visible,
                            $this->category
                         FROM
                            $this->product
                         WHERE 
                            $this->visible = 1
                         AND
                            $this->id =" . $id;
            }
        }
        
        $result = $db->prepare($query);
        $result->execute();
        $ProductData = $result->fetch();
        $db = NULL;
        $count = $result->rowCount();
        if($count>0)
        {
            return $ProductData;
        }
        else
        {
            //return false for two conditions first the id is wrong second the product is not visible for user
            return false;
        }
    }
    
    public function selectProduct($id, $col) {
        $db = new DB();
        $query = "SELECT " . $col . " FROM $this->product WHERE $this->id =" . $id;
        $result = $db->prepare($query);
        $result->execute();
        $ProductData = $result->fetch();
        $db = NULL;
        return $ProductData;
    }
    
    public function GetProductByLIMIT($pageid) {
        $db = new DB();
        $start = 12 * ($pageid - 1);
        $row = 12;
        if(isset($_SESSION['admin']))
        {
            if($_SESSION['lang']=='ar')
            {
                $query = "SELECT 
                            $this->id,
                            $this->name_ar as name ,
                            $this->image ,
                            $this->visible
                        FROM 
                            $this->product
                        LIMIT 
                        $start,$row";
            }
            else
            {
                $query = "SELECT 
                            $this->id ,
                            $this->name as name ,
                            $this->image  ,
                            $this->visible
                        FROM 
                            $this->product 
                        LIMIT 
                        $start,$row";
            }
        }
        else
        {
            if($_SESSION['lang']=='ar')
            {
                $query = "SELECT 
                            $this->id,
                            $this->name_ar as name ,
                            $this->image  ,
                            $this->price
                        FROM 
                            $this->product 
                        WHERE 
                            $this->visible = 1 
                        LIMIT 
                        $start,$row";
            }
            else
            {
                $query = "SELECT 
                            $this->id ,
                            $this->name as name ,
                            $this->image ,
                            $this->price
                        FROM 
                            $this->product
                        WHERE 
                            $this->visible = 1 
                        LIMIT 
                        $start,$row";
            }
        }
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll();
        $db = NULL;
        $count = $stm->rowCount();
        if($count>0)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }
    
    public function GetProductByLIMITCtegory($pageid, $categoryId) {
        $db = new DB();
        $start = 12 * ($pageid - 1);
        $row = 12;
        if(isset($_SESSION['admin']))
        {
            if($_SESSION['lang'] == 'ar')
            {
                $query = "SELECT 
                            $this->id,
                            $this->name_ar as name ,
                            $this->image ,
                            $this->visible
                        FROM 
                            $this->product 
                        WHERE 
                            $this->category= $categoryId
                        LIMIT $start,$row ";
            }
            else
            {
                $query = "SELECT 
                            $this->id ,
                            $this->name as name ,
                            $this->image,
                            $this->visible
                        FROM
                            $this->product 
                        WHERE 
                            $this->category= $categoryId
                        LIMIT $start,$row ";
            }
        }
        else
        {
            if($_SESSION['lang'] == 'ar')
            {
                $query = "SELECT 
                            $this->id,
                            $this->name_ar as name ,
                            $this->image ,
                            $this->price
                        FROM 
                            $this->product 
                        WHERE 
                            $this->category = $categoryId 
                        AND 
                            $this->visible = 1 
                        LIMIT $start,$row ";
            }
            else
            {
                $query = "SELECT 
                            $this->id ,
                            $this->name as name ,
                            $this->image ,
                            $this->price
                        FROM
                            $this->product 
                        WHERE 
                            $this->category= $categoryId 
                        AND 
                            $this->visible = 1 
                        LIMIT $start,$row ";
            }
        }
        
        
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll();
        $db = NULL;
        $count = $stm->rowCount();
        if($count>0)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }
    
    public function getNumberOfProduct() {
        if(isset($_SESSION['admin']))
        {
            $query = "SELECT COUNT(id) as num FROM  $this->product";
        }
        else
        {
            $query = "SELECT COUNT(id) as num FROM $this->product WHERE $this->visible = 1 ";
        }
        
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data = $result->fetch();
        $db=NULL;
        return $data['num'];
    }
    
    public function getNumberOfProductOfCategory($categoryId) {
        if(isset($_SESSION['admin']))
        {
            $query = "SELECT COUNT(id) as num FROM $this->product WHERE $this->category= $categoryId ";
        }
        else
        {
            $query = "SELECT COUNT(id) as num FROM $this->product WHERE $this->category= $categoryId AND $this->visible = 1";
        }
        
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data = $result->fetch();
        $db=NULL;
        return $data['num'];
    }
    
    public function selectRate($product_id) {

        $db = new DB();
        if(isset($_SESSION['admin'])) {
             $query = "SELECT 
                        *
                    FROM 
                        $this->rate
                    WHERE 
                        $this->product_id =" . $product_id;
        } else {
            if($_SESSION['lang'] == 'ar')
            {
                $query = "SELECT 
                            $this->crops_ar as crops ,
                            $this->controlled_pest_ar as controlled_pest,
                            $this->rate_of_use_ar as rate_of_use,
                            $this->phi_ar as phi
                        FROM 
                            $this->rate
                        WHERE 
                            $this->product_id = $product_id ";
            }
            else
            {
                $query = "SELECT 
                            $this->crops ,
                            $this->controlled_pest ,
                            $this->rate_of_use ,
                            $this->phi 
                        FROM 
                            $this->rate
                        WHERE 
                            $this->product_id = $product_id";
            }
        }
        
        $result = $db->prepare($query);
        $result->execute();
        $ProductData = $result->fetchAll();
        $db = NULL;
        return $ProductData;
    }
    
    public function getNumberOfRate($product_id) {
        $query = "SELECT COUNT(id) as num FROM $this->rate WHERE $this->product_id = $product_id ";
        $db = new DB();
        $result = $db->prepare($query);
        $db = NULL;
        $result->execute();
        $data = $result->fetch();
        return $data['num'];
    }
    
    /*
    ** All Function After This Comment For Admin Only
    */
    
    
    public function checkProduct($name = "", $name_ar = "") {
        $db = new DB();
        $querySelect = "SELECT $this->id
                        FROM 
                            $this->product 
                        WHERE 
                            $this->name ='" . $name . "'
                        OR 
                            $this->name_ar = '" . $name_ar . "'";
        $result = $db->prepare($querySelect);
        $result->execute();
        $db=null;
        if ($result->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }

     public function checkProductId($id) {
        $db = new DB();
        $querySelect = "SELECT $this->id
                        FROM 
                            $this->product 
                        WHERE 
                            $this->id ='" . $id . "'";
        $result = $db->prepare($querySelect);
        $result->execute();
        $db=null;
        if ($result->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function addProduct($productInfo) {
        $db = new DB();
        $queryInsert = "INSERT INTO 
                                $this->product 
                                ($this->name, 
                                $this->name_ar,
                                $this->active_ingredient_ar,
                                $this->properties_ar,
                                $this->features_ar,
                                $this->active_ingredient,
                                $this->properties,
                                $this->features,
                                $this->image, 
                                $this->video,
                                $this->category,
                                $this->price) 
                            VALUES 
                                ('" . $productInfo['name'] .
                                "', '" . $productInfo['name_ar'] .
                                "', '" . $productInfo['active_ingredient_ar'] .
                                "', '" . $productInfo['properties_ar'] .
                                "', '" . $productInfo['features_ar'] .
                                "', '" . $productInfo['active_ingredient'] .
                                "', '" . $productInfo['properties'] .
                                "', '" . $productInfo['features'] .
                                "', '" . $productInfo['image'] .
                                "', '" . $productInfo['video'] .
                                "', '" . $productInfo['category'] .
                                "', '" . $productInfo['price'] . "')";
        $sql = $db->prepare($queryInsert);
        $result = $sql->execute();
        
        if ($result) {
            $querySelect = "SELECT `id` FROM `product` WHERE `name` = '" . $productInfo['name']."'" ;
            $sql = $db->prepare($querySelect);
            $sql->execute();
            $data = $sql->fetch();
            $db = NULL;
            @QRcode::png('https://teha43.000webhostapp.com/Veiw/ProductInfo.php?id='.$data['id'], '../Resources/QRimages/'.$data['id'].'.png', QR_ECLEVEL_L, 4);
            return $data['id'];
        } else {
            $db = NULL;
            return 'Not Inserted';
        }
    }
    
    public function deleteProduct($id) {
        $db = new DB();
        $query = "DELETE FROM $this->product WHERE $this->id= " . $id;
        $stm = $db->prepare($query);
        $db = NULL;
        if ($stm->execute()) {return TRUE;} else {return false;}
    }
    public function deleteRate($id) {
        $db = new DB();
        $query = "DELETE FROM $this->rate WHERE $this->id= " . $id;
        $stm = $db->prepare($query);
        $db = NULL;
        if ($stm->execute()) {return TRUE;} else {return false;}
    }
    
    public function updateProduct($id, $col, $data) {
        $db = new DB();
        $query = "UPDATE $this->product SET `" . $col . "` = '" . $data . "' WHERE $this->id = " . $id;
        $stm = $db->prepare($query);
        $db = NULL;
        if ($stm->execute()) {return TRUE;} else {return FALSE;}
    }
    
    public function visible($id) {
        $visible = $this->selectProduct($id, $this->visible);
        if ($visible['visible'] == 1) {
            $this->updateProduct($id, $this->visible, 0);
        } else {
            $this->updateProduct($id, $this->visible, 1);
        }
    }
    
    public function updateRate($id, $col, $data) {
        $db = new DB();
        $query = "UPDATE $this->rate SET `" . $col . "` = '" . $data . "' WHERE $this->id = '" . $id."'";
        $stm = $db->prepare($query);
        $db = NULL;
        if ($stm->execute()) {return TRUE;} else {return FALSE;}
    }
    
    public function addRate($product_id, $rateInfo) {
        $db = new DB();
        $query = "INSERT INTO $this->rate 
                    ($this->crops,
                    $this->controlled_pest,
                    $this->rate_of_use,
                    $this->phi,
                    $this->crops_ar,
                    $this->controlled_pest_ar,
                    $this->rate_of_use_ar,
                    $this->phi_ar,
                    $this->product_id) 
                  VALUES 
                   ('" . $rateInfo['crops'] .
                "', '" . $rateInfo['controlled_pest'] .
                "', '" . $rateInfo['rate_of_use'] .
                "', '" . $rateInfo['phi'] .
                "', '" . $rateInfo['crops_ar'] .
                "', '" . $rateInfo['controlled_pest_ar'] .
                "', '" . $rateInfo['rate_of_use_ar'] .
                "', '" . $rateInfo['phi_ar'] .
                "', '" . $product_id .
                "')";
        $sql = $db->prepare($query);
        $result = $sql->execute();
        $db = NULL;
        return $result;
    }
    
    
    
}
