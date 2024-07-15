<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="images/employer.png" type="image/x-icon">
<link rel="shortcut icon" href="images/employer.png" type="image/x-icon" />
<title>Jobs</title>
<link rel="stylesheet" type="text/css" href="css/style-employer.css" />
<link rel="stylesheet" type="text/css" href="lib/jquery.ad-gallery.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="lib/jquery.ad-gallery.js"></script>
<script type="text/javascript" src="js/validation_employer.js"></script>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}
.employee_register {
    width: 60%;
    margin: 50px auto;
    background: #fff;
    padding: 20px;
    box-shadow: 0px 0px 10px 0px #000;
    overflow: auto; /* Add overflow property */
}
.employee_register img {
    margin-bottom: 20px;
}
.employee_register span {
    font-size: 20px;
    color: #2699d6;
}
.employee_register table {
    width: 100%;
}
.employee_register table td {
    padding: 10px;
}
.employee_register input[type=text], .employee_register select, .employee_register textarea {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}
.employee_register textarea {
    width: 100%;
    height: 100px; /* Set the height as needed */
}
.employee_register input[type=submit] {
    background-color: #2699d6;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}
.employee_register input[type=submit]:hover {
    background-color: #1b7ab3;
}
.em_reg_star {
    color: red;
}
</style>
</head>
<body>

<form action="submit_job.php" method="post" name="employer_registration" enctype="multipart/form-data">
    <div class="employee_register">
        <a href="index.php"><span><- Back to Home</span></a>
        <table>
            <!-- New Job Section -->
            <tr>
                <td colspan="3"><span class="em_head_one">New Job Details</span></td>
            </tr>
            <tr>
                <td><span class="em_reg_star">*</span> Job Title</td>
                <td>:</td>
                <td><input type="text" placeholder="Job Title" name="job_title" class="em_reg_box" /></td>
            </tr>
            <tr>
                <td><span class="em_reg_star">*</span> Job Location</td>
                <td>:</td>
                <td><input type="text" placeholder="Job Location" name="job_location" class="em_reg_box" /></td>
            </tr>
            <tr>
                <td><span class="em_reg_star">*</span> Job Type</td>
                <td>:</td>
                <td>
                    <select name="job_type" class="em_reg_box_select">
                        <option value="" selected="selected">--Select--</option>
                        <option value="Full-Time">Full-Time</option>
                        <option value="Part-Time">Part-Time</option>
                        <option value="Contract">Contract</option>
                        <option value="Temporary">Temporary</option>
                        <option value="Internship">Internship</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><span class="em_reg_star">*</span> Job Shift</td>
                <td>:</td>
                <td>
                    <select name="job_shift" class="em_reg_box_select">
                        <option value="" selected="selected">--Select--</option>
                        <option value="Day-Shift">Day-Shift</option>
                        <option value="Night-Shift">Night-Shift</option>
                        <option value="Flexible-Shift">Flexible-Shift</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><span class="em_reg_star">*</span> Job Description</td>
                <td>:</td>
                <td><textarea name="job_description" placeholder="Job Description" class="em_address" style="width: 100%; height: 100px;"></textarea></td>
            </tr>
            <tr>
                <td><span class="em_reg_star">*</span> Skills Required</td>
                <td>:</td>
                <td><input type="text" placeholder="Skills Required" name="skills_required" class="em_reg_box" /></td>
            </tr>
            <tr>
                <td><span class="em_reg_star">*</span> Salary</td>
                <td>:</td>
                <td><input type="text" placeholder="Salary" name="salary" class="em_reg_box" /></td>
            </tr>
            <tr>
                <td><span class="em_reg_star">*</span> Job Image</td>
                <td>:</td>
                <td><input type="file" name="job_image" class="em_reg_box" /></td>
            </tr>
            
            <!-- Requirements Section -->
            <tr>
                <td colspan="3"><span class="em_head_one">Requirements</span></td>
            </tr>
            <tr>
                <td><span class="em_reg_star">*</span> Education</td>
                <td>:</td>
                <td><input type="text" placeholder="Education" name="education" class="em_reg_box" /></td>
            </tr>
            <tr>
                <td><span class="em_reg_star">*</span> Age</td>
                <td>:</td>
                <td><input type="text" placeholder="Age" name="age" class="em_reg_box" /></td>
            </tr>
            <tr>
                <td><span class="em_reg_star">*</span> Language</td>
                <td>:</td>
                <td><input type="text" placeholder="Language" name="language" class="em_reg_box" /></td>
            </tr>
            <tr>
                <td><span class="em_reg_star">*</span> Experience</td>
                <td>:</td>
                <td><input type="text" placeholder="Experience" name="experience" class="em_reg_box" /></td>
            </tr>

            <!-- Qualifications Section -->
            <tr>
                <td colspan="3"><span class="em_head_one">Qualifications</span></td>
            </tr>
            <tr>
                <td colspan="3">
                    <textarea name="qualification" placeholder="Qualifications" class="em_address"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;">
                    <input type="submit" value="Post" />
                </td>
            </tr>
        </table>
    </div>
</form>
</body>
</html>
