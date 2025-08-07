<?php
session_start();
include 'db.php'; // Include database connection

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product View</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f1ed;
        }
        nav {
            background-color: #4056A1;
            color: black;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav a {
            text-align: center;
            color: black;
            text-decoration: none;
            margin-left: 25px;
            margin-top: 60px;
            font-family: monospace;
            font-size: 18px;
        }
        nav a:hover {
            color: #F13C20;
        }
        .container {
            width: auto;
            height: auto;
            overflow: hidden;
            display: flex;
            justify-content: center;
        }
        .navtitle {
            margin-top: 10px;
            margin-left: 20px;
            display: flex;
            height: 30px;
        }
        .titles {
            font-size: 33px;
            font-family: cursive;
            color: white;
        }
        h2 {
            color: #D79922;
            font-size: 45px;
            margin-left: 30px;
            font-family: serif;
        }
        .containers {
            padding: 20px;
            background-color: #f2f1ed;
            background-attachment: fixed;
        }
        .product {
            border-radius: 30px;
            border: 4px solid white;
            width: 1100px;
            padding: 20px;
            margin: 10px;
            background: #00000018;
            margin-left: 30px;
        }
        img {
            max-width: 100%;
            max-height: 100%;
        }
        .product img {
            width: 300px;
            height: 300px;
            border: 4px solid #4056A1;
        }
        h3 {
            font-size: 35px;
            font-family: serif;
            color: #4056A1;
        }
        .product button {
            margin: 15px;
            background: #4056A1;
            color: white;
            width: 150px;
            height: 40px;
            border: 2px solid white;
            border-radius: 25px;
        }
        .product button:hover {
            background: #C5CBE3;
            color: black;
            border: 2px solid #4056A1;
        }
        footer {
            padding: 20px;
            background: #4056A1;
            color: #000;
            text-align: center;
        }
        .colors {
            color: #F13C20;
        }

        .inbox{
            color:red;
            text-decoration:none;
            font-size:25px;
            background-color:Yellow;
            margin:10px;
        }
    </style>
</head>
<body>
    <nav>
        <div class="container">
            <h1 class="titles">Artisan Craft</h1>
            <div class="navtitle">
                <a href="index.php">Home</a>
                <a href="register.html">Register</a>
                <a href="login.html">Login</a>
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <a href="product_upload.html">Upload Product</a>
                    <a href="manage_products.php">Manage Products</a>
                    <a class="colors" href="product_view.php">View Products</a>
                    <a href="cart.php">Cart</a>
                    <a href="profile.php">My Profile</a>
                    <a href="inbox.php">Inbox</a>
                    <a href="logout.php">Logout</a>
                <?php } ?>
            </div>
        </div>
    </nav>


    <a class="inbox" href="inbox.php">Inbox</a>
    <h2>Find what you need</h2>

    
    <div class="containers">
        <?php while ($product = mysqli_fetch_assoc($result)) { 
            // Fetch owner's details
            $owner_id = $product['owner_id'];
            $owner_sql = "SELECT * FROM users WHERE id = $owner_id";
            $owner_result = mysqli_query($conn, $owner_sql);
            $owner = mysqli_fetch_assoc($owner_result);
        ?>
            <div class="product">
                <h3><?php echo $product['name']; ?></h3>
                <p>Type: <?php echo $product['type']; ?></p>
                <p>Price: R.s.<?php echo $product['price']; ?></p>
                <p>Details: <?php echo $product['details']; ?></p>
                <p>Quantity: <?php echo $product['quantity']; ?></p>
                <p>Owner: <?php echo $owner['first_name'] . ' ' . $owner['second_name']; ?></p>
                <div>
                    <?php
                    $photos = explode(',', $product['photos']);
                    foreach ($photos as $photo) {
                        echo "<img src='$photo' alt='Product Photo'>";
                    }
                    ?>
                </div>
                <button onclick="window.location.href='chat.php?product_id=<?php echo $product['id']; ?>&user_id=<?php echo $owner_id; ?>'">Chat</button>
                <button onclick="window.location.href='add_to_cart.php?product_id=<?php echo $product['id']; ?>'">Add to Cart</button>
                <button onclick="alert('Call: <?php echo $owner['mobile_number']; ?>')">Call</button>
            </div>
        <?php } ?>
    </div>

    <footer>
        <p clss="footerp">Artisan Craft &copy; 2024</p>
    </footer>
</body>
</html>
