<?php

include ($_SERVER['DOCUMENT_ROOT'].'/inc/autoload.php');

if($is_admin)
{
    $id_to_edit = trim($_GET['id']);
    if(isset($_POST['ok']))
    {
        $name_to_save = trim(htmlspecialchars($_POST['name']));
        $message_to_save = trim(htmlspecialchars($_POST['message']));
        updateComment($id_to_edit, $name_to_save, $message_to_save); // Обновляем запись в БД
        $is_edit = true;
        $redirect = $_SERVER['SERVER_NAME'];
    }
    else
    {
        $comment = getComment($id_to_edit);
        $name = $comment['name'];
        $message = $comment['message'];
        $is_edit = false;
    }
}

$title = "Editing";

include $_SERVER['DOCUMENT_ROOT'].'/tpl/header.tpl';
include $_SERVER['DOCUMENT_ROOT'].'/tpl/edit.tpl';
include $_SERVER['DOCUMENT_ROOT'].'/tpl/footer.tpl';
?>