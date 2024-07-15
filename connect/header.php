<header class="header">
    <section class="flex">
        <div id="menu-btn" class="fas fa-bars-staggered"></div>
        <a href="home.php" class="logo"><i class="fas fa-briefcase"></i><b>JOB</b>iRIS</a>

        <nav class="navbar">
            <a href="home.php">Home</a>
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<a href="about.php">About us</a>';
                echo '<a href="jobs.php">All jobs</a>';
                echo '<a href="contact.php">Contact us</a>';
            } else {
                echo '<a href="#">About us</a>';
                echo '<a href="#">All jobs</a>';
                echo '<a href="#">Contact us</a>';
            }
            ?>
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<a href="profile.php">Profile</a>';
                // echo '<a href="connect/logout.php">Logout</a>';
            } else {
                echo '<a href="login.php">Account</a>';
            }
            ?>
        </nav>
        <?php
            if (isset($_SESSION['user_id'])) {
                // Display the user's name
                echo '<a href="#" class="btn" style="margin-top: 0;">' . $_SESSION['user_name'] . '</a>';
            } else {
                echo '<a href="post_job.php" class="btn" style="margin-top: 0;">Post Job</a>';
            }
        ?>
    </section>
</header>
