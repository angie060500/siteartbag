<?php
require_once('connection.php') ; 
session_start();
$pseudo= $_SESSION['pseudo'];
$id= $_SESSION['id'];

$sql ="SELECT * FROM user WHERE idu= '$id'" ;
$result= mysqli_query($conn, $sql);
$row= mysqli_fetch_assoc($result) ; 
$pseudo = $row['pseudo'] ; 
$mail= $row['mail'] ; 
$sql ="DELETE FROM contact WHERE mail= '$mail'" ;
$result= mysqli_query($conn, $sql);
$sql ="DELETE FROM commande WHERE idcc= '$id'" ;
$result= mysqli_query($conn, $sql);
$sql ="DELETE FROM fact WHERE idc= '$id'" ;
$result= mysqli_query($conn, $sql);
$sql ="DELETE FROM user WHERE idu= '$id'" ;
$result= mysqli_query($conn, $sql);


if($result)
	{
		session_destroy();
		session_start() ; 
		$_SESSION['accept'] = "user \" ".$pseudo." \" deleted";
		header("Location: login.php") ; 
    } 
	else 
	{
		header("Location: welcome.php") ; 
	}

?>