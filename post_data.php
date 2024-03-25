<?php
session_start();

// Include your database connection file
include_once "config/dbConn.php"; 

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in, proceed with posting data to the database

    // Check if the class ID is present in the URL
    if (isset($_GET['class_id'])) {
        // Retrieve class ID from the query parameters
        $class_id = $_GET['class_id'];

        // Get the user ID from the session
        $user_id = $_SESSION['user_id'];

        // Check if the attendance record already exists
        $check_sql = "SELECT * FROM attendance WHERE student_id = '$user_id' AND class_id = '$class_id'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            // Attendance record already exists, send an info alert
            $_SESSION['message'] = "You have already signed attendance for this class.";
            $_SESSION['alert_type'] = 'info';
            header("Location: student/attendance-records.php");
        } else {
            // Attendance record does not exist, insert the data into the database
            $insert_sql = "INSERT INTO attendance (student_id, class_id) VALUES ('$user_id', '$class_id')";
            if (mysqli_query($conn, $insert_sql)) {
                // Insert successful, redirect with success message
                $_SESSION['message'] = "Attendance recorded successfully.";
                $_SESSION['alert_type'] = 'success';
                header("Location: student/attendance-records.php");
            } else {
                // Insert failed, display error message
                echo "Error: " . $insert_sql . "<br>" . mysqli_error($conn);
            }
        }

    } else {
        // Handle the case where class ID is missing
        echo "Invalid request. Please provide the class ID.";
    }
    mysqli_close($conn);
} else {
    // User is not logged in, redirect them to the login page along with the class ID
    if (isset($_GET['class_id'])) {
        $class_id = $_GET['class_id'];
        header("Location: login.php?class_id=$class_id");
    } else {
        // Handle the case where class ID is missing
        echo "Invalid request. The class ID is not provided.";
    }
}
?>
