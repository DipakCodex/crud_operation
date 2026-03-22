<?php
session_start();

// Agar session mein email nahi hai, matlab user login nahi karke aaya hai
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Browser back button daba kar wapas na aa sake iske liye cache clear karein
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashborad</title>
    <!-- <link rel="stylesheet" href="image/styles.css"> -->
    <link rel="stylesheet" href="dashboard.css">
</head>
<body class="<?php echo $_SESSION['role']; ?>">

<style>
.update{
background-color: #6a158fff;
color: white;
box-shadow: 0;
border-radius: 5px;
width: 100px;
font-weight: 25px;
cursor: pointer;
}

.delete{
background-color: #8b0000;
color: white;
box-shadow: 0;
border-radius: 5px;
width: 100px;
font-weight: 20px;
cursor: pointer;
}
</style>



    <div class="sidebar">
        <div progile>
            <img src="image/download.png">
            <h2 id="dipak">Dipak</h2>
            <p style="color: #0aae4e;">online</p>
        </div>



        <?php

        if (!isset($_SESSION['role'])) {
    // Agar login nahi hai toh login.php par bhej do
    header("Location: login.php");
    exit();
}



        if($_SESSION['role'] =='admin'){
            ?>
            <ul>
            <li><a href="">Dashboard</a></li>
            <li><a href="teacher.php">Add Teacher</a></li>
            <li><a href="">Delete user</a></li>
            <li><a href="">Edit user</a></li>
            <li><a href="">View profile</a></li>
            <li><a href="">Edit profile</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>
            <?php
        }

        if($_SESSION['role'] =='teachr'){
            ?>
            <ul>
            <li><a href="">Dashboard</a></li>
            <li><a href="teacher.php">Add Student</a></li>
            <li><a href="">Delete Student</a></li>
            <li><a href="">Edit Student</a></li>
            <!-- <li><a href="">View profile</a></li> -->
            <!-- <li><a href="">Edit profile</a></li> -->
            <li><a href="logout.php">Logout</a></li>
            </ul>
            <?php
        }

        if($_SESSION['role'] == 'user'){
            ?>
            <ul>
            <li><a href="">Dashboard</a></li>
            <li><a href="update.php">View profile</a></li>
            <li><a href="update.php">Edit profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
            <?php

        }
        
        ?>


        <!-- <ul>
            <li><i class="fa fa-home"></i>Dashborad</li>
            <li><i class="fa fa-layer-group"></i>Table</li>
            <li><i class="fa fa-cubes"></i>Transformation</li>
            <li><i class="fa fa-table"></i>About</li>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="teacher.php">Add teacher</a></li>
        </ul> -->
    </div>
    <div class="header">
        <h2> Dashboard</h2>
        <div class="user-area">
            <img src="image/download.png" style="width: 45px; height: 45px; border-radius: 50%; margin: right 10px;">Dipak
        </div>
    </div>



    <?php    
    include("connection.php");
    // session_start();
    $query = "SELECT * FROM USER";
    $data = mysqli_query($conn, $query);
?>

              <main class="content">
            <div class="table-container">
                <table border="2px" cellspacing="7" width="100%">
                <tr>
                    <th>id</th>
                    <th>first name</th>
                    <th>last name</th>
                    <th>email</th>
                    <th>password</th>
                     <th>role</th>
                    <th>Operation</th>
                   




                </tr>

                <?php 
                      while ($row = mysqli_fetch_assoc($data)) {
                    echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['fname'] . "</td>";
                        echo "<td>" . $row['lname'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        echo "<td>" . $row['role'] . "</td>";

                            echo "<td class='operation'>
                            <a href='update.php?id=" . $row['id'] . "'>
                            <input type='button' value='Update' class='update'>
                            </a>

                            
                            <a href='delete.php?id=" . $row['id'] . "'
                            onclick='return confirm(\"Are you sure you want to delete this record?\")'>
                            <input type='button' value='Delete' class='delete'>
                            </a></td>

                    </tr>";

}


?>

                </table>
            </div>

</main>

</body>
</html>