<?php

//
// Получение всех комментариев
//

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
	global $max_comments_level;
    $comments = getAllComments(); 
    if (isset($comments[$parent_id])) { 
        foreach ($comments[$parent_id] as $comment) { 
			// Жутко, однако логика с представлением немного разделены
			include '/tpl/comment.tpl'; // Выводим с помощью шаблона 
            viewComments($comment["id"], $level+1); // Рекурсивно достаем дочерние комментарии
        }
    }
}
