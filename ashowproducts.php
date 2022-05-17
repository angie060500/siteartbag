<!DOCTYPE html>

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
?>
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
                        <span class="title2">customers</span>
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
                        <span class="icon"></span>
                        <span class="title2">products</span>
                    </a>
                </li>
                <li>
                    <a href="acustomers.php">
                        <span class="icon"></span>
                        <span class="title2">customers</span>
                    </a>
                </li>
                <li>
                    <a href="aorders.php">
                        <span class="icon"></span>
                        <span class="title2">orders</span>
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



            <div class="card">
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
                <h2 class="card-title">Products</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>product name</th>
                            <th>description</th>
                            <th>image</th>
                            <th>qte</th>
                            <th>price</th>
                            <th>rating</th>
                            <th>sale</th>
                            <th>Delete</th>
                            <th>Modifiy</th>
                        </tr>
                        
                    </thead>
                    <tr>
                    <?php 
                  $sql ="SELECT * FROM article " ;
                  $result= mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result)>0){
                      while($row= mysqli_fetch_assoc($result))  {
                      
                       ?>
                        <tr>
                           <td><?php echo $row['nom'];?></td>
                           <td><?php echo $row['descr'];?></td>
                           <td><img src=<?php print $row['img'] ?> ></td>
                          <td><?php echo $row['qtestock'];?></td>
                          <td><?php echo $row['prix'];?></td>
                          <td><?php echo $row['rating'];?></td>
                          <td><?php echo $row['sale'];?></td>
                          <td> <a href="adelete_article.php?id=<?php echo $row['idarticle']; ?> " class="prod">Delete</a></td>
                         <td> <a href="addproduct.php?id=<?php echo $row['idarticle']; ?>  " class="prod">Modify</a></td>
                       </tr>
                       <?php }} ?>
                </table>
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