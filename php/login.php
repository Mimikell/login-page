<?php
session_start();
$servername = "localhost";  // Change if needed
$username = "root";  // Your database username
$password = "";  // Your database password
$dbname = "my_database";  // The database name where user info is stored

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Hashing password for security (optional)
    //$password = md5($password);
    
    // SQL query to check if the user exists
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, start the session
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // Redirect to dashboard or home page
    } else {
        echo "Invalid username or password.";
    }
}

$conn->close();
?>

