<?php
include '../connect/connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Check if user is an admin
$user_id = $_SESSION['user_id'];
$sql = "SELECT user_type FROM company WHERE company_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($user_type);
$stmt->fetch();
$stmt->close();

// Fetch contact messages from the database
$sql = "SELECT * FROM contact_messages";
$result = $conn->query($sql);

// Handle deletion of messages
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM contact_messages WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $delete_id);

    if ($delete_stmt->execute()) {
        $feedback = "Message deleted successfully.";
    } else {
        $feedback = "Failed to delete the message.";
    }

    $delete_stmt->close();
    header("Location: manage_contacts.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contacts</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
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

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .admin-table th,
        .admin-table td {
            padding: 15px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .admin-table th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }

        .admin-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .admin-table tr:hover {
            background-color: #ddd;
        }

        .admin-table a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
            font-weight: bold;
        }

        .admin-table a:hover {
            text-decoration: underline;
        }

        .btn-view,
        .btn-delete {
            padding: 10px 8px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
            margin-right: 10px;
        }

        .btn-view:hover,
        .btn-delete:hover {
            background-color: #0056b3;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-container {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <?php include 'connect/admin_header.php'; ?>

    <!-- Main Content -->
    <div class="admin-container">
        <h1>Manage Contacts</h1>
        <?php if (isset($feedback)): ?>
            <p class="feedback"><?php echo $feedback; ?></p>
        <?php endif; ?>
        <table class="admin-table">
            <tr>
                <th><h3>#</h3></th>
                <th><h3>Name</h3></th>
                <th><h3>Email</h3></th>
                <th><h3>Phone</h3></th>
                <th><h3>Message</h3></th>
                <th><h3>Action</h3></th>
            </tr>
            <?php 
            $counter = 1;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><h3><?php echo $counter++; ?></h3></td>
                <td><h3><?php echo htmlspecialchars($row['name']); ?></h3></td>
                <td><h3><?php echo htmlspecialchars($row['email']); ?></h3></td>
                <td><h3><?php echo htmlspecialchars($row['phone']); ?></h3></td>
                <td><h3><?php echo htmlspecialchars($row['message']); ?></h3></td>
                <td class="btn-container">
                    <a href="#" class="btn-view" style="color:white;">View</a>
                    <a href="manage_contacts.php?delete_id=<?php echo $row['message_id']; ?>" class="btn-delete" style="color:white;" onclick='return confirm("Are you sure you want to delete this message?")'>Delete</a>
                </td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='6'>No messages found.</td></tr>";
            }
            ?>
        </table>
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
