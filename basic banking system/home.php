<?php
$year = date('Y');
ob_start();
require_once "config.php";
session_start();
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Banking System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel = "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- font -->
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <style>
    body{
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
.btn{
    color: white !important;
    background-color: red;
    font-size: 1vw;
    margin-left: 18vw;
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
                   <li class="nav-item active">
                       <a href="./index.php" class="nav-link"><span class="fa fa-home fa-lg"></span> Home <span class="sr-only">(current)</span></a>
                   </li>
                   <li class="nav-item">
                       <a href="./users.php" class="nav-link"><span class="fa fa-address-card fa-lg"> </span>Users</a>
                   </li>
                   <li class="nav-item">
                       <a href="./history.php" class="nav-link"><span class="fa fa-info fa-lg"></span>Transaction History</a>
                   </li>
                </ul>
            </div>
        </nav>


        <div class="row">
            <div class="col-12">
                <h1>Banking System</h1>
                <div class="row">
                    <p>Task 1</p>
                </div>
                <button id="trans" class="btn px-4 py-2 mt-4">Transfer Money</button>
            </div>
        </div>
            <!-- TRANSFER CREDIT MODAL START-->
  <div id="transModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md" role="content">
           
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Transfer Money</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default" style="padding: 10px;">
                       <h2 class="text-center">Choose an account</h2>
                           <hr>
                           <?php 
                              $stmt = $pdo->query("SELECT * FROM users");
                              $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                              if(count($rows)>0){
                                 foreach($rows as $row ) { ?>

                                <div class="panel panel-default">
                                   <div class="panel-body">
                                      <div class="row" style="padding-left: 10px;">
      
                                        <?php echo('<a class="name" href="profile.php?user_id='.$row['user_id'].'">'.htmlentities($row['user_name']).'</a> ');
                                         ?>   
                                      </div> 
                                      <p><strong>Email Id: </strong><?php echo htmlentities($row['email']); ?><br>  
                                      <strong>Balance:</strong> Rs.<?php echo htmlentities($row['user_credits']); ?></p> 
                                   </div>
                                </div>
                            <?php }
                              }
                          ?>
                  </div>  
                </div>
            </div>
        </div>
    </div>
 <!-- TRANSFER CREDIT MODAL END-->
     </div>
     
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
    <script>
      $(document).ready(function(){
        $('#trans').click(function(){
                $('#transModal').modal('show');
            });
      });
    </script> 
</body>
</html>