<?php
include 'db.php';

$id = intval($_POST['id']);
$title = $_POST['title'];
$description = $_POST['description'];

$imageName = $_FILES['image']['name'];

if($imageName != ""){

    // 🔴 STEP 1: old image fetch karo
    $result = mysqli_query($conn, "SELECT image FROM projects WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
    $oldImage = $row['image'];

    // 🔴 STEP 2: old image delete karo (agar exist karti hai)
    if($oldImage != "" && file_exists("images/" . $oldImage)){
        unlink("images/" . $oldImage);
    }

    // 🔴 STEP 3: new image upload
    $tmp = $_FILES['image']['tmp_name'];
    $newName = time() . "_" . $imageName;

    move_uploaded_file($tmp, "images/" . $newName);

    // 🔴 STEP 4: database update
    mysqli_query($conn, "UPDATE projects SET 
        title='$title',
        description='$description',
        image='$newName'
        WHERE id=$id");

}else{

    // 🔵 Sirf text update
    mysqli_query($conn, "UPDATE projects SET 
        title='$title',
        description='$description'
        WHERE id=$id");
}

header("Location: admin_dashboard.php");
exit;
?>