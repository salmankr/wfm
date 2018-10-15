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
<div class="panel-heading">Employee Registration Form</div>
<div class="panel-body">
<form class="form-horizontal" action="sign_up.php" method="post" enctype="multipart/form-data">
<?php
include_once("../db/connection.php");
if(isset($_POST['registration'])){

    $emp_id=$_POST['Emp_ID'];
    $first_name=$_POST['first_Name'];
    $last_name=$_POST['Last_Name'];
    $email=$_POST['Email'];
    $cell=$_POST['Cell'];
    $password=$_POST['Password'];
    $cnfrm_pass=$_POST['Cnfrm_pass'];
    $img_name=$_FILES['img']['name'];
    $temp_img=$_FILES['img']['tmp_name'];
    $address=$_POST['address'];
    $join_date=$_POST['Join_date'];
    $login_type=$_POST['sel'];
    $date=date('m/y/d');
    if($cnfrm_pass != $password){
?>
        <div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Password Not Match
</div>

        <?php
      
    }
    else{
    $select="SELECT * FROM sign_up WHERE email='$email'";
    $select_run=mysqli_query($con,$select);
    $count=mysqli_num_rows($select_run);
    if($count > 0){

?>
    	<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   User is Alredy registered.
</div>

    	<?php

    }
    else{
    $query = "INSERT INTO sign_up (emp_id,first_name,last_name,email,pass,confirm_pass,image,create_date,reg_date,address,cell,user_type) VALUES ('$emp_id','$first_name','$last_name','$email','$password','$cnfrm_pass','$img_name','$date','$join_date','$address','$cell','$login_type')";
    
    $run=mysqli_query($con,$query);
    if($run){
    move_uploaded_file($temp_img,"image/$img_name");
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   Credential created successfully.
</div>
    <?php

    }
    else
    {
    	?>
    	<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   Credential not created.
</div>

    	<?php

    }}
}
    	
}
?>
<div class="form-group">
<label for="Emp_ID" class="col-sm-3 control-label">Employee ID</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Emp_ID" placeholder="Employee ID" required="required">
</div>
</div>

<div class="form-group">
<label for="1st_Name" class="col-sm-3 control-label">First Name</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="first_Name" placeholder="First Name" required="required">
</div>
</div>

<div class="form-group">
<label for="Last_Name" class="col-sm-3 control-label">Last Name</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Last_Name" placeholder="Last Name" required="required">
</div>
</div>

<div class="form-group">
<label for="Email" class="col-sm-3 control-label">Email</label>
<div class="col-sm-4">
<input type="email" class="form-control" name="Email" placeholder="Email" required="required">
</div>
</div>

<div class="form-group">
<label for="Cell" class="col-sm-3 control-label">Mobile</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Cell" placeholder="Mobile" required="required">
</div>
</div>

<div class="form-group">
<label for="Password" class="col-sm-3 control-label">Password</label>
<div class="col-sm-4">
<input type="password" class="form-control" name="Password" placeholder="Password" required="required">
</div>
</div>

<div class="form-group">
<label for="Cnfrm_pass" class="col-sm-3 control-label">Confirm Password</label>
<div class="col-sm-4">
<input type="password" class="form-control" name="Cnfrm_pass" placeholder="Confirm password" required="required">
</div>
</div>

<div class="form-group">
<label for="img" class="col-sm-3 control-label">Image</label>
<div class="col-sm-4">
<input class="form-control" name="img" type="file" placeholder="Image" required="required" multiple>
</div>
</div>

<div class="form-group">
<label for="address" class="col-sm-3 control-label">Address</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="address" placeholder="Address" required="required">
</div>
</div>

<div class="form-group">
<label for="Join_date" class="col-sm-3 control-label">Join Date</label>
<div class="col-sm-4">
<input type="date" class="form-control" name="Join_date" placeholder="Date" required="required">
</div>
</div>

<div class="form-group">
<label for="Login_type" class="col-sm-3 control-label">Login Type</label>
<div class="col-sm-4">
<select  class="form-control" name="sel" required="required">
<option value="">---</option>
<option value="Admin">Admin</option>
<option value="WFM">WFM</option>
<option value="User">User</option>
</select>
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" name="registration"  class="btn btn-default">Make Credential</button>
</div>
</div>
</form>
</div>  

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