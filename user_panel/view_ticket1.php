<?php
$conn = mysqli_connect("localhost","root","","your_db");

$id = $_GET['id'];

$query = "SELECT * FROM reservation WHERE id='$id'";
$run = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($run);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Ticket Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">
  <div class="card p-4 bg-secondary">

    <h3>🎟️ Ticket Details</h3>

    <p><b>Name:</b> <?=$data['user_name']?></p>
    <p><b>Email:</b> <?=$data['email']?></p>
    <p><b>From:</b> <?=$data['from_des']?></p>
    <p><b>To:</b> <?=$data['destination']?></p>
    <p><b>Date:</b> <?=$data['travel_date']?></p>
    <p><b>Price:</b> ₹<?=$data['ticket_price']?></p>
    <p><b>Status:</b> <?=$data['status']?></p>

  </div>
</div>

</body>
</html>