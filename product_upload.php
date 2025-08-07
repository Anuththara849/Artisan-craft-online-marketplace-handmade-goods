<?php
session_start();
include 'db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $product_type = $_POST['product_type'];
    $product_price = $_POST['product_price'];
    $product_details = $_POST['product_details'];
    $product_quantity = $_POST['product_quantity'];
    $owner_id = $_SESSION['user_id'];

    // Handling product photos upload
    $product_photos = [];
    foreach ($_FILES['product_photos']['name'] as $key => $name) {
        $photo_path = 'uploads/' . basename($name);
        move_uploaded_file($_FILES['product_photos']['tmp_name'][$key], $photo_path);
        $product_photos[] = $photo_path;
    }
    $product_photos = implode(',', $product_photos);

    $sql = "INSERT INTO products (name, type, price, details, quantity, photos, owner_id)
            VALUES ('$product_name', '$product_type', '$product_price', '$product_details', '$product_quantity', '$product_photos', '$owner_id')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to home page after successful product upload
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
