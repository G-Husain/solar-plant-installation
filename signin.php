<?php
session_start();
include("db.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_table WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $_SESSION['admin'] = $email;
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
<title>Solar Admin Login</title>

<style>
/* 🔧 Fix width issue */
*{
    box-sizing: border-box;
}

/* 🌌 Background */
body{
    margin:0;
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:15px;
}

/* 🔳 Glass Container */
.container{
    width:100%;
    max-width:350px;   /* 👈 responsive */
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    padding:25px;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
    text-align:center;
}

/* 🌞 Logo */
.logo{
    font-size:26px;
    font-weight:bold;
    color:#ffcc00;
    margin-bottom:10px;
}

.logo span{
    color:white;
}

/* Heading */
.heading{
    font-size:20px;
    color:white;
    margin-bottom:20px;
}

/* Inputs */
.input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:none;
    border-radius:8px;
    outline:none;
    background:rgba(255,255,255,0.2);
    color:white;
    font-size:14px;
}

/* Placeholder */
.input::placeholder{
    color:#ddd;
}

/* Button */
.login-button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#ffcc00;
    color:black;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
    font-size:15px;
}

.login-button:hover{
    background:#ffaa00;
}

/* Forgot */
.forgot-password{
    display:block;
    text-align:right;   /* 👈 better alignment */
    margin-top:5px;
}

.forgot-password a{
    color:#ccc;
    font-size:13px;
    text-decoration:none;
}

.forgot-password a:hover{
    color:white;
}

/* Error */
.error{
    color:#ff4d4d;
    margin-top:10px;
    font-size:14px;
}

/* 📱 Mobile */
@media (max-width:480px){
    .container{
        padding:20px;
    }

    .logo{
        font-size:22px;
    }

    .heading{
        font-size:18px;
    }
}

/* 💻 Large Screens */
@media (min-width:768px){
    .container{
        max-width:380px;
    }
}

</style>

</head>

<body>

<div class="container">

    <!-- 🌞 Solar Logo -->
    <div class="logo">☀ Solar<span>Admin</span></div>

    <div class="heading">Admin Login</div>

    <form method="POST">

        <input class="input" type="email" name="email" placeholder="Enter Email" required>

        <input class="input" type="password" name="password" placeholder="Enter Password" required>

        <span class="forgot-password">
            <a href="forgot.php">Forgot Password?</a>
        </span>

        <br><br>

        <input class="login-button" type="submit" value="Sign In">

        <p class="error"><?php echo $message; ?></p>

    </form>

</div>

</body>
</html>