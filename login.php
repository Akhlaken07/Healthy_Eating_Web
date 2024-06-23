<?php
session_start();
$conn = new mysqli('localhost','root','','healthywebsite');
if ($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $stmt = $conn->prepare("SELECT * FROM userdetails WHERE uname=? AND pwd=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result(); 

    if ($result->num_rows > 0) {
        header("Location: qr_otp.php"); 
        exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <div style="display: flex; flex-direction: column; justify-content: flex-start; align-items: center; height: 100vh;">
    <h1>Login</h1><br>

    <form id="login" action="#" method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username"><br><br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password"><br><br>
    <input type="submit" value="Login">
    </form>
    </div>

</body>
</html>