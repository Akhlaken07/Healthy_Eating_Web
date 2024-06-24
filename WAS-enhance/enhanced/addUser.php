<!-- code ini tidak lagi digunakan -->

<?php


require 'db_connect.php';

$currentAddress = $_POST['currentAddress'];
$homeAddress = $_POST['homeAddress'];
$email = $_POST['email'];
$countryCodeMobile = $_POST['countryCodeMobile'];
$mobilePhone = $_POST['mobilePhone'];
$countryCodeHome = $_POST['countryCodeHome'];
$homePhone = $_POST['homePhone'];

// Create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS Students (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    matricNo VARCHAR(30) NOT NULL,
    currentAddress VARCHAR(50),
    homeAddress VARCHAR(50),
    email VARCHAR(50),
    countryCodeMobile VARCHAR(5),
    mobilePhone VARCHAR(20),
    countryCodeHome VARCHAR(5),
    homePhone VARCHAR(20)
)";

if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error;
}
// Validate and insert data
$name = $_POST['name'];
if (!preg_match("/^[A-Za-z\s]+$/", $name)) {
    die("Invalid name");
}

$matricNo = $_POST['matricNo'];
if (!preg_match("/^\d{5,10}$/", $matricNo)) {
    die("Invalid matric number");
}

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

$countryCodeHome = $_POST['countryCodeHome'];
if (!preg_match("/^\+\d{1,3}$/", $countryCodeHome)) {
    die("Invalid home country code");
}

$homePhone = $_POST['homePhone'];
if (!preg_match("/^\d{9,15}$/", $homePhone)) {
    die("Invalid home phone number");
}

// Insert data into database

$sql = "INSERT INTO Students (name, matricNo, currentAddress, homeAddress, email, countryCodeMobile, mobilePhone, countryCodeHome, homePhone)
VALUES ('$name', '$matricNo', '$currentAddress', '$homeAddress', '$email', '$countryCodeMobile', '$mobilePhone', '$countryCodeHome', '$homePhone')";

if ($conn->query($sql) === TRUE) {
    if ($user['role'] == 'admin') {
        header("Location: studentDetailsPage.php?message=New Record created successfully");
    } else {
        header("Location: loginPage.php");
    }
    // header("Location: studentDetailsPage.php?message=New Record created successfully");
} else {
    exit( "Error: " . $sql . "<br>" . $conn->error);
}

$conn->close();
?>