<?php
require 'sessionCheck.php';
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    // CSRF token does not match, reject the form submission
    die('Invalid CSRF token');
}
require 'db_connect.php';


// Check if the form data is present in the POST data
if ( !isset($_POST['name']) || !isset($_POST['email'])|| !isset($_POST['height']) || !isset($_POST['weight']) || !isset($_POST['homeAddress'])  || !isset($_POST['countryCodeMobile']) || !isset($_POST['mobilePhone'])) {
    die('Form data not provided');
}

// Get the form data from the POST data

$name = $_POST['name'];
$email = $_POST['email'];
$homeAddress = $_POST['homeAddress'];
$countryCodeMobile = $_POST['countryCodeMobile'];
$mobilePhone = $_POST['mobilePhone'];
$height = $_POST['height'];
$weight = $_POST['weight'];

    // Prepare a SQL statement to update the student
    $sql = 'UPDATE userdetails SET name = ?, email = ?, height = ?, weight = ?, homeAddress = ?, countryCodeMobile = ?, mobilePhone = ? WHERE email = ?';
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssddssss', $name, $email, $height, $weight, $homeAddress, $countryCodeMobile, $mobilePhone, $email);
    if ($stmt->execute()) {
         
        if ($_SESSION['role'] == 'admin') {
            header("Location: userDetailsPage.php?message=Record updated successfully");
        } else {
            header("Location: userPage.php");
        }
        // header("Location: studentDetailsPage.php?message=Record updated successfully");
        exit;
    }
     else {
        echo "Error updating record: " . $stmt->error;
    }

   
    $stmt->close();

$conn->close();
?>