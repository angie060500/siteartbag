<?php
require_once('connection.php') ; 
session_start(); 
$idc=$_SESSION['commande'];
$qte=$_POST['qte'];
$idc=$_POST['idcom'];
$sql ="UPDATE  commande SET qte='$qte' where idcom='$idc'";
$result= mysqli_query($conn, $sql);
if($result)
{ 
  $_SESSION['accept_idcom']=$idc;
  $_SESSION['accept']="MODIFICATION CONFIRMED"; 
  header('location:cart.php');
  }
else 
{
$_SESSION['info']="error"; 
header('location:error.php');
}


?>