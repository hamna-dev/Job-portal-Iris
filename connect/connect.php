<?php
$servername = "localhost"; // server name
$username = "root";        // username
$password = "";            // password
$dbname = "jobiris_db";    // database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
