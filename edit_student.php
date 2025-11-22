<?php
session_start();
include 'db_connect.php';

if(!isset($_SESSION['admin_username'])){
    header("Location: index.php");
    exit();
}

$id = $_GET['id'] ?? 0;

$student = $conn->query("SELECT * FROM Student WHERE student_id='$id'")->fetch_assoc();
$departments = $conn->query("SELECT * FROM Department");

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $roll_no = $_POST['roll_no'];
    $name = $_POST['name'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $department_id = $_POST['department_id'];
    $password = $_POST['password'];

    $sql = "UPDATE Student SET username='$username', roll_no='$roll_no', name='$name', year='$year', semester='$semester', department_id='$department_id', password='$password' WHERE student_id='$id'";

    if($conn->query($sql)){
        $msg = "<p class='success'>Student updated successfully!</p>";
    } else {
        $msg = "<p class='error'>Error: ".$conn->error."</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Student</title>
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
        margin-top: 15px;
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
        <h2>Edit Student</h2>
        <?php if(isset($msg)) echo $msg; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" value="<?php echo $student['username']; ?>" required>
            <input type="text" name="roll_no" placeholder="Roll No" value="<?php echo $student['roll_no']; ?>" required>
            <input type="text" name="name" placeholder="Name" value="<?php echo $student['name']; ?>" required>
            <input type="number" name="year" placeholder="Year" min="1" max="4" value="<?php echo $student['year']; ?>" required>
            <input type="number" name="semester" placeholder="Semester" min="1" max="2" value="<?php echo $student['semester']; ?>" required>
            <select name="department_id" required>
                <option value="">Select Department</option>
                <?php while($dep = $departments->fetch_assoc()){ ?>
                    <option value="<?php echo $dep['department_id']; ?>" <?php if($dep['department_id']==$student['department_id']) echo 'selected'; ?>>
                        <?php echo $dep['department_name']; ?>
                    </option>
                <?php } ?>
            </select>
            <input type="text" name="password" placeholder="Password" value="<?php echo $student['password']; ?>" required>
            <button type="submit" name="submit">Update Student</button>
        </form>
        <a class="back-link" href="admin_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
