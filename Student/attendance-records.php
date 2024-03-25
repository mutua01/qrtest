<div class="content-container">


<?php
@include 'header.php';

// Check if message and alert type session variables are set
if (isset($_SESSION['message']) && isset($_SESSION['alert_type'])) {
    // Display Bootstrap alert based on session variables
    echo '<div class="alert alert-' . $_SESSION['alert_type'] . ' alert-dismissible fade show" role="alert">
            ' . $_SESSION['message'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

    // Clear session variables
    unset($_SESSION['message']);
    unset($_SESSION['alert_type']);
}


// Include the database connection file
include_once "../config/dbConn.php";




// Check if the user ID is set in the session
if (isset($_SESSION['user_id'])) {
    // Fetch attendance records for the student based on their user ID
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT classes.topic, classes.date, classes.time_from, classes.time_to, units.name AS unit_name 
            FROM attendance 
            INNER JOIN classes ON attendance.class_id = classes.id 
            INNER JOIN units ON classes.unit_id = units.id 
            WHERE attendance.student_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    // Check if any attendance records are found
    if (mysqli_num_rows($result) > 0) {
        // Display attendance records in a table
        echo "<h4 class='text-color'>Attendance Records</h4>";
        echo "<div class='table-container'>";
        echo "<table class='table table-striped' width='80%'>";
        echo "<thead><tr><th>#</th><th>Topic</th><th>Date</th><th>Time From</th><th>Time To</th><th>Unit Name</th></tr></thead>";
        echo "<tbody>";
        $counter= 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $counter++ . "</td>";
            echo "<td>" . $row['topic'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['time_from'] . "</td>";
            echo "<td>" . $row['time_to'] . "</td>";
            echo "<td>" . $row['unit_name'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "No attendance records found.";
    }
} else {
    echo "User ID not set in session.";
}

// Close the database connection
mysqli_close($conn);


?>



</div>
<?php @include 'footer.php'; ?>