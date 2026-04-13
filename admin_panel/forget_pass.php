<?php
include("config/connection.php");
session_start();
date_default_timezone_set('Asia/Kolkata');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if(isset($_POST['submit']))
{
    $email = $_POST['email'];

    $otp = rand(100000,999999);

    $created_at = date("Y-m-d H:i:s");
    $expire_at = date("Y-m-d H:i:s",strtotime("+5 minutes"));
    

    $sql = "INSERT INTO OTP_table (email,otp,created_at,expire_at)
            VALUES ('$email','$otp','$created_at','$expire_at')";

    $run = mysqli_query($connection,$sql);
     if($run==true)
    {
        $_SESSION['email']=$email;

        $mail = new PHPMailer(true);
        try{

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nakki831@gmail.com';
            $mail->Password = 'azzugokkqaoqmiuv';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('nakki831@gmail.com','OTP Verification');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Your OTP Code';

            $mail->Body = "
            <h2>OTP Verification</h2>
            <p>Your OTP is:</p>
            <h1 style='color:blue;'>$otp</h1>
            <p>This OTP is valid for 5 minutes.</p>
            <br>
            <p>If you did not request this, please ignore this email.</p>
            ";

            $mail->send();

                        header("location:otp_varify.php");

        }
        catch(Exception $e){
            echo "Mailer Error: ".$mail->ErrorInfo;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Premium Look</title>
    <link href="https://fonts.googleapis.com" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Best Gradient: Midnight to Deep Royal Blue */
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            overflow: hidden;
        }
        /* Background Shapes for extra "Wow" factor */
        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            z-index: -1;
        }
        .circle-1 { width: 300px; height: 300px; top: -50px; right: -50px; }
        .circle-2 { width: 200px; height: 200px; bottom: -30px; left: -30px; }

        .card {
            background: rgba(255, 255, 255, 0.95);
            padding: 50px 40px;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 420px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.2);
            transition: transform 0.4s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .icon-box {
            width: 70px;
            height: 70px;
            background: #f0f4ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 30px;
            color: #302b63;
        }
        h2 {
            margin: 0 0 10px;
            color: #1a1a1a;
            font-size: 24px;
            font-weight: 700;
        }
        p {
            color: #666;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .input-group {
            margin-bottom: 25px;
            text-align: left;
        }
        label {
            font-size: 13px;
            font-weight: 600;
            color: #302b63;
            margin-bottom: 8px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        input[type="email"] {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #eee;
            border-radius: 12px;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
            background: #fdfdfd;
        }
        input[type="email"]:focus {
            border-color: #302b63;
            background: #fff;
            box-shadow: 0 0 10px rgba(48, 43, 99, 0.1);
        }
        button {
            width: 100%;
            padding: 16px;
            background: #302b63;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 15px rgba(48, 43, 99, 0.3);
        }
        button:hover {
            background: #1a1a2e;
            box-shadow: 0 12px 20px rgba(48, 43, 99, 0.4);
            transform: scale(1.02);
        }
        .footer-text {
            margin-top: 25px;
            font-size: 14px;
        }
        .footer-text a {
            color: #302b63;
            text-decoration: none;
            font-weight: 600;
        }
        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Background Shapes -->
    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>

    <div class="card">
        <div class="icon-box">✉️</div>
        <h2>Reset Password</h2>
        <p>Enter your email address below and we'll send you a secure OTP code.</p>
        
        <form method="post">
            <div class="input-group">
                <label>Registered Email</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <button type="submit" name="submit">Send OTP</button>
        </form>

        <div class="footer-text">
            Remember your password? <a href="login.php">Log In</a>
        </div>
    </div>

</body>
</html>
