<?php
session_start() ; 
require_once('security3.php');
$pseudo=$_SESSION['pseudo'] ; 
$iduser= $_SESSION['id'] ;

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
  <?php if (!empty($iduser)){ ?>
  <div class="welcome">
	     <p> Welcome <?php echo  $pseudo ;?></p>
	   </div>
    <?php } ?>
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
      $sql ="SELECT * FROM commande WHERE idcc='$iduser' && ord='$fact'" ;
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
<!----- payment Page ---->
<div class="payment-page">
  <div class="containerp">
    <div class="text">
      <p> Details </p>
    </div>
    <form action="payement_code.php" method="POST">
        <div class="form-row">
            <div class="input-data">
               <input type="text" id="fulln" name="fulln" required>
               <div class="underline"></div>
               <label for="">Full name</label>
            </div>
            <div class="input-data">
               <input type="text" id="phone" name="phone" value="" required pattern="[0-9]{8}" > 
               <div class="underline"></div>
               <label for="">Phone number</label>
            </div>
         </div>
         <div class="form-row">
            <div class="input-data">
               <input type="text" id="addres" name="addres" required>
               <div class="underline"></div>
               <label for="">Address</label>
            </div>
            <div class="input-data">
               <input type="text" id="city" name="city" value="" required > 
               <div class="underline"></div>
               <label for="">City</label>
            </div>
         </div>
         <div class="form-row">
            <div class="input-data">
               <input type="password" id="cardn" name="cardn" value ="" pattern="[0-9]{16}" required >
               <div class="underline"></div>
               <label for="">Card Number</label>
            </div>
            <div class="input-data1">
               <input type="date" id="expd" name="expd" value="" required> 
               <div class="underline"></div>
               <label for="">Expiration Date</label>
            </div>
         </div>
         <div class="form-row">
            <div class="input-data">
               <input type="text" id="cvcode" name="cvcode" required pattern="[0-9]{4}">
               <div class="underline"></div>
               <label for="">CV Code (4 numbers)</label>
            </div>
            <div class="input-data">
               <input type="text" id="coupcode" name="coupcode" pattern="[0-9]{5}">
               <div class="underline"></div>
               <label for="">Coupon Code (5 numbers)</label>
            </div>
         </div>
         <div class="pay-btn">
        <button class="btn1">Purchase <i class="fa fa-credit-card"></i> </button>
    </div>
    </form>

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