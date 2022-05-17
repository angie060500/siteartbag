<!DOCTYPE html>
<?php
session_start() ; 
$pseudo=""; 
if(isset($_SESSION['id'])) {
    require_once('security1.php');
    $iduser= $_SESSION['id'] ;
    $pseudo=$_SESSION['pseudo'] ;
}
require_once("connection.php");
if(isset($_SESSION['accept']))
$accept = $_SESSION['accept'];
else
$accept="";
unset($_SESSION['accept']);


if(isset($_SESSION['order']))
$order = $_SESSION['order'];
else
$order="idarticle";
unset($_SESSION['order']);

if(isset($_SESSION['limit']))
{$limit = $_SESSION['limit'];}
else
$limit=0;

unset($_SESSION['limit']);
if(isset($_SESSION['id'])) {
$iduser=$_SESSION['id'];}
else 
$iduser=''; 

if(isset($_SESSION['upload']))
 {$upload=$_SESSION['upload'];}
else {$upload="" ; }

unset($_SESSION['upload']); 
if ( isset($_SESSION['fact']))
$fact=$_SESSION['fact']; 
else $fact=0 ; 
?>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <title>Art Bags</title>
   <link rel="icon" type="image/png" sizes="5x10" href="images/okk.png">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
</head>
<body>

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
</div>
<!------------ products ----------------->

