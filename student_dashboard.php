<?php
session_start();
include 'db_connect.php';

if(!isset($_SESSION['student_username'])){
    header("Location: student_login.php");
    exit();
}

$username = $_SESSION['student_username'];

// Get student info
$student_sql = "
    SELECT s.name, s.roll_no, s.year, s.semester, d.department_name
    FROM Student s
    JOIN Department d ON s.department_id = d.department_id
    WHERE s.username='$username'
";
$student_res = $conn->query($student_sql);
$student = $student_res->fetch_assoc();

// Map numeric year to FE/SE/TE/BE
$year_map = [1 => "FE", 2 => "SE", 3 => "TE", 4 => "BE"];
$year_text = $year_map[$student['year']] ?? $student['year'];

// Get results
$sql = "
    SELECT sub.subject_id, sub.subject_name, r.marks_obtained, r.grade
    FROM Result r
    JOIN Subject sub ON r.subject_id = sub.subject_id
    JOIN Student s ON r.student_id = s.student_id
    WHERE s.username='$username'
    ORDER BY sub.subject_id
";
$result = $conn->query($sql);

// Prepare subjects array, calculate totals and pass/fail
$subjects = [];
$total_marks_obtained = 0;
$max_marks_per_subject = 100;
$has_fail = false;

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $subjects[] = $row;
        $total_marks_obtained += $row['marks_obtained'];
        if(strtoupper($row['grade']) == 'F'){ // Check if any subject failed
            $has_fail = true;
        }
    }
    $subject_count = count($subjects);
    $percentage = round(($total_marks_obtained / ($subject_count * $max_marks_per_subject)) * 100, 2);
    $sgpa = round(($percentage / 9.5), 3);
} else {
    $subject_count = 0;
    $percentage = 0;
    $sgpa = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Result</title>
<style>
    body { font-family: "Times New Roman", serif; background: #f4f4f4; padding: 20px; }
    .result-sheet { max-width: 800px; margin: auto; background: #fff; padding: 30px; border: 2px solid #333; }
    .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; position: relative; }
    .header .logo { position: absolute; top: -20px; left: 0; width: 80px; height: auto; }
    .header h1 { margin: 0; font-size: 22px; }
    .header h2 { margin: 5px 0; font-size: 18px; font-weight: normal; }
    .student-info { margin-bottom: 20px; }
    .student-info table { width: 100%; border-collapse: collapse; }
    .student-info td { padding: 5px 10px; }
    table.result-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    table.result-table th, table.result-table td { border: 1px solid #333; padding: 8px; text-align: center; }
    table.result-table th { background-color: #ddd; }
    table.result-table .fail-subject { background-color: #fdd; } /* highlight failed subject */
    .totals { text-align: right; font-weight: bold; }
    .status { text-align: center; font-size: 18px; font-weight: bold; margin-top: 10px; }
    .pass { color: green; }
    .fail { color: red; }
</style>
</head>
<body>
<div class="result-sheet">

    <!-- Header -->
    <div class="header">
        <img src="https://img.collegepravesh.com/2017/02/PICT-Logo.jpg" alt="PICT Logo" class="logo">
        <h1>Pune Institute of Computer Technology</h1>
        <h2>Semester Examination Result</h2>
    </div>

    <!-- Student Info -->
    <div class="student-info">
        <table>
            <tr>
                <td><strong>Name:</strong> <?php echo $student['name']; ?></td>
                <td><strong>Seat No:</strong> <?php echo $student['roll_no']; ?></td>
            </tr>
            <tr>
                <td><strong>Dept:</strong> <?php echo $student['department_name']; ?></td>
                <td><strong>Year:</strong> <?php echo $year_text; ?></td>
                <td><strong>Semester:</strong> <?php echo $student['semester']; ?></td>
            </tr>
        </table>
    </div>

    <!-- Subject Results -->
    <table class="result-table">
        <tr>
            <th>Sr. No.</th>
            <th>Subject Code</th>
            <th>Subject Name</th>
            <th>Marks Obtained</th>
            <th>Total Marks</th>
            <th>Grade</th>
        </tr>
        <?php
        if(!empty($subjects)){
            $sr = 1;
            foreach($subjects as $sub){
                $fail_class = (strtoupper($sub['grade']) == 'F') ? 'fail-subject' : '';
                echo "<tr class='$fail_class'>
                        <td>$sr</td>
                        <td>{$sub['subject_id']}</td>
                        <td>{$sub['subject_name']}</td>
                        <td>{$sub['marks_obtained']}</td>
                        <td>$max_marks_per_subject</td>
                        <td>{$sub['grade']}</td>
                      </tr>";
                $sr++;
            }
        } else {
            echo "<tr><td colspan='6'>No results found</td></tr>";
        }
        ?>
    </table>

    <!-- Totals -->
    <p class="totals">Total Marks Obtained: <?php echo $total_marks_obtained; ?> / <?php echo $subject_count * $max_marks_per_subject; ?></p>
    <p class="totals">SGPA: <?php echo $sgpa; ?> / 10</p>

    <!-- Pass/Fail Status -->
    <p class="status <?php echo $has_fail ? 'fail' : 'pass'; ?>">
        <?php echo $has_fail ? 'FAIL' : 'PASS'; ?>
    </p>

</div>
</body>
</html>
