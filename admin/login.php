<?php

$errors = '';
$is_success = false;

include ($_SERVER['DOCUMENT_ROOT'].'/inc/autoload.php');

if(!empty($_POST['ok']))
{
    if($_POST['password'] != '')
    {
        if($admin_hash_pass == hash("sha256",$_POST['password'],false))
        {
            setcookie('pass', $admin_hash_pass, time()+60*60*24, '/');
            $redirect = $_SERVER['SERVER_NAME'];
            $is_success = true;
        }
        else
        {
            $errors = 'Wrong password!';
        }
    }
    else
    {
        $errors = 'Enter password!';
    }
}

$title = "Admin access";

include $_SERVER['DOCUMENT_ROOT'].'/tpl/header.tpl';
include $_SERVER['DOCUMENT_ROOT'].'/tpl/login.tpl';
include $_SERVER['DOCUMENT_ROOT'].'/tpl/footer.tpl';

?>