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
<li><a href="dwn_rost.php">Download Roaster</a></li>
<li><a href="leave_req.php">Leave Request</a></li>
<li><a href="swap_req.php">Swap Request</a></li>
<li><a href="ask_us.php">Ask Us</a></li>
</ul>
</div>
</nav>
<div class="col-sm-3">
<div class="panel panel-default">
<div class="panel-heading">Profile (User)</div>
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
            <a href="personal_info.php"><img src="../admin/image/<?php echo $image; ?>" class="thumbnail" width="100%" height="70px"></a>
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
<div class="panel-heading">Personal Information</div>
<div class="panel-body">
<div class="col-sm-8">
	<?php
	include("../db/connection.php");
	$query = "SELECT * FROM sign_up WHERE email = '$email'";
	$run = mysqli_query($con,$query);
	$count=mysqli_num_rows($run);
   
    $row = mysqli_fetch_array($run);
    $emp_id = $row['emp_id'];
	$f_name = $row['first_name'];
	$l_name = $row['last_name'];
	$img = $row['image'];
	$email = $row['email'];
	$date = $row['reg_date'];
	$address = $row['address'];
	$mobile = $row['cell'];
	?>
	<h3 style="color: #6699ff;"><b>Employee ID</b></h3>
	<b style="margin-left: 150px;"> <?php echo $emp_id; ?> </b>
	<h3 style="color: #6699ff;"><b>First Name</b></h3>
	<b style="margin-left: 150px;"> <?php echo $f_name; ?> </b>
	<h3 style="color: #6699ff;"><b>Last Name</b></h3>
	<b style="margin-left: 150px;"> <?php echo $l_name; ?> </b>
	<h3 style="color: #6699ff;"><b>Image</b></h3>
	<img style="height: 220px; margin-left: 150px; border: 1px solid #6699ff; border-radius: 10px;" src="../admin/image/<?php echo $img; ?>">
	<h3 style="color: #6699ff;"><b>Email</b></h3>
	<b style="margin-left: 150px;"> <?php echo $email; ?> </b>
	<h3 style="color: #6699ff;"><b>Join Date</b></h3>
	<b style="margin-left: 150px;"> <?php echo $date; ?> </b>
	<h3 style="color: #6699ff;"><b>Address</b></h3>
	<b style="margin-left: 150px;"> <?php echo $address; ?> </b>
	<h3 style="color: #6699ff;"><b>Cell#</b></h3>
	<b style="margin-left: 150px;"> <?php echo $mobile; ?> </b>
<?php

?>
</div>

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