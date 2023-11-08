<?php
session_start();
require_once("config/database.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $name = $description = $price = "";

    // Validate and sanitize input data
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $price = trim($_POST["price"]);

    // Check if all required fields are not empty
    if (!empty($name) && !empty($price)) {
        // Prepare an INSERT statement
        $sql = "INSERT INTO products (name, description, price) VALUES (:name, :description, :price)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind parameters
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":price", $price, PDO::PARAM_STR);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to the product list page after successful insertion
                header("location: success.php");
                exit();
            } else {
                echo "Error: Unable to execute the query.";
            }
        }

        // Close the statement
        unset($stmt);
    } else {
        echo "Name and price fields are required.";
    }
}


if (isset($_POST["save"])) {
    // Your existing code for inserting a new record goes here (as shown in the previous response).
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>CHILD VACINATION MANAGEMENT SYSTEM</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>DOCTOR</h1>
        </div>
    <!-- html form to create product will be here -->
    </div> <!-- end .container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
<!-- PHP insert code will be here -->
<!-- html form here where the product information will be entered -->
<form method="post">    <table class='table table-hover table-responsive table-bordered'>
            <td>Id</td>
            <td><input type='int' name='name' class='form-control' /></td>
            <td>CHILD NAME</td>
            <td><input type='text' CHILD NAME='name' class='form-control' /></td>

            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
            <td>Month</td>
            <td><input type='text' name='price' class='form-control' />
        </td>
        <tr>
            <td></td>
            <td>
                <trait>
            <button type="submit" class='btn btn-primary' name='save'>Save</button>
                <a href='index.php' class='btn btn-danger'>Back to read products</a>
</trait>
            </td>
        </tr>
    </table>
</form>

<?php
// Include database connection and other necessary code

// Fetch and display product data in an HTML table
$sql = "SELECT * FROM products";
$result = $pdo->query($sql);

if ($result->rowCount() > 0) {
    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th></tr>";

    // Assuming you are fetching data from the database and iterating through the rows in a loop
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td><a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a></td>"; // Edit button
        echo "<td><a href='deleted.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a></td>"; // Delete button
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No products found.";
}
?>
<style>
body {
    background-color: #f8f9fa;
    padding-top: 50px;
}

.container {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
    padding: 40px;
}

.page-header h1 {
    color: #007bff;
}

table {
    margin-top: 30px;
    width: 100%;
    border-collapse: collapse;
}

th, td {
    text-align: center;
    padding: 12px;
    border-bottom: 1px solid #dee2e6;
}

th {
    background-color: #007bff;
    color: white;
}

.btn-primary, .btn-danger {
    margin-right: 10px;
}

.form-control {
    width: 100%;
    margin-bottom: 15px;
}

textarea.form-control {
    height: 100px;
}

.btn-group {
    margin-top: 15px;
}


</style>