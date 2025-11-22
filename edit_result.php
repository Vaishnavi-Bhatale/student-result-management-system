<?php
session_start();
include 'db_connect.php';
if(!isset($_SESSION['admin_username'])) header("Location:index.php");

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM Result WHERE result_id='$id'")->fetch_assoc();
$students = $conn->query("SELECT * FROM Student");
$subjects = $conn->query("SELECT * FROM Subject");

if(isset($_POST['submit'])){
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $marks_obtained = $_POST['marks_obtained'];
    $grade = $_POST['grade'];

    $conn->query("UPDATE Result SET student_id='$student_id', subject_id='$subject_id', marks_obtained='$marks_obtained', grade='$grade' WHERE result_id='$id'");
    header("Location: admin_dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Result</title>
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
        background: #17a2b8;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
        background: #117a8b;
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
        <h2>Edit Result</h2>
        <form method="post">
            <label>Student:</label>
            <select name="student_id" required>
                <?php while($s = $students->fetch_assoc()){ ?>
                    <option value="<?php echo $s['student_id']; ?>" <?php if($s['student_id']==$result['student_id']) echo 'selected'; ?>>
                        <?php echo $s['name']." (".$s['roll_no'].")"; ?>
                    </option>
                <?php } ?>
            </select>

            <label>Subject:</label>
            <select name="subject_id" required>
                <?php while($sub = $subjects->fetch_assoc()){ ?>
                    <option value="<?php echo $sub['subject_id']; ?>" <?php if($sub['subject_id']==$result['subject_id']) echo 'selected'; ?>>
                        <?php echo $sub['subject_name']; ?>
                    </option>
                <?php } ?>
            </select>

            <label>Marks Obtained:</label>
            <input type="number" name="marks_obtained" value="<?php echo $result['marks_obtained']; ?>" required>

            <label>Grade:</label>
            <input type="text" name="grade" value="<?php echo $result['grade']; ?>">

            <button type="submit" name="submit">Update</button>
        </form>
        <a class="back-link" href="admin_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
