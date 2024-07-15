<?php
// Include the database connection file
include 'connect/connect.php';
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $user_type = $_POST['user_type']; // Add this line to get the user type

    // Prepare and bind
    if ($user_type === 'company') {
        $stmt = $conn->prepare("SELECT company_id, company_name, email, password FROM company WHERE email = ?");
    } else {
        $stmt = $conn->prepare("SELECT user_id, name, email, password FROM users WHERE email = ?");
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $email, $stored_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();

        if ($password === $stored_password) {
            // Password is correct, start a session
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_type'] = $user_type; // Add this line to store the user type in session

            // Redirect based on user type
            if ($user_type === 'admin') {
                echo "<script>alert('Login successful!'); window.location.href = 'admin/admin_dashboard.php';</script>";
            } elseif ($user_type === 'user') {
                echo "<script>alert('Login successful!'); window.location.href = 'home.php';</script>";
            } elseif ($user_type === 'company') {
                echo "<script>alert('Login successful!'); window.location.href = 'company/index.php';</script>";
            } else {
                echo "<script>alert('Unknown user type!'); window.location.href = 'login.php';</script>";
            }
        } else {
            echo "<script>alert('Invalid email or password!');</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password!');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
 
    <!-- header start -->
    <?php include 'connect/header.php'; ?>
    <!-- header end -->
 
<div class="account-form-container">
    <section class="account-form">
        <form action="" method="post">
            <h3>welcome back!</h3>
            <input type="email" required name="email" maxlength="50" placeholder="enter your email" class="input">
            <input type="password" required name="pass" maxlength="20" placeholder="enter your password" class="input">
            <select name="user_type" required class="input">
                <option value="" disabled selected>Select user type</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="company">Company</option>
            </select>
            <p>don't have an account? <a href="register.php">register now</a></p>
            <input type="submit" value="login now" name="submit" class="btn">
        </form>
     </section>
</div>

    <!-- footer start -->
    <?php include 'connect/footer.php'; ?>
    <!-- footer end -->

<script src="js/script.js"></script>

</body>
</html>
