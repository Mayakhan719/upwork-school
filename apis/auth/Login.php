<?php
session_start();
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../../include/db.php");
include_once("../function/Function.php");
$data = new stdClass();
$data->conn=connect();

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $data2 =json_decode(file_get_contents("php://input"));
    if(!empty($data2->email) && !empty($data2->password)){
    $data->email=$data2->email;
     $data->password=$data2->password;
     
     if(!empty($row=searchByEmail($data))){
     $passwordFetch = $row["password"];
    if (password_verify($data->password,$passwordFetch)) {
        http_response_code(200);
        echo json_encode(array(
            "data"=>$row,
            "status"=>true,
            "message"=>"Login Successful"
        ));
    }else{
            http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Password Incorrect"
        ));
    }
     }else{
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Email not registered"
        ));
     }
    }else{
        http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"All Data Needed"
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