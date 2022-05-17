<?php
require_once('connection.php') ;
session_start() ; 
if(isset($_SESSION['id'])){
if(isset($_GET['fa'])) 
{$fa=$_GET['fa']; }
$fa=$fa+1;
if(isset($_GET['fart'])) {
    $ida=$_GET['fart'] ; 
}
if(isset($_GET['id']))
$id =$_GET['id'];
$sql ="UPDATE  article SET rating='$fa' where idarticle='$ida'";
$result= mysqli_query($conn, $sql);
if($result)
{ 
    $_SESSION['detailsid']=$id; 
    $_SESSION['upload']="yes";   
    header("Location: productDetails.php#$ida");
}
else {
    $_SESSION['info']="erro".$sql; 
    header("Location: error.php");   
}}
else {
    $_SESSION['info']="YOU HAVE TO LOGIN FIRST";
    header("Location: login.php");   
}

?>
