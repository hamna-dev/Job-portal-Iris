<?php 
include '../connect/connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>

        /* Profile Container */
        .profile-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            background: url('../images/image.jpg') no-repeat center center/cover;
            padding: 20px;
        }

        .profile {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .profile h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        .profile p {
            margin-bottom: 15px;
            color: #333;
        }

        .profile img {
            border-radius: 50%;
            margin-bottom: 20px;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .profile-options {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .profile-options .btn {
            padding: 10px 20px;
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .profile-options .btn:hover {
            background-color: var(--black);
        }

        /* Add custom CSS styles here */
        .admin-container {
            padding: 20px;
            text-align: center;
        }

        .admin-container h1 {
            color: #333;
            font-size: 36px;
            margin-bottom: 20px;
        }

        .admin-container p {
            color: #666;
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <?php include 'connect/admin_header.php'; ?>

    <!-- Main Content -->
    
    <div class="profile-container">
        <section class="profile">
            <div class="admin-container">
                <h1>Welcome to the Admin Page!</h1>
                <p>This page is only accessible to administrators.</p>
                <p>You can add, edit, or delete content here.</p>
            </div>
        </section>
    </div>


    <!-- Footer -->
    <footer class="footer">
        <section class="grid">
            <div class="box">
                <h3>Quick links</h3>
                <a href="home.php"><i class="fas fa-angle-right"></i>home</a>
                <a href="manage_companies.php"><i class="fas fa-angle-right"></i>Manage Companies</a>
                <a href="manage_users.php"><i class="fas fa-angle-right"></i>Manage Users</a>
                <a href="contact.php"><i class="fas fa-angle-right"></i>Contact us</a>
                <a href="#"><i class="fas fa-angle-right"></i>filter search</a>
            </div>

            <div class="box">
                <h3>Follow us</h3>
                <a href="#"><i class="fab fa-facebook-f"></i>Facebook</a>
                <a href="#"><i class="fab fa-twitter"></i>Twitter</a>
                <a href="#"><i class="fab fa-instagram"></i>Instagram</a>
                <a href="#"><i class="fab fa-linkedin"></i>Linkedin</a>
                <a href="#"><i class="fab fa-youtube"></i>Youtube</a>
            </div>
        </section>

        <div class="credit">&copy; Copyright @ 2023 by <span>Job Portal</span> All rights reserved</div>
    </footer>

    <!-- Include any necessary JavaScript files here -->

</body>
</html>
