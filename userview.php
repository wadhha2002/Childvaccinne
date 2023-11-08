
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<h2>User Side Childvaccine Record</h2>
<?php
// Include database connection and other necessary code
session_start();
require_once("config/database.php");
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
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No products found.";
}
?>
<a href="loginn.php">
<button type="button">Go back</button>
</a>
<style>
/* styles.css */
table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

</style>
