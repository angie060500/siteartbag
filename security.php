<?php
	session_start();
	if (!isset($_SESSION['id'])) {
		$_SESSION['info'] = "You do not have the right to access here";
		header('location:login.php');
		exit();
	}
?>