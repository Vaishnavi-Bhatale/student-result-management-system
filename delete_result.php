<?php
session_start();
include 'db_connect.php';
if(!isset($_SESSION['admin_username'])) header("Location:index.php");

$id = $_GET['id'] ?? 0;

// Fetch result info for confirmation
$result = $conn->query("SELECT r.result_id, s.name AS student_name, sub.subject_name 
                        FROM Result r
                        JOIN Student s ON r.student_id = s.student_id
                        JOIN Subject sub ON r.subject_id = sub.subject_id
                        WHERE r.result_id='$id'")->fetch_assoc();

if(isset($_POST['confirm'])){
    $conn->query("DELETE FROM Result WHERE result_id='$id'");
    header("Location: admin_dashboard.php");
    exit();
}

if(isset($_POST['cancel'])){
    header("Location: admin_dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Delete Result</title>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #f8d7da;
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
        max-width: 400px;
        text-align: center;
    }
    h2 {
        margin-bottom: 20px;
        color: #721c24;
    }
    p {
        margin-bottom: 25px;
        color: #721c24;
        font-weight: bold;
    }
    button {
        padding: 12px 20px;
        margin: 0 10px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }
    .confirm {
        background: #dc3545;
        color: white;
    }
    .confirm:hover {
        background: #c82333;
    }
    .cancel {
        background: #6c757d;
        color: white;
    }
    .cancel:hover {
        background: #5a6268;
    }
</style>
</head>
<body>
    <div class="container">
        <h2>Delete Result</h2>
        <p>Are you sure you want to delete the result of <strong><?php echo htmlspecialchars($result['student_name']); ?></strong> for subject <strong><?php echo htmlspecialchars($result['subject_name']); ?></strong>?</p>
        <form method="post">
            <button class="confirm" name="confirm" type="submit">Yes, Delete</button>
            <button class="cancel" name="cancel" type="submit">Cancel</button>
        </form>
    </div>
</body>
</html>
