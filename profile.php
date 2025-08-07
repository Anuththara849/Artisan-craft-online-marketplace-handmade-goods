<?php
session_start();
include 'db.php'; // Include database connection

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
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





        .profile{ 
            display:flex;
            justify-content:center;
            align-items:center;
            /* border:2px solid red; */
            background: url('profileBack.jpg') no-repeat 0 -850px;
            background-attachment: fixed;
            padding-top:100px;
            padding-bottom:250px;
        }

        .profiles{
            display:flex;
            background: #00000081;
            margin-top:10px;
            margin-right:auto;
            margin-left:auto;
            border-radius: 10px;
            /* border:2px solid white; */
            box-shadow: 0 0 10px rgba(0, 0, 0, 10);
            width: auto;
            height:1000px;
        }
        .dp{
            /* border:2px solid green; */
            margin-right:20px;
            margin-top:20px;
            margin-left:20px;
            width:350px;
            height:350px;
        }
        img{
            width:100%;
            height:100%;
            /* border:2px solid white; */
            border-radius:50%;
        }

        .details{
            /* border:2px solid blue; */
            /* padding:10px; */
            margin-top:100px;
            height:200px;
        }

        h1{
            font-size:40px;
            color:#D79922;
            font-family:serif;
        }

        p{
            color:white;
            margin-left:40px;
            font-size:20px;
        }

        .profileEdit{
            padding-top:50px;
            padding-left:50px;
            padding-right:50px;
            /* border:2px solid pink; */
            /* margin-top:20px;
            margin-left:20px; */
        }

        .edit{
            border-radius:5px;
            padding:10px;
            border:2px solid ;  
            background-color:#4056A1;
            text-decoration:none;
            color:white;
        }
        .edit:hover{
            background-color:#C5CBE3;
            color:black;
            border:2px solid #4056A1;
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
                    <a href="product_upload.html">Product Upload</a>
                    <a href="manage_products.php">Manage Products</a>
                    <a href="product_view.php">View Products</a>
                    <a href="cart.php">Cart</a>
                    <a class="colors" href="profile.php">My Profile</a>
                    <a href="logout.php">Logout</a>
                    
                    

                <?php } ?>
            </div>
        </div>
    </nav>


    <div class="profile">
        <div class="profiles">
            <!-- <h2>My Profile</h2> -->
            <div class="dp">
                <img src="<?php echo $user['profile_photo']; ?>" alt="Profile Photo">
            </div>
            <div class="details">
               <h1><?php echo $user['first_name'] . ' ' . $user['second_name']; ?></h1>
                <p>Email: <?php echo $user['email']; ?></p>
                <p>Mobile Number: <?php echo $user['mobile_number']; ?></p>
                <p>Address: <?php echo $user['address']; ?></p>
                <p>NIC Number: <?php echo $user['nic_number']; ?></p>
            </div>
            <div class="profileEdit">
                <a class="edit" href="edit_profile.php">Edit Profile</a>
            </div>
        </div>
    </div>

    <footer>
        <p clss="footerp">Artisan Craft &copy; 2024</p>
    </footer>
</body>
</html>
