<?php 
include("../db/connection.php");
if(isset($_GET['id'])){

	$id = $_GET['id'];
    $query = "DELETE FROM upload_rost WHERE id='$id'";
    $run = mysqli_query($con,$query);
    if($run){

    	echo "<script> window.open('del_rost.php?del=File Has Been Deleted Successful.','_self'); </script>";
    }
}
?>