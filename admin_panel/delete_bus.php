<?php
session_start();
include("config/connection.php");
$_SESSION['delete_bus'] = "Data delete successfully";
$id = $_GET['id'];
$delete = "delete from bus_info where id='$id'";
$run = mysqli_query($connection, $delete);
if($run==true){
	header("location:view_bus.php");
}
?>