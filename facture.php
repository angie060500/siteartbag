<?php
session_start() ; 
require_once('security3.php');


$iduser=$_SESSION['id'];
$pseudo=$_SESSION['pseudo'] ;
if(isset($_SESSION['accept']))
$accept = $_SESSION['accept'];
else
$accept="";
unset($_SESSION['accept']);
?>

<!DOCTYPE html>
<?php
require_once("connection.php");
?>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <title>Art Bags</title>
   <link rel="icon" type="image/png" sizes="" href="images/okk.png">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
   <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Khula:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>
<html>
<!--- nav ---->
<div class="container">
<div class="navbar">
  <div class="logo">
  <a href="index.php"><img src="images/okk.png" width=60px heigh=30px  ></a>
  <div class="welcome">
	     <p> Welcome <?php echo  $pseudo ;?></p>
	   </div> <php echo $g ; ?>
  </div>
  <nav>
  <ul id="MenuItems">
        <li><a href="index.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="login.php">Account</a></li>
        <?php if (!empty($iduser) ){ ?>
        <div class="dropdown">
        <li><a href="#">Settings</a></li>
            <div class="dropdown-content">
                <a href="logout.php"><p>logout</p></a>
                <a href="delete_client.php"><p>Delete account</p></a>
            </div>
        </div>
        <?php } ?>
     </ul>
  </nav>
  <a href="cart.php"><img src="images/cad.png" width=30px height=30px></a>
  <?php 
  if ( isset($_SESSION['fact']))
  $fact=$_SESSION['fact']; 
  else $fact=0 ; 
  if (!empty($iduser)){
      $sql ="SELECT * FROM commande WHERE idcc='$iduser' && idord='$fact'" ;
      $result= mysqli_query($conn, $sql);
      $nombre=0 ; 
      if ($result)
          { $nombre=mysqli_num_rows($result) ;
            echo "(".$nombre.")" ;    }
      else { echo "(0)" ; }        }  
          ?>
  <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
</div>
</div>
<!----- facture  Page ---->
<div class ="facture-page">
    <div class="container1">

        <div class="cardf1">
        <h2 class="cardf-title">Order details</h2>
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id order</th>
                        <th>fullname</th>
                        <th>phone</th>
                        <th>address</th>
                        <th>city</th>
                        <th>date</th>
                        <th>qte</th>
                        <th>sum</th>
                        <th>status</th>
                    </tr>
                    <?php 
                  $sql ="SELECT * FROM fact WHERE idc='$iduser' " ;
                  $result= mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result)>0){
                      while($row= mysqli_fetch_assoc($result))  {
                          if ($row['qte']!=0) {?>
                        <tr>
                           <td><?php echo  $row['idord'];?></td>
                           <td><?php echo $row['fulln'];?></td>
                           <td><?php echo $row['phone'];?></td>
                           <td><?php echo $row['addres'];?></td>
                           <td><?php echo $row['city'];?></td>
                           <td><?php echo $row['dat'];?></td>
                           <td><?php echo $row['qte'];?>
                           </br>
                                       <a href="factshow.php?fact=<?php echo  $row['idord'];?> "class="prod"> See articles </a></td>
                           <td><?php echo $row['somme']." DT";?></td>
                           <?php if ( $row['statut']=='not delivered'){ ?>
                                        <td><?php echo $row['statut'];?> </br>
                                       <a href="deletefact.php?fact=<?php echo  $row['idord'];?> " class="prod"> Delete</a></td>
                           <?php } else { ?>
                                        <td><?php echo $row['statut'];?>
                                        </br>
                                        <a href="deletefact.php?fact=<?php echo  $row['idord'];?> " class="prod"> Dont affiche </a></td>
                          <?php } ?>
                       </tr>
                       <?php }}} ?>
                </thead>
                </table>
        </div>
    </div>
</div>

<!----------- footer -------------->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col-1">
                <h3> Download Our App </h3>
                <p>Download App for Android and ios mobile phone.</p>
                <div class="app-logo">
                    <img src="images/Download/appstore.png" height=50px>
                    <img src="images/Download/googleplay.png" height=50px>
                </div>
            </div>
            <div class="footer-col-2">
             <a href="index.php"><img src="images/okk.png" width=60px heigh=30px></a>
                <p>Our purpose Is To Sustainably Make the Pleasure and Benefits of Bags to the Many.</p>
            </div>
            <div class="footer-col-3">
                <h3>Useful Links</h3>
                <ul>
                    <li>Coupons</li>
                    <li>Blog Post</li>
                    <li>Return Policy</li>
                    <li>Join Affiliate</li>
                </ul>
            </div>
            <div class="footer-col-4">
                <h3>Follow Us</h3>
                <ul>
                    <li>Facebook</li>
                    <li>Twitter</li>
                    <li>Instagram</li>
                    <li>Youtube</li>
                </ul>
                <div id="icons">
                    <a href="http://www.twitter.fr"><i class="fa fa-twitter"></i></a>
                    <a href="http://www.facebook.fr"><i class="fa fa-facebook"></i></a>
                    <a href="http://www.instagram.fr"><i class="fa fa-instagram"></i></a>
                    <a href="http://www.youtube.fr"><i class="fa fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <hr>
        <p class="copyright">Copyright 2022 - Artbag</p>
     </div>
</div>
<!---- just for toggle menu ---->
<script>
    var MenuItems =  document.getElementById("MenuItems") ; 
    MenuItems.style.maxHeight="0px"; 
    function menutoggle(){
        if (MenuItems.style.maxHeight=="0px")
         { MenuItems.style.maxHeight="200px"; }
         else   { MenuItems.style.maxHeight="0px"; }
    }
</script>
<!-------- js for toglle Form ----------->
   <script>
        var LoginForm =document.getElementById("LoginForm") ;
        var RegForm =document.getElementById("RegForm") ;
        var Indicator=document.getElementById("Indicator") ; 
    
        function register(){
           RegForm.style.transform= "translateX(0px)" ; 
           LoginForm.style.transform= "translateX(0px)" ; 
           Indicator.style.transform= "translateX(120px)" ; 
         }

         function login(){
            RegForm.style.transform= "translateX(350px)" ; 
            LoginForm.style.transform= "translateX(350px)" ; 
            Indicator.style.transform= "translateX(-10px)" ; 
          }
    </script>
</body>
</html>