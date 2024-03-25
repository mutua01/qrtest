<?php @include 'header.php'; ?>

<div class="content-container profile">
    <div class="content"> 
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
        <h3 class="mb-3">Hi, <span class="text-color"><?php echo $_SESSION['Student_name']?>!</span></h3> 
        <h1>Welcome to the student's dashboard</h1> 
        <!-- <p>Choose an option from the sidebar to get started.</p> -->
    </div> 
    <hr>
    <div class="mb-3">
        <table class="table table-stripped">
        <tr>
                <th>School</th>
                <td><?php echo "School of " . $_SESSION['user_school'] ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $_SESSION['user_email'] ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?php echo $_SESSION['user_phone'] ?></td>
            </tr>
        </table>
        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#updateProfile">Update Profile Details</button>
    </div>
    <div class="row">
        <div class="col-12">
            <h5 class="text-color">Upcomming and Ongoing Classes</h5>

            <?php
                // Include the database connection file
                include_once "../config/dbConn.php";


                // Check if the user ID is set in the session
                if (isset($_SESSION['user_id'])) {
                    // Get the user ID from the session
                    $user_id = $_SESSION['user_id'];

                    // Get the current date and time
                    $current_date_time = date('Y-m-d H:i:s');

                    // Fetch the units the user has registered for
                    $sql_units = "SELECT unit_id FROM unit_registration WHERE user_id = '$user_id'";
                    $result_units = mysqli_query($conn, $sql_units);

                    // Create an array to store the unit IDs
                    $unit_ids = array();
                    while ($row_unit = mysqli_fetch_assoc($result_units)) {
                        $unit_ids[] = $row_unit['unit_id'];
                    }

                    // Check if the user has registered for any units
                    if (!empty($unit_ids)) {
                        // Convert the unit IDs array into a comma-separated string
                        $unit_ids_str = implode(',', $unit_ids);

                        // Fetch upcoming and ongoing classes for the user's registered units
                        $sql = "SELECT classes.topic, units.name AS unit_name, user_form.name AS lecturer_name, classes.time_from, classes.time_to
                                FROM classes
                                INNER JOIN units ON classes.unit_id = units.id
                                INNER JOIN user_form ON classes.user_id = user_form.id
                                WHERE classes.time_from >= '$current_date_time' AND classes.unit_id IN ($unit_ids_str) AND classes.user_id = '$user_id'
                                ORDER BY classes.time_from ASC";

                        $result = mysqli_query($conn, $sql);

                        // Check if any classes are found
                        if (mysqli_num_rows($result) > 0) {
                            // Display upcoming and ongoing classes in a table
                            echo "<div class='table-container'>";
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr><th>Topic</th><th>Unit Name</th><th>Lecturer</th><th>Time From</th><th>Time To</th></tr></thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['topic'] . "</td>";
                                echo "<td>" . $row['unit_name'] . "</td>";
                                echo "<td>" . $row['lecturer_name'] . "</td>";
                                echo "<td>" . $row['time_from'] . "</td>";
                                echo "<td>" . $row['time_to'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "</div>";
                        } else {
                            echo "No upcoming or ongoing classes found for your registered units.";
                        }
                    } else {
                        echo "You have not registered for any units.";
                    }
                } else {
                    echo "User ID not set in session.";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>



        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="updateProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Profile Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="database.php" method="POST"> <!-- Update action to point to your PHP script -->
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="new_email" class="form-control" value="<?php echo $_SESSION['user_email']; ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Phone</label>
            <input type="text" name="new_phone" class="form-control" value="<?php echo $_SESSION['user_phone']; ?>" id="exampleInputPassword1">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="update_profile" class="btn custom-button">Save changes</button> <!-- Change button type to submit -->
        </form>
      </div>
    </div>
  </div>
</div>


<?php @include 'footer.php'; ?>