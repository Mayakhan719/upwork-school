<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../../../include/db.php");
include_once("../../function/Admin.php");
require_once "../../library/PHPMailer/PHPMailer.php";
require_once "../../library/PHPMailer/SMTP.php";
require_once "../../library/PHPMailer/Exception.php";
$data = new stdClass();
$data->conn=connect();

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if (isset($_POST["email"])) {
    $data->email=$_POST["email"];
    $data->code = random_int(1000, 9999);
    if(!empty($row=searchByEmail($data))){
        $data->body = " Hi Admin, Your Code is:$data->code";
        $data->subject = "Reset Password";
        $mail = new PHPMailer();
        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "ofertasv123@gmail.com"; //enter you email address
        $mail->Password = 'eaomaxyylcgxgbau'; //enter you email password
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";
    
        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom("ofertasv123@gmail.com");
        $mail->addAddress($data->email); //enter you email address
        $mail->Subject = ("$data->subject");
        $mail->Body = $data->body;

        if ($mail->send()) {
        // Storing Code
        $_SESSION["code"] = $data->code;
        $_SESSION["email_code"]=$data->email;
        header("location:../../code-verification.php");
        }else{
            $_SESSION["message"] = "failed to send email";
            header("location:../../forget-password.php");
        }
    }else{
        $_SESSION["message_error"] = "This email is not register";
        header("location:../../forget-password.php");
        
    }

    }else{
        $_SESSION["message_error"] = "Please enter Email";
        header("location:../../forget-password.php");
    }
}else{
    $_SESSION["message_error"] = "Server error";
    header("location:../../forget-password.php");
    }
?>