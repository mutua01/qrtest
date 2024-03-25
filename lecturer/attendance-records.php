<?php @include 'header.php'; ?>

<div class="content-container">
    <h5 class="text-color">Class Attendance Records</h5>

    <form method="post" class="mb-3">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="date" class="col-form-label">Date:</label>
            </div>
            <div class="col-auto">
                <input type="date" id="date" name="date" class="form-control">
            </div>
            <div class="col-auto">
                <label for="unit" class="col-form-label">Unit Name:</label>
            </div>
            <div class="col-auto">
                <select id="unit" name="unit" class="form-select">
                    <option value="#">SELECT UNIT</option>
                    <?php
                    // Include your database connection file
                    include_once "../config/dbConn.php";

                    // Check if the user is logged in as a lecturer
                    if (isset($_SESSION['user_id'])) {
                        // Get the lecturer's user ID from the session
                        $lecturer_id = $_SESSION['user_id'];

                        // Query to fetch units taught by the lecturer
                        $sql = "SELECT id, name FROM units WHERE user_id = '$lecturer_id'";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary">Check Attendance</button>
            </div>
        </div>
    </form>

    <?php
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['date']) && isset($_POST['unit'])) {
        $date = $_POST['date'];
        $unit_id = $_POST['unit'];

        // Include your database connection file
        include_once "../config/dbConn.php";

        // Query to fetch all registered students for the selected unit
        $students_sql = "SELECT user_form.id AS user_id, user_form.name AS student_name, user_form.email AS student_email, user_form.phone AS student_phone
                         FROM unit_registration
                         INNER JOIN user_form ON unit_registration.user_id = user_form.id
                         WHERE unit_registration.unit_id = '$unit_id'";

        $students_result = mysqli_query($conn, $students_sql);

        if (mysqli_num_rows($students_result) > 0) {
            // Display attendance records in a table
            echo "<table class='table table-striped'>";
            echo "<thead><tr><th>#</th><th>Student Name</th><th>Student Email</th><th>Student Phone</th><th>Attendance Status</th></tr></thead>";
            echo "<tbody>";
            $counter = 1;
            while ($student = mysqli_fetch_assoc($students_result)) {
                // Check if the student attended the class
                $attendance_sql = "SELECT 1 FROM attendance
                                   LEFT JOIN unit_registration ON attendance.student_id = unit_registration.user_id
                                   WHERE unit_registration.unit_id = '$unit_id'
                                   AND attendance.student_id = '{$student['user_id']}'";

                $attendance_result = mysqli_query($conn, $attendance_sql);
                $attendance_status = mysqli_num_rows($attendance_result) > 0 ? 'Present' : 'Absent';

                echo "<tr>";
                echo "<td>" . $counter++ . "</td>";
                echo "<td>" . $student['student_name'] . "</td>";
                echo "<td>" . $student['student_email'] . "</td>";
                echo "<td>" . $student['student_phone'] . "</td>";
                echo "<td>" . $attendance_status . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "No students registered for the selected unit.";
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>
</div>

<?php @include 'footer.php'; ?>
