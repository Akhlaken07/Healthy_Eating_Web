<?php
$conn = new mysqli('localhost', 'root', '', 'healthywebsite');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}

// Check if form data is submitted and all expected fields are filled
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['mail'], $_POST['phone'], $_POST['address'], $_POST['message']) && !empty($_POST['name']) && !empty($_POST['mail']) && !empty($_POST['phone']) && !empty($_POST['address']) && !empty($_POST['message'])) {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO feedback (name, mail, phone, address, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $mail, $phone, $address, $message);

    // Set parameters and execute
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $message = $_POST['message'];
    $stmt->execute();
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Contact</title>
      <link rel="stylesheet" href="css/Dstyles.css">
  </head>

  <body>
    <h1 style="background-color: black; color: white; text-align: center; padding: 15px 32px; font-family: serif; font-size: 32px;font-weight:bold;">Healthy Eating</h1>
  
    <header class="top-navbar">
      <nav class="navbar">
        <a class="nav-link" href="index.php" title="Home">Home</a>
        <a class="nav-link" href="about-us.html" title="About us">About us</a>
        <a class="nav-link" href="why-healthy-meal.html" title="Why Healthy Meal">Why Healthy Meal</a>
        <a class="nav-link" href="healthy-food.html" title="Healthy Food">Healthy Food</a>
        <a class="nav-link" href="contact.html" title="Contact">Contact</a>
        <a class="nav-link" href="about-your-body.html" title="About Your Body">About Your Body</a>
        <a class="nav-link" href="login.php" title="Admin Login" style=" right: 0; transform: translateY(-50%);">Admin Login</a>
      </nav>
    </header>

   <br><br>

<div class="contacts">
<img src="images\lappy.jpg" />

</div>

<div class="words">
<h1>Contact</h1>
<p>No. 244 MyTown, Cheras</p>
<p>healthyeating@gmail.com</p>
<p>016-5748329</p>

</div>

<div class="form">
<div class="transbox">

  <form id="myForm" onsubmit="alert('Message has been submitted.');return validateForm()" method="post">
    <label for="myname">Name: </label>
    <input type="text" id="name" name="name" required><br>
    <label for="myemail">Email: </label>
    <input type="text" id="mail" name="mail" required><br>
    <label for="myphone">Phone No: </label>
    <input type="text" id="phone" name="phone" required><br>
    <label for="myaddress">Address: </label>
    <input type="text" id="address" name="address" required><br>
    <label for="mysubject">Subject: </label>
    <input type="text" id="subject" name="subject" required><br>
    <label for="mymessage">Message: </label>
    <input type="texts" id="message" name="message" required><br>
    <button type="submit">Submit</button>
    <script src="regex.js"></script>
  </form>

</div>
</div>


<div class="contacts">
<img src="images\maps.png" />
<script src="js/regex.js"></script>

  </body>
</html>
