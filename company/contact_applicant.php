<?php
// Include the database connection file
include '../connect/connect.php';
session_start();

if (!isset($_GET['id'])) {
    die("Applicant ID not specified.");
}

$applicant_id = intval($_GET['id']);

// Fetch applicant details
$sql_applicant = "SELECT applicant_name, applicant_email FROM applications WHERE application_id = ?";
$stmt_applicant = $conn->prepare($sql_applicant);
$stmt_applicant->bind_param("i", $applicant_id);
$stmt_applicant->execute();
$stmt_applicant->bind_result($applicant_name, $applicant_email);
$stmt_applicant->fetch();
$stmt_applicant->close();

// Define company email
$company_email =  $_SESSION['user_email']; // Replace with your company's email address

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $headers = "From: " . $company_email . "\r\n" .
               "Reply-To: " . $company_email . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Include the applicant's name in the message
    $full_message = "Dear " . htmlspecialchars($applicant_name) . ",\n\n" . $message;

    // Send email
    if (mail($applicant_email, $subject, $full_message, $headers)) {
        $email_status = "Email sent successfully.";
    } else {
        $email_status = "Failed to send email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Applicant</title>
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
        .contact-form {
            background: #fff;
            padding: 30px;
            margin: 30px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }
        .contact-form h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2em;
        }
        .contact-form form {
            display: flex;
            flex-direction: column;
        }
        .contact-form label {
            margin-bottom: 10px;
            font-size: 1.2em;
        }
        .contact-form input[type="text"],
        .contact-form textarea {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1.2em;
            width: 100%;
            box-sizing: border-box;
        }
        .contact-form input[type="submit"] {
            background-color: #2699d6;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2em;
        }
        .contact-form input[type="submit"]:hover {
            background-color: #1b7ab3;
        }
        .status {
            text-align: center;
            margin-top: 20px;
            font-size: 1.2em;
        }
    </style>
</head>
<body>

    <!-- header start -->
    <?php include 'connect/company_header.php'; ?>
    <!-- header end -->

    <div class="container">
        <div class="contact-form">
            <h1>Contact <?php echo htmlspecialchars($applicant_name); ?></h1>
            <?php if (isset($email_status)) { ?>
                <p class="status"><?php echo htmlspecialchars($email_status); ?></p>
            <?php } ?>
            <form method="post" action="">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required>
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="8" required></textarea>
                <input type="submit" value="Send Email">
            </form>
        </div>
    </div>

    <!-- footer start -->
    <?php include 'connect/company_footer.php'; ?>
    <!-- footer end -->

    <script src="../js/script.js"></script>

</body>
</html>
