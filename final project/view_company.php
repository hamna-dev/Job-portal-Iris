<?php 
include 'connect/connect.php';
session_start();

// Check if company ID is provided in the URL parameters
if (isset($_GET['company_id'])) {
    $company_id = $_GET['company_id'];
    
    // Query to fetch details of the selected company
    $company_query = "SELECT * FROM company WHERE company_id = $company_id";
    $company_result = $conn->query($company_query);
    
    // Fetch company details
    $company_row = $company_result->fetch_assoc();
} else {
    // Redirect or display an error message if company ID is not provided
    header("Location: all_companies.php");
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Company</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
 
    <!-- header start -->
    <?php include 'connect/header.php'; ?>
    <!-- header end -->
 
    <section class="view-company">
        <h1 class="heading">Company Details</h1>

        <div class="details">
            <div class="info">
                <!-- Display company logo if available -->
                <img src="<?php echo $company_row['profile_image']; ?>" alt="Company Logo">
                <h3><?php echo $company_row['company_name']; ?></h3>
                <p><i class="fas fa-map-marker-alt"></i><?php echo $company_row['company_location']; ?></p>
            </div>

            <div class="description">
                <h3>About Company</h3>
                <p><?php echo $company_row['about_company']; ?></p>
            </div>

            <ul>
                <!-- <li><?php echo $company_row['jobs_posted']; ?> Jobs Posted</li> -->
                <li>Established on <?php echo $company_row['established_date']; ?></li>
                <li><?php echo $company_row['working_employees']; ?> Working Employees</li>
            </ul>
        </div>
    </section>

    <section class="jobs-container">
    <h1 class="heading">Jobs They Offer</h1>
    <div class="box-container">
        <?php 
        // Query to fetch jobs offered by the company
        $jobs_query = "SELECT * FROM jobs WHERE company_id = $company_id";
        $jobs_result = $conn->query($jobs_query);

        if ($jobs_result->num_rows > 0) {
            while ($job = $jobs_result->fetch_assoc()) {
        ?>
        <div class="box">
            <div class="company">
                <!-- Display company logo if available -->
                <img src="uploads/jobs/<?php echo $job['job_image']; ?>" alt="Company Logo">
                <div>
                    <h3><?php echo $company_row['company_name']; ?></h3>
                    <!-- Example: Display posted days ago using PHP -->
                    <?php
                    $posted_days_ago = date_diff(date_create($job['created_at']), date_create('today'))->format('%a');
                    ?>
                    <p><?php echo ($posted_days_ago == 0) ? 'Posted today' : 'Posted ' . $posted_days_ago . ' days ago'; ?></p>
                </div>
            </div>
            <h3 class="job-title"><?php echo $job['job_title']; ?></h3>
            <p class="location"><i class="fas fa-map-marker-alt"></i><span><?php echo $job['job_location']; ?></span></p>
            <div class="tags">
                <p><i class="fas fa-indian-rupee-sign"></i><span><?php echo $job['salary']; ?></span></p>
                <p><i class="fas fa-briefcase"></i><span><?php echo $job['job_type']; ?></span></p>
                <p><i class="fas fa-clock"></i><span><?php echo $job['job_shift']; ?></span></p>
            </div>
            <div class="flex-btn">
                <a href="view_job.php?id=<?php echo $job['job_id']; ?>" class="btn">View Details</a>
                <button type="submit" class="far fa-heart" name="save"></button>
            </div>
        </div>
        <?php 
            }
        } else {
            echo "No jobs found.";
        }
        ?>
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
