<?php
session_start();
include 'db_connect.php';
if(!isset($_SESSION['admin_username'])) header("Location:index.php");

if(isset($_POST['submit'])){
    $name = $_POST['department_name'];
    $sql = "INSERT INTO Department(department_name) VALUES('$name')";
    if($conn->query($sql)) $msg="Department added successfully!";
    else $msg="Error: ".$conn->error;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Department</title>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .container {
        background: #fff;
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }
    h2 {
        margin-bottom: 20px;
        color: #333;
    }
    input[type="text"] {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0 20px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }
    button {
        width: 100%;
        padding: 12px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
        background-color: #45a049;
    }
    .msg {
        margin: 15px 0;
        color: green;
        font-weight: bold;
    }
    .back-link {
        display: inline-block;
        margin-top: 10px;
        text-decoration: none;
        color: #555;
        transition: 0.3s;
    }
    .back-link:hover {
        color: #000;
    }
</style>
</head>
<body>
    <div class="container">
        <h2>Add Department</h2>
        <form method="post">
            <input type="text" name="department_name" placeholder="Enter department name" required>
            <button type="submit" name="submit">Add</button>
        </form>
        <?php if(isset($msg)) echo "<div class='msg'>$msg</div>"; ?>
        <a class="back-link" href="admin_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
