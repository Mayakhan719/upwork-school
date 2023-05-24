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
    if (isset($_POST["terms_and_condition"])) {
    $data->terms_and_condition=pg_escape_string($data->conn,$_POST["terms_and_condition"]);
    if ($_POST["status"] == 'active') {
        $data->status=$_POST["status"];
    }else{
        $data->status = 'inactive';
    }
        if (CreateLicense($data)) {
        $_SESSION["message"] = "Terms and condition Created";
        header("location:../../Licence.php");
        }else{
            $_SESSION["message"] = "failed to Created Terms and condition";
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