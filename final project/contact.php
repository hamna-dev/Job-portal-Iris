<?php
// Include the database connection file
include 'connect/connect.php';
session_start();
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, phone FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $phone);
$stmt->fetch();
$stmt->close();


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $role = $_POST['role'];
    $message = $_POST['message'];

    // Insert the contact message into the database
    $insert_query = "INSERT INTO contact_messages (name, email, phone, role, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ssiss", $name, $email, $number, $role, $message);
    
    // Check if the query executed successfully
    if ($stmt->execute()) {
        // Message sent successfully
        echo "<script>alert('Message sent successfully');</script>";
    } else {
        // Failed to send message
        echo "<script>alert('Error sending message');</script>";
    }
    
    // Close statement
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contect us</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
 
    <!-- header start -->
    <?php include 'connect/header.php'; ?>
    <!-- header end -->
 
<div class="section-title">contact us</div>

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
            <a href="#"> NO-25, AALIM STREET KINNIYA 03 mumbai, INDIA -40014  </a>
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
                <input type="tel" name="number" required min="0" max="999999999" maxlength="15" placeholder="Enter your number" class="input" value="<?php echo $phone; ?>">
            </div>
    
            <div class="box">
                <p>Role <span>*</span></p>
                <select name="role" required class="input">
                    <option value="job seeker">Job Seeker</option>
                </select>
            </div>
    
        </div>
        <p>Message <span>*</span></p>
        <textarea name="message" class="input" required maxlength="1000" placeholder="Enter your message" cols="30" rows="10"></textarea>
        <input type="submit" value="Send Message" name="send" class="btn">
    </form>
</section>
 




    <!-- footer start -->
    <?php include 'connect/footer.php'; ?>
    <!-- footer end -->




<script src="js/script.js"></script>

</body>
</html>