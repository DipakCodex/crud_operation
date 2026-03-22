<?php
session_start(); // Pehle session start karna zaroori hai

session_unset(); // Saare session variables ko khali karne ke liye
session_destroy(); // Poora session khatam karne ke liye

// User ko logout ke baad login page par bhejne ke liye
header("location:index.php");
exit();
?>