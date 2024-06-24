<?php
session_start();
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    // CSRF token does not match, reject the form submission
    die('Invalid CSRF token');
}
require 'db_connect.php';



// $currentAddress = $_POST['currentAddress'];
$homeAddress = $_POST['homeAddress'];
$email = $_POST['email'];
$countryCodeMobile = $_POST['countryCodeMobile'];
$mobilePhone = $_POST['mobilePhone'];
$height = $_POST['height'];
$weight = $_POST['weight'];
// $countryCodeHome = $_POST['countryCodeHome'];
// $homePhone = $_POST['homePhone'];

// Check if "Users" table exists, if not, create it
$sql = "CREATE TABLE IF NOT EXISTS Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'user',
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// Check if "Userdetails" table exists, if not, create it

$sql = "CREATE TABLE IF NOT EXISTS Userdetails (
    name VARCHAR(50) NOT NULL,
    homeAddress VARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    height DECIMAL(5,2),
    weight DECIMAL(5,2),
    countryCodeMobile VARCHAR(10),
    mobilePhone VARCHAR(20)
   
)";

if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error;
}


// Validate and insert data
$name = $_POST['name'];
if (!preg_match("/^[A-Za-z\s]+$/", $name)) {
    die("Invalid name");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = 'user'; // Set the role for the new user

    // Check if the email is already in use
    $sql = "SELECT * FROM Users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

// Validate and insert data
$name = $_POST['name'];
if (!preg_match("/^[A-Za-z\s]+$/", $name)) {
    die("Invalid name");
}

// $matricNo = $_POST['matricNo'];
// if (!preg_match("/^\d{5,10}$/", $matricNo)) {
//     die("Invalid matric number");
// }

$email = $_POST['email'];
if (!preg_match("/^.+@gmail.com$/", $email)) {
    die("Invalid email");
}

$countryCodeMobile = $_POST['countryCodeMobile'];
if (!preg_match("/^\+\d{1,3}$/", $countryCodeMobile)) {
    die("Invalid mobile country code");
}

$mobilePhone = $_POST['mobilePhone'];
if (!preg_match("/^\d{9,15}$/", $mobilePhone)) {
    die("Invalid mobile phone number");
}

// $countryCodeHome = $_POST['countryCodeHome'];
// if (!preg_match("/^\+\d{1,3}$/", $countryCodeHome)) {
//     die("Invalid home country code");
// }

// $homePhone = $_POST['homePhone'];
// if (!preg_match("/^\d{9,15}$/", $homePhone)) {
//     die("Invalid home phone number");
// }



    if ($result->num_rows > 0) {
        echo "<script type='text/javascript'>alert('Email is already in use'); window.location.href = 'registerPage.php';</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Users (email, password, role) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $hashed_password, $role);
        if ($stmt->execute() === TRUE) {
            echo "<script type='text/javascript'>alert('New user registered successfully'); window.location.href = 'loginPage.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "INSERT INTO Userdetails (name, homeAddress, email, height, weight, countryCodeMobile, mobilePhone) VALUES (?, ?, ?, ?, ?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssddss", $name, $homeAddress, $email, $height, $weight, $countryCodeMobile, $mobilePhone);
        

        if ($stmt->execute() === TRUE) {
            echo "<script type='text/javascript'>alert('New user registered successfully'); window.location.href = 'loginPage.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


$conn->close();
?>