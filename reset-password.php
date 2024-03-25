<?php 
session_start();
@include 'config/dbConn.php'; 

// Step 5: Verify Token
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["token"])) {
   $token = $_GET["token"];
   $sql = "SELECT email FROM user_form WHERE verify_token='$token'";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
       // Token is valid, allow user to reset password
       $row = $result->fetch_assoc();
       $email = $row["email"];
   } else {
      //  echo "Invalid token.";
      //  exit; // Stop further execution
       $_SESSION['message'] = "Invalid token. Try Again";
       $_SESSION['alert_type'] = 'info';
       header('location: forgot-password.php');
       exit; // Stop further execution
   }
}

// Step 6: Reset Password
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];

    if ($new_password !== $confirm_password) {
      $_SESSION['message'] = "Passwords do not match.";
      $_SESSION['alert_type'] = 'danger';
      header('location: reset-password.php');
      exit;
  }else{

   $passwd = md5($new_password);

   $sql = "UPDATE user_form SET password='$passwd', verify_token=NULL WHERE email='$email'";
    if ($conn->query($sql) === TRUE) {
      //   echo "Password reset successfully.";
      //   // Redirect to login page or any other page after successful password reset
      //   exit;
      $_SESSION['message'] = "Password reset successfully.";
      $_SESSION['alert_type'] = 'success';
      header('location: login.php'); // Redirect to login page after successful password reset
      exit;
    } else {
      $_SESSION['message'] = "Error updating password: " . $conn->error;
      $_SESSION['alert_type'] = 'danger';
      header('location: forgot-password.php');
      exit;
    }

  }

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Password Reset</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   
<div class="form-container">

   <form action="" method="post"> <!-- Update action to point to the same page -->
      <h3>Reset Password</h3>
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

      <div class="password-input">
         <input type="password" id="new_password" name="new_password" minlength="6" placeholder="Enter Your New Password"> <!-- Change input name to match PHP script -->
         <button type="button" class="show-hide-btn" onclick="showHidePassword('new_password', this)">
            <i class="fas fa-eye-slash"></i>
         </button>
      </div>
      <div class="password-input">
         <input type="password" id="confirm_password" name="confirm_password" minlength="6" placeholder="Repeat Your New Password"> <!-- Change input name to match PHP script -->
         <button type="button" class="show-hide-btn" onclick="showHidePassword('confirm_password', this)">
            <i class="fas fa-eye-slash"></i>
         </button>
      </div>
      <input type="hidden" name="email" value="<?php echo $email; ?>"> <!-- Pass email value obtained from token verification -->
      <input type="submit" name="submit" value="Set New Password" class="form-btn">
   </form>

</div>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script src="script.js"></script>
</body>
</html>
