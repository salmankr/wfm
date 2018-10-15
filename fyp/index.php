 <?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>WorkForce Management System</title>
<link rel='icon' href="img/icon.ico">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel='stylesheet' href="style/style.css">
<!-- Latest compiled and minified JavaScript -->
</head>
<body>
<div class="container-fluid">
<div class="jumbotron">
<div class="row">
<div class="col-sm-3">
<img src="img/logo.png">
</div>
<div class="col-sm-9">
<h2>WorkForce Management System</h2>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-8">
<div class="panel panel-default">
<div class="panel-heading">Employee Management
</div>
<div class="panel-body">
<img src="img/bg-admin6.jpg" class="img-responsive">
</div>
</div>
</div>
<div class="col-sm-4">
<div class="panel panel-default">
<div class="panel-body">
<div class="panel-footer">
<form action="index.php" method="post" id="login_form">
<div class="form-group">
<label for="email">Email address</label>
<input type="email" class="form-control" name="email" id="email" placeholder="Email">
</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password" class="form-control" name="pass" id="pass" placeholder="Password">
</div>
<div class="form-group">
<label for="select">Login Type</label>
<select  class="form-control" name="sel" id="sel">
<option>---</option>
<option>Admin</option>
<option>WFM</option>
<option>User</option>
</select>
</div>
<button id="btn_login" class="btn btn-default" name="sign_in">Sign In</button>
</form>
<?php 
include_once("db/connection.php");
if(isset($_POST['sign_in'])){

    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $sel = $_POST["sel"];
    
    $query = "SELECT * FROM sign_up WHERE email = '$email' AND pass = '$pass' AND user_type = '$sel'";
    $run = mysqli_query($con , $query);
    $count = mysqli_num_rows($run);
    if($count > 0){
         while ($row = mysqli_fetch_array($run)) {
             $type = $row['user_type'];
             if($type == "Admin"){
                 
                 $_SESSION["email"] = $email;
                echo "<script> window.open('admin/dashboard.php','_self'); </script>";
             }

             else if($type == "WFM"){
 
                 $_SESSION["email"] = $email;
                echo "<script> window.open('wfm/dashboard.php','_self'); </script>";
             }
             else{

                 $_SESSION["email"] = $email;
                echo "<script> window.open('user/dashboard.php','_self'); </script>";
             }

    }
}
    else{

        echo "Invalid User Name And Password!";
    }
}
?>
</div>
<div class="panel-footer" style="margin-top: 30px;">
<p><strong>For Support And Queries</strong></p>
<p><strong> Email: </strong><a href="">admin@gmail.com</a></p>
<p><strong> Web: </strong><a href="">wfm.com</a></p>
<p><strong> Phone: </strong>92-32********</p>
<p><strong>Copyright:</strong> Salman & Shomeel</p>
</div>
</div>
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
<script src="js/custom.js" type="text/javascript"></script>
</body>
</html>