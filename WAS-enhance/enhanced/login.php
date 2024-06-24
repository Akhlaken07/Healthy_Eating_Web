<?php
session_start();
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    // CSRF token does not match, reject the form submission
    die('Invalid CSRF token');
}
require 'db_connect.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT id, password, role FROM Users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Set the session variable
        $_SESSION['userid'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['useremail'] = $email;

        // Redirect based on role
        if ($user['role'] == 'admin') {
            header("Location: userDetailsPage.php");
        } else {
            header("Location: userPage.php");
        }
        exit;
    } else {
       
        echo "<script type='text/javascript'>alert('Invalid email or password'); window.location.href = 'loginPage.php';</script>";
    }
}

$conn->close();
?>