<?php
session_start();
require_once("config/database.php");

$product = null; // Initialize $product as null

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // Prepare a SELECT statement to fetch product details
    $selectSql = "SELECT * FROM products WHERE id = :id";
    if ($selectStmt = $pdo->prepare($selectSql)) {
        // Bind the parameter
        $selectStmt->bindParam(":id", $id, PDO::PARAM_INT);

        // Attempt to execute the SELECT statement
        if ($selectStmt->execute()) {
            // Fetch the product details
            $product = $selectStmt->fetch(PDO::FETCH_ASSOC);

            if (!$product) {
                echo "Product not found.";
                exit();
            }
        } else {
            echo "Error: Unable to execute the SELECT query.";
            exit();
        }
    }

    // Close the SELECT statement
    unset($selectStmt);
}

// Check if the "id" parameter is set in the URL
if (isset($_GET["id"])) {
    // Get the ID from the URL and sanitize it
    $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);

    // Prepare a DELETE statement
    $sql = "DELETE FROM products WHERE id = :id";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind the parameter
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to the product list page after successful deletion
            // header("location: creat.php");
            echo("Deleted success...");
            exit();
        } else {
            echo "Error: Unable to execute the query.";
        }
    }

    // Close the statement
    unset($stmt);
}
?>



<!DOCTYPE HTML>
<html>
<head>
    <title>Delete Product - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Delete Product</h1>
        </div>
    </div> <!-- end .container -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>


