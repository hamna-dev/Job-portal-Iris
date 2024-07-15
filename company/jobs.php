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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All jobs</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body> 
 
    <!-- header start -->
    <?php include 'connect/company_header.php'; ?>
    <!-- header end -->
 
    <section class="jobs-container">

        <h1 class="heading">Your posted jobs</h1>
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
                        <!-- Display the name of the user who posted the job -->
                        <h3><?php echo $row['user_name']; ?></h3>
                        <p><?php echo $row['created_at']; ?></p>
                    </div>
                </div>
                <h3 class="job-title"><?php echo $row['job_title']; ?></h3>
                <p class="location"><i class="fas fa-map-marker-alt"></i><span><?php echo $row['job_location']; ?></span></p>
                <div class="tags">
                    <p><i class="fas fa-indian-rupee-sign"></i><span><?php echo $row['salary']; ?></span></p>
                    <p><i class="fas fa-briefcase"></i><span><?php echo $row['job_type']; ?></span></p>
                    <p><i class="fas fa-clock"></i><span><?php echo $row['job_shift']; ?></span></p>
                </div>
                <div class="flex-btn">
                    <a href="view_applicants.php?id=<?php echo $row['job_id']; ?>" class="btn">view details</a>
                    <button type="submit" class="far fa-heart" name="save"></button>
                </div>
            </div>
            <?php 
                }
            } else {
                echo "You haven't posted any jobs yet.";
            }
            ?>
        </div>

    </section>

    <!-- footer start -->
    <?php include 'connect/company_footer.php'; ?>
    <!-- footer end -->




<script src="js/script.js"></script>

<script>
    let dropdowm_items = document.querySelectorAll('.job-filter form .dropdown-container .dropdowm .lists .items');

    dropdowm_items.forEach(items =>
    {
        items.onclick = () =>
        {
            items_parent = items.parentElement.parentElement;
            let output = items_parent.querySelector('.output');
            output.value = items.innerText;
        }
    })
</script>

</body>
</html>