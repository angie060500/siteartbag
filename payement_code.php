<?php
require_once('connection.php') ; 
session_start() ; 
$fulln= $_POST['fulln'] ;
$phone= $_POST['phone'] ;
$addres= $_POST['addres'] ;
$city= $_POST['city'] ;
$cardn= $_POST['cardn'] ;
$expd= $_POST['expd'] ;
$cvcode= $_POST['cvcode'] ;
$fact = $_SESSION['fact']; 
unset($_SESSION['fact']) ; 

$iduser=$_SESSION['id'];
$sql ="SELECT * FROM commande WHERE idcc='$iduser' && ord='$fact'" ;
$result= mysqli_query($conn, $sql);
$nombre=0 ; 
$tot=0 ; 
$result= mysqli_query($conn, $sql);
if($result)
   if(mysqli_num_rows($result)>0){
        while($row= mysqli_fetch_assoc($result)) 
                  { $nombre = $nombre + $row['qte'] ; 
                    $tot = $tot + ($row['total']*$row['qte'] ); 
                  }}
$sql ="UPDATE fact SET fulln='$fulln',phone='$phone',addres='$addres',city='$city',cardn='$cardn',dat='$expd',cvcode='$cvcode',qte='$nombre',somme='$tot' WHERE idord=$fact " ;
$result= mysqli_query($conn, $sql);
if($result){
    $_SESSION['accept']="command passed" ;
    header("Location: facture.php");
}
else {
    $_SESSION['info']=$sql;
    header("Location: error.php");
}

?>