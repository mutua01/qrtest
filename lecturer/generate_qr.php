<?php

// Include the library
include "../phpqrcode/qrlib.php";
// Include your database connection file
include_once "../config/dbConn.php"; 

// Set the time zone to 'Africa/Nairobi'
date_default_timezone_set('Africa/Nairobi');


// Get the current time
$current_time = date("H:i:s");
$current_date = date('Y-m-d');

// // Get the current date and time
// $currentDateTime = date('Y-m-d H:i:s');
// echo "Current Date and Time in Nairobi: " . $currentDateTime;



// Query to fetch the ongoing class based on current time
$sql = "SELECT * FROM classes WHERE time_from <= '$current_time' AND time_to >= '$current_time' AND date = '$current_date'";
$result = mysqli_query($conn, $sql);

// Check if a class is found
if (mysqli_num_rows($result) > 0) {
    // Fetch the class ID
    $row = mysqli_fetch_assoc($result);
    $class_id = $row['id'];

    // echo $class_id;

    // Store the class ID in the session
    $_SESSION['id'] = $class_id;


    // Data to encode in QR code
    $data = "https://17eb-2c0f-fe38-2402-c5f6-cc8c-307e-f582-d54d.ngrok-free.app/qrtest2/post_data.php?class_id=$class_id";

    // Output QR code image directly to the browser
    QRcode::png($data);

    // Close database connection
    mysqli_close($conn);
} else {
    // Handle no ongoing class scenario
    echo "No ongoing class found.";
    mysqli_close($conn);
}



?>
