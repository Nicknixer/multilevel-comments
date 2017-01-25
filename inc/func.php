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
 * Получение массива со всеми комментариями
 * Позволяет не делать запрос к БД в каждой ветке рекурсии
 */
$comments_array = array();
function getAllCommentsLink() {
    global $comments_array;
    if(empty($comments_array))
    {
        $comments_array = getAllComments();
    }
    return $comments_array;
}

/**
 * Вывод дерева комментариев
 * @param Integer $parent_id - id-родителя
 * @param Integer $level - уровень вложености
 */
function viewComments($parent_id, $level) {
	global $max_comments_level, $is_admin;
    $comments = getAllCommentsLink();
    if (isset($comments[$parent_id])) { 
        foreach ($comments[$parent_id] as $comment) { 
			// Жутко, однако логика с представлением разделены
			include '/tpl/comment.tpl'; // Выводим с помощью шаблона 
            viewComments($comment["id"], $level+1); // Рекурсивно достаем дочерние комментарии
        }
    }
}

/**
 * Вывод комментариев
 * Для использовании в шаблоне вывода
 */
function showComments() {
    viewComments(0, 0);
}

/**
 * Удаление дерева комментариев
 * @param Integer $parent_id - id комментария
 */
function deleteCommentTree($parent_id) {
    $comments = getAllCommentsLink();
    deleteComment($parent_id);
    if (isset($comments[$parent_id])) {
        foreach ($comments[$parent_id] as $comment) {
            deleteCommentTree($comment['id']); // Рекурсивно удаляем дочерние комментарии
        }
    }
}

/**
 * Удаление комментария
 * @param Integer $id - id комментария
 */
function deleteComment($id){
    global $pdo;
    $STH = $pdo->prepare("DELETE FROM comment WHERE (id = :id) ;");
    $STH->bindParam(':id',$id);
    $STH->execute();
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
 * Изменение комментария в БД
 * @param Integer $id - id
 * @param String $name - имя комментатора
 * @param String $message - текст комментария
 */
function updateComment($id, $name, $message) {
    global $pdo;
    $rows = $pdo->prepare('UPDATE comment SET message=:message, name=:name WHERE id=:id;');
    $rows->bindParam(':id',$id);
    $rows->bindParam(':name',$name);
    $rows->bindParam(':message',$message);
    $rows->execute();
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

/**
 * Проверка уровня вложенности комментария
 *
 * Самый верхний уровень комментария - 0
 *
 * @param Integer $id - id комментария
 * @return Integer - уровень вложенности
 */
function checkCommentLevel($id){
    $parent_id = getComment($id)['parent_id'];
    if($parent_id == 0) return 0;
    return 1+checkCommentLevel($parent_id);
}

/**
 * Проверка существования комментария
 *
 * @param Integer $id - id комментария
 * @return Boolean - существует ли
 */
function isExistComment($id){
    $comment = getComment($id);

    if(isset($comment['id'])){
        return true;
    }
    return false;
}


