<?php
ob_start();
require_once "config.php";
session_start();
if (isset($_POST['submit'])){
    $receiver=$_POST['receiver'];
   $amount=$_POST['amount'];
   $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:xyz");
   $stmt->execute(array(":xyz" => $_GET['user_id']));
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $sender=$row['user_name'];
   $balance=$row['user_credits'];
   if($balance<$amount){
     ?>
        <script>
        alert("Insufficient balance");
        </script>
     <?php
   }
   else{
   $sql = "INSERT INTO history (sender, receiver, trans_amount) VALUES (?,?,?)";
   $stmt= $pdo->prepare($sql);
   $stmt->execute([$sender, $receiver, $amount]);

   $sql = "UPDATE users SET user_credits=user_credits-$amount WHERE user_name='$sender'";
   $stmt= $pdo->prepare($sql);
   $stmt->execute();

   $sql = "UPDATE users SET user_credits=user_credits+$amount WHERE user_name='$receiver'";
   $stmt= $pdo->prepare($sql);
   $stmt->execute();
 ?>
 <script>
   alert("Payment Successful");
 </script>

<?php 
}
} 
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Basic Banking System</title>
        <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap-social.css"> 
    <link rel="stylesheet" href="style.css">
     <style>
        body{
            backdrop-filter: blur(5px);

        margin: 0;
        padding: 0;
    }
    .container-fluid{
    width:100vw;
    height:100vh;
        background-attachment: fixed;
        background-image: url('bank.jpeg');
        -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    }
    .navbar-nav{
        position: absolute;
        right: 0;
    }

    button{
        color: white;
    }
    .nav-link{
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-size: 18px;
        color: turquoise;
        cursor: pointer;
    }
    h1{
        font-size: 12vw;
        color:gold;
        margin-top: 30vh;
        padding-left: 17vw;
        font-family: 'Cookie', cursive;
    }
    .row> p{
        color: honeydew;
        padding-left: 19vw;
        position: absolute;
        top: 0;bottom: 0;right: 0;left: 0;
        padding-top: 52vh;
        font-family: 'Cookie';
        font-size: 2.5vw;
    }
  .row2{
    padding-left: 45%;
  }
    .btn:hover{
        color:black;
    }
    #footer p{
        color: white;
        margin-top: 20vh;
        font-size: 2vw;
        font-weight: 500;
    }
    </style>
</head>
<body>
<div class="container-fluid">
         <!-- An horizontal navbar that becomes vertical on large screens -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarcontent"
            aria-controls="navbarcontent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
           
            <div class="collapse navbar-collapse" id="navbarcontent">
                <ul class="navbar-nav mt-5 pr-5">
                   <li class="nav-item">
                       <a href="./index.php" class="nav-link"><span class="fa fa-home fa-lg"></span> Home</a>
                   </li>
                   <li class="nav-item active">
                       <a href="./users.php" class="nav-link"><span class="fa fa-address-card fa-lg"> </span>Users <span class="sr-only">(current)</span></a>
                   </li>
                   <li class="nav-item">
                       <a href="./history.php" class="nav-link"><span class="fa fa-info fa-lg"></span>Transaction History</a>
                   </li>
                </ul>
            </div>
        </nav>
<!-- NAVBAR END-->

<?php
$stmt = $pdo->prepare("SELECT * FROM users where user_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['user_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sender=$row['user_name'];
?>
<!-- USER DETAILS START-->
    <div class="container" style=" padding-top:200px;"  >
          <div class="row">
             <div class="col-sm offset-md-3 col-md-6">
                  <div class="panel panel-default" style="padding: 10px; color:white; background-color: blue; border-radius: 20px;">
                       <h2 class="text-center">User Details</h2>
                           <hr style="border:1px solid white;">
                                <div class="panel panel-default" style="color:  black;" >
                                   <div class="panel-body">
                                      <p><b>Name:</b> <?php echo htmlentities($row['user_name']); ?></p>
            <p><b>Email Id:</b> <?php echo htmlentities($row['email']); ?></p>
            <p><b>Balance:</b> <?php echo htmlentities($row['user_credits']); ?></p>   
            <p><button class="btn btn-dark btn-xs view_data" data-toggle="modal" data-target="#transfer<?php echo $row['user_id'] ?>">Transfer Money</button></p> 
                                   </div>
                                </div>
            </div>
            </div>
          </div>
   </div>
<!-- USER DETAILS END-->

<!-- TRANSACTION MODAL START-->
   <div id="transfer<?php echo $row['user_id'] ?>" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl" role="content">
            <!-- Modal content-->
            <div class="modal-content">
                <?php $id=$row['user_id']; ?>
                <div class="modal-header">
                    <h4 class="modal-title">Transfer Money </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                        <label for="name" name="<?php echo $row['user_id'] ?>" class="col-md-2 col-form-label">Sender:</label>
                        <div class="col-md-10" id="uname">
                           <p><?php echo $row['user_name'] ?></p>
                        </div>
                        </div>
                       <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">Reciever:</label>
                        <div class="col-md-10">
                            <select name="receiver" class="form-control">
                                <?php 
                                   $stmt = $pdo->query("SELECT * FROM users WHERE user_id!=$id ");
                                   $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                   if(count($rows)>0){
                                   foreach($rows as $row ) { ?>

                                     <option><?php echo $row['user_name'] ?></option>
                                  
                                  <?php }
                                       } 
                                 ?>
                            </select>
                        </div>
                        </div>
                    <div class="form-group row">
                        <label for="amount" class="col-md-2 col-form-label">Transfer Amount</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" id="amount" name="amount" placeholder=" Credits\Amount" required>
                        </div>
                    </div>   
                       <div class="form-group row2">
                          <button href="profile.php?user_id=$id" type="submit" id="submit" name="submit" class="btn btn-primary btn-md ml-auto">Transfer</button>  
                         
                         <button type="button" class="btn btn-secondary btn-md ml-auto" data-dismiss="modal">Cancel</button>     
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
                                    
</div>
<!-- TRANSACTION MODAL END-->

 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> 
<!-- TO CHECK THE REQUIRED FIELDS-->  
<script>
     $(document).ready(function(){
    document.getElementById("submit").onclick = function () {
        if() {
            alert('error please fill all fields!');
            }      

         };   
  });
</script>

</body>
</html>

