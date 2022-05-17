<?php
require_once('connection.php') ; 
$limit=0 ; 
session_start() ; 
if(isset($_GET['nb'])) 
{$limit=$_GET['nb']; }
else {$limit=0 ; }
$_SESSION['limit']=$limit ;  
$_SESSION['info']=$limit;
header("Location: products.php") ;
?>