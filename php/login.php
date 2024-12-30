<?php
session_start();

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "1234";
$dbname = "login_system";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$inputUsername' AND password='$inputPassword'";
    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $inputUsername;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}

mysqli_close($conn);
?>

