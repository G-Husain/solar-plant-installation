<?php
session_start();
include("db.php");

// 🔐 Session check
if (!isset($_SESSION['admin'])) {
    header("Location: signin.php");
    exit();
}

// 🔴 Handle Actions
if (isset($_GET['action']) && isset($_GET['id'])) {

    $id = intval($_GET['id']); // security

    if ($_GET['action'] == 'accept') {
        mysqli_query($conn, "UPDATE requests SET status='Approved' WHERE id=$id");
    }

    if ($_GET['action'] == 'reject') {
        mysqli_query($conn, "UPDATE requests SET status='Rejected' WHERE id=$id");
    }

    if ($_GET['action'] == 'delete') {
        mysqli_query($conn, "DELETE FROM requests WHERE id=$id");
    }

    header("Location: admin_dashboard.php");
    exit();
}

// 📊 Fetch Data
$result = mysqli_query($conn, "SELECT * FROM requests ORDER BY id ASC");
$count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>

<div class="header">
    <h2>Admin Dashboard</h2>
    <div>
        <a href="index.php" class="back-btn">Back</a>
    <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Number</th>
        <th>Address</th>
        <th>Status</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>

<?php
// ✅ No data case
if ($count == 0) {
    echo "<tr><td colspan='7'>No record found!</td></tr>";
} else {
    while($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
         <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $row['address']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td><?php echo $row['created_at']; ?></td>

        <td>
            <a class="btn accept" href="?action=accept&id=<?php echo $row['id']; ?>">Accept</a>
            <a class="btn reject" href="?action=reject&id=<?php echo $row['id']; ?>">Reject</a>
            <a class="btn delete" href="?action=delete&id=<?php echo $row['id']; ?>" 
               onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
<?php
    }
}
?>

</table>

</body>
</html>