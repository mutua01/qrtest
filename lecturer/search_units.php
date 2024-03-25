<?php
// Include your database connection file
include_once "../config/dbConn.php"; 

// Check if input is provided
if (isset($_GET['input'])) {
    // Escape and sanitize the input
    $input = mysqli_real_escape_string($conn, $_GET['input']);

    // Fetch matching units based on input
    $sql = "SELECT * FROM units WHERE name LIKE '%$input%'";
    $result = mysqli_query($conn, $sql);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Fetch units into an array
        $units = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $units[] = $row;
        }
        // Send units data as JSON response
        echo json_encode($units);
    } else {
        // No matches found
        echo json_encode([]);
    }
} else {
    // Input not provided
    echo json_encode([]);
}

// Close database connection
mysqli_close($conn);
?>
