<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $sql = "SELECT * FROM requests WHERE name='$name' AND phone='$phone'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        // 🔐 session me save
        $_SESSION['client_name'] = $row['name'];
        $_SESSION['client_phone'] = $row['phone'];
        $_SESSION['client_status'] = $row['status'];

        header("Location:client_dashboard.php");
        exit();

    } else {
        echo "❌ No record found!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>
    <!-- From Uiverse.io by Smit-Prajapati -->
<div class="container">
    <div class="heading">Check Status</div>
    <form action="" class="form" method="POST">
      <input required="" class="input" type="text" name="name" id="name" placeholder="Enter your name">
      <input required="" class="input" type="text" name="phone" id="phone_number" placeholder="Enter your mobile number">
      <input class="login-button" type="submit" value="check status">
      
    </form>
</body>
</html>