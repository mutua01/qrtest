<?php
// Start session if not already started
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the add_unit button was clicked
    if (isset($_POST['add_unit'])) {

        
        // Include your database connection file
        include_once "../config/dbConn.php"; 
        

        // Escape user inputs for security
        $unitname = mysqli_real_escape_string($conn, $_POST['unitname']);
        $school_of =  mysqli_real_escape_string($conn, $_POST['school_of']);
        $course = mysqli_real_escape_string($conn, $_POST['course']);
        $year = mysqli_real_escape_string($conn, $_POST['year']);
        $semester = mysqli_real_escape_string($conn, $_POST['semester']);
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

       echo $school_of;

        // Attempt to insert the data into the database
        $sql = "INSERT INTO units (name, school, course, year, semester, user_id) VALUES ('$unitname', '$school_of', ' $course', '$year', '$semester', '$user_id')";
        if (mysqli_query($conn, $sql)) {
            // Data inserted successfully
            // echo "Record added successfully";
            $_SESSION['message'] = 'Record added successfully.';
            $_SESSION['alert_type'] = 'success';
        } else {
            // Error inserting data
            // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            $_SESSION['message'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
            $_SESSION['alert_type'] = 'danger';
        }

        header("Location: units.php");
        // Close database connection
        mysqli_close($conn);
    }


    if (isset($_POST['add_class'])) {

        include_once "../config/dbConn.php"; 
        
        // Retrieve the form data
        $date = $_POST['date'];
        $topic = $_POST['topic'];
        $unit_id = $_POST['unit_id'];
        $venue = $_POST['venue'];
        $time_from = $_POST['time_from'];
        $time_to = $_POST['time_to'];
        $user_id = $_POST['user_id'];

        // Validate and sanitize the data (optional)
        // You can add validation and sanitization if needed
         echo $unit_id;
        // Insert the data into the database
        $sql = "INSERT INTO classes (date, topic, unit_id, venue, time_from, time_to, user_id) 
                VALUES ('$date', '$topic', '$unit_id', '$venue', '$time_from', '$time_to', '$user_id')";

        if (mysqli_query($conn, $sql)) {
            // Data inserted successfully
            // echo "Class added successfully";

            $_SESSION['message'] = "Class added successfully";
            $_SESSION['alert_type'] = 'success';

        } else {
            // Error inserting data
            // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            $_SESSION['message'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
            $_SESSION['alert_type'] = 'danger';
        }
        header("Location: classes.php");
        // Close database connection
        mysqli_close($conn);

    }


    // Check if the form is submitted and the change_password button is clicked
if (isset($_POST['change_password'])) {
    // Get the current user's ID from the session

    include_once "../config/dbConn.php"; 

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

     mysqli_close($conn);
}


}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    include_once "../config/dbConn.php";

    // Prepare a delete statement
    $sql = "DELETE FROM units WHERE id = ?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to the units page with a success message
            header("location: units.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>


?>
