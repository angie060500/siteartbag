
<?php 
require_once('connection.php') ; 
ini_set('SMTP','smtp.topnet.tn');
ini_set("smtp_port","25");

$email= $_POST['email'] ;
if(isset($_GET['mail'])) 
{$mail=$_GET['mail']; }

if ($mail==1){
$sql ="SELECT * from user WHERE user.mail='$email' ";
$result= mysqli_query($conn, $sql);
$result= mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
         while($row= mysqli_fetch_assoc($result)) {
                   $code=$row['code'] ; 
                   $code1=$code-rand(1,9); 
                   $sql1 ="UPDATE  user set code='$code1' WHERE user.mail='$email' ";
                   $result1= mysqli_query($conn, $sql1);
                 }}
    
$ok=$code; 
$to = "angiedigiambattista1@gmail.com";
$subject = "code";
$txt = "code :".$ok."";
$headers = "From: artbox@artbox.com" . "\r\n" ;


if(mail($to,$subject,$txt,$headers)) {
 echo('<br>'."Email Sent ;D ".'</br>');
 } 
 else 
 {
 echo("<p>Email Message delivery failed...</p>");
 }

}
?>
