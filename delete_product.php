<?php
session_start();
include 'db.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Check if the product ID is set
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Delete product
    $sql = "DELETE FROM products WHERE id = $product_id AND owner_id = $user_id";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: manage_products.php');
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header('Location: manage_products.php');
    exit();
}
?>
