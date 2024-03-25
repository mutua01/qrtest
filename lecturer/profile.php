<?php @include 'header.php'; ?>
<!-- Page Content -->
<div class="content-container profile">
    <div class="content"> 
        <h3 class="mb-3">Hi, <span class="text-color"><?php echo $_SESSION['Lecturer_name']?>!</span></h3> 
        <h1>Welcome to the dashboard</h1> 
        <hr>
        <br>
        <div class="row">
            <div class="col-12">
            <h5 class="text-color">Upcomming and Ongoing Classes</h5>


            <?php

// Include your database connection file
include_once "../config/dbConn.php";

// Check if the user is logged in as a lecturer
if (isset($_SESSION['user_id'])) {
    // Get the lecturer's user ID from the session
    $lecturer_id = $_SESSION['user_id'];

    // Get the current date and time
    $current_date = date('Y-m-d');
    $current_time = date('H:i:s');

    // Query to fetch upcoming and ongoing classes
    $sql = "SELECT classes.*, units.name AS unit_name
            FROM classes
            INNER JOIN units ON classes.unit_id = units.id
            WHERE classes.user_id = '$lecturer_id'
            AND ((classes.date > '$current_date') OR (classes.date = '$current_date' AND classes.time_to > '$current_time'))";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Display upcoming and ongoing classes in a table
        echo "<table class='table table-striped'>";
        echo "<thead><tr><th>#</th><th>Unit Name</th><th>Topic</th><th>Date</th><th>Venue</th><th>Time From</th><th>Time To</th></tr></thead>";
        echo "<tbody>";
        $counter = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $counter++ . "</td>";
            echo "<td>" . $row['unit_name'] . "</td>";
            echo "<td>" . $row['topic'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['venue'] . "</td>";
            echo "<td>" . $row['time_from'] . "</td>";
            echo "<td>" . $row['time_to'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No upcoming or ongoing classes found.";
    }
} else {
    // Redirect the user to the login page if not logged in as a lecturer
    header("Location: login.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>


            </div>
        </div>
    </div>
</div>



<?php @include 'footer.php'; ?>
