
<?php
// Database configuration
$host = "localhost"; // Change this to your database host
$dbname = "childvaccine"; // Change this to your database name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set PDO attributes (optional)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    die("Error: Database connection failed. " . $e->getMessage());
}
?>

