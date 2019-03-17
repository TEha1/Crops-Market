<?php
include_once 'DB.php';
/*
**this class about everything about user and user table in database
*/
class User 
{
    /*
	**function check if user is sorted in db or not and if sorted update his info
	**$code-> get form google api
    **$gClient->get from google api
    **$google_oauthV2->get from google api
    */
	private $userTbl = 'users';
    public function GoogleLogin($code,$gClient,$google_oauthV2)
	{
		$db = new DB();
        $gClient->authenticate($code);
        $_SESSION['token'] = $gClient->getAccessToken();
        //Get user profile data from google
        $gpUserProfile = $google_oauthV2->userinfo->get();
        //Insert or update user data to the database
        $gpUserData = array(
            'oauth_provider'=> 'google',
            'oauth_uid'     => $gpUserProfile['id'],
            'first_name'    => $gpUserProfile['given_name'],
            'last_name'     => $gpUserProfile['family_name'],
            'email'         => $gpUserProfile['email'],
            'gender'        => $gpUserProfile['gender'],
            'picture'       => $gpUserProfile['picture'],
            'link'          => $gpUserProfile['link']
        );
		if(!empty($gpUserData)){
            //Check whether user data already exists in database
            $querySelect = "SELECT
                                * 
                            FROM 
                                ".$this->userTbl." 
                            WHERE 
                                oauth_provider = '".$gpUserData['oauth_provider']."' 
                            AND
                                oauth_uid = '".$gpUserData['oauth_uid']."'";
            $result = $db->prepare($querySelect);
        	$result->execute();
            if($result->rowCount() > 0){
                //Update user data if already exists
                $queryUpdate = "UPDATE 
                                    ".$this->userTbl." 
                                SET 
                                    first_name = '".$gpUserData['first_name']."', 
                                    last_name = '".$gpUserData['last_name']."', 
                                    email = '".$gpUserData['email']."', 
                                    gender = '".$gpUserData['gender']."',
                                    picture = '".$gpUserData['picture']."', 
                                    link = '".$gpUserData['link']."' 
                                WHERE 
                                    oauth_provider = '".$gpUserData['oauth_provider']."' 
                                AND 
                                    oauth_uid = '".$gpUserData['oauth_uid']."'";
                $update = $db->prepare($queryUpdate);
        		$update->execute();
            }else{
                //Insert user data
                $queryInsert = "INSERT INTO 
                                    ".$this->userTbl." 
                                SET 
                                    oauth_provider = '".$gpUserData['oauth_provider']."', 
                                    oauth_uid = '".$gpUserData['oauth_uid']."', 
                                    first_name = '".$gpUserData['first_name']."', 
                                    last_name = '".$gpUserData['last_name']."',
                                    email = '".$gpUserData['email']."',
                                    gender = '".$gpUserData['gender']."', 
                                    picture = '".$gpUserData['picture']."',
                                    link = '".$gpUserData['link']."'";
                $insert = $db->prepare($queryInsert);
        		$insert->execute();
            }
            
            //Get user data from the database
            $result = $db->prepare($querySelect);
        	$result->execute();
            $gpUserData = $result->fetchAll();
        }
        //close db connection
        $db = NULL;
        //Return user data
        return $gpUserData;
	}
    /*
    **function check if user is sorted in db or not and if sorted update his info
    **$helper-> get form facebook api
    **$FB->get form facebook api
    */
    public function FacebookLogin($helper,$FB)
    {
        $db = new DB();
        $accessToken = $helper->getAccessToken();
        $oAuth2Client = $FB->getOAuth2Client();
        if(!$accessToken->isLongLived())
        {
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        }
        $response = $FB->get("/me?fields=id,first_name,last_name,gender,email,link,picture.type(large)",$accessToken);
        $userData=$response->getGraphNode()->asArray();
        $gpUserData = array(
            'oauth_provider'=> 'facebook',
            'oauth_uid'     => $userData['id'],
            'first_name'    => $userData['first_name'],
            'last_name'     => $userData['last_name'],
            'email'         => $userData['email'],
            'gender'        => $userData['gender'],
            'picture'       => $userData['picture']['url'],
            'link'          => $userData['link']
        );
        if(!empty($gpUserData)){
            //Check whether user data already exists in database
            $querySelect = "SELECT 
                                * 
                            FROM 
                                ".$this->userTbl." 
                            WHERE 
                                oauth_provider = '".$gpUserData['oauth_provider']."'
                            AND 
                                oauth_uid = '".$gpUserData['oauth_uid']."'";
            $result = $db->prepare($querySelect);
            $result->execute();
            if($result->rowCount() > 0){
                //Update user data if already exists
                $queryUpdate = "UPDATE 
                                    ".$this->userTbl." 
                                SET 
                                    first_name = '".$gpUserData['first_name']."',
                                    last_name = '".$gpUserData['last_name']."',
                                    email = '".$gpUserData['email']."',
                                    gender = '".$gpUserData['gender']."',
                                    picture = '".$gpUserData['picture']."', 
                                    link = '".$gpUserData['link']."' 
                                WHERE
                                    oauth_provider = '".$gpUserData['oauth_provider']."' 
                                AND 
                                    oauth_uid = '".$gpUserData['oauth_uid']."'";
                $update = $db->prepare($queryUpdate);
                $update->execute();
            }else{
                //Insert user data
                $queryInsert = "INSERT INTO 
                                    ".$this->userTbl."
                                SET 
                                    oauth_provider = '".$gpUserData['oauth_provider']."',
                                    oauth_uid = '".$gpUserData['oauth_uid']."',
                                    first_name = '".$gpUserData['first_name']."',
                                    last_name = '".$gpUserData['last_name']."',
                                    email = '".$gpUserData['email']."',
                                    gender = '".$gpUserData['gender']."', 
                                    picture = '".$gpUserData['picture']."', 
                                    link = '".$gpUserData['link']."'";
                $insert = $db->prepare($queryInsert);
                $insert->execute();
            }
            
            //Get user data from the database
            $result = $db->prepare($querySelect);
            $result->execute();
            $gpUserData = $result->fetchAll();
        }
        //close db connection
        $db = NULL;
        //Return user data
        return $gpUserData;
    }
    /*
    **function SignUp check  if this mail is exist or not and  if not exist insert it
    **and if exist return false
    **$UserData info of user  
    */
    public function Check($email)
    {
        $db = new DB();
        //Check whether user data already exists in database
        $querySelect = "SELECT 
                            * 
                        FROM 
                            ".$this->userTbl." 
                        WHERE
                            email = '".$email."'";
        $result = $db->prepare($querySelect);
        $result->execute();
        if($result->rowCount() > 0)
        {
            return false;
        }
        else
        {
            return true;
        }

    }
    public function SignUp($UserData) 
    {
        $db = new DB();
        if(!empty($UserData))
        {
            //Insert user data
            $queryInsert = "INSERT INTO
                                ".$this->userTbl."
                            SET 
                                oauth_provider = '".$UserData['oauth_provider']."',
                                first_name = '".$UserData['first_name']."',
                                last_name = '".$UserData['last_name']."',
                                email = '".$UserData['email']."',
                                gender = '".$UserData['gender']."',
                                password = '".$UserData['password']."',
                                picture = '".$UserData['picture']."'";
            $querySelect = "SELECT 
                            * 
                        FROM 
                            ".$this->userTbl." 
                        WHERE
                            email = '".$UserData['email']."'";
            $insert = $db->prepare($queryInsert);
            $insert->execute();
            //Get user data from the database
            $result = $db->prepare($querySelect);
            $result->execute();
            $UserData = $result->fetchAll();
            return $UserData;
        }
        return false;
    }
    /*
    **function LogIn check if this email exist in database or not and if exist return his info
    **and if not exist return false
    **$UserData is an array with his email
    */
    public function LogIn($UserData)
    {
        $db = new DB();
        if(!empty($UserData))
        {
            //Check whether user data already exists in database
            $querySelect = "SELECT
                                * 
                            FROM 
                                ".$this->userTbl."
                            WHERE 
                                email = '".$UserData['email']."'";
            $result = $db->prepare($querySelect);
            $result->execute();
            if($result->rowCount() > 0)
            {
                $data = $result->fetchAll();
                return $data;   
            }
            else
            {
                return false;
            }
        }
        return false;
    }
    /*
    **funcrion LogOut destroy session
    */
    public function LogOut()
    {
        session_destroy();
    }
    /*
    **update one column in one time 
    **$id id of user
    **$col column i want to update
    **$data data i want to set
    **if updated reurn true else return false
    */
    public function updateuser($id,$col,$data)
    {
        $db = new DB(); 
        $query = "UPDATE 
                    `".$this->userTbl."`
                SET 
                    `".$col."` = '".$data."' 
                WHERE 
                    `id` = ".$id ;
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
    **function delete user delete one user in one time
    **if you delete user you delete every order he ask
    **$id is the id of user
    */
    public function deleteUser($id)
    {
        $db = new DB(); 
        $query = "DELETE FROM `users` WHERE `id`= ".$id;
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
    **function selectuser used to select specific column in users table
    **$id id of user
    **$col column you want to select
    */
    public function selectuser($id,$col)
    {
        $db = new DB();
        $query = "SELECT ".$col." FROM `users` WHERE `id` =".$id;
        $result = $db->prepare($query);
        $result->execute();
        $ProductData = $result->fetchAll();
        $db = NULL;
        return $ProductData;
    }
    /*
    **function block used to change column block in user table if 0 to 1 and vice versa
    **$id the id of user
    */
    public function block($id)
    {
        $block = $this->selectuser($id,'block');
        if($block[0]['block'] == 1)
        {
            $this->updateuser($id,'block',0);
        }
        else
        {
            $this->updateuser($id,'block',1);
        }
    }
    /*
    **function getNumberOfUsers return number of all users
    */
    public function getNumberOfUsers()
    {
        $query = "SELECT * FROM `users`";
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data = $result->rowCount();
        return $data;
    }
    /*
    **function GetUsersByLIMIT get 10 rows from users in specific category 
    **if $pageid = 5 the limet get from 40 to 50
    */
    public function GetUsersByLIMIT($pageid)
    {
        $db = new DB();
        $start = 10*($pageid-1);
        $row = 10;
        $query = "SELECT * FROM `users` LIMIT $start,$row";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll();
        $db = NULL;
        return $result;
    }
    public function getUser($id)
    {
        $db = new DB();
        $query = "SELECT * FROM `users` WHERE `id`=".$id;
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll();
        $db = NULL;
        return $result;
    }
}