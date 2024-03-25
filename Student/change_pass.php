<?php

// Include your database connection file
include_once "../config/dbConn.php";

// Check if the form is submitted and the change_password button is clicked
if (isset($_POST['change_password'])) {
    // Get the current user's ID from the session
    session_start();

    $user_id = $_SESSION['user_id'];

    // Get the current password, new password, and confirm password from the form
    $currentPassword = mysqli_real_escape_string($conn, $_POST['currentPassword']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    // echo $currentPassword;
    // Check if the new password and confirm password match
    if ($newPassword === $confirmPassword) {
        // Encrypt the passwords using md5
        $currentPassword = md5($currentPassword);
        $newPassword = md5($newPassword);

        // Check if the current password matches the password in the database
        $sql = "SELECT * FROM user_form WHERE id = '$user_id' AND password = '$currentPassword'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            // Update the password in the database
            $updateSql = "UPDATE user_form SET password = '$newPassword' WHERE id = '$user_id'";
            if (mysqli_query($conn, $updateSql)) {
                // Password updated successfully
                $_SESSION['message'] = 'Password changed successfully.';
                $_SESSION['alert_type'] = 'success';
            } else {
                // Error updating password
                $_SESSION['message'] = 'Error changing password.';
                $_SESSION['alert_type'] = 'danger';
            }
        } else {
            // Current password does not match
            $_SESSION['message'] = 'Current password is incorrect.';
            $_SESSION['alert_type'] = 'danger';
        }
    } else {
        // New password and confirm password do not match
        $_SESSION['message'] = 'New password and confirm password do not match.';
        $_SESSION['alert_type'] = 'danger';
    }

    // Redirect back to the change password page
     header("Location: change-password.php");
     exit;
}


// Close the database connection
mysqli_close($conn);

?>
