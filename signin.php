<?php
session_start();
include("db.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query
    $sql = "SELECT * FROM admin_table WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $_SESSION['admin'] = $email;  // session set
        header("Location: admin_dashboard.php");
        exit();

    } else {
        $message = "❌ Invalid Email or Password";
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
    <div class="heading">Sign In</div>
    <form action="" class="form" method="post">
      <input required="" class="input" type="email" name="email" id="email" placeholder="E-mail">
      <input required="" class="input" type="password" name="password" id="password" placeholder="Password">
      <span class="forgot-password"><a href="#">Forgot Password ?</a></span>
      <input class="login-button" type="submit" value="Sign In">
      <br>
      <p style="color:red;"><?php echo $message; ?></p>
    </form>
</body>
</html>