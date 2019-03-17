<?php
if(!isset($_SESSION))
{
	session_start();
}
if(!isset($_SESSION['admin']))
{
     header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}
else
{
    session_destroy();
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}