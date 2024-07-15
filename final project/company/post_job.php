<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="images/employer.png" type="image/x-icon">
<link rel="shortcut icon" href="images/employer.png" type="image/x-icon" />
<title>Employer Registration</title>
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

<form onsubmit="return validateForm();" action="submit_company.php" method="post" name="employer_registration" enctype="multipart/form-data">
<div class="employee_register">
    <img src="images/1377172085_mail-new.png" align="left"/><br />
    <span>New Employer Registration</span>
    <table>
        <tr>
            <td colspan="3"><span class="em_head_one">Create Your Account</span></td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> Company Name</td>
            <td>:</td>
            <td><input type="text" placeholder="Company Name" name="company" class="em_reg_box" /></td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> Type</td>
            <td>:</td>
            <td>
                <input type="radio" name="companytype" value="Company"/> Company
                <input type="radio" name="companytype" value="Recruitment Agency"/> Recruitment Agency
            </td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> Category</td>
            <td>:</td>
            <td>
                <select name="category" class="em_reg_box_select">
                    <option value="" selected="selected">- Select -</option>
                    <option value="IT Software - Mobile">IT Software - Mobile</option>
                    <option value="IT Software - Telecom Software">IT Software - Telecom Software</option>
                    <option value="IT Software - DBA / Datawarehousing">IT Software - DBA / Datawarehousing</option>
                    <option value="IT Software - E-Commerce / Internet Technologies">IT Software - E-Commerce / Internet Technologies</option>
                    <option value="IT Software - Embedded /EDA /VLSI /ASIC /Chip Des.">IT Software - Embedded /EDA /VLSI /ASIC /Chip Des.</option>
                    <option value="IT Software - ERP / CRM">IT Software - ERP / CRM</option>
                    <option value="IT Software - Network Administration / Security">IT Software - Network Administration / Security</option>
                    <option value="IT Software - QA & Testing">IT Software - QA & Testing</option>
                    <option value="Marketing / Advertising / MR / PR">Marketing / Advertising / MR / PR</option>
                    <option value="Shipping">Shipping</option>
                    <option value="Other">Other</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> Address</td>
            <td>:</td>
            <td><textarea name="address" class="em_address"></textarea></td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> City</td>
            <td>:</td>
            <td><input type="text" placeholder="City" name="city" class="em_reg_box" /></td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> State</td>
            <td>:</td>
            <td><input type="text" placeholder="State" name="state" class="em_reg_box" /></td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> Website URL</td>
            <td>:</td>
            <td><input type="text" placeholder="URL" name="website" class="em_reg_box" /></td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> Telephone</td>
            <td>:</td>
            <td><input type="text" placeholder="Telephone" name="telephone" class="em_reg_box" /></td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> Benefits</td>
            <td>:</td>
            <td><input type="text" placeholder="Benefits" name="benefits" class="em_reg_box" /></td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> Requirements</td>
            <td>:</td>
            <td><input type="text" placeholder="Requirements" name="requirements" class="em_reg_box" /></td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> Job Description</td>
            <td>:</td>
            <td><input type="text" placeholder="Job Description" name="job_description" class="em_reg_box" /></td>
        </tr>
        <tr>
            <td colspan="3"><span class="em_head_one">Contact Details</span></td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> Title</td>
            <td>:</td>
            <td>
                <select name="title" class="em_reg_box_select">
                    <option value="" selected="selected">--Select--</option>
                    <option value="Mr">Mr</option>
                    <option value="Ms">Ms</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Dr">Dr</option>
                    <option value="Prof">Prof</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> First Name</td>
            <td>:</td>
            <td><input type="text" placeholder="First Name" name="fname" class="em_reg_box" /></td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> Last Name</td>
            <td>:</td>
            <td><input type="text" placeholder="Last Name" name="lname" class="em_reg_box" /></td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> Designation</td>
            <td>:</td>
            <td><input type="text" placeholder="Designation" name="designation" class="em_reg_box" /></td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> Email id</td>
            <td>:</td>
            <td><input type="text" placeholder="Email id" name="contactemail" class="em_reg_box" /></td>
        </tr>
        <tr>
            <td><span class="em_reg_star">*</span> Mobile</td>
            <td>:</td>
            <td>+
                <input type="text" name="MCCode" class="mobile_box" onkeypress="return onlyNumbers(event);" />
                - <input type="text" name="MNumber" class="mobile_number_box" onkeypress="return onlyNumbers(event);" />
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;">
                <input type="submit" value="Register" />
            </td>
        </tr>
    </table>
</div>
</form>

</body>
</html>
