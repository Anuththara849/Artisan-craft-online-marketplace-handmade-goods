<?php
session_start();
include 'db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $user['password'])) {
            // Password is correct, start a session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['second_name'];
            
            // Redirect to home page after successful login
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with that email address.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

       h2{
            color:#D79922;
            font-size:30px;
        }

       .loging{
        height: auto;
        width:auto;
        background: url('forLogin.jpg') no-repeat 0 -1050px;
        background-attachment: fixed;
        display:flex;
        justify-content:center;
        /* margin-left:20px;
        margin-right:20px; */
        /* border:2px solid red; */


       }
        .login-containers {
            background: #00000081;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            height:500px;
            text-align: center;
            margin:50px;
        }
        .login-containers h2 {
            margin-bottom: 20px;
        }
        .login-containers input[type="email"],
        .login-containers input[type="password"] {
            width: 200px;
            padding: 10px;
            margin-right: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-containers button {
            width: 50%;
            padding: 10px;
            background: #4056A1;
            color: #fff;
            border: 2px solid ;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
        }
        .login-containers button:hover {
            border:2px solid #4056A1;
        background-color: #C5CBE3;
        color:black;
        }
        .error {
            font-size:20px;
            color: red;
            margin-top: 10px;
        }

        footer {
            padding: 20px;
            background: #4056A1;
            color: #000;
            text-align: center;
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
            </div>
        </div>
</nav>


<h2>Welcome back login here</h2>
<div class="loging">
    <div class="login-containers">
        <?php if (!empty($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <form method="post" action="login.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</div>

<footer>
        <p>Artisan Craft &copy; 2024</p>
</footer>

</body>
</html>
