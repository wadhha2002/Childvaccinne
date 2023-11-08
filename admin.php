<?php
session_start();

if ($_SESSION['role'] !== 'admin') {
    // If a non-admin tries to access the admin dashboard, redirect them to an error page or the login page.
    header("Location: login.php");
    exit();
    
}

// Admin-specific dashboard content and functionality here.
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, Admin!</h1>
    <!-- Admin-specific content goes here -->
</body>
</html>
