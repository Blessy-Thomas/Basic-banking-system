<?php
ob_start();
require_once "config.php";
session_start();
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel = "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- font -->
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style.css">
     <style>
        body{
            backdrop-filter: blur(5px);
        }
        body{
    margin: 0;
    padding: 0;
}
.container-fluid{
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
.active{
    border: 10px;
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

        <!-- ALLUSERS TABLE START-->
     
        <div class="row row-content">
                <div class="col-12 offset-sm-1 col-sm-10">
                    <h2 style="padding-top: 120px ;text-align: center; padding-bottom: 5px; color: white; "><b><i>ACCOUNTS</i></b></h2>
                    <div class="table-responsive tb">
                        <table class="table table-striped">
                            <thead class="thead">
                            <tr>
                            <th>ID</th>
                            <th>USER</th>
                            <th>EMAIL</th>
                            <th>BALANCE</th>
                            <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody> 
                            <tr>
                            <?php 
                            $stmt = $pdo->query("SELECT * FROM users");
                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            if(count($rows)>0){
                                foreach($rows as $row ) { ?>
                                <td><?php echo htmlentities($row['user_id']); ?> </td>
                                <td style="text-tranform: uppercase; text-decoration: none;"><?php echo('<a href="profile.php?user_id='.$row['user_id'].'">'.htmlentities($row['user_name']).'</a> ');
                                                ?>  </td>
                                <td><?php echo htmlentities($row['email']); ?> </td>
                                <td><?php echo htmlentities($row['user_credits']); ?> </td>
                                <td>
                                    <button>
                                        <?php  echo('<a href="profile.php?user_id='.$row['user_id'].'">'."View".'</a> ');?>
                                    </button>
                                </td>
                                </tr>
                                <?php }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div> 
</div>                  
<!-- ALLUSERS TABLE END-->

 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>   
</body>
</html>


