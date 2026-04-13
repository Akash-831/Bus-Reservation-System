<?php
include("config/connection.php");
date_default_timezone_set('Asia/Kolkata');
session_start();
if(isset($_POST['submit'])){
    $email = $_SESSION['email'];
    $otp = $_POST['otp'];
   $select = "SELECT * FROM otp_table WHERE email='$email' AND otp='$otp' ORDER BY id DESC LIMIT 1";
    $run = mysqli_query($connection, $select);
    if(mysqli_num_rows($run)>0){
        header("location:change_pass.php");
    }else{
        echo "<script>
alert('OTP does not match');
        </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Auth - OTP</title>
    <link href="https://fonts.googleapis.com" rel="stylesheet">
    <style>
        :root {
            --bg: #0f1113;
            --glass: rgba(255, 255, 255, 0.03);
            --accent: #d4af37; /* Muted Luxury Gold */
            --text: #e0e0e0;
        }

        * { box-sizing: border-box; font-family: 'Space Grotesk', sans-serif; }

        body {
            margin: 0; padding: 0; display: flex; justify-content: center; align-items: center;
            height: 100vh; background-color: var(--bg); overflow: hidden;
        }

        /* Creative Character: The Guardian Eye */
        .character-box {
            position: absolute; top: 15%; width: 80px; height: 80px;
            background: #1a1d21; border-radius: 50%;
            border: 2px solid var(--accent); box-shadow: 0 0 20px rgba(212, 175, 55, 0.2);
            display: flex; justify-content: center; align-items: center;
            animation: float 4s ease-in-out infinite;
        }
        .eye {
            width: 30px; height: 30px; background: var(--accent); border-radius: 50%;
            position: relative; animation: blink 3s infinite;
        }
        .eye::after {
            content: ''; position: absolute; top: 5px; left: 5px;
            width: 10px; height: 10px; background: white; border-radius: 50%;
        }

        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }
        @keyframes blink { 0%, 90%, 100% { transform: scaleY(1); } 95% { transform: scaleY(0); } }

        /* The Frosted Glass Form */
        .otp-card {
            background: var(--glass);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            padding: 60px 40px;
            border-radius: 40px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            width: 100%; max-width: 400px; text-align: center;
            box-shadow: 0 40px 100px rgba(0,0,0,0.6);
            z-index: 10;
        }

        h2 { color: var(--text); font-size: 24px; font-weight: 700; margin-bottom: 10px; letter-spacing: 1px; }
        p { color: #888; font-size: 14px; margin-bottom: 40px; line-height: 1.6; }

        /* Creative Input Fields */
        .otp-input-container {
            display: flex; justify-content: space-between; gap: 10px; margin-bottom: 40px;
        }

        /* Note: Your PHP logic uses one input, so we use a styled single input that looks like multiple boxes */
        .otp-field {
            width: 100%; height: 70px; background: rgba(0,0,0,0.2);
            border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 15px;
            font-size: 32px; font-weight: 700; color: var(--accent);
            text-align: center; letter-spacing: 15px; outline: none; transition: 0.3s;
        }

        .otp-field:focus {
            border-color: var(--accent); background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 25px rgba(212, 175, 55, 0.1);
        }

        /* Button Design */
        .btn-verify {
            width: 100%; padding: 18px; background: var(--accent); color: #000;
            border: none; border-radius: 15px; font-size: 15px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 2px; cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-verify:hover {
            transform: scale(1.03); background: #f1c40f; box-shadow: 0 15px 30px rgba(212, 175, 55, 0.3);
        }

        .footer { margin-top: 30px; font-size: 12px; color: #666; }
        .footer a { color: var(--accent); text-decoration: none; font-weight: 600; }

        /* Subtle Background Gradients */
        .bg-glow {
            position: absolute; width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.05) 0%, transparent 70%);
            z-index: 1; filter: blur(50px);
        }
    </style>
</head>
<body>

    <div class="bg-glow" style="top: 0; left: 0;"></div>
    <div class="bg-glow" style="bottom: 0; right: 0;"></div>

    <!-- Character Animation -->
    <div class="character-box">
        <div class="eye"></div>
    </div>

    <div class="otp-card">
        <h2>Enter Passcode</h2>
        <p>A secure 6-digit code has been dispatched to your identity. Please authenticate below.</p>
        
        <form method="post">
            <div class="otp-input-container">
                <input type="text" name="otp" class="otp-field" maxlength="6" placeholder="000000" required autocomplete="off">
            </div>
            
            <button type="submit" name="submit" class="btn-verify">Verify Access</button>
        </form>

        <div class="footer">
            Didn't receive the code? <a href="#" type="submit">Request New</a>
        </div>
    </div>

</body>
</html>
