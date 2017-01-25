<?php

if($is_admin) {
	if($is_delete) {
		echo '<div class="msg">Message is deleted.</div>';
    } else { ?>
<div class="msg"><b><?=$name; ?></b>: <?=$message; ?></div>
<div class="msg">Are you really want to delete this message?</div>
<form action="?id=<?=$id_to_delete; ?>" method="POST">
    <input type = "submit" name = "ok" value = "Yes"/>
</form>

<?php
	}
} else { ?>

<div class="msg">Access denied!</div>

<?php
} ?>

<div class = "msg"><a href = "/">Home</div>