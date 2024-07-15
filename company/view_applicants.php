<?php
// Include the database connection file
include '../connect/connect.php';
session_start();

if (!isset($_GET['id'])) {
    die("Job ID not specified.");
}

$job_id = intval($_GET['id']);

// Fetch job details
$sql_job = "SELECT jobs.job_title, company.company_name FROM jobs INNER JOIN company ON jobs.company_id = company.company_id WHERE jobs.job_id = ?";
$stmt_job = $conn->prepare($sql_job);
$stmt_job->bind_param("i", $job_id);
$stmt_job->execute();
$stmt_job->bind_result($job_title, $company_name);
$stmt_job->fetch();
$stmt_job->close();

// Fetch applicants for the specified job
$sql_applicants = "SELECT application_id, applicant_name, applicant_email, applicant_phone, applicant_resume, application_date FROM applications WHERE job_id = ?";
$stmt_applicants = $conn->prepare($sql_applicants);
$stmt_applicants->bind_param("i", $job_id);
$stmt_applicants->execute();
$result_applicants = $stmt_applicants->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applicants</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header, .footer {
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .container {
            padding: 20px;
        }
        .applicant-list {
            background: #fff;
            padding: 30px;
            margin: 30px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
        }
        .applicant-list h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2em;
        }
        .applicant {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 30px;
            margin: 20px;
            font-size: 1.2em;
        }
        .applicant h3 {
            margin: 15px 0;
            font-size: 1.5em;
        }
        .applicant p {
            margin: 10px 0;
            font-size: 1.2em;
        }
        .applicant a.btn {
            background-color: #2699d6;
            color: #fff;
            padding: 15px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1.2em;
        }
        .applicant a.btn:hover {
            background-color: #1b7ab3;
        }
    </style>
</head>
<body>

    <!-- header start -->
    <?php include 'connect/company_header.php'; ?>
    <!-- header end -->

    <div class="container">
        <div class="applicant-list">
            <h1>Applicants for <?php echo htmlspecialchars($job_title); ?> at <?php echo htmlspecialchars($company_name); ?></h1>
            <?php 
            if ($result_applicants->num_rows > 0) {
                // Output data of each row
                while($applicant = $result_applicants->fetch_assoc()) {
            ?>
            <div class="applicant">
                <h3><?php echo htmlspecialchars($applicant['applicant_name']); ?></h3>
                <p>Email: <?php echo htmlspecialchars($applicant['applicant_email']); ?></p>
                <p>Phone: <?php echo htmlspecialchars($applicant['applicant_phone']); ?></p>
                <p>Resume: <a href="../uploads/resumes/<?php echo htmlspecialchars($applicant['applicant_resume']); ?>" target="_blank">View Resume</a></p>
                <p>Application Date: <?php echo htmlspecialchars($applicant['application_date']); ?></p>
                <a href="contact_applicant.php?id=<?php echo intval($applicant['application_id']); ?>" class="btn">Contact Applicant</a>
            </div>
            <?php 
                }
            } else {
                echo "<p>No applicants found.</p>";
            }
            ?>
        </div>
    </div>

    <!-- footer start -->
    <?php include 'connect/company_footer.php'; ?>
    <!-- footer end -->

    <script src="../js/script.js"></script>

</body>
</html>
