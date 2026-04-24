<?php
session_start();

// 🔐 check session
if (!isset($_SESSION['client_name'])) {
    header("Location: checkstatus.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Client Dashboard</title>

<style>
body{
    font-family: Arial;
    background:#f4f6f9;
    text-align:center;
    margin-top:50px;
}

.box{
    background:white;
    width:300px;
    margin:auto;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 10px gray;
}

.status{
    font-size:20px;
    font-weight:bold;
}

.pending{ color:orange; }
.approved{ color:green; }
.rejected{ color:red; }

.logout{
    display:inline-block;
    margin-top:15px;
    padding:8px 12px;
    background:red;
    color:white;
    text-decoration:none;
    border-radius:5px;
}
</style>

</head>
<body>

<div class="box">

    <h2>Welcome <?php echo $_SESSION['client_name']; ?></h2>

    <p><b>Phone:</b> <?php echo $_SESSION['client_phone']; ?></p>

    <p class="status 
    <?php 
        if($_SESSION['client_status']=='Approved') echo 'approved';
        elseif($_SESSION['client_status']=='Rejected') echo 'rejected';
        else echo 'pending';
    ?>">
        Status: <?php echo $_SESSION['client_status']; ?>
    </p>

    <a href="index.php" class="logout">Back to home</a>

</div>

</body>
</html>