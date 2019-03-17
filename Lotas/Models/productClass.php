<?php

include_once 'DB.php';
/*
  this class about everything about product and table product in database
 */

class Product {
    /*
     * *function addproduct insert new product in database and return id of it if it inserted
     * *if not inserted return false
     * *$productInfo is an array with product information like
     * *name,name_ar,script_en,script_ar,price,image->image saved in Resources/ProductImages,
     * *video->id of video in youtube
     */

    public function checkProduct($name, $name_ar) {
        $db = new DB();
        $querySelect = "SELECT * 
                        FROM 
                            `product` 
                        WHERE 
                            `name` ='" . $name . "'
                        OR 
                            `name_ar` = '" . $name_ar . "'";
        $result = $db->prepare($querySelect);
        $result->execute();
        if ($result->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function addProduct($productInfo) {
        $db = new DB();

        $queryInsert = "INSERT INTO 
                                `product` 
                                (`name`, 
                                `name_ar`,
                                `active_ingredient_ar`,
                                `properties_ar`,
                                `features_ar`,
                                `active_ingredient`,
                                `properties`,
                                `features`,
                                `image`, 
                                `video`,
                                `category`) 
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
                "', '" . $productInfo['category'] . "')";
        $sql = $db->prepare($queryInsert);
        $result = $sql->execute();
        if ($result) {
            $querySelect = "SELECT 
                                    `id` 
                                FROM 
                                    `product` 
                                WHERE 
                                    `name` ='" . $productInfo['name'] . "'";
            $sql = $db->prepare($querySelect);
            $sql->execute();
            $data = $sql->fetchAll();
            $db = NULL;
            return $data[0]['id'];
        } else {
            $db = NULL;
            return 'Not Inserted';
        }
    }

    /*
     * *get product information by id of product
     */

    public function getProduct($id) {
        $db = new DB();
        $query = "SELECT * FROM `product` WHERE `id` =" . $id;
        $result = $db->prepare($query);
        $result->execute();
        $ProductData = $result->fetchAll();
        $db = NULL;
        return $ProductData;
    }

    /*
     * *update one column in one time 
     * *$id id of product
     * *$col column i want to update
     * *$data data i want to set
     * *if updated reurn true else return false
     */

    public function updateProduct($id, $col, $data) {
        $db = new DB();
        $query = "UPDATE `product` SET `" . $col . "` = '" . $data . "' WHERE `id` = " . $id;
        $stm = $db->prepare($query);
        if ($stm->execute()) {
            $db = NULL;
            return TRUE;
        } else {
            $db = NULL;
            return FALSE;
        }
    }

    public function get_productAr($id) {
        $db = new DB();
        $query = "SELECT
                 `id`, `name_ar`, `active_ingredient_ar`, `properties_ar`,
                 `features_ar`, `image`, `video`, `visible`, `category`
                 FROM
                 `product` WHERE `id` =" . $id;
        $result = $db->prepare($query);
        $result->execute();
        $ProductData = $result->fetchAll();
        $db = NULL;
        return $ProductData;
    }

    public function getProductEn($id) {
        $db = new DB();
        $query = "SELECT
                 `id`, `name`, `active_ingredient`, `properties`,
                 `features`, `image`, `video`, `visible`, `category`
                 FROM
                 `product` WHERE `id` =" . $id;

        $result = $db->prepare($query);
        $result->execute();
        $ProductData = $result->fetchAll();
        $db = NULL;
        return $ProductData;
    }

    /*
     * *delete one product in one time by id
     * *if deleted return true else return false
     */

    public function deleteProduct($id) {
        $db = new DB();
        $query = "DELETE FROM `product` WHERE `id`= " . $id;
        $stm = $db->prepare($query);
        if ($stm->execute()) {
            $db = NULL;
            return TRUE;
        } else {
            $db = NULL;
            return false;
        }
    }

    /*
     * *get one column from specific product by id
     */

    public function selectProduct($id, $col) {
        $db = new DB();
        $query = "SELECT " . $col . " FROM `product` WHERE `id` =" . $id;
        $db->arabic();
        $result = $db->prepare($query);
        $result->execute();
        $ProductData = $result->fetchAll();
        $db = NULL;
        return $ProductData;
    }

    /*
     * *function visible if product has in visible column 1 make it 0 and vice versa 
     * *$id the id of product
     */

    public function visible($id) {
        $visible = $this->selectProduct($id, 'visible');
        if ($visible[0]['visible'] == 1) {
            $this->updateProduct($id, 'visible', 0);
        } else {
            $this->updateProduct($id, 'visible', 1);
        }
    }

    /*
     * *function GetProductByLIMIT get 10 rows from product 
     * *if $pageid = 5 the limet get from 40 to 50
     */

    public function GetProductByLIMIT($pageid) {
        $db = new DB();
        $start = 12 * ($pageid - 1);
        $row = 12;
        $query = "SELECT * FROM `product` WHERE `visible` = 1 LIMIT $start,$row";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll();
        $db = NULL;
        return $result;
    }

    /*
     * *function GetProductByLIMIT get 10 rows from product in specific category 
     * *if $pageid = 5 the limet get from 40 to 50
     */

    public function GetProductByLIMITCtegory($pageid, $categoryId) {
        $db = new DB();
        $start = 12 * ($pageid - 1);
        $row = 12;
        $query = "SELECT * FROM `product` WHERE `category`= $categoryId AND `visible` = 1 LIMIT $start,$row ";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll();
        $db = NULL;
        return $result;
    }

    /*
     * *function getNumberOfProduct return number of all product
     */

    public function getNumberOfProduct() {
        $query = "SELECT * FROM `product` WHERE `visible` = 1 ";
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data = $result->rowCount();
        return $data;
    }

    /*
     * *function getNumberOfProductOfCategory return number of products in specific category
     * *$categoryId the category id
     */

    public function getNumberOfProductOfCategory($categoryId) {
        $query = "SELECT * FROM `product` WHERE `category`= $categoryId AND `visible` = 1";
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data = $result->rowCount();
        return $data;
    }

    public function GetProductByLIMITAdmin($pageid) {
        $db = new DB();
        $start = 12 * ($pageid - 1);
        $row = 12;
        $query = "SELECT * FROM `product` LIMIT $start,$row";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll();
        $db = NULL;
        return $result;
    }

    /*
     * *function GetProductByLIMIT get 10 rows from product in specific category 
     * *if $pageid = 5 the limet get from 40 to 50
     */

    public function GetProductByLIMITCtegoryAdmin($pageid, $categoryId) {
        $db = new DB();
        $start = 12 * ($pageid - 1);
        $row = 12;
        $query = "SELECT * FROM `product` WHERE `category`= $categoryId  LIMIT $start,$row ";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll();
        $db = NULL;
        return $result;
    }

    /*
     * *function getNumberOfProduct return number of all product
     */

    public function getNumberOfProductAdmin() {
        $query = "SELECT * FROM  `product`";
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data = $result->rowCount();
        return $data;
    }

    /*
     * *function getNumberOfProductOfCategory return number of products in specific category
     * *$categoryId the category id
     */

    public function getNumberOfProductOfCategoryAdmin($categoryId) {
        $query = "SELECT * FROM `product` WHERE `category`= $categoryId ";
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data = $result->rowCount();
        return $data;
    }

    public function addRateOfUse($product_id, $rateOfUseInfo) {
        $db = new DB();
        $query = "INSERT INTO `rate_of_use` 
                    (`crops`,
                    `controlled_pest`,
                    `rate_of_use`,
                    `phi`,
                    `crops_ar`,
                    `controlled_pest_ar`,
                    `rate_of_use_ar`,
                    `phi_ar`,
                    `product_id`) 
                  VALUES 
                  ('" . $rateOfUseInfo['crops'] .
                "', '" . $rateOfUseInfo['controlled_pest'] .
                "', '" . $rateOfUseInfo['rate_of_use'] .
                "', '" . $rateOfUseInfo['phi'] .
                "', '" . $rateOfUseInfo['crops_ar'] .
                "', '" . $rateOfUseInfo['controlled_pest_ar'] .
                "', '" . $rateOfUseInfo['rate_of_use_ar'] .
                "', '" . $rateOfUseInfo['phi_ar'] .
                "', '" . $rateOfUseInfo['product_id'] .
                "')";
        $sql = $db->prepare($queryInsert);
        $result = $sql->execute();
        $db = NULL;
        return $result;
    }

    public function selectRateOfUse($product_id) {

        $db = new DB();
        $query = "SELECT * FROM `rate_of_use` WHERE `product_id` =" . $product_id;
        $result = $db->prepare($query);
        $result->execute();
        $ProductData = $result->fetchAll();
        $db = NULL;
        return $ProductData;
    }

    public function updateRateOfUse($id, $col, $data) {
        $db = new DB();
        $query = "UPDATE `rate_of_use` SET `" . $col . "` = '" . $data . "' WHERE `id` = " . $id;
        $stm = $db->prepare($query);
        if ($stm->execute()) {
            $db = NULL;
            return TRUE;
        } else {
            $db = NULL;
            return FALSE;
        }
    }

    public function getNumberOfRateOfUse($product_id) {
        $query = "SELECT * FROM `rate_of_use` WHERE `product_id` = $product_id ";
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data = $result->rowCount();
        return $data;
    }

}
