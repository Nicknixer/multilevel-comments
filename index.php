<?php

include '/inc/autoload.php';

$errors = '';
$msg_after_refresh = isset($_POST['message']) ? $_POST['message'] : '';
$name_after_refresh = isset($_POST['name']) ? $_POST['name'] : '';
$isadd = (isset($_POST['add']))? true : false;

//
// Action click on "Add"
//

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
		//Save message
		$STH = $pdo->prepare("INSERT INTO comment (name,message) VALUES (:msg,:name);");
		$STH->bindParam(':msg',$msg_to_save);
		$STH->bindParam(':name',$name_to_save);
		$STH->execute();
		//////////
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