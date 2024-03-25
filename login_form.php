<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'Lecturer'){

         $_SESSION['Lecturer_name'] = $row['name'];
         header('location:lecturer_page.php');

      }elseif($row['user_type'] == 'Student'){

         $_SESSION['Student_name'] = $row['name'];
         header('location:student_page.php');

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
               ?>
            <input type="email" name="email" required placeholder="Enter your Email">
               <div class="password-input">
                  <input type="password" id="password" name="password" minlength="6" placeholder="Enter your Password">
                     <button type="button" class="show-hide-btn" onclick="showHidePassword('password')">
                        <i class="fas fa-eye-slash"></i>
                     </button>
               </div>
            <input type="submit" name="submit" value="Login" class="form-btn">
            <p>Don't have an account? <a href="register_form.php">Register</a></p>
         </form>

      </div>
         <script src="script.js"></script>
   </body>
</html>