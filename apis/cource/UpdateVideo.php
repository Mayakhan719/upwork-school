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

if($_SERVER['REQUEST_METHOD'] === "PUT"){

    $data2 =json_decode(file_get_contents("php://input"));
    if(!empty($data2->id) && !empty($data2->title) && !empty($data2->link) && !empty($data2->description)){
    $data->id=$data2->id;
    $data->title=$data2->title;
     $data->link=$data2->link;
     $data->description=$data2->description;
    if ($row = UpdateVideo($data)) {
        http_response_code(200);
        echo json_encode(array(
            "data"=>[
                'id'=>$data->id,
                'title'=>$data->title,
                'link'=>$data->link,
                'description'=>$data->description
            ],
            "status"=>true,
            "message"=>"Video Updated Successfully"
        ));
    }else{
            http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Failed To Update Video"
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