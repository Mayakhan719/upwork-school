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
    if(!empty($data2->description)){
    $data->description=$data2->description;
    if ($row = createRecommendation($data)) {
        http_response_code(200);
        echo json_encode(array(
            "status"=>true,
            "message"=>"Recommendation Created Successfully",
			"data"=>$row
        ));
    }else{
            http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Failed To Create Recommendation"
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