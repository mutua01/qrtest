<?php 

@include 'header.php'; 

// Include the database connection file
include_once "../config/dbConn.php"; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or handle unauthorized access
    header("Location: login.php");
    exit; // Stop further execution
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch the class details associated with the user ID
$sql = "SELECT classes.date, classes.topic, classes.venue, classes.time_from, classes.time_to, units.name AS unit_name
        FROM classes
        INNER JOIN units ON classes.unit_id = units.id
        WHERE classes.user_id = $user_id";

$result = mysqli_query($conn, $sql);


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


    <!-- Button trigger modal -->
<button type="button" class="btn custom-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Class
</button>

<div class="custom-table">
    <br>
    <table class="table  table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Topic</th>
                <th scope="col">Unit Name</th>
                <th scope="col">Venue</th>
                <th scope="col">Time From</th>
                <th scope="col">Time To</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are any results
            if (mysqli_num_rows($result) > 0) {
                $counter = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $counter++ . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['topic'] . "</td>";
                    echo "<td>" . $row['unit_name'] . "</td>";
                    echo "<td>" . $row['venue'] . "</td>";
                    echo "<td>" . $row['time_from'] . "</td>";
                    echo "<td>" . $row['time_to'] . "</td>";
                    // Actions column with edit and delete icons
                
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No classes found for this user.";
            }
            ?>
        </tbody>
    </table>
</div>






<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Class</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="database.php">
          <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" id="date">
          </div>
          <div class="mb-3">
            <label for="unit" class="form-label">Unit</label>
            <input type="text" class="form-control" id="unit" placeholder="Search for unit...">
            <!-- Hidden input field to store unit ID -->
            <input type="hidden" name="unit_id" id="unitId">
                <div id="unitResults"></div>
            </div>
          <div class="mb-3">
            <label for="topic" class="form-label">Topic</label>
            <input type="text" name="topic" class="form-control" id="topic">
          </div>
          
          <div class="mb-3">
            <label for="venue" class="form-label">Venue</label>
            <input type="text" name="venue" class="form-control" id="venue">
          </div>
          <div class="mb-3">
            <label for="time-from" class="form-label">Time From</label>
            <input type="time" name="time_from" class="form-control" id="time-from">
          </div>
          <div class="mb-3">
            <label for="time-to" class="form-label">Time To</label>
            <input type="time" name="time_to" class="form-control" id="time-to">
          </div>
          <div>
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" >
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add_class" class="btn custom-button">Add Class</button>
        </form>
      </div>
    </div>
  </div>
</div>




<?php @include 'footer.php'; ?>
