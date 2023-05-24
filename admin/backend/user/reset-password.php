<?php
// debuger
session_start();
include_once("../../../include/db.php");
include_once("../../function/Admin.php");
$data = new stdClass();
$data->conn=connect();
if($_SERVER['REQUEST_METHOD'] === "POST"){
    if ($_POST["newpassword"] && $_POST["confirmpassword"]) {
        $data->email=$_SESSION["email_code"];
        unset($_SESSION["email_code"]);
        $password=$_POST["newpassword"];
        $cpassword=$_POST["confirmpassword"];
    if ($password == $cpassword) {
        $data->password=password_hash($password, PASSWORD_DEFAULT);
        if(resetPassword($data)){
            $_SESSION["message"]="Password has been changed";
            header("location:../../login.php");
            }else{
                $_SESSION["message_error"]="Failed to Change Password";
                header("location:../../reset-password.php");
            }
        }else{
            $_SESSION["message_error"]="Password are not same";
            header("location:../../reset-password.php");
        }


}else{
    $_SESSION["message_error"]="Please enter both password";
    header("location:../../reset-password.php");
    }
}else{
    $_SESSION["message_error"]="server error";
    header("location:../../reset-password.php");
    }
?>