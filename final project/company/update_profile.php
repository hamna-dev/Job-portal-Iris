<?php
include '../connect/connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['user_id'];

// Fetch jobs posted count from jobs table
$sql_jobs = "SELECT COUNT(*) FROM jobs WHERE company_id = ?";
$stmt_jobs = $conn->prepare($sql_jobs);

if ($stmt_jobs === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt_jobs->bind_param("i", $user_id);
$stmt_jobs->execute();
$stmt_jobs->bind_result($jobs_posted);
$stmt_jobs->fetch();
$stmt_jobs->close();

// Fetch company name and profile image from user table
$sql_user = "SELECT company_name, profile_image FROM company WHERE company_id = ?";
$stmt_user = $conn->prepare($sql_user);

if ($stmt_user === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$stmt_user->bind_result($company_name, $user_profile_image);
$stmt_user->fetch();
$stmt_user->close();

// Fetch company details from companies table
$sql_company = "SELECT company_location, about_company, established_date, working_employees FROM company WHERE company_id = ?";
$stmt_company = $conn->prepare($sql_company);

if ($stmt_company === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt_company->bind_param("i", $user_id);
$stmt_company->execute();
$stmt_company->bind_result($company_location, $about_company, $established_date, $working_employees);
$stmt_company->fetch();
$stmt_company->close();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    function sanitize($input) {
        global $conn;
        return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags(trim($input))));
    }

    $company_location = sanitize($_POST['company_location'] ?? '');
    $about_company = sanitize($_POST['about_company'] ?? '');
    $established_date = sanitize($_POST['established_date'] ?? '');
    $working_employees = intval($_POST['working_employees'] ?? 0);

    // Use the profile image from the user table
    $profile_image = $user_profile_image;

    // Update company details in the database
    $sql_update = "UPDATE company SET company_location = ?, about_company = ?, established_date = ?, working_employees = ? WHERE company_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    
    if ($stmt_update === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt_update->bind_param("sssss", $company_location, $about_company, $established_date, $working_employees, $user_id);
    if ($stmt_update->execute()) {
        // Redirect to profile page after successful update
        header("Location: profile.php");
        exit();
    } else {
        die('Update failed: ' . htmlspecialchars($stmt_update->error));
    }

    $stmt_update->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
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
    <?php include 'connect/company_header.php'; ?>
    <!-- header end -->

    <div class="edit-profile-container">
        <div class="edit-profile">
            <h2>Update Profile</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" name="company_name" value="<?php echo htmlspecialchars($company_name); ?>" class="input" readonly>
                
                <label for="company_location">Company Location:</label>
                <input type="text" id="company_location" name="company_location" value="<?php echo htmlspecialchars($company_location); ?>" class="input">
                
                <label for="about_company">About Company:</label>
                <textarea id="about_company" name="about_company" class="input"><?php echo htmlspecialchars($about_company); ?></textarea>
                
                <label for="jobs_posted">Jobs Posted:</label>
                <input type="text" id="jobs_posted" name="jobs_posted" value="<?php echo htmlspecialchars($jobs_posted); ?>" class="input">
                
                <label for="established_date">Established Date:</label>
                <input type="date" id="established_date" name="established_date" value="<?php echo htmlspecialchars($established_date); ?>" class="input">
                
                <label for="working_employees">Working Employees:</label>
                <input type="number" id="working_employees" name="working_employees" value="<?php echo htmlspecialchars($working_employees); ?>" class="input">

                <input type="submit" value="Update Profile" class="btn">
            </form>
        </div>
    </div>

    <!-- footer start -->
    <?php include 'connect/company_footer.php'; ?>
    <!-- footer end -->

    <script src="../js/script.js"></script>

</body>
</html>

