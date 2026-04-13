<?php
include("config/connection.php");
session_start();
if(isset($_POST['submit'])){
	$_SESSION['pass_chang'] = "password change successfully";
	$email = $_SESSION['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$update = "update user_signup set password='$password', confirm_password='$confirm_password' where email='$email'";
	$run = mysqli_query($connection, $update);
	if($run==true){
		header("location:login.php");
	}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

        body {
        	overflow: hidden;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .form-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 350px;
            text-align: center;
            animation: fadeIn 0.8s ease-out;
        }

        h2 { color: white; margin-bottom: 25px; font-weight: 500; }

        .input-group { position: relative; margin-bottom: 20px; }

        input {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.15);
            border: none;
            outline: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        input::placeholder { color: rgba(255, 255, 255, 0.7); }

        /* Input Focus Animation */
        input:focus {
            background: rgba(255, 255, 255, 0.25);
            border-color: #fff;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #fff;
            color: #764ba2;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Button Hover & Active Animation */
        button:hover {
            background: #f0f0f0;
            transform: scale(1.03);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }

        button:active { transform: scale(0.98); }

        /* Keyframes for Fade In */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Update Password</h2>
    <form method="post">
        <div class="input-group">
            <input type="password" name="password" placeholder="New Password" required>
        </div>
        <div class="input-group">
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        </div>
        <button type="submit" name="submit">Change Password</button>
    </form>
</div>

</body>
</html>
