<?php
session_start();
include 'db.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get the cart item ID to be removed
$cart_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($cart_id > 0) {
    // Delete the product from the cart table
    $sql = "DELETE FROM cart WHERE id = $cart_id AND user_id = " . $_SESSION['user_id'];
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the cart page
        header('Location: cart.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
