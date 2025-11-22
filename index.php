<?php
session_start();
include 'db_connect.php';

if(isset($_POST['role'], $_POST['username'], $_POST['password'])){
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($role == 'student'){
        $sql = "SELECT * FROM Student WHERE username='$username' AND password='$password'";
        $redirect = "student_dashboard.php";
    } elseif($role == 'teacher'){
        $sql = "SELECT * FROM Teacher WHERE username='$username' AND password='$password'";
        $redirect = "teacher_dashboard.php";
    } elseif($role == 'admin'){
        $sql = "SELECT * FROM Admin WHERE username='$username' AND password='$password'";
        $redirect = "admin_dashboard.php";
    } else {
        $error = "Please select a valid role!";
    }

    if(isset($sql)){
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            // Set session based on role
            if($role == 'student') $_SESSION['student_username'] = $username;
            if($role == 'teacher') $_SESSION['teacher_username'] = $username;
            if($role == 'admin') $_SESSION['admin_username'] = $username;

            header("Location: $redirect");
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Result Management System</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;}
    body{background:linear-gradient(135deg,#6a11cb 0%,#2575fc 100%);min-height:100vh;display:flex;justify-content:center;align-items:center;padding:20px;}
    .container{width:100%;max-width:450px;}
    .login-card{background-color:white;border-radius:15px;box-shadow:0 10px 30px rgba(0,0,0,0.2);overflow:hidden;}
    .header{background:linear-gradient(to right,#2575fc,#6a11cb);color:white;padding:25px;text-align:center;}
    .header h1{font-size:24px;margin-bottom:5px;}
    .header p{font-size:14px;opacity:0.9;}
    .login-form{padding:30px;}
    .form-group{margin-bottom:20px;}
    label{display:block;margin-bottom:8px;font-weight:600;color:#333;}
    input, select{width:100%;padding:12px 15px;border:1px solid #ddd;border-radius:8px;font-size:16px;transition:border 0.3s;}
    input:focus, select:focus{border-color:#2575fc;outline:none;box-shadow:0 0 0 2px rgba(37,117,252,0.2);}
    .btn{background:linear-gradient(to right,#2575fc,#6a11cb);color:white;border:none;padding:14px;border-radius:8px;font-size:16px;font-weight:600;cursor:pointer;width:100%;transition:all 0.3s;}
    .btn:hover{background:linear-gradient(to right,#1c68e3,#5a0dc5);box-shadow:0 5px 15px rgba(37,117,252,0.4);}
    @media(max-width:480px){.login-card{border-radius:10px;}.header{padding:20px;}.login-form{padding:20px;}}
    .error{color:red;text-align:center;margin-top:10px;}
</style>
</head>
<body>
<div class="container">
    <div class="login-card">
        <div class="header">
            <h1>Student Result Management System</h1>
            <p>Login to access your account</p>
        </div>
        <form class="login-form" method="POST">
            <div class="form-group">
                <label for="role">Select Role</label>
                <select id="role" name="role" required>
                    <option value="">-- Select your role --</option>
                    <option value="admin">Administrator</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn">Login</button>
            <?php if(isset($error)){ echo "<p class='error'>$error</p>"; } ?>
        </form>
    </div>
</div>
</body>
</html>
