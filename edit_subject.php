<?php
session_start();
include 'db_connect.php';
if(!isset($_SESSION['admin_username'])) header("Location:index.php");

$id = $_GET['id'];
$subject = $conn->query("SELECT * FROM Subject WHERE subject_id='$id'")->fetch_assoc();
$departments = $conn->query("SELECT * FROM Department");
$teachers = $conn->query("SELECT * FROM Teacher");

if(isset($_POST['submit'])){
    $subject_name = $_POST['subject_name'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $credits = $_POST['credits'];
    $department_id = $_POST['department_id'];
    $teacher_id = $_POST['teacher_id'];

    $conn->query("UPDATE Subject SET subject_name='$subject_name', year='$year', semester='$semester', credits='$credits', department_id='$department_id', teacher_id='$teacher_id' WHERE subject_id='$id'");
    header("Location: admin_dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Subject</title>
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
        color: #333;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
        background: #218838;
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
        <h2>Edit Subject</h2>
        <form method="post">
            <input type="text" name="subject_name" placeholder="Subject Name" value="<?php echo $subject['subject_name']; ?>" required>
            <input type="number" name="credits" placeholder="Credits" value="<?php echo $subject['credits']; ?>" required>
            <input type="number" name="year" placeholder="Year" min="1" max="4" value="<?php echo $student['year']; ?>" required>
            <input type="number" name="semester" placeholder="Semester" min="1" max="2" value="<?php echo $student['semester']; ?>" required>
            <select name="department_id" required>
                <option value="">Select Department</option>
                <?php while($d = $departments->fetch_assoc()){ ?>
                    <option value="<?php echo $d['department_id']; ?>" <?php if($d['department_id']==$subject['department_id']) echo 'selected'; ?>>
                        <?php echo $d['department_name']; ?>
                    </option>
                <?php } ?>
            </select>

            <select name="teacher_id" required>
                <option value="">Select Teacher</option>
                <?php while($t = $teachers->fetch_assoc()){ ?>
                    <option value="<?php echo $t['teacher_id']; ?>" <?php if($t['teacher_id']==$subject['teacher_id']) echo 'selected'; ?>>
                        <?php echo $t['name']; ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit" name="submit">Update Subject</button>
        </form>
        <a class="back-link" href="admin_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
