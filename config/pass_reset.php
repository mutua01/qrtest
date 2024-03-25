<?php

// Database connection
@include 'dbConn.php';

// Step 6: Reset Password
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["new_password"])) {
    $new_password = $_POST["new-password"];

    $email = $_POST["email"];
    $sql = "UPDATE user_form SET password='$new_password' WHERE email='$email'";
    if ($conn->query($sql) === TRUE) {
        echo "Password reset successfully.";
    } else {
        echo "Error updating password: " . $conn->error;
    }
}

$conn->close();
?>