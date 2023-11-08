<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve user inputs from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Database connection parameters
    $servername = "your_server_name";
    $username = "your_database_username";
    $password_db = "your_database_password";
    $dbname = "child";

    // Create a new database connection
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize user inputs to prevent SQL injection (recommended)
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query the database to check if the user exists
    $sql = "SELECT * FROM child WHERE child_id = '$email' AND child_name = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, display a success message
        echo "Login successful!";
        // Redirect to a different page (e.g., dashboard.php)
        header("Location: dashboard.php");
        exit(); // Ensure that the script stops execution after the redirect
    } else {
        // User does not exist or password is incorrect, display an error message
        echo "Login failed. Please check your credentials.";
    }

    // Close the database connection
    $conn->close();
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CHILD VACCINE MANAGEMENT SYSTEM</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link href="styles.css" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
    <style>
     /* Apply custom styles to the form */
     .images{
      .images {
  background-image: url("th3.jpg");
}

     }
.form-signin {
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}

/* Style the form header */
.form-signin h1 {
    margin-bottom: 20px;
    font-size: 24px;
}

/* Style the form labels and inputs */
.form-floating {
    margin-bottom: 15px;
}

/* Style the "Remember me" checkbox */
.checkbox {
    font-weight: 400;
}

/* Center the copyright notice */
.text-muted {
    text-align: center;
}

/* Style the submit button */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;

}


    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  
  <body class="text-center">
    
<div class="images"></div>

<main class="form-signin w-100 m-auto">
  <form method="POST">

    <img class="mb-4" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="10" height="10">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
  </form>

</main>


    
  </body>