<?php
include("config/connection.php");
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['submit']))
{
    $email = $_POST['email'];

    $otp = rand(100000,999999);

    $created_at = date("Y-m-d H:i:s");
    $expire_at = date("Y-m-d H:i:s",strtotime("+5 minutes"));

    $sql = "INSERT INTO OTP_table (email,otp,created_at,expire_at)
            VALUES ('$email','$otp','$created_at','$expire_at')";

    $run = mysqli_query($connection,$sql);

    if($run == true)
    {
        $_SESSION['email'] = $email;

        $mail = new PHPMailer(true);

        try{
            // 🔥 SMTP CONFIG
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            $mail->Username = 'nakki831@gmail.com';
            $mail->Password = 'azzugokkqaoqmiuv'; // App Password (no space)

            // 👉 TRY SSL FIRST
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // 🔥 DEBUG MODE (IMPORTANT)
            $mail->SMTPDebug = 3; // 0=off, 1=client, 2=client+server, 3=full detail
            $mail->Debugoutput = function($str, $level) {
                echo "<pre>DEBUG LEVEL $level: $str</pre>";
            };

            // 🔥 EMAIL CONTENT
            $mail->setFrom('nakki831@gmail.com','OTP Verification');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Your OTP Code';

            $mail->Body = "
            <h2>OTP Verification</h2>
            <p>Your OTP is:</p>
            <h1 style='color:blue;'>$otp</h1>
            <p>This OTP is valid for 5 minutes.</p>
            ";

            // 🔥 SEND
            if($mail->send()){
                echo "<h3 style='color:green;'>✅ Mail Sent Successfully</h3>";
                header("refresh:2;url=otp_varify.php");
            } else {
                echo "<h3 style='color:red;'>❌ Mail Not Sent</h3>";
            }

        } catch (Exception $e){
            echo "<h3 style='color:red;'>❌ Mailer Error:</h3>";
            echo "<pre>".$mail->ErrorInfo."</pre>";
        }
    }
    else{
        echo "<h3 style='color:red;'>❌ Database Insert Failed</h3>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Test Mail Debug</title>
</head>
<body>

<form method="post">
    <input type="email" name="email" placeholder="Enter Email" required>
    <button type="submit" name="submit">Send OTP</button>
</form>

</body>
</html>