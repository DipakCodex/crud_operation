<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website1";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    // Failed
    die("Connection failed: " . mysqli_connect_error());
} else {
    // Success
    // echo "Connection OK";
}
?>
