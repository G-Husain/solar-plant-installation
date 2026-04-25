<?php
include ('db.php');

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM projects WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Update Project</title>

<style>
body{
    font-family: Arial;
    background:#eef2f7;
    padding:40px;
}

.form-box{
    max-width:700px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

input, textarea{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:6px;
}

button{
    background:green;
    color:white;
    padding:12px;
    border:none;
    width:100%;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:darkgreen;
}

label{
    font-weight:bold;
}

img{
    width:150px;
    margin-bottom:10px;
    border-radius:6px;
}
</style>

</head>
<body>

<div class="form-box">

<h2>Update Project</h2>

<form action="pro_update_process.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<label>Title</label>
<input type="text" name="title" value="<?php echo $row['title']; ?>">

<label>Description</label>
<textarea name="description"><?php echo $row['description']; ?></textarea>

<label>Current Image</label><br>
<img src="images/<?php echo $row['image']; ?>">

<label>Change Image</label>
<input type="file" name="image">

<button type="submit" name="update">Save Changes</button>

</form>

</div>

</body>
</html>