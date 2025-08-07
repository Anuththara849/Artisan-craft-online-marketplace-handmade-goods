<?php
session_start();
include 'db.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$query = isset($_GET['query']) ? $_GET['query'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

$sql = "SELECT * FROM products WHERE name LIKE '%$query%'";

if (!empty($type)) {
    $sql .= " AND type = '$type'";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }



        .kkk{
            
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

        footer {
            padding: 20px;
            background: #4056A1;
            color: #000;
            text-align: center;
        }

        .containers {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        .product {
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: left;
            display: flex;
            align-items: center;
        }
        .product img {
            max-width: 100px;
            max-height: 100px;
            margin-right: 10px;
            border-radius: 5px;
        }
        .product button {
            width: 150px;
            padding: 10px;
            background: #4056A1;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
            border: 2px solid white;
        }
        .product button:hover {
            background: #C5CBE3;
            color: black;
            border: 2px solid #4056A1;
        }



        h2 {
            font-size: 40px;
            margin-left: 40px;
            margin-bottom: 20px;
            color:#D79922 ;
            font-family: serif;
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
                    <a href="cart.php">Cart</a>
                    <a href="profile.php">My Profile</a>
                    <a href="logout.php">Logout</a>
                    
                    

                <?php } ?>
            </div>
        </div>
    </nav>

    
<h2>Search Results</h2>

<div class="kkk">
    <div class="containers">
       
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <?php while ($product = mysqli_fetch_assoc($result)) { ?>
                <div class="product">
                    <div>
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p><?php echo htmlspecialchars($product['details']); ?></p>
                        <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                        <p>Quantity: <?php echo htmlspecialchars($product['quantity']); ?></p>
                        <?php
                        $photos = explode(',', $product['photos']);
                        foreach ($photos as $photo) {
                            echo "<img src='$photo' alt='Product Image' width='100'>";
                        }
                        ?>
                        <p>Owner: <?php
                            $owner_id = $product['owner_id'];
                            $owner_sql = "SELECT * FROM users WHERE id = $owner_id";
                            $owner_result = mysqli_query($conn, $owner_sql);
                            $owner = mysqli_fetch_assoc($owner_result);
                            echo htmlspecialchars($owner['first_name'] . ' ' . $owner['second_name']);
                        ?></p>
                    </div>
                    <div>
                        <a href="product_view.php?id=<?php echo $product['id']; ?>"><button>View</button></a>
                        <a href="index.php"><button>Cancel</button></a>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No products found.</p>
        <?php } ?>
    </div>

</div>    
</body>
</html>
