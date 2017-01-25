<?php

$is_admin = false;
if(isset($_SESSION["pass"]))
{
	if($_SESSION["pass"] == $admin_hash_pass)
	{
		$is_admin = true;
	}
}
?>