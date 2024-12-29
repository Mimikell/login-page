<?php
session_start();

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "my_database";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = mysqli_real_escape_string($conn, $_POST['username']);
    $inputPassword = mysqli_real_escape_string($conn, $_POST['password']);
    
    //$inputPassword = md5($inputPassword);
    
    $sql = "SELECT * FROM users WHERE username='$inputUsername' AND password='$inputPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $inputUsername;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}

$conn->close();
?>
