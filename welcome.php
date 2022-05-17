<!DOCTYPE html>
<?php
session_start() ; 
$pseudo=""; 
if(isset($_SESSION['id'])) {
    require_once('security1.php');
    $pseudo=$_SESSION['pseudo'] ;
    $iduser=$_SESSION['id'];
}
else {
    $iduser="";
}
require_once("connection.php");

?>


<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <title>Art Bags</title>
   <link rel="icon" type="image/png" sizes="5x10" href="images/okk.png">
   <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
</head>
<body>
<div class="header">
<div class="container">
<div class="navbar">
  <div class="logo">
  <?php if ($pseudo=="admin"){ ?>   
  <a href="addproduct.php"><img src="images/okk.png" width=60px heigh=30px  ></a>
  <?php } else { ?>
  <a href="index.php"><img src="images/okk.png" width=60px heigh=30px  ></a>
  <?php } ?>
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
<div class="row">
  <div class="col-2">
  <h1> Life is better <br>with designer bags! </h1>
  <p> Succes isn't always about greatness.It's about consistency. Consistent <br>hard work gains success.Greatness will come.</p> 
  <a href="products.php" class="btn">Explore Now &#8594; </a>

</div>
  <div class="col-2">
  <img src="images/background/bb4.png " width=68% class="ok"> 
  </div>
</div>
</div>
</div>
<!------------ features categories ----------------->
<div class="categories">
    <div class="small-container">
    <div class="row">
    <div class="col-3">
        <img src="images/cat1.jpg">
    </div>
    <div class="col-3">
        <img src="images/cat2.jpg">
    </div>
    <div class="col-3">
        <img src="images/cat3.jpg">
    </div>
    </div>
    </div>
</div>
<!------------ features products ----------------->
<div class="small-container">
    <h2 class="title">Featured Products</h2>
 
    <?php 
       $s=0;
       $sql ="SELECT * FROM article ORDER BY sale ASC" ;
       $limit=1 ; 
       $count=0; 
       $result= mysqli_query($conn, $sql);
       $nb=mysqli_num_rows($result); 
       if(mysqli_num_rows($result)>0){
                  while(($row= mysqli_fetch_assoc($result)) && ($count<($limit*8)))  { 
                      
                    if($count>(($limit-1)*7)|| ($count==0 && $limit==1)){
                    if ($s % 4==0) {
                        ?> 
                    <div class="row">
                    <div id="<?php echo $row['idarticle'];?>" class="col-4">
                    <a href="productDetails.php?id=<?php echo $row['idarticle'];?>"><img src=<?php print $row['img'] ?>></a>
                     <h4> <?php print $row['nom'] ?>  </h4>
                            <div  class="rating"> 
                            <?php $mm=0;
                               for($i=0;$i<$row['rating'];$i++){ 
                                   $mm=$mm+1;?>
                                         <a href="stars1.php?fa=<?php echo $i ?>&fart=<?php echo $row['idarticle'];?>"  >  <i class="fa fa-star"></i></a>
                                <?php }for($i=0;$i<(5-$row['rating']);$i++){
                                    ?>
                                    <a href="stars1.php?fa=<?php echo $mm+$i ?>&fart=<?php echo $row['idarticle'];?>"  >  <i class="fa fa-star-o"></i></a>
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
                             <a href="addcommande1.php?id=<?php echo $row['idarticle'];?>"><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>
                        <?php } else { ?>
                            <div class="shop2">
                             <a href="addcommande1.php?id=<?php echo $row['idarticle'];?>"><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>  
                           <?php } ?>
                     </div>
                     
                     <?php }
                     if ($s % 4==1 || $s % 4==2  ) {
                         ?>
                        <div id="<?php echo $row['idarticle'];?>" class="col-4">
                        <a href="productDetails.php?id=<?php echo $row['idarticle'];?>"><img src=<?php print $row['img'] ?>></a>
                        <h4> <?php print $row['nom'] ?>  </h4>
                               <div  class="rating"> 
                               <?php $mm=0;
                               for($i=0;$i<$row['rating'];$i++){ 
                                   $mm=$mm+1;?>
                                         <a href="stars1.php?fa=<?php echo $i ?>&fart=<?php echo $row['idarticle'];?>"  >  <i class="fa fa-star"></i></a>
                                <?php }for($i=0;$i<(5-$row['rating']);$i++){
                                    ?>
                                    <a href="stars1.php?fa=<?php echo $mm+$i ?>&fart=<?php echo $row['idarticle'];?>"  >  <i class="fa fa-star-o"></i></a>
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
                             <a href="addcommande1.php?id=<?php echo $row['idarticle'];?>"><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>
                        <?php } else { ?>
                            <div class="shop2">
                             <a href="addcommande1.php?id=<?php echo $row['idarticle'];?>"><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>  
                           <?php } ?>
                        </div>
                    <?php  }
                     ?>
                                    <?php 
                     if ($s % 4==3  ) {
                         ?>
                        <div id="<?php echo $row['idarticle'];?>" class="col-4">
                        <a href="productDetails.php?id=<?php echo $row['idarticle'];?>"><img src=<?php print $row['img'] ?>></a>
                        <h4> <?php print $row['nom'] ?>  </h4>
                               <div  class="rating"> 
                               <?php $mm=0;
                               for($i=0;$i<$row['rating'];$i++){ 
                                   $mm=$mm+1;?>
                                         <a href="stars1.php?fa=<?php echo $i ?>&fart=<?php echo $row['idarticle'];?>"  >  <i class="fa fa-star"></i></a>
                                <?php }for($i=0;$i<(5-$row['rating']);$i++){
                                    ?>
                                    <a href="stars1.php?fa=<?php echo $mm+$i ?>&fart=<?php echo $row['idarticle'];?>"  >  <i class="fa fa-star-o"></i></a>
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
                             <a href="addcommande1.php?id=<?php echo $row['idarticle'];?>"><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>
                        <?php } else { ?>
                            <div class="shop2">
                             <a href="addcommande1.php?id=<?php echo $row['idarticle'];?>"><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>  
                           <?php } ?>
                        </div>
                        </div>
                    <?php  } ?>
                     
                    <?php $s+=1 ; }
                           $count++ ;  }} ?>
        </div>
