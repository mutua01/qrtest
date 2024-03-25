<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : null;
   $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : null;
   $pass = isset($_POST['password']) ? md5($_POST['password']) : null;
   $cpass = isset($_POST['cpassword']) ? md5($_POST['cpassword']) : null;
   $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : null;

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'Lecturer'){
         $_SESSION['Lecturer_name'] = $row['name'];
         $_SESSION['user_id'] = $row['id'];
         $_SESSION['user_school'] = $row['school'];
         header('location:lecturer/profile.php');

         

      }elseif($row['user_type'] == 'Student'){
         $_SESSION['Student_name'] = $row['name'];
         $_SESSION['user_id'] = $row['id'];
         $_SESSION['user_school'] = $row['school'];
         $_SESSION['user_phone'] = $row['phone'];
         $_SESSION['user_email'] = $row['email'];

         // Check if class ID is present in the URL
         if(isset($_GET['class_id'])) {
             // Redirect to the post_data.php page with class ID
             header('location: post_data.php?class_id=' . $_GET['class_id']);
         } else {
             // Redirect to the default location
             header('location: student/profile.php');
         }
      }

   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
   <body>
   
      <div class="form-container">

         <form action="" method="post">
            <h3>Login</h3>
               <?php
                  if(isset($error)){
                     foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                     };
                  };
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
               <div class="password-input">
                  <input type="password" id="password" name="password" minlength="6" placeholder="Enter your Password">
                     <button type="button" class="show-hide-btn" onclick="showHidePassword('password')">
                        <i class="fas fa-eye-slash"></i>
                     </button>
                     <input type="hidden" name="redirect_url" value="post_data.php?class_id=<?php echo isset($_GET['class_id']) ? $_GET['class_id'] : ''; ?>">

               </div>
            <input type="submit" name="submit" value="Login" class="form-btn">
            <p>Don't have an account? <a href="register.php">Register</a></p>
            <p> <a href="forgot-password.php">Forgot Password?</a></p>
         </form>

      </div>
      <!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
         <script src="script.js"></script>
   </body>
</html>