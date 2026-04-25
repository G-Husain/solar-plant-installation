<?php
include 'db.php';

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];

$imageName = $_FILES['image']['name'];

if($imageName != ""){

    $tmp = $_FILES['image']['tmp_name'];
    $newName = time() . "_" . $imageName;

    move_uploaded_file($tmp, "images/" . $newName);

    mysqli_query($conn, "UPDATE projects SET 
        title='$title',
        description='$description',
        image='$newName'
        WHERE id=$id");

}else{

    mysqli_query($conn, "UPDATE projects SET 
        title='$title',
        description='$description'
        WHERE id=$id");
}

header("Location: admin_dashboard.php");
exit;
?>