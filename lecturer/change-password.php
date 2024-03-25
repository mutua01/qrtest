<?php @include 'header.php'; ?>

<div class="content-container">

  <div class="change_pass">
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
    <h5 class="text-color">Change Your Password</h5>
    <br>  
    <form action="database.php" method="POST">
      <div class="mb-3">
        <label for="currentPassword" class="form-label">Current Password</label>
        <div class="input-group">
          <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
          <button class="btn custom-button" type="button" id="showCurrentPassword"><i class="fas fa-eye text-white"></i></button>
        </div>
      </div>
      <div class="mb-3">
        <label for="newPassword" class="form-label">New Password</label>
        <div class="input-group">
          <input type="password" class="form-control" id="newPassword" name="newPassword" required>
          <button class="btn custom-button" type="button" id="showNewPassword"><i class="fas fa-eye text-white"></i></button>
        </div>
      </div>
      <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirm New Password</label>
        <div class="input-group">
          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
          <button class="btn custom-button" type="button" id="showConfirmPassword"><i class="fas fa-eye text-white"></i></button>
        </div>
      </div>
      <button type="submit" name="change_password" class="btn custom-button">Change Password</button>
    </form>
  </div>
</div>

<?php @include 'footer.php'; ?>
