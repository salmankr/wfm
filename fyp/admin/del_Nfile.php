<?php 
include("../db/connection.php");
if(isset($_GET['id'])){

	$id = $_GET['id'];
    $query = "DELETE FROM news_feed WHERE id='$id'";
    $run = mysqli_query($con,$query);
    if($run){

    	echo "<script> window.open('delete_news.php?del=News update have been removed.','_self'); </script>";
    }
}
?>