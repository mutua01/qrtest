<?php 

@include 'header.php';
include_once "../config/dbConn.php";

?>

<div class="content-container">

<?php

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
?>


    
<?php
// Include your database connection file

// Check if user school is set in the session
if (isset($_SESSION['user_school'])) {
    // Fetch units where school matches user's school
    $user_school = $_SESSION['user_school'];
    $sql = "SELECT units.*, user_form.name AS lecturer_name FROM units 
            INNER JOIN user_form ON units.user_id = user_form.id 
            WHERE units.school = '$user_school'";
    $result = mysqli_query($conn, $sql);

    // Check if any units are found
    if (mysqli_num_rows($result) > 0) {
        // Display units in a table
        $counter = 1;
?>
<h5 class="text-color">Register Units</h5>
<form action="database.php" method="GET"> <!-- Change the action attribute to your submission PHP file -->
    <div class="table-container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Unit Name</th>
                <th>Course Name</th>
                <th>Lecturer Name</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $counter++ . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['course'] . "</td>";
            echo "<td>" . $row['lecturer_name'] . "</td>";
            // Add hidden input fields for user_id and unit_id
            echo "<input type='hidden' name='user_id' value='" . $_SESSION['user_id'] . "'>";
            echo "<input type='hidden' name='unit_id' value='" . $row['id'] . "'>";
            // Change the button type to 'submit' to submit the form
            echo "<td><a class='btn custom-button' href='database.php?user_id=" . $_SESSION['user_id'] . "&unit_id=" . $row['id'] . "'>Register</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    </div>
</form>




<?php
    } else {
        echo "No units found for your school.";
    }
} else {
    echo "User school not set in session.";
}

// Close the database connection
mysqli_close($conn);
?>

</div>

<?php @include 'footer.php'; ?>
