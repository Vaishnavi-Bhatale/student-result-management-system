<?php
session_start();
include 'db_connect.php';
if(!isset($_SESSION['admin_username'])) header("Location:index.php");

$departments=$conn->query("SELECT * FROM Department");
$teachers=$conn->query("SELECT * FROM Teacher");

if(isset($_POST['submit'])){
    $subject_name=$_POST['subject_name'];
    $year=$_POST['year'];
    $semester=$_POST['semester'];
    $credits=$_POST['credits'];
    $department_id=$_POST['department_id'];
    $teacher_id=$_POST['teacher_id'];
    $conn->query("INSERT INTO Subject(subject_name,year,semester,credits,department_id,teacher_id) VALUES('$subject_name','$year','$semester','$credits','$department_id','$teacher_id')");
    $msg="Subject added successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Subject</title>
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
        max-width: 450px;
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
        <h2>Add Subject</h2>
        <?php if(isset($msg)) echo "<div class='msg'>$msg</div>"; ?>
        <form method="post">
            <input type="text" name="subject_name" placeholder="Subject Name" required>
            <input type="number" name="year" min="1" max="4" placeholder="Year" required>
            <input type="number" name="semester" min="1" max="2" placeholder="Semester" required>
            <input type="number" name="credits" placeholder="Credits" required>

            <select name="department_id" required>
                <option value="">Select Department</option>
                <?php while($d=$departments->fetch_assoc()) echo "<option value='{$d['department_id']}'>{$d['department_name']}</option>"; ?>
            </select>

            <select name="teacher_id" required>
                <option value="">Select Teacher</option>
                <?php while($t=$teachers->fetch_assoc()) echo "<option value='{$t['teacher_id']}'>{$t['name']}</option>"; ?>
            </select>

            <button type="submit" name="submit">Add Subject</button>
        </form>
        <a class="back-link" href="admin_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
