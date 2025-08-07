<?php
include 'db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $second_name = $_POST['second_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt the password
    $mobile_number = $_POST['mobile_number'];
    $address = $_POST['address'];
    $nic_number = $_POST['nic_number'];
    $nic_front_photo = 'uploads/' . basename($_FILES['nic_front_photo']['name']);
    $nic_back_photo = 'uploads/' . basename($_FILES['nic_back_photo']['name']);
    $profile_photo = 'uploads/' . basename($_FILES['profile_photo']['name']);

    // Move uploaded files to the uploads directory
    move_uploaded_file($_FILES['nic_front_photo']['tmp_name'], $nic_front_photo);
    move_uploaded_file($_FILES['nic_back_photo']['tmp_name'], $nic_back_photo);
    move_uploaded_file($_FILES['profile_photo']['tmp_name'], $profile_photo);

    $sql = "INSERT INTO users (first_name, second_name, email, password, mobile_number, address, nic_number, nic_front_photo, nic_back_photo, profile_photo)
            VALUES ('$first_name', '$second_name', '$email', '$password', '$mobile_number', '$address', '$nic_number', '$nic_front_photo', '$nic_back_photo', '$profile_photo')";

    if (mysqli_query($conn, $sql)) {
        // Start a session and store user_id
        session_start();
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        
        // Redirect to home page after successful registration
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
