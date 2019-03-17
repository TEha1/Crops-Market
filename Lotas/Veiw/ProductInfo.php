<?php include 'NavBar.php'; ?>


<div class="container-fluid myNavTabs">
    <ul class="nav nav-tabs nav-justified">
        <?php
            echo '<li class="active"><a href="#defention" data-toggle="pill">' . $Admin_Product["definition"] . '</a></li>
                <li><a href="#structure" data-toggle="pill">' . $Admin_Product["structure"] . '</a></li>
                <li><a href="#usingWay" data-toggle="pill">' . $Admin_Product["using_way"] . '</a></li>
                <li><a href="#advantages" data-toggle="pill">' . $Admin_Product["advantages"] . '</a></li>';
        ?>
    </ul>
    <div class="tab-content">
        <div id="defention" class="tab-pane fade in active">
            <div class="row">
                <div class="col-sm-5 prod_img ">
                    <img src="../Resources/IMG/prod_01.jpg">
                </div>
                <?php
                    echo '<div class="col-sm-7 prod_info ">
                    <h4 class="page-header">كونكور وصل والأكاروس �?صل</h4>
                    <p class="well">
                    يشمل برنامج للمكا�?حة المتكاملة IPM للأكاروسات إتباع طرق الخدمة الزراعية خاصة التخلص من الحشائش، والري المنتظم والتسميد المتوازن لتقوية النباتات، وتستخدم المكا�?حة الكيماوية قبل الحدود الإقتصادية الحرجة للأكاروسات وتبلغ ٣ - ٥ أ�?راد للورقة أو الثمرة، وللوصول إلي ك�?اءة مرت�?عة للمركبات المستخدمة، لابد من التطبيق الصحيح، واستخدام ألة الرش المناسبة، وضرورة التغطية الكاملة لسطحي الأوراق المعاملة، وتناوب أستخدام المبيدات، والبداية بمبيد
                    </p>
                </div>';
                
                ?>

            </div>

        </div>
        <div id="structure" class="tab-pane fade">
            <?php
                echo '<ul class="well struc_">
                <li>' . $Admin_Product["effective_material"] . ':</li>
                <p class="">
                    Ut enim ad minim veniam, Ut enim ad minim veniam.  
                </p>

                <li>' . $Admin_Product["chemical_group"] . ':</li>
                <p>
                    Ut enim ad minim veniam, Ut enim ad minim veniam,<br>
                    Ut enim ad minim veniam,Ut enim ad minim veniam.    
                </p>
                <li>' . $Admin_Product["chemical_increase"] . ':</li>
                <p>
                    Ut enim ad minim veniam, Ut enim ad minim veniam,
                    Ut enim ad minim veniam,Ut enim ad minim veniam,Ut enim ad minim veniam,
                    Ut enim ad minim veniam, Ut enim ad minim veniam, Ut enim ad minim veniam.<br>
                    Ut enim ad minim veniam,Ut enim ad minim veniam.   
                </p>
            </ul>';
            ?>

        </div>
        <div id="usingWay" class="tab-pane fade">
            <ul class="well struc_">
                <?php
                    echo '<li>' . $Admin_Product["how_to_use"] . ':</li>
                <p class="">
                يوصي باستخدام المبيد الأكاروسي كونكور وقائياً عند بداية ظهور الإصابة 
                </p>
                <li>' . $Admin_Product["explanation_video"] . ':</li>';
                ?>
                <div class="ex_video">
                    <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY">
                    </iframe>
                </div>
            </ul>
        </div>
        <div id="advantages" class="tab-pane fade">
            <ul class="well advan_">
                <li> Ut enim ad minim veniam, Ut enim ad minim.</li>
                <li> Ut enim ad minim veniam, Ut enim ad minim.</li>
                <li> Ut enim ad minim veniam, Ut enim ad minim.</li>
                <li> Ut enim ad minim veniam, Ut enim ad minim.</li>
                <li> Ut enim ad minim veniam, Ut enim ad minim.</li>
                <li> Ut enim ad minim veniam, Ut enim ad minim.</li>
            </ul>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>