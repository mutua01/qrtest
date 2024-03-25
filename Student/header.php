<?php 

@include 'config.php'; 

session_start(); 

if(!isset($_SESSION['Student_name'])){
 header('location:login.php'); 
} 
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATTENDANCE SYSTEM</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Your Custom CSS -->
    <link rel="stylesheet" href="../style.css">
    <style>
        /* Custom CSS for profile icon */
        .profile-icon {
            margin: 20px;
        }
        .navbar{
            background-color: #fbd0d9;
            z-index: 2; /* higher z-index */
            position: fixed;
            top: 0;
            width: 100%;

        }
        #sidebarMenu{
            background-color: #fbd0d9 !important;
            height: 100%; /* Occupy full height */
            position: fixed; /* Fix position */
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1; /* lower z-index */
            padding-top: 56px; /* Adjust padding-top for the space occupied by the top navbar */
            overflow-y: auto; 
        }
        .list-group a {
            background-color: #fbd0d9 !important;
            
        }
        .list-group a:hover {
            background-color: white !important;
        }
        .fas{
            color: crimson;
        }
        
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ATTENDANCE SYSTEM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Add your navbar links here -->
            <div class="hide">
            <div class=" profile-icon">
                    <i class="fas fa-user-circle fa-3x"></i>
                </div>
                <div class="list-group list-group-flush">
                    <a href="profile.php" class="list-group-item list-group-item-action">Profile</a>
                    <a href="change-password.php" class="list-group-item list-group-item-action">Change Password</a>
                    <a href="register-unit.php" class="list-group-item list-group-item-action">Register Unit</a>
                    <a href="attendance-records.php" class="list-group-item list-group-item-action">Attendance Records</a>
                    <a href="../logout.php" class="list-group-item list-group-item-action btn">Logout</a>
                </div>
            </div>
            
        </div>
    </div>
</nav>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class=" profile-icon">
                    <i class="fas fa-user-circle fa-3x"></i>
                </div>
                <div class="list-group list-group-flush">
                    <a href="profile.php" class="list-group-item list-group-item-action">Profile</a>
                    <a href="change-password.php" class="list-group-item list-group-item-action">Change Password</a>
                    <a href="register-unit.php" class="list-group-item list-group-item-action">Register Unit</a>
                    <a href="attendance-records.php" class="list-group-item list-group-item-action">Attendance Records</a>
                    <a href="../logout.php" class="list-group-item list-group-item-action btn">Logout</a>
                </div>
            </nav>

            <!-- Page content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">