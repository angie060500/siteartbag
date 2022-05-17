<?php
session_start() ; 
if(isset($_SESSION['info']))
$info = $_SESSION['info'];
else
$info="";
unset($_SESSION['info']);

if(isset($_SESSION['accept']))
$accept = $_SESSION['accept'];
else
$accept="";
unset($_SESSION['accept']);

if(isset($_SESSION['id'])){
    header('location:welcome.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <title>Art Bags</title>
   <link rel="icon" type="image/png" sizes="5x10" href="images/okk.png">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
</head>
<html>
<!--- nav ---->
<div class="container">
<div class="navbar">
  <div class="logo">
  <a href="welcome.php"><img src="images/okk.png" width=60px heigh=30px ></a>
  </div>
  <nav>
  <ul id="MenuItems">
        <li><a href="welcome.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="login.php">Account</a></li>
     </ul>
  </nav>
  <a href="cart.php"><img src="images/cad.png" width=30px height=30px></a>
  <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
</div>
</div>
<!----- Account  Page ---->
<div class="account-page">
  <div class="container">
    <div class="row">
      <div class="col-2">
      <img src="images/background/bb2.png" width=75%>
      </div>
      <div class="col-2">
         <div class="form-container">
             <?php if (!empty($info)) { ?>
	         <div class="alert-info">
	          <b> <?php echo $info ;?></b>
             </div>
	     <?php } ?>
         <?php if (!empty($accept)) { ?>
	         <div class="alert-accept">
	          <b> <?php echo $accept ;?></b>
             </div>
	     <?php } ?>
            </br>
            <span> Code </span>
            <form id="" action="verif.php" method="POST">
                <p> If you do not receive this email, please check your spam </p>
                </br>
                </br>
                <input type="text" id="code" name="code" placeholder="confirmation code" required>
                <button type="submit" class="btn">Enter</button>
                <a href="mdp.php">Send The Code Again </a>
            </form>
         </div>
      </div>
      </div>
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
             <a href="welcome.php"><img src="images/okk.png" width=120px></a>
                <p>Our purpose Is To Sustainably Make the Pleasure and Benefits of Sacs to the Many.</p>
            </div>
            <div class="footer-col-3">
                <h3>Usefl Links</h3>
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
        <p class="copyright">Copyright 2022 - Art Bags</p>
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

</body>
</html>