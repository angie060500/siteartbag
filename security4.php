<?php
	session_start();
	if (!isset($_SESSION['id'])) {
		$_SESSION['info'] = "You have to login";
		header('location:login.php');
		exit();
	}
?>