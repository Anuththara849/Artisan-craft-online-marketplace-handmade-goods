<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT DISTINCT sender_id, product_id FROM messages WHERE receiver_id = '$user_id' ORDER BY timestamp DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inbox</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <h2>Inbox</h2>

    <div>
        <?php while ($row = mysqli_fetch_assoc($result)) { 
            $sender_id = $row['sender_id'];
            $product_id = $row['product_id'];
            
            $sender_sql = "SELECT * FROM users WHERE id = $sender_id";
            $sender_result = mysqli_query($conn, $sender_sql);
            $sender = mysqli_fetch_assoc($sender_result);
            
            $product_sql = "SELECT * FROM products WHERE id = $product_id";
            $product_result = mysqli_query($conn, $product_sql);
            $product = mysqli_fetch_assoc($product_result);
        ?>
            <div>
                <p>From: <?php echo $sender['first_name'] . ' ' . $sender['second_name']; ?></p>
                <p>Product: <?php echo $product['name']; ?></p>
                <a href="chat.php?product_id=<?php echo $product_id; ?>&user_id=<?php echo $sender_id; ?>">View Conversation</a>
            </div>
        <?php } ?>
    </div>

    <button onclick="window.location.href='index.php'">Home</button>
</body>
</html>
