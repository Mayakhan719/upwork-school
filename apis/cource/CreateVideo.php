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
    if(!empty($data2->title) && !empty($data2->link) && !empty($data2->description)){
    $data->title=$data2->title;
     $data->link=$data2->link;
     $data->description=$data2->description;
    if ($row = createVideo($data)) {
        http_response_code(200);
        echo json_encode(array(
            "data"=>$row,
            "status"=>true,
            "message"=>"Video Created Successfully"
        ));
    }else{
            http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Failed To Create Video"
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