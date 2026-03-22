<?php
session_start();
require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $otp = rand(1000, 9999); // 4-digit OTP
    $now = date("Y-m-d H:i:s");

    // Insert/update OTP in database
    $stmt = $conn->prepare("INSERT INTO users (email, otp_code, otp_created_at) VALUES (?, ?, ?)
    ON DUPLICATE KEY UPDATE otp_code=?, otp_created_at=?");
    $stmt->bind_param("sisss", $email, $otp, $now, $otp, $now);
    $stmt->execute();

    // Send OTP email
    $subject = "Your OTP Code";
    $message = "Your OTP is: $otp";
    $headers = "From: no-reply@example.com";

    if (mail($email, $subject, $message, $headers)) {
        $_SESSION["email"] = $email;
        header("Location: verify.php");
    } else {
        echo "Error sending OTP!";
    }
}
?>
