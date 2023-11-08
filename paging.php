<?php
// Database connection details
$host = "localhost";
$db_name = "childvaccine";
$username = "root";
$password = "";

try {
    // Create a PDO instance
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);

    // Set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Example 1: Insert a new record
    $insert_query = "INSERT INTO your_table_name (column1, column2, column3) VALUES (:value1, :value2, :value3)";
    $insert_statement = $con->prepare($insert_query);

    $value1 = "New Value 1";
    $value2 = "New Value 2";
    $value3 = "New Value 3";

    $insert_statement->bindParam(':value1', $value1);
    $insert_statement->bindParam(':value2', $value2);
    $insert_statement->bindParam(':value3', $value3);

    $insert_statement->execute();
    echo "New record inserted successfully.";

    // Example 2: Update an existing record
    $update_query = "UPDATE your_table_name SET column1 = :new_value1 WHERE column2 = :search_value";
    $update_statement = $con->prepare($update_query);

    $new_value1 = "Updated Value 1";
    $search_value = "Search Value";

    $update_statement->bindParam(':new_value1', $new_value1);
    $update_statement->bindParam(':search_value', $search_value);

    $update_statement->execute();
    echo "Record updated successfully.";

    // Example 3: Select records
    $select_query = "SELECT * FROM your_table_name WHERE column3 = :filter_value";
    $select_statement = $con->prepare($select_query);

    $filter_value = "Filter Value";

    $select_statement->bindParam(':filter_value', $filter_value);
    $select_statement->execute();

    // Fetch and display the selected records
    while ($row = $select_statement->fetch(PDO::FETCH_ASSOC)) {
        echo "Column1: " . $row['column1'] . "<br>";
        echo "Column2: " . $row['column2'] . "<br>";
        echo "Column3: " . $row['column3'] . "<br>";
        echo "<hr>";
    }
} catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}
// Example 1: Insert a new record
$insert_query = "INSERT INTO products (column1, column2, column3) VALUES (:value1, :value2, :value3)";

// Example 2: Update an existing record
$update_query = "UPDATE products SET column1 = :new_value1 WHERE column2 = :search_value";

// Example 3: Select records
$select_query = "SELECT * FROM products WHERE column3 = :filter_value";

?>
