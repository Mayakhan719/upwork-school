<?php 
require_once "../admin/Library/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
function sendMail($data){
     //SMTP Settings
     $mail = new PHPMailer();
     $mail->isSMTP();
     $mail->Host = "smtp.gmail.com";
     $mail->SMTPAuth = true;
     $mail->Username = "ventureoffical123@gmail.com"; //enter you email address
     $mail->Password = 'bpvlxqxuetmtregm'; //enter you email password
     $mail->Port = 465;
     $mail->SMTPSecure = "ssl";
     //Email Settings
     $mail->isHTML(true);
     $mail->setFrom("noreply@gmail.com");
     $mail->addAddress($data->email); //enter you email address
     $mail->Subject = ("$data->subject");
     $mail->Body = $data->body;
     if ($mail->send()) {
        return true;
    }
}
?>