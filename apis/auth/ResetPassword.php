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
    if (!empty($data2->email) && !empty($data2->password)) {
        $data->email = $data2->email;
        $password = $data2->password;
        $data->password = password_hash($password, PASSWORD_DEFAULT);
        if (!empty($row = searchByEmail($data))) {
            if (updatePassword($data)) {
                $row3 = searchByEmail($data);
                http_response_code(200);
                echo json_encode(array(
                "Data"=>$row3,
                "status"=>true,
                "message"=>"Password Updated Successfully"
            ));
            }else{
                http_response_code(200);
                echo json_encode(array(
                "status"=>false,
                "message"=>"Failed To Update Password"
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
        http_response_code(503);
    echo json_encode(array(
        "status"=>false,
        "message"=>"Server Error"
    ));
    }
    ?>