<?php
// Include the database connection file
include 'connect/connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['c_pass'];
    $user_type = $_POST['user_type'];
    $profile_image = $_FILES['profile_image'];

    // Password validation pattern
    $passwordPattern = '/^(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/';

    if (preg_match($passwordPattern, $password)) {
        if ($password === $confirm_password) {

            // Handle image upload
            if ($profile_image['error'] === 0) {
                $imagePath = 'uploads/users/' . basename($profile_image['name']);
                move_uploaded_file($profile_image['tmp_name'], $imagePath);
            } else {
                $imagePath = null;
            }

            // Prepare and bind
            if ($user_type === 'user') {
                $stmt = $conn->prepare("INSERT INTO users (name, email, password, profile_image) VALUES (?, ?, ?, ?)");
            } else if ($user_type === 'company') {
                $stmt = $conn->prepare("INSERT INTO company (company_name, email, password, profile_image) VALUES (?, ?, ?, ?)");
            }
            $stmt->bind_param("ssss", $name, $email, $confirm_password, $imagePath);

            if ($stmt->execute()) {
                echo "<script>alert('New account created successfully!');</script>";
                header("Location: login.php");
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Passwords do not match!');</script>";
        }
    } else {
        echo "<script>alert('Password must be at least 8 characters long and include at least one symbol and number.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- header start -->
<?php include 'connect/header.php'; ?>
    <!-- header end -->

<div class="account-form-container">
    <section class="account-form">
        <form action="" method="post" enctype="multipart/form-data">
            <h3> create new account!</h3>
            <input type="text" required name="name" maxlength="20" placeholder="enter your name" class="input">
            <input type="email" required name="email" maxlength="50" placeholder="enter your email" class="input">
            <input type="password" required name="pass" maxlength="20" placeholder="enter your password" class="input">
            <input type="password" required name="c_pass" maxlength="20" placeholder="confirm your password" class="input">
            <select name="user_type" required class="input">
                <option value="" disabled selected>Select user type</option>
                <option value="user">User</option>
                <option value="company">Company</option>
            </select>
            <input type="file" name="profile_image" accept="image/*" class="input">
            <p>already have an account? <a href="login.php">login now</a></p>
            <input type="submit" value="register now" name="submit" class="btn">
        </form>
    </section>
</div>

    <!-- footer start -->
    <?php include 'connect/footer.php'; ?>
    <!-- footer end -->

<script src="js/script.js"></script>

</body>
</html>
