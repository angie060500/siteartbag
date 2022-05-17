<?php
require_once('adminsecurity.php');
require_once("connection.php");
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
if(isset($_GET['id'])) 
    $ok=$_GET['id']; 
else $ok="" ; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
    <title>Document</title>
</head>
<body>
<div class="navigation1" >
            <ul>
                <li>
                    <a href="index.php">
                        <span class="icon"></span>
                        <span class="title2"><h2>Artbag</h2></span>
                    </a>
                </li>
                <li>
                    <a href="addproduct.php">
                        <span class="icon"><i class="fa fa-cart-plus"></i></span>
                        <span class="title2">add product</span>
                    </a>
                
                </li>
                <li>
                    <a href="ashowproducts.php">
                        <span class="icon"><i class="fa fa-tag"></i></i></span>
                        <span class="title2">products</span>
                    </a>
                </li>
                <li>
                    <a href="acustomers.php">
                        <span class="icon"><i class="fa fa-users"></i></span>
                        <span class="title2">customer</span>
                    </a>
                </li>
                <li>
                    <a href="aorders.php">
                        <span class="icon"><i class="fa fa-cart-arrow-down"></i></span>
                        <span class="title2">orders</span>
                    </a>
                </li>
                <li>
                    <a href="messages.php">
                        <span class="icon"><i class="fa fa-comments"></i></span>
                        <span class="title2">messages</span>
                    </a>
                </li>
            </ul>

        </div>
<div class="container">
  
        <div class="navigation" id="MenuItems">
            <ul>
                <li>
                    <a href="index.php">
                        <span class="icon"></span>
                        <span class="title2"><h2>Artbag</h2></span>
                    </a>
                </li>
                <li>
                    <a href="addproduct.php">
                        <span class="icon"></span>
                        <span class="title2">add product</span>
                    </a>
                
                </li>
                <li>
                    <a href="ashowproducts.php">
                        <span class="icon"><i class="fa fa-shopping-bag"></span>
                        <span class="title2">products</span>
                    </a>
                </li>
                <li>
                    <a href="acustomers.php">
                        <span class="icon"></span>
                        <span class="title2">customer</span>
                    </a>
                </li>
                <li>
                    <a href="aorders.php">
                        <span class="icon"></span>
                        <span class="title2">orders</span>
                    </a>
                </li>
                <li>
                    <a href="messages.php">
                        <span class="icon"><i class="fa fa-comments"></i></span>
                        <span class="title2">messages</span>
                    </a>
                </li>
            </ul>

        </div>
        <div class="main">
            <div class="topbar">
            <img src="images/menu.png" class="menu-icon1" onclick="menutoggle()">
            <a href="logout.php" class="logout">Logout</a>
                <div class="user">
                    <img src="images/profiles/profile1.jpg" >
                </div>
        </div>
            
        <div class="form-container1">
            <?php if (!empty($info)) { ?>
	           <div class="alert-info">
	           <b> <?php echo $info ;?></b>
              </div>
	        <?php } ?>
           <?php if (!empty($accept)) { ?>
	          <div class="alert-accept">
	           <b> <?php echo $accept ;?></b>
              </div>
	       <?php } 
           if(!empty($ok)){
            $sql ="SELECT * FROM article where idarticle= '$ok' " ;
            $result= mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)>0){
                while($row= mysqli_fetch_assoc($result))  {
                    $_SESSION['nomarticle'] =  $row['nom']; 
                ?>
      
           <form id="" action="addproduct_code.php" method="POST" >
           <span>Add Product </span>
           <label class="" for="nom">nom :</label>
           <input type="text" id="nom" name="nom" placeholder="Nom de produit " value="<?php echo $row['nom'];?>">
           <label class="" for="desc">Description :</label>
           <input type="text" id="descr" name="descr" placeholder="Description " value="<?php echo $row['descr'];?>">
           <label class="" for="img">image :</label>
           <input type="text" id="img" name="img" placeholder="image " value="<?php print $row['img'] ?>">
           <label class="" for="qtestock">qte stock :</label>
           <input type="text" id="qtestock" name="qtestock" placeholder="qte stock  " value="<?php echo $row['qtestock'];?>">
           <label class="" for="prix">price :</label>
           <input type="text" id="prix" name="prix" placeholder="price  " value="<?php echo $row['prix'];?>">
           <label class="" for="rating">rating :</label>
           <input type="text" id="rating" name="rating" placeholder="rating  " value="<?php echo $row['rating'];?>">
           <label class="" for="sale">nb of sales :</label>
            <input type="text" id="sale" name="sale" placeholder="sale  " value="<?php echo $row['sale'];?>">
           <button type="submit" id="form-submit" class="btn btn-success btn-fw" > Submit</button>
           <button type="reset" id="form-submit" class="btn btn-danger btn-fw">Reset</button>
       </form>
           <?php }}}else{
                ?>
            
            <form id="" action="addproduct_code.php" method="POST" >
                <span>Add Product </span>
                <label class="" for="nom">name :</label>
                <input type="text" id="nom" name="nom" placeholder="Nom de produit " value="">
                <label class="" for="desc">Description :</label>
                <input type="text" id="desc" name="desc" placeholder="Description " value="">
                <label class="" for="img">image :</label>
                <input type="text" id="img" name="img" placeholder="image " value="">
                <label class="" for="qtestock">qte stock :</label>
                <input type="text" id="qtestock" name="qtestock" placeholder="qte stock  " value="">
                <label class="" for="prix">price :</label>
                <input type="text" id="prix" name="prix" placeholder="price  " value="">
                <label class="" for="rating">rating :</label>
                <input type="text" id="rating" name="rating" placeholder="rating  " value="">
                <label class="" for="sale">nb of sales :</label>
                 <input type="text" id="sale" name="sale" placeholder="sale  " value="">
                <button type="submit" id="form-submit" class="btn btn-success btn-fw">Submit</button>
                <button type="reset" id="form-submit" class="btn btn-danger btn-fw">Reset</button>
            </form>
            <?php } ?>
        </div>
           
    
</div>  
<!---- just for toggle menu ---->
<script>
    var MenuItems =  document.getElementById("MenuItems") ; 
    MenuItems.style.maxHeight="0px"; 
    function menutoggle(){
        if (MenuItems.style.maxHeight=="0px")
         { MenuItems.style.maxHeight="400px"; }
         else   { MenuItems.style.maxHeight="0px"; }
    }
</script>
</body>
</html>