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
    if (isset($_POST["terms_and_condition"]) && isset($_POST["id"])) {
    $data->terms_and_condition=pg_escape_string($data->conn,$_POST["terms_and_condition"]);
    $data->id=$_POST["id"];
    if ($_POST["status"] == 'active') {
        $data->status=$_POST["status"];
    }else{
        $data->status = 'inactive';
    }
        if (updateLicense($data)) {
        $_SESSION["message"] = "License Agreement Updated";
        header("location:../../Licence.php");
        }else{
            $_SESSION["message_error"] = "failed to update License Agreement";
            header("location:../../Licence.php");
        }
    }else{
        $_SESSION["message_error"] = "Please enter code";
        header("location:../../Licence.php");
    }
}else{
    $_SESSION["message_error"] = "Server error";
    header("location:../../Licence.php");

    }
?>