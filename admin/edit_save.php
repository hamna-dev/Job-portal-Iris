<?php
session_start();
include_once "../connect/connect.php";
$user=$_SESSION['user_id'];
if($_SERVER["REQUEST_METHOD"]== "POST")
{
    if(isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['confirm_pass']))
    {
        if($_POST['pass']===$_POST['confirm_pass'])
        {
            $new_email=$_POST['email'];
            $new_pass=$_POST['pass'];
            $sql="UPDATE users SET email = ?, password= ? WHERE user_id= ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $new_email, $new_pass, $user);
            $stmt->execute();

            if($stmt->affected_rows > 0){
                echo '<script>alert("Update Successfuly!!"); window.location.href="edit_profile.php";</script>';
            }else{
                echo '<script>alert("Update not complete!!"); window.location.href="edit_profile.php";</script>';   
            }
            $stmt->close();
        }
        else
        {
            echo "Both passwords need to be the same";
        }
    }
}
?>
