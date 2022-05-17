<!DOCTYPE html>
<?php
require_once('security.php');

require_once("connection.php");
$pseudo=$_SESSION['pseudo'] ;
if(isset($_SESSION['id'])) {
    $iduser=$_SESSION['id'];
}
else {
    $iduser="";
}

if(isset($_GET['id']))
{$id =$_GET['id'];  
    $_SESSION['idarticle']= $id;  }
elseif(isset( $_SESSION['detailsid']))  
  {   $id=$_SESSION['detailsid'] ; 
    $_SESSION['idarticle']= $id; ;}

$id= $_SESSION['idarticle'] ; 

?>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <title>Art Bags</title>
   <link rel="icon" type="image/png" sizes="16x16" href="images/okk.png">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
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
</div>
<!------------ Single product details ----------------->
<div class="small-container single-product">
  <div class="row">
  <?php 
        $sql ="SELECT * FROM article where idarticle='$id'" ;
        $result= mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
           while($row= mysqli_fetch_assoc($result))  {
                       ?>
           <div class="col-2">
           <img src=<?php print $row['img'] ?> width=100%>
           </div>
           <div class="col-2">
                  <p> Home/ toto bag</p>
                 <h1 style="color:#BF3880"><?php echo $row['nom'];?></h1>
                 <h4><?php echo $row['prix']." DT";?></h4>
                 <select>
                       <option>Select Size</option>
                       <option>Large</option>
                       <option>Medium</option>
                       <option>Small</option>
                </select>
             <form action="addcommande2.php" method="POST">
             <input id="qte" name="qte" type="number" value="1" >
              <button id="cart" type="submit"  class="btn3"> Add to cart </button>
              </form>

             <h3>Description<i class="fa fa-indent"></i></h3>
            <br>
            <p> <?php echo $row['descr'];?></p>
          </div>
       <?php }}?>
</div>
</div>

<!---------- title -------------->
<div class="small-container">
    <div class="row row2">
       <h2> Related Products </h2>
       <a href="products.php">View More</a>
    </div>
</div>
<!---products----->
<div class="small-container">
    <div class="row ">
    <?php 
        $sql ="SELECT * FROM article " ;
        $result= mysqli_query($conn, $sql);
        $s=0 ; 
        if(mysqli_num_rows($result)>0){
            $p= mysqli_num_rows($result)-$id ; 
           while($row= mysqli_fetch_assoc($result))  {
                   if(($row['idarticle']>$id) && $s<4 )  { 
                       $s=$s+1; ?>
        <div id="<?php echo $row['idarticle'];?>" class="col-4">
        <a href="productDetails.php?id=<?php echo $row['idarticle'];?>"> <img src=<?php print $row['img'] ?> ></a>
            <h4><?php echo $row['nom'];?></h4>
            <div  class="rating"> 
            <?php $mm=0;
                               for($i=0;$i<$row['rating'];$i++){ 
                                   $mm=$mm+1;?>
                                         <a href="stars2.php?fa=<?php echo $i ?>&fart=<?php echo $row['idarticle'];?>&id=<?php echo $id;?>"  >  <i class="fa fa-star"></i></a>
                                <?php }for($i=0;$i<(5-$row['rating']);$i++){
                                    ?>
                                    <a href="stars2.php?fa=<?php echo $mm+$i ?>&fart=<?php echo $row['idarticle'];?>&id=<?php echo $id;?>"  >  <i class="fa fa-star-o"></i></a>
                                 <?php } ?>
                                </div>
            <p><?php echo $row['prix']." DT";?></p>
            <?php 
                        $a=$row['idarticle'];
                        $sql2 ="SELECT * FROM commande WHERE (idart='$a' && idcc='$iduser' && ord='$fact ')" ;
                        $result2= mysqli_query($conn, $sql2);
                        $nb2=mysqli_num_rows($result2); 
                        if(mysqli_num_rows($result2)==0){?>
                          <div class="shop1">
                          <a href="addcommande2.php?id=<?php echo $row['idarticle'];?>"  ><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>
                        <?php } else { ?>
                            <div class="shop2">
                            <a href="addcommande2.php?id=<?php echo $row['idarticle'];?>"  ><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>  
                           <?php } ?>
        </div>
       <?php }}} 
       if ($p<4){ 
        $sql2 ="SELECT * FROM article " ;
        $result2= mysqli_query($conn, $sql2);
        $s=0 ; 
        if(mysqli_num_rows($result2)>0){
            while($row2= mysqli_fetch_assoc($result2))  {
                if(($row2['idarticle']!=$id) && $s<(4-$p) )  { 
                    $s=$s+1; ?>
                      <div id="<?php echo $row['idarticle'];?>" class="col-4">
                      <a href="productDetails.php?id=<?php echo $row2['idarticle'];?>"> <img src=<?php print $row2['img'] ?> ></a>
                    <h4><?php echo $row2['nom'];?></h4>
                    <div  class="rating"> 
                    <?php     $mm=0 ; 
                               for($i=0;$i<$row['rating'];$i++){ 
                                   $mm=$mm+1 ; ?>
                                         <a href="stars2.php?fa=<?php echo $i ?>&fart=<?php echo $row['idarticle'];?>"  >  <i class="fa fa-star"></i></a>
                                <?php }for($i=0;$i<(5-$row['rating']);$i++){
                                    echo $mm ; 
                                    ?>
                                    <a href="stars2.php?fa=<?php echo $mm+$i ?>&fart=<?php echo $row['idarticle'];?>"  >  <i class="fa fa-star-o"></i></a>
                                 <?php } ?>
                                </div>
                 <p><?php echo $row2['prix']." DT";?></p>
                 <?php 
                        $a=$row['idarticle'];
                        $sql2 ="SELECT * FROM commande WHERE (idart='$a' && idcc='$iduser' && ord='$fact ')" ;
                        $result2= mysqli_query($conn, $sql2);
                        $nb2=mysqli_num_rows($result2); 
                        if(mysqli_num_rows($result2)==0){?>
                          <div class="shop1">
                             <a href="addcommande2.php?id=<?php echo $row['idarticle'];?>"><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>
                        <?php } else { ?>
                            <div class="shop2">
                             <a href="addcommande2.php?id=<?php echo $row['idarticle'];?>"><i class="fa fa-shopping-cart fa-2x"></i></a>
                          </div>  
                           <?php } ?>
     </div>
   <?php }}} }  ?>
       
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
                <a href="index.php"><img src="images/okk.png" width=120px></a>
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