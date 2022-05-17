<?php
require_once('connection.php') ;
session_start(); 

$id=$_SESSION['id']; 
$sql ="DELETE FROM commande WHERE idcc= '$id'" ;
$result= mysqli_query($conn, $sql);
if($result)
  header('location:cart.php');
else 
{
$_SESSION['info']="error"; 
header('location:error.php');
}


?>