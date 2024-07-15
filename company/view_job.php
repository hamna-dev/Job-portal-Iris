<?php 
include '../connect/connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or display an error message
    header("Location: login.php");
    exit(); // Stop further execution
}

// Fetch jobs posted by the logged-in user from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT jobs.*, company.company_name AS user_name FROM jobs INNER JOIN company ON jobs.company_id = company.company_id WHERE jobs.company_id = $user_id";
$result = $conn->query($sql);

// Check if job ID is provided in the URL parameters
if (isset($_GET['id'])) {
    $job_id = $_GET['id'];
    
    // Query to fetch details of the selected job
    $job_query = "SELECT * FROM jobs WHERE job_id = $job_id";
    $job_result = $conn->query($job_query);
    
    // Fetch job details
    $job_row = $job_result->fetch_assoc();
} else {
    // Redirect or display an error message if job ID is not provided
    header("Location: all_jobs.php");
    exit(); // Stop further execution
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Job Details</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body> 
 
    <!-- header start -->
    <?php include 'connect/company_header.php'; ?>
    <!-- header end -->
 
    <section class="job-details">
        <h1 class="heading">Job Details</h1>

        <div class="details">
            <div class="job-info">
                <h3><?php echo $job_row['job_title']; ?></h3>
                <!-- <a href="view_company.php">IT infosys Co.</a> -->
                <p><i class="fas fa-map-marker-alt"></i><?php echo $job_row['job_location']; ?></p>
            </div>

            <div class="basic-details">
                <h3>Salary</h3>
                <p><?php echo $job_row['salary']; ?></p>
                
                <!-- Add more fields as per your database structure -->
                <h3>Benefits</h3>
                <p>Work from home, health insurance</p>

                <h3>Job Type</h3>
                <p><?php echo $job_row['job_type']; ?></p>

                <h3>Schedule</h3>
                <p><?php echo $job_row['job_shift']; ?></p>
            </div>

            <ul>
                <h3>Requirements</h3>
                <li>Education: <span><?php echo $job_row['education']; ?></span></li>
                <li>Age: <span><?php echo $job_row['age']; ?></span></li>
                <li>Language: <span><?php echo $job_row['language']; ?></span></li>
                <li>Experience: <span><?php echo $job_row['experience']; ?></span></li>
            </ul>

            <ul>
                <h3>Qualification</h3>
                <li><?php echo $job_row['qualification']; ?></li>
                <!-- Add more qualification fields if necessary -->
            </ul>

            <div class="description">
                <h3>Job Description</h3>
                <p><?php echo $job_row['job_description']; ?></p>
                <ul>
                    <li>Hiring 2 candidates for this role</li>
                    <li>Posted <?php echo $job_row['created_at']; ?></li>
                </ul>  
            </div>
        </div>
    </section>

    <!-- footer start -->
    <?php include 'connect/company_footer.php'; ?>
    <!-- footer end -->

<script src="js/script.js"></script>

</body>
</html>
