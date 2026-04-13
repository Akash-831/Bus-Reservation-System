<?php
include("config/connection.php");
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['submit'])){
    
    $name             = trim($_POST['name']);
    $contact          = trim($_POST['contact']);
    $email            = trim($_POST['email']);
    $password         = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if email already exists
    $select = "SELECT * FROM user_signup WHERE email='$email' LIMIT 1";
    $run = mysqli_query($connection, $select);

    if(mysqli_num_rows($run) > 0){
        echo "<script>alert('Email already exist');</script>";
    }
    else if($password != $confirm_password){
        echo "<script>alert('Password does not match');</script>";
    }
    else{
        // Premium HTML Email Template
        $mail = new PHPMailer(true);
        
        try{
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'nakki831@gmail.com';
            $mail->Password   = 'azzugokkqaoqmiuv';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            
            // Remove this in production
            $mail->SMTPDebug  = 0;        // Change to 0 after testing

            $mail->setFrom('nakki831@gmail.com', 'BusGo');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = 'Welcome to BusGo - Account Created Successfully';

            // Professional Premium Email Body
            $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <style>
                    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap");
                    body { font-family: "Inter", sans-serif; }
                </style>
            </head>
            <body style="margin:0; padding:0; background:#f4f4f4;">
                <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4; padding:40px 0;">
                    <tr>
                        <td align="center">
                            <table width="600" cellpadding="0" cellspacing="0" style="background:white; border-radius:16px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);">
                                
                                <!-- Header -->
                                <tr>
                                    <td style="background: linear-gradient(135deg, #6b46c1, #9f7aea); padding:40px 30px; text-align:center;">
                                        <h1 style="color:white; margin:0; font-size:28px; font-weight:600;">BusGo</h1>
                                        <p style="color:#e0d4ff; margin:8px 0 0 0; font-size:16px;">Your Journey, Simplified</p>
                                    </td>
                                </tr>
                                
                                <!-- Content -->
                                <tr>
                                    <td style="padding:40px 40px 30px;">
                                        <h2 style="color:#1f2937; margin:0 0 20px 0; font-size:24px;">Welcome aboard, '.$name.'! 👋</h2>
                                        
                                        <p style="color:#4b5563; font-size:16px; line-height:1.6;">
                                            Your account has been successfully created. You are now part of the BusGo family.
                                        </p>
                                        
                                        <div style="background:#f8fafc; border-left:5px solid #7c3aed; padding:15px 20px; margin:25px 0; border-radius:8px;">
                                            <p style="margin:0; color:#374151;">
                                                <strong>Email:</strong> '.$email.'<br>
                                                <strong>Account Created:</strong> '.date("d M, Y h:i A").'
                                            </p>
                                        </div>
                                        
                                        <p style="color:#4b5563; font-size:16px; line-height:1.6;">
                                            You can now login and start booking your bus tickets with ease.
                                        </p>
                                    </td>
                                </tr>
                                
                                <!-- CTA Button -->
                                <tr>
                                    <td align="center" style="padding:0 40px 40px;">
                                        <a href="https://yourwebsite.com/login.php" 
                                           style="background:linear-gradient(135deg, #6b46c1, #9f7aea); color:white; padding:14px 40px; 
                                                  text-decoration:none; border-radius:50px; font-weight:600; font-size:16px; display:inline-block;">
                                            Login to Your Account
                                        </a>
                                    </td>
                                </tr>
                                
                                <!-- Footer -->
                                <tr>
                                    <td style="background:#f8fafc; padding:25px; text-align:center; border-top:1px solid #e5e7eb;">
                                        <p style="color:#6b7280; font-size:13px; margin:0;">
                                            Thank you for choosing BusGo<br>
                                            Safe Travels • Secure Booking
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            </html>';

            $mail->send();

            // Insert into database after successful email
            $insert = "INSERT INTO user_signup(name, contact, email, password, confirm_password) 
                       VALUES('$name','$contact','$email','$password','$confirm_password')";
            
            if(mysqli_query($connection, $insert)){
                $_SESSION['signup'] = "Account created successfully";
                header("location:login.php");
                exit();
            }

        } catch(Exception $e){
            echo "<script>alert('Mailer Error: Unable to send email.');</script>";
            // echo "Mailer Error: " . $mail->ErrorInfo;   // Uncomment only for testing
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register</title>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

/* PROFESSIONAL FIXED GRADIENT */

body{
overflow: hidden;
height:100vh;
display:flex;
align-items:center;
justify-content:center;

/* Soft premium gradient */

background: linear-gradient(135deg,#1e3c72,#2a5298);

}

/* FORM CONTAINER */

.form-container{
width:520px;
}

/* GLASS CARD */

.card{

border:none;
border-radius:20px;

background:rgba(255,255,255,0.12);
backdrop-filter:blur(18px);

box-shadow:0 20px 50px rgba(0,0,0,0.35);

color:white;

}

/* HEADER */

.card-header{

background:transparent;
border:none;
text-align:center;
padding-top:30px;

}

.card-header h4{

font-weight:700;
letter-spacing:1px;

}

.card-header p{
color:#e6e6e6;
}

/* INPUT */

.input-group-text{

background:rgba(255,255,255,0.15);
border:none;
color:white;

}

.form-control{

background:rgba(255,255,255,0.15);
border:none;
color:white;

}

.form-control::placeholder{
color:#eaeaea;
}

.form-control:focus{

background:rgba(255,255,255,0.2);
box-shadow:none;
color:white;

}

/* BUTTON */

.btn-primary{

background:white;
color:#333;
font-weight:600;
border:none;
padding:12px;
transition:0.3s;

}

.btn-primary:hover{

background:black;
color:white;
transform:scale(1.03);

}

/* LINKS */

.links{

display:flex;
justify-content:space-between;
align-items: center;
justify-content: flex-end;
margin-top:15px;

}

.links a{

text-decoration:none;
color:white;
font-size:14px;
font-weight:500;

}

.links a:hover{
text-decoration:underline;
}

/* CHECKBOX */

.form-check-label a{
color:white;
font-weight:600;
text-decoration:underline;
}

</style>

</head>

<body>

<div class="form-container">

<div class="card">

<div class="card-header">

<h4>Create Your Account</h4>
<p class="small">Fill the form to register</p>

</div>

<div class="card-body p-4">

<form method="post">

<div class="row">

<div class="col-md-6 mb-3">

<div class="input-group">

<span class="input-group-text">
<i class="bi bi-person"></i>
</span>

<input type="text" name="name" class="form-control" placeholder="Full Name" required>

</div>

</div>

<div class="col-md-6 mb-3">

<div class="input-group">

<span class="input-group-text">
<i class="bi bi-telephone"></i>
</span>

<input type="text" name="contact" class="form-control" placeholder="Mobile Number" required>

</div>

</div>

</div>

<div class="mb-3">

<div class="input-group">

<span class="input-group-text">
<i class="bi bi-envelope"></i>
</span>

<input type="email" name="email" class="form-control" placeholder="Email Address" required>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<div class="input-group">

<span class="input-group-text">
<i class="bi bi-lock"></i>
</span>

<input type="password" name="password" class="form-control" placeholder="Password" required>

</div>

</div>

<div class="col-md-6 mb-3">

<div class="input-group">

<span class="input-group-text">
<i class="bi bi-shield-lock"></i>
</span>

<input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>

</div>

</div>

</div>

<div class="form-check mb-3">

<input class="form-check-input" type="checkbox" required>

<label class="form-check-label">

I agree to <a href="#">Terms & Conditions</a>

</label>

</div>

<div class="d-grid">

<button type="submit" name="submit" class="btn btn-primary">
Create Account
</button>

</div>

<div class="links">


<a href="login.php">Already have account? Login</a>

</div>

</form>

</div>

</div>

</div>

</body>
</html>
