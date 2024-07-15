<header class="header">
    <section class="flex">
        <div id="menu-btn" class="fas fa-bars-staggered"></div>
        <a href="home.php" class="logo"><i class="fas fa-briefcase"></i><b>JOB</b>iRIS</a>

        <nav class="navbar">
            <a href="admin_dashboard.php">Home</a>
            <a href="manage_companies.php">Manage Companies</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="manage_contacts.php">Contact Us</a>
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
            // Display the user's name
            echo '<a href="profile.php" class="btn" style="margin-top: 0;">' . $_SESSION['user_name'] . '</a>';
        } else {
            echo '<a href="post_job.php" class="btn" style="margin-top: 0;">Post Job</a>';
        }
        ?>
    </section>
</header>
