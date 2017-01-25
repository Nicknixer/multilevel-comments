<div class="msg">Article!<br />Comment this, pls!</div>
<?php
if($errors != '') echo '<div class="error">'.$errors.'</div>';
?>
<form action="?" method="POST">
<input type="text" name="name" placeholder="Your name" maxlength="12" size="12" value="<?=$name_after_refresh; ?>" required />
	<textarea name="message" cols="50" rows="4" maxlength="450" placeholder="Type your message here" autofocus required><?=$msg_after_refresh; ?></textarea>
	<br/>
	<button name="add">Add</button>
	<button name="refresh">Refresh</button>
</form>

<div class="head">Comments:</div>

<?php  
showComments(); // Выводим коментарии
if($is_admin) {
	echo '<div class="msg"><a href="/admin/logout.php">Logout</a></div>';
} else {
	echo '<div class="msg"><a href="/admin/login.php">Sign in</a></div>';
}
?>