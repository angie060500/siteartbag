<?php
require_once('connection.php') ; 
$mail=$pass=$pass='' ; 
$mail= $_POST['email'] ;
$pass= $_POST['password'] ;
$password=MD5($pass) ; 
$sql ="SELECT * from user where user.mail='$mail' and user.pass= '$password'";
$result= mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
  while($row= mysqli_fetch_assoc($result)) 
  {
      $id=$row["idu"]; 
      $pseudo = $row["pseudo"] ; 
      $email= $row["mail"]; 
      session_start() ; 
      $_SESSION['id']=$id ;
      $_SESSION['pseudo']=$pseudo;
      $_SESSION['email']=$email ; 
  }
  if ($pseudo=="admin")
   header("Location: addproduct.php") ; 
  else
   header("Location: welcome.php") ; 
}
else{ 
  session_start() ; 
  $_SESSION['info']="Invalid email or password" ;
  header("Location: login.php");
}
?>