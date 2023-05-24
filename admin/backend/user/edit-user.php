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
    if (isset($_POST["id"]) && isset($_POST["email"]) && isset($_POST["city"]) && isset($_POST["password"]) && isset($_POST["city"]) && isset($_POST["country"]) && isset($_POST["referral_code"])) {
        $data->id=$_POST["id"];
        $data->email=$_POST["email"];
    $data->password=$_POST["password"];
    $data->city=$_POST["city"];
    $data->country=$_POST["country"];
    $data->referral_code=$_POST["referral_code"];
        // if (empty(searchByEmail($data))) {
        if (updateUser($data)) {
            $_SESSION["message"] = "User updated Successfully";
            header("location:../manage-users.php");
        }else{
            $_SESSION["message"] = "failed to update user";
            header("location:../manage-users.php");
        }
    // }else{
    //         $_SESSION["message_error"] = "User Already Exist on this email";
    //         header("location:../manage-users.php");
    //     }
    }else{
        $_SESSION["message_error"] = "All data needed";
        header("location:../manage-users.php");
    }
}else{
    $_SESSION["message_error"] = "Server error";
    header("location:../manage-users.php");
    }
?>