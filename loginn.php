<?php
session_start();
require_once("config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    // Query to check if the username and password exist in the database
    $query = "SELECT * FROM main WHERE Username=:username AND Password=:password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $enteredUsername);
    $stmt->bindParam(':password', $enteredPassword);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        // Authentication successful
        // Redirect the user to the desired page
        header("Location: creat.php");
        //exit();
    } else {
        // Authentication failed
        echo "Invalid username or password. Please try again.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form id="login-form" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </div>
            <div class="input-group">
                <a href="forgot-password.php">Forgot Password?</a>
            </div>
            <div class="input-group">
                <a href="userview.php">
                   <button type="button">Login as user</button>
                </a>
                <!-- <a href="creat.php">
                     <button type="button">Login as admin</button>
                </a> -->

                <button type="submit">Login as admin</button>

                <a href="doctor.php">
                     <button type="button">Login as doctor</button>
                </a>
            </div>
        </form>
        <div class="input-group">
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>
</body>
</html>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-container {
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    text-align: center;
    background: linear-gradient(to bottom, #3498db, #2980b9);
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

.input-group {
    margin: 10px 0;
}

label {
    display: block;
    font-weight: bold;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="checkbox"] {
    margin-right: 5px;
}

button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 21px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
}
</style>


