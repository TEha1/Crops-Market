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
        <title>Lotus</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="../Resources/CSS/main.css">
        <link rel="shortcut icon" href="../Resources/IMG/favicon1.png" >
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

        <!-- NavBar -->
        <nav class="navbar nav_ navbar-fixed-top" >
            <div class="">
                <div class="navbar-header navbar-left">
                    <button type="button" class="navbar-toggle navbar-toggle_" data-toggle="collapse" data-target="#NavBar">
                        <span class="icon-bar" style="background-color: darkgreen"></span>
                        <span class="icon-bar" style="background-color: darkgreen"></span>
                        <span class="icon-bar" style="background-color: darkgreen"></span>
                    </button>
                    <a href="" class="navbar-brand" style="color: white">Our Logo</a>
                </div>
                <div id="NavBar" class="collapse navbar-collapse" style="margin-right: 60px">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="home.php">Home.</a></li>
                        <li><a href="#values">Values.</a></li>
                        <li><a href="#services">Services.</a></li>
                        <li><a href="#contact">Contact.</a></li>
                        <li><a href="Products.php">Products.</a></li>
                        <?php
                        if (isset($_SESSION['id'])) {
                            echo '<li><a href="myProfile.php"><span class="glyphicon glyphicon-user test" ></span> profile</a></li>
                            <li><a href="../Controllers/logoutUserController.php"><span class="glyphicon glyphicon-log-out test" ></span> Logout</a></li>';
                        } 
                        else 
                        {
                            echo '<li><a href="" data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-lock test" ></span> Login</a></li>
                            <li><a href="" data-toggle="modal" data-target="#signupModal"><span class="glyphicon glyphicon-user test" ></span> Sign Up</a></li>';
                        }
                        ?>
                    </ul>
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
                                    <div class="col_">
                                        <a href="<?php echo $facebook; ?>" class="fb btn_">
                                            <i class="fa fa-facebook fa-fw"></i> Login with Facebook
                                        </a>
                                        <a href="<?php echo $google; ?>" class="google btn_"><i class="fa fa-google fa-fw">
                                            </i> Login with Google+
                                        </a>
                                    </div>

                                    <div class="col_">
                                        <div class="hide-md-lg">
                                            <p>Or sign in manually:</p>
                                        </div>

                                        <input class="input_" type="text" name="email" placeholder="Username" required>
                                        <input class="input_" type="password" name="password" placeholder="Password" required>
                                        <button name="submit" type="submit" class="input_" value="LogIn" >Log In</button>
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
                        <form action="../Controllers/signupUserController.php" class="well" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="pwd">First Name:</label>
                                <input  type="text" class="form-control" id="fn" placeholder="Enter first name" name="first_name" required>
                            </div>

                            <div class="form-group">
                                <label>Last Name:</label>
                                <input  type="text" class="form-control" id="ln" placeholder="Enter last name" name="last_name" required>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label >Repeat Password:</label>
                                <input type="password" class="form-control" id="pwd" placeholder="Enter password again" name="resetpassword" required>
                            </div>
                            <div class="form-group">
                                <label >Choice Your Picture:</label>
                                <input type="file" class="form-control" id="pwd"  name="image" required>
                            </div>
                            <div class="form-group">
                                <label >Gender:</label>
                                <select name="gender" class="gender" style="width: 50%; border-radius: 5px">
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                            <button name="submit" type="submit" class="btn btn-success" style="width: 100%" value="SignUp" >Sign Up</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>

<?php
        echo'ما هذا';