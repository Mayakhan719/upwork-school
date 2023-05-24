<?php
// debuger
ini_set("display_errors",1);
session_start();
use PHPMailer\PHPMailer\PHPMailer;
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");


// file include
include_once("../../include/db.php");
include_once("../function/Function.php");
require_once "../library/PHPMailer/PHPMailer.php";
require_once "../library/PHPMailer/SMTP.php";
require_once "../library/PHPMailer/Exception.php";
$data = new stdClass();
$data->conn=connect();
// object
if($_SERVER['REQUEST_METHOD'] === "POST"){

$data2 =json_decode(file_get_contents("php://input"));
if(!empty($data2->email)){
$data->email=$data2->email;
$subject = "Forget password";
$data->code = random_int(1000, 9999);
$body = " Hi,Your Code is:$data->code";

 if($row=searchByEmail($data)){
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
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        if (saveOTP($data)) {
        http_response_code(200);
        echo json_encode(array(
            "status"=>true,
            "message"=>"email send:code".$data->code
        ));
    }else {
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"code not saved"
        ));
    }
    }else{
        http_response_code(200);
    echo json_encode(array(
        "status"=>false,
        "message"=>"failed to send code"
    ));
    }
}else{
    http_response_code(200);
    echo json_encode(array(
        "status"=>false,
        "message"=>"Wrong email"
    ));
}
}else{
    http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"All Data needed"
        ));
}
}else{
    http_response_code(503);
echo json_encode(array(
    "status"=>false,
    "message"=>"server error"
));
}
?>