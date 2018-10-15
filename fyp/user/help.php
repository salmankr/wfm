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
<div class="panel-heading">help</div>
<div class="panel-body">

<div class="col-sm-6" id="heading">
<h1 style="color: #6699ff;">Latest Articles</h1>
<table class="table table-hover">

<tr><td><a href="https://www.callcentrehelper.com/what-is-workforce-management-57249.htm" target="_blank"><h3>Introduction To system</h3><br></a>
<p>This is the system designed to manage workload inside an organization. Please visit above link to know more!</p></td></tr>

<tr><td><a href="http://www.incontact.com/blog/workforce-management-basics-in-todays-contact-center-environment/" target="_blank"><h3>System Usage in Industry</h3><br></a>
<p>Our system is usually used in those industries which keep running 24/7. But main industry of WFM is BPO. Please visit above link to know more!</p></td></tr>

<tr><td><a href="https://www.callcentrehelper.com/what-is-workforce-management-57249.htm" target="_blank"><h3>Core Features of System</h3><br></a>
<p>Five core features are kept in mind designing this system, but these features could be changed according to requirment. Please visit above link to know more!</p></td></tr>

</table>
</div>

<div class="col-sm-6">
<div class="row" style= "padding-left: 10px; border: 2px dashed #e6e6e6; background: #e6f0ff">
<h3 style="color: #6699ff;">Support</h3>
<b><p>Need more support?</p></b>
<p>You can always contact us on: </p>
<p>Admin's Email Here!</p>
<p>Admin's Contact Here!</p>
<p>Admin's Fax Here!</p> 
</div>
<br>
<div class="row" style= "padding-left: 10px; border: 1px solid #e6e6e6;">
<h3 style="color: #6699ff;">Quick Links</h3>
<table class="table table-hover">
    <tr><td><a href="home.php">Home</a></td></tr>
    <tr><td><a href="dashboard.php">Dashboard</a></td></tr>
    <tr><td><a href="#">FAQs</a></td></tr>
</table>
</div><br>
<div class="row" style= "padding-left: 10px; border: 1px solid #e6e6e6;">
<h3 style="color: #6699ff;">Company policy</h3>
<p>company policy link would be mentioned in above link!</p>
</div>
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