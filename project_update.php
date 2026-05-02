<?php
include('db.php');
$result = mysqli_query($conn, "SELECT * FROM projects");
?>

<!DOCTYPE html>
<html>
<head>
<title>Projects Dashboard</title>

<style>
body{
    font-family: Arial;
    background:#eef2f7;
    padding:40px;
        background: #a7b3c3;
}

/* Container Grid */
.container{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap:25px;
}

/* Card Style */
.card{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

/* Heading */
.card h3{
    margin-bottom:15px;
    color:#333;
}

/* Inputs */
input, textarea{
    width:100%;
    padding:8px;
    margin-top:5px;
    margin-bottom:12px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:14px;
}

/* Button */
button{
    background:green;
    color:white;
    padding:10px;
    border:none;
    width:100%;
    border-radius:6px;
    cursor:pointer;
}

button:hover{
    background:darkgreen;
}

/* Image */
img{
    width:100%;
    height:150px;
    object-fit:cover;
    border-radius:6px;
    margin-bottom:10px;
}

label{
    font-weight:bold;
}
</style>

</head>
<body>

<h1 style="text-align:center; margin-bottom:30px;">Projects Dashboard</h1>

<div class="container">

<?php
$project_no = 1;

while($row = mysqli_fetch_assoc($result)){
?>

<div class="card">

<h3>
    Project <?php echo $project_no; ?> 
</h3>

<form action="pro_update_process.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<label>Title</label>
<input type="text" name="title" value="<?php echo $row['title']; ?>">

<label>Description</label>
<textarea name="description"><?php echo $row['description']; ?></textarea>

<label>Current Image</label>
<img src="images/<?php echo $row['image']; ?>" alt="Project Image">

<label>Change Image</label>
<input type="file" name="image">

<button type="submit" name="update">Update</button>

</form>

</div>

<?php 
$project_no++;
} 
?>

</div>

</body>
</html>