<?php 
include 'connect/connect.php';
session_start();

// Fetch jobs from the database with user names
$sql = "SELECT jobs.*, company.company_name FROM jobs INNER JOIN company ON jobs.company_id = company.company_id LIMIT 6";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Home</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header, .footer {
            /* background-color: #333; */
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .home-container {
            padding: 20px;
        }
        .home form {
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        .home form h3 {
            margin-bottom: 15px;
        }
        .home form p {
            margin: 10px 0 5px;
        }
        .home form input[type="text"], .home form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .home form input[type="submit"] {
            background-color: #2699d6;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .home form input[type="submit"]:hover {
            background-color: #1b7ab3;
        }
        .category, .jobs-container {
            background: #fff;
            padding: 20px;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
        }
        .category h1, .jobs-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .box-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .box {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 20px;
            margin: 10px;
            flex: 1 1 30%;
            box-sizing: border-box;
            text-align: center;
        }
        .box img {
            max-width: 100%;
            height: auto;
        }
        .box h3 {
            margin: 15px 0;
        }
        .box .tags {
            display: flex;
            justify-content: space-between;
        }
        .box .tags p {
            margin: 5px 0;
        }
        .box .flex-btn {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .box .btn, .box .far {
            background-color: #2699d6;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .box .btn:hover, .box .far:hover {
            background-color: #1b7ab3;
        }
        .footer .grid {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .footer .box {
            flex: 1 1 30%;
            margin: 20px 0;
            text-align: center;
        }
        .footer .box a {
            color: #fff;
            display: block;
            margin: 5px 0;
            text-decoration: none;
        }
        .footer .box a:hover {
            text-decoration: underline;
        }
        .footer .credit {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body> 
        <?php include 'connect/header.php'; ?>
    <!-- header end -->

    <div class="home-container">

        <section class="home">
            <form action="" method="post">
                <h3>Find Your Next Opportunity</h3>
                <p>Job Title<span>*</span></p>
                <input type="text" name="title" placeholder="Keyword, category, or company" required maxlength="20" class="input">

                <p>Job Location</p>
                <input type="text" name="Location" placeholder="City, state, or country" required maxlength="50" class="input">

                <input type="submit" value="Search Job" name="search" class="btn">
            </form>
        </section>

    </div>

    <section class="jobs-container">
        <h1 class="heading">Latest Jobs</h1>
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
        <div style="text-align: center; margin-top: 2rem;">
            <a href="jobs.php" class="btn">View All</a>
        </div>
    </section>


    <!-- footer start -->
    <?php include 'connect/footer.php'; ?>
    <!-- footer end -->

    <script src="js/script.js"></script>

</body>
</html>
