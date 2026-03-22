<?php
include("connection.php");

// Form submit vaye paxi matra yo block vitra ko code chalsxa
if(isset($_POST['submit']))
{
    // Check garne ki field haru khali ta xainan
    $fname    = $_POST['fname'] ?? '';
    $lname    = $_POST['lname'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role     = $_POST['role'] ?? '';

    // SQL Query
    $query = "INSERT INTO teachr (fname, lname, email, password, role) 
    VALUES ('$fname', '$lname', '$email', '$password', '$role')";
          
    $data = mysqli_query($conn, $query);

    if ($data) {
        echo "<script>alert('Teacher added successfully!');</script>";
    } else {
        echo "Data not sent: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher Form</title>
    <link rel="stylesheet" href="teacher.css">
</head>
<body>
    <div class="form-container">
        <h2>Add Teacher</h2>
        <form action="teacher.php" method="post">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" required>

            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <select name="user_type" required>
                <option value="" disabled selected>Select Role</option>
                <option value="teachr">Teacher</option>
            </select>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>