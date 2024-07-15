<?php 
include '../connect/connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT name, email, profile_image FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email, $profile_image);
$stmt->fetch();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
    </style>
</head>
<body>

    <!-- header start -->
    <?php include 'connect/admin_header.php'; ?>
    <!-- header end -->

    <div class="profile-container">
        <section class="profile">
            <?php if ($profile_image): ?>
                <img src="../<?php echo htmlspecialchars($profile_image); ?>" alt="Profile Image">
            <?php else: ?>
                <img src="images/default.jpg" alt="Default Profile Image">
            <?php endif; ?>
            <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>

            <div class="profile-options">
                <a href="edit_profile.php" class="btn">Edit Profile</a>
                <a href="connect/logout.php" class="btn">Logout</a>
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
    <!-- footer end -->

    <script src="../js/script.js"></script>

</body>
</html>