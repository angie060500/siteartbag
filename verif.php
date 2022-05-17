<?php
require_once('connection.php') ; 
session_start(); 

$codeverif=$_POST['code']; 
$cod=$_SESSION['code']; 
if($codeverif==$cod){
    header("Location: newpass.php") ; 
}
else {
    $_SESSION['info']="ERROR";
    header("Location: code.php");
}
?>