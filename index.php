<?php

include '/inc/autoload.php';

$errors = '';
$msg_after_refresh = isset($_POST['message']) ? $_POST['message'] : '';
$name_after_refresh = isset($_POST['name']) ? $_POST['name'] : '';
$isadd = (isset($_POST['add']))? true : false;

//
// Action click on "Refresh"
//
if(isset($_POST['refresh']))
{
    $msg_after_refresh = $_POST['message'];
    $name_after_refresh = $_POST['name'];
}



$title = "Page";
include '/tpl/header.tpl';
include '/tpl/page.tpl';
include '/tpl/footer.tpl';

?>