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
<div class="panel-heading">Leave View</div>
<div class="panel-body">
<div class="col-sm-12 table-responsive"><br>
<form class="form-horizontal" action="leave_data.php" method="post">
<?php 
include("../db/connection.php");
       $emp_id = $_GET['lve'];
       $query = "SELECT * FROM leaves WHERE emp_id = $emp_id";
       $run = mysqli_query($con,$query);
while($row = mysqli_fetch_array($run)){
       
       $emp_id = $row['emp_id'];
       $name = $row['name'];
       $frm_date = $row['frm_dte'];
       $to_date = $row['to_dte'];
       $type = $row['lve_type'];
       $reason = $row['reason'];
       ?>
<div class="form-group">
<label for="Emp_ID" class="col-sm-5 control-label">Employee ID</label>
<div class="col-sm-5">
<input type="text" class="form-control" name="emp_id" value="<?php echo $emp_id; ?>" placeholder="Employee ID" readonly required="required">
</div>
</div>
<div class="form-group">
<label for="name" class="col-sm-5 control-label">Name</label>
<div class="col-sm-5">
<input type="text" class="form-control" name="EMP_NAME" placeholder="Employee Name" value="<?php echo $name; ?>" required="required" disabled>
</div>
</div>
<div class="form-group">
<label for="date" class="col-sm-5 control-label">From</label>
<div class="col-sm-5">
<input type="date" class="form-control" name="frm_date" placeholder="Date" value="<?php echo $frm_date; ?>" required="required" readonly>
</div>
</div>

<div class="form-group">
<label for="date" class="col-sm-5 control-label">To</label>
<div class="col-sm-5">
<input type="date" class="form-control" name="to_date" placeholder="Date" value="<?php echo $to_date; ?>" required="required" disabled>
</div>
</div>

<div class="form-group">
<label for="type" class="col-sm-5 control-label">Leave Type</label>
<div class="col-sm-5">
<input type="text" class="form-control" name="lve_type" placeholder="Leave Type" value="<?php echo $type; ?>" required="required" disabled>
</div>
</div>

<div class="form-group">
<label for="reasondate" class="col-sm-5 control-label">Reason</label>
<div class="col-sm-5">
<textarea rows="10" cols="50" class="form-control" name="reason" required disabled><?php echo $reason; ?></textarea>
</div>
</div>

<?php
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
<?php 
}
?>