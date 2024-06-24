

<!DOCTYPE html>
<html>
<head>
    <title>User Page</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4l+U6D4U1SJ2mOz1meY2wm1xP5eNJmj6eXplicitv49K5BdPtF+to8xM6B5z" crossorigin="anonymous"></script>
</head>
<body>

<?php

require 'sessionCheck.php';
header("Content-Security-Policy: default-src 'self' https://stackpath.bootstrapcdn.com; script-src 'self' 'unsafe-inline'");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
require 'db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['useremail'])) {
    die('You are not logged in');
}

// If the form is submitted, update the user's details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }
    $name = $_POST['name'];
    $matricNo = $_POST['matricNo'];
    $currentAddress = $_POST['currentAddress'];
    $homeAddress = $_POST['homeAddress'];
    $email = $_POST['email'];
    $countryCodeMobile = $_POST['countryCodeMobile'];
    $mobilePhone = $_POST['mobilePhone'];
    $countryCodeHome = $_POST['countryCodeHome'];
    $homePhone = $_POST['homePhone'];

    $sql = "UPDATE Students SET name = ?, matricNo = ?, currentAddress = ?, homeAddress = ?, email = ?, countryCodeMobile = ?, mobilePhone = ?, countryCodeHome = ?, homePhone = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $name, $matricNo, $currentAddress, $homeAddress, $email, $countryCodeMobile, $mobilePhone, $countryCodeHome, $homePhone, $_SESSION['useremail']);

   
    if ($stmt->execute()) {
        echo "<script>alert('Details updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating details');</script>";
    }
    
}

// Get the user's details from the database
$sql = "SELECT id, name, matricNo, currentAddress, homeAddress, email, countryCodeMobile, mobilePhone, countryCodeHome, homePhone FROM Students WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['useremail']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die('User not found');
}

$conn->close();
?>
<div class="container">
        <div class="py-5 text-center">
            <h2>Welcome,  <?php echo $_SESSION['useremail']; echo "<br>session_id(): ".session_id();?>!</h2>
            <form action="logout.php" method="post" class="logout-button">
                <input type="submit" value="Logout" class="btn btn-primary">
            </form>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-3">User Details</h4>
                <form action="userPage.php" method="post" class="needs-validation" novalidate>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="email" value="<?php echo $data['email']; ?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="matricNo">Matric No:</label>
                            <input type="text" id="matricNo" name="matricNo" value="<?php echo htmlspecialchars($user['matricNo']); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="currentAddress">Current Address:</label>
                        <input type="text" id="currentAddress" name="currentAddress" value="<?php echo htmlspecialchars($user['currentAddress']); ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="homeAddress">Home Address:</label>
                        <input type="text" id="homeAddress" name="homeAddress" value="<?php echo htmlspecialchars($user['homeAddress']); ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="form-control" required readonly>
                    </div>

                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label for="countryCodeMobile">Country Code Mobile:</label>
                            <input type="text" id="countryCodeMobile" name="countryCodeMobile" value="<?php echo htmlspecialchars($user['countryCodeMobile']); ?>" class="form-control" required>
                        </div>
                        <div class="col-md-10 mb-3">
                            <label for="mobilePhone">Mobile Phone:</label>
                            <input type="text" id="mobilePhone" name="mobilePhone" value="<?php echo htmlspecialchars($user['mobilePhone']); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label for="countryCodeHome">Country Code Home:</label>
                            <input type="text" id="countryCodeHome" name="countryCodeHome" value="<?php echo htmlspecialchars($user['countryCodeHome']); ?>" class="form-control" required>
                        </div>
                        <div class="col-md-10 mb-3">
                            <label for="homePhone">Home Phone:</label>
                            <input type="text" id="homePhone" name="homePhone" value="<?php echo htmlspecialchars($user['homePhone']); ?>" class="form-control" required>
                        </div>
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>