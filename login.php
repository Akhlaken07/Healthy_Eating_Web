<?php
session_start();
$conn = new mysqli('localhost','root','','healthywebsite');
if ($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING); 

    // Define the regex patterns
    $usernamePattern = "/^[a-zA-Z0-9]{5,}$/"; // Alphanumeric characters, at least 5
    $passwordPattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{7,}$/"; // Minimum eight characters, at least one letter and one number

    // Validate the inputs
    if (!preg_match($usernamePattern, $username)) {
        echo "<script>alert('Invalid username');</script>";
        return;
    }

    if (!preg_match($passwordPattern, $password)) {
        echo "<script>alert('Invalid password');</script>";
        return;
    }

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
<div style="display: flex; justify-content: center; gap: 10px;">
    <input type="submit" value="Login">
    <button type="button" onclick="window.location.href='index.php';">Go Back</button>
</div>
</form>

</div>

</body>
</html>