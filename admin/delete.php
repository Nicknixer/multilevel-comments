<?php

include ($_SERVER['DOCUMENT_ROOT'].'/inc/autoload.php');

if($is_admin)
{
    $id_to_delete = trim($_GET['id']);
    if(isset($_POST['ok']))
    {
        $STH = $pdo->prepare("DELETE FROM comment WHERE (id = :id) ;");
        $STH->bindParam(':id',$id_to_delete);
        $STH->execute();
        $is_delete = true;
        $redirect = $_SERVER['SERVER_NAME'];
    }
    else
    {
        $rows = $pdo->prepare('SELECT name, message FROM comment WHERE id=:id');
        $rows->bindParam(':id',$id_to_delete);
        $rows->execute();
        $row = $rows->fetch();
        $name = $row['name'];
        $message = $row['message'];
        $is_delete = false;
    }
}

$title = "Removing";

include $_SERVER['DOCUMENT_ROOT'].'/tpl/header.tpl';
include $_SERVER['DOCUMENT_ROOT'].'/tpl/delete.tpl';
include $_SERVER['DOCUMENT_ROOT'].'/tpl/footer.tpl';
?>