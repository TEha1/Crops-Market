<?php
include_once '../Models/gpConfig.php';
include_once '../Models/fbConfig.php';
$permissions = ['email'];
$facebook = $helper->getLoginUrl($redirectURL, $permissions);
$google = $gClient->createAuthUrl();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Theme Made By www.w3schools.com - No Copyright -->
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

        <link rel="shortcut icon" href="../Resources/IMG/favicon1.png" >
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <?php
        if (0) {
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

    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

        <!-- NavBar -->
        <?php
        if (0) {
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
                        <li class="active"><a href="#myPage">' . $NavBar["home"] . '</a></li>
                        <li ><a href="#values" >' . $NavBar["values"] . '</a></li>
                        <li><a href="#services">' . $NavBar["services"] . '</a></li>
                        <li><a href="#contact">' . $NavBar["contact"] . '</a></li>
                        <li><a href="Products.php">' . $NavBar["products"] . '</a></li> ';
            if (isset($_SESSION['id'])) {
                echo '  </ul>
                    
                      <a class="btn btn-default ln_switcher_ nav navbar-nav navbar-left">En</a>
                        <ul class="nav navbar-nav navbar-left nav_content_ NavBar">
                            <li><a href="myProfile.php?page=1"><span class="glyphicon glyphicon-user test" ></span> ' . $NavBar["profile"] . ' </a></li>
                            <li><a href="../Controllers/logoutUserController.php"><span class="glyphicon glyphicon-log-out test" ></span> ' . $NavBar["logout"] . ' </a></li>
                        </ul>';
            } elseif (isset($_SESSION['admin'])) {
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
                            </ul>
                        </li>
                    </ul>';

                echo '
                      <a class="btn btn-default ln_switcher_ nav navbar-nav navbar-left">En</a>
                        <ul class="nav navbar-nav navbar-left nav_content_ NavBar">
                        <li><a href="../Controllers/logoutAdminController.php">'
                . '<span class="glyphicon glyphicon-log-out test" ></span> ' . $NavBar["logout"]
                . ' </a></li>'
                . '</ul>';
            } else {
                echo '</ul>
                      <a class="btn btn-default ln_switcher_ nav navbar-nav navbar-left">En</a>
                      <ul class="nav navbar-nav navbar-left nav_content_ NavBar">
                        <li><a href="" data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-lock test" ></span> ' . $NavBar["login"] . ' </a></li>
                        <li><a href="" data-toggle="modal" data-target="#signupModal"><span class="glyphicon glyphicon-user test" ></span> ' . $NavBar["signup"] . ' </a></li>
                      </ul>';
            }
        } 
        
        else {
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
                        <li class="active"><a href="#myPage">' . $NavBar["home"] . '</a></li>
                        <li ><a href="#values" >' . $NavBar["values"] . '</a></li>
                        <li><a href="#services">' . $NavBar["services"] . '</a></li>
                        <li><a href="#contact">' . $NavBar["contact"] . '</a></li>
                        <li><a href="Products.php">' . $NavBar["products"] . '</a></li> ';
            if (isset($_SESSION['id'])) {
                echo '  </ul>
                      <a class="btn btn-default ln_switcher nav navbar-nav navbar-right">En</a>
                        <ul class="nav navbar-nav navbar-right right_nav nav_content NavBar">
                            <li><a href="myProfile.php?page=1"><span class="glyphicon glyphicon-user test" ></span> ' . $NavBar["profile"] . ' </a></li>
                            <li><a href="../Controllers/logoutUserController.php"><span class="glyphicon glyphicon-log-out test" ></span> ' . $NavBar["logout"] . ' </a></li>
                        </ul>';
            } elseif (isset($_SESSION['admin'])) {
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
                            </ul>
                        </li>
                    </ul>';

                echo '
                      <a class="btn btn-default ln_switcher nav navbar-nav navbar-right">En</a>
                        <ul class="nav navbar-nav navbar-right right_nav nav_content NavBar">
                             <li><a href="../Controllers/logoutAdminController.php">'
                             . '<span class="glyphicon glyphicon-log-out test" ></span> ' . $NavBar["logout"]
                             . ' </a></li>'
                        . '</ul>';
            } else {
                echo '</ul>
                      <a class="btn btn-default ln_switcher nav navbar-nav navbar-right">En</a>
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
    <img src="../Resources/IMG/img1.jpg">
</div>


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
                                <a href="<?php echo $facebook; ?>" class="fb btn_">
                                    <i class="fa fa-facebook fa-fw"></i>
                                    <?php
                                    echo $SignIn["login_facebook"];
                                    ?>

                                </a>
                                <a href="<?php echo $google; ?>" class="google btn_"><i class="fa fa-google fa-fw">
                                    </i> 
                                    <?php
                                    echo $SignIn["login_google"];
                                    ?>
                                </a>
                                <a href="" class="btn_ btn_signup text-center" data-toggle="modal" data-target="#signupModal">
                                    <i class="fa fa-google fa-fw">
                                    </i>
                                    <?php
                                    echo $NavBar["signup"];
                                    ?>
                                </a>
                            </div>

                            <div class="col_ direction_">
                                <div class="hide-md-lg">
                                    <p>
                                        <?php
                                        echo $SignIn["sign_manual"] . ':';
                                        ?>

                                    </p>
                                </div>
                                <?php
                                echo '<input class="input_" type="text" name="email" placeholder="' . $SignIn["email"] . '" required style="color:#000">
                                          <input class="input_" type="password" name="password" placeholder="' . $SignIn["password"] . '" required style="color:#000">
                                          <input name="submit" type="submit" class="input_" value="' . $NavBar["login"] . '" >';
                                ?>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Model Sign Up -->
<div class="modal fade" id="signupModal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php
                echo '
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
                            </div>
                            <div class="form-group">
                                <label for="pwd">' . $SignIn["password"] . ':</label>
                                <input type="password" id="pwd" class="form-control" placeholder="' . $SignIn["enter_password"] . '" name="password" minlength="10" maxlength="100" required>
                            </div>
                            <div class="form-group">
                                <label >' . $SignIn["re_password"] . ':</label>
                                <input type="password" id="rpwd" class="form-control" id="re_pwd" placeholder="' . $SignIn["enter_pw_again"] . '" name="resetpassword" minlength="10" maxlength="100"  required>
                                <b id="notMatched" class="not_matched">not matched</b>
                                <b id="matched" class="matched">matched</b>
                            </div>
                            <div class="form-group">
                                <label >' . $SignIn["gender"] . ':</label>
                                <select name="gender" class="gender " required>
                                    <option>' . $SignIn["male"] . '</option>
                                    <option>' . $SignIn["female"] . '</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>' . $SignIn["photo"] . ':</label>
                                <div class="text-center upload_form" >
                                    <input required="required" type="file" name="image" class="form-control" >
                                </div>
                            </div>
                            <input id="signUp" name="submit" type="button" class="btn btn-success disabled signup_btn" value="' . $NavBar["login"] . '" >
                        </form>
                            ';
                ?>
            </div>
        </div>
    </div>
</div>


<!-- Model Category -->
<div class="modal fade" id="categoryModal_" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="../Controllers/addCategoryController.php" method="get" class="well" >
                    <div class="form-group">
                        <span>Category Name :</span>
                        <input  type="text" class="form-control" placeholder="Enter category name" name="name_en" required>
                    </div>
                    <div class="form-group">
                        <span>اسم النوع</span>
                        <input  type="text" class="form-control"  placeholder="اسم النوع" name="name_ar" required>
                    </div>
                    <input name="submit" type="submit" class="btn btn-success addcategory_submit"value="addcategory" >
                </form>
                <form action="../Controllers/deleteCategoryController.php" method="post" class="well">
                    <div class="form-group">
                        <span >Delete Category : </span><br>
                        <select name="id" class="deletecategory_submit">
                            <?php
                            include_once '../Models/categoryClass.php';
                            $category = new Category();
                            $data = $category->getAllCategories();
                            foreach ($data as $cat) {
                                echo '<option value="' . $cat['id'] . '">' . $cat['name_en'] . '</option>';
                            }
                            ?>
                        </select>
                        <input name="submit" type="submit" class="btn btn-success cat_delete" value="DeleteCategory" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../Resources/JS/SignUp.js"></script>


