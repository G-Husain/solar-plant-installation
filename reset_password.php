<?php
date_default_timezone_set("Asia/Karachi");
include("db.php");

$message = "";
$token = $_GET['token'] ?? "";

// 🔴 Step 1: Token check
if ($token == "") {
    die("Invalid request!");
}

$query = "SELECT * FROM admin_table 
WHERE token='$token' 
AND token_expire > NOW()";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    die("❌ Token invalid or expired!");
}

// 🔵 Step 2: Password update
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if ($password != $confirm) {
        $message = "<span class='error'>❌ Passwords do not match!</span>";
    } else {

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        mysqli_query($conn, "UPDATE admin_table 
        SET password='$hashed', token=NULL, token_expire=NULL 
        WHERE token='$token'");

        $message = "<span class='success'>✅ Password updated successfully!</span>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>

    <style>
       /* 🔧 Width issue fix */
*{
    box-sizing: border-box;
}

/* 🌌 Background */
body {
    font-family: Arial;
    background: linear-gradient(135deg, #141e30, #243b55);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
    padding: 15px;
}

/* 📦 Box */
.box {
    background: #fff;
    padding: 25px;
    width: 100%;
    max-width: 350px;   /* 👈 responsive */
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    text-align: center;
}

/* 📝 Heading */
h2 {
    margin-bottom: 20px;
    color: #243b55;
    font-size: 22px;
}

/* 🔤 Inputs */
input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 6px;
    border: 1px solid #ccc;
    outline: none;
    font-size: 14px;
}

/* 🔘 Button */
button {
    width: 100%;
    padding: 12px;
    background: #243b55;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    font-size: 15px;
    transition: 0.3s;
}

button:hover {
    background: #141e30;
}

/* ✅ Success */
.success {
    color: green;
    font-size: 14px;
}

/* ❌ Error */
.error {
    color: red;
    font-size: 14px;
}

/* 🔗 Link */
a {
    display: block;
    margin-top: 12px;
    text-decoration: none;
    color: #243b55;
    font-size: 14px;
}

/* 📱 Mobile */
@media (max-width:480px) {
    .box {
        padding: 20px;
    }

    h2 {
        font-size: 20px;
    }

    input, button {
        padding: 10px;
        font-size: 14px;
    }
}

/* 💻 Large screens */
@media (min-width:768px) {
    .box {
        max-width: 380px;
    }

    h2 {
        font-size: 24px;
    }
}
    </style>
</head>

<body>

<div class="box">
    <h2>Reset Password</h2>

    <form method="POST">
        <input type="password" name="password" placeholder="New Password" required>
        <input type="password" name="confirm" placeholder="Confirm Password" required>
        <button type="submit">Update Password</button>
    </form>

    <?php if($message != "") echo $message; ?>

    <a href="signin.php">Back to Login</a>
</div>

</body>
</html>