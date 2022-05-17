<?php
require_once("connection.php");
session_start() ; 
$order=$_POST['order']; 
$_SESSION['order']=$order; 
header('location:products.php');

?>