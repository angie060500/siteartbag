<?php
require_once('connection.php') ; 
session_start();
if(isset($_GET['idm'])) 
{$idm=$_GET['idm']; }
else {$idm=0 ; }

$sql ="DELETE FROM contact WHERE idm= '$idm'" ;
$result= mysqli_query($conn, $sql);

if($result)
	{
		$_SESSION['accept'] = "message deleted";
		header("Location: messages.php") ; 
    } 
	else 
	{
        $_SESSION['info'] = "message NOT deleted";
		header("Location: messages.php") ; 
    }

?>