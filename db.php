<?php
$conn = mysqli_connect("localhost", "root", "", "solarplant");




if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>