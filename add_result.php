<?php
session_start();
include 'db_connect.php';
if(!isset($_SESSION['admin_username'])) header("Location:index.php");

$students=$conn->query("SELECT * FROM Student");
$subjects=$conn->query("SELECT * FROM Subject");

if(isset($_POST['submit'])){
    $student_id=$_POST['student_id'];
    $subject_id=$_POST['subject_id'];
    $marks=$_POST['marks_obtained'];
    $grade=$_POST['grade'];
    $conn->query("INSERT INTO Result(student_id,subject_id,marks_obtained,grade) VALUES('$student_id','$subject_id','$marks','$grade')");
    $msg="Result added successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Result</title>
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
    select, input[type="number"], input[type="text"] {
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
        <h2>Add Result</h2>
        <form method="post">
            <label>Student:</label>
            <select name="student_id" required>
                <?php while($s=$students->fetch_assoc()) echo "<option value='{$s['student_id']}'>{$s['name']} ({$s['roll_no']})</option>"; ?>
            </select>

            <label>Subject:</label>
            <select name="subject_id" required>
                <?php while($sub=$subjects->fetch_assoc()) echo "<option value='{$sub['subject_id']}'>{$sub['subject_name']}</option>"; ?>
            </select>

            <label>Marks:</label>
            <input type="number" name="marks_obtained" required>

            <label>Grade:</label>
            <input type="text" name="grade">

            <button type="submit" name="submit">Add</button>
        </form>
        <?php if(isset($msg)) echo "<div class='msg'>$msg</div>"; ?>
        <a class="back-link" href="admin_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
