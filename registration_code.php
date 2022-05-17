<?php
require_once('connection.php') ; 
$fname=$pass=$email='' ; 
$fname= $_POST['name'] ;
$pass= $_POST['password'] ;
$password=MD5($pass) ; 
$email= $_POST['email'] ;
if (empty($fname) || empty($password) || empty($email)) {
  $result= FALSE ; 
}
else{
$sql ="SELECT * from user ";
$result= mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
  while($row= mysqli_fetch_assoc($result)) 
   $code=$row['code'] ; }
else $code=3828 ; 
$code=$code+rand(-20,11) ; 
$sql ="INSERT INTO user (pseudo,pass,mail,code) VALUES ('$fname','$password','$email','$code') " ;
$result= mysqli_query($conn, $sql);}

if($result){
  session_start() ; 
  $_SESSION['accept'] = " Registration Done ";
  header("Location: login.php") ; 
}
else{ 
  session_start() ; 
  $_SESSION['info']="Error" ;
  header("Location: error.php") ; 
      }

?>