<?php
//finish
if(!isset($_SESSION)){session_start();}
if(isset($_POST['UpdateManager']) && isset($_SESSION['manager']))
{
    try
    {
        include_once'../Models/adminClass.php';
        $admin = new Admin();

        if($_POST['Gmail']!='')
        {
            $admin->updateManager(1,'Gmail',filter_var($_POST['Gmail'],FILTER_SANITIZE_EMAIL));
        }
        if($_POST['password'] !='')
        {
            $admin->updateManager(1,'password',filter_var($_POST['password'],FILTER_SANITIZE_STRING));
        }
        header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
    }
    catch (Exception $ex) 
    {
        //someting wrong find an idea
        //echo $ex->getMessage();
        header('Location: ' . filter_var('../Veiw/home.php?notify=wrong_in_system', FILTER_SANITIZE_URL));
    }
}
else
{
    //echo '//someone go direct to this page and route to home';
    header('Location: ' . filter_var('../Veiw/home.php', FILTER_SANITIZE_URL));
}