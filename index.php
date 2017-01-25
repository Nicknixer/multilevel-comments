<?php

include '/inc/autoload.php';

//
// Хранит ошибку валидации.
// Ей всегда нужна инициализация, т.к. используется в шаблоне вывода
//
$errors = '';

//
// Сохраняем переданные данные из формы
// Заполняем ими форму после неуспешной попытки добавления или обновления страницы
//
$msg_after_refresh = isset($_POST['message']) ? $_POST['message'] : '';
$name_after_refresh = isset($_POST['name']) ? $_POST['name'] : '';


//
// Action click on "Add"
//

$isadd = (isset($_POST['add']))? true : false; // Была ли нажата кнопка "Add"

if($isadd)
{
	$msg_to_save = trim(htmlspecialchars($_POST['message']));
	$name_to_save = trim(htmlspecialchars($_POST['name']));
    if( empty($msg_to_save) || (strlen($msg_to_save) > 200) ) {
		$errors = "Enter message! (Max: 200)";
    }
    elseif ( empty($name_to_save) || (strlen($name_to_save) > 12) ) {
		$errors = "Enter name! (Max: 12)";
	} else {
        addComment( $name_to_save, $msg_to_save );
		$msg_after_refresh = '';
		$name_after_refresh = '';
    }
}

//
// Action click on "Refresh"
//
if(isset($_POST['refresh']))
{
    $msg_after_refresh = trim(htmlspecialchars($_POST['message']));
    $name_after_refresh = trim(htmlspecialchars($_POST['name']));
}

$title = "Page";
include '/tpl/header.tpl';
include '/tpl/page.tpl';
include '/tpl/footer.tpl';

?>