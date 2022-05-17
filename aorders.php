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
                <li>
                    <a href="messages.php">
                        <span class="icon"></span>
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
                <h2 class="card-title">Orders</h2>
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
                  $sql ="SELECT * FROM fact " ;
                  $result= mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result)>0){
                      while($row= mysqli_fetch_assoc($result))  {  
                          if ( $row['statut']=='not delivered' && $row['qte']!=0 ) {
                 ?>
                        <tr>
                           <td><?php echo  $row['idord'];?></td>
                           <td><?php echo $row['fulln'];?></td>
                           <td><?php echo $row['phone'];?></td>
                           <td><?php echo $row['addres'];?></td>
                           <td><?php echo $row['city'];?></td>
                           <td><?php echo $row['dat'];?></td>
                           <td><?php echo $row['qte'];?></br> <a href="orderpro.php?fact=<?php echo$row['idord'];?> " class="prod"> see articles </a></td>
                           <td><?php echo $row['somme']." DT";?></td>
                           <?php if ( $row['statut']=='not delivered'){ ?>
                                        <td><?php echo $row['statut'];?> </br>
                                        <a href="comdone.php?fact=<?php echo$row['idord'];?> " class="prod"> Done</a></td>
                           <?php } ?>
                 
               
                       </tr>
                       <?php }}} ?>
                </thead>
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