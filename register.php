<?php

@include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $school = mysqli_real_escape_string($conn, $_POST['school']);
   $phone = $_POST["phone"];
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   // Remove any non-numeric characters from the phone number
   $phone = preg_replace("/[^0-9]/", "", $phone);

   if (strlen($phone) == 9) {
      // Add "254" to the beginning of the phone number
      $phone = "254" . $phone;

      // echo "Verified phone number: " . $phone;
  } else {
      // echo "Invalid phone number. Please enter a 10-digit number.";
      $error[] = "Invalid phone number. Please enter a 10-digit number.";
  }

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, phone, school, password, user_type) VALUES('$name','$email', '$phone', '$school','$pass','$user_type')";
         mysqli_query($conn, $insert);
         $_SESSION['message'] = "Registration Successful. Log in to get started!";
         $_SESSION['alert_type'] = 'success';
         header('location:login.php');
      }
   }
   
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Register</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" maxlength="15" required placeholder="Enter your Name">
      <input type="email" name="email" maxlength="30" placeholder="Enter your Email">
      <input type="text" name="phone" maxlength="10" placeholder="Enter your Phone Number">
      <select name="school" required>
         <option value="">SELECT YOUR SCHOOL</option>
         <option value="Computing">School of Computing</option>
         <option value="Education">School of Education</option>
         <option value="Business and Economics">School of Business and Economics</option>
      </select>
      <div class="password-input">
         <input type="password" id="password" name="password" minlength="6" placeholder="Enter your Password">
         <button type="button" class="show-hide-btn" onclick="showHidePassword('password')">
            <i class="fas fa-eye-slash"></i>
         </button>
      </div>
      <div class="password-input">
         <input type="password" id="cpassword" name="cpassword" minlength="6" placeholder="Confirm your Password">
         <button type="button" class="show-hide-btn" onclick="showHidePassword('cpassword')">
            <i class="fas fa-eye-slash"></i>
         </button>
      </div>
      <select name="user_type">
         <option value="">Select User Role</option>
         <option value="Student">Student</option>
         <option value="Lecturer">Lecturer</option>
      </select>
      <input type="submit" name="submit" value="Register" class="form-btn">
      <p>Already have an account? <a href="login.php">Login</a></p>
   </form>

</div>
<script src="script.js"></script>
</body>
</html>