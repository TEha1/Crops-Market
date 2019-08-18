<?php
include_once 'DB.php';
/*
**this class about everything about user and user table in database
*/
class User 
{
    private $id ='id';
    private $oauth_provider ='oauth_provider';
    private $oauth_uid ='oauth_uid';
    private $first_name ='first_name';
    private $last_name ='last_name';
    private $email ='email';
    private $gender ='gender';
    private $picture ='picture';
    private $link ='link';
    private $phone ='phone';
    private $password ='password';
    private $block ='block';
    private $users ='users';
    
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
            'gender'        => '',
            'picture'       => $gpUserProfile['picture'],
            'link'          => ''
        );
        $querySelect = "SELECT
                            * 
                        FROM 
                            ".$this->users." 
                        WHERE 
                            oauth_provider = '".$gpUserData['oauth_provider']."' 
                        AND
                            oauth_uid = '".$gpUserData['oauth_uid']."'";
        $result = $db->prepare($querySelect);
        $result->execute();
        if($result->rowCount() > 0){
            $queryUpdate = "UPDATE 
                                ".$this->users." 
                            SET 
                                $this->first_name = '".$gpUserData['first_name']."', 
                                $this->last_name = '".$gpUserData['last_name']."', 
                                $this->email = '".$gpUserData['email']."', 
                                $this->gender = '".$gpUserData['gender']."',
                                $this->picture = '".$gpUserData['picture']."', 
                                $this->link = '".$gpUserData['link']."' 
                            WHERE 
                                $this->oauth_provider = '".$gpUserData['oauth_provider']."' 
                            AND 
                                $this->oauth_uid = '".$gpUserData['oauth_uid']."'";
            $update = $db->prepare($queryUpdate);
            $update->execute();
        }else{
            $queryInsert = "INSERT INTO 
                                ".$this->users." 
                            SET 
                                $this->oauth_provider = '".$gpUserData['oauth_provider']."', 
                                $this->oauth_uid = '".$gpUserData['oauth_uid']."', 
                                $this->first_name = '".$gpUserData['first_name']."', 
                                $this->last_name = '".$gpUserData['last_name']."',
                                $this->email = '".$gpUserData['email']."',
                                $this->gender = '".$gpUserData['gender']."', 
                                $this->picture = '".$gpUserData['picture']."',
                                $this->link = '".$gpUserData['link']."'";
            $insert = $db->prepare($queryInsert);
            $insert->execute();
        }
        $result = $db->prepare($querySelect);
        $result->execute();
        $gpUserData = $result->fetch();
        $db = NULL;
        return $gpUserData;
	}
    
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
            'gender'        => '',
            'picture'       => $userData['picture']['url'],
            'link'          => ''
        );
        $querySelect = "SELECT 
                            * 
                        FROM 
                            ".$this->users." 
                        WHERE 
                            $this->oauth_provider = '".$gpUserData['oauth_provider']."'
                        AND 
                            $this->oauth_uid = '".$gpUserData['oauth_uid']."'";
        $result = $db->prepare($querySelect);
        $result->execute();
        if($result->rowCount() > 0){
            $queryUpdate = "UPDATE 
                                ".$this->users." 
                            SET 
                                $this->first_name = '".$gpUserData['first_name']."',
                                $this->last_name = '".$gpUserData['last_name']."',
                                $this->email = '".$gpUserData['email']."',
                                $this->gender = '".$gpUserData['gender']."',
                                $this->picture = '".$gpUserData['picture']."', 
                                $this->link = '".$gpUserData['link']."' 
                            WHERE
                                $this->oauth_provider = '".$gpUserData['oauth_provider']."' 
                            AND 
                                $this->oauth_uid = '".$gpUserData['oauth_uid']."'";
            $update = $db->prepare($queryUpdate);
            $update->execute();
        }else{
            $queryInsert = "INSERT INTO 
                                ".$this->users."
                            SET 
                                $this->oauth_provider = '".$gpUserData['oauth_provider']."',
                                $this->oauth_uid = '".$gpUserData['oauth_uid']."',
                                $this->first_name = '".$gpUserData['first_name']."',
                                $this->last_name = '".$gpUserData['last_name']."',
                                $this->email = '".$gpUserData['email']."',
                                $this->gender = '".$gpUserData['gender']."', 
                                $this->picture = '".$gpUserData['picture']."', 
                                $this->link = '".$gpUserData['link']."'";
            $insert = $db->prepare($queryInsert);
            $insert->execute();
        }
        $result = $db->prepare($querySelect);
        $result->execute();
        $gpUserData = $result->fetch();
        $db = NULL;
        return $gpUserData;
    }
    
    public function Check($email)
    {
        $db = new DB();
        $querySelect = "SELECT 
                            $this->id 
                        FROM 
                            ".$this->users." 
                        WHERE
                            $this->email = '".$email."'";
        $result = $db->prepare($querySelect);
        $result->execute();
        $db=NULL;
        if($result->rowCount() > 0){return false;}else{return true;}

    }
    
    public function SignUp($UserData) 
    {
        $db = new DB();
        $queryInsert = "INSERT INTO
                            ".$this->users."
                        SET 
                            $this->oauth_provider   = '".$UserData['oauth_provider']."',
                            $this->first_name       = '".$UserData['first_name']."',
                            $this->last_name        = '".$UserData['last_name']."',
                            $this->email            = '".$UserData['email']."',
                            $this->gender           = '".$UserData['gender']."',
                            $this->password         = '".$UserData['password']."',
                            $this->phone            = '".$UserData['phone']."',
                            $this->picture          = '".$UserData['picture']."'";
        $querySelect = "SELECT 
                            * 
                        FROM 
                            ".$this->users." 
                        WHERE
                            $this->email = '".$UserData['email']."'";
        $insert = $db->prepare($queryInsert);
        $insert->execute();
        $result = $db->prepare($querySelect);
        $result->execute();
        $UserData = $result->fetch();
        $db=NULL;
        return $UserData;
    }
    
    public function LogIn($UserData)
    {
        $db = new DB();
        $querySelect = "SELECT
                            * 
                        FROM 
                            ".$this->users."
                        WHERE 
                            $this->email = '".$UserData['email']."'";
        $result = $db->prepare($querySelect);
        $result->execute();
        $data = $result->fetch();
        $db=NULL;
        if($result->rowCount() > 0){return $data;}else{return false;}
    }
    
    public function LogOut()
    {
        session_destroy();
    }
    
    public function UpdateUser($id,$col,$data)
    {
        $db = new DB(); 
        $query = "UPDATE 
                    `".$this->users."`
                SET 
                    `".$col."` = '".$data."' 
                WHERE 
                    $this->id = ".$id ;
        $stm = $db->prepare($query);
        $db = NULL;
        if($stm->execute()){return TRUE;} else {return false;}

    }
    
    public function DeleteUser($id)
    {
        $db = new DB(); 
        $query = "DELETE FROM $this->users WHERE $this->id= ".$id;
        $stm = $db->prepare($query);
        $db = NULL;
        if($stm->execute()){return TRUE;} else {return false;}
    }
    
    public function SelectUser($id,$col)
    {
        $db = new DB();
        $query = "SELECT ".$col." FROM $this->users WHERE $this->id =".$id;
        $result = $db->prepare($query);
        $result->execute();
        $ProductData = $result->fetch();
        $db = NULL;
        return $ProductData;
    }
    
    public function Block($id)
    {
        $block = $this->SelectUser($id,'block');
        if($block['block'] == 1)
        {
            $this->updateuser($id,'block',0);
        }
        else
        {
            $this->updateuser($id,'block',1);
        }
    }
    
    public function getNumberOfUsers()
    {
        $query = "SELECT COUNT($this->id) as num FROM $this->users";
        $db = new DB();
        $result = $db->prepare($query);
        $result->execute();
        $data = $result->fetch();
        $db=NULL;
        return $data['num'];
    }
    
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
        $result = $stm->fetch();
        $db = NULL;
        return $result;
    }
}