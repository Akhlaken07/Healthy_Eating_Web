<?php
session_start();
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    // CSRF token does not match, reject the form submission
    die('Invalid CSRF token');
}
?>