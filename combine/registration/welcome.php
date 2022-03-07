<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.Php");
}
?>


<html >
<head>
    <title>PHP login system!- HOME</title>
</head>
<body>
<a href="logout.php">Logout</a>
<a href = "change_password.php" > Change Password</a>

<div class="container mt-4">
    <h3><?php echo "Welcome " . $_SESSION['username'] ?>! You can now use this website</h3>
    <hr>
</div>
</body>
</html>