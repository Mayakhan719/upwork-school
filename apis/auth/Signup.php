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
    $data2 = json_decode(file_get_contents("php://input"));
    if ( !empty($data2->email) && !empty($data2->password) && !empty($data2->username)) {
        $data->username = $data2->username;
        $data->email = $data2->email;
        $password = $data2->password;
        $data->password = password_hash($password, PASSWORD_DEFAULT);
                if (empty($row = searchByEmail($data))) {
                    if ($dat = CreateUser($data)) {
                        http_response_code(200);
                        echo json_encode(
                            array(
                                "status" => true,
                                "message" => "User Created Successfully",
                                "user" => $dat
                            )
                        );
                        exit();
                    } else {
                        http_response_code(200);
                        echo json_encode(array(
                                "status" => false,
                                "message" => "Failed to create user"
                            ));
                    }

                } else {
                    http_response_code(200);
                    echo json_encode(array(
                            "status" => false,
                            "message" => "User Already Exist try another Email"
                        ));
                }
    } else {
        http_response_code(200);
        echo json_encode(array(
                "status" => false,
                "message" => "All Data needed"
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