<?php
include '../connect/connect.php';
session_start();

// Initializing alert message and redirect URL variables
$alertMessage = "";
$redirectUrl = "index.php";

// Handling form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming you have a session variable storing the user's ID
    $user_id = $_SESSION['user_id'];

    $job_title = $_POST['job_title'];
    $job_location = $_POST['job_location'];
    $job_type = $_POST['job_type'];
    $job_shift = $_POST['job_shift'];
    $job_description = $_POST['job_description'];
    $skills_required = $_POST['skills_required'];
    $salary = $_POST['salary'];
    $education = $_POST['education'];
    $age = $_POST['age'];
    $language = $_POST['language'];
    $experience = $_POST['experience'];
    $qualification = $_POST['qualification'];
    $job_image = $_FILES['job_image']['name'];
    $target_dir = "../uploads/jobs/";
    $target_file = $target_dir . basename($_FILES['job_image']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES['job_image']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $alertMessage = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES['job_image']['size'] > 500000000) {
        $alertMessage = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $alertMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $alertMessage = "Sorry, your file was not uploaded.";
    // If everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES['job_image']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO jobs (company_id, job_title, job_location, job_type, job_shift, job_description, skills_required, salary, education, age, language, experience, qualification, job_image)
            VALUES ('$user_id', '$job_title', '$job_location', '$job_type', '$job_shift','$job_description', '$skills_required', '$salary', '$education', '$age', '$language', '$experience', '$qualification','$job_image')";

            if ($conn->query($sql) === TRUE) {
                $alertMessage = "New job registered successfully";
                // Redirect to index.php
                header("Location: $redirectUrl");
                exit(); // Ensure script execution stops here to avoid further output
            } else {
                $alertMessage = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $alertMessage = "Sorry, there was an error uploading your file.";
        }
    }

    // Close the database connection
    $conn->close();

    // Adding JavaScript to show the alert (if needed)
    // echo "<script>alert('$alertMessage');</script>";
}
?>
