<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="box-box" id="Register-form">
            <form action="#" method="post" autocomplete="off">
                <h2>Register</h2>
                <h3><label for="fname">First Name</label></h3>
                <input type="text" name="fname"  id="fname"placeholder="Enter first name" required>
                <h3><label for="lname">Last Name</label></h3>
                <input type="text" name="lname" placeholder="Enter last name" required>
                <h3><label for="email">Email</label></h3>
                <input type="email" name="email" placeholder="Enter your email" required>
                <h3><label for="password">Password</label></h3>
                <input type="password" name="password" placeholder="Password" required>
                <h3><label for="password">Comform Password</label></h3>
                <input type="password" name="cpassword" placeholder="Conform Password" required>
                <select name="user_type" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" name="register">Register</button>
                <p>Already have an account?<a href="index.php">Login</a></p>
            </form>
        </div>
</body>
</html>
<?php
include("connection.php");
if(isset($_POST['register']))
{
    $fname = $_POST['fname'];
     $lname = $_POST['lname'];
      $email = $_POST['email'];
       $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $role = $_POST['role'];
        
        
       if($password !== $cpassword){
        echo "<p style='color:red;'>Passwords do not match!</p>";
        exit;
    }

       $query = "INSERT INTO USER (fname, lname, email, password, cpassword, role) 
          VALUES ('$fname','$lname','$email','$password','$cpassword', '$role')";
          
       $data =mysqli_query($conn, $query);
      if (!$data) {
    echo "Data not sent: " . mysqli_error($conn);
} else {
    echo "Data sent successfully.";
}
}
?>