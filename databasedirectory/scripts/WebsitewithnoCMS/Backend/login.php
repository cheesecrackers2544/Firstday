<?php
// login.php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $host = 'localhost'; // or your host
    $dbUsername = 'root'; // or your db username
    $dbPassword = ''; // or your db password
    $dbName = 'your_database_name'; // your database name

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login success
        $_SESSION['username'] = $username;
        header("Location: welcome.php"); // redirect to welcome page or dashboard
    } else {
        echo "Invalid username or password";
    }

    $conn->close();
}
?>
