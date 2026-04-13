<?php
include("config/connection.php");
$id = $_GET['id'];
$delete = "delete from driver where id='$id'";
$run = mysqli_query($connection, $delete);
if($run==true){
	header("location:view_driver.php");
}
?>