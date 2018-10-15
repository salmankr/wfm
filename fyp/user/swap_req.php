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
<div class="panel-heading">Swap</div>
<div class="panel-body">

<?php 
include("../db/connection.php");
$query = "select * from sign_up where email = '$email'";
$run = mysqli_query($con,$query);
while($row = mysqli_fetch_array($run)){

    $emp_id = $row['emp_id'];
	$emp_name = $row['first_name'];
	?>
	<form class="form-horizontal" action="swap_req.php" method="post" enctype="multipart/form-data">
	<div class="form-group form-group-sm">
	<div class="col-sm-6">
<h3 style="text-align: center; color: #6699ff; "><b>First Agent</b></h3>

<div class="form-group">
<label for="f_emp" class="col-sm-3 control-label">Employee ID</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="f_emp" placeholder="ID" value="<?php echo $emp_id; ?>" readonly required="required">
</div>
</div>


<div class="form-group">
<label for="f_name" class="col-sm-3 control-label">Name</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="f_name" placeholder="Name" value="<?php echo $emp_name; ?>" readonly required="required">
</div>
</div>

<div class="form-group">
<label for="f_sup" class="col-sm-3 control-label">Supervisor</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="f_sup" placeholder="Name" required="required">
</div>
</div>

<div class="form-group">
<label for="date" class="col-sm-3 control-label">Date</label>
<div class="col-sm-6">
<input type="date" class="form-control" name="swp_date" placeholder="Date" required="required">
</div>
</div>
</div>

<div class="col-sm-6">
<h3 style="text-align: center; color: #6699ff; "><b>Second Agent</b></h3>
<div class="form-group">
<label for="s_emp" class="col-sm-3 control-label">Employee ID</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="s_emp" placeholder="ID" required="required">
</div>
</div>

<div class="form-group">
<label for="s_name" class="col-sm-3 control-label">Name</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="s_name" placeholder="Name" required="required">
</div>
</div>

<div class="form-group">
<label for="s_sup" class="col-sm-3 control-label">Supervisor</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="s_sup" placeholder="Name" required="required">
</div>
</div>
</div>
</form>
<?php
}
?>
<div class="col-sm-offset-5 col-sm-6">
<button type="submit" name="swap_req"  class="btn btn-default">Apply Swap</button>
</div> 
<?php
include_once("../db/connection.php");
if(isset($_POST['swap_req'])){
	$f_emp = $_POST['f_emp'];
	$f_name = $_POST['f_name'];
	$f_sup = $_POST['f_sup'];
	$date = $_POST['swp_date'];
	$s_emp = $_POST['s_emp'];
	$s_name = $_POST['s_name'];
	$s_sup = $_POST['s_sup'];
	$query = "INSERT INTO swap (emp_id1,name1,supervisor1,swp_date,emp_id2,name2,supervisor2) VALUES 
	     ('$f_emp','$f_name','$f_sup','$date','$s_emp','$s_name','$s_sup')";
	       $run = mysqli_query($con,$query);
        if($run){
      ?>
      <div class="col-sm-12" style="text-align: center;"><br><b style="padding-right: 40px;"> Success! Your Swap Request Dated <?php echo $date; ?> has been sent to WorkForce</b></div>
      <?php
        	  }
		else{
		    
			echo "<b>Failed to forward.</b>";
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