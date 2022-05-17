<?php
session_start() ; 
$iduser="" ; 
$pseudo="" ; 
if(isset($_SESSION['id'])) {
    require_once('security1.php'); 
    $iduser=$_SESSION['id'];
    $pseudo=$_SESSION['pseudo'] ;
}

require_once("connection.php");
if(isset($_SESSION['info']))
$info = $_SESSION['info'];
else
$info="";
unset($_SESSION['info']);
?>

<!DOCTYPE html>
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
  <?php if (!empty($iduser) ){ ?>
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
<!----- About  Page ---->
<div class="about-page">
  <div class="container">
    <div class="row">
        <div class="col-2">
            <h1> About Us</h1>
            <p><h3>Are you looking for a bag that has it all ? practical ,light and cute ,all at once ?<br>You came to the right place .  
                our store offers unique , handmade 'tote bags ' that will satisfy all your needs . The bag itself is made out of high quality material and emballished with a trendy design .
                <br> <h2>In our store you will definetly find the style that speaks to your soul . </h2> </h3></p> 
            <a href="#form-row" class="btn">Contact Us &#8594; </a>

        </div>
        <div class="col-2">
            <img src="images/background/acceuil1.png " width=70% class="ok"> 
        </div>
        </div>

        
    </div>

     

</div>
<div class="small-container">
    <h2 class="title" style="padding: 15px">who we are</h2>
    <div class="row">
        <div class="col-4">
            <img src="images/products/who1.jpg">
            <p><h3> our products are 100% handmade with love </h3></p>
        </div>
        <div class="col-4">
            <img src="images/products/who5.jpg">
            <p><h3> organic fabrics and cruelty free: eco-friendly process</h3></p>
        </div>
        <div class="col-4">
            <img src="images/products/who4.jpg">
            <p><h3> designed with high quality materials and unique touch </h3></p>
        </div>
    </div>
    
    



</div>
<div class="ccontainer">
    <div class="row">
    <div class="col-2">
            <h2> Need Help ? Send us a message</h2>
             <form action="message_code.php" method="POST">
                 <div class="form-row select">
                     <div class="input-data">
                         <select name="subject" id="subject" required>
                         <option value="">--Please choose an option--</option>
                             <option value="comment">comment</option>
                             <option value="message">message</option>
                         </select>
                     </div>
                     <div class="input-data">
                         <select name="rating" id="rating" required>
                         <option value="">--Give as rating --</option>
                             <option value="5">5</option>
                             <option value="4">4</option>
                             <option value="3">3</option>
                             <option value="2">2</option>
                             <option value="1">1</option>
                         </select>
                     </div>
                 </div>
                 <div class="form-row" id="form-row">
                     <div class="input-data">
                         <input type="email" id="email" name="email" placeholder="your e-mail"  required>
                     </div>
                     <div class="input-data">
                         <input type="text" id="nom" name="nom" placeholder="nom" >
                     </div>
                 </div>
                 <div class="form-row textarea">
                     <div class="input-data">
                         <textarea name="msg" id="msg" cols="30" rows="10" placeholder=" your message"></textarea>
                     </div>
                 </div>
                 <button class="btn1">Send &#8594; </button>
             </form>


        </div>
        <div class="contact">
        <div class="col-2">
            <h2>Contact Info</h2>
            <div class="contact-info">
                <div class="icons">
                    <i class=" card-items far fa-envelope"></i>
                    <a href="https://mail.google.com/mail/u/0/#inbox?compose=CllgCKCBjtvwMBDlMHFmHkHvfzlLJHtdcjggcgtccGpqsDwwBwCQlxJRqNGVdZTpZhdmcKFBTsq"><p>artbag@artbag.com</p></a>
                </div>
                <div class="icons">
                    <i class=" card-items fas fa-phone"></i>
                    <p>73251231</p>
                </div>
                <div class="icons">
                    <i class=" card-items fas fa-map-pin"></i>
                    <a href="https://www.google.com/maps/@36.8624873,10.1876552,19z"><p>artbag Office</p></a>
                </div>
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