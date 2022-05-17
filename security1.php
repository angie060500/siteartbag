<?php
	if (!isset($_SESSION['id'])) {
		$_SESSION['info'] = "Invalid email or password";
		header('location:login.php');
		exit();
	}
?>