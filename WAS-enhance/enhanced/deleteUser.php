<?php
require 'sessionCheck.php';
require 'db_connect.php';

$email = $_POST['email'];

// Prepare a SQL statement to delete the student from Userdetails table
$sql = "DELETE FROM Userdetails WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);

// Execute the statement
if ($stmt->execute()) {
    // Prepare a SQL statement to delete the user from Userdetails table
    $sql = "DELETE FROM Userdetails WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: userDetailsPage.php?message=Record deleted successfully");
    } else {
        echo "Error deleting record from Userdetails: " . $stmt->error;
    }
} else {
    echo "Error deleting record from Userdetails: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>