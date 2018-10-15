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
<li> <a class="dropdown dropdown-toggle" data-toggle="dropdown" href="#">Roster</a>
<ul class="dropdown-menu">
<li><a href="upl_rost.php">Upload Roster</a></li>
<li><a href="view_rost.php">View Roster</a></li>
<li><a href="del_rost.php">Delete Roster</a></li>
</ul>
</li>
<li> <a class="dropdown dropdown-toggle" data-toggle="dropdown" href="#">Reports</a>
<ul class="dropdown-menu">
<li><a href="upl_report.php">Upload Report</a></li>
<li><a href="view_report.php">View Report</a></li>
<li><a href="del_report.php">Delete Report</a></li>
</ul>
<li><a href="leave_apr.php">Leaves approval</a></li>
<li><a href="swap_apr.php">Swap Approval</a></li>
</ul>
</div>
</nav>
<div class="col-sm-3">
<div class="panel panel-default">
<div class="panel-heading">Profile (WFM)</div>
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
            <a href="personal_info.php"> <img class="img-thumbnail img-responsive" src="../admin/image/<?php echo $image; ?>" width="100%" height="70px"></a>
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
<div class="panel-heading">Work Station</div>
<div class="panel-body">
<div class="col-sm-5 table-responsive">
<h3 style="font-size: 20px;"><b>Leave Requests</b></h3>
<div class="col-sm-6" style="font-size: 15px; padding: 0px;"><b>Employee ID</b></div>
<div class="col-sm-6" style="font-size: 15px; padding: 0px;"><b>Name</b></div>
<?php
include("../db/connection.php");
    $query = "select * from leaves";
    $run = mysqli_query($con,$query);
    $count = mysqli_num_rows($run);
if($count > 0){
while($row = mysqli_fetch_array($run)){

    $emp_id = $row['emp_id'];
    $name = $row['name'];
?>

<table class="table table-striped">
<tr>
	<td><b><a href="leave_data.php?lve=<?php echo $emp_id ?>"> <?php echo $emp_id; ?></a></b></td>
	<td style="width: 185px;"> <?php echo $name;   ?> </td>
</tr>
</table>
<?php
}
}
else{
	?>

<b style="color: green;">No Leave Request Available!</b>
	<?php
}
?>
</div>  
<div class="col-sm-2"></div>
<div class="col-sm-5 table-responsive">
	<h3 style="font-size: 20px;"><b>Swap Requests</b></h3>
<div class="col-sm-4" style="font-size: 15px; padding-left: 0px; "><b>Employee ID</b></div>
<div class="col-sm-4" style="font-size: 15px; padding-left: 5px; "><b>Name</b></div>
<div class="col-sm-4" style="font-size: 15px; "><b>Date</b></div>
<?php
include("../db/connection.php");
    $query = "SELECT * FROM swap";
    $run = mysqli_query($con,$query);
    $count = mysqli_num_rows($run);
    
if($count > 0){

    while($row = mysqli_fetch_array($run)){
    $f_emp = $row['emp_id1'];
	$f_name = $row['name1'];
	$swp_date = $row['swp_date'];
	$s_emp = $row['emp_id2'];
	$s_name = $row['name2'];
		?>
		<table class="table table-striped">
<tr>
	<td style="width: 119px;"> <?php echo $f_emp; ?> </td>
	<td style="width: 119px;"> <?php echo $f_name;   ?> </td>
	<td> <?php echo $swp_date; ?></td>
</tr>
<tr>
	<td> <?php echo $s_emp; ?> </td>
	<td> <?php echo $s_name;   ?> </td>
	<td> <?php echo $swp_date; ?></td>
</tr><br>
</table>
		<?php
	}
}
	else{
		?>
	<b style="color: green;"> <?php echo "No Pending Swap Request Found!"; ?></b>
	<?php
	}

?>
<b style="color: red;"></b>
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