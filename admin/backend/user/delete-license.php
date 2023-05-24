<?php
session_start();
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../../../include/db.php");
include_once("../../function/Admin.php");
$data = new stdClass();
$data->conn=connect();

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $data2 =json_decode(file_get_contents("php://input"));
    if (!empty($data2->id)){
        $data->id=$data2->id;
        if (deleteAgreement($data)) {
            $_SESSION["message"] = "License agreement delete Successfully";
            http_response_code(200);
            echo json_encode(array(
            "status"=>true,
            "message"=>"License agreement delete Successfully"
        ));
        }else{
            $_SESSION["message_error"] = "failed to delete License agreement";
            http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"failed to delete License agreement"
        ));
        }
    }else{
        $_SESSION["message_error"] = "All data needed";
        http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"All data needed"
        ));
    }
}else{
    $_SESSION["message_error"] = "Server error";
    http_response_code(200);
            echo json_encode(array(
            "status"=>false,
            "message"=>"Server error"
        ));
    }
?>