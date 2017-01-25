<div class="msg">Auth</div>
<?php
if($errors != '')
{
	echo '<div class="error">'.$errors.'</div>';
}
if($is_success)
{
echo '<div class="msg">Success!<br/></div>';
}
else { ?>
<form action="?" method="POST">
    <input type="text" name="password" placeholder="Type your password"/>
    <input type="submit" name="ok" value="Enter"/>
</form>
<?php } ?>
<div class="msg"><a href="/">Home</a></div>