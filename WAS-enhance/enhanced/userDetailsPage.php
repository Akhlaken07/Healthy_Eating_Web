<?php
 
require 'sessionCheck.php';
header("Content-Security-Policy: default-src 'self' https://stackpath.bootstrapcdn.com; script-src 'self' 'unsafe-inline'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>Welcome, <?php echo $_SESSION['role']; echo "<br>session_id(): ".session_id();?>!</p>
                <form action="logout.php" method="post" class="float-right">
                    <input type="submit" value="Logout" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center my-5">
                <h1>User Details Table</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <tbody id="data-container">
                        <script src="js/loadUser.js"></script>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if (isset($_GET['message'])): ?>
            <div class="row">
                <div class="col-12">
                    <div id="message" class="alert alert-success" role="alert">
                        <?php echo htmlspecialchars($_GET['message']); ?>
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById('message').style.display = 'none';
                        }, 3000);
                    </script>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>