<?php
session_start();
include 'db_connect.php';

if(!isset($_SESSION['teacher_username'])){
    header("Location: teacher_login.php");
    exit();
}

$username = $_SESSION['teacher_username'];
$teacher = $conn->query("SELECT * FROM Teacher WHERE username='$username'")->fetch_assoc();
$teacher_id = $teacher['teacher_id'];

function getGrade($marks){
    if($marks >= 90) return "O";
    elseif($marks >= 80) return "A+";
    elseif($marks >= 70) return "A";
    elseif($marks >= 60) return "B+";
    elseif($marks >= 50) return "B";
    elseif($marks >= 40) return "C";
    else return "F";
}

if(isset($_POST['submit_marks'])){
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $marks = $_POST['marks'];
    $grade = getGrade($marks);

    $check = $conn->query("SELECT * FROM Result WHERE student_id='$student_id' AND subject_id='$subject_id'");
    if($check->num_rows > 0){
        $conn->query("UPDATE Result SET marks_obtained='$marks', grade='$grade' 
                      WHERE student_id='$student_id' AND subject_id='$subject_id'");
        $message = "Marks updated successfully!";
    } else {
        $conn->query("INSERT INTO Result (student_id, subject_id, marks_obtained, grade) 
                      VALUES ('$student_id','$subject_id','$marks','$grade')");
        $message = "Marks added successfully!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", sans-serif;
            background: #f4f6fb;
        }
        /* Topbar */
        .topbar {
            background: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px;
        }
        .topbar h1 {
            font-size: 20px;
            color: #333;
        }
        .profile-menu {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
        .profile-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: url('default-profile.png') no-repeat center/cover;
        }
        .profile-text {
            display: flex;
            flex-direction: column;
            font-size: 14px;
        }
        .profile-text strong {
            color: #333;
        }
        .profile-text span {
            font-size: 12px;
            color: gray;
        }
        .fa-caret-down {
            margin-left: 8px;
            color: #333;
        }
        .dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 50px;
            background: white;
            min-width: 140px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 6px;
            z-index: 10;
        }
        .dropdown a {
            display: block;
            padding: 12px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
        }
        .dropdown a:hover {
            background: #f5f5f5;
        }
        .profile-menu.active .dropdown {
            display: block;
        }

        /* Cards */
        .container {
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .card h3 {
            margin-bottom: 15px;
            color: #4B49AC;
        }
        .message {
            padding: 12px;
            background: #e8f9ee;
            border-left: 5px solid #2d7a35;
            color: #2d7a35;
            margin-bottom: 15px;
            border-radius: 6px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #4B49AC;
            color: white;
            font-size: 15px;
        }
        input[type="number"] {
            width: 70px;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            background: #4B49AC;
            color: white;
            border: none;
            padding: 7px 15px;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #3a3796;
        }
    </style>
</head>
<body>
    <!-- Topbar -->
    <div class="topbar">
        <h1>Student Result Management</h1>
        <div class="profile-menu" onclick="this.classList.toggle('active')">
            <div class="profile-info">
                <div class="profile-pic"></div>
                <div class="profile-text">
                    <strong><?php echo $teacher['name']; ?></strong>
                    <span>Teacher</span>
                </div>
                <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown">
                <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
        </div>
    </div>

    <div class="container">
        <?php if(isset($message)) echo "<p class='message'>$message</p>"; ?>

        <?php
        $subjects = $conn->query("SELECT * FROM Subject WHERE teacher_id='$teacher_id'");
        while($sub = $subjects->fetch_assoc()){
            echo "<div class='card'>";
            echo "<h3>".$sub['subject_name']."</h3>";
            $sub_id = $sub['subject_id'];

            // Fetch subject details first
$sub_info = $conn->query("SELECT * FROM Subject WHERE subject_id='$sub_id'")->fetch_assoc();
$dept_id = $sub_info['department_id'];
$year = $sub_info['year'];
$sem = $sub_info['semester'];

// Now only get students of same dept, year, and semester
$results = $conn->query("
    SELECT r.result_id, s.name, s.student_id, s.roll_no, r.marks_obtained, r.grade
    FROM Student s
    LEFT JOIN Result r ON s.student_id = r.student_id AND r.subject_id='$sub_id'
    WHERE s.department_id='$dept_id' AND s.year='$year' AND s.semester='$sem'
");

            
            echo "<table>
                    <tr>
                        <th>Roll No</th>
                        <th>Student Name</th>
                        <th>Marks</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>";

            while($res = $results->fetch_assoc()){
                $marks_val = isset($res['marks_obtained']) ? $res['marks_obtained'] : '';
                $grade_val = isset($res['grade']) ? $res['grade'] : '';
                echo "<tr>
                        <td>{$res['roll_no']}</td>
                        <td>{$res['name']}</td>
                        <form method='post'>
                            <td><input type='number' name='marks' value='$marks_val' min='0' max='100' required></td>
                            <td>$grade_val</td>
                            <td>
                                <input type='hidden' name='student_id' value='{$res['student_id']}'>
                                <input type='hidden' name='subject_id' value='$sub_id'>
                                <button type='submit' name='submit_marks'>Save</button>
                            </td>
                        </form>
                      </tr>";
            }
            echo "</table></div>";
        }
        ?>
    </div>
</body>
</html>
