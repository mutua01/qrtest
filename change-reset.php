<?php 

@include 'config.php'; 

session_start(); 

if(!isset($_SESSION['Lecturer_name'])){
 header('location:login_form.php'); 
} 
?> 

<!DOCTYPE html>

 <html lang="en">
   <head> 
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Change Password</title>

      <!-- custom css file link --> 
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  </head> 

   <body>
      
   <div class="form-container">

<form action="change-p.php" method="post">
   <h3>Change Password</h3>
      <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
         };
      ?>
   <div class="password-input">
         <input type="password" id="password" name="op" minlength="6" placeholder="Enter your Old Password">
            <button type="button" class="show-hide-btn" onclick="showHidePassword('password')">
               <i class="fas fa-eye-slash"></i>
            </button>
      </div>
      <div class="password-input">
         <input type="password" id="password" name="np" minlength="6" placeholder="Enter your New Password">
            <button type="button" class="show-hide-btn" onclick="showHidePassword('password')">
               <i class="fas fa-eye-slash"></i>
            </button>
      </div>
      <div class="password-input">
         <input type="password" id="password" name="c_np" minlength="6" placeholder="Confirm your New Password">
            <button type="button" class="show-hide-btn" onclick="showHidePassword('password')">
               <i class="fas fa-eye-slash"></i>
            </button>
      </div>
   <input type="submit" name="submit" value="Change" class="form-btn">
   <a href="lecturer_page.php" class="btn">Back</a>
</form>

</div>
<script src="script.js"></script>

   </body> 
</html>