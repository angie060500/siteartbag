<!DOCTYPE html>
<?php
require_once('security.php');

require_once("connection.php");
$_SESSION['commande']=0; 
$iduser=$_SESSION['id'];
$pseudo=$_SESSION['pseudo'] ;
if(isset($_SESSION['accept_idcom']))
$idc1=$_SESSION['accept_idcom'];
else 
$idc1="" ; 
unset($_SESSION['accept_idcom']);

if(isset($_SESSION['accept']))
$info = $_SESSION['accept'];
else
$info="";
unset($_SESSION['accept']);

?>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <title>Art Bags</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
   <link rel="icon" type="image/png" sizes="5x10" href="images/okk.png">
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
<!---- cart items details --->
<div class="small-container cart-page">
    <table>
        <tr>
            <th>Products</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
 <?php 
     if(isset($_SESSION['fact'] )) 
     $fact= $_SESSION['fact'] ; 
     else $fact =0 ; 
     $id=$_SESSION['id']; 
     $total=0 ; 
     $sql ="SELECT * FROM commande WHERE idcc='$id' && ord='$fact'" ;
     $result= mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){         
           while($row= mysqli_fetch_assoc($result))  {
            $article=$row['idart'];
            $sql1 ="SELECT * FROM article WHERE idarticle='$article' " ;
            $result1= mysqli_query($conn, $sql1);
            $row1= mysqli_fetch_assoc($result1);
            $_SESSION['commande']= $row['idcom']; 
            $_SESSION['idarticle']= $article; 
            $prix=$row1['prix']*$row['qte'];
            $total=$total+$prix;
           ?>
        <tr>
            <td>
                <div >
                <a href="productDetails.php?id=<?php echo $row1['idarticle'];?>"> <img src=<?php print $row1['img'] ?> ></a>
                    <div class="cart-info">
                        <p><?php echo $row1['nom'];?></p>
                    </div>
                    </br>
                        <form action="Removecommande_code.php" method="POST">
                        <input id="idcom" name="idcom" type="number" value=<?php echo $row['idcom'];?> style="display:none;">
                        <button type="submit" class="confirm">Remove</button>
                        </form>
               </div>
           </td>
        <td>
        <?php  if (!empty($info) && ($row['idcom']==$idc1) ) { ?>
             <form action="MAJcommande_code.php" method="POST">
             <input id="qte" name="qte" type="number" value=<?php echo $row['qte'];?>  >
             <input id="idcom" name="idcom" type="number" value=<?php echo $row['idcom'];?> style="display:none;">
	           <div class="confirm1">
	           <b> <?php echo $info ;?></b>
              </div>
         
             <button type="submit" class="confirm ">Confirm</button>
            </form>
        <?php } else {?>
            <form action="MAJcommande_code.php" method="POST">
             <input id="qte" name="qte" type="number" value=<?php echo $row['qte'];?>>
             <input id="idcom" name="idcom" type="number" value=<?php echo $row['idcom'];?> style="display:none;">
             </br>
             </br>
             </br>
              </div>
             <button type="submit" class="confirm">Confirm</button>
            </form>
            <?php } ?>

        </td>
             <td><?php echo $prix." DT";?></td>
        </tr>
        <?php }} ?>
</table>
   <div class="total-price">
        <table>
            <tr>
                <td>Total</td>
                <td><?php echo $total." DT"?></td>
            </tr>
        </table>
    </div>
    <div class="pay-btn">
         <a href="resetCart.php" class="btn"> Reset </i> </a>
        <a href="products.php" class="btn">keep shopping <i class="fa fa-shopping-basket"></i> </a>
        <a href="payment.php" class="btn">Purchase <i class="fa fa-credit-card"></i> </a>
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
</script>

</body>
</html>