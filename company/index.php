<?php 
include '../connect/connect.php';
session_start();

// Fetch jobs from the database with user names
$user_id = $_SESSION['user_id'];
$sql = "SELECT jobs.*, company.company_name FROM jobs INNER JOIN company ON jobs.company_id = company.company_id WHERE jobs.company_id = $user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Home</title>
    <link rel="stylesheet" href="../css/style.css">
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
        /* Profile Container */

        .profile {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .profile h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        .profile p {
            margin-bottom: 15px;
            color: #333;
        }

        .profile img {
            border-radius: 50%;
            margin-bottom: 20px;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .profile-options {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .profile-options .btn {
            padding: 10px 20px;
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .profile-options .btn:hover {
            background-color: var(--black);
        }

        /* Add custom CSS styles here */
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
    </style>
</head>
<body>

    <!-- header start -->
    <div class="header" style="color: black;">
        <h1>Company Header</h1>
    </div>
       
        <?php include 'connect/company_header.php'; ?>
    <!-- header end -->

    <div class="home-container">

        <div class="profile-container">
            <section class="profile">
                <div class="admin-container">
                    <h1>Welcome <?php echo $_SESSION['user_name'] ?>!</h1>
                    <p>You must update your details in your profile.</p>
                    <p>You can add, edit, or delete Jobs here.</p>
                </div>
            </section>
        </div>

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
                    <img src="../uploads/jobs/<?php echo $row['job_image']; ?>" alt="">
                    <div>
                        <h3><?php echo $row['company_name']; ?></h3>
                        <p><?php echo $row['created_at']; ?></p>
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
                    <a href="view_applicants.php?id=<?php echo $row['job_id']; ?>" class="btn">View Details</a>
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
    <?php include 'connect/company_footer.php'; ?>
    <!-- footer end -->

    <script src="../js/script.js"></script>

</body>
</html>
