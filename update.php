<?php
include("connection.php");

// Check GET id first (show form)
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid user ID");
}
$id = (int) $_GET['id'];

// Fetch existing user data
$query = "SELECT * FROM user WHERE id = $id";
$data = mysqli_query($conn, $query);

if (mysqli_num_rows($data) != 1) {
    die("User not found");
}
$user = mysqli_fetch_assoc($data);

// Handle update form submit
if (isset($_POST['update'])) {

    // Get POST values
    $id = (int) $_POST['id'];     // hidden input बाट id लिन्छौ
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    // Check confirm password match
    if ($password !== $cpassword) {
        $error = "Passwords do not match!";
    } else {
        // UPDATE query (clean — no wrong comments)
        $update = "UPDATE user SET
            fname = '$fname',
            lname = '$lname',
            email = '$email',
            password = '$password'
        WHERE id = $id";

        if (mysqli_query($conn, $update)) {
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Update failed: " . mysqli_error($conn);
        }
    }
}
?>



<!DOCTYPE html>
<html lang="yes">
<head>
<meta charset="utf-8">
<title>Update User</title>
<link rel="stylesheet" href="update.css">
</head>
<body>
<div class="container">
<div class="title">Update Account</div>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>


<form method="post" action="">

    <!-- Hidden id field (must be inside form) -->
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

    <div class="input_field">
      <label>First Name</label>
      <input type="text" name="fname" value="<?= htmlspecialchars($user['fname']) ?>" required>
    </div>

    <div class="input_field">
      <label>Last Name</label>
      <input type="text" name="lname" value="<?= htmlspecialchars($user['lname']) ?>" required>
    </div>

    <div class="input_field">
      <label>Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    </div>

    <div class="input_field">
      <label>Password</label>
      <input type="password" name="password" value="<?= htmlspecialchars($user['password']) ?>">
    </div>

    <div class="input_field">
      <label>Confirm Password</label>
      <input type="password" name="cpassword">
    </div>

    <div class="input_field">
      <input type="submit" name="update" value="Update" class="btn">
    </div>

</form>
</div>
</body>
</html>
