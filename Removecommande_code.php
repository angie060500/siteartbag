<?php
require_once('connection.php') ; 
$qte=$idc='' ; 
$qte= $_POST['qte'] ;
session_start(); 
$idc=$_POST['idcom'];
$sql ="DELETE FROM commande WHERE idcom= '$idc'" ;
$result= mysqli_query($conn, $sql);
if($result)
  header('location:cart.php');
else 
{
$_SESSION['info']="error"; 
header('location:error.php');
}


?>