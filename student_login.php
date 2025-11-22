<?php
session_start();
include 'db_connect.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Student WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows == 1){
        $_SESSION['student_username'] = $username;
        header("Location: student_dashboard.php");
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<form method="post">
    Username: <input type="text" name="username" required>
    Password: <input type="password" name="password" required>
    <button type="submit" name="login">Login</button>
</form>
<?php if(isset($error)) echo $error; ?>
