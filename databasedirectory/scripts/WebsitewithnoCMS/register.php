<?php
// Database connection parameters
$host = 'localhost'; // or your host
$dbUsername = 'root'; // or your db username
$dbPassword = ''; // or your db password
$dbName = 'your_database_name'; // your database name

// Establishing connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Hash the password - very important for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if username already exists
    $checkUser = $conn->query("SELECT id FROM users WHERE username = '$username'");
    if ($checkUser->num_rows > 0) {
        echo "Username already exists";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // Redirect to login page or wherever you want
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
