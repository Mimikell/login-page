<?php
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $reset_link = "http://webssystems.com/reset-password.php";
        echo "Click here to reset your password: " . $reset_link;
    } else {
        echo "No account found with that email.";
    }
}
?>

