<?php
include 'connect/connect.php';
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the form data
    $job_id = sanitize($_POST['job_id']);
    $applicant_name = sanitize($_POST['applicant_name']);
    $applicant_email = sanitize($_POST['applicant_email']);
    $applicant_phone = sanitize($_POST['applicant_phone']);
    $applicant_resume = $_FILES['applicant_resume']['name'];
    $applicant_resume_temp = $_FILES['applicant_resume']['tmp_name'];

    // Move uploaded resume to a permanent location
    move_uploaded_file($applicant_resume_temp, "uploads/resumes/$applicant_resume");

    // Get user_id from session
    $user_id = $_SESSION['user_id'];

    // Insert the application into the database
    $insert_query = "INSERT INTO applications (user_id, job_id, applicant_name, applicant_email, applicant_phone, applicant_resume) 
                     VALUES ('$user_id', '$job_id', '$applicant_name', '$applicant_email', '$applicant_phone', '$applicant_resume')";
    $result = mysqli_query($conn, $insert_query);

    if ($result) {
        // Application submitted successfully
        echo "<script>alert('Application submitted successfully'); window.location.href = 'jobs.php';</script>";
        exit; // Add exit to prevent further execution of the script
    } else {
        // Application submission failed
        echo "<script>alert('Error submitting application');</script>";
    }
}

// Function to sanitize input data
function sanitize($input) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags(trim($input))));
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* CSS for Apply for Job form */

.account-form {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
}

.heading {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 5px;
    font-size: 16px;
}

input[type="file"] {
    cursor: pointer;
}

.btn {
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.form-container {
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.error-message {
    color: red;
    margin-top: 10px;
}

    </style>
</head>
<body>

    <!-- header start -->
    <?php include 'connect/header.php'; ?>
    <!-- header end -->

    <section class="account-form">
        <h1 class="heading">Apply for Job</h1>
        <div class="form-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="job_id" value="<?php echo $_GET['job_id']; ?>">
                <div class="form-group">
                    <label for="applicant_name">Your Name:</label>
                    <input type="text" name="applicant_name" id="applicant_name" value="<?php echo $_SESSION['user_name'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="applicant_email">Your Email:</label>
                    <input type="email" name="applicant_email" id="applicant_email" value="<?php echo $_SESSION['user_email'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="applicant_phone">Your Phone:</label>
                    <input type="tel" name="applicant_phone" id="applicant_phone" required>
                </div>
                <div class="form-group">
                    <label for="applicant_resume">Upload Resume:</label>
                    <input type="file" name="applicant_resume" id="applicant_resume" accept=".pdf,.doc,.docx" required>
                </div>
                <button type="submit" class="btn">Submit Application</button>
            </form>
        </div>
    </section>

    
    <!-- footer start -->
    <?php include 'connect/footer.php'; ?>
    <!-- footer end -->

    <script src="js/script.js"></script>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
