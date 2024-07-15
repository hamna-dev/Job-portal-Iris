<header class="header">
    <section class="flex">
        <div id="menu-btn" class="fas fa-bars-staggered"></div>
        <a href="index.php" class="logo"><i class="fas fa-briefcase"></i><b>JOB</b>iRIS</a>

        <nav class="navbar">
            <a href="index.php">Home</a>
            <!-- <a href="about.php">About Us</a> -->
            <a href="jobs.php">All Jobs</a>
            <a href="contact.php">Contact Us</a>
            <?php
            if (isset($_SESSION['user_id'])) {
                // echo '<a href="profile.php">Profile</a>';
            } else {
                echo '<a href="login.php">Account</a>';
            }
            ?>
        </nav>

        <?php
        if (isset($_SESSION['user_id'])) {
            // Check if the user type is 'company' to display the "Post Job" button
            if ($_SESSION['user_type'] === 'company') {
                echo '<a href="add_post.php" class="btn" style="margin-top: 0;">Post Job</a>';
            }
            // Display the user's name
            echo '<a href="profile.php" class="btn" style="margin-top: 0;">' . $_SESSION['user_name'] . '</a>';
        } else {
            echo '<a href="post_job.php" class="btn" style="margin-top: 0;">Post Job</a>';
        }
        ?>
    </section>
</header>
