<?php
session_start();
include 'db_connect.php';

if(!isset($_SESSION['admin_username'])){
    header("Location: index.php");
    exit();
}

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $roll_no = $_POST['roll_no'];
    $name = $_POST['name'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $department_id = $_POST['department_id'];
    $password = $_POST['password'];

    $sql = "INSERT INTO Student (username, roll_no, name, year, semester, department_id, password) 
            VALUES ('$username', '$roll_no', '$name', '$year', '$semester', '$department_id', '$password')";

    if($conn->query($sql)){
        $msg = "<p class='success'>Student added successfully!</p>";
    } else {
        $msg = "<p class='error'>Error: ".$conn->error."</p>";
    }
}

// Fetch departments for dropdown
$departments = $conn->query("SELECT * FROM Department");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Student</title>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }
    .container {
        background: #fff;
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
        width: 100%;
        max-width: 500px;
        text-align: center;
    }
    h2 {
        margin-bottom: 25px;
        color: #333;
    }
    input, select {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0 20px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        box-sizing: border-box;
    }
    button {
        width: 100%;
        padding: 12px;
        background: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
        background: #218838;
    }
    .success {
        color: green;
        font-weight: bold;
        margin-bottom: 15px;
    }
    .error {
        color: red;
        font-weight: bold;
        margin-bottom: 15px;
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
        <h2>Add New Student</h2>
        <?php if(isset($msg)) echo $msg; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="roll_no" placeholder="Roll No" required>
            <input type="text" name="name" placeholder="Name" required>
            <input type="number" name="year" min="1" max="4" placeholder="Year" required>
            <input type="number" name="semester" min="1" max="2" placeholder="Semester" required>
            <select name="department_id" required>
                <option value="">Select Department</option>
                <?php while($dep = $departments->fetch_assoc()){ ?>
                    <option value="<?php echo $dep['department_id']; ?>"><?php echo $dep['department_name']; ?></option>
                <?php } ?>
            </select>
            <input type="text" name="password" placeholder="Password" required>
            <button type="submit" name="submit">Add Student</button>
        </form>
        <a class="back-link" href="admin_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
