<?php
session_start();

if ($_SESSION['role'] !== 'user') {
    // If a non-user tries to access the user dashboard, redirect them to an error page or the login page.
    header("Location: login.php");
    exit();
}
// session_start();

elseif ($_SESSION['role'] === 'user') {
    // Redirect to the user dashboard
    header("Location: user_dashboard.php");
} elseif ($_SESSION['role'] === 'admin') {
    // Redirect to the admin dashboard
    header("Location: admin_dashboard.php");
} else {
    // Handle unauthorized access
    echo "Unauthorized access!";
}

// User-specific dashboard content and functionality here.
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome, User!</h1>
    <!-- User-specific content goes here -->
</body>
</html>
