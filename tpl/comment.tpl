<div class="msg" style='margin-left: <?=($level * 25); ?>px;'><b><?=$comment['name']; ?></b>. Date: <?=$comment['date']; ?>
<?php
/*
if($is_admin)
	{
		echo '<a href="/admin/edit.php?id='.$comment['id'].'"><img src="/img/edit.png" width="12" height="12" alt="e"/></a>';
		echo '<a href="/admin/delete.php?id='.$comment['id'].'"><img src="/img/delete.png" width="12" height="12" alt="x"/></a>';
	}
	*/
?>
<br/>
<b>Message</b>: <?=$comment['message']; ?> 
<?php if($level < $max_comments_level-1) { ?>
<br/><a href="answer.php?id=<?=$comment['id']; ?>">Answer</a>
<?php } ?>
</div>