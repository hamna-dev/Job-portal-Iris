<?php 
include 'connect/connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, phone FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $phone);
$stmt->fetch();
$stmt->close();

// Update user data
if (isset($_POST['update_profile'])) {
    $new_name = $_POST['name'];
    $new_phone = $_POST['phone'];

    // Update phone number and name
    $update_stmt = $conn->prepare("UPDATE users SET name = ?, phone = ? WHERE user_id = ?");
    $update_stmt->bind_param("ssi", $new_name, $new_phone, $user_id);
    $update_stmt->execute();
    $update_stmt->close();

    // Update session variables
    $_SESSION['user_name'] = $new_name;

    echo "<script>alert('Profile updated successfully!'); window.location.href = 'profile.php';</script>";
}

// Update password
if (isset($_POST['update_password'])) {
    $password = $_POST['pass'];
    $confirm_password = $_POST['confirm_pass'];
    
    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        // Update password
        $update_pass_stmt = $conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_pass_stmt->bind_param("si", $hashed_password, $user_id);
        $update_pass_stmt->execute();
        $update_pass_stmt->close();

        echo "<script>alert('Password updated successfully!');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Edit Profile Container */
        .edit-profile-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            background: url('images/image.jpg') no-repeat center center/cover;
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
    <?php include 'connect/header.php'; ?>
    <!-- header end -->

    <div class="edit-profile-container">
        <section class="edit-profile">
            <h2>Edit Profile</h2>
          
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" class="input" value="<?php echo $phone; ?>" required>
                
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="input" value="<?php echo $name; ?>" required>
                
                <input type="submit" name="update_profile" value="Update Profile" class="btn">
            </form>
        </section>
        
        <section class="edit-profile">
            <h2>Change Password</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="pass">New Password:</label>
                <input type="password" id="pass" name="pass" class="input" required>
                
                <label for="confirm_pass">Confirm Password:</label>
                <input type="password" id="confirm_pass" name="confirm_pass" class="input" required>
                
                <input type="submit" name="update_password" value="Update Password" class="btn">
            </form>
        </section>
    </div>

    <!-- footer start -->
    <?php include 'connect/footer.php'; ?>
    <!-- footer end -->

    <script src="js/script.js"></script>

</body>
</html>
