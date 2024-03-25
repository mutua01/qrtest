<?php session_start();  ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reset Password</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
   <body>
   
      <div class="form-container">

         <form action="config/forgot_password.php" method="post">
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
            <input type="email" name="email" required placeholder="Enter your Email">


            <input type="submit" name="submit" value="Send Password Reset Link" class="form-btn">
            <p>Don't have an account? <a href="register.php">Register</a></p>
         </form>

      </div>
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

         <script src="script.js"></script>
   </body>
</html>