<?php
require_once('connection.php') ; 
session_start(); 

$pass1=$_POST['password1']; 
$pass2=$_POST['password2']; 
$mail=$_SESSION['verif']; 
if ($pass1==$pass2){
    $pass2=MD5($pass2);
    $sql ="UPDATE  user SET pass='$pass2' where mail='$mail'";
    $result= mysqli_query($conn, $sql);
    if($result)
    { 
        $_SESSION['accept']="Password changed";
        header("Location: login.php") ; 
    }
    else { 
        $_SESSION['info']="ERROR";
        header("Location: error.php") ;
    }

}
else  { 
    $_SESSION['info']="password not identical";
    header("Location: newpass.php") ; 

}