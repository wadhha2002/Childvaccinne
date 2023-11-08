<?php
session_start();
require_once("config/database.php");

// Check if the product ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch the product data from the database
    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $product_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            // Product not found, handle this as needed (e.g., redirect to an error page).
            echo "Product not found.";
            exit();
        }
    } else {
        echo "Error: Unable to fetch product data.";
        exit();
    }

    // Check if the form is submitted to update the product
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and sanitize input data (similar to your create.php file)
        $name = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $price = trim($_POST["price"]);

        // Check if all required fields are not empty
        if (!empty($name) && !empty($price)) {
            // Update the product in the database
            $sql = "UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":price", $price, PDO::PARAM_STR);
            $stmt->bindParam(":id", $product_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Redirect to the product list page after successful update
                header("Location: creat.php");
                exit();
            } else {
                echo "Error: Unable to update the product.";
            }
        } else {
            echo "Name and price fields are required.";
        }
    }
} else {
    // If no product ID is provided, handle this as needed (e.g., redirect to an error page).
    echo "Invalid product ID.";
    exit();
}
?>
<!-- HTML form for editing the product -->
<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Edit Product</h1>
        </div>

        <form method="post">
            <table class="table table-hover table-responsive table-bordered">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>" /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="description" class="form-control"><?php echo $product['description']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="text" name="price" class="form-control" value="<?php echo $product['price']; ?>" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                        <a href="index.php" class="btn btn-danger">Cancel</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
