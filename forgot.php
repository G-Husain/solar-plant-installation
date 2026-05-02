<?php
date_default_timezone_set("Asia/Karachi");
include("db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];

    $query = "SELECT * FROM admin_table WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

        // 🔐 Token generate
        $token = bin2hex(random_bytes(50));
        $expire = date("Y-m-d H:i:s", strtotime("+1 hour"));

        mysqli_query($conn, "UPDATE admin_table 
        SET token='$token', token_expire='$expire' 
        WHERE email='$email'");

        // 🔗 Reset link
        $link = "http://localhost/solar-plant-installation/reset_password.php?token=$token";

        // 📧 PHPMailer start
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            $mail->Username = 'mrhusain642@gmail.com';   // 👈 change
            $mail->Password = 'zfzy ywtj nnvm clda';      // 👈 change

            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('mrhusain642@gmail.com', 'Solar Project');
            $mail->addAddress($email);

            $mail->Subject = "Reset Password";
            $mail->Body = "Click this link to reset your password:\n$link";

            $mail->send();

            $message = "<span class='success'>✅ Reset link sent to your email!</span>";

        } catch (Exception $e) {
            $message = "<span class='error'>❌ Email Error: {$mail->ErrorInfo}</span>";
        }

    } else {
        $message = "<span class='error'>❌ Email not found!</span>";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>

    <style>

        *{
               box-sizing: border-box;
        }
     body {
    font-family: Arial;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
    padding: 15px;
}

/* 📦 Main Box */
.box {
    background: white;
    padding: 25px;
    width: 100%;
    max-width: 350px;   /* 👈 responsive width */
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    text-align: center;
}

/* 📱 Heading */
h2 {
    margin-bottom: 20px;
    font-size: 22px;
}

/* 🔤 Inputs */
input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
}

/* 🔘 Button */
button {
    width: 100%;
    padding: 12px;
    background: #2c5364;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 15px;
    transition: 0.3s;
}

button:hover {
    background: #203a43;
}

/* 📩 Messages */
.success {
    color: green;
    font-size: 14px;
}

.error {
    color: red;
    font-size: 14px;
}

/* 🔗 Link */
a {
    display: block;
    margin-top: 12px;
    text-decoration: none;
    color: #2c5364;
    font-size: 14px;
}

/* 📱 Extra Small Devices */
@media (max-width: 480px) {
    .box {
        padding: 20px;
    }

    h2 {
        font-size: 20px;
    }

    input, button {
        font-size: 14px;
        padding: 10px;
    }
}

/* 💻 Large Screens */
@media (min-width: 768px) {
    .box {
        max-width: 400px;
    }

    h2 {
        font-size: 24px;
    }
}
    </style>
</head>

<body>

<div class="box">
    <h2>Forgot Password</h2>

    <form method="POST">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Send Reset Link</button>
    </form>

    <?php if($message != "") echo $message; ?>

    <a href="signin.php">Back to Login</a>
</div>

</body>
</html>