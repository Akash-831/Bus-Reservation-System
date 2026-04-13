<?php
session_start();

// saare session variables remove karo
session_unset();

// session destroy karo
session_destroy();

// login page pe redirect karo
header("Location: login.php");
exit();
?>