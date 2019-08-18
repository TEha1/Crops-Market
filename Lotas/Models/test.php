<?php

include_once 'DB.php';

$db = new DB();
$userTbl = 'users';
$email = $_POST['email1'];

//Check whether user data already exists in database
$querySelect = "SELECT 
                            * 
                        FROM 
                            " . $userTbl . " 
                        WHERE
                            email = '" . $email . "'";
$result = $db->prepare($querySelect);
$result->execute();
if ($result->rowCount() > 0) {
    echo 'email used before';
} else {
    echo 'Fail';
}