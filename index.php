<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <div class="container">
        <div class="box-box active" id="login-form">
            <form action="#" method="post">
                <h2>Login</h2>
                <h3><label for="email">Email</label></h3>
                <input type="email" name="email" placeholder="email" required>
                <h3><label for="password">Password</label></h3>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
                <select name="user_role" required>
                <option value="user">User</option>
                <!-- <option value="teachr">Teacher</option> -->
                <option value="admin">Admin</option>
                </select>
                <p>Don't have an account?<a href="register.php"> Register</a></p>
            </form>
        </div>
    </div>
</body>
</html>




<?php
include("connection.php");
session_start();

if (isset($_POST['login'])) {
    $useremail = $_POST['email'];
    $userpass = $_POST['password'];

    // 1. Student Table check garne (Role 'user' set garne Dashboard sanga match garna)
    $query_student = "SELECT * FROM user WHERE email='$useremail' AND password='$userpass'";
    $res_student = mysqli_query($conn, $query_student);

    if (mysqli_num_rows($res_student) == 1) {
        $row = mysqli_fetch_assoc($res_student);
        $_SESSION['email'] = $row['email'];
        // $_SESSION['fname'] = $row['fname']; // Dashboard ma naam dekhauna
        
        // AGAR database ma 'role' column chha vane tyo use garnus:
        $_SESSION['role'] = $row['role']; 
        
        // AGAR database ma role chhaina vane, manually 'user' rakhnus:
        // $_SESSION['role'] = 'user'; 

        header('location:dashboard.php');
        exit();
    } 
    
    // 2. Teacher Table check garne
    $query_teacher = "SELECT * FROM teachr WHERE email='$useremail' AND password='$userpass'";
    $res_teacher = mysqli_query($conn, $query_teacher);

    if (mysqli_num_rows($res_teacher) == 1) {
        $row = mysqli_fetch_assoc($res_teacher);
        $_SESSION['email'] = $row['email'];
        $_SESSION['fname'] = $row['fname'];
        
        // Database bata role line (e.g., 'teacher' or 'admin')
        $_SESSION['role'] = $row['role']; 

        header('location:dashboard.php');
        exit();
    } 
    else {
        echo "<p style='color:red; text-align:center;'>Email or Password do not match!</p>";
    }
}
?>