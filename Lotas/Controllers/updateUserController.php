<?php
include '../Resources/arabic_worlds.php';
if (!isset($_SESSION)) {
    session_start();
}
if ($_POST['submit'] == 'Update' || $_POST['submit'] == $SignIn["update"] && $_SESSION['oauth_provider'] == 'lotus') {
    try {
        include '../Models/userClass.php';
        $user = new User();
        if ($_POST['first_name'] != '') {
            if ($user->updateuser($_SESSION['id'], 'first_name', $_POST['first_name'])) {
                $_SESSION['first_name'] = $_POST['first_name'];
            }
        }
        if ($_POST['last_name'] != '') {
            if ($user->updateuser($_SESSION['id'], 'last_name', $_POST['last_name'])) {
                $_SESSION['last_name'] = $_POST['last_name'];
            }
        }
        if ($_POST['phone'] != '') {
            if (preg_match("/^(015|010|011|012)[0-9]{8}$/", $_POST['phone'])) {
                if ($user->updateuser($_SESSION['id'], 'phone', $_POST['phone'])) {
                    $_SESSION['phone'] = $_POST['phone'];
                }
            } else {
                //Wrong phone number
                //phone number not match find an idea
                echo'Wrong phone number';
            }
        }

        if ($_POST['password'] != '' && $_POST['resetpassword'] != '') {
            if ($_POST['password'] == $_POST['resetpassword']) {
                $user->updateuser($_SESSION['id'], 'password', $_POST['password']);
            } else {
                echo '//password not equal reset password find an idea';
            }
        }
        if (isset($_FILES) && !empty($_FILES['image']['name'])) {
            //get the old image director and delete it
            include_once '../Models/fileManagerClass.php';
            $fileManager = new fileManger();
            if (isset($_SESSION['picture'])) {
                $image = $user->selectuser($_SESSION['id'], 'picture');
                $imageDir = '../Resources/UserImages/' . $image[0]['picture'];
                $fileManager->delete($imageDir);
            }
            $allowedext = array('png', 'jpeg', 'jpg', 'gif');
            $file = $_FILES['image'];
            $dir = "../Resources/UserImages/";
            //upload the new image and save director in DB
            $diractor = $fileManager->upload($file, $allowedext, $dir);
            if ($user->updateuser($_SESSION['id'], 'picture', $diractor)) {
                $_SESSION['picture'] = $diractor;
            }
        }
        //header('Location: ' . filter_var('../Veiw/myProfile.php', FILTER_SANITIZE_URL));
    } catch (Exception $ex) {
        //someting wrong find an idea
        echo $ex->getMessage();
    }
} else {
    echo '//someone go direct to this page and route to home';
    //header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}