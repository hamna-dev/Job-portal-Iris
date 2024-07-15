<?php
include '../connect/connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Check if user is an admin
if ($_SESSION['user_type'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// Check if user ID to delete is provided
if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM user WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    
    if ($stmt->execute()) {
        // User deleted successfully
        echo '<script>alert("User deleted successfully.");</script>';
        header("Location: manage_users.php");
        exit();
    } else {
        // Error occurred while deleting user
        echo '<script>alert("Error deleting user. Please try again.");</script>';
    }

    $stmt->close();
} else {
    // User ID not provided or invalid
    echo '<script>alert("Invalid user ID.");</script>';
}
?>
