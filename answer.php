<?php

include '/inc/autoload.php';

$id_to_answer = trim(htmlspecialchars($_GET['id']));

//
// Здесь имеется уязвимость
// Мы можем перейти к ответу на комментарий 5+ уровня,
// достаточно лишь перейти по адресу /answer.php?id={id коомментария 5+ уровня}
//

$errors = '';
$is_answered = false;

if(isset($_POST['ok'])) {
	$msg_to_save = trim(htmlspecialchars($_POST['message']));
	$name_to_save = trim(htmlspecialchars($_POST['name']));
    if( empty($msg_to_save) || (strlen($msg_to_save) > 200) ) {
		$errors = "Enter message! (Max: 200)";
    }
    elseif ( empty($name_to_save) || (strlen($name_to_save) > 12) ) {
		$errors = "Enter name! (Max: 12)";
	} else {
	    addComment( $name_to_save, $msg_to_save, $id_to_answer );
		$is_answered = true;
    }
}
if(!$is_answered){
    $comment = getComment($id_to_answer);
	$name = $comment['name'];
	$message = $comment['message'];
}

$title = "Answering";

include '/tpl/header.tpl';
include '/tpl/answer.tpl';
include '/tpl/footer.tpl';
?>