<?php

include_once 'DB.php';

class Admin {

    public function loginAdmin($email) {
        $db = new DB();
        if (!empty($email)) {
            //Check whether admin data already exists in database
            $querySelect = "SELECT
                                * 
                            FROM 
                                `admin`
                            WHERE 
                                email = '" . $email . "'";
            $result = $db->prepare($querySelect);
            $result->execute();
            if ($result->rowCount() > 0) {
                $data = $result->fetchAll();
                return $data;
            } else {
                return false;
            }
        }
        return false;
    }

}