</div>
<!------ offer  ------>
<div class="offer">
    <div class="small-container">
        <div class="row">
        <?php 
        $sql ="SELECT * FROM article where idarticle='26'" ;
        $result= mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
           while($row= mysqli_fetch_assoc($result))  {
                       ?>
            <div class="col-2">
            <img src=<?php print $row['img'] ?>  class="offer-img" width=340px  >
            </div>
            <div class="col-2">
                <p>Exclusively Available on ArtBag </p>
                <h1><?php print $row['nom'] ?> </h1>
                <small><?php print $row['descr'] ?>  </small>
                <br>
                <a  href="productDetails.php?id=<?php echo $row['idarticle'];?>" class="btn"> Buy Now &#8594;</a>
            </div>
        <?php }} ?>
        </div>
    </div>
</div>

<!-- testimonial -->
<div class="testimonial">
    <div class="small-container">
        <div class="row">
        <?php    $sql ="SELECT * FROM contact WHERE txt='comment' ORDER BY rating ASC" ;
                  $result= mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result)>0){
                      while($row= mysqli_fetch_assoc($result))  { ?>
            <div class="col-3">
                <img src="images/guillemets.png" width=10px height=40px >
                <p><?php echo$row['msg'] ?></p>
                <p><?php echo$row['dat'] ?></p>
                <div class="rating">
                <?php 
                for($i=0;$i<$row['rating'];$i++){ 
                                   ?>
                                  <i class="fa fa-star"></i>
                                <?php }for($i=0;$i<(5-$row['rating']);$i++){
                                    ?>
                                <i class="fa fa-star-o"></i>
                                 <?php } ?>
                </div>
                <h3><?php echo$row['msg'] ?></h3>
            </div>
            <?php }} ?>
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
                <a href="welcome.php"><img src="images/okk.png"width=60px heigh=30px></a>
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
        <p class="copyright">Copyright 2022 - Art Bag</p>
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