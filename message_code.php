<?php
require_once('connection.php') ; 
require_once('security4.php');
$mail=$nom=$nom='' ; 
$rating= $_POST['rating'] ;
$mail= $_POST['email'] ;
$nom= $_POST['nom'] ;
$msg= $_POST['msg'] ;
$subject= $_POST['subject'] ;
$date=date("d-m-Y");
$sql ="INSERT INTO contact (mail,nom,txt,msg,dat,rating) VALUES ('$mail','$nom','$subject','$msg','$date','$rating') " ;
$result= mysqli_query($conn, $sql);

if($result){
  session_start() ; 
  $_SESSION['accept'] = " Message Envoyé ";
  header("Location: about.php") ; 
}
else{ 
  session_start() ; 
  $_SESSION['info']="use your email " ;
  header("Location: error.php") ; 
      }
?>