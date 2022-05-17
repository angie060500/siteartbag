<?php
require_once('connection.php') ; 

if(isset($_GET['fact'])) 
{$fact=$_GET['fact']; }
session_start() ; 
$sql ="DELETE FROM commande WHERE ord=$fact " ;
$result= mysqli_query($conn, $sql);

$sql ="DELETE FROM fact WHERE idord=$fact " ;
$result= mysqli_query($conn, $sql);

$_SESSION['accept'] = " command deleted" ; 
header("Location: facture.php") ; 


?>