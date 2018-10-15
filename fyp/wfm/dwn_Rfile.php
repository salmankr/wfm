<?php 
include("../db/connection.php");
if(isset($_GET['id'])){

	$id = $_GET['id'];
    $query = "SELECT * FROM upload_report WHERE id = '$id'";
    $run = mysqli_query($con,$query);
    while($row = mysqli_fetch_array($run)){

    	 $file_name = $row['file'];
    	 header("Content-Disposition: attachment; filename=$file_name");
    	 header("Content-Type: file/pdf/wps");
    	 readfile("upload-server/reports/$file_name");
    }
}
?>