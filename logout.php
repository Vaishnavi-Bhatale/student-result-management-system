<?php
session_start();
session_destroy(); // Ends the session
header("Location: index.php"); // Redirects to login page
exit();
?>
