<?php
include_once '../Models/gpConfig.php';
include_once '../Models/fbConfig.php';
$permissions = ['email'];
$facebook = $helper->getLoginUrl($redirectURL, $permissions);
$google = $gClient->createAuthUrl();
if ($_SERVER['PHP_SELF'] == '/Veiw/NavBar.php') {
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $_GET['lang'];
} elseif (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} else {
    $_SESSION['lang'] = 'ar';
    $lang = 'ar';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lotus</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="../Resources/IMG/favicon1.png" >
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
<?php
if ($lang == 'ar') {
    include '../Resources/Ln/arabic_ln.php';
    echo '<link rel="stylesheet" href="../Resources/CSS/main_ar.css">';
    echo '<link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">';
} else {
    include '../Resources/Ln/english_ln.php';
    echo '<link rel="stylesheet" href="../Resources/CSS/main.css">';
}
?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../Resources/JS/jquery-3.2.1.min.js"></script>
        <script src="../Resources/JS/push.min.js"></script>
    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

        <!-- NavBar -->
<?php
if (isset($_GET['notify'])) {
    if ($_GET['notify'] == 'wrong_password') {
        echo '
                <script>
                    Push.create("Wrong Password ",{
                        timeout: 3000,
                    });
                </script>
                ';
    } elseif ($_GET['notify'] == 'wrong_email') {
        echo '
                <script>
                    Push.create("Wrong Email ",{
                        timeout: 3000,
                    });
                </script>
                ';
    } elseif ($_GET['notify'] == 'wrong_admin_password') {
        echo '
                <script>
                    Push.create("Wrong Password ",{
                        timeout: 3000,
                    });
                </script>
                ';
    } elseif ($_GET['notify'] == 'wrong_in_system') {
        echo '
                <script>
                    Push.create("Wrong In System ",{
                        timeout: 3000,
                    });
                </script>
                ';
    }
}
if ($lang == 'ar') {
    echo '<nav class="navbar nav_ navbar-fixed-top">
            <div class="">';
    echo '<div class="navbar-header navbar-right ">';
    echo '      <button type="button" class="navbar-toggle navbar-toggle_" data-toggle="collapse" data-target="#NavBar">
                        <span class="icon-bar icon_bar_"></span>
                        <span class="icon-bar icon_bar_"></span>
                        <span class="icon-bar icon_bar_"></span>
                    </button>
                    <a href="" class="navbar-brand">Our Logo</a>
                </div>
                <div id="NavBar" class="collapse navbar-collapse ">';
    echo '<ul class="nav navbar-nav navbar-right NavBar">';
    echo '
                        <li class="active"><a href="home.php">' . $NavBar["home"] . '</a></li>
                        
                        <li ><a href="home.php#values" >' . $NavBar["values"] . '</a></li>
                        <li><a href="home.php#services">' . $NavBar["services"] . '</a></li>
                        <li><a href="home.php#contact">' . $NavBar["contact"] . '</a></li>
                        <li><a href="Products.php">' . $NavBar["products"] . '</a></li> ';
    if (isset($_SESSION['id'])) {
        echo '  </ul>
                    
                      <a href="?lang=en" class="btn btn-default ln_switcher_ nav navbar-nav navbar-left">En</a>
                        <ul class="nav navbar-nav navbar-left nav_content_ NavBar">
                            <li><a href="myProfile.php?page=1"><span class="glyphicon glyphicon-user test" ></span> ' . $NavBar["profile"] . ' </a></li>
                            <li><a href="../Controllers/logoutUserController.php"><span class="glyphicon glyphicon-log-out test" ></span> ' . $NavBar["logout"] . ' </a></li>
                        </ul>';
    } elseif (isset($_SESSION['admin'])) {
        if (isset($_SESSION['manager'])) {
            $add = '<li><a href="" data-toggle="modal" data-target="#admin">' . $NavBar["add_admin"] . '</a></li>';
        } else {
            $add = '';
        }
        echo '  <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                ' . $NavBar["maintain"] . '
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu admin_menu">
                                <li><a href="Admin_Home.php">' . $NavBar["edit_home_script"] . '</a></li>
                                <li><a href="Admin_add_product.php">' . $NavBar["add_product"] . '</a></li>
                                <li><a href="" data-toggle="modal" data-target="#categoryModal_">' . $NavBar["add_category"] . '</a></li>
                                <li><a href="Orders_and_Users.php?pageUser=1&pageOrder=1">' . $NavBar["orders_users"] . '</a></li>
                                ' . $add . '
                            </ul>
                        </li>
                    </ul>';

        echo '
                      <a href="home.php?lang=en" class="btn btn-default ln_switcher_ nav navbar-nav navbar-left">En</a>
                        <ul class="nav navbar-nav navbar-left nav_content_ NavBar">
                        <li><a href="../Controllers/logoutAdminController.php">'
        . '<span class="glyphicon glyphicon-log-out test" ></span> ' . $NavBar["logout"]
        . ' </a></li>'
        . '</ul>';
    } else {
        echo '</ul>
                      <a href="home.php?lang=en" class="btn btn-default ln_switcher_ nav navbar-nav navbar-left">En</a>
                      <ul class="nav navbar-nav navbar-left nav_content_ NavBar">
                        <li><a href="" data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-lock test" ></span> ' . $NavBar["login"] . ' </a></li>
                        <li><a href="" data-toggle="modal" data-target="#signupModal"><span class="glyphicon glyphicon-user test" ></span> ' . $NavBar["signup"] . ' </a></li>
                      </ul>';
    }
} else {
    echo '<nav class="navbar nav_ navbar-fixed-top">
            <div class="">';
    echo '<div class="navbar-header navbar-left">';
    echo '      <button type="button" class="navbar-toggle navbar-toggle_" data-toggle="collapse" data-target="#NavBar">
                        <span class="icon-bar icon_bar_"></span>
                        <span class="icon-bar icon_bar_"></span>
                        <span class="icon-bar icon_bar_"></span>
                    </button>
                    <a href="" class="navbar-brand">Our Logo</a>
                </div>
                <div id="NavBar" class="collapse navbar-collapse ">';
    echo '<ul class="nav navbar-nav navbar-left NavBar">';
    echo '
                        <li class="active"><a href="home.php">' . $NavBar["home"] . '</a></li>
                        <li ><a href="home.php#values" >' . $NavBar["values"] . '</a></li>
                        <li><a href="home.php#services">' . $NavBar["services"] . '</a></li>
                        <li><a href="home.php#contact">' . $NavBar["contact"] . '</a></li>
                        <li><a href="Products.php">' . $NavBar["products"] . '</a></li> ';
    if (isset($_SESSION['id'])) {
        echo '  </ul>
                      <a href="home.php?lang=ar" class="btn btn-default ln_switcher nav navbar-nav navbar-right">ع</a>
                        <ul class="nav navbar-nav navbar-right right_nav nav_content NavBar">
                            <li><a href="myProfile.php?page=1"><span class="glyphicon glyphicon-user test" ></span> ' . $NavBar["profile"] . ' </a></li>
                            <li><a href="../Controllers/logoutUserController.php"><span class="glyphicon glyphicon-log-out test" ></span> ' . $NavBar["logout"] . ' </a></li>
                        </ul>';
    } elseif (isset($_SESSION['admin'])) {
        if (isset($_SESSION['manager'])) {
            $add = '<li><a href="" data-toggle="modal" data-target="#admin">' . $NavBar["add_admin"] . '</a></li>';
        } else {
            $add = '';
        }
        echo '  <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                ' . $NavBar["maintain"] . '
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu admin_menu">
                                <li><a href="Admin_Home.php">' . $NavBar["edit_home_script"] . '</a></li>
                                <li><a href="Admin_add_product.php">' . $NavBar["add_product"] . '</a></li>
                                <li><a href="" data-toggle="modal" data-target="#categoryModal_">' . $NavBar["add_category"] . '</a></li>
                                <li><a href="Orders_and_Users.php?pageUser=1&pageOrder=1">' . $NavBar["orders_users"] . '</a></li>
                                ' . $add . '
                            </ul>
                        </li>
                    </ul>';

        echo '
                      <a href="home.php?lang=ar" class="btn btn-default ln_switcher nav navbar-nav navbar-right">ع</a>
                        <ul class="nav navbar-nav navbar-right right_nav nav_content NavBar">
                             <li><a href="../Controllers/logoutAdminController.php">'
        . '<span class="glyphicon glyphicon-log-out test" ></span> ' . $NavBar["logout"]
        . ' </a></li>'
        . '</ul>';
    } else {
        echo '</ul>
                      <a href="home.php?lang=ar"class="btn btn-default ln_switcher nav navbar-nav navbar-right">ع</a>
                      <ul class="nav navbar-nav navbar-right right_nav nav_content NavBar">
                        <li><a href="" data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-lock test" ></span> ' . $NavBar["login"] . ' </a></li>
                        <li><a href="" data-toggle="modal" data-target="#signupModal"><span class="glyphicon glyphicon-user test" ></span> ' . $NavBar["signup"] . ' </a></li>
                      </ul>';
    }
}
?>
    </div>
</div>
</nav>

<div class="cover" >
    <img src="../Resources/IMG/01.jpg">
</div>






<?php
if (isset($_SESSION['id']) || isset($_SESSION['admin'])) {
    
} else {
    echo '
    <!-- Modal Login -->
<div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container_">
                    <form action="../Controllers/loginUserController.php" method="POST">
                        <div class="row_">
                            <div class="vl_">
                                <span class="vl-innertext">or</span>
                            </div>

                            <div class="col_ direction_">
                                <a href="' . $facebook . '" class="fb btn_">
                                    <i class="fa fa-facebook fa-fw"></i>
                                    
                                    ' . $SignIn["login_facebook"] . '
                                    

                                </a>
                                <a href="' . $google . '" class="google btn_"><i class="fa fa-google fa-fw">
                                    </i> 
                                    
                                    ' . $SignIn["login_google"] . '
                                    
                                </a>
                                <a href="" class="btn_ btn_signup text-center" data-toggle="modal" data-target="#signupModal">
                                    <i class="fa fa-google fa-fw">
                                    </i>
                                    
                                     ' . $NavBar["signup"] . '
                                    
                                </a>
                            </div>

                            <div class="col_ direction_">
                                <div class="hide-md-lg">
                                    <p>
                                        
                                        ' . $SignIn["sign_manual"] . ' :
                                        

                                    </p>
                                </div>
                                
                                <input class="input_" type="text" name="email" placeholder="' . $SignIn["email"] . '" required style="color:#000">
                                          <input class="input_" type="password" name="password" placeholder="' . $SignIn["password"] . '" required style="color:#000">
                                          <input name="Login" type="submit" class="input_" value="' . $NavBar["login"] . '" >
                                

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    ';
    echo '<!-- Model Sign Up -->
    <div class="modal fade" id="signupModal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                
                            <form action="../Controllers/signupUserController.php" class="well" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="pwd">' . $SignIn["first_name"] . ':</label>
                                <input  type="text" class="form-control" id="fn" placeholder="' . $SignIn["enter_fn"] . '" name="first_name" minlength="2" maxlength="100" required>
                            </div>
                            <div class="form-group">
                                <label>' . $SignIn["last_name"] . ':</label>
                                <input  type="text" class="form-control" id="ln" placeholder="' . $SignIn["enter_ln"] . '" name="last_name" minlength="2" maxlength="100"  required>
                            </div>
                            <div class="form-group">
                                <label>' . $SignIn["email"] . ':</label>
                                <input type="email" class="form-control" id="email" placeholder="' . $SignIn["enter_email"] . '" name="email" minlength="2" required>
                                <b id="" class="not_matched">not matched</b>
                                <b id="" class="matched">matched</b>
                            </div>
                            <div class="form-group">
                                <label for="pwd">' . $SignIn["password"] . ':</label>
                                <input type="password" id="pwd" class="form-control" placeholder="' . $SignIn["enter_password"] . '" name="password" minlength="10" maxlength="100" required>
                            </div>
                            <div class="form-group">
                                <label >' . $SignIn["re_password"] . ':</label>
                                <input type="password" id="rpwd" class="form-control" id="re_pwd" placeholder="' . $SignIn["enter_pw_again"] . '" name="resetpassword" minlength="10" maxlength="100"  required>
                                <b id="" class="not_matched"><span class="glyphicon glyphicon-remove" ></span></b>
                                <b id="" class="matched"><span class="glyphicon glyphicon-ok" ></span></b>
                            </div>
                            <div class="form-group">
                                <label>' . $SignIn["phone"] . ':</label>
                                <div class="text-center upload_form" >
                                    <input required="required" type="text" placeholder="' . $SignIn["enter_phone"] . '" name="phone" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label >' . $SignIn["gender"] . ':</label>
                                <select name="gender" class="gender " required>
                                    <option value = "male">' . $SignIn["male"] . '</option>
                                    <option value = "female">' . $SignIn["female"] . '</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>' . $SignIn["photo"] . ':</label>
                                <div class="text-center upload_form" >
                                    <input required="required" type="file" name="image" class="form-control" >
                                </div>
                            </div>
                            <input id="signUp" name="SignUp" type="button" class="btn btn-success disabled signup_btn" value="' . $NavBar["login"] . '" >
                        </form>
            </div>
        </div>
    </div>
</div>
<script src="../Resources/JS/SignUp.js"></script>
';
}
if (isset($_SESSION['admin'])) {
    echo'<!-- Model Category -->
<div class="modal fade" id="categoryModal_" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="../Controllers/addCategoryController.php" method="post" class="well">
                    <div class="form-group traverse_en">
                        <span>' . $English["category_name"] . ':</span>
                        <input id="myCategoryName"  type="text" class="form-control" placeholder="' . $English["enter_category_name"] . '" name="name" required>
                        <b id="myFoundBefore_1" class="not_matched">not matched</b>
                    </div>
                    <div class="form-group traverse_ar">
                        <span>' . $Arabic["category_name"] . '</span>
                        <input id="myCategoryNameAr" type="text" class="form-control"  placeholder="' . $Arabic["enter_category_name"] . '" name="name_ar" required>
                        <b id="myFoundBefore_2" class="not_matched">not matched</b>
                    </div>
                    <input id="myAddCategory__" name="addcategory" type="button" class="disabled btn btn-success addcategory_submit" value="' . $SignIn['add_category'] . '" >
                </form>
                <form action="../Controllers/deleteCategoryController.php" method="post" class="well">
                    <div class="form-group">
                        <span >' . $SignIn['delete_category'] . ' : </span><br>
                        <select name="id" class="deletecategory_submit" required>';
    include_once '../Models/categoryClass.php';
    $category = new Category();
    $data = $category->getAllCategories();
    foreach ($data as $cat) {
        echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>';
    }
    echo '</select>
                        <input name="DeleteCategory" type="submit" class="btn btn-success cat_delete" value="' . $SignIn['delete_category'] . '" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../Resources/JS/category.js"></script>
';
}
if (isset($_SESSION['manager'])) {
    echo'<!-- Model Admin -->
<div class="modal fade" id="admin" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="../Controllers/addAdminController.php" method="post" class="well">
                    <div class="form-group ">
                        <span>' . $SignIn["email"] . ':</span>
                        </div>
                        <div class="form-group ">
                        <input id="adminEmail" type="email" class="form-control " placeholder="' . $SignIn["enter_email"] . '" name="email" required>
                        <b class="myEmailFoundBefore_1 matched"><span class="glyphicon glyphicon-ok" ></span></b>
                        <b class="myEmailFoundBefore_2 not_matched"><span class="glyphicon glyphicon-remove" ></span></b>
                    </div>
                    <div class="form-group ">
                        <span>' . $SignIn["password"] . ':</span>
                        </div>
                        <div class="form-group ">
                        <input id="adminPass" type="password" class="form-control" placeholder="' . $SignIn["enter_password"] . '" name="password" required>
                    </div>
                    <div class="form-group ">
                        <span>' . $SignIn["re_password"] . ':</span>
                        </div>
                        <div class="form-group ">
                        <input id="adminRpass" type="password" class="form-control" placeholder="' . $SignIn["enter_pw_again"] . '" name="repassword" required>
                        <b class="myEmailFoundBefore_1 matched"><span class="glyphicon glyphicon-ok" ></span></b>
                        <b class="myEmailFoundBefore_2 not_matched"><span class="glyphicon glyphicon-remove"></span></b>
                    </div>
                    <input id="addAdmin" name="addAdmin" type="submit" class=" btn btn-success disabled addcategory_submit" value="' . $SignIn["add_admin"] . '" >
                </form>
                <form action="../Controllers/deleteAdminController.php" method="post" class="well">
                    <div class="form-group">
                        <span >' . $SignIn['delete_admin'] . ' : </span><br>
                        <select name="id" class="deletecategory_submit traverse_en">';
    include_once '../Models/adminClass.php';
    $admin = new Admin();
    $data = $admin->selectAdmin();
    foreach ($data as $d) {
        echo '<option value="' . $d['id'] . '">' . $d['email'] . '</option>';
    }
    echo '</select>
                        <input name="DeleteAdmin" type="submit" class="btn btn-success cat_delete" value="' . $SignIn['delete_admin'] . '" >
                    </div>
                </form>
                <form action="../Controllers/updateManagerController.php" method="post" class="well">
                    <div class="form-group">
                        <span>' . $SignIn['receiver_email'] . ' : </span><br>';
    include_once '../Models/adminClass.php';
    $admin = new Admin();
    $data = $admin->selectManager(1, 'Gmail');
    echo '
                    </div>
                    <div class="form-group ">
                        <input type="email" class="form-control " placeholder="' . $data["Gmail"] . '" name="Gmail"> 
                    </div>
                    <div class="form-group ">
                        <span>' . $SignIn['password_manager'] . ' : </span><br>
                    </div>
                    <div class="form-group ">
                        <span>' . $SignIn["password"] . ':</span>
                    </div>
                    <div class="form-group ">
                        <input id="mangerPass" type="password" class="form-control" placeholder="' . $SignIn["enter_password"] . '" name="password" >
                    </div>
                    <div class="form-group ">
                        <span>' . $SignIn["re_password"] . ':</span>
                    </div>
                    <div class="form-group ">
                        <input id="managerRpass" type="password" class="form-control" placeholder="' . $SignIn["enter_pw_again"] . '" name="repassword" >
                        <b id="managerMatched__" class="matched"><span class="glyphicon glyphicon-ok"></span></b>
                        <b id="managerNotMatched__" class="not_matched"><span class="glyphicon glyphicon-remove" ></span></b>
                    </div>
                    <input id="UpdateManager" name="UpdateManager" type="submit" class="btn btn-success  cat_delete" value="' . $SignIn['update'] . '" >
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../Resources/JS/admin.js"></script>
<script src="../Resources/JS/updateManager.js"></script> 

';

}
?>