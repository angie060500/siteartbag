<?php
session_start();
require_once('connection.php') ; 
if(isset($_GET['id']))
$id =$_GET['id'];
else
$id="";
if(isset($_SESSION['nomarticle']))
$nom =$_SESSION['nomarticle'];
else
$nom="";

if(!empty($id))
{   
	$sql = "delete from article where idarticle= '$id'";
    $result= mysqli_query($conn, $sql);
 
if($result)
	{
		$_SESSION['accept'] = "article ' ".$id." ' supprimé avec succès";
		header('location:ashowproducts.php');
    } 
	else 
	{
		$_SESSION['info'] = " Order linked by this article  ";
		header('location:ashowproducts.php');
    }
}
else{
    $sql = "delete from article where nom= '$nom'";
    $result= mysqli_query($conn, $sql);
    if($result)
	{
		$_SESSION['accept'] = "article ' ".$id." ' modifié avec succès";
		header('location:ashowproducts.php');
    } 
	else 
	{
		$_SESSION['info'] = " Order linked by this article  ";
		header('location:ashowproducts.php');
    }
}


?>