<?php
require_once('connection.php') ; 
$ida=$noma=$description=$image=$qteqtock=$price=$rating=$sale=""; 
session_start() ; 
if(!empty($_SESSION['nomarticle'] ))
$nom=$_SESSION['nomarticle'];
else
$nom="";

if(!empty($nom)){  require_once('adelete_article.php'); }

$noma=$_POST['nom'] ;
$description=$_POST['descr'] ;
$image=$_POST['img'] ;
$qteqtock=$_POST['qtestock'] ;
$price=$_POST['prix'] ;
$rating=$_POST['rating'] ;
$sale=$_POST['sale'] ;


$sql ="INSERT INTO article (nom,descr,img,qtestock,prix,rating,sale) VALUES ('$noma','$description','$image','$qteqtock','$price','$rating','$sale') " ;
$result= mysqli_query($conn, $sql);
 
if($result){
    session_start() ; 
    $_SESSION['accept'] = " Add product Done ";
    if(!empty($nom)){$_SESSION['accept'] = " mofication product Done ";
                        header("Location: ashowproducts.php") ; }
    else{header("Location: addproduct.php") ; }
  }
else{ 
    session_start() ; 
    $_SESSION['info']=" Add product Not Done ";
    if(!empty($nom)){$_SESSION['info'] = " mofication product Not Done ";
      header("Location: ashowproducts.php") ; }
     else{header("Location: addproduct.php") ; }}
      
  ?>