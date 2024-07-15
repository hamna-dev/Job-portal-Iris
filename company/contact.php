<?php
// Include the database connection file
include '../connect/connect.php';
session_start();

$alert_message = "";

if (isset($_POST['send'])) {
    // Retrieve and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $number = htmlspecialchars($_POST['number']);
    $role = htmlspecialchars($_POST['role']);
    $message = htmlspecialchars($_POST['message']);

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, role, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $number, $role, $message);

    if ($stmt->execute()) {
        $alert_message = "Your message has been sent successfully!";
    } else {
        $alert_message = "Failed to send your message. Please try again later.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
        .contact-form input[type="email"],
        .contact-form input[type="tel"],
        .contact-form select,
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

<div class="section-title">Contact Us</div>

<section class="contact">
    <div class="box-container">
        <div class="box">
            <i class="fas fa-phone"></i>
            <a href="tel:0752828672">0752-828-672</a>
            <a href="tel:1111133333">0111-113-333</a>
        </div>
        <div class="box">
            <i class="fas fa-envelope"></i>
            <a href="mailto:hamna@gmail.com">hamna@gmail.com</a>
            <a href="mailto:sath@gmail.com">sath@gmail.com</a>
        </div>
        <div class="box">
            <i class="fas fa-map-marker-alt"></i>
            <a href="#">NO-25, AALIM STREET KINNIYA 03 Mumbai, INDIA - 40014</a>
        </div>
    </div>
    <form action="" method="post">
        <h3>Drop Your Message</h3>
        <div class="flex">
            <div class="box">
                <p>Name <span>*</span></p>
                <input type="text" name="name" required maxlength="50" placeholder="Enter your name" class="input" value="<?php echo $_SESSION['user_name'] ?>">
            </div>
            <div class="box">
                <p>Email <span>*</span></p>
                <input type="email" name="email" required maxlength="50" placeholder="Enter your email" class="input" value="<?php echo $_SESSION['user_email'] ?>">
            </div>
            <div class="box">
                <p>Number <span>*</span></p>
                <input type="tel" name="number" required min="0" max="999999999" maxlength="15" placeholder="Enter your number" class="input">
            </div>
            <div class="box">
                <p>Role <span>*</span></p>
                <select name="role" required class="input">
                    <option value="job provider">Company</option>
                </select>
            </div>
        </div>
        <p>Message <span>*</span></p>
        <textarea name="message" class="input" required maxlength="1000" placeholder="Enter your message" cols="30" rows="10"></textarea>
        <input type="submit" value="Send Message" name="send" class="btn">
    </form>
</section>

    <!-- footer start -->
    <?php include 'connect/company_footer.php'; ?>
    <!-- footer end -->

<script src="../js/script.js"></script>
<?php if ($alert_message): ?>
    <script>
        alert("<?php echo $alert_message; ?>");
    </script>
<?php endif; ?>
</body>
</html>
