<?php
	session_start();

	$_SESSION['authenticated_user'] = false;
	$_SESSION['authenticated_admin'] = false;
	header("Location: main_pg.php");
?>