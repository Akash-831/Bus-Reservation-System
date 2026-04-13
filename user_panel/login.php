<?php
include("config/connection.php");
date_default_timezone_set('Asia/Kolkata');
session_start();
if(isset($_SESSION['signup'])){
	echo "<script>
alert('".$_SESSION['signup']."');
	</script>";
	unset($_SESSION['signup']);
}
if(isset($_SESSION['pass_chang'])){
	echo "<script>
alert('".$_SESSION['pass_chang']."');
	</script>";
	unset($_SESSION['pass_chang']);
}
if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$select = "select * from user_signup where email='$email' and password='$password'";
	$run = mysqli_query($connection, $select);
	$array = mysqli_fetch_array($run);
	 if(mysqli_num_rows($run) > 0){
        $_SESSION['email_id'] = $array['email'];
        $_SESSION['user_contact'] = $array['contact'];
        $_SESSION['user_name'] = $array['name'];
        $_SESSION['user_id'] = $array['id'];
        $user_id = $array['id'];
        $name = $array['name'];
        $email = $array['email'];
        $login_date = date("d M Y");
$login_time = date(" h:i A");
        $insert = "insert into login_history(user_id, name, email, login_date, login_time)
        values('$user_id','$name','$email','$login_date','$login_time')";
        $run_insert = mysqli_query($connection, $insert);
        header("Location: index.php");
        exit; // Always exit after header redirect
    }else{
        // Alert for invalid credentials
        echo "<script>alert('Password does not match');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Professional Login Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<style>
/* ===== Body ===== */
body {
	overflow: hidden;
    margin: 0;
    height: 100vh;
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
}

/* ===== Login Form Card ===== */
.login-card {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 50px 35px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    color: #fff;
}

/* ===== Form Floating Inputs ===== */
.form-floating > .form-control {
    background: rgba(255,255,255,0.15);
    border: none;
    border-radius: 12px;
    color: #fff;
    padding: 14px 18px;
}
.form-floating > .form-control:focus {
    background: rgba(255,255,255,0.25);
    box-shadow: 0 0 10px rgba(255,255,255,0.5);
    color: #fff;
}
.form-floating > label {
    color: #ddd;
    font-weight: 500;
}

/* ===== Login Button ===== */
.btn-login {
    width: 100%;
    padding: 14px;
    margin-top: 20px;
    font-weight: 600;
    border-radius: 15px;
    border: none;
    background: linear-gradient(135deg,#6a11cb,#2575fc);
    color: #fff;
    font-size: 16px;
    letter-spacing: 1px;
    transition: 0.3s;
}
.btn-login:hover {
    transform: scale(1.03);
    box-shadow: 0 8px 25px rgba(255,255,255,0.3);
}

/* ===== Links ===== */
.links {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    margin-top: 15px;
}
.links a {
    color: #fff;
    text-decoration: none;
}
.links a:hover {
    text-decoration: underline;
}

/* ===== Signup Link ===== */
.signup-link {
    text-align: center;
    margin-top: 25px;
}
.signup-link a {
    color: #fff;
    font-weight: 600;
    text-decoration: underline;
}

/* ===== Remember Me ===== */
.form-check-label {
    color: #fff;
    font-weight: 500;
}

/* ===== Responsive ===== */
@media (max-width: 500px) {
    .login-card {
        padding: 35px 20px;
    }
}
</style>
</head>
<body>

<div class="login-card">

    <form method="post">
        <!-- Email Input -->
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
            <label for="email"><i class="bi bi-envelope"></i> Email</label>
        </div>

        <!-- Password Input -->
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
            <label for="password"><i class="bi bi-lock"></i> Password</label>
        </div>

        <!-- Links -->
        <div class="d-flex justify-content-between align-items-center links">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
            <a href="forget_pass.php">Forgot Password?</a>
        </div>

        <!-- Login Button -->
        <button type="submit" name="submit"class="btn btn-login">Login</button>

        <!-- Signup Link -->
        <div class="signup-link">
            Don't have an account? <a href="signup.php">Sign Up</a>
        </div>
    </form>

</div>

</body>
</html>