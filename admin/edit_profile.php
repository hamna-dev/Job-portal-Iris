<?php 
include '../connect/connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email);
$stmt->fetch();
$stmt->close();

// Update user data
if (isset($_POST['update'])) {
    $new_name = $_POST['name'];
    $new_email = $_POST['email'];
    
    $update_stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE user_id = ?");
    $update_stmt->bind_param("ssi", $new_name, $new_email, $user_id);
    $update_stmt->execute();
    $update_stmt->close();

    // Update session variables
    $_SESSION['user_name'] = $new_name;
    $_SESSION['user_email'] = $new_email;

    echo "<script>alert('Profile updated successfully!'); window.location.href = 'profile.php';</script>";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Edit Profile Container */
.edit-profile-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 80vh;
    background: url('../images/image.jpg') no-repeat center center/cover;
    padding: 20px;
}

.edit-profile {
    background: rgba(255, 255, 255, 0.9);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
}

.edit-profile h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
    font-size: 24px;
}

.edit-profile form {
    display: flex;
    flex-direction: column;
}

.edit-profile form label {
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

.edit-profile form .input {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.edit-profile form .input:focus {
    border-color: #66afe9;
    outline: none;
    box-shadow: 0 0 8px rgba(102, 175, 233, 0.6);
}

.edit-profile form .btn {
    padding: 10px;
    background-color: #2980b9;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

.edit-profile form .btn:hover {
    background-color: var(--black);
}

    </style>
</head>
<body>

    <!-- header start -->
    <?php include 'connect/admin_header.php'; ?>
    <!-- header end -->

    <div class="edit-profile-container">
        <section class="edit-profile">
            <h2>Edit Profile</h2>
          
            <form action="edit_save.php" method="post">
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="input" value="<?php echo $email ?>">

                <label for="email">password:</label>
                <input type="password" id="pass" name="pass" class="input">
                
                <label for="email">confirm password:</label>
                <input type="password" id="pass" name="confirm_pass" class="input">
                
                <input type="submit" name="update" value="Update Profile" class="btn">
            </form>
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

    <script src="js/script.js"></script>

</body>
</html>
