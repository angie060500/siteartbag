<?php 
session_start() ; 
if(isset($_SESSION['info']))
$info = $_SESSION['info'];
else
$info="";
unset($_SESSION['info']);
echo $info ; ?>