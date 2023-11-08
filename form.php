<?php
// Include database connection and configuration
include 'config/database.php';

// Initialize variables
$name = $description = $price = $image = '';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get product ID from the form
    $id = isset($_POST['id']) ? $_POST['id'] : die('ERROR: Record ID not found.');

    // Validate and sanitize form inputs
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $description = htmlspecialchars(strip_tags($_POST['description']));
    $price = htmlspecialchars(strip_tags($_POST['price']));

    // Check if an image file was uploaded
    if (!empty($_FILES['image']['name'])) {
        // Define a target directory to save uploaded images
        $targetDir = 'uploads/';
        // Generate a unique filename for the uploaded image
        $image = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $image;

        // Check if the file type is allowed (you can customize this)
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        if (!in_array($fileType, $allowedTypes)) {
            die('ERROR: Only JPG, JPEG, PNG, and GIF files are allowed.');
        }

        // Upload the image to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            // Image uploaded successfully
        } else {
            die('ERROR: Failed to upload image.');
        }
    }

    // Update the product record in the database
    error_reporting(E_ALL);
ini_set('display_errors', 1);

    $query = "UPDATE products
              SET name=:name, description=:description, price=:price, image=:image
              WHERE id = :id";

    $stmt = $con->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Record was updated successfully
        header('Location: index.php'); // Redirect to the product listing page
        exit();
    } else {
        die('ERROR: Unable to update record. Please try again.');
    }
}
?>
