
<?php
session_start();
header("Content-Security-Policy: default-src 'self' https://stackpath.bootstrapcdn.com");
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>

<html>
<head>
<title>Registration Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <h1 class="text-center" style="color: #1f558f; font-family: 'Arial', sans-serif; font-weight: bold; padding: 20px;">Registration</h1>
    <div class="container h-100">
        
            <div class="row justify-content-center">
                  <script src="js/validation.js"></script>
                <form action="register.php" method="post" onsubmit="return validateForm()" class="col-4">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div class="form-group mt-3">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" pattern="[A-Za-z\s]+" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="height">Height (cm):</label>
                        <input type="number" id="height" name="height" min="0" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight (kg):</label>
                        <input type="number" id="weight" name="weight" min="0" class="form-control">
                    </div>
                    <!-- <div class="form-group">
                        <label for="matricNo">Matric No:</label>
                        <input type="text" id="matricNo" name="matricNo" pattern="\d{5,10}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="currentAddress">Current Address:</label>
                        <input type="text" id="currentAddress" name="currentAddress" class="form-control">
                    </div> -->
                    <div class="form-group">
                        <label for="homeAddress">Home Address:</label>
                        <input type="text" id="homeAddress" name="homeAddress" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="countryCodeMobile">Mobile Phone No:</label>
                        <div class="row">
                            <div class="col-3">
                                <input type="text" id="countryCodeMobile" name="countryCodeMobile" placeholder="Country Code" pattern="\+\d{1,3}" class="form-control">
                            </div>
                          <p class="mt-1">-</p>
                            <div class="col">
                                <input type="text" id="mobilePhone" name="mobilePhone" pattern="\d{9,12}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="countryCodeHome">Home Phone No (Emergency):</label>
                        <div class="row">
                            <div class="col-3">
                                <input type="text" id="countryCodeHome" name="countryCodeHome" placeholder="Country Code" pattern="\+\d{1,3}" class="form-control">
                            </div>
                            <p class="mt-1">-</p>
                            <div class="col">
                                <input type="text" id="homePhone" name="homePhone" pattern="\d{9,12}" class="form-control">
                            </div>
                        </div>
                    </div> -->

                    <input type="submit" value="Register" class="btn btn-primary">
                    <p class="mt-3">Already have an account? <a href="loginPage.php" style="margin-left: 10px;">Log in</a></p>
                </form>
             
                
            </div>
        
    </div>
</body>
</html>