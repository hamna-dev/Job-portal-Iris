<?php 
include 'connect/connect.php';
session_start();

// Fetch jobs from the database with user names
$sql = "SELECT jobs.*, company.company_name FROM jobs INNER JOIN company ON jobs.company_id = company.company_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All jobs</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- header start -->
    <?php include 'connect/header.php'; ?>
    <!-- header end -->

    <section class="job-filter">
        <h1 class="heading">Filter Jobs</h1>
        <form action="" method="post">
            <div class="flex">
                <div class="box">
                    <p>Job Title <span>*</span></p>
                    <input type="text" name="title" placeholder="Keyword, category or company" maxlength="20" class="input">
                </div>
                <div class="box">
                    <p>Job Location</p>
                    <input type="text" name="location" placeholder="City, state or country" maxlength="50" class="input">
                </div>
            </div>

            <div class="dropdown-container">
                <!-- Dropdowns for other filters -->
            </div>

            <button type="submit" class="btn">Search</button>
        </form>
    </section>

    <section class="jobs-container">
        <h1 class="heading">All Jobs</h1>
        <div class="box-container">
            <?php 
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
            ?>
            <div class="box">
                <div class="company">
                    <img src="uploads/jobs/<?php echo $row['job_image']; ?>" alt="">
                    <div>
                        <h3><?php echo $row['company_name']; ?></h3>
                        <?php
                        $posted_days_ago = date_diff(date_create($row['created_at']), date_create('today'))->format('%a');
                        ?>
                        <p><?php echo ($posted_days_ago == 0) ? 'Posted today' : 'Posted ' . $posted_days_ago . ' days ago'; ?></p>
                    </div>
                </div>
                <h3 class="job-title"><?php echo $row['job_title']; ?></h3>
                <p class="location"><i class="fas fa-map-marker-alt"></i><span><?php echo $row['job_location']; ?></span></p>
                <div class="tags">
                    <p><i class="fas fa-rupee-sign"></i><span><?php echo $row['salary']; ?></span></p>
                    <p><i class="fas fa-briefcase"></i><span><?php echo $row['job_type']; ?></span></p>
                    <p><i class="fas fa-clock"></i><span><?php echo $row['job_shift']; ?></span></p>
                </div>
                <div class="flex-btn">
                    <a href="view_job.php?id=<?php echo $row['job_id']; ?>" class="btn">View Details</a>
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
