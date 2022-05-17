<?php
require_once('connection.php') ; 
$idc='' ; 
session_start(); 
if (isset($_GET['nb'])){
   $_SESSION['limit'] = $_GET['nb']-1 ; }
$idcc=$_SESSION['id'];
if(!isset($_SESSION['fact']))
{$sql ="INSERT INTO fact (fulln,idc,phone,addres,city,cardn,dat,cvcode,qte,somme,statut) VALUES ('0','$idcc',0,'0','0',0,'0',0,0,0,'not delivered') " ;
   $result= mysqli_query($conn, $sql);
   $sql ="SELECT * FROM fact " ;
$result= mysqli_query($conn, $sql);
$fact=0 ; 
if($result)
   if(mysqli_num_rows($result)>0){
        while($row= mysqli_fetch_assoc($result)) 
                $fact=$row['idord'] ; 
   }
$_SESSION['fact']=$fact ;

 }
else 
{ $fact=$_SESSION['fact'] ;
}
if (isset($_GET['id'])){
 $ida=$_GET['id']; 
 $sql1 ="SELECT * FROM commande WHERE idart='$ida' && ord='$fact'" ;
  $result1= mysqli_query($conn, $sql1);
 if (mysqli_num_rows($result1)>0){
       $sql0 ="DELETE FROM commande WHERE idart='$ida' && ord='$fact'" ;
       $result0= mysqli_query($conn, $sql0);
       $_SESSION['upload']="yes";   
       header("Location: products.php#$ida");
    }
 else {

       $row1= mysqli_fetch_assoc($result1); 
          $sql1 ="SELECT * FROM article WHERE idarticle='$ida' " ;
         $result1= mysqli_query($conn, $sql1);
         $row1= mysqli_fetch_assoc($result1);
        $prix=$row1['prix'] ; 
         $qte=1 ; 
        $sql ="INSERT INTO commande (idart,ord,idcc,qte,total) VALUES ('$ida','$fact','$idcc','$qte','$prix') " ;
       $result= mysqli_query($conn, $sql);
     if($result)
          {  
         $_SESSION['accept']="Product added to cart successfully "; 
         $_SESSION['upload']="yes";   
         header("Location: products.php#$ida");
          }
         else 
          {
            $_SESSION['info']="YOU HAVE TO LOGIN " ; 
            header('location: login.php');
}
}}
else {
$idcc=$_SESSION['id'];
$ida=$_SESSION['idarticle'];
$qte=$_POST['qte'];
$sql1 ="SELECT * FROM article WHERE idarticle='$ida' && ord='$fact' " ;
$result1= mysqli_query($conn, $sql1);
$row1= mysqli_fetch_assoc($result1);
$prix=$row1['prix'] ; 

$sql ="INSERT INTO commande (idart,ord,idcc,qte,total) VALUES ('$ida','$fact','$idcc','$qte','$prix') " ;
$result= mysqli_query($conn, $sql);
if($result)
{  
$_SESSION['accept']="Product added to cart successfully "; 
header('location:products.php');
}
else 
{
   $_SESSION['info']="YOU HAVE TO LOGIN " ; 
   header('location: login.php');

}}
?>