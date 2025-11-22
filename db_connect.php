<?php
$servername = "localhost";
$username   = "root";
$password   = "";           // default for XAMPP
$dbname     = "student_result";  // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>