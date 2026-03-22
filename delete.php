<?php
include("connection.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid ID");
}

$id = (int) $_GET['id'];

$query = "DELETE FROM user WHERE id = $id";

if (mysqli_query($conn, $query)) {
    header("Location: dashboard.php");
    exit;
} else {
    echo "Delete failed: " . mysqli_error($conn);
}
?>
