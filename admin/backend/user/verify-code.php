<?php
session_start();
// file include
include_once("../../../include/db.php");
include_once("../../function/Admin.php");
$data = new stdClass();
$data->conn=connect();
if($_SERVER['REQUEST_METHOD'] === "POST"){
    if (!empty($_POST["code"])) {
    $data->email=$_SESSION["email_code"];
    $data->code=$_POST["code"];
    if(!empty($row = searchByEmail($data))){
            $code = $_SESSION["code"];
        if ($code == $data->code) {
            header("location:../../reset-password.php");
        }else{
            $_SESSION["error_message"] = "Your code is incorrect";
            header("location:../../code-verification.php");
        }
    }else{
            $_SESSION["error_message"] = "Email is not register";
            header("location:../../code-verification.php");
    }
    }else{
        $_SESSION["error_message"] = "Please enter code";
        header("location:../../code-verification.php");
    }

}
?>