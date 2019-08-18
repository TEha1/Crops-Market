<?php
if($_SERVER['PHP_SELF'] == '/Veiw/footer.php'  )
{
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}
?>
<div class="footer text-center">
    <div class="container-fluid">
        <div class="icon">
            <a href="#"><img  src="../Resources/IMG/facebook.png"></a>
            <a href="#"><img  src="../Resources/IMG/twitter.png"></a>
            <a href="#"><img  src="../Resources/IMG/googleplus.png"></a>
            <a href="#"><img  src="../Resources/IMG/youtube.png"></a>
        </div>
        <div class="copy">
            Copyright &copy; 2018 <a href="#" class="hvr-grow-rotate"><span>Lotus</span></a>
        </div>
    </div>
</div>

</body>
</html>
