<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}
include './NavBar.php';
?>

<div class="myNavTabs text-center">
    <form action="" method="POST" enctype="multipart/form-data" >

        <!-- Container (About Section) -->
        <div id="about" class="container-fluid container__">
            <div class="row ">
                <div class="col-sm-8">
                    <h2>About Company Page</h2><br>
                    <div id="" class="well new_definition text-center">
                        <textarea class="well" ></textarea>
                    </div><br>
                    <?php
                    echo '<h2>' . $NavBar["about_company"] . '</h2>';
                    ?>
                    <div id="" class="well new_definition text-center">
                        <textarea class="well" ></textarea>
                    </div>
                </div>
                <div class="col-sm-4">
                    <span class="glyphicon glyphicon-signal logo"></span>
                </div>
            </div>
        </div>

        <!-- Container (About Values) -->
        <div id="values" class="container-fluid bg-grey container__">
            <div class="row">
                <div class="col-sm-4 ">
                    <span class="glyphicon glyphicon-globe logo slideanim"></span>
                </div>
                <div class="col-sm-8">
                    <h2>Our Values</h2><br>
                    <div class="well new_definition text-center">
                        <textarea class="well" ></textarea>
                    </div><br>
                    <?php
                    echo '
                    <h2>'.$NavBar["services"].'</h2>';
                    ?>
                    <div class="well new_definition text-center">
                        <textarea class="well" ></textarea>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" name="apply" value="Done"
               class="btn btn-success btn-md done">
    </form>
</div>

<script src="../Resources/JS/home.js"></script>
<?php include './footer.php'; ?>