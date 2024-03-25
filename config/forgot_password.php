<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


// Database connection
@include 'dbConn.php';

// Step 1: User Request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();

    $email = $_POST["email"];
    // Step 2: Check if email exists
    $email_check_sql = "SELECT * FROM user_form WHERE email='$email'";

    $result = mysqli_query($conn, $email_check_sql);
    if (mysqli_num_rows($result) > 0) {
        // Email exists, proceed with password reset
        // Step 3: Generate Token
        $token = bin2hex(random_bytes(32)); // Generate a random token

        $sql = "UPDATE user_form SET verify_token='$token' WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            // Step 4: Send Email using PHPMailer
            $reset_link = "https://17eb-2c0f-fe38-2402-c5f6-cc8c-307e-f582-d54d.ngrok-free.app/qrtest2/reset-password.php?token=$token";
            
            // Create a new PHPMailer instance
            $mail = new PHPMailer;

            // Set up SMTP for sending emails
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'davidmusembi02@gmail.com'; // Your email address
            $mail->Password = 'bayzhaqbbbleaylv'; // Your email password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Set sender and recipient email addresses
            $mail->setFrom('davidmusembi02@gmail.com', 'ATTENDANCE SYSTEM');
            $mail->addAddress($email, 'Recipient Name');

            // Set email subject and body
            $mail->Subject = 'Password Reset';
            $mail->Body = "Click the following link to reset your password: $reset_link";

            // Send the email
            if ($mail->send()) {
                // Email sent successfully
                $_SESSION['message'] = "Password reset link sent to your email.";
                $_SESSION['alert_type'] = 'success';
                header('location:../forgot-password.php');
            } else {
                // Error sending email
                $_SESSION['message'] = "Error sending email. Please try again.";
                $_SESSION['alert_type'] = 'danger';
                header('location:../forgot-password.php');
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $_SESSION['message'] =  "Error: " . $sql . "<br>" . $conn->error;
            $_SESSION['alert_type'] = 'danger';
            header('location:../forgot-password.php');
        }
    } else {
        // echo "Email not found.";
        $_SESSION['message'] = "Email not found.";
        $_SESSION['alert_type'] = 'danger';
        header('location:../forgot-password.php');
    }
}





$conn->close();
?>
