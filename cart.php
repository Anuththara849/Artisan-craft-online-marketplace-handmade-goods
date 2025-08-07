<?php
session_start();
include 'db.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch cart products from the database
$sql = "SELECT c.id AS cart_id, p.* FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = $user_id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error: ' . mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f1ed ;
        }

        .kkk{

            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            margin: 0;
            margin-bottom: 30px ;
        }


        nav {
            background-color:#4056A1 ;
            color: black;
            /* padding: 10px; */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav a {
            text-align:center;
            color: black;
            text-decoration: none;
            margin-left:  25px;
            margin-top:60px;
            font-family:monospace;
            font-size:18px;
            /* padding-left:10px; */
            /* border:2px solid red; */
        }

        nav a:hover{
            /* background-color:#1A4D2E; */
            color:#F13C20;
        }

        .container{
            width: auto;
            height: auto;
            overflow: hidden;
            display: flex;
            justify-content:center;
        }

        .navtitle{
            margin-top:10px;
            margin-left:20px;
            /* border:2px solid red; */
            display:flex;
            height:30px;
        }

        .titles{
        font-size:33px;
        font-family:cursive;
        color:white;
       }


       
        .cart-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
            text-align: center;
        }
        .cart-container h2 {
            margin-bottom: 20px;
        }
        .product {
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: left;
        }
        .product img {
            max-width: 100px;
            max-height: 100px;
            margin-right: 10px;
            border-radius: 5px;
        }
        .product button {
            border:2px solid white;
            margin: 5px;
            padding: 10px;
            background: #4056A1;
            color: #fff;
            border-radius: 25px;
            cursor: pointer;
        }
        .product button:hover {
            background: #C5CBE3;
            color:black;
            border:2px solid #4056A1;
        }


        h2{
            margin-left:30px;
            color:#D79922;
            font-family:serif;
            font-size:50px;
        }



        footer {
            padding: 20px;
            background: #4056A1;
            color: #000;
            text-align: center;
        }

        .colors{
    color:#F13C20;
}


.colors{
    color:#F13C20;
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
                <a href="login.php">Login</a>
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <a href="product_upload.html">Upload Product</a>
                    <a href="manage_products.php">Manage Products</a>
                    <a href="product_view.php">View Products</a>
                    <a class="colors" href="cart.php">Cart</a>
                    <a  href="profile.php">My Profile</a>
                    <a href="logout.php">Logout</a>
                    
                    

                <?php } ?>
            </div>
        </div>
    </nav>


    <h2>Your Cart</h2>
<div class="kkk">
    <div class="cart-container">
        
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="product">
                    <?php if (!empty($row['photo'])) { ?>
                        <img src="uploads/<?php echo htmlspecialchars($row['photo']); ?>" alt="Product Photo">
                    <?php } ?>
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p>Type: <?php echo htmlspecialchars($row['type']); ?></p>
                    <p>Price: <?php echo htmlspecialchars($row['price']); ?></p>
                    <p>Details: <?php echo htmlspecialchars($row['details']); ?></p>
                    <button onclick="removeFromCart(<?php echo $row['cart_id']; ?>)">Remove from Cart</button>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>Your cart is empty.</p>
        <?php } ?>
    </div>
</div>    
    <script>
        function removeFromCart(cartId) {
            if (confirm('Are you sure you want to remove this product from the cart?')) {
                window.location.href = 'remove_from_cart.php?id=' + cartId;
            }
        }
    </script>

<footer>
        <p class="forPutter">Artisan Craft &copy; 2024</p>
    </footer>
</body>
</html>
