<?php
session_start();
include 'db_connect.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Teacher WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows == 1){
        $_SESSION['teacher_username'] = $username;
        header("Location: teacher_dashboard.php");
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<h2>Teacher Login</h2>
<form method="post">
    Username: <input type="text" name="username" required>
    Password: <input type="password" name="password" required>
    <button type="submit" name="login">Login</button>
</form>
<?php if(isset($error)) echo $error; ?>
