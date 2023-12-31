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
    $managementContactName = $conn->real_escape_string($_POST['managementContactName']);
    $managementContactPhone = $conn->real_escape_string($_POST['managementContactPhone']);
    $ownerEmail = $conn->real_escape_string($_POST['ownerEmail']);
    $password = $conn->real_escape_string($_POST['password']);

    // Hash the password - very important for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $checkUser = $conn->prepare("SELECT OwnerID FROM Owner_Profiles WHERE OwnerEmail = ?");
    $checkUser->bind_param("s", $ownerEmail);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        echo "Email already exists";
    } else {
        // Insert the new user into the database
        $insertStmt = $conn->prepare("INSERT INTO Owner_Profiles (ManagementContactName, ManagementContactPhone, OwnerEmail, Password, EmailVerified) VALUES (?, ?, ?, ?, FALSE)");
        $insertStmt->bind_param("ssss", $managementContactName, $managementContactPhone, $ownerEmail, $hashedPassword);
        $insertStmt->execute();

        if ($insertStmt->affected_rows > 0) {
            echo "New record created successfully. Please verify your email.";

            // Generate a unique verification token
            $token = bin2hex(random_bytes(50)); // 50 bytes = 100 hex characters

            // Retrieve the ID of the newly inserted user
            $newUserId = $conn->insert_id;

            // Update the user record with this verification token
            $updateTokenSql = "UPDATE Owner_Profiles SET VerificationToken = ? WHERE OwnerID = ?";
            $tokenStmt = $conn->prepare($updateTokenSql);
            $tokenStmt->bind_param("si", $token, $newUserId);
            $tokenStmt->execute();
            $tokenStmt->close();

            // Prepare verification link
            $verificationLink = "http://localhost/verify-email.php?token=" . $token;

            // Send the verification email
            $to = $ownerEmail;
            $subject = "Email Verification";
            $message = "Please click on the following link to verify your email: " . $verificationLink;
            $headers = 'From: noreply@yourwebsite.com' . "\r\n" .
                       'Reply-To: noreply@yourwebsite.com' . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
            echo "Verification email sent.";
        } else {
            echo "Error: " . $insertStmt->error;
        }
        $insertStmt->close();
    }

    $checkUser->close();
    $conn->close();
}
?>

