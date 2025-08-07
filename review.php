<?php
session_start();
include 'db.php'; // Include database connection

$product_id = $_GET['product_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO reviews (product_id, user_id, rating, review) VALUES ('$product_id', '$user_id', '$rating', '$review')";
    if (mysqli_query($conn, $sql)) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Review</title>
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="register.html">Register</a>
        <a href="login.html">Login</a>
        <a href="product_view.php">View Products</a>
        <?php if (isset($_SESSION['user_id'])) { ?>
            <a href="product_upload.html">Upload Product</a>
            <a href="cart.php">Cart</a>
            <a href="profile.php">My Profile</a>
            <a href="logout.php">Logout</a>
        <?php } ?>
    </nav>

    <div class="container">
        <h2>Submit Review</h2>
        <form action="review.php?product_id=<?php echo $product_id; ?>" method="post">
            Rating: <input type="number" name="rating" min="1" max="5" required><br>
            Review: <textarea name="review" required></textarea><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
