<?php

if($is_admin) {
	if($is_edit) {
		echo '<div class="msg">Message is edited.</div>';
} else { ?>

<form action="?id=<?=$id_to_edit; ?>" method="POST">
    <input type="text" name="name" placeholder="Name" value="<?=$name; ?>" maxlength="12" size="12" autofocus required />
    <textarea name="message" cols="50" rows="4" maxlength="200" placeholder="Comment" required><?=$message ?></textarea>
    <input type = "submit" name = "ok" value = "Edit"/>
</form>

<?php
	}
} else { ?>

<div class="msg">Access denied!</div>

<?php
} ?>

<div class = "msg"><a href = "/">Home</div>