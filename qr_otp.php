<?php
declare(strict_types=1);
require 'vendor/autoload.php';
$secret = 'XVQ2UIGO75XRUKJO';
$link= \Sonata\GoogleAuthenticator\GoogleQrUrl::generate('heatlhyweb', $secret, 'Healthy_Eating_Web');
if (isset($_POST['otp-submit'])){
    $code=$_POST['pass-code'];
    $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
    
    if ($g->checkCode($secret, $code)) {
        header("Location: database_feedback.php"); 
        exit();
    } else {
        echo "NO \n";
    }   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Two Factor Authenticator using Google Authenticator</h1><br>
    <center><img src="<?=$link?>"></center><br>
    <center><h3>Scan the QR code to get the OTP</h3></center><br>
    <!-- Start of the form -->
    <form id="otp" action="" method="POST">
        <center><input type="text" name="pass-code" required></center><br>
        <center><input type="submit" name="otp-submit" value="Submit"></center>
    </form>
</body>
</html>