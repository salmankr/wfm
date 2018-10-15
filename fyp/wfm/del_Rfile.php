<?php 
include("../db/connection.php");
if(isset($_GET['id'])){

	$id = $_GET['id'];
    $query = "DELETE FROM upload_report WHERE id='$id'";
    $run = mysqli_query($con,$query);
    if($run){

    	echo "<script> window.open('del_report.php?del=File Has Been Deleted Successful.','_self'); </script>";
    }
}
?>