<div class="small-container">
<?php if (!empty($accept)) { ?>
	          <div class="alert-accept1">
	           <b> <?php echo $accept ;?></b>
              </div>
	       <?php } ?>

    <div class="row row2"> 
        <h2>All Products</h2>
        <form action="orderproducts_code.php" method="POST" >
        <select name="order" onchange="this.form.submit();">
            <option value="idarticle">Sort By </option>
            <option value="prix">Price</option>
            <option value="rating">Rating</option>
            <option value="sale">Sale</option>      
       </select>
       </form>
    </div>

    <?php 
       $s=0;
       $sql ="SELECT * FROM article ORDER BY $order ASC" ;
       $limit=$limit+1 ;  
       $count=0;  
       $result= mysqli_query($conn, $sql);
       $nb=mysqli_num_rows($result); 
       if(mysqli_num_rows($result)>0){
                  while(($row= mysqli_fetch_assoc($result)) && ($count<($limit*12)))  { 
                     $a=  $row['idarticle']; 
                    if($count>(($limit-1)*11)|| ($count==0 && $limit==1)){
                    if ($s % 4==0) {
                        ?> 
                    <div class="row">
                    <?php if(empty($upload)){?>
                        <div class="col-4">
                    <?php } else {?>
                    <div  id="<?php echo $row['idarticle'];?>" class="col-4">
                   <?php } ?>
                    <a href="productDetails.php?id=<?php echo $row['idarticle'];?>"><img src=<?php print $row['img'] ?>></a>
                     <h4> <?php print $row['nom'] ?>  </h4>
                            <div  class="rating"> 
                            <?php $mm=0;
                               for($i=0;$i<$row['rating'];$i++){ 
                                   $mm=$mm+1;?>
                                         <a href="stars.php?fa=<?php echo $i ?>&fart=<?php echo $row['idarticle'];?>&nb=<?php echo $limit; ?>"  >  <i class="fa fa-star"></i></a>
                                <?php }for($i=0;$i<(5-$row['rating']);$i++){
                                    ?>
                                    <a href="stars.php?fa=<?php echo $mm+$i ?>&fart=<?php echo $row['idarticle'];?>&nb=<?php echo $limit; ?>"  >  <i class="fa fa-star-o"></i></a>
                                 <?php } ?>
                             </div>
                       <p><?php print $row['prix'] ?> DT </p>
                       <?php 
                        $a=$row['idarticle'];
                        $sql2 ="SELECT * FROM commande WHERE (idart='$a' && idcc='$iduser' && ord='$fact')" ;
                        $result2= mysqli_query($conn, $sql2);
                        $nb2=mysqli_num_rows($result2); 
                        if(mysqli_num_rows($result2)==0){?>
                          <div class="shop1">
                             <a href="addcommande.php?id=<?php echo $row['idarticle'];?>&nb=<?php echo $limit; ?>"><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>
                        <?php } else { ?>
                            <div class="shop2">
                             <a href="addcommande.php?id=<?php echo $row['idarticle'];?>&nb=<?php echo $limit; ?>"><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>  
                           <?php } ?>
                     </div>
                     
                     <?php }
                     if ($s % 4==1 || $s % 4==2  ) {
                         ?>
                                          <?php if(empty($upload)){?>
                        <div class="col-4">
                    <?php } else {?>
                    <div  id="<?php echo $row['idarticle'];?>" class="col-4">
                   <?php } ?>
                        <a href="productDetails.php?id=<?php echo $row['idarticle'];?>"><img src=<?php print $row['img'] ?>></a>
                        <h4> <?php print $row['nom'] ?>  </h4>
                               <div  class="rating"> 
                               <?php $mm=0;
                               for($i=0;$i<$row['rating'];$i++){ 
                                   $mm=$mm+1;?>
                                         <a href="stars.php?fa=<?php echo $i ?>&fart=<?php echo $row['idarticle'];?>&nb=<?php echo $limit; ?>"  >  <i class="fa fa-star"></i></a>
                                <?php }for($i=0;$i<(5-$row['rating']);$i++){
                                    ?>
                                    <a href="stars.php?fa=<?php echo $mm+$i ?>&fart=<?php echo $row['idarticle'];?>&nb=<?php echo $limit; ?>"  >  <i class="fa fa-star-o"></i></a>
                                 <?php } ?>
            
                                </div>
                          <p><?php print $row['prix'] ?> DT </p>
                          <?php 
                        $a=$row['idarticle'];
                        $sql2 ="SELECT * FROM commande WHERE (idart='$a' && idcc='$iduser' && ord='$fact ')" ;
                        $result2= mysqli_query($conn, $sql2);
                        $nb2=mysqli_num_rows($result2); 
                        if(mysqli_num_rows($result2)==0){?>
                          <div class="shop1">
                             <a href="addcommande.php?id=<?php echo $row['idarticle'];?>&nb=<?php echo $limit; ?>"><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>
                        <?php } else { ?>
                            <div class="shop2">
                             <a href="addcommande.php?id=<?php echo $row['idarticle'];?>&nb=<?php echo $limit; ?>"><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>  
                           <?php } ?>
                        </div>
                    <?php  }
                     ?>
                                    <?php 
                     if ($s % 4==3  ) {
                         ?>
                          <?php if(empty($upload)){?>
                        <div class="col-4">
                    <?php } else {?>
                    <div  id="<?php echo $row['idarticle'];?>" class="col-4">
                   <?php } ?>
                        <a href="productDetails.php?id=<?php echo $row['idarticle'];?>"><img src=<?php print $row['img'] ?>></a>
                        <h4> <?php print $row['nom'] ?>  </h4>
                        
                               <div  class="rating"> 
                               <?php $mm=0;
                               for($i=0;$i<$row['rating'];$i++){ 
                                   $mm=$mm+1;?>
                                         <a href="stars.php?fa=<?php echo $i ?>&fart=<?php echo $row['idarticle'];?>&nb=<?php echo $limit; ?>"  >  <i class="fa fa-star"></i></a>
                                <?php }for($i=0;$i<(5-$row['rating']);$i++){
                                    ?>
                                    <a href="stars.php?fa=<?php echo $mm+$i ?>&fart=<?php echo $row['idarticle'];?>&nb=<?php echo $limit; ?>"  >  <i class="fa fa-star-o"></i></a>
                                 <?php } ?>
                            
                                </div>
                          <p><?php print $row['prix'] ?> DT </p>
                          <?php 
                        $a=$row['idarticle'];
                     
                        $sql2 ="SELECT * FROM commande WHERE (idart='$a' && idcc='$iduser' && ord='$fact')" ;
                        $result2= mysqli_query($conn, $sql2);
                        $nb2=mysqli_num_rows($result2); 
                        if(mysqli_num_rows($result2)==0){?>
                          <div class="shop1">
                             <a href="addcommande.php?id=<?php echo $row['idarticle']?>&nb=<?php echo $limit;?>"><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>
                        <?php } else { ?>
                            <div class="shop2">
                             <a href="addcommande.php?id=<?php echo $row['idarticle'];?>&nb=<?php echo $limit; ?>"><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>  
                           <?php }
                            ?>
                        </div>
                        </div>
                    <?php  } ?>
                     
                    <?php $s+=1 ; }
                           $count++ ;  }} ?>
        </div>
    </div>
    <div class="page-btn"> 
        <?php 
           if( $nb>12){
                for($i=0; $nb>0 ; $i++ ) {
                      $nb= $nb-12 ; ?>
                   <a href="initialiser.php?nb=<?php echo $i; ?> "> <span <?php if($limit-1==$i) echo 'style="background:#BF3880 ; color : white"' ?>><?php echo $i ?></span> </a>
                      <?php } 
                      $limit=$limit ;  
                      if ($limit==$i) $limit=0 ; ?>
                    <a href="initialiser.php?nb=<?php echo $limit; ?> "> <span> &#8594; </span></a>
                    <?php } ?>
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
                <a href="welcome.php"><img src="images/okk.png" width=60px heigh=30px></a>
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
