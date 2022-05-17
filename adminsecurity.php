<?php
	session_start();
    $pseudo=$_SESSION['pseudo'] ; 
	if ($pseudo!="admin") {
		header('location:login.php');
		exit();
	}
?>