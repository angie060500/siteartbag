<?php
require_once('connection.php') ; 
if(isset($_GET['fact'])) 
{$fact=$_GET['fact']; }

$sql ="UPDATE fact SET statut='Done' WHERE idord=$fact " ;
$result= mysqli_query($conn, $sql);

$sql ="SELECT * from fact WHERE idord=$fact " ;
$result= mysqli_query($conn, $sql);
$row= mysqli_fetch_assoc($result) ; 
session_start()  ; 
$_SESSION['id3']= $row['idc'] ; 
$_SESSION['f']=$fact ; 

header("Location: mail.php?mail=3") ;
?>