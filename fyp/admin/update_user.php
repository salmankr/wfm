<?php
session_start();
if(!isset($_SESSION["email"])){

    header("Location: ../index.php");
}
else{
     $email = $_SESSION["email"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>WorkForce Management System</title>
<link rel='icon' href="../img/icon.ico">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link rel='stylesheet' href="../style/style.css">
</head>
<body>
<div class="container-fluid">
<div class="jumbotron">
<ul class="nav nav-pills pull-right">
<li><a href="dashboard.php"> <span class="glyphicon glyphicon-th"></span> Dashboard </a></li>
<li><a href="change_password.php"><span class="glyphicon glyphicon-lock"></span> Change Password </a></li>
<li><a href="help.php"><span class="fa fa-question-circle"></span> Help </a></li>
<li><a href="../logout/logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
</ul>

<div class="row">
<div class="col-sm-3">
<img src="../img/logo.png">
</div>
<div class="col-sm-9">
<h2>WorkForce Management System Dashboard</h2>
</div>
</div>
</div>
<nav class="navbar navbar-inverse">
<div class="container-fluid">
<div class="navbar-header">
<a class="navbar-brand" href="#">WebSiteName</a>
</div>
<ul class="nav navbar-nav">
<li class="active"><a href="home.php">Home</a></li>
<li> <a class="dropdown dropdown-toggle" data-toggle="dropdown" href="#">Credential</a>
<ul class="dropdown-menu">
<li><a href="sign_up.php">Create Credential</a></li>
<li><a href="update_user.php">Update Credential</a></li>
<li><a href="delete_user.php">Delete Credential</a></li>
</ul>
</li>

<li> <a class="dropdown dropdown-toggle" data-toggle="dropdown" href="#">News Feeds</a>
<ul class="dropdown-menu">
<li><a href="update_news.php">Update News</a></li>
<li><a href="delete_news.php">Delete News</a></li>
</ul>
</li>
<li><a href="we_listen.php">We Listen</a></li>
</ul>
</div>
</nav>
<div class="col-sm-3">
<div class="panel panel-default">
<div class="panel-heading">Profile (Admin)</div>
<div class="panel-body">
<div class="row">
<?php 
include("../db/connection.php");
$query = "select * from sign_up where email = '$email'";
$run = mysqli_query($con,$query);
$count = mysqli_num_rows($run);
if($count > 0){
   while($row = mysqli_fetch_array($run)){
  $first_name = $row["first_name"];
  $last_name = $row["last_name"];
  $image = $row["image"];
  $date = date("l, M d, Y");
  ?>
        <div class="col-sm-5">
            <a href="personal_info.php"><img src="image/<?php echo $image; ?>" class="thumbnail" width="100%" height="70px"></a>
        </div>
    <div class="col-sm-7" style="padding:0px;">
    <ul style="padding-left:0px;list-style:none;">
    <li> <?php echo $first_name; ?> </li>
    <li> <?php echo $last_name; ?> </li>
    <li> <?php echo $date; ?> </li>
    <li><?php date_default_timezone_set("Asia/Karachi"); echo date("h:i:sa"); ?></li>
    </ul>
    </div>
  <?php 
  }
}
?>


</div>
</div>
</div>
</div>
<div class="col-sm-9">
<div class="panel panel-default">
<div class="panel-heading">Update Credential</div>
<div class="panel-body">

<div class="col-sm-6">
<h3 style="text-align: center; color: #6699ff; "><b>Update Info</b></h3>
<form class="form-horizontal" action="update_user.php" method="post">
<div class="form-group">
<label for="Emp_ID" class="col-sm-3 control-label">Employee ID</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="Emp_ID" id="Emp_ID" placeholder="Employee ID" required="required">
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button id="btn_login" class="btn btn-default" name="update">Update Credential</button>
</div>
</div>
<?php
include("../db/connection.php");
if(isset($_POST['update'])){
  $emp_id=$_POST['Emp_ID'];
   $select="SELECT * FROM sign_up WHERE emp_id='$emp_id'";
    $select_run=mysqli_query($con,$select);
    $count=mysqli_num_rows($select_run);
    if($count > 0){

  $_SESSION['Emp_ID'] = $emp_id;
  header("Location: User_Info.php");

    }
    else{
      ?>
      <div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   User Id is invalid.
</div>

      <?php
    }


}

?>
<?php 
}
?>
</form>
</div>

<div class="col-sm-6">
<h3 style="text-align: center; color: #6699ff; "><b>Reset Password</b></h3>
<form class="form-horizontal" action="update_user.php" method="post">

<div class="form-group">
<label for="Emp_ID" class="col-sm-3 control-label">Employee ID</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="reset_pass" id="Emp_ID" placeholder="Employee ID" required="required">
</div>
</div>

<div class="col-sm-offset-2 col-sm-10">
<button type="submit" name="pwd_reset"  class="btn btn-default">Reset</button>
</div>
<?php
if(isset($_POST['pwd_reset'])){
      $emp_id = $_POST['reset_pass'];
      $query = "UPDATE sign_up SET pass='Password1',confirm_pass='Password1' WHERE emp_id = '$emp_id'";
       $run = mysqli_query($con,$query);
       if($run){
        ?>
        <div class="col-sm-12" style="text-align: center;"><b>Password Reset Successfully!</b></div>
        <?php
       }
       else{
        echo "not found";
       }
   }
    ?>
</form>
</div>
</div>  

</div>
</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

