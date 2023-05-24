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
    if (isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["dob"])  && isset($_POST["gender"])) {
        $data->email=$_POST["email"];
    $data->dob= $_POST["dob"];
    $data->username=$_POST["username"];
    $data->gender=$_POST["gender"];
    $data->id = $_SESSION["admin_id"];
            if (UpdateUser($data)) {
                $_SESSION["message"] = "Profile Updated Successfully";
                header("location:../../profile.php");
            }else{
                $_SESSION["message_error"] = "failed to Update Profile";
                header("location:../../profile.php");
            }
    }else{
        $_SESSION["message_error"] = "All data needed";
        header("location:../../profile.php");
    }
}else{
    $_SESSION["message_error"] = "Server error";
    header("location:../../profile.php");
    }
?>