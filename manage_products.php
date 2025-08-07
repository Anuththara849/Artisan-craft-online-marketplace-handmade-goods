<?php
session_start();
include 'db.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user products
$sql = "SELECT * FROM products WHERE owner_id = $user_id";
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
    <title>Manage Products</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f1ed ;

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

        .kkk{
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }



        h2 {
            font-size: 40px;
            margin-left: 40px;
            margin-bottom: 20px;
            color:#D79922 ;
            font-family: serif;
        }

        .manage-containers {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
            text-align: center;
        }
        .manage-containers h2 {
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
            margin: 5px;
            padding: 10px;
            background: #4056A1;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            border-radius: 25px;
            border: 2px solid white;
            width:80px;
        }
        .product button:hover {
            background: #C5CBE3;
            color: black;
            border: 2px solid #4056A1;
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
                    <a class="colors" href="manage_products.php">Manage Products</a>
                    <a href="product_view.php">View Products</a>
                    <a href="cart.php">Cart</a>
                    <a href="profile.php">My Profile</a>
                    <a href="logout.php">Logout</a>
                    
                    

                <?php } ?>
            </div>
        </div>
    </nav>

<h2>Manage Products</h2>

    <div class="kkk">
    
        
        <div class="manage-containers">
            
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="product">
            
                        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                        <p>Type: <?php echo htmlspecialchars($row['type']); ?></p>
                        <p>Price: <?php echo htmlspecialchars($row['price']); ?></p>
                        <p>Details: <?php echo htmlspecialchars($row['details']); ?></p>
                        <button onclick="window.location.href='edit_product.php?id=<?php echo $row['id']; ?>'">Edit</button>
                        <button onclick="deleteProduct(<?php echo $row['id']; ?>)">Delete</button>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>No products found.</p>
            <?php } ?>
        </div>
    </div>


    <script>
        function deleteProduct(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                window.location.href = 'delete_product.php?id=' + id;
            }
        }
    </script>

<footer>
    <p>Artisan Craft &copy; 2024</p>
</footer>
</body>
</html>
