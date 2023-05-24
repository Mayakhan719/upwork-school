<?php
session_start();
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../../include/db.php");
include_once("../function/Function.php");
$data = new stdClass();
$data->conn=connect();

if ($_SERVER['REQUEST_METHOD'] === "PUT") {
    $data2 = json_decode(file_get_contents("php://input"));
    if (!empty($data2->id) ){
        $data->id = $data2->id;
        $row = searchById($data);
    if (!empty($data2->username) ){
        $data->username = $data2->username;
    }else{
        $data->username = $row["username"];
    }
    if (!empty($data2->referral_code) ){
        $data->referral_code = $data2->referral_code;
    }else{
        $data->referral_code = $row["referral_code"];
    }
      if (!empty($data2->country)){
        $data->country = $data2->country;
    }else{
        $data->country = $row["country"];
    }
    if (!empty($data2->city)) {
        $data->city = $data2->city;
    }else{
        $data->city = $row["city"];
    }
            if (updateProfile($data)) {
                $row3 = searchById($data);
                http_response_code(200);
                echo json_encode(array(
                "Data"=>$row3,
                "status"=>true,
                "message"=>"Profile Updated Successfully"
            ));
            }else{
                http_response_code(200);
                echo json_encode(array(
                "status"=>false,
                "message"=>"Failed To Update Profile"
            ));
            }
}else {
    http_response_code(200);
                echo json_encode(array(
                "status"=>false,
                "message"=>"user id will not be null"
            ));
}

    }else{
        http_response_code(503);
    echo json_encode(array(
        "status"=>false,
        "message"=>"Server Error"
    ));
    }
    ?>