<?php
session_start();
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../../include/db.php");
include_once("../function/Function.php");
$data = new stdClass();
$data->conn=connect();
if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
    $data2 =json_decode(file_get_contents("php://input"));
    if(!empty($data2->id)){
        $data->id=$data2->id;
        if (!empty($row = DeleteVideo($data))) {
            http_response_code(200);
            echo json_encode(array(
                "status"=>true,
                "message"=>"Video Deleted Successfully"
            ));
        }else{
            http_response_code(200);
            echo json_encode(array(
                "status"=>false,
                "message"=>"Failed To delete video"
            ));
         }
    }else {
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