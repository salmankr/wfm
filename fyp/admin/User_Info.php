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

<div class="row">
<div class="col-sm-10" style="padding-top: 30px;">
    <h2 style="color: #6699ff">Latest News:</h2>
    <br>
    <?php 
include("../db/connection.php");
$query = "SELECT * FROM news_feed LIMIT 0,1";
$run = mysqli_query($con,$query);
$row = mysqli_fetch_array($run);
$news = $row["news"];
?>
<div class="col-sm-10" style="color: red">
    <b><?php echo $news; ?></b>
</div>
<?php

?>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-sm-9">
<div class="panel panel-default">
<div class="panel-heading">Update Credential</div>
<div class="panel-body">
<?php 
include("../db/connection.php");
if(isset($_SESSION["Emp_ID"])){
	$session_id=$_SESSION["Emp_ID"];
    $select="SELECT * FROM sign_up WHERE emp_id='$session_id'";
    $select_run=mysqli_query($con,$select);
    $count=mysqli_num_rows($select_run);
    if($count > 0){
        while ($row=mysqli_fetch_array($select_run)) {
    $emp_id=$row['emp_id'];   
    $first_name=$row['first_name'];
    $last_name=$row['last_name'];
    $email=$row['email'];
    $cell=$row['cell'];
    $img_name=$row['image'];
    $address=$row['address'];
    $join_date=$row['reg_date'];
    $login_type=$row['user_type'];
    $date=date('m/y/d');

      ?>
      
<form class="form-horizontal" action="User_Info.php" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="Emp_ID" class="col-sm-3 control-label">Employee ID</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Emp_ID" placeholder="Employee ID" value="<?php echo $emp_id; ?>" disabled required="required">
</div>
</div>

<div class="form-group">
<label for="1st_Name" class="col-sm-3 control-label">First Name</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="first_Name" placeholder="First Name" value="<?php echo $first_name; ?>" required="required">
</div>
</div>

<div class="form-group">
<label for="Last_Name" class="col-sm-3 control-label">Last Name</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Last_Name" placeholder="Last Name" value="<?php echo $last_name; ?>" required="required">
</div>
</div>

<div class="form-group">
<label for="Email" class="col-sm-3 control-label">Email</label>
<div class="col-sm-4">
<input type="email" class="form-control" name="Email" placeholder="Email" value="<?php echo $email; ?>" required="required">
</div>
</div>

<div class="form-group">
<label for="Cell" class="col-sm-3 control-label">Mobile</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Cell" placeholder="Mobile" value="<?php echo $cell; ?>" required="required">
</div>
</div>

<div class="form-group">
<label for="img" class="col-sm-3 control-label">Image</label>
<div class="col-sm-4">
<input class="form-control" name="img" type="file" placeholder="Image" required="required">
<img src="image/<?php echo $img_name; ?>" class="img-responsive">
</div>
</div>

<div class="form-group">
<label for="address" class="col-sm-3 control-label">Address</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $address; ?>" required="required">
</div>
</div>

<div class="form-group">
<label for="Join_date" class="col-sm-3 control-label">Join Date</label>
<div class="col-sm-4">
<input type="date" class="form-control" name="Join_date" placeholder="Date" value="<?php echo $join_date; ?>" disabled required="required">
</div>
</div>

<div class="form-group">
<label for="Login_type" class="col-sm-3 control-label">Login Type</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="login_type" placeholder="Address" disabled value="<?php echo $login_type; ?>" 
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" name="update"  class="btn btn-default">Update Credential</button>
</div>
</div>
<a href="update_user.php" class="pull-right" style="margin-right: 20px;"><span class="glyphicon glyphicon-arrow-left"></span></a>
</form>
<?php 

        }

    }
}
?>

</div>  
<?php
if(isset($_POST ['update'])){
    if(isset($_SESSION["Emp_ID"])){
    $session_id=$_SESSION["Emp_ID"];
    $first_name=$_POST['first_Name'];
    $last_name=$_POST['Last_Name'];
    $email=$_POST['Email'];
    $cell=$_POST['Cell'];
    $img_name=$_FILES['img']['name'];
    $temp_img=$_FILES['img']['tmp_name'];
    $address=$_POST['address'];
    $select="SELECT * FROM sign_up WHERE emp_id = '$session_id'";
    $select_run=mysqli_query($con,$select);
    $count=mysqli_num_rows($select_run);
    if($count > 0){

        $row = mysqli_fetch_array($select_run);
        $image = $row['image'];
        $del = unlink("image/$image");
       if($del){
    $query_update="update sign_up set first_name='$first_name',last_name='$last_name',email='$email',cell='$cell',image='$img_name',address='$address' where emp_id = '$session_id'";
    $run_update = mysqli_query($con,$query_update);
    if($run_update){
          
          move_uploaded_file($temp_img,"image/$img_name");
          echo "<script> window.open('User_Info.php','_self'); </script>";
          ?>
    <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   Credential Updated successfully.
</div>
    <?php
    }
 }
}
    else{

        ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   Credential falied to update.
</div>

        <?php
    }
}
}
?>

</div>
</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
<?php 
}
?>
