<?php
include_once 'NavBar.php';
?>


<!-- Container (About Section) -->
<div id="about" class="container-fluid container__">
    <div class="row">
        <div class="col-sm-8">
            <?php
            echo '<h2>' . $NavBar["about_company"] . '</h2><br>
                <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h4><br>
                <p>إجراء تغييراتك على المساهمين لأول مرة: قم بالتسجيل عن طريق إضا�?ة اسم المستخدم الخاص بك واسمك بالكامل وعنوان بريدك الإلكتروني وتاريخ أول مساهمة. على النحو التالي اسم المستخدم والاسم الكامل وعنوان البريد الإلكتروني ارتكاب التغييرات الخاصة بك. أرسل طلب سحب.</p>
                ';
            ?>
        </div>
        <div class="col-sm-4 text-center">
            <span class="glyphicon glyphicon-signal logo"></span>
        </div>
    </div>
</div>

<!-- Container (About Values) -->
<div id="values" class="container-fluid bg-grey container__ ">
    <div class="row">
        <div class="col-sm-4 text-center">
            <span class="glyphicon glyphicon-globe logo slideanim"></span>
        </div>
        <div class="col-sm-8 ">
            <?php
            echo '<h2>' . $NavBar["values"] . '</h2><br>
                <h4><strong>MISSION:</strong> Our mission lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h4><br>
                <p><strong>VISION:</strong> Our vision Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>';
            ?>

        </div>
    </div>
</div>

<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center container__">
    <?php
    echo '<h2>' . $NavBar["services"] . '</h2><br>';
    ?>
    <h4>What we offer</h4>
    <br>
    <div class="row slideanim ">
        <div class="col-sm-4">
            <span class="glyphicon glyphicon-off logo-small"></span>
            <h4>POWER</h4>
            <p>Lorem ipsum dolor sit amet..</p>
        </div>
        <div class="col-sm-4">
            <span class="glyphicon glyphicon-heart logo-small"></span>
            <h4>LOVE</h4>
            <p>Lorem ipsum dolor sit amet..</p>
        </div>
        <div class="col-sm-4">
            <span class="glyphicon glyphicon-lock logo-small"></span>
            <h4>JOB DONE</h4>
            <p>Lorem ipsum dolor sit amet..</p>
        </div>
    </div>
    <br><br>
    <div class="row slideanim">
        <div class="col-sm-4">
            <span class="glyphicon glyphicon-leaf logo-small"></span>
            <h4>GREEN</h4>
            <p>Lorem ipsum dolor sit amet..</p>
        </div>
        <div class="col-sm-4">
            <span class="glyphicon glyphicon-certificate logo-small"></span>
            <h4>CERTIFIED</h4>
            <p>Lorem ipsum dolor sit amet..</p>
        </div>
        <div class="col-sm-4">
            <span class="glyphicon glyphicon-wrench logo-small"></span>
            <h4>HARD WORK</h4>
            <p>Lorem ipsum dolor sit amet..</p>
        </div>
    </div>
</div>

<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey container__">
    <?php
        echo '<h2 class="text-center">'.$NavBar["contact"].'</h2>';
    ?>
    <div class="row">
        <div class="col-sm-5">
            <p>Contact us and we'll get back to you within 24 hours.</p>
    <p><span class = "glyphicon glyphicon-map-marker"></span> Chicago, US</p>
    <p><span class = "glyphicon glyphicon-phone"></span> +00 1515151515</p>
    <p><span class = "glyphicon glyphicon-envelope"></span> myemail@something.com</p>
    </div>
    <div class = "col-sm-7 slideanim">
    <div class = "row">
    <div class = "col-sm-6 form-group">
    <input class = "form-control" id = "name" name = "name" placeholder = "Name" type = "text" required>
    </div>
    <div class = "col-sm-6 form-group">
    <input class = "form-control" id = "email" name = "email" placeholder = "Email" type = "email" required>
    </div>
    </div>
    <textarea class = "form-control" id = "comments" name = "comments" placeholder = "Comment" rows = "5"></textarea><br>
    <div class = "row">
    <div class = "col-sm-12 form-group">
    <button class = "btn btn-default pull-right" type = "submit">Send</button>
    </div>
    </div>
    </div>
    </div>
    </div>
    <script src = "../Resources/JS/home.js"></script>
<?php
include_once 'footer.php';
?>
