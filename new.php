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
    <title>View Company Details</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body> 
 
    <!-- header start -->
    <?php include 'connect/header.php'; ?>
    <!-- header end -->
 
    <section class="company-details">
        <h1 class="heading">Company Details</h1>

        <div class="details">
            <div class="company-info">
                <h3><?php echo $company_row['company_name']; ?></h3>
                <p><i class="fas fa-map-marker-alt"></i><?php echo $company_row['company_location']; ?></p>
                <!-- Add more company details as necessary -->
            </div>

            <div class="description">
                <h3>About Company</h3>
                <p><?php echo $company_row['about_company']; ?></p>
            </div>

            <ul>
                <!-- Display additional company information -->
                <li>Established on <?php echo $company_row['established_date']; ?></li>
                <li><?php echo $company_row['working_employees']; ?> Working Employees</li>
                <!-- Add more company information if necessary -->
            </ul>
        </div>
    </section>

    <!-- footer start -->
    <?php include 'connect/footer.php'; ?>
    <!-- footer end -->

<script src="js/script.js"></script>

</body>
</html>
