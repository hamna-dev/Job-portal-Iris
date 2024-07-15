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

// Check if company ID to delete is provided
if (isset($_GET['company_id']) && is_numeric($_GET['company_id'])) {
    $company_id = $_GET['company_id'];

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM company WHERE company_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $company_id);
    
    if ($stmt->execute()) {
        // Company deleted successfully
        alert("Company deleted successfully!");
        // Redirect to manage_companies.php
        header("Location: manage_companies.php");
        exit();
    } else {
        // Error occurred while deleting company
        echo "Error deleting company. Please try again.";
    }

    $stmt->close();
} else {
    // Company ID not provided or invalid
    echo "Invalid company ID.";
}
?>
