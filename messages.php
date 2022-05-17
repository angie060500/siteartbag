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
if (!isset($_SESSION['idm1']))
$_SESSION['idm1']=0;
$_SESSION['idm']=$_SESSION['idm1'];;
if (isset($_GET['idm']))
$_SESSION['idm1']= $_GET['idm'];
else 
$_SESSION['idm1']=0;



?>
<?php if($_SESSION['idm1']!=0)  {
header("Location: messages.php#answer-form") ; 
 }


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
                        <span class="icon"></span>
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
                <h2 class="card-title">messages</h2>
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th>name </th>
                        <th>mail </th>
                        <th>date</th>
                        <th>type</th>
                        <th>message</th>
                        <th>type</th>
                        <th>answer</th>
                        <th>delete</th>
                    </tr>
                </thead>
                <?php 
                  $sql ="SELECT * FROM contact " ;
                  $result= mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result)>0){
                      while($row= mysqli_fetch_assoc($result))  {
                          ?>
                        <tr>
                        <td><?php echo $row['nom'];?></td>
                        <td><?php echo $row['mail'];?></td>
                        <td><?php echo $row['dat'];?></td>
                        <td><?php echo $row['txt'];?></td>
                        <td><?php echo $row['msg'];?></td>
                        <td><?php echo $row['rating'];?></td>
                        <?php if($row['statut']=='DONE') { ?>
                         <td style="color: #BF3880"> <?php echo 'SEND'?> </td>
                         <?php } else { ?>
                            <td> <a href="messages.php?idm=<?php echo $row['idm'];?> " class="prod">Answer</a></td>
                         <?php } ?>
                         <td> <a href="Delete_msg.php?idm=<?php echo $row['idm'];?>" class="prod">Delete</a></td>
                        </tr>
                    <?php }} ?>

                </table>

            </div>
            <div class="form-container3">
          <?php 
  
          if (isset( $_SESSION['idm']))
           $idmsg = $_SESSION['idm'] ; 
           else 
           $idmsg=0 ; 
          if($idmsg!=0){ 
                $sql ="SELECT * FROM contact WHERE idm=$idmsg " ;
                  $result= mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result)>0){
                      while($row= mysqli_fetch_assoc($result))  {
                          ?>
            <form action="mail.php?mail=2" id="answer-form" method="POST">
                <div class="answer">
                    <span>answer here</span>
                    <input type="text" name="statut" id="statut" value=<?php echo $row['idm'];?> style="display:none">
                    <label for="email">to:</label>
                    <input type="email" name="email" id="email" value=<?php echo $row['mail'];?>>
                    <label for="subject">subject :</label>
                    <input type="text" name="subject" id="subject" value="reply_artbox">
                    <label for="msg">message :</label>
                    <textarea name="msg" id="msg" cols="30" rows="50" placeholder="write here" value="Bonjour <?php echo $row['nom'];?> "></textarea>
                    </br>
                    <button class="btn">Send &#8594; </button>
                </div>
            </form>
            <?php } }}
            else {  ?>
                     
                     <form action="mail.php?mail=2" id="answer-form" method="POST">
                <div class="answer">
                    <span>answer here</span>
                    <label for="email">to:</label>
                    <input type="email" name="email" id="email" placeholder="e-mail">
                    <label for="subject">subject :</label>
                    <input type="text" name="subject" id="subject" placeholder="subject">
                    <label for="msg">message :</label>
                    <textarea name="msg" id="msg" cols="30" rows="50" placeholder="write here"></textarea>
                    </br>
                    <button class="btn">Send &#8594; </button>
                </div>
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