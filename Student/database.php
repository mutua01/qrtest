<?php

// Include your database connection file
include_once "../config/dbConn.php";

// Check if the form is submitted and the register_unit button is clicked
if (isset($_GET['user_id']) && isset($_GET['unit_id'])) {
    // Get the user ID and unit ID from the form
    $user_id = $_GET['user_id'];
    $unit_id = $_GET['unit_id'];

    echo $unit_id;
    // Check if the registration record already exists
    $sql_check = "SELECT * FROM unit_registration WHERE user_id = '$user_id' AND unit_id = '$unit_id'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        // Registration record already exists
        // echo "You are already registered for this unit.";
        session_start();

        // Set session variables for message and alert type
        $_SESSION['message'] = 'You are already registered for this unit.';
        $_SESSION['alert_type'] = 'warning'; // Possible values: 'success', 'info', 'warning', 'danger'

        // Redirect to a certain location
        header('Location: register-unit.php');
        exit; // Stop further execution


    } else {
        // Insert the registration data into the database
        $sql_insert = "INSERT INTO unit_registration (user_id, unit_id) VALUES ('$user_id', '$unit_id')";
        if (mysqli_query($conn, $sql_insert)) {
            // Registration successful
            // echo "Unit registration successful.";

            session_start();

            // Set session variables for message and alert type
            $_SESSION['message'] = 'Unit registration successful.';
            $_SESSION['alert_type'] = 'success'; // Possible values: 'success', 'info', 'warning', 'danger'

            // Redirect to a certain location
            header('Location: register-unit.php');
            exit; // Stop further execution



        } else {
            // Registration failed
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
        }
    }
} else {
    // If the form is not submitted, redirect the user back to the previous page
    // header("Location: " . $_SERVER['HTTP_REFERER']);
    // exit;
}



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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_profile"])) {

    session_start();
    // Retrieve new email and phone from the form
    $new_email = $_POST["new_email"];
    $new_phone = $_POST["new_phone"];

    // Update user form values in the database
    $user_id = $_SESSION['user_id']; // Assuming you have stored user_id in the session
    $sql = "UPDATE user_form SET email='$new_email', phone='$new_phone' WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Profile details updated successfully.";
        $_SESSION['alert_type'] = 'success';
        $_SESSION['user_email'] = $new_email;
        $_SESSION['user_phone'] = $new_phone;
    } else {
        $_SESSION['message'] = "Error updating profile details: " . $conn->error;
        $_SESSION['alert_type'] = 'danger';
    }

    // Redirect back to the page with the modal
    header('location: profile.php');
    exit;
}


// Close the database connection
mysqli_close($conn);

?>
