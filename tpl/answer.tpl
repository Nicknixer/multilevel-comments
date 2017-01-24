<?php 

if($is_answered) {
	echo '<div class="msg">Answer is added.</div>';
}
else
{
	if($errors) {
		echo '<div class="error">'. $errors .'</div>';
	}
?>
	<div class="msg"><strong><?=$name; ?></strong>: <?=$message; ?></div>
	<form action="?id=<?=$id_to_answer; ?>" method="POST">
	<input type="text" name="name" placeholder="Your name" maxlength="12" size="12" autofocus required />
	<textarea name="message" cols="50" rows="4" maxlength="200" placeholder="Type your answer here" required></textarea>
	<input type = "submit" name = "ok" value = "Answer"/>
	</form>
	
<?php
}
?>

<div class = "msg"><a href = "/">Home</div>