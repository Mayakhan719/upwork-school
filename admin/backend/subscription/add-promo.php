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
    if (isset($_POST["code"]) && isset($_POST["date"]) && isset($_POST["discount"])) {
    $data->code=$_POST["code"];
    $data->date=$_POST["date"];
    $data->discount=$_POST["discount"];
        if (createPromo($data)) {
            $_SESSION["message"] = "Promo Code Created Successfully";
            header("location:../../manage-promo-code.php");
        }else{
            $_SESSION["message"] = "failed to create promo code";
            header("location:../../manage-promo-code.php");
        }
    }else{
        $_SESSION["message_error"] = "All data needed";
        header("location:../../manage-promo-code.php");
    }
}else{
    $_SESSION["message_error"] = "Server error";
    header("location:../../manage-promo-code.php");
    }
?>