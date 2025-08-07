<?php
session_start();
include 'db.php'; // Include database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_GET['product_id'];

// Check if the product is already in the cart
$sql_check = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
$result_check = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result_check) == 0) {
    $sql = "INSERT INTO cart (user_id, product_id) VALUES ('$user_id', '$product_id')";
    if (mysqli_query($conn, $sql)) {
        header("Location: cart.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Product is already in the cart.";
}

mysqli_close($conn);
?>
