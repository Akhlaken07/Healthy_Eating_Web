<?php
require 'sessionCheck.php';
require 'db_connect.php';

$sql = "SELECT  name, homeAddress, email, countryCodeMobile, mobilePhone, weight, height FROM Userdetails";
$result = $conn->query($sql);

echo '<table class="table table-bordered">';
echo '<tr><th>Name</th><th>Email</th><th>height</th><th>weight</th><th>Home Address</th><th>Mobile Phone</th><th>Edit</th><th>Delete</th></tr>';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>'.htmlspecialchars($row["name"]).'</td>';
        // echo '<td>'.htmlspecialchars($row["matricNo"]).'</td>';
        // echo '<td>'.htmlspecialchars($row["currentAddress"]).'</td>';
        echo '<td>'.htmlspecialchars($row["email"]).'</td>';   
        echo '<td>'.htmlspecialchars($row["height"]).'</td>';
        echo '<td>'.htmlspecialchars($row["weight"]).'</td>';
        echo '<td>'.htmlspecialchars($row["homeAddress"]).'</td>';
        echo '<td>'.htmlspecialchars($row["countryCodeMobile"].$row["mobilePhone"]).'</td>';
        // echo '<td>'.htmlspecialchars($row["countryCodeHome"].$row["homePhone"]).'</td>';    
        
        echo "<td>
                        <form action='editUserPage.php' method='post'>
                                <input type='hidden' name='email' value='" . $row['email'] . "'>
                                <input type='submit' value='Edit' class='btn btn-primary'>
                        </form>
                    </td>";
        echo "<td>
                        <form action='deleteUser.php' method='post'>
                                <input type='hidden' name='email' value='" . $row['email'] . "'>
                                <input type='submit' value='Delete' class='btn btn-danger'>
                        </form>
                    </td>";
        
    }
} else {
    echo '<tr><td colspan="9">No data found</td></tr>';
}

$conn->close();
?>