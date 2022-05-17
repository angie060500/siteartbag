
<?php 
require_once('connection.php') ; 
ini_set('SMTP','smtp.topnet.tn');
ini_set("smtp_port","25");
if(isset($_POST['email']))
$email= $_POST['email'] ;
else $email="" ; 
session_start() ; 
$_SESSION['verif']=$email; 
if(isset($_GET['mail'])) 
{$mail=$_GET['mail']; 
}

if ($mail==1){
$sql ="SELECT * from user WHERE user.mail='$email' ";
$result= mysqli_query($conn, $sql);
$result= mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
         while($row= mysqli_fetch_assoc($result)) {
                   $code=$row['code'] ; 
                   $_SESSION['code']=$code; 
                   $code1=$code-rand(-90,90); 
                   $sql1 ="UPDATE  user set code='$code1' WHERE user.mail='$email' ";
                   $result1= mysqli_query($conn, $sql1);
                 }
   
$ok=$code; 
$subject = "code";
$txt = "code :".$ok."";
$headers = "From: artbag@artbag.com" . "\r\n" ;


if(mail($email,$subject,$txt,$headers)) {
    header("Location: code.php") ; 
 } 
 else 
 {
 echo("<p>Email Message delivery failed...</p>");
 }
    }

}
if ($mail==2){
  $subject = "reply_artbag" ; 
  $txt = $_POST['msg'];
  $headers = "From: artbag@artbag.com" . "\r\n" ;
  $idms= $_POST['statut'] ; 
  $sql ="UPDATE contact set statut='DONE' WHERE idm=$idms " ;
  $result= mysqli_query($conn, $sql);
  if(mail($email,$subject,$txt,$headers)) {
    $_SESSION['accept']="EMAIL SEND " ;    
    header("Location: messages.php") ;   
   } 
   else 
   {
    $_SESSION['info']="EMAIL NOT SEND " ;
    header("Location: messages.php") ; 
   }
      }

if ($mail==3){
  $id3=$_SESSION['id3'];
  $sql ="SELECT * from user WHERE idu=$id3 " ;
  $result= mysqli_query($conn, $sql);
  $row= mysqli_fetch_assoc($result) ;  
  $pseudo = $row['pseudo'] ; 
  $email= $row['mail'] ; 
  if (isset($_SESSION['f'] ))
  $f = $_SESSION['f'] ; 
  else $f=0 ; 
  $sql ="SELECT * from fact WHERE idord=$f " ;
  $result= mysqli_query($conn, $sql);
  $row= mysqli_fetch_assoc($result) ;  
  $you = $row['fulln'] ; 
  $subject = 'facture' ; 
  $txt = "Congratulations $pseudo , your order -$f- by the name \"$you\" has been shipped." ; 
  $headers = "From: artbag@artbag.com" . "\r\n" ;
  

  if(mail($email,$subject,$txt,$headers)) {
    $_SESSION['accept']=" command -$f- passed " ;    
    header("Location: aorders.php") ;   
   } 
   else 
   {
    $_SESSION['info']= " command -$f- not passed ";
    header("Location: aorders.php") ; 
   }
      }


if ($mail==4){
  if(isset($_GET['id'])) 
  {$id=$_GET['id']; }
  else $id =0 ; 
  $_SESSION['adclient']=$id ; 
  $sql ="SELECT * from user where idu='$id'";
   $result= mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
      while($row= mysqli_fetch_assoc($result)) 
      {
      $email = $row['mail'] ; }
    }
        $subject = "IMPORTANT!" ; 
        $txt = "Sorry , your account is deleted by artbag administration.";
        $headers = "From: artbag@artbag.com" . "\r\n" ;
        if(mail($email,$subject,$txt,$headers)) { 
          header("Location: adclient.php?id=<?php echo $id; ?> ") ;   
         } 
         else 
         {
          $_SESSION['info']="EMAIL NOT SEND " ;
         }
        }
      
?>
