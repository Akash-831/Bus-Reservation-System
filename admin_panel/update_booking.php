<?php
include("config/connection.php");

$id = $_GET['id'];
$status = $_GET['status'];

if($status == 'accept' || $status == 'reject'){

    $update = "UPDATE booking_table SET status='$status' WHERE id='$id'";
    mysqli_query($connection, $update);
}
header("Location: booking_request.php");
exit;
?>