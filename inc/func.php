<?php

/**
 * Получение всех комментариев
 */
function getAllComments() {
	global $pdo;
	$rows = $pdo->prepare('SELECT * FROM comment');
	$rows->execute();
	$comments = $rows->fetchAll();
	foreach($comments as $comment){
		$result[$comment["parent_id"]][] = $comment;
	}
    return $result;
}
 
/**
 * Вывод дерева комментариев
 * @param Integer $parent_id - id-родителя
 * @param Integer $level - уровень вложености
 */
function viewComments($parent_id, $level) {
	global $max_comments_level, $is_admin;
    $comments = getAllComments(); 
    if (isset($comments[$parent_id])) { 
        foreach ($comments[$parent_id] as $comment) { 
			// Жутко, однако логика с представлением немного разделены
			include '/tpl/comment.tpl'; // Выводим с помощью шаблона 
            viewComments($comment["id"], $level+1); // Рекурсивно достаем дочерние комментарии
        }
    }
}

/**
 * Добавление комментария в БД
 * @param String $name - имя комментатора
 * @param String $message - текст комментария
 * @param Integer $parent_id - id-родителя
 */
function addComment($name, $message, $parent_id = 0) {
    global $pdo;
    $STH = $pdo->prepare("INSERT INTO comment (name,message,parent_id) VALUES (:name,:message,:parent_id);");
    $STH->bindParam(':name',$name);
    $STH->bindParam(':message',$message);
    $STH->bindParam(':parent_id',$parent_id);
    $STH->execute();
}

/**
 * Получение одного комментария
 * @param Integer $id - id комментария
 * @return Array
 */
function getComment($id){
    global $pdo;
    $rows = $pdo->prepare('SELECT * FROM comment WHERE id=:id');
    $rows->bindParam(':id',$id);
    $rows->execute();
    return $rows->fetch();
}

