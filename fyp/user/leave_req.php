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
<div class="panel-heading">Leaves Request</div>
<div class="panel-body">
<div class="col-sm-9">
<?php 
include("../db/connection.php");
$query = "select * from sign_up where email = '$email'";
$run = mysqli_query($con,$query);
while($row = mysqli_fetch_array($run)){

    $emp_id = $row['emp_id'];
	$emp_name = $row['first_name'];
	?>
<form class="form-horizontal" action="leave_req.php" method="post">
<div class="form-group">
<label for="Emp_ID" class="col-sm-5 control-label">Employee ID</label>
<div class="col-sm-5">
<input type="text" class="form-control" name="emp_id" value="<?php echo $emp_id; ?>" placeholder="Employee ID" readonly required="required">
</div>
</div>
<div class="form-group">
<label for="name" class="col-sm-5 control-label">Name</label>
<div class="col-sm-5">
<input type="text" class="form-control" name="emp_name" value="<?php echo $emp_name; ?>" placeholder="Employee Name" readonly required="required">
</div>
</div>
<div class="form-group">
<label for="date" class="col-sm-5 control-label">From</label>
<div class="col-sm-5">
<input type="date" class="form-control" name="frm_date" placeholder="Date" required="required">
</div>
</div>

<div class="form-group">
<label for="date" class="col-sm-5 control-label">To</label>
<div class="col-sm-5">
<input type="date" class="form-control" name="to_date" placeholder="Date" required="required">
</div>
</div>

<div class="form-group">
<label for="type" class="col-sm-5 control-label">Leave Type</label>
<div class="col-sm-5">
<select  class="form-control" name="lve_type">
<option>---</option>
<option>Annual</option>
<option>Casual/Sick</option>
<option></option>
</select>
</div>
</div>

<div class="form-group">
<label for="reasondate" class="col-sm-5 control-label">Reason</label>
<div class="col-sm-5">
<textarea rows="10" cols="50" class="form-control" name="reason" required></textarea>
</div>
</div>
<button type="submit" name="leave_btn" class="btn btn-default pull-right">Request</button>
</form>
<?php
}
?>
<?php
include ("../db/connection.php");
    if(isset($_POST['leave_btn'])){
    	$emp_id = $_POST['emp_id'];
    	$emp_name = $_POST['emp_name'];
    	$frm_date = $_POST['frm_date'];
    	$to_date = $_POST['to_date'];
        $type = $_POST['lve_type'];
        $reason = $_POST['reason'];
        $query = "INSERT INTO leaves (emp_id,name,frm_dte,to_dte,lve_type,reason) VALUES ('$emp_id','$emp_name','$frm_date','$to_date','$type','$reason')";
        $run = mysqli_query($con,$query);
        if($run){
        	echo "<b>Success! Your Leave request has been sent to WorkForce</b>";
        }
		else{
		    
			echo "<b>Failed to forward.</b>";
		}
    }
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