<?php 
    @include 'header.php';
    include_once "../config/dbConn.php"; 

    // Fetch data from the units table
    $sql = "SELECT * FROM units";
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
<button type="button" class="btn custom-button" data-bs-toggle="modal" data-bs-target="#addUnit">
  Add Unit
</button>


<div class="custom-table">
    <br>
<table class="table  table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Unit Name</th>
      <th scope="col">School</th>
      <th scope="col">Course</th>
      <th scope="col">Year</th>
      <th scope="col">Semester</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        // Check if there are any results
        if (mysqli_num_rows($result) > 0) {
            // Output data in a table
            $counter = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $counter++ . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['school'] . "</td>";
                echo "<td>" . $row['course'] . "</td>";
                echo "<td>" . $row['year'] . "</td>";
                echo "<td>" . $row['semester'] . "</td>";
                echo "<td>
                  <a href='database.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this unit?\")'>
                      <i class='fas fa-trash text-white'></i> Delete
                  </a>
                </td>";
              echo "</tr>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Courses added will appear here";
        }

        // Close database connection
        mysqli_close($conn);
    ?>

</table>


</div>




<!-- Modal -->
<div class="modal fade" id="addUnit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Unit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <form method="POST" action="database.php">
        <div class="mb-3">
            <label for="unitname" class="form-label">Unit Name</label>
            <input type="text" class="form-control" name="unitname" id="unitname" required>
        </div>
        <div class="mb-3">
            <label for="school" class="form-label">School</label>
                <select id="school" name="school_of" class="form-select" required>
                    <option value="#">SELECT SCHOOL</option>
                    <option value="computing">School of Computing</option>
                    <option value="Education">School of Education</option>
                    <option value="Medicine">School of Medicine</option>
                    <option value="Business and Economics">School of Business and Economics</option>
                </select>
        </div>

        <div class="mb-3">
            <label for="course" class="form-label">Course</label>
                <select id="course" name="course" class="form-select" required>
                    <option value="#">SELECT COURSE</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Medicine and Surgery">Medicine and Surgery</option>
                    <option value="Accounting">Accounting</option>
                </select>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Academic Year</label>
            <input type="integer" class="form-control" name="year" id="year" required>
        </div>
        <div class="mb-3">
            <label for="semester" class="form-label">Semister Taught</label>
            <input type="integer" class="form-control" name="semester" id="semester" required>
        </div>
        <div>
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" >
            <input type="hidden" name="school" value="<?php echo $_SESSION['user_school']; ?>" >
        </div>
    
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add_unit" class="btn custom-button">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>



<?php @include 'footer.php'; ?>
